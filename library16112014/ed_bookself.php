<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){ 
    $id=mysql_real_escape_string($_POST['id']);
	$opby=mysql_real_escape_string($_SESSION['userid']);
	$deptid=mysql_real_escape_string($_POST['deptid']);
	$selfno=mysql_real_escape_string($_POST['selfno']);
	$capacity=mysql_real_escape_string($_POST['capacity']);

    $query="UPDATE tbl_bookself SET `deptid`='$deptid',`selfno`='$selfno',`capacity`='$capacity',`opby`='$opby',`storedstatus`='U' WHERE selfno='$id'";
	if($r=$myDb->update_sql($query)){
	  $msg="Data updated successfully";
	  echo $msg;
	}else{
	  $msg=$myDb->last_error;  
	  echo $msg;
	}  

}else{
  header("Location:index.php");
}
}