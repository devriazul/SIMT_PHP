<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){ 
	$opby=mysql_real_escape_string($_SESSION['userid']);
	$maxval=mysql_real_escape_string($_POST['maxval']);
	$fine=mysql_real_escape_string($_POST['fine']);

    $query="INSERT INTO  tbl_libsetting(`maxallow`,`fine`,`opby`,`storedstatus`) VALUES('$maxval','$fine','$opby','I')";
	if($r=$myDb->insert_sql($query)){
	  $msg="Data inserted successfully";
	  echo $msg;
	}else{
	  $msg=$myDb->last_error;  
	  echo $msg;
	}  

}else{
  header("Location:login.php");
}
}  
?>