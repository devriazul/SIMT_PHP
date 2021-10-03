<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $pname=mysql_real_escape_string($_POST['pname']);
  $packsize=mysql_real_escape_string($_POST['packsize']);
  $id=mysql_real_escape_string($_POST['id']);
  //$mname=mysql_real_escape_string($_POST['mname']);
  $qty=mysql_real_escape_string($_POST['qty']);
  if($myDb->update_sql("UPDATE tbl_product set pname='$pname'
                                               ,packsize='$packsize'
											   ,qty='$qty'
											   
							   WHERE id='$id'")){
     echo "Product update successfully";
	 
     $insacc="update tbl_accchart SET accname='$pname' WHERE productid='$id'";
	 $myDb->update_sql($insacc);
	 
  }else{
     echo $myDb->last_error;
  }	 	 

?>


<?php 
}else{
  header("Location:index.php");
}
}