<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='stdinfo.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['delt']=="y"){
	$id=mysql_real_escape_string($_GET['id']);
	
	
	$chks="SELECT s.id stid, e.stdtid stdtid
           FROM tbl_stdinfo s
           INNER JOIN tbl_educationalq e 
		   ON s.id = e.stdtid
		   WHERE s.id='$id'
		   
		   UNION
		   SELECT s.id stid, f.stid stdtid
           FROM tbl_stdinfo s
           INNER JOIN tbl_feescollection f 
		   ON s.id = f.stid
		   WHERE s.id='$id'";
	$chsq=$myDb->select($chks);
	$chsr=$myDb->get_row($chsq,'MYSQL_ASSOC');	   
		   
    if(($chsr['stid']==$chsr['stdtid'])&&($chsr['stid']!="")&&($chsr['stdtid']!="")){  
	
	   $msg="Intrigrity constant error,you can not delete master record,please delete details record first then delete master";
       header("Location:manage_student.php?msg=$msg");	
	}else{
  
	   $qup="UPDATE tbl_stdinfo SET `storedstatus`='D' WHERE `id`='$id'";
	   $upd=$myDb->update_sql($qup);
	   $msg="Data deleted successfully";
       header("Location:manage_student.php?msg=$msg");	
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
