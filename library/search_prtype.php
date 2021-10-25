<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select distinct pname from tbl_product where pname LIKE '$q%' and prtype='Library Book' order by id desc";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$pname = $rs['pname'];
	echo "$pname\n";
}

}else{
  header("Location:index.php");
}
} 