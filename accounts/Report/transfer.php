<?php ob_start();
session_start();
require_once('../dbClass.php');
include("../config.php"); 
include('../inword2.php');

if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='voucherEntry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  	$id = !empty($_GET['id'])?mysql_real_escape_string($_GET['id']):'';
	$rd = $_GET['rd'];
	$amount = $_GET['amount'];
	if($rd === "dr"){
		$myDb->update_sql("UPDATE tbl_2ndjournal SET amountdr=0,amountcr='$amount' where id='$id'");
		echo "Transfer successfull";
	}
	if($rd === "cr"){
		$myDb->update_sql("UPDATE tbl_2ndjournal SET amountdr='$amount',amountcr=0 where id='$id'");
		echo "Transfer successfull";

	}
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>