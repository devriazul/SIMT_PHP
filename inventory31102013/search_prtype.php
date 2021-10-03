<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select distinct prtype from tbl_product where prtype LIKE '$q%' order by id desc";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$prtype = $rs['prtype'];
	echo "$prtype\n";
}

}else{
  header("Location:index.php");
}
}  
?>

