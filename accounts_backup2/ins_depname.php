<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
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
	$opdate=date("Y-m-d");
	/*
	echo $code;"\n";
	echo $name;"\n";
	echo $description;
	exit;
	*/
    $query="INSERT INTO  tbl_department(`code`,`name`,`admissionfee`,`labfee`,`libraryfee`,`idcardfee`,`regifee`,`onetimefee`,`noofsemester`,`semesterfee`,`noofmonths`,`tuitionfee`,`credit`,`description`,opby,opdate,storedstatus) VALUES('$code','$name','$admissionfee','$labfee','$libraryfee','$idcardfee','$regifee','$onetimefee','$noofsemester','$semesterfee','$noofmonths','$tuitionfee','$description','$_SESSION[userid]','$opdate','I')";
	$r=$myDb->insert_sql($query);
	$msg="Data inserted successfully";
	header("Location:depname.php?msg=$msg");
}else{
  header("Location:login.php");
}
}  
?>