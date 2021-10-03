<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select userid as userid,emailid from tbl_login where userid LIKE '$q%' and storedstatus<>'D'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$userid = $rs['userid'];
	echo "$userid\n";
}

}else{
  header("Location:login.php");
}
}  
?>

