<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $rurl=$_SERVER['HTTP_REFERER'];
  
    $accname=mysql_real_escape_string(ucfirst(strtolower($_POST['accname'])));
	$description=mysql_real_escape_string($_POST['description']);
	$orderid=mysql_real_escape_string($_POST['orderid']);
	$opdate=date("Y-m-d");
			  $a=time().".jpg";
	if($_FILES[img][tmp_name]!=""){	
		copy($_FILES[img][tmp_name],"dashboardimg/".$a);	    
		$query="INSERT INTO   tbl_access(`accname`,`description`,`img`,`orderid`) VALUES('$accname','$description','$a','$orderid')";
		if($r=$myDb->insert_sql($query)){
		   $msg="Data inserted successfully";
		   $sdq="select * from tbl_access order by id desc";
					$sdep=$myDb->dump_query($sdq,'edit_access_level.php','del_access_level.php',$car['upd'],$car['delt']);			
		   header("Location:$rurl?msg=$msg");			
		}else{
		   $msg=$myDb->last_error;
		  $sdq="select * from tbl_access order by id desc";
					$sdep=$myDb->dump_query($sdq,'edit_access_level.php','del_access_level.php',$car['upd'],$car['delt']);		
		  		   header("Location:$rurl?msg=$msg");			
	
		} 		
	}else{
	  $msg="Record not inserted,image mandatory";
		   header("Location:$rurl?msg=$msg");			
	}	

}else{
  header("Location:index.php");
}
}