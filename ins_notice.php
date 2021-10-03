<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){ 
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managenotice.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
	$adate=mysql_real_escape_string(ucfirst($_POST['adate']));
	$headline=mysql_real_escape_string(ucfirst($_POST['headline']));
	$desc=mysql_real_escape_string($_POST['desc']);
	$status=mysql_real_escape_string(ucfirst($_POST['status']));
	$noticefor=mysql_real_escape_string(ucfirst($_POST['noticefor']));
	//$remarks=mysql_real_escape_string($_POST['remarks']);
	
	$opdate=date("Y-m-d");
	
    $query="INSERT INTO   tbl_noticeboard(`headline`,`description`,`adate`,`status`,`opby`,`opdate`,`storedstatus`,`noticefor`) VALUES('$headline','$desc','$adate','$status','$_SESSION[userid]','$opdate','I','$noticefor')";
	
	if($myDb->insert_sql($query))
	{
   		$msg="Data inserted successfully";
   		header("Location:add_notice.php?msg=$msg");

	}
	else
	{
   		$msg=$myDb->last_error;
   		header("Location:add_notice.php?msg=$msg");

	}   
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 
}else{
  header("Location:index.php");
}
}  
?>