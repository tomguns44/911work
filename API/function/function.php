<?php
include dirname(__FILE__)."/desqlinjection.php";
//include dirname(__FILE__)."/lang.php";
//include dirname(__FILE__)."/plusinfun.php";
//include dirname(__FILE__)."/db_mssql.php";
include dirname(__FILE__)."/db_mysql.php";

include dirname(__FILE__)."/tools.php";

//include dirname(__FILE__)."/email.php";

$now_web_lang = "zh_tw";

function GrantSet($str){
   //$tmp_path=explode('/',str_replace (strtolower($SetPath),"",strtolower($_SERVER['SCRIPT_NAME'])));
   $tmp_path=explode('/',$str);
   $tmp_file=explode('.',$tmp_path[count($tmp_path)-1]);
   $tmp_val=$tmp_file[0];
   
   $result = 0;
   $s = " WHERE NameExe LIKE '".$tmp_val."%'";
   $r = loaddata_row("sdb_admin_program",$s); //echo $s;exit;
   if (!$r)
   {
	   ?>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <script language="JavaScript">
      alert("您無權限進入此功能!");
	  location.href = ('index.php');
      </script> 
	  <?
	  exit();
   }else
   {
	   $result = $r['uid'];
   }
   
   return $result;
}

function GrantItem($iProNo,$iCode){
   $UserNo = $_COOKIE['admin_id'];
   $result = false;
   $s = " WHERE iUserNo='".$UserNo."' AND iProNo='".$iProNo."' AND iCode='".$iCode."' "; //echo $s; exit;
   $r = loaddata_row("sdb_admin_AdmUseItem",$s); //echo $s;exit;
   if ($r)
   {
	   $result = true;  
   }
   return $result;
}

function GrantSetStr($id){
   $result = "";
   $s = " WHERE uid='".$id."'";
   $r = loaddata_row("sdb_admin_program",$s); //echo $s;exit;
   $result = $r['Name'];  
   return $result;
}

function ftSelectSort($table,$iSort,$s)//"sdb_admin_class",$iSort," WHERE 1 ")
{
	$chkispowermsql = new phpMysql_h;
	$chkispowermsql->init();
	$sql = "SELECT MAX(iSort) FROM ".$table." ".$s;
	$chkispowermsql->query($sql);
	list($row) = mysql_fetch_row($chkispowermsql->listmysql);
	$chkispowermsql->close_mysql();
	unset($chkispowermsql);
	$val = $iSort==""?$row+1:$iSort;
	$result = "<input name='iSort' type='text' class='inputstyle' id='iSort' value='".$val."' size='5' maxlength='3'>";

	return $result;
}

function ftSelectID($table,$s="")//"sdb_admin_class",$iSort," WHERE 1 ")
{
	$chkispowermsql = new phpMysql_h;
	$chkispowermsql->init();
	$sql = "SELECT MAX(uid) FROM ".$table." ".$s;
	$chkispowermsql->query($sql);
	if (!list($row) = mysql_fetch_row($chkispowermsql->listmysql))
	{
		$row=0;
	}
	$chkispowermsql->close_mysql();
	unset($chkispowermsql);
	$result = $row+1;

	return $result;
}

