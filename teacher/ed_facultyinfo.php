<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  
  /*$chka="SELECT*FROM  tbl_accdtl WHERE flname='managefacultyinfo.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  */
    
	//$fid=mysql_real_escape_string(ucfirst($_POST['fid']));
	//$pass=mysql_real_escape_string(md5($_POST['pass']));
	$name=mysql_real_escape_string(ucfirst($_POST['name']));
	$sex=mysql_real_escape_string(ucfirst($_POST['sex']));
	$paddress=mysql_real_escape_string(ucfirst($_POST['paddress']));
	$deptid=mysql_real_escape_string(ucfirst($_POST['deptid']));
	//$desigid=mysql_real_escape_string(ucfirst($_POST['desigid']));
	//$jdate=mysql_real_escape_string(ucfirst($_POST['jdate']));
	$expsub=mysql_real_escape_string(ucfirst($_POST['expsub']));
	$eduq=mysql_real_escape_string(ucfirst($_POST['eduq']));
	$eyear=mysql_real_escape_string(ucfirst($_POST['eyear']));
	$emonth=mysql_real_escape_string(ucfirst($_POST['emonth']));
	$contactno=mysql_real_escape_string(ucfirst($_POST['contactno']));
	$emptype=mysql_real_escape_string(ucfirst($_POST['emptype']));
	//$payscaleid=mysql_real_escape_string(ucfirst($_POST['payscaleid']));
	$fname=mysql_real_escape_string(ucfirst($_POST['fname']));
	$mname=mysql_real_escape_string(ucfirst($_POST['mname']));
	$dob=mysql_real_escape_string(ucfirst($_POST['dob']));
	$mstatus=mysql_real_escape_string(ucfirst($_POST['mstatus']));
	$bg=mysql_real_escape_string($_POST['bg']);
	$opdate=date("Y-m-d");
	
	$id=mysql_real_escape_string($_SESSION['userid']);
	$qup="UPDATE tbl_faculty SET `name`='$name',`fname`='$fname',`mname`='$mname',`sex`='$sex',`dob`='$dob',`mstatus`='$mstatus',`bloodgroup`='$bg',`address`='$paddress',`deptid`='$deptid',`expartincourse`='$expsub',`eduqualification`='$eduq',`contactno`='$contactno',`storedstatus`='U' WHERE `facultyid`='$id'";
	$upd=$myDb->update_sql($qup);
	//$f=true;
	$msg="Data Updated Successfully";
	//echo $msg;
    header("Location:facultypersonalinfo.php?msg=$msg");
  /* }else{
     $msg="Sorry,you are not authorized to access this page";
	 echo $msg;
	 //header("Location:home.html?msg=$msg");
   }	 
*/
  $myDb->__destruct();
	   

}else{
  header("Location:index.php");
}
}  
?>