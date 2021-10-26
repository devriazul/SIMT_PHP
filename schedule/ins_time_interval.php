<?php ob_start();
session_start();

<<<<<<< HEAD
include("config.php"); 
=======
include('../config.php');  
>>>>>>> f3fe93dba8d28723d8594a1151c137b47a7928b5
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_time_interval.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
   $intervalName=mysql_real_escape_string($_POST['intervalName']);
   $orderid=mysql_real_escape_string($_POST['orderid']);
   $ordernum=mysql_real_escape_string($_POST['ordernum']);
   $id=!empty($_POST['id'])?mysql_real_escape_string($_POST['id']):'';
   $yrpart=!empty($_POST['yrpart'])?mysql_real_escape_string($_POST['yrpart']):'';
   
   if(!empty($id)){
   		$myDb->update_sql("UPDATE tbl_time_interval SET intervalName='$intervalName', orderid='$orderid',ordernum='$ordernum',yrpart='$yrpart' where id='$id'");
		echo "<div style='width:500px; padding:5px; height:25px;background-color:#999999; color:#FFFFFF;font-size:13px;'>Record successfully updated</div>";
   }else{
	   if($myDb->insert_sql("INSERT INTO tbl_time_interval(intervalName,ordernum,orderid,yrpart)VALUES('$intervalName','$ordernum','$orderid','$yrpart')")){
		  echo "<div style='width:500px; padding:5px; height:25px;background-color:#999999; color:#FFFFFF;font-size:13px;'>Record successfully saved</div>";
	   }else{
		  echo $myDb->last_error;
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