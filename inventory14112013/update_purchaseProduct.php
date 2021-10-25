<?php ob_start();
session_start();
require_once('dbClass.php');
require_once('class/productfilter.class.php');
include("config.php"); 
$pft=new ProductFilter();
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $pqty=mysql_real_escape_string($_GET['pqty']);
  $pprice=mysql_real_escape_string($_GET['pprice']);
  $reqid=mysql_real_escape_string($_GET['reqid']);
  $id=mysql_real_escape_string($_GET['id']);
  $supid=mysql_real_escape_string($_GET['supid']);
  $storeid=mysql_real_escape_string($_GET['storeid']);
  $pdate=mysql_real_escape_string($_GET['pdate']);
  echo $pft->createPurchaseProduct($reqid,$id,$pqty,$pprice,$supid,$storeid,$pdate);
?>


<?php 
}else{
  header("Location:login.php");
}
}  
?>
