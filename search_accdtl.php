<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select distinct flname as filename from tbl_accdtl where flname LIKE '$q%' and storedstatus<>'D'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$filename = $rs['filename'];
	echo "$filename\n";
}

}else{
  header("Location:login.php");
}
}  
?>

