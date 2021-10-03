<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){ 
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manageleave.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
	$name=mysql_real_escape_string(ucfirst($_POST['name']));
	$code=mysql_real_escape_string(ucfirst($_POST['code']));
	$dayscount=mysql_real_escape_string(ucfirst($_POST['dayscount']));
	$status=mysql_real_escape_string(ucfirst($_POST['status']));
	$remarks=mysql_real_escape_string($_POST['remarks']);
	
	$opdate=date("Y-m-d");
	/*
	echo $code;"\n";
	echo $name;"\n";
	echo $description;
	exit;
	*/
    $query="INSERT INTO   tbl_leave(`name`,`code`,`dayscount`,`status`,`remarks`,`opby`,`opdate`,`storedstatus`) VALUES('$name','$code','$dayscount','$status','$remarks','$_SESSION[userid]','$opdate','I')";
	
	if($myDb->insert_sql($query)){
	
	   $msg="Data inserted successfully";
	   echo $msg;
	}else{
	   $msg=$myDb->last_error;
	   echo $msg;
	}   
	
	//header("Location:add_hostelname.html?msg=$msg");
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 
	
}else{
  header("Location:index.php");
}
}  
?>