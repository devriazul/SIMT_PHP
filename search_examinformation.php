<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select distinct examtype from tbl_examinitionsettings where storedstatus<>'D' AND examtype LIKE '$q%' order by id";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$code = $rs['examtype'];
	echo "$code\n";
}

}else{
  header("Location:index.php");
}
}
