<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_jurnal.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  
    $chkam="SELECT SUM(amountdr) amountdr,( SELECT SUM(amountcr) amountcr
                                FROM tbl_tmpjurnal
                                WHERE amountdr=0
                                AND opby='$_SESSION[userid]'
                                AND masteraccno in(SELECT accno
                                                 FROM tbl_tmpjurnal
                                                 WHERE amountcr=0
                                                 AND opby='$_SESSION[userid]'
                                                 AND masteraccno=0)
                              ) amountcr
			FROM tbl_tmpjurnal
			WHERE amountcr=0
			AND opby='admin'
			AND masteraccno=0;
			";
	$amsq=$myDb->select($chkam);
	$amfet=$myDb->get_row($amsq,'MYSQL_ASSOC');
	
	if($amfet['amountdr']!=$amfet['amountcr']){
	   echo "Debit and credit not same,you can not save data";
	}else{
	   echo "Data save successfully";
	}      
	
	

   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>
  
  
  
  
