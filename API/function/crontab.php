<?

include "function.php";

$mssql = new phpMssql_h;
$mssql->init();
$sql = "UPDATE tblGamerInfo SET Chips='3000' WHERE Chips<3000 ";
$mssql->query($sql);
unset($mssql);

$msql = new phpMysql_h;
$msql->init();
$sql = "INSERT INTO sdb_admin_sendlog (datex) VALUES (NOW()) ";
$msql->query($sql);
unset($msql);
?>