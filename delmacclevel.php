<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
    $chka="SELECT*FROM  tbl_accdtl WHERE flname='macclevel.php' AND userid='$_SESSION[userid]' and storedstatus<>'D'";
    $caq=$myDb->select($chka);
    $car=$myDb->get_row($caq,'MYSQL_ASSOC');
    if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
	$id=mysql_real_escape_string($_GET['id']);
	
	$qup="UPDATE tbl_accdtl SET storedstatus='D' WHERE `id`='$id'";
	$upd=$myDb->update_sql($qup);
	$msg="Data updated successfully";
    header("Location:macclevel.php?msg=$msg");
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}