<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managecourseinformation.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  
    $code=mysql_real_escape_string(strtoupper($_POST['code']));
	$name=mysql_real_escape_string(ucfirst($_POST['name']));
	$department=mysql_real_escape_string($_POST['department']);
	$credit=mysql_real_escape_string($_POST['credit']);
	$theory=mysql_real_escape_string($_POST['theory']);
	$practical=mysql_real_escape_string($_POST['practical']);
	$description=mysql_real_escape_string($_POST['description']);
	$id=mysql_real_escape_string($_GET['id']);
	$qup="UPDATE tbl_courses SET `coursecode`='$code',`coursename`='$name',`departmentid`='$department',`credit`='$credit',`theory`='$theory',`practical`='$practical',`description`='$description',`storedstatus`='U' WHERE `id`='$id'";
	$upd=$myDb->update_sql($qup);
	$msg="Data updated successfully";
    header("Location:managecourseinformation.php?msg=$msg");
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>