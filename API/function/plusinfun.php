<?
//PHP 驗證 Email -檢查 DNS 的 MX
function check_email($email) 
{  
    if(preg_match('/^w[-.w]*@(w[-._w]*.[a-zA-Z]{2,}.*)$/', $email, $matches)) 
	{  
        $hostname = $matches[1];  
        if(function_exists('checkdnsrr')) 
		{  
            if(checkdnsrr($hostname.'.', 'MX')) return true;  
            //if(checkdnsrr($hostname.'.', 'A')) return true;  
        }else 
		{  
            exec("nslookup -type=MX $hostname", $result);  
            foreach($result as $line) 
			{  
                if(eregi("^$hostname", $line)) return true;  
            }  
            return false;  
        }  
        return false;  
    }  
    return false;  
}
?>