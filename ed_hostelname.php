<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='hostelname.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
    $code=mysql_real_escape_string(strtoupper($_POST['code1']));
	$name=mysql_real_escape_string(ucfirst($_POST['name1']));
	$address=mysql_real_escape_string($_POST['address']);
	$noofseats=mysql_real_escape_string($_POST['noofseats']);
	$id=mysql_real_escape_string($_GET['id']);
	$qup="UPDATE tbl_hostel SET `code`='$code',`name`='$name',`address`='$address',`noofseats`='$noofseats',`storedstatus`='U',opby='$_SESSION[userid]' WHERE `id`='$id'";
	$upd=$myDb->update_sql($qup);
	$msg="Data updated successfully";
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