<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_venue.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
   $venuname=mysql_real_escape_string($_POST['venuname']);
   $roomno=mysql_real_escape_string($_POST['roomno']);
   $orderid=mysql_real_escape_string($_POST['orderid']);
   $id=!empty($_POST['id'])?mysql_real_escape_string($_POST['id']):'';
   if(!empty($id)){
   		$myDb->update_sql("UPDATE tbl_venue SET venuname='$venuname', orderid='$orderid',roomno='$roomno' where id='$id'");
		echo "<div style='width:500px; padding:5px; height:25px;background-color:#999999; color:#FFFFFF;font-size:13px;'>Record successfully updated</div>";
   }else{
	   if($myDb->insert_sql("INSERT INTO tbl_venue(venuname,roomno,orderid)VALUES('$venuname','$roomno','$orderid')")){
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