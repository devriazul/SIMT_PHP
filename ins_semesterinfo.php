<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){ 
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='semesterinfo.php' AND userid='$_SESSION[userid]'"; 
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['upd']=="y")||($_SESSION['userid']=="administrator")){
    $name=mysql_real_escape_string(strtoupper($_POST['name']));
	$period=mysql_real_escape_string($_POST['period']);
	$totcredit=mysql_real_escape_string($_POST['totcredit']);
	$description=mysql_real_escape_string($_POST['desc']);
	$opdate=date("Y-m-d");
	
    $query="INSERT INTO   tbl_semester(`name`,`period`,`totalcredit`,`description`,`opby`,`opdate`,`storedstatus`) VALUES('$name','$period','$totcredit','$description','$_SESSION[userid]','$opdate','I')";
	if($r=$myDb->insert_sql($query)){
		$msg="Data inserted successfully";
		echo $msg;
    }else{
	    $msg=$myDb->last_error;
		echo $msg;
    }	
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 echo $msg;
   }	 
		
}else{
  header("Location:index.php");
}
}