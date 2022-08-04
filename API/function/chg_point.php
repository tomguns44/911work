<?

function chg_point($memID,$less_point,$less_action_point,$tag,$kind,$action_kind)
{
    global $bouns_id;
    if($memID == "" || $action_kind == "")
    {
        return "false";
        exit;
    }
    
    switch($kind)
    {
        case "0":
            if($less_point <= 0)
            {
                return "false";
                exit;
            }
            break;
        case "1":
            if($less_action_point <= 0)
            {
                return "false";
                exit;
            }
            break;
    }
    
    //$tag = ($tag == "") ? "race" : $tag;
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    
    $auth = new Auth();
    $str = "point";
    $str2 = "point";
    $str3 = "point";
    $str4 = "";
    $str5 = "lastpoint";
    if($kind != 0)
    {
        $less_point = $less_action_point;
        $str = "action";
        $str2 = "Action_Point";
        $str3 = "Action_point";
        $str4 = "2";
        $str5 = "lastactionpoint";
    }
    
    if($less_point <= 0)
    {
        return "fail-less_point";
        //$_SESSION["err"] = "兌換失敗!! 您的商品金額錯誤!!";
    }
    else
    {
		//查詢點數
		$result = $auth->Balance($memID,$str3);
		if ($result[":error_code"]=="OK")
		{
			$sum_point = $result[":balance"];
			// 遊戲中點數
			/*$result_ex = $auth->BalanceEx($memID,"point tw");
			$vvv=0;
			if ($result_ex[":error_code"]=="OK") $vvv = $result_ex[":amount"];
			$sum_point = $sum_point + $vvv;*/
			//
			//解凍大作戰
            /*$s = " WHERE isout='N' AND memId='".$memID."' ";
        	$check_1888 = loadcount("memberInfo_outgame",$s);
        	if ($check_1888 > 0)
        	{
        		$s = " WHERE memId='".$memID."' ORDER BY runDate DESC LIMIT 1 ";
        		$t_member = loaddata_row("memberInfo_outgame",$s);
        		if ($t_member != NULL)
        		{
        			$plastactionpoint = ceil($sum_point-$t_member[$str5]);
        			$sum_point = $plastactionpoint;
        		}
        	}*/
        	
			//扣點前記錄
			$msql = new phpMysql_h;
            $msql->init();
			$sql = "INSERT INTO `chg_point_log` (`memId` ,`before_".$str."`,less_date".$str4.",action_kind ) VALUES ('".$memID."', '".$sum_point."',now(),'".$action_kind."');";
			$msql->query($sql);
			$chg_uid = mysql_insert_id($msql->linkmysql);
			
			//echo $sum_point.":".$less_point;exit;
            
			if ($sum_point<$less_point)
			{
				//$_SESSION["err"] = "兌換失敗!! 您的點數不足!!";
				return "fail-user_point";
			}else
			{
    	            //取出點數
    				$buyPoints = $less_point; //金額        
    				$verifyCode = uniqid(mt_srand( (double)microtime() * 1000000));//訂單編號
    				$result = $auth->Withdraw($memID,(float)$buyPoints,$str2,$verifyCode);
    				//扣點後記錄
    				$vmsg = $result[":error_code"];
    				$msql_d = new phpMysql_h;
            		$msql_d->init();
        			$sql = "update `chg_point_log` set `less_".$str."`='".$buyPoints."',`error_code".$str4."`='".$vmsg."' where memId='".$memID."' and uid='".$chg_uid."'";
        			$msql_d->query($sql);
            		if($kind == 0)
                    {
                		$sql = "INSERT INTO Deposit_log (memId,price,createDate,error_code,web) VALUES ('".$memID."','".$buyPoints."',NOW(),'".$vmsg."','pking-hand') ";
                		$msql_d->query($sql);
                    }
            		unset($msql_d);
            		
    				if ($result[":error_code"]=="Accepted")
    				{
    					$result = $auth->Balance($memID,$str3);
						// 遊戲中點數
						$result_ex = $auth->BalanceEx($memID,"point tw");
						$vvv=0;
						if ($result_ex[":error_code"]=="OK") $vvv = $result_ex[":amount"];
						$result[":balance"] = $result[":balance"] + $vvv;
						//
    					$mem_tmp = loaddata_row("memberInfo", " where memId='".$memID."'");
    					
    					$msql = new phpMysql_h;
                        $msql->init();
                        if($kind == 0)
                        {
                            $fund_out_hash = uniqid(mt_srand((double)microtime() * 1000000));
                            $fund_in_hash = uniqid(mt_srand((double)microtime() * 1000000));
                            $sql = "INSERT INTO turnover (src_memId,des_memId,fund_out_hash,fund_in_hash,point,chkpoint,createDate,status,createIP) VALUES ('".$mem_tmp["uuid"]."','12195','".$fund_out_hash."','".$fund_in_hash."','".$buyPoints."','0',NOW(),'O','".$ipAddress."')  ";
                            $msql->query($sql);
                            $bouns_id = mysql_insert_id($msql->linkmysql);
                            $sql = "INSERT INTO turnover (src_memId,des_memId,fund_out_hash,fund_in_hash,point,chkpoint,createDate,status,createIP) VALUES ('12195','".$mem_tmp["uuid"]."','".$fund_out_hash."','".$fund_in_hash."','".$buyPoints."','0',NOW(),'I','".$ipAddress."') ";
                            $msql->query($sql);
                        }
                        else if($kind == 1)
                        {
                            $sql = "INSERT INTO `memberInfo_getbouns` (`memId`, `action_point`, `point`, `pro_name`, `createDate`, `ip`) VALUES ('".$memID."', '".$buyPoints."', '0', 'chg_".$tag."', NOW(), '".$ipAddress."') ";
			                $msql->query($sql);
			                $bouns_id = mysql_insert_id($msql->linkmysql);
                        }
                        //扣除後點數查詢
                        $sql = "update `chg_point_log` set `after_".$str."`='".$result[":balance"]."' where memId='".$memID."' and uid='".$chg_uid."'";
            			$msql->query($sql);
                        unset($msql);
                          
                        return "succ";                              
    					//$_SESSION["err"] = "已為您登記賽事!!!";
    				}else
    				{
    					return "fail-".$result[":error_code"];
    					//$_SESSION["err"] = "兌換失敗!!系統可能忙錄中!!請稍後再試!!!";
    				}
			}
		}
		else
		{
			return "fail-".$result[":error_code"];
			//$_SESSION["err"] = "兌換失敗!!系統可能忙錄中!!請稍後再試!!!";
		}
    }
}
?>