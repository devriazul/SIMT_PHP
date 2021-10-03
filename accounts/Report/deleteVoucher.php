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
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  $voucherid = !empty($_GET['voucherid']) ? mysql_real_escape_string($_GET['voucherid']): '';  
  if( empty($voucherid)){ 
  	echo "Voucherid not found";
	header("Location:rptGeneralJournal.php");
  }else{
  	$myDb->update_sql("DELETE FROM tbl_masterjournal WHERE voucherid='$voucherid'");
  	$myDb->update_sql("DELETE FROM tbl_2ndjournal WHERE voucherid='$voucherid'");
	$msg = "Voucher ".$voucherid." successfully deleted";
	header("Location:rptGeneralJournal.php?msg=$msg&fdate=$fdate&tdate=$tdate");

  }
  
	
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}  
?>