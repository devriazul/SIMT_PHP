<?php
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
$myDb->connectDefaultServer()

	$applyfor=mysql_real_escape_string($_POST['applyfor']);

	$data="SELECT * FROM  tbl_leave WHERE code='$applyfor' AND storedstatus<>'D'";
  	$dataq=$myDb->select($data);
  	$datar=$myDb->get_row($dataq,'MYSQL_ASSOC');
  	echo $datar['dayscount'];
  
?>