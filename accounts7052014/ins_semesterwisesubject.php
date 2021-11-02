<?php 
ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){ 
    $year=mysql_real_escape_string(ucfirst($_POST['year1']));
	$session=mysql_real_escape_string(ucfirst($_POST['session1']));
	$semester=mysql_real_escape_string($_POST['semester1']);
	$department=mysql_real_escape_string($_POST['department1']);
	$course=count($_POST['crid']);//mysql_real_escape_string($_POST['sid']);
	$opdate=date("Y-m-d");
	for($i=0;$i<$course;$i++){
	//$arr=array(mysql_real_escape_string($_POST['crid'][$i]));
	//$courseid=implode(',',$arr);
	
	//echo print_r($courseid);
	//exit;
    $query="INSERT INTO   tbl_semesterwisesubj(`year`,`session`,`semesterid`,`deptid`,`courseid`,`opby`,`opdate`,`storedstatus`) VALUES('$year','$session','$semester','$department','".mysql_real_escape_string($_POST['crid'][$i])."','$_SESSION[userid]','$opdate','I')";
	
	  if($myDb->insert_sql($query)){
	     $msg="Data inserted successfully";
		 header("Location:semesterwisesubject.php?t=1&msg=$msg");
	  
	  }else{
	     $msg=$myDb->last_error;
		 //echo $msg;
		 header("Location:semesterwisesubject.php?t=0&msg=$msg");
	  } 	 
	}
	//$msg="Data inserted successfully";
	//header("Location:semesterwisesubject.php?msg=$msg");
}else{
  header("Location:login.php");
}
}  
?>