<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){ 
	$opby=mysql_real_escape_string($_SESSION['userid']);
	$maxval=mysql_real_escape_string($_POST['maxval']);
	$fine=mysql_real_escape_string($_POST['fine']);
	$totaldays=mysql_real_escape_string($_POST['totaldays']);
	$stdfine=mysql_real_escape_string($_POST['stdfine']);
	$teacherfine=mysql_real_escape_string($_POST['teacherfine']);

    $query="INSERT INTO  tbl_libsetting(`maxallow`,`fine`,`totaldays`,`opby`,`storedstatus`,`stdfine`,`teacherfine`) VALUES('$maxval','$fine','$totaldays','$opby','I','$stdfine','$teacherfine')";
	if($r=$myDb->insert_sql($query)){
	  $msg="Data inserted successfully";
	  echo $msg;
	}else{
	  $msg=$myDb->last_error;  
	  echo $msg;
	}  

}else{
  header("Location:index.php");
}
}