<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='depname.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){	
  
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

			 WHERE d.id='$id'";
	$stds=$myDb->select($chkstd);
	$stdq=$myDb->get_row($stds,'MYSQL_ASSOC');
  
  
  
    if(($stdq['did']==$stdq['deptname'])&&($stdq['did']!="")&&($stdq['deptname']!="")){  
	
	   $msg="Intrigrity constant error,you can not delete master record,please delete details record first then delete master";
       header("Location:depname.php?msg=$msg");	
	}else{
  
	   $qup="UPDATE  tbl_department SET `storedstatus`='D' WHERE `id`='$id'";
	   $upd=$myDb->update_sql($qup);
	   $msg="Data deleted successfully";
       header("Location:depname.php?msg=$msg");	
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
