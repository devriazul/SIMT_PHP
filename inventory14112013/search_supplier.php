<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select sname from tbl_supplier where sname LIKE '%$q%' order by id desc";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$sname = $rs['sname'];
	echo "$sname\n";
}

}else{
  header("Location:index.php");
}
}  
?>

