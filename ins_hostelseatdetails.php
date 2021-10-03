<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){ 
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managehostelseatdetails.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
	$hostelid=mysql_real_escape_string(ucfirst($_POST['hostelid']));
	$roomid=mysql_real_escape_string(ucfirst($_POST['roomid']));
	$seatno=mysql_real_escape_string(ucfirst($_POST['seatno']));
	$price=mysql_real_escape_string(ucfirst($_POST['price']));
	$mealcharge=mysql_real_escape_string(ucfirst($_POST['mealcharge']));
	$opdate=date("Y-m-d");
	/*
	echo $code;"\n";
	echo $name;"\n";
	echo $description;
	exit;
	*/
    $query="INSERT INTO   tbl_hostelseatdetails(`hostelid`,`roomid`,`seatno`,`price`,`mealcharge`,`opby`,`opdate`,`storedstatus`) VALUES('$hostelid','$roomid','$seatno','$price','$mealcharge','$_SESSION[userid]','$opdate','I')";
	
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