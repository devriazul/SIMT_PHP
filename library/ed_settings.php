<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){ 
	$opby=mysql_real_escape_string($_SESSION['userid']);
	$id=mysql_real_escape_string($_POST['id']);
	$maxallow=mysql_real_escape_string($_POST['maxval']);
	$fine=mysql_real_escape_string($_POST['fine']);
	$totaldays=mysql_real_escape_string($_POST['totaldays']);
	$stdfine=mysql_real_escape_string($_POST['stdfine']);
	$teacherfine=mysql_real_escape_string($_POST['teacherfine']);

    $query="UPDATE tbl_libsetting SET `maxallow`='$maxallow',`fine`='$fine',
									  `totaldays`='$totaldays',`opby`='$opby',
									  `storedstatus`='U',`stdfine`='$stdfine',
									  `teacherfine`='$teacherfine' 
									  WHERE id='$id'";
	if($r=$myDb->update_sql($query)){
	  $msg="Data updated successfully";
	  echo $msg;
	}else{
	  $msg=$myDb->last_error;  
	  echo $msg;
	}  

}else{
  header("Location:index.php");
}
}