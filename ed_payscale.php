<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managepayscale.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
    
	$name=mysql_real_escape_string(ucfirst($_POST['name']));
	$desigid=mysql_real_escape_string(ucfirst($_POST['desigid']));
	$basicsalary=mysql_real_escape_string(ucfirst($_POST['basicsalary']));
	$houserent=mysql_real_escape_string(ucfirst($_POST['houserent']));
	$medicalallow=mysql_real_escape_string(ucfirst($_POST['medicalallow']));
	$transportallow=mysql_real_escape_string(ucfirst($_POST['transportallow']));
	$otherallow=mysql_real_escape_string(ucfirst($_POST['otherallow']));
	$remarks=mysql_real_escape_string($_POST['remarks']);

	$id=mysql_real_escape_string($_GET['id']);
	$qup="UPDATE tbl_payscale SET `name`='$name',`designationid`='$desigid',`basicpay`='$basicsalary',`houserent`='$houserent',`medicalallow`='$medicalallow',`transportallow`='$transportallow',`otherallow`='$otherallow',`remarks`='$remarks',`storedstatus`='U',opby='$_SESSION[userid]' WHERE `id`='$id'";
	$upd=$myDb->update_sql($qup);
	$f=true;
	$msg="Data Updated Successfully";
	echo $msg;
    //header("Location:managepayscale.php?msg=$msg");
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 echo $msg;
	 //header("Location:home.html?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}