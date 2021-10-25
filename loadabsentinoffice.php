<?php
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
$myDb->connectDefaultServer()

	$efid=mysql_real_escape_string($_GET['efid']);
	$smonth=mysql_real_escape_string($_GET['smonth']);
	$syear=mysql_real_escape_string($_GET['syear']);
	$data="Select COUNT(id) as td From tbl_attendance Where efid='$efid' and monthname= '$smonth' and yearname= '$syear' and astatus='Absent' and instatus='Regular In'";
  	$dataq=$myDb->select($data);
  	$datar=$myDb->get_row($dataq,'MYSQL_ASSOC');
  	echo $datar['td'];
  
?>