<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
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

