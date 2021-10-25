<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
	if($_SESSION['userid'])
	{
		$ff="SELECT f.id FROM tbl_faculty f  WHERE f.facultyid='$_SESSION[userid]'";
  		$rff=$myDb->select($ff);
  		$ffrow=$myDb->get_row($rff,'MYSQL_ASSOC');
	
		$TR = count($_POST['stdid']);
  		for ($i=0; $i <$TR; $i++)
  		{
			$opdate=date("Y-m-d");
			$stdid=$_POST['stdid'][$i];
			$session=$_POST['session'];
			$section=$_POST['section'];
			$deptid=$_POST['deptid'];
			$courseid=$_POST['courseid'];
			$semesterid=$_POST['semesterid'];
			$examname=$_POST['examtype'];
			$totalworkingdays=$_POST['tnd'][$i];
			$attndays=$_POST['ad'][$i];
			$attendancepercent=$_POST['mp'][$i];
			$attndmarks=$_POST['fmarks'][$i];
			$year=$_POST['year'];
			$opby=$_SESSION['userid'];
			if($examname=="Attendance Theory Cont")
			{
				//echo $examname; exit;
				
				$query="UPDATE tbl_marksentryfinal set attendancemarks='$attndmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid' and opby='$opby'";

				$queryat="INSERT INTO tbl_stdattandence(stdid,deptid,courseid,session,section,year,semesterid,totalworkingdays,attndays,attendancepercent,opby,opdate,storedstatus)VALUES('$stdid','$deptid','$courseid','$session','$section','$year','$semesterid','$totalworkingdays','$attndays','$attendancepercent','$opby','$opdate','I')";
				$myDb->insert_sql($queryat);
				
				

				if($myDb->update_sql($query))
				{
					$queryN="INSERT INTO tbl_attndexaminitiontrace(deptid,courseid,session,year,semesterid,section,examname,opby,opdate,storedstatus)VALUES('$deptid','$courseid','$session','$year','$semesterid','$section','$examname','$opby','$opdate','I')";
					$myDb->insert_sql($queryN);
					
					$msg="Data inserted successfully"; 
				}
				else
				{
					$msg=$myDb->last_error;
				} 	
			} 
			else if ($examname=="Attendance Practical Cont")
			{
				//$query="INSERT INTO tbl_marksentryfinal(stdid,deptid,courseid,session,year,semesterid,examname,attendancemarksprac,opby,opdate,storedstatus)VALUES('$stdid','$deptid','$courseid','$session','$year','$semesterid','$examname','$attndmarks','$opby','$opdate','I')";
				//if($myDb->insert_sql($query)){
				$query="UPDATE tbl_marksentryfinal set attendancemarksprac='$attndmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid' and opby='$opby'";
				$queryat="INSERT INTO tbl_stdattandence(stdid,deptid,courseid,session,section,year,semesterid,totalworkingdays,attndays,attendancepercent,opby,opdate,storedstatus)VALUES('$stdid','$deptid','$courseid','$session','$section','$year','$semesterid','$totalworkingdays','$attndays','$attendancepercent','$opby','$opdate','I')"; 
				$myDb->insert_sql($queryat);

				

				if($myDb->update_sql($query))
				{
					$queryN="INSERT INTO tbl_attndexaminitiontrace(deptid,courseid,session,year,semesterid,section,examname,opby,opdate,storedstatus)VALUES('$deptid','$courseid','$session','$year','$semesterid','$section','$examname','$opby','$opdate','I')";
					$myDb->insert_sql($queryN);
					$msg="Data inserted successfully"; 

				}else
				{
					$msg=$myDb->last_error;
				} 	
			}

  		}
		//$updaf="UPDATE   tbl_assignfaculty set attndstatus='1' Where facultyid='$ffrow[id]' and deptid='$_POST[deptid]' and courseid='$_POST[courseid]' and session='$_POST[session]' and year='$_POST[year]' and semesterid='$_POST[semesterid]' and section='$_POST[section]'";
		//$afop=$myDb->update_sql($updaf);
		
		echo $msg;	
 	}
	else
	{
  		header("Location:index.php");
	}
}  
?>

