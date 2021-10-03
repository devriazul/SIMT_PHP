<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managecourseinformation.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
    $code=mysql_real_escape_string(strtoupper($_POST['code']));
	$name=mysql_real_escape_string(ucfirst($_POST['name']));
	$department=mysql_real_escape_string($_POST['department']);
	$credit=mysql_real_escape_string($_POST['credit']);
	$theory=mysql_real_escape_string($_POST['theory']);
	$parctical=mysql_real_escape_string($_POST['parctical']);
	$description=mysql_real_escape_string($_POST['description']);
	$id=mysql_real_escape_string($_GET['id']);
	$cont_assess_t=mysql_real_escape_string($_POST['cont_assess_t']);
	$f_exam_t=mysql_real_escape_string($_POST['f_exam_t']);
	$cont_assess_p=mysql_real_escape_string($_POST['cont_assess_p']);
	$f_exam_p=mysql_real_escape_string($_POST['f_exam_p']);

	$qup="UPDATE tbl_courses SET `coursecode`='$code',`coursename`='$name',`departmentid`='$department',`credit`='$credit',`theory`='$theory',`practical`='$parctical',`description`='$description',`storedstatus`='U',
	cont_assess_t='$cont_assess_t',
	f_exam_t='$f_exam_t',
	cont_assess_p='$cont_assess_p',
	f_exam_p='$f_exam_p',
	opby='$_SESSION[userid]'
	WHERE `id`='$id'";
	if($myDb->update_sql($qup)){
	   $msg="Data updated successfully";
	   echo $msg;
	}else{
	   $msg=$myDb->last_error;
	   echo $msg;
	}      
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg&id=$id");
   }	 

}else{
  header("Location:index.php");
}
}