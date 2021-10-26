<?php 
ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;


$sql = "select ifnull(sum(pqty),0) totalPurchase, (select ifnull(sum(iqty),0) from tbl_issue WHERE pid='$q') totalIssue from tbl_buyproduct where pid='$q' and pstatus='P'";
$rsd = mysql_query($sql);

$sqlp = "select ifnull(sum(pqty*pprice),0) totalPurchasePrice, (select ifnull(sum(iqty*iprice),0) from tbl_issue WHERE pid='$q') totalIssuePrice from tbl_buyproduct where pid='$q'";
$rsdp = mysql_query($sqlp);
$rsp = mysql_fetch_array($rsdp);

while($rs = mysql_fetch_array($rsd)) {
	$reqtyprice = ($rsp['totalPurchasePrice']-$rsp['totalIssuePrice']);
	$reqty = ($rs['totalPurchase']-$rs['totalIssue']);
	$favgprice =  round($reqtyprice/$reqty);
	//$opqtyprice = round($rsd['OpBal'] * $fprice,2);
	//$avgprice = $reqtyprice +  $opqtyprice;
	//$avgqty = $reqty + $rsd['OpBal'];
	//$favgprice = round($avgprice/$avgqty,2);

	echo $favgprice;
}

}else{
  header("Location:index.php");
}
}
