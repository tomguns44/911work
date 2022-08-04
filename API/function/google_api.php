<?php
function shortenGoogleUrl($long_url){
 $apiKey = 'AIzaSyBBaxemddsrCdnBcgDiSMkXkjFKvqfAOhk'; //Get API key from : http://code.google.com/apis/console/
 $postData = array('longUrl' => $long_url, 'key' => $apiKey);
 $jsonData = json_encode($postData);
 $curlObj = curl_init();
 curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url');
 curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
 curl_setopt($curlObj, CURLOPT_HEADER, 0);
 curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
 curl_setopt($curlObj, CURLOPT_POST, 1);
 curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);
 $response = curl_exec($curlObj);
 curl_close($curlObj);
 $json = json_decode($response);
 return $json->id;
}

//echo shortenGoogleUrl("www.pking.com.tw/?factor=sotom");

function createfactorDir($tid)
{
	$id = $tid;
	$bpath = "/var/www/html/a.pking.com.tw";
	$xpath = $bpath."/".$id;
	$srcfile = $bpath."/temp.php";
	$desfile = $xpath."/index.php";
	//
	$r = false;
	if (mkdir($xpath))
	{
		copy($srcfile,$desfile);
		$r = true;
	}
	
	return $r;
}
?>