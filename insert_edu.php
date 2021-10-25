<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_student.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){ 
  $id=mysql_real_escape_string($_POST['id']);
  $mq="SELECT*FROM tbl_stdinfo WHERE id='$id'";
  $mqr=$myDb->select($mq);
  $msf=$myDb->get_row($mqr,'MYSQL_ASSOC');

    $ei="INSERT INTO tbl_educationalq(stdtid,stdid,exstid,nexemination,group1,board,passyear,cgpas,tcgpa,gcsubject,opby,opdate,storedstatus,othtrade)VALUES('$msf[id]','$msf[stdid]','$msf[exstid]','".mysql_real_escape_string($_POST['nexemination'])."','".mysql_real_escape_string($_POST['group1'])."','".mysql_real_escape_string($_POST['board'])."','".mysql_real_escape_string($_POST['passyear'])."','".mysql_real_escape_string($_POST['cgpas'])."','".mysql_real_escape_string($_POST['tcgpa'])."','".mysql_real_escape_string($_POST['gcsubject'])."','$_SESSION[userid]','".date("Y-m-d")."','I','".mysql_real_escape_string($_POST['othtrade'])."')";
   
    if($ein=$myDb->insert_sql($ei)){
		$msg="Student information successfully saved.";
		header("Location:manage_student.php?msg=$msg");
    }else{
	    $msg=$myDb->last_error;
		header("Location:manage_student.php?msg=$msg");
    }			
 
 
 }else{
     $msg="Sorry,you are not authorized to access this page";
 }	 

}else{
  header("Location:index.php");
}
}