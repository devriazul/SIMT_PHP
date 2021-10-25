<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select coursename from tbl_courses where storedstatus<>'D' AND coursename LIKE '$q%' order by id";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$code = $rs['coursename'];
	echo "$code\n";
}

}else{
  header("Location:index.php");
}
}  
?>

