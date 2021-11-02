<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managedesignation.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
	$id=mysql_real_escape_string($_GET['id']);
	$htq="SELECT d.id did,d.name dname,p.designationid designationid 
	      FROM tbl_designation d
		  INNER JOIN tbl_payscale p
		  ON d.id=p.designationid
		  WHERE d.id='$id'";
	$htr=$myDb->select($htq);
	$htrow=$myDb->get_row($htr,'MYSQL_ASSOC');	  
	
	if(($htrow['did']==$htrow['designationid'])&&($htrow['did']!="")&&($htrow['designationid']!="")){
	   $msg="Intrigrity constant error,you can not delete master record,please delete details record first then delete master";
       header("Location:managedesignation.php?msg=$msg");
	}else{
	   
	   $qup="UPDATE tbl_designation SET `storedstatus`='D' WHERE `id`='$id'";
	   $upd=$myDb->update_sql($qup);
	   $msg="Data deleted successfully";
       header("Location:managedesignation.php?msg=$msg");
	}   
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}