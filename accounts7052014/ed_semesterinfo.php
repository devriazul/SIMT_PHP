<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='semesterinfo.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['upd']=="y"){
    $name=mysql_real_escape_string(strtoupper($_POST['name']));
	$year=mysql_real_escape_string(ucfirst($_POST['year']));
	$session=mysql_real_escape_string(ucfirst($_POST['session']));
	$period=mysql_real_escape_string($_POST['period']);
	$totcredit=mysql_real_escape_string($_POST['totcredit']);
	$description=mysql_real_escape_string($_POST['desc']);
	$id=mysql_real_escape_string($_GET['id']);
	$qup="UPDATE  tbl_semester SET `name`='$name',`year`='$year',`session`='$session',`period`='$period',`totalcredit`='$totcredit',`description`='$description',`storedstatus`='U' WHERE `id`='$id'";
	$upd=$myDb->update_sql($qup);
	$msg="Data updated successfully";
    header("Location:semesterinfo.php?msg=$msg");
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>
