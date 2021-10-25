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
  
  if($myDb->insert_sql("INSERT INTO tbl_supplier(sname,sphone,saddress,semail,opby)VALUES('$sname','$sphone','$saddress','$semail','$_SESSION[userid]')")){
     $maxs=$myDb->select("SELECT MAX(id) mid from tbl_supplier");
	 $maxsf=$myDb->get_row($maxs,'MYSQL_ASSOC');
  
  //--------------------Supplier entry into Chart of Accounts in Accounts Payable----------------------
  	$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,supid) VALUES('$sname','5329','5329','Balance Sheet','5','$_SESSION[userid]','".date("Y-m-d")."','I','$maxsf[mid]')");
	  
     echo "Supplier Insert successfully";
  }else{
     echo $myDb->last_error;
  }	 	 

?>


<?php 
}else{
  header("Location:index.php");
}
}