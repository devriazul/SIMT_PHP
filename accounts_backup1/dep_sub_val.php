<?php 
ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){ 
    $year=mysql_real_escape_string($_POST['yearv']);
	$session=mysql_real_escape_string($_POST['sessionv']);
	$semester=mysql_real_escape_string($_POST['semesterv']);
	$department=mysql_real_escape_string($_POST['deptidv']);
	$courseid=$_POST['crid'];
	$coursecode=$_POST['crcode'];
	$t=$_POST['t'];
	$p=$_POST['p1'];
	$c=$_POST['c'];
	
	$cont=count($_POST['crid']);//mysql_real_escape_string($_POST['sid']);
	
	//print_r($cont);
	//exit;
	$opdate=date("Y-m-d");
	for($i=0;$i<$cont;$i++){
	//$arr=array(mysql_real_escape_string($_POST['crid'][$i]));
	//$courseid=implode(',',$arr);
	
	//echo print_r($courseid);
	//exit;
    $query="INSERT INTO `tbl_dep_mark_dis`(`crid`,`crcode`,`t`,`p`,`c`,`cont_assess_t`,`f_exam_t`,`cont_assess_p`,`f_exam_p`,`depid`,`sesssion`,`year`,`semesterid`)
VALUES ('".mysql_real_escape_string($_POST['crid'][$i])."', '".mysql_real_escape_string($_POST['crcode'][$i])."', '".mysql_real_escape_string($_POST['t'][$i])."', '".mysql_real_escape_string($_POST['p1'][$i])."', '".mysql_real_escape_string($_POST['c'][$i])."', '".mysql_real_escape_string($_POST['cont_assess_t'][$i])."', '".mysql_real_escape_string($_POST['f_exam_t'][$i])."', '".mysql_real_escape_string($_POST['cont_assess_p'][$i])."', '".mysql_real_escape_string($_POST['f_exam_p'][$i])."', '$department', '$session', '$year', '$semester')";
	
	  if($myDb->insert_sql($query)){
	     $msg="Data inserted successfully";
		 echo $msg;
		 //header("Location:semesterwisesubject.php?t=1&msg=$msg");
	  
	  }else{
	     $msg=$myDb->last_error;
		 echo $msg;
		 //header("Location:semesterwisesubject.php?t=0&msg=$msg");
	  } 	 
	}
	//$msg="Data inserted successfully";
	//header("Location:semesterwisesubject.php?msg=$msg");
}else{
  header("Location:login.php");
}
}  
?>