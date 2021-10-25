<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){ 
	$opby=mysql_real_escape_string($_SESSION['userid']);
	$id=mysql_real_escape_string($_POST['id']);
	$maxallow=mysql_real_escape_string($_POST['maxval']);
	$fine=mysql_real_escape_string($_POST['fine']);

    $query="UPDATE tbl_libsetting SET `maxallow`='$maxallow',`fine`='$fine',`opby`='$opby',`storedstatus`='U' WHERE id='$id'";
	if($r=$myDb->update_sql($query)){
	  $msg="Data updated successfully";
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