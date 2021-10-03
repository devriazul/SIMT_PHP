<?php
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
$myDb->connect($host,$user,$pwd,$db,true);

	$efid=mysql_real_escape_string($_GET['efid']);

	$data="SELECT d.name as Designation from tbl_faculty f inner join tbl_designation d on f.designationid=d.id WHERE f.facultyid='$efid'";
  	$dataq=$myDb->select($data);
  	$datar=$myDb->get_row($dataq,'MYSQL_ASSOC');
  	echo $datar['Designation'];
  
?>