<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managecourseinformation.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['delt']=="y"){
  $id=mysql_real_escape_string($_GET['id']);
   $chkstd=" SELECT s.seat hseat,st.seat stseat
             FROM tbl_hostelseat s
             INNER  JOIN tbl_stdinfo st 
             ON s.id=st.hostelid
			 WHERE s.id='$id'

			 ";
			 
	$stds=$myDb->select($chkstd);
	$stdq=$myDb->get_row($stds,'MYSQL_ASSOC');

     if(($stdq['hseat']==$stdq['stseat'])&&($stdq['hseat']!="")&&($stdq['stseat']!="")){  
	
	   $msg="Intrigrity constant error,you can not delete master record,please delete details record first then delete master";
       header("Location:manage_hostelseat.html?msg=$msg");	
	}else{
  
	   $qup="UPDATE  tbl_hostelseat SET `storedstatus`='D' WHERE `id`='$id'";
	   if($myDb->update_sql($qup)){
	      $msg="Data deleted successfully";
          header("Location:manage_hostelseat.html?msg=$msg");
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