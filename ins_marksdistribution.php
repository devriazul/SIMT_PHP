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
	
	$opdate=date("Y-m-d");
    //$query="INSERT INTO   tbl_marksdistribution(`departmentid`,`courseid`,`markstype`,`totalmarks`,`classtest`,`quiz`,`behaviour`,`attendance`,`homework`,`jobexpr`,`jobexprreport`,`jobexprviva`,`opby`,`opdate`,`storedstatus`) VALUES('$departmentid','$courseid','$markstype','$totalmarks','$classtest','$quiz','$behaviour','$attendance','$homework','$je','$jer','$jev','$_SESSION[userid]','$opdate','I')";
	$query="INSERT INTO   tbl_marksdistribution(`departmentid`,`courseid`,`markstype`,`totalmarks`,`opby`,`opdate`,`storedstatus`) VALUES('$departmentid','$courseid','$markstype','$totalmarks','$_SESSION[userid]','$opdate','I')";
	
	if($myDb->insert_sql($query)){
	
	   $msg="Data inserted successfully";
	   echo $msg;
	}else{
	   $msg=$myDb->last_error;
	   echo $msg;
	}   
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 
	//header("Location:add_hostelname.html?msg=$msg");
}else{
  header("Location:index.php");
}
}