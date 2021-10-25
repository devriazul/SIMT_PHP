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
  if($car['ins']=="y"){
  
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
	$opdate=date("Y-m-d");

	$id=mysql_real_escape_string($_GET['id']);

	$qup="UPDATE `tbl_stdcv` SET `stdid` = '$stdid', `stdname` = '$stdname', `fname` = '$fname', `mname` = '$mname', `paddress` = '$preaddress', `peraddress` = '$peraddress', `dob`='$dob', `department` = '$department', `session` = '$session', `passingyear` = '$passyear', `cgpa`='$cgpa', `higherstudy` = '$higheredu', `hsorgname` = '$hsorgname', `wonameaddress` = '$wonameaddress', `designation` = '$designation', `cellno` = '$phone', `email` = '$email', `opby`='$_SESSION[userid]', `opdate`='$opdate' ,`storedstatus`='U'	WHERE `id`='$id'";
	if($myDb->update_sql($qup)){
	   $msg="Data updated successfully";
	   header("Location:managestdcv.php?msg=$msg");

	}else{
	   $msg=$myDb->last_error;
	   header("Location:managestdcv.php?msg=$msg");
	}      
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}  
?>