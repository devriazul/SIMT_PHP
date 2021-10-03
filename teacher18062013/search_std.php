<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select stdid as stdid from tbl_stdinfo where stdid LIKE '%$q%' and storedstatus<>'D'";
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

