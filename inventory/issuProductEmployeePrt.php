<?php ob_start();
session_start();
require_once('dbClass.php');
require_once 'class/productfilter.class.php';
include("config.php"); 
$pft=new ProductFilter();
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='product_list.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
    $empid=mysql_real_escape_string($_GET['empid']);
	$issuedate=mysql_real_escape_string($_GET['issuedate']);


?>
<style type="text/css">
@import url("main.css");
</style>
<div align="center">
<h2>SAIC GROUP OF INSTITUTIONS<br />
<h4>House-1,Road-2,Block-B,Section-6</h4>
<h4>Mirpur,Dhaka-1216</h4>
Product List Report<br />

</h2>
</div>
<?php 
  
	 $pft->issueEmployeePrd($empid,$issuedate);
  
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>