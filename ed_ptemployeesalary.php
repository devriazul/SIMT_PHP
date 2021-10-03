<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manageptemployeesalary.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
	$monthname=mysql_real_escape_string($_POST['monthname']);
	$yearname=mysql_real_escape_string($_POST['yearname']);
	$efname=mysql_real_escape_string($_POST['efname']);
	$desig=mysql_real_escape_string($_POST['desig']);
	$ttc=mysql_real_escape_string($_POST['ttc']);
	$tcr=mysql_real_escape_string($_POST['tcr']);
	$tpc=mysql_real_escape_string($_POST['tpc']);
	$pcr=mysql_real_escape_string($_POST['pcr']);
	$others=mysql_real_escape_string($_POST['otherallow']);
	$remarks=mysql_real_escape_string($_POST['remarks']);
	$opdate=date("Y-m-d");
	$id=$_GET['id'];
 	$qup="UPDATE tbl_parttimeemployeesalary SET `monthname`='$monthname', `yearname`='$yearname', `empname`='$efname', `designation`='$desig', `ttclass`='$ttc', `tamountpc`='$tcr', `tpclass`='$tpc', `pamountpc`='$pcr', `opby`='$_SESSION[userid]', `opdate`='$opdate', `storedstatus`='U', `remarks`='$remarks', `others`='$others' WHERE `id`='$id'"; 


	if($myDb->update_sql($qup)){
	   $msg="Data updated successfully";
	header("Location:edit_ptemployeesalary.php?msg=$msg&id=$id");
	}else{
	   $msg=$myDb->last_error;
	 header("Location:edit_ptemployeesalary.php?msg=$msg&id=$id");
	}
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}