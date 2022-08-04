<?
$toppoker_cardType = array("♠A","♠2","♠3","♠4","♠5","♠6","♠7","♠8","♠9","♠10","♠J","♠Q","♠K",
						   "♥A","♥2","♥3","♥4","♥5","♥6","♥7","♥8","♥9","♥10","♥J","♥Q","♥K",
						   "♣A","♣2","♣3","♣4","♣5","♣6","♣7","♣8","♣9","♣10","♣J","♣Q","♣K",
						   "♦A","♦2","♦3","♦4","♦5","♦6","♦7","♦8","♦9","♦10","♦J","♦Q","♦K");

$toppoker_cardType_pic = array("sa","s2","s3","s4","s5","s6","s7","s8","s9","st","sj","sq","sk",
						       "ha","h2","h3","h4","h5","h6","h7","h8","h9","ht","hj","hq","hk",
						       "ca","c2","c3","c4","c5","c6","c7","c8","c9","ct","cj","cq","ck",
						       "da","d2","d3","d4","d5","d6","d7","d8","d9","dt","dj","dq","dk");

$toppoker_back_pic = "back";
$toppoker_box_pic = "bg_card-book";

function reslut_card_array($str)
{
	global $toppoker_cardType_pic;
	$r_a = array();
	$a_card = explode(";",$str);
	for ($i=0;$i<52;$i++)
	{
		$b_card = explode(",",$a_card[$i]);
		$r_a[$i]['card'] = $b_card[0];
		$r_a[$i]['sum'] = $b_card[1];
		if ($r_a[$i]['sum']==0)
		{
			$r_a[$i]['pic'] = "images/goldcard/bg_card-book.jpg";
		}else
		{
			$pic = $toppoker_cardType_pic[$b_card[0]]; //echo $b_card[0];
			$r_a[$i]['pic'] = "images/goldcard/".$pic.".jpg";
		}
	}
	
	return $r_a;
}

function reslut_carded_array($card_a)
{
	$bb = array();
	$j = 0;
	for ($i=0;$i<52;$i++)
	{
		if ($card_a[$i]['sum']>0)
		{
			$bb[$j] = $card_a[$i];
			$j++;
		}
	}
	
	return $bb;
}

function impcard_str($card_a)
{
	$bb = array();
	for ($i=0;$i<52;$i++)
	{
		$aa = $card_a[$i]['card'].",".$card_a[$i]['sum'];
		array_push($bb,$aa);
	}
	$card = implode(";",$bb);
	
	return $card;
}

function checkcardsum($card_a)
{
	$cs = 0;
	for ($i=0;$i<52;$i++)
	{
		$cs+=$card_a[$i]['sum'];
	}
	
	return $cs;
}
?>