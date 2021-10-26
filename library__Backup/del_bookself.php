<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){ 
    $id=mysql_real_escape_string($_GET['id']);

    $query="DELETE FROM tbl_bookself WHERE selfno='$id'";
	if($r=$myDb->update_sql($query)){
	  $msg="Data deleted successfully";
	  header("Location:manage_settings.php?msg=$msg");
	}else{
	  $msg=$myDb->last_error;  
	  header("Location:manage_settings.php?msg=$msg");
	}  

}else{
  header("Location:index.php");
}
}