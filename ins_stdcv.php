<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){ 

  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managestdcv.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
	$stdid=mysql_real_escape_string($_POST['stdid']);
	$stdname=mysql_real_escape_string($_POST['stdname']);
	$fname=mysql_real_escape_string($_POST['fname']);
	$mname=mysql_real_escape_string($_POST['mname']);
	$preaddress=mysql_real_escape_string($_POST['presentaddress']);
	$peraddress=mysql_real_escape_string($_POST['permanentaddress']);
	$dob=mysql_real_escape_string($_POST['dob']);
	$department=mysql_real_escape_string($_POST['department']);
	$session=mysql_real_escape_string($_POST['session']);
	$passyear=mysql_real_escape_string($_POST['syear']);
	$cgpa=mysql_real_escape_string($_POST['cgpa']);
	$higheredu=mysql_real_escape_string($_POST['higheredu']);
	$hsorgname=mysql_real_escape_string($_POST['orgname']);
	$wonameaddress=mysql_real_escape_string($_POST['wonameadd']);
	$designation=mysql_real_escape_string($_POST['designation']);
	$phone=mysql_real_escape_string($_POST['phoneno']);
	$email=mysql_real_escape_string($_POST['email']);
	$simg=mysql_real_escape_string($_POST['img']);
	$cs=mysql_real_escape_string($_POST['cs']);
	$ls=mysql_real_escape_string($_POST['ls']);
	$ref1=mysql_real_escape_string($_POST['ref1']);
	$ref2=mysql_real_escape_string($_POST['ref2']);
	$co=mysql_real_escape_string($_POST['co']);
	$ts=mysql_real_escape_string($_POST['ts']);

	$opdate=date("Y-m-d");

echo    $query="INSERT INTO `tbl_stdcv` (`stdid`, `stdname`, `fname`, `mname`, `paddress`, `peraddress`, `dob`, `department`, `session`, `passingyear`, `cgpa`, `higherstudy`, `hsorgname`, `wonameaddress`, `designation`, `cellno`, `email`, `img`, `cs`, `ls`, `ref1`, `ref2`, `co`, `ts`, `opby`, `opdate`, `storedstatus`) VALUES ('$stdid', '$stdname', '$fname', '$mname', '$preaddress', '$peraddress', '$dob', '$department', '$session', '$passyear', '$cgpa', '$higheredu', '$hsorgname', '$wonameaddress', '$designation', '$phone', '$email', '$simg', '$cs', '$ls', '$ref1', '$ref2', '$co', '$ts', '$_SESSION[userid]','$opdate','I')"; exit;
	
	if($myDb->insert_sql($query)){
	
	   	$msg="Data inserted successfully";
   		//header("Location:add_stdcv.php?msg=$msg");
		header("Location:reportstudentcv.php?stdid=$stdid");
	}else{
	   $msg=$myDb->last_error;
   		header("Location:add_stdcv.php?msg=$msg");
	}   
	
	//header("Location:add_hostelname.html?msg=$msg");
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 
}else{
  header("Location:index.php");
}
}