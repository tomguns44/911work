
<?
    $login_wsdl = "http://tw.every8d.com/API20/Security.asmx?wsdl";
    $sms_wsdl = "http://tw.every8d.com/API20/Message.asmx?wsdl";
    
    $custID ="av8d20";   //�Фŧ��
    $userID="28041376";  //�z��EVERY8D�b�� 
    $password="ZKBABS"; //�z��EVERY8D�K�X
    $client = new SoapClient($login_wsdl);
    // login
    $params = array("custID"=>$custID,"userID"=>$userID,"password"=>$password,"APIType"=>"","version"=>""); 
    $objResult =$client->Login($params);
    $xmlstr= $objResult->LoginResult;
    
    $xml = new SimpleXMLElement($xmlstr);
    
    if($xml->ERROR_CODE =="0000"){
    	
    	echo "Login successfully<br/>";
    }else{
    	echo "Login Failure!<br/>";
    	exit;
    }
    
    // send sms
    
    $UserNo = $xml->USER_NO;      //�q�n�J���G���oUserNo
    $CompanyNo = $xml->COMPANY_NO; //�q�n�J���G���oCompany_No
    $Credit = $xml->CREDIT;        //�q�n�J���G���o�ثe�Ѿl�B��
    $subject = "test";   //�o�e�D��
    $content = "hello";  //�o�e���e
    
    $mobile = "0929514349"; //�o�e���X
    $email = "";  //�o�eemail��m
    $sendTime= "";  //�o�e�ɶ�
    
    $sms_xml =	'<REPS>';
    $sms_xml .=		'<IP></IP>';
    $sms_xml .=		'<CARD_NO/>';
    $sms_xml .=		'<USER NAME="" MOBILE="'.$mobile.'" EMAIL="'.$email.'" SENDTIME="'.$sendTime.'" PARAM=""/>';
    $sms_xml .=	'</REPS>';


    
    $params_sms = array("custID"=>$custID,
    			"CompanyNo"=>$CompanyNo,
    			"userNo"=>$UserNo,
    			"sendtype"=>"110",
    			"msgCategory"=>"10",
    			"subject"=>$subject,
    			"content"=>$content,
    			"image"=>"",
    			"Audio"=>"",
    			"xml"=>$sms_xml,
    			"batchID"=>"",
    			"certified"=>"");
    
    $sms_Service = new SoapClient($sms_wsdl);		
    $sendResult = $sms_Service->QueueIn($params_sms);
    $sendResultStr = $sendResult->QueueInResult;
    if( substr($sendResultStr,0,1) =="-"){
        echo "Send SMS Failure!<br/>";	
    }else{
    	echo "Send SMS Successfully<br/>";
    }
    
    
    
?>