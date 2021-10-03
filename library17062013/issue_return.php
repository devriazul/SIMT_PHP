<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){ 
	$stdid=mysql_real_escape_string($_POST['stdid']);
	$opby=mysql_real_escape_string($_SESSION['userid']);
	$courseid=mysql_real_escape_string($_POST['courseid']);
	$bookid=mysql_real_escape_string($_POST['bookid']);
	$session=mysql_real_escape_string($_POST['session']);
	$issue=mysql_real_escape_string($_POST['issue']);
	
	$deptid=mysql_real_escape_string($_POST['deptid']);
	$semesterid=mysql_real_escape_string($_POST['semesterid']);
	
	$chkb=$myDb->select("SELECT*FROM tbl_bookissue WHERE stdid='$stdid' AND courseid='$courseid' AND bookid='$bookid' AND `return`<>'R' AND fine=0");
	$cbf=$myDb->get_row($chkb,'MYSQL_ASSOC');
	if(isset($cbf['stdid'])){
	
			$cdate=$myDb->select("select curdate() cdate");
			$cdatef=$myDb->get_row($cdate,'MYSQL_ASSOC');
			$rtu="UPDATE tbl_bookissue
				  SET rcvdate='$cdatef[cdate]',
				  `return`='R',
				  opby='$_SESSION[userid]',
				  storedstatus='U'
				  where stdid='$stdid'
				  and bookid='$bookid'
				  and courseid='$courseid'
				  ";
			if($ru=$myDb->update_sql($rtu)){
			   echo "Your book is return successfully";	  
			}else{
			   echo $myDb->last_error;
			} 
	}else{
	  echo "This book is not issued to you";
	}    	   
	
	
	
}else{
  header("Location:login.php");
}
}  
?>	
	