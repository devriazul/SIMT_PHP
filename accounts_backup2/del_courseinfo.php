<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='courseinformation.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['delt']=="y"){
	$id=mysql_real_escape_string($_GET['id']);
	$qup="UPDATE tbl_courses SET `storedstatus`='D' WHERE `id`='$id'";
	$upd=$myDb->update_sql($qup);
	$msg="Data deleted successfully";
    header("Location:courseinformation.php?msg=$msg");
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>