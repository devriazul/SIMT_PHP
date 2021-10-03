<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){ 
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='semesterwisesubject_search.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
    //$year=mysql_real_escape_string(ucfirst($_POST['year1']));
	$session=mysql_real_escape_string(ucfirst($_POST['session1']));
	$semester=mysql_real_escape_string($_POST['semester1']);
	$department=mysql_real_escape_string($_POST['department1']);
	$course='';
	if(isset($_POST['crid'])){
	   $course=count($_POST['crid']);
	}else{
	   echo "You have to select at least one subject";
	}      
	$opdate=date("Y-m-d");
	$msg='';
	for($i=0;$i<$course;$i++){
		//$query="INSERT INTO tbl_semesterwisesubj(`session`,`semesterid`, `deptid`,`courseid`,`opby`,`opdate`,`storedstatus`) VALUES('$session','$semester','$department','".mysql_real_escape_string($_POST['crid'][$i])."', '$_SESSION[userid]','$opdate','I')";
		//$query="INSERT INTO tbl_semesterwisesubj(`semesterid`, `deptid`,`courseid`,`opby`,`opdate`,`storedstatus`) VALUES('$semester','$department','".mysql_real_escape_string($_POST['crid'][$i])."', '$_SESSION[userid]','$opdate','I')";
		$query="INSERT INTO tbl_semesterwisesubj(`session`,`semesterid`, `deptid`,`courseid`,`opby`,`opdate`,`storedstatus`) VALUES('$session','$semester','$department','".mysql_real_escape_string($_POST['crid'][$i])."', '$_SESSION[userid]','$opdate','I')";
		
		  if($myDb->insert_sql($query)){
			 $msg="Data inserted successfully";
		  
		  }else{
			 $msg=$myDb->last_error;
		  } 	 
	}
	echo $msg;
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 
}else{
  header("Location:index.php");
}
}