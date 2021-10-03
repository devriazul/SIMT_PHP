<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){ 
    $code=mysql_real_escape_string(strtoupper($_POST['code']));
	$name=mysql_real_escape_string(ucfirst($_POST['name']));
	$admissionfee=mysql_real_escape_string($_POST['admissionfee']);
	$labfee=mysql_real_escape_string($_POST['labfee']);
	$libraryfee=mysql_real_escape_string($_POST['libraryfee']);
	$idcardfee=mysql_real_escape_string($_POST['idcardfee']);
	$regifee=mysql_real_escape_string($_POST['regifee']);
	$onetimefee=mysql_real_escape_string($_POST['onetimefee']);
	$noofsemester=mysql_real_escape_string($_POST['noofsemester']);
	$semesterfee=mysql_real_escape_string($_POST['semesterfee']);
	$noofmonths=mysql_real_escape_string($_POST['noofmonths']);
	$tuitionfee=mysql_real_escape_string($_POST['tuitionfee']);
	$credit=mysql_real_escape_string($_POST['credit']);
	$description=mysql_real_escape_string($_POST['description']);
	$admform=mysql_real_escape_string($_POST['admform']);
	$rcvbook=mysql_real_escape_string($_POST['rcvbook']);
	$opdate=date("Y-m-d");

    $query="INSERT INTO  tbl_department(`code`,`name`,`admissionfee`,`labfee`,`libraryfee`,`idcardfee`,`regifee`,`onetimefee`,`noofsemester`,`semesterfee`,`noofmonths`,`tuitionfee`,`credit`,`description`,opby,opdate,storedstatus,admform,rcvbook) VALUES('$code','$name','$admissionfee','$labfee','$libraryfee','$idcardfee','$regifee','$onetimefee','$noofsemester','$semesterfee','$noofmonths','$tuitionfee','$credit','$description','$_SESSION[userid]','$opdate','I','$admform','$rcvbook')";
	if($r=$myDb->insert_sql($query)){
	  $msg="Data inserted successfully";
	  echo $msg;
	}else{
	  $msg=$myDb->last_error;  
	  echo $msg;
	}  

}else{
  header("Location:login.html");
}
}  
?>