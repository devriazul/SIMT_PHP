<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select storename from tbl_store where storename LIKE '$q%' order by id desc";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$storename = $rs['storename'];
	echo "$storename\n";
}

}else{
  header("Location:index.php");
}
}  
?>

