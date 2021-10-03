<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managedesignation.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
    
	$name=mysql_real_escape_string(ucfirst($_POST['name']));
	$description=mysql_real_escape_string($_POST['desc']);

	$id=mysql_real_escape_string($_GET['id']);
	$qup="UPDATE tbl_designation SET `name`='$name',`description`='$description',`storedstatus`='U',opby='$_SESSION[userid]', torder='$_POST[order]' WHERE `id`='$id'";
	$upd=$myDb->update_sql($qup);
	$msg="Data Updated Successfully";
	echo $msg;
    //header("Location:hostelname.html?msg=$msg");
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 echo $msg;
	 //header("Location:home.html?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}