<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){ 
	$opby=mysql_real_escape_string($_SESSION['userid']);
	$courseid=mysql_real_escape_string($_GET['courseid']);
	$isbnno=mysql_real_escape_string($_POST['isbnno']);
	$author=mysql_real_escape_string($_POST['author']);
	$publisher=mysql_real_escape_string($_POST['publisher']);
	$edition=mysql_real_escape_string($_POST['edition']);
	$deptid=mysql_real_escape_string($_POST['deptid']);
	$selfid=mysql_real_escape_string($_POST['selfid']);
	$noofrow=mysql_real_escape_string($_POST['noofrow']);
	$price=mysql_real_escape_string($_POST['price']);
	$totalbook=mysql_real_escape_string($_POST['totalbook']);

    $query="INSERT INTO tbl_bookentry(`courseid`,`deptid`,`isbnno`,`author`,`publisher`,
			              `edition`,`selfid`,`rowno`,`price`,`opby`,`storedstatus`,`totalbook`)            
			VALUES('$courseid','$deptid','$isbnno','$author','$publisher','$edition','$selfid','$noofrow','$price','$opby','I','$totalbook')";
	if($r=$myDb->insert_sql($query)){
	  $msg="Data inserted successfully";
	  echo $msg;
	}else{
	  $msg=$myDb->last_error;  
	  echo $msg;
	}  

}else{
  header("Location:login.php");
}
}  
?>