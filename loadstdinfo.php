<?php
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
$myDb->connect($host,$user,$pwd,$db,true);

	$stdid=mysql_real_escape_string($_GET['stdid']);

	$data="SELECT s.*, d.name as departmentname FROM  tbl_stdinfo s inner join tbl_department d on s.deptname=d.id WHERE s.stdid='$stdid' AND s.storedstatus<>'D'";
  	$dataq=$myDb->select($data);
  	$datar=$myDb->get_row($dataq,'MYSQL_ASSOC');
  	//echo $datar['fname'];
	$results = array ("0"=>$datar['fname'], "1"=>$datar['mname'], "2"=>$datar['dob'], "3"=>"20".substr($datar['session'],0,2)."-"."20".substr($datar['session'],-2,4), "4"=>$datar['departmentname'], "5"=>$datar['peraddress'], "6"=>$datar['praddress'], "7"=>$datar['phone'] , "8"=>$datar['img']);//"a" => "orange"

	if(@$_GET['a']==1)
	{
		echo $results[0];
	}
	if(@$_GET['b']==1)
	{
		echo $results[1];
	}
	if(@$_GET['c']==1)
	{
		echo $results[2];
	}
	if(@$_GET['d']==1)
	{
		echo $results[4];
	}
	if(@$_GET['e']==1)
	{
		echo $results[3];
	}
	if(@$_GET['f']==1)
	{
		echo $results[5];
	}
	if(@$_GET['g']==1)
	{
		echo $results[6];
	}
	if(@$_GET['h']==1)
	{
		echo $results[7];
	}
	if(@$_GET['i']==1)
	{
		echo $results[8];
	}


	//$fruits = array ("0"=>$datar['fname'], "1"=>$datar['mname'], "2"=>$datar['dob'], "3"=>"20".substr($datar['4'],0,2)."-"."20".substr($datar['4'],-2,4), "5"=>$datar['departmentname'], "6"=>$datar['boardregno']);//"a" => "orange"
  	//print_r($fruits);
?>