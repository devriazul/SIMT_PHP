<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='semesterinfo.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['delt']=="y"){
	$id=mysql_real_escape_string($_GET['id']);
	$chk="SELECT sm.id semid,s.semester semesterid
	      FROM tbl_semester sm
		  INNER JOIN tbl_stdinfo s
		  ON sm.id=s.semester
		  WHERE sm.id='$id'
		  
		  UNION
		  SELECT sm.id semid,sw.semesterid semesterid
		  FROM tbl_semester sm
		  INNER JOIN tbl_semesterwisesubj sw
		  ON sm.id=sw.semesterid
		  WHERE sm.id='$id'		  
		  ";
	$chkq=$myDb->select($chk);
	$chr=$myDb->get_row($chkq,'MYSQL_ASSOC');	  
	
    if(($chr['semid']==$chr['semesterid'])&&($chr['semid']!="")&&($chr['semesterid']!="")){  
	
	   $msg="Intrigrity constant error,you can not delete master record,please delete details record first then delete master";
       header("Location:semesterinfo.php?msg=$msg");	
	}else{
	
       $qup="UPDATE tbl_semester SET `storedstatus`='D' WHERE `id`='$id'";
	   $upd=$myDb->update_sql($qup);
	   $msg="Data deleted successfully";
       header("Location:semesterinfo.php?msg=$msg");
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