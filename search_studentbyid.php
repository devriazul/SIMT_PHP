<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "SELECT DISTINCT stdid 'SID' FROM  `tbl_stdinfo`  WHERE storedstatus <>  'D' and stdid<>'' and stdname like '$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$code = $rs['SID'];
	echo "$code\n";
}

}else{
  header("Location:index.php");
}
}  
?>

