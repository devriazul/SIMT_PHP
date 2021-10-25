<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $sname=mysql_real_escape_string($_POST['sname']);
  $sphone=mysql_real_escape_string($_POST['sphone']);
  $saddress=mysql_real_escape_string($_POST['saddress']);
  $semail=mysql_real_escape_string($_POST['semail']);
  if($myDb->insert_sql("INSERT INTO tbl_supplier(sname,sphone,saddress,semail)VALUES('$sname','$sphone','$saddress','$semail')")){
     echo "Supplier Insert successfully";
  }else{
     echo $myDb->last_error;
  }	 	 

?>


<?php 
}else{
  header("Location:login.php");
}
}  
?>
