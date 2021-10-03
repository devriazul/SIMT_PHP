<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managecourseassigntofaculty.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
    
	$facultyid=mysql_real_escape_string(ucfirst($_POST['facultyid']));
	$departmentid=mysql_real_escape_string(ucfirst($_POST['deptid']));
	$courseid=mysql_real_escape_string(ucfirst($_POST['courseid']));
	$session=mysql_real_escape_string(ucfirst($_POST['session']));
	$year=mysql_real_escape_string(ucfirst($_POST['year']));
	$semester=mysql_real_escape_string(ucfirst($_POST['semester']));
	$section=mysql_real_escape_string(ucfirst($_POST['section']));

	
	$id=mysql_real_escape_string($_GET['id']);
	
	$opdate=date("Y-m-d");
	$qup="UPDATE tbl_assignfaculty SET `facultyid`='$facultyid',`deptid`='$departmentid',`courseid`='$courseid',`semesterid`='$semester',`section`='$section',`session`='$session',`year`='$year',`opby`='$_SESSION[userid]',`opdate`='$opdate',`storedstatus`='U' WHERE `id`='$id'";
	
	

	if($upd=$myDb->update_sql($qup))
	{
		$msg="Data Updated Successfully";
		//echo $msg;
    	header("Location:managecourseassigntofaculty.php?msg=$msg");
	}
	else
	{
		$msg=$myDb->last_error;
   		header("Location:managecourseassigntofaculty.php?msg=$msg");
	}
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 echo $msg;
	 //header("Location:home.html?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}