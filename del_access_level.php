<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='system_access_level.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
	$id=mysql_real_escape_string($_GET['id']);
	$opdate=date("Y-m-d");
    $query="DELETE FROM tbl_access WHERE id='$id'";
	if($r=$myDb->update_sql($query)){
	   $t=1;
	   $msg="Data deleted successfully";
	   header("Location:system_access_level.php?msg=$msg&t=1");
	  
    }else{
	   $t=0;
	   $msg=$myDb->last_error;
	   header("Location:system_access_level.php?msg=$msg&t=0");
		
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