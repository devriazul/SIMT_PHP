<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;
//$sql = "select accname from tbl_accchart where id not in(select parentid from tbl_accchart) and groupname!=0 and accname like '%$q%'";
$sql = "SELECT accname FROM tbl_accchart
   WHERE MATCH (accname)
   AGAINST ('$q' WITH QUERY EXPANSION)
   and id not in(select parentid from tbl_accchart) and groupname!=0";
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

