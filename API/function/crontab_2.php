<?

include "function.php";

$s = "WHERE Players='rxboy001'";
$ms = ms_loaddata_row("tblGamerInfo",$s);
$ss = $ms['Chips'] + 3500;

$mssql = new phpMssql_h;
$mssql->init();
$sql = "UPDATE tblGamerInfo SET Chips='".$ss."' WHERE Players='rxboy001' ";
$mssql->query($sql);
unset($mssql);

?>