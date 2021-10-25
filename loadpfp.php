<?php
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
$myDb->connectDefaultServer()

	$efid=mysql_real_escape_string(substr($_GET['efid'],0,1));
	
	
	$data="SELECT * FROM tbl_profund_settings WHERE section like '$efid%'";
  	$dataq=$myDb->select($data);
  	$datar=$myDb->get_row($dataq,'MYSQL_ASSOC');
	
  	echo $datar['pf'];
  
?>