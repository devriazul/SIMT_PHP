<?php
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
$myDb->connect($host,$user,$pwd,$db,true);

	$efname=mysql_real_escape_string($_GET['efname']);

	$data="SELECT pamountpc FROM  tbl_parttimeemployeesalary WHERE empname='$efname'";
  	$dataq=$myDb->select($data);
  	$datar=$myDb->get_row($dataq,'MYSQL_ASSOC');
  	echo $datar['pamountpc'];
  
?>