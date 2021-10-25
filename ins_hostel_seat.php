<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){ 
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='hostelname.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
    $hostelid=mysql_real_escape_string($_POST['hostelid']);
	$roomno=mysql_real_escape_string($_POST['roomno']);
	$noofstudent=mysql_real_escape_string($_POST['noofstudent']);
    //$price=mysql_real_escape_string($_POST['price']);
	$opdate=date("Y-m-d");
    
	   $sq="INSERT INTO tbl_hostelseat(`hostelid`,`roomno`,`noofstudent`,opby,opdate,storedstatus)values('$hostelid','$roomno','$noofstudent','$_SESSION[userid]','$opdate','I')";
	   if($myDb->insert_sql($sq)){
	      $msg="Data inserted successfully";
	      echo $msg;
	   }else{
	      $msg=$myDb->last_error;
		  echo $msg;
	   }	  
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 
	//header("Location:add_hostelname.html?msg=$msg");
}else{
  header("Location:index.php");
}
}