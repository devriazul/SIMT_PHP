<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  	if($_SESSION['userid'])
	{
		$chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_root_acc_head.php' AND userid='$_SESSION[userid]'";
  		$caq=$myDb->select($chka);
  		$car=$myDb->get_row($caq,'MYSQL_ASSOC');
		if($car['ins']=="y")
		{
            $id=mysql_real_escape_string($_POST['id']);
			$accname=mysql_real_escape_string($_POST['accname']);
			$type=mysql_real_escape_string($_POST['type']);
			$parentid=mysql_real_escape_string($_POST['parentid']);
			$groupname=mysql_real_escape_string($_POST['groupname']);
			if(!empty($accname)){
			  $myDb->update_sql("UPDATE tbl_accchart SET accname='$accname',type='$type',parentid='$parentid',groupname='$groupname' where id='$id'");
			  
			  $vrc=$myDb->select("SELECT*FROM tbl_2ndjournal WHERE accno='$id'");
			  $vrcf=$myDb->get_row($vrc,'MYSQL_ASSOC');
			  if(!empty($vrcf['id'])){
				  $myDb->update_sql("UPDATE tbl_2ndjournal SET parentid='$parentid',groupname='$groupname' where accno='$id'");
			  
			  }
			  echo "<div style='width:500px; height:25px;padding:5px; background-color:#999999;color:#ffffff;' align='center'>Record successfully updated</div>";				  
			}

		}
else
{
	$msg="Sorry, You are not authorized to access this page.";
    header("Location:home.php?msg=$msg");
}
}else{
  header("Location:login.php");
}
}  
?>
