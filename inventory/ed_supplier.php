<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $sname=mysql_real_escape_string($_POST['sname']);
  $sphone=mysql_real_escape_string($_POST['sphone']);
  $saddress=mysql_real_escape_string($_POST['saddress']);
  $semail=mysql_real_escape_string($_POST['semail']);
  $id=mysql_real_escape_string($_POST['id']);
  if($myDb->update_sql("UPDATE tbl_supplier set sname='$sname'
                                               ,sphone='$sphone'
											   ,saddress='$saddress'
											   ,semail='$semail'
							   WHERE id='$id'")){
     echo "Supplier update successfully";
  }else{
     echo $myDb->last_error;
  }	 	 

?>


<?php 
}else{
  header("Location:index.php");
}
}