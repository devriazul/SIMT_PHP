<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  	if($_SESSION['userid'])
	{
    	$chka="SELECT*FROM  tbl_accdtl WHERE flname='managenotice.php' AND userid='$_SESSION[userid]'";
		$caq=$myDb->select($chka);
  		$car=$myDb->get_row($caq,'MYSQL_ASSOC');
  		if($car['ins']=="y")
		{
  			$pdate=mysql_real_escape_string(ucfirst($_POST['adate']));
			$headline=mysql_real_escape_string(ucfirst($_POST['headline']));
			$desc=mysql_real_escape_string(ucfirst($_POST['desc']));
			$status=mysql_real_escape_string(ucfirst($_POST['status']));
			$noticefor=mysql_real_escape_string(ucfirst($_POST['noticefor']));
			$opdate=date('Y-m-d');
		
			$id=mysql_real_escape_string($_GET['id']);
			$qup="UPDATE tbl_noticeboard SET `headline`='$headline',`description`='$desc',`adate`='$pdate', `status`='$status', `storedstatus`='U', `opdate`='$opdate', `noticefor`='$noticefor' WHERE `id`='$id'";
			$upd=$myDb->update_sql($qup);
		
   			$msg="Data update successfully";
   			header("Location:managenotice.php?msg=$msg");
   		}
		else
		{
     		$msg="Sorry,you are not authorized to access this page";
   			header("Location:managenotice.php?msg=$msg");
   		}	 

	}
	else
	{
  		header("Location:index.php");
	}
}  
?>