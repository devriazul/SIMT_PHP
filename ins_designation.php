<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){ 
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managedesignation.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
	$name=mysql_real_escape_string(ucfirst($_POST['name']));
	$description=mysql_real_escape_string($_POST['desc']);
	$order=mysql_real_escape_string($_POST['order']);
	
	$opdate=date("Y-m-d");
	/*
	echo $code;"\n";
	echo $name;"\n";
	echo $description;
	exit;
	*/
    $query="INSERT INTO   tbl_designation(`name`,`description`,`opby`,`opdate`,`storedstatus`,`torder`) VALUES('$name','$description','$_SESSION[userid]','$opdate','I','$order')";
	
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