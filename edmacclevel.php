<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='macclevel.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
    $userid1=mysql_real_escape_string($_POST['userid']);
	$name=mysql_real_escape_string(($_POST['flname']));
	$ins=mysql_real_escape_string($_POST['ins']);
	$upd=mysql_real_escape_string($_POST['upd']);
	$delt=mysql_real_escape_string($_POST['delt']);
	$id=mysql_real_escape_string($_GET['id']);
	
	
	$qup="UPDATE tbl_accdtl SET `userid`='$userid1',`flname`='$name',`ins`='$ins',`upd`='$upd',`delt`='$delt' WHERE `id`='$id'";
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