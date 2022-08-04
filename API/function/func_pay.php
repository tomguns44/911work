<?php
class pepay
{
    var $sys_trust="hXNeu0y4Vr";                  //pepay 系統信任碼
	var $shop_trust="PEep9wkoeW";                 //pepay 廠商信任碼
	var $shop_id="PPS_126557";                      //pepay 廠商代碼    
    var $currency="TWD";                           //幣別,預設為台幣
	var $pay_url="http://gate.pepay.com.tw/pepay/payselect_amt.php";  //金流網址
	var $pay_type="TY-ATM";         //預設消費類型
	var $sub_type="ST-WEB";	        //子消費類型啟用，無分類則不需傳此參數
	var $prod_id="PD-ATM-SCSB";     //如有指定金流代碼則會自動選擇該消費方式而跳過選擇頁面
	var $re_url="http://cashflow.pking.com.tw/pepay/returnurl.php";     //金流接回pk結果頁
	//var $shop_para="";            //廠商自定參數,可不用
	
	var $phone_reurl="http://cashflow.pking.com.tw/pepay/phone_pay01.php";  //接收phone回傳結果之網址
	var $phone_server_url = "http://gate.pepay.com.tw/pepay/paysys/otp_chk/pe_otp_chk.php";  //pepay otp檢查網址
	var $nLimitMinute=3;    //phone有效啟用時間，設0則為預設時間（5分），此為設定3分
	
    function create_atm_check($kind, $o_id, $money, $sess, $prod, $user, $ashop_id)
    {
        switch($kind)
        {
            case 1:
                $tmp=$this->sys_trust."#".$this->shop_id."#".$o_id."#".$money."#".$this->shop_trust;
                break;
                
            case 2:
                $tmp=$this->sys_trust."#".$ashop_id."#".$o_id."#".$money."#".$sess."#".$prod."#".$this->shop_trust;
                break;
                
            case 3:
                $tmp=$this->sys_trust."#".$ashop_id."#".$o_id."#".$money."#".$sess."#".$prod."#".$user."#".$this->shop_trust;
                break;
                
            case 4:
                $tmp=$this->sys_trust."#".$ashop_id."#".$user."#".$this->shop_trust;
                break;
        }
        
	    $check=md5($tmp);
	    return $check;
    }
    
    function create_phone_check($kind, $res, $o_id, $trigger, $otp1, $otp2, $call_id)
    {
        switch($kind)
        {
            case 1:
                $tmp=$this->sys_trust."#".$this->shop_id."#".$o_id."#".$trigger."#".$otp1."#".$otp2."#".$call_id."#".$this->phone_reurl."#".$this->shop_trust;
                break;
                
            case 2:
                $tmp=$this->sys_trust."#".$res."#".$this->shop_id."#".$o_id."#".$trigger."#".$otp1."#".$otp2."#".$call_id."#".$this->phone_reurl."#".$this->shop_trust;
                break;
        }
        
	    $check=md5($tmp);
	    return $check;
    }
    
    function get_item($item)
    {
        //先將商品名稱轉big5再urlencode
    	$name_5=iconv("UTF-8", "BIG5", $item);
    	$item_name=urlencode($name_5);
    	return $item_name;
    }
}

function write_file($filename,$newdata)
{
          $f=fopen($filename,"a+");
          fwrite($f,$newdata);
          fclose($f);  
}
?>