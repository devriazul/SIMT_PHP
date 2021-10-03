<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $storeid=mysql_real_escape_string($_POST['storeid']);
  $storename=mysql_real_escape_string($_POST['storename']);
  if($myDb->insert_sql("INSERT INTO tbl_store(storeid,storename)VALUES('$storeid','$storename')")){
     echo "Store Insert successfully";
  }else{
     echo $myDb->last_error;
  }	 	 

?>


<?php 
}else{
  header("Location:index.php");
}
}