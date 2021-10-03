<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='depname.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
    $id=mysql_real_escape_string($_GET['id']);

    $chkstd="SELECT d.id did,s.deptname deptname
             FROM tbl_department d
             INNER  JOIN tbl_stdinfo s 
             ON d.id=s.deptname
			 WHERE d.id='$id'

             UNION
             SELECT d.id did,b.depcode deptname
             FROM tbl_department d
             INNER JOIN tbl_batch b
             ON d.id=b.depcode
			 WHERE d.id='$id'
			 
             UNION
             SELECT d.id did,c.departmentid deptname
             FROM tbl_department d
             INNER JOIN tbl_courses c
             ON d.id=c.departmentid
			 WHERE d.id='$id'
			 
             UNION 
             SELECT d.id did,sc.deptid deptname
             FROM tbl_department d
             INNER JOIN tbl_semesterwisesubj sc
             ON d.id=sc.deptid
             WHERE d.id='$id';
			 
			 UNION 
             SELECT d.id did,sf.deptid deptname
             FROM tbl_department d
             INNER JOIN tbl_staffinfo sf
             ON d.id=sf.deptid
             WHERE d.id='$id'";
			 
	$stds=$myDb->select($chkstd);
	$stdq=$myDb->get_row($stds,'MYSQL_ASSOC');
  
  
  
    if(($stdq['did']==$stdq['deptname'])&&($stdq['did']!="")&&($stdq['deptname']!="")){  
	
	   $msg="Intrigrity constant error,you can not delete master record,please delete details record first then delete master";
       header("Location:depname.html?msg=$msg");	
	}else{
  
	   $qup="UPDATE  tbl_department SET `storedstatus`='D' WHERE `id`='$id'";
	   if($myDb->update_sql($qup)){
	      $msg="Data deleted successfully";
          header("Location:depname.php?msg=$msg");	
	   }else{
	      $msg=$myDb->last_error;
          header("Location:depname.php?msg=$msg");	
	   }	  
	}   

   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}  