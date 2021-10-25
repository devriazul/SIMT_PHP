<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){ 
    
	$facultyid=mysql_real_escape_string(ucfirst($_POST['facultyid']));
	$departmentid=mysql_real_escape_string(ucfirst($_POST['deptid']));
	$courseid=mysql_real_escape_string(ucfirst($_POST['courseid']));
	$session=mysql_real_escape_string(ucfirst($_POST['session']));
	$year=mysql_real_escape_string(ucfirst($_POST['year']));
	$semester=mysql_real_escape_string(ucfirst($_POST['semester']));
	
	$opdate=date("Y-m-d");
	
    $query="INSERT INTO tbl_assignfaculty(`facultyid`,`deptid`,`courseid`,`session`,`year`,`opby`,`opdate`,`storedstatus`,`semesterid`) VALUES('$facultyid','$departmentid','$courseid','$session','$year','$_SESSION[userid]','$opdate','I','$semester')";
	
	if($myDb->insert_sql($query)){
	
	   $msg="Data inserted successfully";
	   echo $msg;
	}else{
	   $msg=$myDb->last_error;
	   // $msg= "Can't Save Data. Selected Faculty was already assigned to Selected Session Selected Semester.";
		echo $msg;
	}   
	
	//header("Location:add_hostelname.html?msg=$msg");
}else{
  header("Location:index.php");
}
}  
?>