<?
function check_email($email) 
{
	if(preg_match('/^\w[-.\w]*@(\w[-._\w]*\.[a-zA-Z]{2,}.*)$/', $email, $matches))
	{
		if(function_exists('checkdnsrr'))
		{
			if(checkdnsrr($matches[1] . '.', 'MX')) return true;
			if(checkdnsrr($matches[1] . '.', 'A')) return true;
		}else
		{
			if(!empty($hostName))
			{
				if( $recType == '' ) $recType = "MX";
				exec("nslookup -type=$recType $hostName", $result);
				foreach ($result as $line)
				{
					if(eregi("^$hostName",$line))
					{
						return true;
					}
				}
				return false;
			}
			return false;
		}
	}
	return false;
}

function check_email_Ex(&$email, $strict=0) 
{ 
	$email = strtolower($email); 
	if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*((\.[a-z]{2,3})|(\.info)|(\.name))$", $email)) 
	{ 
		return false; 
	}else 
	{ 
		if($strict) 
		{ 
			list ($Username, $Domain) = split ("@", $email); 
			if(function_exists('getmxrr') && getmxrr($Domain, $MXHost, $Weight)) 
			{ 
				foreach ( $Weight as $mxid => $preference ) 
				{ 
					if(trim($preference) == '') 
					{ 
						$preference = 10000000 + $row_counter; 
					}else 
					{ 
						$preference = $preference * 100; 
					} 
					while(isset($MXRecords[$preference])) 
					{ 
						$preference = $preference + 1; 
					} 
					$MXRecords[$preference] = $MXHost[$mxid]; 
				} 
				ksort($MXRecords); 
				$ConnectAddress = array_shift($MXRecords); 
			}else
			{ 
				$ConnectAddress = $Domain; 
			} 
			$Connect = fsockopen ( $ConnectAddress, 25 ); 
			if ($Connect) 
			{ 
				if (ereg("^220", $Out = fgets($Connect, 1024))) 
				{ 
					if (!isset($HTTP_HOST)) 
					{
						$h = "pk777.com.tw"; 
					}else 
					{
						$h = $HTTP_HOST;
					}
					fputs ($Connect, "HELO $h\r\n"); 
					$Out = fgets ( $Connect, 1024 ); 
					fputs ($Connect, "MAIL FROM: <{$email}>\r\n"); 
					$From = fgets ( $Connect, 1024 ); 
					fputs ($Connect, "RCPT TO: <{$email}>\r\n"); 
					$To = fgets ($Connect, 1024); 
					fputs ($Connect, "QUIT\r\n"); 
					fclose($Connect); 
					if (!ereg ("^250", $From) || !ereg ( "^250", $To )) 
					{ 
						return false; 
					} 
				}else 
				{ 
					return false; 
				} 
			}else 
			{ 
				return false; 
			}
		} # End of strict check 
		return true; 
	} 
} 

/*$email = "tgs@huco-tnm.com";
if (check_email_Ex(&$email,true))
{
	echo "it's ok-".$email;
}else
{
	echo "not use".$email;
}*/
?>