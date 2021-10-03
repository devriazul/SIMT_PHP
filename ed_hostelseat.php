<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
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
       $id=mysql_real_escape_string($_GET['id']);
	   $sq="UPDATE tbl_hostelseat SET `hostelid`='$hostelid',
	                                  `roomno`='$roomno',
	                                  `noofstudent`='$noofstudent',
									  `storedstatus`='U',
									  opby='$_SESSION[userid]'
								  WHERE id='$id'";
	   if($myDb->update_sql($sq)){
	      $msg="Data updated successfully";
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