<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  	if($_SESSION['userid'])
	{
    	$chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_attndsettings.php' AND userid='$_SESSION[userid]'";
		$caq=$myDb->select($chka);
  		$car=$myDb->get_row($caq,'MYSQL_ASSOC');
  		if($car['ins']=="y")
		{
  			$stdintime=mysql_real_escape_string(ucfirst($_POST['stdintime']));
			$stdouttime=mysql_real_escape_string(ucfirst($_POST['stdouttime']));
 			$minallow=mysql_real_escape_string(ucfirst($_POST['minallow']));
			$maxallow=mysql_real_escape_string(ucfirst($_POST['maxallow']));
			
		
			$id=mysql_real_escape_string($_POST['id']);
			$qup="UPDATE tbl_attendancesettings SET `stdintime`='$stdintime',`stdouttime`='$stdouttime',`minallow`='$minallow', `maxallow`='$maxallow' WHERE `id`='$id'";
			$upd=$myDb->update_sql($qup);
		
   			$msg="Data update successfully";
   			header("Location:manage_attndsettings.php?msg=$msg");
   		}
		else
		{
     		$msg="Sorry,you are not authorized to access this page";
   			header("Location:manage_attndsettings.php?msg=$msg");
   		}	 

	}
	else
	{
  		header("Location:index.php");
	}
}  
?>