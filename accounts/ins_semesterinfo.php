<?php 
ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){ 
    $name=mysql_real_escape_string(strtoupper($_POST['name']));
	$year=mysql_real_escape_string(ucfirst($_POST['year']));
	$session=mysql_real_escape_string(ucfirst($_POST['session']));
	$period=mysql_real_escape_string($_POST['period']);
	$totcredit=mysql_real_escape_string($_POST['totcredit']);
	$description=mysql_real_escape_string($_POST['desc']);
	$opdate=date("Y-m-d");
	
    $query="INSERT INTO   tbl_semester(`name`,`session`,`year`,`period`,`totalcredit`,`description`,`opby`,`opdate`,`storedstatus`) VALUES('$name','$session','$year','$period','$totcredit','$description','$_SESSION[userid]','$opdate','I')";
	$r=$myDb->insert_sql($query);
	$msg="Data inserted successfully";
	header("Location:semesterinfo.php?msg=$msg");
}else{
  header("Location:login.php");
}
}  
?>