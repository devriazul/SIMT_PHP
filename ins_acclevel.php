<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){ 
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='macclevel.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
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
	if($r=$myDb->insert_sql($query)){
	   $msg="Data inserted successfully";
	   header("Location:macclevel.php?msg=$msg&t=1");
	}else{
	   $msg=$myDb->last_error;
	   header("Location:macclevel.php?msg=$msg&t=0");
	}      
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:index.php?msg=$msg");
   }	 
}else{
  header("Location:index.php");
}
}