<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $pid=mysql_real_escape_string($_POST['pid']);
  $supid=mysql_real_escape_string($_POST['supid']);
  $rqty=mysql_real_escape_string($_POST['rqty']);
  $id=mysql_real_escape_string($_POST['id']);
  $empid=mysql_real_escape_string($_POST['empid']);
  $storeid=mysql_real_escape_string($_POST['storeid']);

  if($myDb->update_sql("UPDATE tbl_buyproduct SET pid='$pid',
                                                  supid='$supid',
												  rqty='$rqty',
												  empid='$empid',
												  storeid='$storeid'
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
