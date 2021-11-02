<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_batch.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['delt']=="y"){	
  
    $id=mysql_real_escape_string($_GET['id']);
	if($myDb->update_sql("DELETE FROM tbl_batch WHERE id='$id'")){
	   $msg="Batch delete successfully";
	   echo $msg;
	   header("Location:manage_batch.php?msg=$msg");
	}else{
	
	   echo $myDb->last_error;
	
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
  