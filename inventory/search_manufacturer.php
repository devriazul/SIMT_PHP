<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select distinct mname from tbl_product where mname LIKE '$q%' order by id desc";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$mname = $rs['mname'];
	echo "$mname\n";
}

}else{
  header("Location:index.php");
}
}  
?>

