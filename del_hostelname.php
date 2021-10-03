<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='hostelname.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
	$id=mysql_real_escape_string($_GET['id']);
	$htq="SELECT h.id hid,h.code hcode,s.hostel shostel,s.hostelid shostelid 
	      FROM tbl_hostel h
		  INNER JOIN tbl_stdinfo s
		  ON h.id=s.hostelid
		  WHERE h.code=s.hostel
		  AND h.id='$id'";
	$htr=$myDb->select($htq);
	$htrow=$myDb->get_row($htr,'MYSQL_ASSOC');	  
	
	if(($htrow['hid']==$htrow['shostelid'])&&($htrow['hid']!="")&&($htrow['shostelid']!="")){
	   $msg="Intrigrity constant error,you can not delete master record,please delete details record first then delete master";
       header("Location:hostelname.php?msg=$msg");
	}else{
	   
	   $qup="UPDATE tbl_hostel SET `storedstatus`='D' WHERE `id`='$id'";
	   $upd=$myDb->update_sql($qup);
	   $msg="Data deleted successfully";
       header("Location:hostelname.php?msg=$msg");
	}   
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}  