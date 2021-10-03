<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){ 
    $id=mysql_real_escape_string($_GET['id']);

    $query="DELETE FROM tbl_bookentry WHERE bookid='$id'";
	if($r=$myDb->update_sql($query)){
	  $msg="Data deleted successfully";
	  header("Location:book_entry.php?msg=$msg&list=1");
	}else{
	  $msg=$myDb->last_error;  
	  header("Location:book_entry.php?msg=$msg&list=1");
	}  

}else{
  header("Location:login.php");
}
}  
?>