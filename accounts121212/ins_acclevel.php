<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){ 
    $userid1=mysql_real_escape_string($_POST['userid']);
	$name=mysql_real_escape_string($_POST['flname']);
	$ins=mysql_real_escape_string($_POST['ins']);
	$upd=mysql_real_escape_string($_POST['upd']);
	$delt=mysql_real_escape_string($_POST['delt']);
	$opdate=date("Y-m-d");
	/*
	echo $code;"\n";
	echo $name;"\n";
	echo $description;
	exit;
	*/
    $query="INSERT INTO  tbl_accdtl(`userid`,`flname`,`ins`,`upd`,`delt`) VALUES('$userid1','$name','$ins','$upd','$delt')";
	$r=$myDb->insert_sql($query);
	$msg="Data inserted successfully";
	header("Location:macclevel.php?msg=$msg");
}else{
  header("Location:login.php");
}
}  
?>