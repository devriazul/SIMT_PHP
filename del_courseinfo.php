<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managecourseinformation.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['delt']=="y"){
  $id=mysql_real_escape_string($_GET['id']);
   $chkstd=" SELECT c.id crsid,d.crid coursename
             FROM tbl_courses c
             INNER  JOIN tbl_dep_mark_dis d 
             ON c.id=d.crid
			 WHERE c.id='$id'

             UNION
             SELECT c.id crsid,s.courseid coursename
             FROM tbl_courses c
             INNER  JOIN tbl_semesterwisesubj s 
             ON c.id=s.courseid
			 WHERE c.id='$id'
			 
             UNION
             SELECT c.id crsid,ss.courseid coursename
             FROM tbl_courses c
             INNER  JOIN tbl_studwisesubject ss 
             ON c.id=ss.courseid
			 WHERE c.id='$id'
			 ";
			 
	$stds=$myDb->select($chkstd);
	$stdq=$myDb->get_row($stds,'MYSQL_ASSOC');

     if(($stdq['crsid']==$stdq['coursename'])&&($stdq['crsid']!="")&&($stdq['coursename']!="")){  
	
	   $msg="Intrigrity constant error,you can not delete master record,please delete details record first then delete master";
       header("Location:managecourseinformation.html?msg=$msg");	
	}else{
  
	   $qup="UPDATE  tbl_courses SET `storedstatus`='D' WHERE `id`='$id'";
	   if($myDb->update_sql($qup)){
	      $msg="Data deleted successfully";
          header("Location:managecourseinformation.php?msg=$msg");
	   }else{
	      $msg=$myDb->last_error;
		  echo $msg;
	   }	  	  	
	}   
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>