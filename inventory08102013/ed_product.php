<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $pname=mysql_real_escape_string($_POST['pname']);
  $packsize=mysql_real_escape_string($_POST['packsize']);
  $prtype=mysql_real_escape_string($_POST['prtype']);
  $id=mysql_real_escape_string($_POST['id']);
  $mname=mysql_real_escape_string($_POST['mname']);
  if($myDb->update_sql("UPDATE tbl_product set pname='$pname'
                                               ,packsize='$packsize'
											   ,prtype='$prtype'
											   ,mname='$mname'
											   
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
  header("Location:login.php");
}
}  
?>
