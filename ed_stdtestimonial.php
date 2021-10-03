<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managestdtestimonial.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
	$slno=mysql_real_escape_string($_POST['sn']);
	$examyear=mysql_real_escape_string($_POST['syear']);
	$stdid=mysql_real_escape_string($_POST['stdid']);
	$stdname=mysql_real_escape_string($_POST['stdname']);
	$fname=mysql_real_escape_string($_POST['fname']);
	$mname=mysql_real_escape_string($_POST['mname']);
	$department=mysql_real_escape_string($_POST['department']);
	$session=mysql_real_escape_string($_POST['session']);
	$rollno=mysql_real_escape_string($_POST['rollno']);
	$regino=mysql_real_escape_string($_POST['regino']);
	$cgpa=mysql_real_escape_string($_POST['cgpa']);
	$dob=mysql_real_escape_string($_POST['dob']);
	$writtenby=mysql_real_escape_string($_POST['writtenby']);
	$opdate=date("Y-m-d");

	$id=mysql_real_escape_string($_GET['id']);

	$qup="UPDATE tbl_stdtestimonial SET `slno`='$slno',`examyear`='$examyear',`stdid`='$stdid',`stdname`='$stdname',`fname`='$fname',`mname`='$mname',`department`='$department',`session`='$session',`rollno`='$rollno', `regino`='$regino' , `cgpa`='$cgpa', `dob`='$dob', `writtenby`='$writtenby', `opby`='$_SESSION[userid]', `opdate`='$opdate' ,`storedstatus`='U'	WHERE `id`='$id'";
	if($myDb->update_sql($qup)){
	   $msg="Data updated successfully";
	   header("Location:managestdtestimonial.php?msg=$msg");

	}else{
	   $msg=$myDb->last_error;
	   header("Location:managestdtestimonial.php?msg=$msg");
	}      
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}