<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){ 
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managegradingsystem.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
	$lmarks=mysql_real_escape_string(ucfirst($_POST['lmarks']));
	$umarks=mysql_real_escape_string(ucfirst($_POST['umarks']));
	$grade=mysql_real_escape_string(ucfirst($_POST['grade']));
	$gpoint=mysql_real_escape_string(ucfirst($_POST['gpoint']));

	
	$opdate=date("Y-m-d");
    $query="INSERT INTO tbl_gradesystem(`lowermarks`,`uppermarks`,`latergrade`,`gradepoint`,`opby`,`opdate`,`storedstatus`) VALUES('$lmarks','$umarks','$grade','$gpoint','$_SESSION[userid]','$opdate','I')";
	
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
	//header("Location:add_hostelname.html?msg=$msg");
}else{
  header("Location:index.php");
}
}