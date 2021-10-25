<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select coursename, coursecode from tbl_courses where storedstatus<>'D' AND coursename LIKE '$q%' order by id desc";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$coursename = $rs['coursename'].' ('.$rs['coursecode'].')';
	echo "$coursename\n";
}

}else{
  header("Location:login.html");
}
}  
?>

