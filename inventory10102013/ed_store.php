<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $storeid=mysql_real_escape_string($_POST['storeid']);
  $storename=mysql_real_escape_string($_POST['storename']);
  $id=mysql_real_escape_string($_POST['id']);
  if($myDb->insert_sql("UPDATE tbl_store SET storeid='$storeid',storename='$storename' WHERE id='$id'")){
     echo "Store Update successfully";
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
