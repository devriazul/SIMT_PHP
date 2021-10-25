<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select coursecode,coursename from tbl_courses where coursecode LIKE '$q%' and storedstatus<>'D'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$filename = $rs['coursecode']."->".$rs['coursename'];
	echo "$filename\n";
}

}else{
  header("Location:login.php");
}
}  
?>

