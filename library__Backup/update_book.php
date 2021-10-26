<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
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
	$bookid=mysql_real_escape_string($_GET['bookid']);

    $query="UPDATE tbl_bookentry SET `courseid`='$courseid'
	                                ,`deptid`='$deptid'
									,`isbnno`='$isbnno',
									`author`='$author'
									,`publisher`='$publisher',
			                         `edition`='$edition'
									 ,`selfid`='$selfid'
									 ,`rowno`='$noofrow'
									 ,`price`='$price'
									 ,`opby`='$opby'
									 ,`storedstatus`='U'
									 ,`totalbook`='$totalbook'
					WHERE bookid='$bookid'";            
	if($r=$myDb->update_sql($query)){
	  $msg="Data updated successfully";
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