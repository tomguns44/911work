<?
//ini_set("display_errors",1);
/*
* 实现AES加密
* $str : 要加密的字符串
* $keys : 加密密钥
* $iv : 加密向量
* $cipher_alg : 加密方式
*/
function ecryptdString($str,$keys="6461772803150152",$iv="8105547186756005",$cipher_alg=MCRYPT_RIJNDAEL_128){
    $iv = md5(md5($keys));
	$encrypted_string = bin2hex(mcrypt_encrypt($cipher_alg, $keys, $str, MCRYPT_MODE_CBC,$iv));
    return $encrypted_string;
}
/*
* 实现AES解密
* $str : 要解密的字符串
* $keys : 加密密钥
* $iv : 加密向量
* $cipher_alg : 加密方式
*/
function decryptString($str,$keys="6461772803150152",$iv="8105547186756005",$cipher_alg=MCRYPT_RIJNDAEL_128){
    $iv = md5(md5($keys));
	$decrypted_string = mcrypt_decrypt($cipher_alg, $keys, pack("H*",$str),MCRYPT_MODE_CBC, $iv);
    return $decrypted_string;
}

$a = "我是誰";
$b = ecryptdString($a);
echo $b."<br>";
$c = decryptString($b);
echo $c."<br>";
?>