<?

function generatorPassword($plen)
{
	$password_len = $plen;
	$password = '';

	// remove o,0,1,l
	$word = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
	$len = strlen($word);

	for ($i = 0; $i < $password_len; $i++) {
		srand((double)microtime()*1000000); 
		$p = rand() % $len;
		$password .= $word[$p];
	}

	return $password;
}

function getCard()
{
	$xcode = array("0"=>0,"1"=>1,"2"=>2,"3"=>3,"4"=>4,"5"=>5,"6"=>6,"7"=>7,"8"=>8,"9"=>9,"a"=>0,"b"=>1,"c"=>2,"d"=>3,"e"=>4,"f"=>5);
	$last_code = array("0"=>"00","1"=>"01","2"=>"02","3"=>"03","4"=>"04","5"=>"05","6"=>"06","7"=>"07","8"=>"08","9"=>"09","a"=>"10","b"=>"11","c"=>"12","d"=>"13","e"=>"14","f"=>"15");
	$hash = uniqid(mt_srand((double)microtime() * 1000000));
	$p[0] = $xcode[substr($hash,0,1)] + $xcode[substr($hash,12,1)]; if (strlen($p[0])>=2) $p[0]=substr($p[0],0,1);
	$p[1] = $xcode[substr($hash,1,1)] + $xcode[substr($hash,11,1)]; if (strlen($p[1])>=2) $p[1]=substr($p[1],0,1);
	$p[2] = $xcode[substr($hash,2,1)] + $xcode[substr($hash,10,1)]; if (strlen($p[2])>=2) $p[2]=substr($p[2],0,1);
	$p[3] = $xcode[substr($hash,3,1)]; if (strlen($p[3])>=2) $p[3]=substr($p[3],0,1);
	$p[4] = $xcode[substr($hash,4,1)]; if (strlen($p[4])>=2) $p[4]=substr($p[4],0,1);
	$p[5] = $xcode[substr($hash,5,1)]; if (strlen($p[5])>=2) $p[5]=substr($p[5],0,1);
	$p[6] = $xcode[substr($hash,6,1)]; if (strlen($p[6])>=2) $p[6]=substr($p[6],0,1);
	$p[7] = $xcode[substr($hash,7,1)] + $xcode[substr($hash,10,1)]; if (strlen($p[7])>=2) $p[7]=substr($p[7],0,1);
	$p[8] = $xcode[substr($hash,8,1)] + $xcode[substr($hash,11,1)]; if (strlen($p[8])>=2) $p[8]=substr($p[8],0,1);
	$p[9] = $xcode[substr($hash,9,1)] + $xcode[substr($hash,12,1)]; if (strlen($p[9])>=2) $p[9]=substr($p[9],0,1);
	
	//-- 序號
	$seq="";
	for ($i=0;$i<10;$i++)
	{
		$seq.=$p[$i];
	}
	
	//-- 密碼
	$pasw = generatorPassword(16);
	
	$card['seq'] = $seq;
	$card['password'] = $pasw;
	
	return $card;
}

/*
$p = getCard();
echo $p['seq']."-".$p['password'];
*/
?>