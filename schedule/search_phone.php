<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_time_interval.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
   
   $guideteacher=mysql_real_escape_string($_POST['guideteacher']);
   $agname=explode('->',$guideteacher);
   $arr=array();
   $arr=$agname;
   
   
   
   $phone=$myDb->select("SELECT*FROM tbl_faculty WHERE facultyid='$arr[0]'");
   $phonef=$myDb->get_row($phone,'MYSQL_ASSOC');
   echo $phonef['contactno'];
 }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
 }	 

}else{
  header("Location:index.php");
}
}