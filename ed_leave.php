<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manageleave.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
    
	$name=mysql_real_escape_string(ucfirst($_POST['name']));
	$code=mysql_real_escape_string(ucfirst($_POST['code']));
	$dayscount=mysql_real_escape_string(ucfirst($_POST['dayscount']));
	$status=mysql_real_escape_string(ucfirst($_POST['status']));
	$remarks=mysql_real_escape_string($_POST['remarks']);
	$opdate=date('Y-m-d');

	$id=mysql_real_escape_string($_GET['id']);
	$qup="UPDATE tbl_leave SET `name`='$name',`code`='$code',`dayscount`='$dayscount', `status`='$status', `remarks`='$remarks',`storedstatus`='U', `opdate`='$opdate' WHERE `id`='$id'";
	$upd=$myDb->update_sql($qup);

	$qupld="UPDATE tbl_leavedetails SET `allocateddays`='$dayscount',`storedstatus`='U', `opdate`='$opdate' WHERE `ltype`='$code'";
	$updld=$myDb->update_sql($qupld);


	$f=true;
	$msg="Data Updated Successfully";
	echo $msg;
    //header("Location:managepayscale.php?msg=$msg");
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 echo $msg;
	 //header("Location:home.html?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}