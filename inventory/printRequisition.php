<?php ob_start();
session_start();
require_once('dbClass.php');
require_once('class/productfilter.class.php');
include("config.php"); 
$pft=new productfilter();
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_requesition.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  $pft->showRequisitionProduct($_GET['reqid'])
?>
<style type="text/css">
@import url("main.css");
</style>
<div align="center">
<h2>SAIC GROUP OF INSTITUTIONS<br />
<h4>House-1,Road-2,Block-B,Section-6</h4>
<h4>Mirpur,Dhaka-1216</h4>
<?php if($pft->status=="R"){ ?>
Requisition Report
<?php }else if($pft->status=="A"){ ?>
Requisition Approved Report
<?php }else if($pft->status=="P"){?>
Purchase Report
<?php } ?>
</h2>
</div>
<?php   
     $reqid=mysql_real_escape_string($_GET['reqid']);
		 echo $pft->printRequisition($reqid);
  
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>