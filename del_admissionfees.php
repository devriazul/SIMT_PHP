<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_admissionfees.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
	$id=mysql_real_escape_string($_GET['id']);
	$opdate=date("Y-m-d");
    $query="DELETE FROM tbl_feescollection WHERE id='$id'";
	if($r=$myDb->update_sql($query)){
	   $t=1;
	   $msg="Data deleted successfully";
	   header("Location:manage_admissionfees.html?msg=$msg&t=1");
	  
    }else{
	   $t=0;
	   $msg=$myDb->last_error;
	   header("Location:manage_admissionfees.html?msg=$msg&t=0");
		
	} 			
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.html?msg=$msg");
   }	 

}else{
  header("Location:login.html");
}
}  
?>