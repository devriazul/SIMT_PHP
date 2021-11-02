<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='semesterinfo.php' AND userid='$_SESSION[userid]'"; 
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['upd']=="y")||($_SESSION['userid']=="administrator")){
    $name=mysql_real_escape_string(strtoupper($_POST['name']));
	$period=mysql_real_escape_string($_POST['period']);
	$totcredit=mysql_real_escape_string($_POST['totcredit']);
	$description=mysql_real_escape_string($_POST['desc']);
	$id=mysql_real_escape_string($_GET['id']);
	$qup="UPDATE  tbl_semester SET `name`='$name',`period`='$period',`totalcredit`='$totcredit',`description`='$description',`storedstatus`='U',opby='$_SESSION[userid]' WHERE `id`='$id'";
	$upd=$myDb->update_sql($qup);
	$msg="Data updated successfully";
    echo $msg;
	//header("Location:semesterinfo.html?msg=$msg");
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 echo $msg;
	 //header("Location:home.html?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}