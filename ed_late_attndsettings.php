<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  	if($_SESSION['userid'])
	{
    	$chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_late_attndsettings.php' AND userid='$_SESSION[userid]'";
		$caq=$myDb->select($chka);
  		$car=$myDb->get_row($caq,'MYSQL_ASSOC');
  		if(($car['ins']=="y")||($_SESSION['userid']=="administrator"))
		{
  			//$section=mysql_real_escape_string(ucfirst($_POST['section']));
			$nod=mysql_real_escape_string(ucfirst($_POST['nod']));
 			$ed=mysql_real_escape_string(ucfirst($_POST['ed']));
			
		
			$id=mysql_real_escape_string($_POST['id']);
			$qup="UPDATE tbl_late_attnd_setting SET `nod`='$nod',`ed`='$ed'  WHERE `id`='$id'";
			$upd=$myDb->update_sql($qup);
		
   			$msg="Data update successfully";
   			header("Location:manage_late_attndsettings.php?msg=$msg");
   		}
		else
		{
     		$msg="Sorry,you are not authorized to access this page";
   			header("Location:manage_late_attndsettings.php?msg=$msg");
   		}	 

	}
	else
	{
  		header("Location:index.php");
	}
}  
?>