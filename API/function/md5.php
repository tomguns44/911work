<?php
/*
Exp:
$abc ="aBcD中國人abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$a = encode($abc,'www.qh8.net',true);//加密
echo $a;
echo decode($a,'www.qh8.net',true);//解密
*/
    function encode($code,$seed = "qh8.net", $safe = false){
        if ($safe) $code = base64_encode(strrev(str_rot13($code))); 
        $c_l = strlen($code);
        $s_m = md5($seed);
        $s_l = strlen($m); 
        $a=0;
        while ($a <$c_l){
            $str .= sprintf ("%'02s",base_convert(ord($code{$a})+ord($s_m{$s_l % $a+1}),10,32));
            $a++;
        }
        return $str;//wordwrap($str, 80, "n", true)
    }
    
    
    function decode($code, $seed = 'qh8.net', $safe = false){
        //$code = preg_replace("'[ rnt]+'", '', $code);
        preg_match_all("/.{2}/", $code, $arr);
        $arr = $arr[0];
        $s_m = md5($seed);
        $s_l = strlen($m); 
        $a = 0;
        foreach ($arr as $value){
            $str .= chr(base_convert($value,32,10)-ord($s_m{$s_l % $a+1}));
            $a++;
        }
        if ($safe) $str = str_rot13(strrev(base64_decode($str)));
        return $str;
    }
?>