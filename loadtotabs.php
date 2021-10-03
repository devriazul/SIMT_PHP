<?php
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
$myDb->connect($host,$user,$pwd,$db,true);

	$efid=mysql_real_escape_string($_GET['efid']);
	$smonth=mysql_real_escape_string($_GET['smonth']);
	$syear=mysql_real_escape_string($_GET['syear']);
	$wd=mysql_real_escape_string($_GET['wd']);
	//$tl=mysql_real_escape_string($_GET['tl']);
	
	//------Total Attendance-------
	$data="Select COUNT(id) as tad From tbl_attendance Where efid='$efid' and monthname= '$smonth' and yearname='$syear'";
  	$dataq=$myDb->select($data);
  	$datar=$myDb->get_row($dataq,'MYSQL_ASSOC');

	//------Total Default Holday-------
	$dl="Select SUM(totaldays) as tdl From eventer_eventshces Where section='Holiday Calendar' and monthname= '$smonth' and yearname='$syear'";
  	$dlq=$myDb->select($dl);
  	$dlr=$myDb->get_row($dlq,'MYSQL_ASSOC');
	
	//------Total Leave-------	
	$datatl="SELECT ifnull(SUM(accepteddays),0) as totalLeave From tbl_leaveassignedhistory Where efid='$efid' and monthname='$smonth' and yearname='$syear'";
  	$datatlq=$myDb->select($datatl);
  	$datatlr=$myDb->get_row($datatlq,'MYSQL_ASSOC');
	  
	//------Total Late Attendance-------	
	$datala="Select COUNT(id) as td From tbl_attendance Where efid='$efid' and monthname= '$smonth' and yearname= '$syear' and astatus='Late Present' and instatus='Regular In'";
  	$datalaq=$myDb->select($datala);
  	$datalar=$myDb->get_row($datalaq,'MYSQL_ASSOC');

	$lateabs="Select * FROM tbl_late_attnd_setting WHERE section='Late Present'";
	$lateabsq=$myDb->select($lateabs);
	$lateabsr=$myDb->get_row($lateabsq,'MYSQL_ASSOC');
	
	$ac = floor($datalar['td']/ $lateabsr['nod']);
	
	//------------end-------------

	//------Total Absent In Office-------	
	$dataao="Select COUNT(id) as tdio From tbl_attendance Where efid='$efid' and monthname= '$smonth' and yearname= '$syear' and astatus='Absent' and instatus='Regular In'";
  	$dataaoq=$myDb->select($dataao);
  	$dataaor=$myDb->get_row($dataaoq,'MYSQL_ASSOC');

	$absio="Select * FROM tbl_late_attnd_setting WHERE section='Late Present'";
	$absioq=$myDb->select($absio);
	$absior=$myDb->get_row($absioq,'MYSQL_ASSOC');
	
	$aioc = floor($dataaor['tdio']/ $absior['nod']);
	
	//------------end-------------

	
  	echo $wd - (($datar['tad'] - ($ac + $aioc)) + $dlr['tdl'] + $datatlr['totalLeave']);
  
?>