<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select sum(pqty) totalPurchase,(select sum(iqty) from tbl_issue WHERE pid='$q') totalIssue from tbl_buyproduct where pid='$q'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$reqty = ($rs['totalPurchase']-$rs['totalIssue']);
	echo $reqty;
}

}else{
  header("Location:index.php");
}
}
