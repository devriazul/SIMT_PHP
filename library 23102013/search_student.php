<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select stdid,stdname from tbl_stdinfo where storedstatus<>'D' AND stdid LIKE '%$q%' OR exstid LIKE '%$q%' order by id desc";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$stdid = $rs['stdid'];
	echo "$stdid\n";
}

}else{
  header("Location:index.php");
}
}  
?>

