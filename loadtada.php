<?php
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
$myDb->connectDefaultServer()

	$efid=mysql_real_escape_string($_GET['efid']);

	$data="SELECT s.StaffID as StaffID, d.name as Designation, p.name as Payscale, p.basicpay, p.houserent, p.medicalallow, p.transportallow, p.otherallow FROM  vw_allstaff s inner join tbl_designation d on s.DesigId=d.id inner join tbl_payscale p on s.PaysacleId=p.id WHERE s.StaffID='$efid'";
  	$dataq=$myDb->select($data);
  	$datar=$myDb->get_row($dataq,'MYSQL_ASSOC');
  	echo $datar['transportallow'];
  
?>