<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select * from tbl_accchart where id not IN(select parentid from tbl_accchart) amd groupname!=0 and accname like '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['accname'];
	echo "$cname\n";
}

}else{
  header("Location:login.php");
}
}  
?>

