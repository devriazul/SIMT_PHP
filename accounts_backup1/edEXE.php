<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='stdinfo.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){ 
  
  $id=mysql_real_escape_string($_GET['id']);
  $mq="SELECT*FROM tbl_stdinfo WHERE id='$id'";
  $mqr=$myDb->select($mq);
  $msf=$myDb->get_row($mqr,'MYSQL_ASSOC');
    $ei="UPDATE tbl_educationalq SET 
									 nexemination='".mysql_real_escape_string($_POST['nexemination'])."',
									 group1='".mysql_real_escape_string($_POST['group1'])."',
									 board='".mysql_real_escape_string($_POST['board'])."',
									 passyear='".mysql_real_escape_string($_POST['passyear'])."',
									 cgpas='".mysql_real_escape_string($_POST['cgpas'])."',
									 tcgpa='".mysql_real_escape_string($_POST['tcgpa'])."',
									 gcsubject='".mysql_real_escape_string($_POST['gcsubject'])."'
	     WHERE id='$id'";
    $ein=$myDb->insert_sql($ei);
	$msg="Student education information successfully updated.";
	header("Location:edit_education.php?msg=$msg&id=$id");
 
 
 }else{
     $msg="Sorry,you are not authorized to access this page";
 }	 

}else{
  header("Location:login.php");
}
}  
?>

