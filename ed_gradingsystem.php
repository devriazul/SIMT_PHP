<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managegradingsystem.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
    
	$lmarks=mysql_real_escape_string(ucfirst($_POST['lmarks']));
	$umarks=mysql_real_escape_string(ucfirst($_POST['umarks']));
	$grade=mysql_real_escape_string(ucfirst($_POST['grade']));
	$gpoint=mysql_real_escape_string(ucfirst($_POST['gpoint']));
	$opdate=date('Y-m-d');
	$uname=$_SESSION['userid'];

	$id=mysql_real_escape_string($_GET['id']);
	$qup="UPDATE tbl_gradesystem SET `lowermarks`='$lmarks',`uppermarks`='$umarks',`latergrade`='$grade', `gradepoint`='$gpoint', `opby`='$uname',`storedstatus`='U', `opdate`='$opdate' WHERE `id`='$id'";
	$upd=$myDb->update_sql($qup);
	//$f=true;
	$msg="Data Updated Successfully";
	echo $msg;
    //header("Location:managegradingsystem.php?msg=$msg");
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 echo $msg;
	 //header("Location:home.html?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}