<?
class tools_h
{
	function showmessage($str,$code="utf-8")
	{
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$code\">";
		echo "<script language=\"JavaScript\">";
		echo "alert('$str');";
		echo "</script>";
	}

	function goURL($str)	//edit by nick
	{
	//	header("Location:$str");
		/*die ("<script Language=\"JavaScript\">location.href = ('$str');</script>");*/
        echo "<script Language=\"JavaScript\">window.location.href = '$str';</script>";
		exit;
		/*echo "<form name=\"submitfrm\"action=\"$str\" method=\"post\">";
		echo "</form>";
		echo "<script  language=\"JavaScript\">";
		echo "submitfrm.submit();";
		echo "</script>";*/
	}
	
	function goBack()
	{
		die ("<script Language=\"JavaScript\">history.go(-1);</script>");
	}

	function addzero($str,$size)
	{
		$tstr="";
		$strl=strlen($str);
		$sum=$size-$strl;
		for ($i=0;$i<$sum;$i++)
		{
			$tstr=$tstr."0";
		}
		$tstr=$tstr.$str;
		return $tstr;
	}

	function makedir($path)
	{
		mkdir($path,0777);
		$file=fopen($path."/check.tg","w");
		fclose($file);
	}

	function submitURL($str)	//edit by nick
	{
		die ("<script Language=\"JavaScript\">location.href = ('$str');</script>");
	}

	function submitgetURL($str)	//edit by nick
	{
		die ("<script Language=\"JavaScript\">location.href = ('$str');</script>");
	}

	function submitURLEx($str,$accstring)
	{
			echo "<form name=\"submitfrm\"action=\"$str\" method=\"post\">";
			echo "<input name=\"accstring\" type=\"hidden\" value=\"$accstring\">";
		echo "</form>";
		echo "<script  language=\"JavaScript\">";
		echo "submitfrm.submit();";
		echo "</script>";
	}

	function addslash($str)
	{
		$tstr=addslashes($str);
		return $tstr;
	}

	function stripslash($str)
	{
		$tstr=stripslashes($str);
		return $tstr;
	}
}
?>