<?

$host_ver = isset($_SERVER['SERVER_NAME'])?$_SERVER['SERVER_NAME']:"0.0.0.0";
if ($host_ver=="127.0.0.1" || $host_ver=="sandbox.v888.bz")
{
	$is_test = true;
}else
{
	$is_test = false;
}

class phpMysql_h
{
	var $listmysql="";								
	var $sql="";
	var $linkmysql=0;								
	var $ip="192.168.0.6"; 
	var $db="pkhg_db";							
	var $user="v888";									
	var $password="smartocean367788";
	/*var $ip="localhost";
	var $db="pkhg_db";									
	var $user="root";						
	var $password="smartocean01357";*/
	
	function __destruct()
	{
		$this->close_mysql();
	}

	function link_mysql()							
	{
		global $is_test;
		if ($is_test)
		{
			$this->ip="localhost";//"smartocean";//--
			$this->user="root";//"smartocean";//--
			$this->password="smartocean01357";//"smartocean";//--
		}
		//echo $this->password;
		$this->linkmysql=@mysql_connect($this->ip,$this->user,$this->password);
		if (!$this->linkmysql)
		{
				//echo ("sorry for not allow intro cos system is busy and try again later<br>");
				echo "<script>location.href='fix/';</script>";
				exit;
		}
		$this->query("SET NAMES utf8");
		//mysql_query('SET NAMES utf8');
		//mysql_query('SET CHARACTER_SET_CLIENT=utf8');
		//mysql_query('SET CHARACTER_SET_RESULTS=utf8');
		//mysql_query('SET CHARACTER_SET_CONNECTION=utf8');
	}

	function select($table,$Field,$ISIF,$Sortx,$sortstr)
	{
		if ($Sortx=="0")
		{
			$this->sql = "SELECT ".$Field." FROM ".$table." WHERE ".$ISIF;
		}else if ($Sortx=="desc")
		{
			$this->sql = "SELECT ".$Field." FROM ".$table." WHERE ".$ISIF." ORDER BY ".$sortstr." DESC"; //....(asc->FFDN?p!Li?j,,descFFDN?j!Li?p)"
		}else if ($Sortx=="asc")
		{
			$this->sql = "SELECT ".$Field." FROM ".$table." WHERE ".$ISIF." ORDER BY ".$sortstr." ASC"; //....(asc->FFDN?p!Li?j,,descFFDN?j!Li?p)"
		}
		$this->query($this->sql);
	}

	function add($table,$Field,$valuex)
	{
		$this->sql = "INSERT INTO ".$table." (".$Field.")  VALUES  (".$valuex.")";
		$this->query($this->sql);
	}

	function close_mysql()
	{
		if ($this->linkmysql!="") @mysql_close($this->linkmysql);
	}

	function select_db()
	{
		//mysql_query($this->linkmysql, "SET CHARACTER SET utf8");
		//mysql_query($this->linkmysql, "SET NAMES 'utf8'");
		//mysql_query('SET NAMES utf8');
		//mysql_query('SET CHARACTER_SET_CLIENT=utf8');
		//mysql_query('SET CHARACTER_SET_RESULTS=utf8');
		//mysql_query('SET character_set_connection=utf8');

		$link_Isok=@mysql_select_db($this->db,$this->linkmysql);
		if (!$link_Isok)
		{
			mysql_close($this->linkmysql);
			exit;
		}
	}

	function init()
	{
		$this->link_mysql();
		$this->select_db();
	}

	function query($str)
	{
		$this->listmysql=mysql_query($str,$this->linkmysql); //echo $str;
		if (mysql_errno()!=0)
			echo mysql_errno().": ".mysql_error()."<BR>";
	}
}


function loaddata_row($table,$s="",$usetable="")  //
{
	$chkispowermsql = new phpMysql_h;
	if ($usetable!="") 
	{
		$chkispowermsql->db = $usetable;
	}
	//echo $chkispowermsql->db;
	$chkispowermsql->init();
	$sql = "SELECT * FROM ".$table." ".$s.";"; //echo $sql;
	$chkispowermsql->query($sql);
	$row=NULL;
	$row = mysql_fetch_array($chkispowermsql->listmysql);
	$chkispowermsql->close_mysql();
	unset($chkispowermsql);

	return $row;
}

function loaddata_array($table,$s="",$usetable="")  //
{
	$chkispowermsql = new phpMysql_h;
	if ($usetable!="") 
	{
		$chkispowermsql->db = $usetable;
	}
	$chkispowermsql->init();
	$sql = "SELECT * FROM ".$table." ".$s.";"; 
    $chkispowermsql->query($sql);
	$j=0;
	$r=NULL;
	while($row = mysql_fetch_array($chkispowermsql->listmysql))
	{
		  $r[$j] = $row;
		  $j++;
	}
	$chkispowermsql->close_mysql();
	unset($chkispowermsql);

	return $r;
}

function load_data($sql,$usetable="")
{
	$chkispowermsql = new phpMysql_h;
	if ($usetable!="") 
	{
		$chkispowermsql->db = $usetable;
	}
	$chkispowermsql->init();
	$chkispowermsql->query($sql);
	$j=0;
	$r=NULL;
	while($row = mysql_fetch_array($chkispowermsql->listmysql))
	{
		  $r[$j] = $row;
		  $j++;
	}
	$chkispowermsql->close_mysql();
	unset($chkispowermsql);

	return $r;
}

function sql_exe($sql,$usetable="")
{
	$chkispowermsql = new phpMysql_h;
	if ($usetable!="") 
	{
		$chkispowermsql->db = $usetable;
	}
	$chkispowermsql->init();
	$chkispowermsql->query($sql);
	$chkispowermsql->close_mysql();
	unset($chkispowermsql);
}

function loadCount($table,$s="",$usetable="")  //
{
	$chkispowermsql = new phpMysql_h;
	if ($usetable!="") 
	{
		$chkispowermsql->db = $usetable;
	}
	$chkispowermsql->init();
	$sql = "SELECT COUNT(*) FROM ".$table." ".$s;
	$chkispowermsql->query($sql);
	list($row) = mysql_fetch_row($chkispowermsql->listmysql);
	$chkispowermsql->close_mysql();
	unset($chkispowermsql);

	return $row;
}

function member_cash_vpoint($m,$point,$doaction)
{
	$srcpoint = $m['vpoint'];
	$n = loaddata_row("memberInfo","WHERE uuid='".$m['uuid']."' ");
	$sql = "INSERT INTO cash_log_v (memId,srcpoint,point,descpoint,createDate,doaction) VALUES ('".$m['uuid']."','".$srcpoint."','".$point."','".$n['vpoint']."',NOW(),'".$doaction."') "; //echo $sql;exit;
	sql_exe($sql);
}

?>