<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select * from tbl_accchart where id NOT IN(select parentid from tbl_accchart)";
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

