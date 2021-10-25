<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $pname=mysql_real_escape_string(ucwords($_POST['pname']));
  $packsize=mysql_real_escape_string($_POST['packsize']);
  $prtype=mysql_real_escape_string(ucwords($_POST['prtype']));
  $mname=mysql_real_escape_string(ucwords($_POST['mname']));
  $qty=mysql_real_escape_string($_POST['qty']);
  if($myDb->insert_sql("INSERT INTO tbl_product(pname,packsize,prtype,mname,opby,qty)VALUES('$pname','$packsize','$prtype','$mname','$_SESSION[userid]','$qty')")){
     $maxp=$myDb->select("SELECT MAX(id) mid from tbl_product");
	 $maxpf=$myDb->get_row($maxp,'MYSQL_ASSOC');
     $insacc="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,productid)
	                 VALUES('$pname','1660','1660','Expense Account','1','$_SESSION[userid]','".date("Y-m-d")."','I','$maxpf[mid]')";
	 $myDb->insert_sql($insacc);	
	 			 
     echo "Product Insert successfully";
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
