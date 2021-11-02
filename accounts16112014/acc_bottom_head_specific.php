<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q=$_GET['q'];


$sql = "select accname from tbl_accchart where accname like '$q%'";
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

