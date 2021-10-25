<?php 
ob_start();
session_start();
require_once('dbClass.php');
include_once("config.php"); // the connection to the database 
if($myDb->connectDefaultServer())
{ 

//if(isset($_GET['submitted'])) { 
	$NR = count($_POST['stdid']);
	$query="UPDATE   tbl_examinitionsettings set examstatus='1' Where id='$_POST[examid]'";
	$op=$myDb->update_sql($query);
	
	for($i=0;$i<$NR;$i++)
	{
		$opdate=date("Y-m-d");
		$examid=$_POST['examid'];
		$stdid=$_POST['stdid'][$i];
		$marks=$_POST['marks'][$i];
		$deptid=$_POST['deptid'];
		$courseid=$_POST['courseid'];
		$session=$_POST['session'];
		$eyear=$_POST['eyear'];
		$semesterid=$_POST['semesterid'];

		$opby=$_SESSION['userid'];

		$newCategory = mysql_query("INSERT INTO tbl_marksentryprimary (examid, stdid, marks, opby, opdate, storedstatus) 
					VALUES ('$examid','$stdid','$marks','$opby','$opdate','I')") or die(mysql_error());
								
		$ivn="SELECT * FROM tbl_marksentryfinal WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$eyear' and semesterid='$semesterid'";
  		$ivqn=$myDb->select($ivn);
  		$ivrsn=$myDb->get_row($ivqn,'MYSQL_ASSOC');
		if($ivrsn==0)
		{
			$newCategory = mysql_query("INSERT INTO tbl_marksentryfinal (stdid, deptid, courseid, session, year, semesterid, opby, opdate, storedstatus) 
					VALUES ('$stdid','$deptid','$courseid','$session','$eyear','$semesterid','$opby','$opdate','I')") or die(mysql_error());
		}
		
		echo "Successfully submit marks";
		
	}
	
}
	?>