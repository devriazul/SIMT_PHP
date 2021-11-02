<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manageemployeesalary.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
	$monthname=mysql_real_escape_string($_POST['monthname']);
	$yearname=mysql_real_escape_string($_POST['yearname']);
	$tworkingdays=mysql_real_escape_string($_POST['workingdays']);
	//$efid=mysql_real_escape_string($_POST['efid']);
	//$efname=mysql_real_escape_string($_POST['efname']);
	//$desig=mysql_real_escape_string($_POST['desig']);
	//$payscale=mysql_real_escape_string($_POST['payscale']);
	$lateattnd=mysql_real_escape_string($_POST['lateattnd']);
	$absinoffice=mysql_real_escape_string($_POST['absinoffice']);
	$totabs=mysql_real_escape_string($_POST['totabs']);
	$totleave=mysql_real_escape_string($_POST['totleave']);
	$basicpay=mysql_real_escape_string($_POST['basicpay']);
	$houserent=mysql_real_escape_string($_POST['houserent']);
	$medallow=mysql_real_escape_string($_POST['medallow']);
	$tada=mysql_real_escape_string($_POST['tada']);
	$otherallow=mysql_real_escape_string($_POST['otherallow']);
	$gsalary=mysql_real_escape_string($_POST['gsalary']);
	$increment=mysql_real_escape_string($_POST['increment']);
	$securitymoney=mysql_real_escape_string($_POST['securitymoney']);
	$dedperday=mysql_real_escape_string($_POST['dedperday']);
	$totded=mysql_real_escape_string($_POST['totded']);
	$pfp=mysql_real_escape_string($_POST['pfp']);
	$pfa=mysql_real_escape_string($_POST['pfa']);
	$fb=mysql_real_escape_string($_POST['fb']);
	$netpay=mysql_real_escape_string($_POST['netpay']);
	$remarks=mysql_real_escape_string($_POST['remarks']);
	
	$opdate=date("Y-m-d");
	$id=$_GET['id'];
 	$qup="UPDATE `simtdb`.`tbl_employeesalary` SET `monthname` = '$monthname', `yearname` = '$yearname ', `tworkingdays` = '$tworkingdays', `lateattendance` = '$lateattnd', `absentinoffice` = '$absinoffice', `totalabsent` = '$totabs', `totalleave` = '$totleave', `basicpay` = '$basicpay', `houserent` = '$houserent', `medicalallow` = '$medallow', `tada` = '$tada', `otherallow` = '$otherallow', `grosssalary` = '$gsalary', `increment` = '$increment', `securitymoney` = '$securitymoney', `dedperday` = '$dedperday', `totded` = '$totded', `pfundpercent` = '$pfp', `pfundamount` = '$pfa', `festivalbouns` = '$fb', `netpay` = '$netpay', `remarks`='$remarks', `opby`='$_SESSION[userid]' WHERE `id`='$id'"; 


	if($myDb->update_sql($qup)){
	   $msg="Data updated successfully";
	header("Location:edit_employeesalary.php?msg=$msg&id=$id");
	}else{
	   $msg=$myDb->last_error;
	 header("Location:edit_employeesalary.php?msg=$msg&id=$id");
	}
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}