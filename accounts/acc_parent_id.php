<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = !empty($_GET["accname"])?mysql_real_escape_string($_GET['accname']):'';
$q=urlencode($q);
$q=str_replace("+"," ",$q);

$sql = "select id from tbl_accchart where parentid=0 and groupname=0 and accname ='$q'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$name = $rs['id'];
	echo $name;
}

}else{
  header("Location:login.php");
}
}  
?>

