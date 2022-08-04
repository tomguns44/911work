<?
if (isset($_GET['xclass']))
{
	if (!preg_match('/^\w+$/', $_GET['xclass']))
	{
		exit;
	}
}

if (isset($_GET['uid']))
{
	if (!preg_match('/^\w+$/', $_GET['uid']))
	{
		exit;
	}
}

if (isset($_GET['code']))
{
	if (!preg_match('/^\w+$/', $_GET['code']))
	{
		exit;
	}
}

if (isset($_GET['tid']))
{
	if (!preg_match('/^\w+$/', $_GET['tid']))
	{
		exit;
	}
}

if (isset($_COOKIE['pk_src_url']))
{
	if (!preg_match('/^\w+$/', $_COOKIE['pk_src_url']))
	{
		exit;
	}
}

if (isset($_GET['uuid']))
{
	if (!preg_match('/^\w+$/', $_GET['uuid']))
	{
		exit;
	}
} 

if (isset($_GET['page']))
{
	if (!preg_match('/^\w+$/', $_GET['page']))
	{
		exit;
	}
}

if (isset($_GET['PB_page']))
{
	if (!preg_match('/^\w+$/', $_GET['PB_page']))
	{
		exit;
	}
}

if (isset($_GET['login_account']))
{
	if (!preg_match('/^\w+$/', $_GET['login_account']))
	{
		exit;
	}
}

if (isset($_GET['login_pwd']))
{
	if (!preg_match('/^\w+$/', $_GET['login_pwd']))
	{
		exit;
	}
}

//=================================================================

if (isset($_POST['code']))
{
	if (!preg_match('/^\w+$/', $_POST['code']))
	{
		exit;
	}
}

if (isset($_POST['pk_src_url']))
{
	if (!preg_match('/^\w+$/', $_POST['pk_src_url']))
	{
		exit;
	}
}

if (isset($_POST['tid']))
{
	if (!preg_match('/^\w+$/', $_POST['tid']))
	{
		exit;
	}
}

if (isset($_POST['login_account']))
{
	if (!preg_match('/^\w+$/', $_POST['login_account']))
	{
		exit;
	}
}

if (isset($_POST['login_pwd']))
{
	if (!preg_match('/^\w+$/', $_POST['login_pwd']))
	{
		exit;
	}
}

if (isset($_POST['idno']))
{
	if (!preg_match('/^\w+$/', $_POST['idno']))
	{
		exit;
	}
}

if (isset($_COOKIE['setIP']))
{
	if (!preg_match('/^\w+$/', $_COOKIE['setIP']))
	{
		exit;
	}
}

function turn_sql_tgs($str){   //從網頁過來的資料
  if(!get_magic_quotes_gpc())
  {
	  //$str=str_replace("\"","”",$str);	  
		//$str=str_replace("'","",$str);
	   // $str=str_replace("\"","",$str);
	   //$str=str_replace("","  ",$str);
	//   $str=iconv('big5','big5//ignore',$str);
	   $str=addslashes($str);
   }
   $str=str_replace('\'','&#039',$str);
   if(substr($str,-1,1)=="\\")
      $str=$str." ";
   if(substr($str,-1,2)=="//")
      $str=$str." ";
   $str=htmlspecialchars($str); 
   return $str;
}

function RemoveXSS($val) {   
   // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed   
   // this prevents some character re-spacing such as <java\0script>   
   // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs   
   $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);   
      
   // straight replacements, the user should never need these since they're normal characters   
   // this prevents like <IMG SRC=@avascript:alert('XSS')>   
   $search = 'abcdefghijklmnopqrstuvwxyz';  
   $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';   
   $search .= '1234567890!@#$%^&*()';  
   $search .= '~`";:?+/={}[]-_|\'\\';  
   for ($i = 0; $i < strlen($search); $i++) {  
      // ;? matches the ;, which is optional  
      // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars  
     
      // @ @ search for the hex values  
      $val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ;  
      // @ @ 0{0,7} matches '0' zero to seven times   
      $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ;  
   }  
     
   // now the only remaining whitespace attacks are \t, \n, and \r  
   $ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');  
   $ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');  
   $ra = array_merge($ra1, $ra2);  
     
   $found = true; // keep replacing as long as the previous round replaced something  
   while ($found == true) {  
      $val_before = $val;  
      for ($i = 0; $i < sizeof($ra); $i++) {  
         $pattern = '/';  
         for ($j = 0; $j < strlen($ra[$i]); $j++) {  
            if ($j > 0) {  
               $pattern .= '(';   
               $pattern .= '(&#[xX]0{0,8}([9ab]);)';  
               $pattern .= '|';   
               $pattern .= '|(&#0{0,8}([9|10|13]);)';  
               $pattern .= ')*';  
            }  
            $pattern .= $ra[$i][$j];  
         }  
         $pattern .= '/i';   
         $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag   
         $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags   
         if ($val_before == $val) {   
            // no replacements were made, so exit the loop   
            $found = false;   
         }   
      }   
   }   
   return $val;   
}

//XSS 判斷
function xss_tgs($val)
{
	$result = false;
	$xss_s = htmlspecialchars($val);
	$xss_d = RemoveXSS($xss_s);
	//echo $xss_s."<br />".$xss_d."<br />".substr_count($xss_d,"sc<x>ript");exit;
	if (substr_count($xss_d,"sc<x>ript")!=0 ||
	    substr_count($xss_d,"mouseover")!=0 ||
		substr_count($xss_d,"\"")!=0 ||
		substr_count($xss_d,"'")!=0 ||
		substr_count($xss_d,"../../")!=0) 
	{
		$result = true;
	}
	
	if (!$result)
	{
		$request = array_merge($_GET, $_POST); 
		if (count($request)>0)
		{
			foreach ($request as $key => $value)
			{
				if ($key)
				{
					$xv = @htmlspecialchars($value);
					$dv = RemoveXSS($xv);
					if (substr_count($dv,"sc<x>ript")!=0 ||
						substr_count($dv,"mouseover")!=0 ||
						substr_count($dv,"\"")!=0 ||
						substr_count($dv,"'")!=0 ||
						substr_count($dv,"../../")!=0)
					{
						$result = true;
						break;
					}
				}
			}
		}
	}
	
	return $result;
}

//XSS 判斷
if (xss_tgs($_SERVER['PHP_SELF']))
{
	echo "This script is possibly vulnerable to Cross Site Scripting (XSS) attacks.Err:0";
	exit;
}

if (xss_tgs($_SERVER['QUERY_STRING']))
{
	echo "This script is possibly vulnerable to Cross Site Scripting (XSS) attacks.Err:1";
	exit;
}

if (xss_tgs($_SERVER['SCRIPT_NAME']))
{
	echo "This script is possibly vulnerable to Cross Site Scripting (XSS) attacks.Err:2";
	exit;
}


?>