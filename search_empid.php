<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select sid from tbl_staffinfo where storedstatus<>'D' AND sid LIKE '$q%' order by id";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$sid = $rs['sid'];
	echo "$sid\n";
}

}else{
  header("Location:index.php");
}
}  
?>

