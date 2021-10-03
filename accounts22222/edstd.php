<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='stdinfo.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  
  $id=mysql_real_escape_string($_GET['id']);
  $ed="SELECT*FROM tbl_stdinfo WHERE id='$id'";
  $edq=$myDb->select($ed);
  $esr=$myDb->get_row($edq,'MYSQL_ASSOC');

  if($_SERVER['REQUEST_METHOD']=="POST"){ 
  if($_POST['exstid']==""){
  $password=mysql_real_escape_string($_POST['password']);
  $sexstatus=mysql_real_escape_string($_POST['sexstatus']);
  /*$d=mysql_real_escape_string($_POST['d']);
  $m=mysql_real_escape_string($_POST['m']);
  $y=mysql_real_escape_string($_POST['y']);
  */
  $exstid=mysql_real_escape_string($_POST['exstid']);
  $stdname=mysql_real_escape_string($_POST['stdname']);
  $dob=mysql_real_escape_string($_POST['dob']);
  $session=mysql_real_escape_string($_POST['session']);
  $bgroup=mysql_real_escape_string($_POST['bgroup']);
  $deptname=mysql_real_escape_string($_POST['deptname']);
  $fname=mysql_real_escape_string($_POST['fname']);
  $hostel=mysql_real_escape_string($_POST['hostel']);
  $mname=mysql_real_escape_string($_POST['mname']);
  $gname=mysql_real_escape_string($_POST['gname']);
  $nationality=mysql_real_escape_string($_POST['nationality']);
  $praddress=mysql_real_escape_string($_POST['praddress']);
  $peraddress=mysql_real_escape_string($_POST['peraddress']);
  $religion=mysql_real_escape_string($_POST['religion']);
  $phone=mysql_real_escape_string($_POST['phone']);
  
  
  if($exstid){
     copy($_FILES[img][tmp_name],"uploads/".$esr['img']);			 
     if(!$_FILES[img][tmp_name]){
         $ins="UPDATE tbl_stdinfo SET  exstid='$exstid',      stdname='$stdname',password='$password',sexstatus='$sexstatus',dob='$dob',session='$session',bgroup='$bgroup',deptname='$deptname',fname='$fname',hostel='$hostel',mname='$mname',gname='$gname',nationality='$nationality',praddress='$praddress',peraddress='$peraddress',religion='$religion',phone='$phone',opby='$_SESSION[userid]',opdate='".date("Y-m-d")."',storedstatus='U' WHERE id='$id'";						 
	                $sin=$myDb->update_sql($ins);
	                $msg="Student information updated successfully";
					header("Location:edit_stdinfo.php?msg=$msg&id=$id");
	 }else{
         $ins="UPDATE tbl_stdinfo SET  exstid='$exstid',      stdname='$stdname',password='$password',sexstatus='$sexstatus',dob='$dob',session='$session',bgroup='$bgroup',deptname='$deptname',fname='$fname',hostel='$hostel',mname='$mname',gname='$gname',nationality='$nationality',praddress='$praddress',peraddress='$peraddress',religion='$religion',phone='$phone',opby='$_SESSION[userid]',opdate='".date("Y-m-d")."',storedstatus='U',img='$esr[img]' WHERE id='$id'";						 
	                $sin=$myDb->update_sql($ins);
	                $msg="Student information updated successfully";
					header("Location:edit_stdinfo.php?msg=$msg&id=$id");
	 }				 
  }else{
     copy($_FILES[img][tmp_name],"uploads/".$esr['img']);			 
     if(!$_FILES[img][tmp_name]){
         $ins="UPDATE tbl_stdinfo SET       stdname='$stdname',password='$password',sexstatus='$sexstatus',dob='$dob',session='$session',bgroup='$bgroup',deptname='$deptname',fname='$fname',hostel='$hostel',mname='$mname',gname='$gname',nationality='$nationality',praddress='$praddress',peraddress='$peraddress',religion='$religion',phone='$phone',opby='$_SESSION[userid]',opdate='".date("Y-m-d")."',storedstatus='U' WHERE id='$id'";						 
	                $sin=$myDb->update_sql($ins);
	                $msg="Student information updated successfully";
					header("Location:edit_stdinfo.php?msg=$msg&id=$id");
	}else{
         $ins="UPDATE tbl_stdinfo SET       stdname='$stdname',password='$password',sexstatus='$sexstatus',dob='$dob',session='$session',bgroup='$bgroup',deptname='$deptname',fname='$fname',hostel='$hostel',mname='$mname',gname='$gname',nationality='$nationality',praddress='$praddress',peraddress='$peraddress',religion='$religion',phone='$phone',opby='$_SESSION[userid]',opdate='".date("Y-m-d")."',storedstatus='U',img='$esr[img]' WHERE id='$id'";						 
	                $sin=$myDb->update_sql($ins);
	                $msg="Student information updated successfully";
					header("Location:edit_stdinfo.php?msg=$msg&id=$id");
	}				
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
}  
?>
