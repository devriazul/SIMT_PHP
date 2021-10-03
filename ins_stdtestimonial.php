<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){ 

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

    $query="INSERT INTO `tbl_stdtestimonial` (`slno`, `examyear`, `stdid`, `stdname`, `fname`, `mname`, `department`, `session`, `rollno`, `regino`, `cgpa`, `dob`, `writtenby`, `opby`, `opdate`, `storedstatus`) VALUES ('$slno', '$examyear', '$stdid', '$stdname', '$fname', '$mname', '$department', '$session', '$rollno', '$regino', '$cgpa', '$dob', '$writtenby',  '$_SESSION[userid]','$opdate','I')";
	
	if($myDb->insert_sql($query)){
	
	   $msg="Data inserted successfully";
   		header("Location:add_stdtestimonial.php?msg=$msg");
	}else{
	   $msg=$myDb->last_error;
   		header("Location:add_stdtestimonial.php?msg=$msg");
	}   
	
	//header("Location:add_hostelname.html?msg=$msg");
}else{
  header("Location:index.php");
}
}  
?>