<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
	$q = $_GET["q"];
	if (!$q) return;

$sql = "select empname from tbl_parttimeemployeesalary where storedstatus<>'D' AND empname LIKE '%$q%' order by id";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$code = $rs['empname'];
	echo "$code\n";
}

}else{
  header("Location:login.php");
}
}  
?>

