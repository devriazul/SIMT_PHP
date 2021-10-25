<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_supplier.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['delt']=="y"){
  $id=mysql_real_escape_string($_GET['id']);
   $chkstd=" SELECT s.id supid,pb.sid bsupid
             FROM tbl_supplier s
             INNER  JOIN tbl_buyproduct pb 
             ON s.id=pb.sid
			 WHERE s.id='$id'

			 ";
			 
	$stds=$myDb->select($chkstd);
	$stdq=$myDb->get_row($stds,'MYSQL_ASSOC');

     if(($stdq['hseat']==$stdq['stseat'])&&($stdq['hseat']!="")&&($stdq['stseat']!="")){  
	
	   $msg="Intrigrity constant error,you can not delete master record,please delete details record first then delete master";
       header("Location:supplier_list.php?msg=$msg");	
	}else{
  
	   $qup="delete from tbl_supplier WHERE `id`='$id'";
	   if($myDb->update_sql($qup)){
	      $msg="Data deleted successfully";
          header("Location:supplier_list.php?msg=$msg");
	   }else{
	      $msg=$myDb->last_error;
		  echo $msg;
	   }	  	  	
	}   
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>