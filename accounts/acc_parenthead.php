<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select accname from tbl_accchart where id in(select parentid from tbl_accchart) and parentid=0 and groupname=0 and accname like '$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$name = $rs['accname'];
	echo "$name\n";
}

}else{
  header("Location:login.php");
}
}  
?>

