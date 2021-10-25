<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manageallocatehostel.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  
       $id=mysql_real_escape_string($_GET['id']);
       $query="SELECT id, seatno as SeatNo, price as Rent, IF(status = 1, 'Allocated','Available')  as Status FROM  tbl_hostelseatdetails WHERE roomid='$id' and storedstatus<>'D'";
       //$sdep=$myDb->dump_query($query,'edit_education.php','del_education.php',$car['upd'],$car['delt']);
	   $sdep=$myDb->dump_queryHSA($query,'allocatehostelseatdetails.php',$car['upd']);

   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}  
?>
