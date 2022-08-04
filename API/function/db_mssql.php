<?
class phpMssql_h
{
	var $listmssql="";								//3s￠Gg2!MeRARw|r|e
	var $sql="";
	var $linkmssql=0;								//3s!O￠Gg!MeRARwao￠FDN?X
	var $ip="203.129.81.235:3433";//"MyServer2k";//"203.129.81.235,3433";  							//cw!Mqmssqlao|i!!O}
	var $user="pokermaster";									//￠Ggn?Jmssqlao!LI￠FDIaI				****
	var $password="dezhpuke998";				//￠Ggn?Jmssql!LI￠FDIaIao!OK?X		****
	var $db="dbPoker";									//!MeRARw
	
	function link_mssql()							//?Pmssql3s?u
	{
		$this->linkmssql=mssql_pconnect($this->ip,$this->user,$this->password);
		if (!$this->linkmssql)
		{
				echo ("MsSQL系統忙錄中，請稍後再試..."); 
				exit;  
		}
	}
	
	function select($table,$Field,$ISIF,$Sortx,$sortstr)
	{
		if ($Sortx=="0")
		{
			$this->sql = "SELECT ".$Field." FROM ".$table." WHERE ".$ISIF;
		}else if ($Sortx=="desc")
		{
			$this->sql = "SELECT ".$Field." FROM ".$table." WHERE ".$ISIF." ORDER BY ".$sortstr." DESC"; //....(asc->￠FDN?p!Li?j,,desc￠FDN?j!Li?p)"
		}else if ($Sortx=="asc")
		{
			$this->sql = "SELECT ".$Field." FROM ".$table." WHERE ".$ISIF." ORDER BY ".$sortstr." ASC"; //....(asc->￠FDN?p!Li?j,,desc￠FDN?j!Li?p)"
		}
		$this->query($this->sql);
	}
	
	function add($table,$Field,$valuex)
	{
		$this->sql = "INSERT INTO ".$table." (".$Field.")  VALUES  (".$valuex.")";
		$this->query($this->sql);
	}
	
	function close_mssql()
	{
		mssql_close($this->linkmssql);
	}
	
	function select_db()
	{
		$link_Isok=@mssql_select_db($this->db,$this->linkmssql);
		if (!$link_Isok) 
		{
			echo ("資料庫連結失敗，可能是系統忙錄中，請稍後再試...");   
			mssql_close($this->linkmssql);
			exit;
		}
	}
	
	function init()
	{
		$this->link_mssql();
		$this->select_db();
	}
	
	function query($str)
	{
		$this->listmssql=mssql_query($str,$this->linkmssql);
	}
}

function ms_loaddata_row($table,$s="")  //
{
	$chkispowermsql = new phpMssql_h;
	$chkispowermsql->init();
	$sql = "SELECT * FROM ".$table." ".$s.";";
	$chkispowermsql->query($sql);
	$row=NULL;
	$row = mssql_fetch_array($chkispowermsql->listmssql);
	$chkispowermsql->close_mssql();
	unset($chkispowermsql);

	return $row;
}

function ms_loaddata_array($table,$s="",$orderid="",$start=0,$offset=10)  //
{
	$chkispowermsql = new phpMssql_h;
	$chkispowermsql->init();
	//$sql = "set names 'utf8' ";
	//$chkispowermsql->query($sql);
	if ($orderid=="")
	{
		$sql = "SELECT * FROM ".$table." ".$s." "; //echo $sql;
	}else
	{
		$topoffset = $offset + $offset*$start;
		$sql = "SELECT * FROM ( SELECT TOP ".$offset." * FROM ( SELECT TOP ".$topoffset." * FROM ".$table." ORDER BY ".$orderid." DESC ) AS t1 ) AS derivedtbl_1 ".$s." ORDER BY ".$orderid." DESC "; //echo $sql;
	}
	$chkispowermsql->query($sql);
	$j=0;
	$r=NULL;
	while($row = mssql_fetch_array($chkispowermsql->listmssql))
	{
		  $r[$j] = $row; //echo $row['id'];
		  $j++;
	}
	$chkispowermsql->close_mssql();
	unset($chkispowermsql);

	return $r;
}

/*
select * from ( select top offset * from(select top (offset + offset * start) * from [TableName] order by FieldName ) TableAlias order by FieldName desc
*/
function ms_load_data($sql)
{
	$chkispowermsql = new phpMssql_h;
	$chkispowermsql->init();
	$chkispowermsql->query($sql);
	$j=0;
	$r=NULL;
	while($row = mssql_fetch_array($chkispowermsql->listmssql))
	{
		  $r[$j] = $row;
		  $j++;
	}
	$chkispowermsql->close_mssql();
	unset($chkispowermsql);

	return $r;
}
?>