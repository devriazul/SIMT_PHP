<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managemarksdistribution.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
    
	$departmentid=mysql_real_escape_string(ucfirst($_POST['deptid']));
	$courseid=mysql_real_escape_string(ucfirst($_POST['courseid']));
	$markstype=mysql_real_escape_string(ucfirst($_POST['dtype']));
	$totalmarks=mysql_real_escape_string(ucfirst($_POST['totalmarks']));
	/*$classtest=mysql_real_escape_string(ucfirst($_POST['classtest']));
	$je=mysql_real_escape_string(ucfirst($_POST['je']));
	$jer=mysql_real_escape_string(ucfirst($_POST['jer']));
	$jev=mysql_real_escape_string(ucfirst($_POST['jev']));

	$homework=mysql_real_escape_string(ucfirst($_POST['homework']));
	$quiz=mysql_real_escape_string(ucfirst($_POST['quiz']));
	$behaviour=mysql_real_escape_string(ucfirst($_POST['behavior']));
	$attendance=mysql_real_escape_string(ucfirst($_POST['attendance']));
	*/
	$id=mysql_real_escape_string($_GET['id']);
	
	$opdate=date("Y-m-d");
	//$qup="UPDATE tbl_marksdistribution SET `departmentid`='$departmentid',`courseid`='$courseid',`markstype`='$markstype',`totalmarks`='$totalmarks',`classtest`='$classtest',`quiz`='$quiz',`behaviour`='$behaviour',`attendance`='$attendance',`homework`='$homerork',`jobexpr`='$je',`jobexprreport`='$jer',`jobexprviva`='$jev',`opby`='$_SESSION[userid]',`opdate`='$opdate',`storedstatus`='U' WHERE `id`='$id'";
	$qup="UPDATE tbl_marksdistribution SET `departmentid`='$departmentid',`courseid`='$courseid',`markstype`='$markstype',`totalmarks`='$totalmarks',`opby`='$_SESSION[userid]',`opdate`='$opdate',`storedstatus`='U' WHERE `id`='$id'";
	
	

	if($upd=$myDb->update_sql($qup))
	{
		$msg="Data Updated Successfully";
		//echo $msg;
    	header("Location:managemarksdistribution.php?msg=$msg");
	}
	else
	{
		$msg=$myDb->last_error;
   		header("Location:managemarksdistribution.php?msg=$msg");
	}
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 echo $msg;
	 //header("Location:home.html?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}