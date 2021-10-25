<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select facultyid from tbl_faculty where storedstatus<>'D' AND facultyid LIKE '$q%' order by id";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$facultyid = $rs['facultyid'];
	echo "$facultyid\n";
}

}else{
  header("Location:login.php");
}
}  
?>

