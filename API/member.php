<?php
ini_set('display_errors',1);
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
if (!isset($_SESSION)) {
	session_start();
}
include_once dirname(__FILE__)."/function/db_mysql.php";

const API_KEY = "123987456";

$bodyMsg = file_get_contents('php://input');
$headers = apache_request_headers();
//print_r($_SERVER);
/*
Array
(
    [Host] => 127.0.0.1
    [Accept] => 
    [Content-Type] => application/json
    [Authorization] => Bearer 123123
    [Content-Length] => 7
)
*/
$params = json_decode($bodyMsg,true);

$method = isset($params['method'])?$params['method']:"-1";
//$ti = isset($params['ti'])?$params['method']:"-1";
//$md = isset($params['md'])?$params['md']:"-1";

switch ($method) {
case "get_access_token":
		$memId = isset($params['memId'])?$params['memId']:"-1";
		$passwd = isset($params['passwd'])?$params['passwd']:"-1";
		
		$m = loaddata_row("memberInfo"," WHERE memId='".$memId."' ");
		if ($m==NULL) {
			$result['Code'] = "Error";
			$result['msg'] = "User not exist";
		}else {
			$oauth = md5(uniqid(mt_srand((double)microtime() * 1000000)));
			$sql = "UPDATE memberInfo SET oauth='".$oauth."',oauthtime=NOW() WHERE uid='".$m['uid']."' ";
			sql_exe($sql);
			$result['Code'] = "Ok";
			$result['msg'] = "Success";
			$result['oauth'] = $oauth;
		}
		
case "get_account_balance":
		$oauth = isset($params['oauth'])?$params['oauth']:"-1";
		$m = loaddata_row("memberInfo"," WHERE oauth='".$oauth."' ");
		if ($m==NULL) {
			$result['Code'] = "Error";
			$result['msg'] = "oauth not exist";
		}else {
			$ntd = time();
			$std = strtotime($m['oauthtime']);
			$etd = $std + 3*24*60*60; //3天過期
			if ($ntd>$etd) {
				$result['Code'] = "Error";
				$result['msg'] = "oauth time is expired";
			}else {
				$result['Code'] = "Ok";
				$result['msg'] = "Success";
				$result['oauth'] = $m['vpoint'];
			}
		}
		break;
		
default:
		$result['Code'] = "Error";
		$result['msg'] = "method error";
		break;
}

echo json_encode($result);
?>