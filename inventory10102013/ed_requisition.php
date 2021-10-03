<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $pid=mysql_real_escape_string($_POST['pid']);
  $rqty=mysql_real_escape_string($_POST['rqty']);
  $id=mysql_real_escape_string($_POST['id']);
  $empid=mysql_real_escape_string($_POST['empid']);
  $expdate=mysql_real_escape_string($_POST['expdate']);

  if($myDb->update_sql("UPDATE tbl_buyproduct SET pid='$pid',
												  rqty='$rqty',
												  empid='$empid',
												  reqdate='$expdate'
							   WHERE id='$id'")){
     echo "Requisition Update successfully";
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
