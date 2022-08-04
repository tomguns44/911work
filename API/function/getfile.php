<?
date_default_timezone_set('Asia/Taipei');
include_once dirname(__FILE__)."/imagefun.php";
function getfile($hash,$g_pic,$g_pic_name,$path)
{
	if ($g_pic != "") 
	{
		$path.=$hash; 

		umask(0);
		@mkdir($path,0777);
		$path.="/";		
		$t_pic_name = explode(".",$g_pic_name);
		//$ext = $t_pic_name[count($t_pic_name)-1];
		$ext = @end(explode('.', $g_pic_name));
		$desc_file = strtotime(date('Y-m-d H:i:s')).(double)microtime() * 1000000;
		$x_pic_name = $desc_file.".".$ext;
		$tstr = $path.$x_pic_name;    //echo $tstr; exit;
		$file_size = filesize($g_pic);
		
		/*$max_size = 1024*300;
		if ($file_size>$max_size)
		{
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
			echo "<script language=\"JavaScript\">";
			echo "alert('檔案限制300K以下');";
			echo "</script>";
			die ("<script Language=\"JavaScript\">history.go(-1);</script>");
		}*/
		$allow_format = array('jpg','jpeg', 'png');
		copy($g_pic,$tstr);
		$t_ext = strtolower($ext);
		if (in_array($t_ext,$allow_format))
		{
			//$pstr = substr($tstr,0,strlen($tstr)-4)."-s.".$ext;
			//$pstr = $path.$desc_file."-s.".$ext;
			$pstr = $path."thumb-".$desc_file.".".$ext;
			ImageResize($tstr,$pstr,60,30);	
		}else
		{
			$pstr = $tstr;
		}
		$retval = $x_pic_name;
		unlink($g_pic);
	}else
	{
		$retval = "neno";
	}
	
	return $retval;
}	

function getfileEx($g_pic,$g_pic_name,$path)
{
	if ($g_pic != "") 
	{
		//$path = "/home/www/services/backup/music_pic/";
		//$path.=$hash; 
		//echo $path; exit;
		umask(0);
		@mkdir($path,0777);
		$path.="/";		
		$tstr=$path.$g_pic_name;   
		copy($g_pic,$tstr);
		$retval = $g_pic_name;
		unlink($g_pic);
	}else
	{
		$retval = "neno";
	}
	
	return $retval;
}
?>
