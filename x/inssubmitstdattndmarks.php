<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
	if($_SESSION['userid'])
	{
		$TR = count($_POST['stdid']);
  		for ($i=0; $i <$TR; $i++)
  		{
			$opdate=date("Y-m-d");
			$stdid=$_POST['stdid'][$i];
			$session=$_POST['session'];
			$deptid=$_POST['deptid'];
			$courseid=$_POST['courseid'];
			$semesterid=$_POST['semesterid'];
			$examname=$_POST['examtype'];
			$attndmarks=$_POST['fmarks'][$i];
			$year=$_POST['year'];
			$opby=$_SESSION['userid'];
			if($examname=="Attendance Theory Cont")
			{
				//echo $examname; exit;
				//$query="INSERT INTO tbl_marksentryfinal(stdid,deptid,courseid,session,year,semesterid,examname,attendancemarks,opby,opdate,storedstatus)VALUES('$stdid','$deptid','$courseid','$session','$year','$semesterid','$examname','$attndmarks','$opby','$opdate','I')";
				//if($myDb->insert_sql($query)){
				$query="UPDATE tbl_marksentryfinal set attendancemarks='$attndmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid' and opby='$opby'";
				if($myDb->update_sql($query)){

					$msg="Data inserted successfully"; 
				}else{
					$msg=$myDb->last_error;
				} 	
			} 
			else if ($examname=="Attendance Practical Cont")
			{
				//$query="INSERT INTO tbl_marksentryfinal(stdid,deptid,courseid,session,year,semesterid,examname,attendancemarksprac,opby,opdate,storedstatus)VALUES('$stdid','$deptid','$courseid','$session','$year','$semesterid','$examname','$attndmarks','$opby','$opdate','I')";
				//if($myDb->insert_sql($query)){
				$query="UPDATE tbl_marksentryfinal set attendancemarksprac='$attndmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid' and opby='$opby'";
				if($myDb->update_sql($query)){

					$msg="Data inserted successfully"; 
				}else{
					$msg=$myDb->last_error;
				} 	
			}

  		}echo $msg;	
 	}
	else
	{
  		header("Location:index.php");
	}
}  
?>

