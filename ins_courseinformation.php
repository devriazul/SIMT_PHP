<?php 
ob_start();
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
	$department=mysql_real_escape_string(ucfirst($_POST['department']));
	$credit=mysql_real_escape_string($_POST['credit']);
	$theory=mysql_real_escape_string($_POST['theory']);
	$parctical=mysql_real_escape_string($_POST['parctical']);
	$description=mysql_real_escape_string($_POST['desc']);
	$cont_assess_t=mysql_real_escape_string($_POST['cont_assess_t']);
	$f_exam_t=mysql_real_escape_string($_POST['f_exam_t']);
	$cont_assess_p=mysql_real_escape_string($_POST['cont_assess_p']);
	$f_exam_p=mysql_real_escape_string($_POST['f_exam_p']);
	$opdate=date("Y-m-d");
	/*
	echo $code;"\n";
	echo $name;"\n";
	echo $description;
	exit;
	*/
    $query="INSERT INTO   tbl_courses(`coursecode`,`coursename`,`departmentid`,`credit`,`theory`,`practical`,`description`,`opby`,`opdate`,`storedstatus`,`cont_assess_t`,`f_exam_t`,`cont_assess_p`,`f_exam_p`) VALUES('$code','$name','$department','$credit','$theory','$parctical','$description','$_SESSION[userid]','$opdate','I','$cont_assess_t','$f_exam_t','$cont_assess_p','$f_exam_p')";
	if($myDb->insert_sql($query)){
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
	   
}else{
  header("Location:index.php");
}
}  
?>