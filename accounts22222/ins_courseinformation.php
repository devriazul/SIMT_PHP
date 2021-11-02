<?php 
ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){ 
    $code=mysql_real_escape_string(strtoupper($_POST['code']));
	$name=mysql_real_escape_string(ucfirst($_POST['name']));
	$department=mysql_real_escape_string(ucfirst($_POST['department']));
	$credit=mysql_real_escape_string($_POST['credit']);
	$theory=mysql_real_escape_string($_POST['theory']);
	$practical=mysql_real_escape_string($_POST['practical']);
	$description=mysql_real_escape_string($_POST['desc']);
	$opdate=date("Y-m-d");
	/*
	echo $code;"\n";
	echo $name;"\n";
	echo $description;
	exit;
	*/
    $query="INSERT INTO   tbl_courses(`coursecode`,`coursename`,`departmentid`,`credit`,`theory`,`practical`,`description`,`opby`,`opdate`,`storedstatus`) VALUES('$code','$name','$department','$credit','$theory','$practical','$description','$_SESSION[userid]','$opdate','I')";
	$r=$myDb->insert_sql($query);
	$msg="Data inserted successfully";
	header("Location:courseinformation.php?msg=$msg");
}else{
  header("Location:login.php");
}
}  
?>