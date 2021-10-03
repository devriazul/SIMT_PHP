<?php
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
$myDb->connect($host,$user,$pwd,$db,true);

	$monthdayscount=mysql_real_escape_string($_POST['smonth']);

	//$data="SELECT * FROM  tbl_leave WHERE code='$monthdayscount' AND storedstatus<>'D'";
  	//$dataq=$myDb->select($data);
  	//$datar=$myDb->get_row($dataq,'MYSQL_ASSOC');
  	if($monthdayscount=="January")
	{
		echo 31;
	}	
	else if($monthdayscount=="February")
	{
		if(date('L')==1)
		{	
			echo 29;
		}
		else
		{
			echo 28;
		}
	}	
	else if($monthdayscount=="March")
	{
		echo 31;
	}	
	else if($monthdayscount=="April")
	{
		echo 30;
	}	
	else if($monthdayscount=="May")
	{
		echo 31;
	}	
	else if($monthdayscount=="June")
	{
		echo 30;
	}	
	else if($monthdayscount=="July")
	{
		echo 31;
	}	
	else if($monthdayscount=="August")
	{
		echo 31;
	}	
	else if($monthdayscount=="September")
	{
		echo 30;
	}	
	else if($monthdayscount=="October")
	{
		echo 31;
	}	
	else if($monthdayscount=="November")
	{
		echo 30;
	}	
	else if($monthdayscount=="December")
	{
		echo 31;
	}	
  
?>