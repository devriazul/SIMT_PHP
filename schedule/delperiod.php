<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_time_interval.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
   $id=mysql_real_escape_string($_GET['id']);
   $sdq=$myDb->select("select*from tbl_schedule_map where interval_fid='$id'");
   $sdqf=$myDb->get_row($sdq,'MYSQL_ASSOC');
   
   $sdq_t=$myDb->select("select*from tbl_schedule_map where interval_toid='$id'");
   $sdqf_t=$myDb->get_row($sdq_t,'MYSQL_ASSOC');
     if(!empty($sdqf['id'])||!empty($sdqf_t['id'])){
		  echo "<div style='width:500px; padding:5px; height:25px;background-color:#999999; color:#FFFFFF;font-size:13px;'>Child record found, you can not delete master record</div>";
		  
     }else{
	   if($myDb->update_sql("DELETE FROM tbl_time_interval WHERE id='$id'")){
		  echo "<div style='width:500px; padding:5px; height:25px;background-color:#999999; color:#FFFFFF;font-size:13px;'>Record successfully deleted</div>";
	   }else{
		  echo $myDb->last_error;
	   }
	 
	 }	   

 }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
 }	 

}else{
  header("Location:index.php");
}
}