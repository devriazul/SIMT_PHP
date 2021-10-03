<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='system_access_level.php' AND userid='$_SESSION[userid]' and storedstatus<>'D'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
	$id=mysql_real_escape_string($_GET['id']);
	
	$qup="SELECT l.userid as luserid,ac.userid as acuserid from tbl_login l
	      LEFT JOIN tbl_accdtl ac
		  on l.userid=ac.userid
		  WHERE l.id='$id' and tbl_accdtl.storedstatus='D'";
	$qus=$myDb->select($qup);
	$lacc=$myDb->get_row($qus,'MYSQL_ASSOC');
	
	if($lacc['luserid']==$lacc['acuserid']){
	  $msg="Intrigrity constant error,master record found";
	  header("Location:manage_userinfo.php?msg=$msg");
	}else{        
	
	  $qup="UPDATE tbl_login SET storedstatus='D' WHERE `id`='$id'";
	  $upd=$myDb->update_sql($qup);
	  $msg="Data deleted successfully";
      header("Location:manage_userinfo.php?msg=$msg");
	}  
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}