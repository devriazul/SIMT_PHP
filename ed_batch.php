<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_batch.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
    $id=mysql_real_escape_string($_GET['id']);
    $batchname=mysql_real_escape_string($_POST['batchname']);
	$session=mysql_real_escape_string($_POST['session']);
	$depcode=mysql_real_escape_string($_POST['depcode']);
	$opdate=date("Y-m-d");
	
    
	    $query="UPDATE tbl_batch
		               SET `batchname`='$batchname',
					       `session`='$session'
						   ,`depcode`='$depcode',
						   `opby`='$_SESSION[userid]',
						   `opdate`='$opdate',
						   `storedstatus`='U'
				where id='$id'";
	    if($r=$myDb->update_sql($query)){
	       $msg="Data updated successfully";
	       echo $msg;
	    }else{
	       $msg=$myDb->last_error;
	       echo $msg;
	    }
   		       
   }else{
     $msg="Sorry,you are not authorized to access this page";
   }	 

}else{
  header("Location:login.php");
}
}