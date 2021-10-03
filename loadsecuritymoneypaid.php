<?php
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
$myDb->connect($host,$user,$pwd,$db,true);

	$efid=mysql_real_escape_string($_GET['efid']);

	$vs="SELECT ifnull(smob,0) as smob FROM `vw_allstaff` WHERE StaffID='$efid'";
	$r=$myDb->select($vs);
	$row=$myDb->get_row($r,'MYSQL_ASSOC');


	$data="Select ifnull(SUM(securitymoney),0) as SMP From tbl_employeesalary WHERE empid='$efid'";
  	$dataq=$myDb->select($data);
  	$datar=$myDb->get_row($dataq,'MYSQL_ASSOC');
  	if(($datar['SMP']>0) || ($row['smob']>0))
	{
		echo $row['smob'] + $datar['SMP'].".00";
	}
	else
	{
		echo "0.00";
	
	}
  
?>