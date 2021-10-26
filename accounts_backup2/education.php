<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_student.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  
       $id=mysql_real_escape_string($_GET['id']);
       $stdname=mysql_real_escape_string($_GET['stdname']);
       $query="SELECT id,stdid as 'Student ID',exstid as 'Existing Student ID',nexemination as 'Name of Exemination',group1 as 'Group',board as Board,passyear as 'Pass Year'
	           ,gcsubject as 'Subject Name',cgpas as 'Got CGPA',tcgpa as 'Total CGPA' FROM  tbl_educationalq WHERE stdtid='$id'";
        //$r=$myDb->select_one($query);
                //$sdq="select * from tbl_accchart where accname='$accname' AND storedstatus='I' OR storedstatus='U' order by id asc";
			    $sdep=$myDb->dump_query($query,'edit_education.php','del_education.php',$car['upd'],$car['delt']);

   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>
