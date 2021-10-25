<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){ 
    
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manageexam.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
	
	$departmentid=mysql_real_escape_string(ucfirst($_POST['deptid']));
	$courseid=mysql_real_escape_string(ucfirst($_POST['courseid']));
	$session=mysql_real_escape_string(ucfirst($_POST['session']));
	$year=mysql_real_escape_string(ucfirst($_POST['year']));
	$semester=mysql_real_escape_string(ucfirst($_POST['semester']));
	$examtype=mysql_real_escape_string(ucfirst($_POST['examtype']));
	$examname=mysql_real_escape_string(ucfirst($_POST['examname']));
	$exammarksper=mysql_real_escape_string(ucfirst($_POST['exammarksper']));
	$dline=mysql_real_escape_string(ucfirst($_POST['dline']));
	
	$opdate=date("Y-m-d");
    $query="INSERT INTO   tbl_examinitionsettings(`deptid`,`courseid`,`session`,`year`,`semesterid`,`examtype`,`examname`,`exammarksper`,`lastdate`,`opby`,`opdate`,`storedstatus`) VALUES('$departmentid','$courseid','$session','$year','$semester','$examtype','$examname','$exammarksper','$dline','$_SESSION[userid]','$opdate','I')";
	
	if($myDb->insert_sql($query)){
		
	   $msg="Data inserted successfully";
	   //header("Location:add_examinformation.php?msg=$msg");
	   echo $msg;
	}else{
	   $msg=$myDb->last_error;
	   echo $msg;
	}   
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 
	//header("Location:add_hostelname.html?msg=$msg");
}else{
  header("Location:index.php");
}
}