function turn_sql($str){   //從網頁過來的資料
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

function AddOnline($ip)
{
	$chkispowermsql = new phpMysql_h;
	$chkispowermsql->init();
	$now = mktime(date('H'),date('m'),date('s'),date('m'),date('d'),date('Y'));
	$sql = "DELETE FROM online WHERE abs(datex-".$now.")>300 ";
	$chkispowermsql->query($sql);
	$sql = "SELECT datex FROM online WHERE ip='$ip' ORDER BY datex DESC LIMIT 0,1";
	$chkispowermsql->query($sql);
	list($datex)=mysql_fetch_row($chkispowermsql->listmysql);
	$p = $now-$datex;
	if ($p>=5*60)
	{
		$sql = "DELETE FROM online WHERE ip='$ip' ";
		$chkispowermsql->query($sql);
		$sql = "INSERT INTO online (serial,ip,datex) VALUES ('','$ip',$now)";
		$chkispowermsql->query($sql);
	}
	$chkispowermsql->close_mysql();
	unset($chkispowermsql);
}

function AddIP($ip)
{
	$chkispowermsql = new phpMysql_h;
	$chkispowermsql->init();
	$sql = "INSERT sdb_admin_ip (uid,ip,datex) VALUES ('','$ip',NOW())";
	$chkispowermsql->query($sql);
	$chkispowermsql->close_mysql();
	unset($chkispowermsql);
}

function loadTableCount($table,$s="")
{
	$chkispowermsql = new phpMysql_h;
	$chkispowermsql->init();
	$sql = "SELECT COUNT(*) FROM ".$table." ".$s;
	$chkispowermsql->query($sql);
	list($cs) = mysql_fetch_row($chkispowermsql->listmysql);
	$chkispowermsql->close_mysql();
	unset($chkispowermsql);
	
	return $cs;
}

function loadIPCount($table)
{
	$c = loadTableCount($table);
	return $c;
}

function loadTodayIPCount($table)
{
	$c = loadTableCount($table," WHERE to_days(now())-to_days(datex)=0");
	return $c;
}

function loadYesTodayIPCount($table)
{
	$c = loadTableCount($table," WHERE to_days(now())-to_days(datex)=1");
	return $c;
}

function loadpasw()  //
{
	$chkispowermsql = new phpMysql_h;
	$chkispowermsql->init();
	$sql = "SELECT admin_pasw FROM sdb_admin_pasw ";
	$chkispowermsql->query($sql);
	list($row) = mysql_fetch_row($chkispowermsql->listmysql);
	$chkispowermsql->close_mysql();
	unset($chkispowermsql);

	return $row;
}

function cuttingstr($str,$ct)
{
	if(strlen($str) > $ct)
	{
		for($i=0;$i<$ct;$i++)
		{
			$ch=substr($str,$i,1);
			if(ord($ch)>127) $i++;
		}
		$str= substr($str,0,$i);
	}
	return $str;
}

function GetHtmlText($str)
{
	$str = preg_replace("/<sty(.*)\/style>|<scr(.*)\/script>|<!--(.*)-->/isU","",$str);
	$alltext = "";
	$start = 1;
	for($i=0;$i<strlen($str);$i++){
	if($start==0 && $str[$i]==">") $start = 1;
	else if($start==1){
	 if($str[$i]=="<"){ $start = 0; $alltext .= " "; }
	 else if(ord($str[$i])>32) $alltext .= $str[$i];
	}
	}
	$alltext = preg_replace("/&([^;&]*)(;|&)/"," ",$alltext);
	$alltext = preg_replace("/@{1,}/"," ",$alltext);
	$alltext = preg_replace("/ {1,}/"," ",$alltext);
	return $alltext;
}

function cutdate($str)
{
	$s = substr($str,5,11);
	return $s;
}

function cutdate2($str)
{
	$s = substr($str,0,10);
	return $s;
}

//echo utf8_substr($content,0,15);
function utf8_substr($StrInput,$strStart,$strLen)
{
	//對字串做URL Eecode
	$StrInput = mb_substr($StrInput,$strStart,mb_strlen($StrInput));
	$iString = urlencode($StrInput);
	$lstrResult="";
	$istrLen = 0;
	$k = 0;
	do{
	$lstrChar = substr($iString, $k, 1);
	if($lstrChar == "%"){
	$ThisChr = hexdec(substr($iString, $k+1, 2));
	if($ThisChr >= 128){
	if($istrLen+3 < $strLen){
	$lstrResult .= urldecode(substr($iString, $k, 9));
	$k = $k + 9;
	$istrLen+=3;
	}else{
	$k = $k + 9;
	$istrLen+=3;
	}
	}else{
	$lstrResult .= urldecode(substr($iString, $k, 3));
	$k = $k + 3;
	$istrLen+=2;
	}
	}else{
	$lstrResult .= urldecode(substr($iString, $k, 1));
	$k = $k + 1;
	$istrLen++;
	}
	}while ($k < strlen($iString) && $istrLen < $strLen); 
	return $lstrResult;
}

function readpicfile($filename)
{
	$file = explode(".",$filename);
	$result = $file[0]."-s.jpg";
	return $result;
}

function search_exist_prod($SearchWord, $SearchKey, $SearchArray)
{
	$j=0;
	$isFind = false;
	if(is_array($SearchArray))
	{
		foreach($SearchArray as $sa_key) 
		{
			foreach($sa_key as $v1=>$v2)
			{
				//echo $v1."=>".$v2.$j."<br>";
				if ($SearchKey==$v1 && !is_numeric($v1))
				{
					if ($SearchWord == $v2)
					{
						$isFind = true;
						break;
					}
					$j++;
				}
			}
			if ($isFind) break;
		}
	}
	return $j;
}

function search_exist_prod_ex($actiontable, $SearchKey)
{
	$chkispowermsql = new phpMysql_h;
	$chkispowermsql->init();
	$sql = "SELECT billboard FROM memberInfo_billboard_".$actiontable." WHERE memId='".$SearchKey."' ";
	$chkispowermsql->query($sql);
	$j = 0;
	if (list($billboard) = mysql_fetch_row($chkispowermsql->listmysql))
	{
		$j = $billboard;
	}
	$chkispowermsql->close_mysql();
	unset($chkispowermsql);

	return $j;
}

function SendGET($_url)
{
	$url = parse_url($_url);
	$contents = '';
	$fp = fsockopen($url['host'],$url['port']);
	if($fp)
	{
		$_request = $url['path'].($url['query']==''?'':'?'.$url['query']).($url['fragment']==''?'':'#'.$url['fragment']);
		fputs($fp,'GET '.$_request." HTTP/1.0\r\n");
		fputs($fp,"Host: ".$url['host']."\n");
		fputs($fp,"Content-type: application/x-www-form-urlencoded\n");
		fputs($fp,"Connection: close\n\n");
		$line = fgets($fp,1024);
		if(!eregi("^HTTP/1\.. 200", $line)) return;
		else
		{
			$results = '';
			$contents = '';
			$inheader = 1;
			while(!feof($fp))
			{
				$line = fgets($fp,2048);
				if($inheader&&($line == "\n" || $line == "\r\n"))
				{
					$inheader = 0;
				}elseif(!$inheader)
				{
					$contents .= $line;
				}
			}
			fclose($fp);
		}
	}
	return $contents;
} 

//繁轉簡
function trangb($str)
 {
        $nstr=iconv('utf-8','big5',$str);
        if (iconv_strlen($str,'utf-8')!=iconv_strlen($nstr,'big5'))
                $nstr=riconv('utf-8','big5',$str);
        $pnstr=iconv('big5','gb2312',$nstr);
        if (iconv_strlen($nstr,'big5')!=iconv_strlen($pnstr,'gb2312'))
                $pnstr=riconv('big5','gb2312',$nstr);
        $nstr= iconv('gb2312','utf-8',$pnstr);
        return $nstr;
 }
function riconv($loc1,$loc2,$str)
{
    $i=iconv_strlen($str,$loc1);
    if ($i<=1)
        return '?';
    $blen=(int)($i/2);
    $elen=$i-$blen;
    $bstr=iconv_substr($str,0,$blen,$loc1);
    $nbstr=iconv($loc1,$loc2,$bstr);
    if (iconv_strlen($bstr,$loc1)!=iconv_strlen($nbstr,$loc2))
        $nbstr=riconv($loc1,$loc2,$bstr);
    $estr=iconv_substr($str,$blen,$elen,$loc1);
    $nestr=iconv($loc1,$loc2,$estr);
    if (iconv_strlen($estr,$loc1)!=iconv_strlen($nestr,$loc2))
        $nestr=riconv($loc1,$loc2,$estr);
    return $nbstr.$nestr;
}

function curl($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
?>
