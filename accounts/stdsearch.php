<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select stdid as stdid from tbl_stdinfo where stdid LIKE '%$q%' and storedstatus<>'D'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['stdid'];
	echo "$cname\n";
}

}else{
  header("Location:login.php");
}
}  
?>