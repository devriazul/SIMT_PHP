<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){ 
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
	$r=$myDb->insert_sql($query);
	$msg="Data inserted successfully";
	header("Location:hostelname.php?msg=$msg");
}else{
  header("Location:login.php");
}
}  
?>