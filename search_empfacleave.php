<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "SELECT empid 
		FROM tbl_leaveapplication
		WHERE empid LIKE '$q%'
		AND storedstatus<>'D'
	   ";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$sid = $rs['empid'];
	echo "$sid\n";
}

}else{
  header("Location:index.php");
}
}  
?>

