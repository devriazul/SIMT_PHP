<?php
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
$myDb->connectDefaultServer()

	$efid=mysql_real_escape_string($_GET['efid']);

	$data="SELECT bankaccno FROM  vw_allstaff WHERE StaffID='$efid'";
  	$dataq=$myDb->select($data);
  	$datar=$myDb->get_row($dataq,'MYSQL_ASSOC');
  	echo $datar['bankaccno'];
  
?>