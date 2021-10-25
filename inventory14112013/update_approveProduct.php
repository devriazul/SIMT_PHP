<?php ob_start();
session_start();
require_once('dbClass.php');
require_once('class/productfilter.class.php');
include("config.php"); 
$pft=new ProductFilter();
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $aqty=mysql_real_escape_string($_GET['aqty']);
  $appdate=mysql_real_escape_string($_GET['appdate']);
  $reqid=mysql_real_escape_string($_GET['reqid']);
  $id=mysql_real_escape_string($_GET['id']);
  echo $pft->createApproveProduct($reqid,$id,$appdate,$aqty);
?>


<?php 
}else{
  header("Location:login.php");
}
}  
?>
