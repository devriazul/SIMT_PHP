<?php ob_start();
session_start();
require_once('dbClass.php');
require_once('class/productfilter.class.php');
include("config.php"); 
$pft=new ProductFilter();
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $pqty=mysql_real_escape_string($_GET['pqty']);
  $pprice=mysql_real_escape_string($_GET['pprice']);
  $reqid=mysql_real_escape_string($_GET['reqid']);
  $id=mysql_real_escape_string($_GET['id']);
  echo $pft->createPurchaseProduct($reqid,$id,$pqty,$pprice);
?>


<?php 
}else{
  header("Location:login.php");
}
}  
?>
