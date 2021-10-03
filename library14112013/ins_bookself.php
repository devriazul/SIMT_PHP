<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){ 
	$opby=mysql_real_escape_string($_SESSION['userid']);
	$deptid=mysql_real_escape_string($_POST['deptid']);
	$selfno=mysql_real_escape_string($_POST['selfno']);
	$noofrow=mysql_real_escape_string($_POST['noofrow']);
	$capacity=mysql_real_escape_string($_POST['capacity']);
	
    for($i=1;$i<=$noofrow;$i++){
		$query="INSERT INTO  tbl_bookself(`selfno`,`noofrow`,`capacity`,`deptid`,`opby`,`storedstatus`) VALUES('$selfno','$i','$capacity','$deptid','$opby','I')";
		if($r=$myDb->insert_sql($query)){
		  $msg="Data inserted successfully";
		  echo $msg;
		}else{
		  $msg=$myDb->last_error;  
		  echo $msg;
		}  
    }		
	
}else{
  header("Location:login.php");
}
}  
?>