<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  	if($_SESSION['userid'])
	{
  		$chka="SELECT*FROM  tbl_accdtl WHERE flname='managestdcv.php' AND userid='$_SESSION[userid]'";
  		$caq=$myDb->select($chka);
  		$car=$myDb->get_row($caq,'MYSQL_ASSOC');
	  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
		{
			$id=mysql_real_escape_string($_GET['id']);
	   
	   		$qup="Delete from tbl_stdcv WHERE `id`='$id'";
	   		$upd=$myDb->update_sql($qup);
			$query="INSERT INTO `tbl_logdetails` (`formname`, `tblname`, `tblid`, `opby`, `opdate`) VALUES ('Student CV', 'tbl_stdcv', '$id',  '$_SESSION[userid]','$opdate')";
			if($myDb->insert_sql($query))
			{		
	   			$msg="Data deleted successfully.";
       			header("Location:managestdcv.php?msg=$msg");
			}
   		}
		else
		{
     		$msg="Sorry,you are not authorized to access this page";
		 	header("Location:home.php?msg=$msg");
   		}	 

	}
	else
	{
  		header("Location:index.php");
	}
}