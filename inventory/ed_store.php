<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $storeid=mysql_real_escape_string($_POST['storeid']);
  $storename=mysql_real_escape_string($_POST['storename']);
  $maintainby=mysql_real_escape_string($_POST['maintainby']);
  
  $id=mysql_real_escape_string($_POST['id']);
  if($myDb->insert_sql("UPDATE tbl_store SET storename='$storename',maintainby='$maintainby',opby='$_SESSION[userid]' WHERE id='$id'")){
     echo "Store Update successfully";
  }else{
     echo $myDb->last_error;
  }	 	 

?>


<?php 
}else{
  header("Location:index.php");
}
}