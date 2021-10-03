<?php
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
$myDb->connect($host,$user,$pwd,$db,true);

	$efid=mysql_real_escape_string($_GET['efid']);
	$smonth=mysql_real_escape_string($_GET['smonth']);
	$syear=mysql_real_escape_string($_GET['syear']);
	$data="Select SUM(totaldays) as th From eventer_eventshces Where section='Holiday Calendar' and monthname= '$smonth' and yearname='$syear'";
  	$dataq=$myDb->select($data);
  	$datar=$myDb->get_row($dataq,'MYSQL_ASSOC');
  	echo $datar['th'];
  
?>