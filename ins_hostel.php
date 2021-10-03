<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){ 
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='hostelname.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
    $code=mysql_real_escape_string(strtoupper($_POST['code1']));
	$name=mysql_real_escape_string(ucfirst($_POST['name1']));
	$address=mysql_real_escape_string($_POST['address']);
	$noofseats=mysql_real_escape_string($_POST['noofseats']);
	$opdate=date("Y-m-d");
	/*
	echo $code;"\n";
	echo $name;"\n";
	echo $description;
	exit;
	*/
    $query="INSERT INTO   tbl_hostel(`code`,`name`,`address`,`noofseats`,opby,opdate,storedstatus) VALUES('$code','$name','$address','$noofseats','$_SESSION[userid]','$opdate','I')";
	
	if($myDb->insert_sql($query)){
	
	   $msg="Data inserted successfully";
	   echo $msg;
	}else{
	   $msg=$myDb->last_error;
	   echo $msg;
	}
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 echo $msg;
	 //header("Location:home.html?msg=$msg");
   }	 
	
	//header("Location:add_hostelname.html?msg=$msg");
}else{
  header("Location:login.html");
}
}