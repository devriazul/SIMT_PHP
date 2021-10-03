<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select id,name from tbl_department where name like '$q%'  and storedstatus<>'D' order by id desc";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$name = $rs['id']."->".$rs['name'];
	echo "$name\n";
}

}else{
  header("Location:index.php");
}
}