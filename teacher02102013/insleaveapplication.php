<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
	if($_SESSION['userid'])
	{
			$opdate=date("Y-m-d");
			$empid=$_POST['empid'];
			$empname=$_POST['empname'];
			$designation=$_POST['desig'];
			$applyfor=$_POST['applyfor'];
			$fdate=$_POST['fdate'];
			$tdate=$_POST['tdate'];
			$reason=$_POST['reason'];
			$remarks=$_POST['remarks'];
			$opby=$_SESSION['userid'];
			$dayscount=mysql_real_escape_string($_POST['td']);
			$lid=$_POST['lid'];
		  	$len = count($_POST['pdate']);
  			//echo print_r($_POST['pdate']);
  			//exit;
  			for ($i=0; $i <$len-1; $i++)
  			{

				$ei="INSERT INTO tbl_leavemakeuphistory(lid,cdate,ctime,fname,description,opby,opdate,storedstatus)VALUES('".mysql_real_escape_string($_POST['lid'])."','".mysql_real_escape_string($_POST['pdate'][$i])."','".mysql_real_escape_string($_POST['ptime'][$i])."','".mysql_real_escape_string($_POST['facultyid'][$i])."','".mysql_real_escape_string($_POST['desc'][$i])."','$_SESSION[userid]','".date("Y-m-d")."','I')";
    			$ein=$myDb->insert_sql($ei);
				//echo "success";
				//exit;
  			}	


			$queryl="INSERT INTO `tbl_leavedetails` (`efid`, `ltype`, `allocateddays`, `opby`, `opdate`, `storedstatus`) VALUES ('$empid', '$applyfor', '$dayscount', '$opby', '$opdate', 'I');";
			$myDb->insert_sql($queryl);

			$query="INSERT INTO `tbl_leaveapplication` (`empid`, `name`, `designation`, `applyfor`, `applydate`, `frmdate`, `todate`, `reason`, `remarks`, `opby`, `opdate`, `storedstatus`,`lid`) VALUES ('$empid', '$empname', '$designation', '$applyfor', '$opdate', '$fdate', '$tdate', '$reason', '$remarks', '$opby', '$opdate', 'I','$lid');";
			if($myDb->insert_sql($query)){
			$msg="Data inserted successfully"; 
			}else{
				$msg=$myDb->last_error;
			} 	echo $msg;
  	}	
 	
	else
	{
  		header("Location:index.php");
	}
}  
?>

