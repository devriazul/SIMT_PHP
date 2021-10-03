<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select name from tbl_hostel where storedstatus<>'D' AND name LIKE '$q%' order by id";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$code = $rs['name'];
	echo "$code\n";
}

}else{
  header("Location:index.php");
}
}