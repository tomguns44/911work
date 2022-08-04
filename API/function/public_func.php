<?php

function get_start_day($tmp_day, $num)  //num:0 本週1~本周6,num:6 上週6~本周5
{
	$less_day = sday_no(date("w", strtotime($tmp_day)), chg_day($num));
	$tmp = split("-", $tmp_day);
	$result = date("Y/m/d H:i:s", mktime(0 , 0, 0, $tmp[1], $tmp[2]-$less_day, $tmp[0]));
	return $result;
}

function get_end_day($tmp_day, $num)
{
	$less_day = eday_no(date("w", strtotime($tmp_day)), chg_day($num));
	$tmp = split("-", $tmp_day);
	$result = date("Y/m/d H:i:s", mktime(23 , 59, 59, $tmp[1], $tmp[2]+$less_day, $tmp[0]));
	return $result;
}

function chg_day($no)
{
    switch($no)
    {
        case "0": $result = "0,0"; break;   //本週1~本周6
        case "1": $result = "0,-1"; break;   //本週1~本周日
        case "5": $result = "3,2"; break;   //上週5~本周4
        case "6": $result = "2,1"; break;   //上週6~本周5
        case "8": $result = "-8,1"; break;   //下週2~本周5
        case "9": $result = "-4,-5"; break;   //周日顯示:上週5~本周4
    }
    return $result;
}

function get_one_day($tmp_day, $chg)
{
    $less_day = oday_no(date("w", strtotime($tmp_day)), $chg);
	$tmp = split("-", $tmp_day);
	$result = date("Y/m/d H:i:s", mktime(0 , 0, 0, $tmp[1], $tmp[2]-$less_day, $tmp[0]));
	return $result;
}

function oday_no($no,$chg)
{
    switch($no)
    {
        case "1": $result = "0"; break;
		case "2": $result = "1"; break;
		case "3": $result = "2"; break;
		case "4": $result = "3"; break;
		case "5": $result = "4"; break;
		case "6": $result = "5"; break;
		case "0": $result = "6"; break;
    }
    
    $result += $chg;
    return $result;
}

function sday_no($no,$chg)
{
    $tmp = split(",", $chg);
    switch($no)
    {
        case "1": $result = "0"; break;
		case "2": $result = "1"; break;
		case "3": $result = "2"; break;
		case "4": $result = "3"; break;
		case "5": $result = "4"; break;
		case "6": $result = "5"; break;
		case "0": $result = "6"; break;
    }
    
    $result += $tmp[0];
    return $result;
}

function eday_no($no,$chg)
{
    $tmp = split(",", $chg);
    switch($no)
    {
        case "1": $result = "5"; break;
		case "2": $result = "4"; break;
		case "3": $result = "3"; break;
		case "4": $result = "2"; break;
		case "5": $result = "1"; break;
		case "6": $result = "0"; break;
		case "0": $result = "-1"; break;
    }
    $result -= $tmp[1];
    return $result;
}

?>
