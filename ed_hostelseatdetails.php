<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managehostelseatdetails.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
    
	$hostelid=mysql_real_escape_string(ucfirst($_POST['hostelid']));
	$roomid=mysql_real_escape_string(ucfirst($_POST['roomid']));
	$seatno=mysql_real_escape_string(ucfirst($_POST['seatno']));
	$price=mysql_real_escape_string(ucfirst($_POST['price']));
	$mealcharge=mysql_real_escape_string(ucfirst($_POST['mealcharge']));
	$opdate=date("Y-m-d");

	$id=mysql_real_escape_string($_GET['id']);
	$qup="UPDATE tbl_hostelseatdetails SET `seatno`='$seatno', `price`='$price', `mealcharge`='$mealcharge', `storedstatus`='U', `opdate`='$opdate', `opby`='$_SESSION[userid]' WHERE `id`='$id'";
	$upd=$myDb->update_sql($qup);
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