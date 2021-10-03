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
			//$courseid=$_POST['courseid'];
			$semesterid=$_POST['semesterid'];
			$stdcursemester=$_POST['cursemesterid'] +1;
			$year= date("Y");
			$remarks="Promoted.";
			$opby=$_SESSION['userid'];
			
			/*$vs="Select * from tbl_stdpromotiontrace WHERE  deptid='$deptid' and semesterid='$semesterid' and session='$session' and year='$year' and storedstatus<>'D' ";
  			$r=$myDb->select($vs);
  			$row=$myDb->get_row($r,'MYSQL_ASSOC');
			if($row==0)
			{*/
				$query="INSERT into tbl_stdpromotiontrace (deptid,  semesterid, session, year, remarks, opby, opdate, storedstatus) VALUES ('$deptid','$semesterid','$session','$year','$remarks','$opby','$opdate','I')";
				
				if($myDb->insert_sql($query)){
				// update student promoted semester

				$msg="Data inserted successfully"; 
				}else{
					$msg=$myDb->last_error;
				} 	
			//}
/*			should be open in later satage
			else
			{
				$query="UPDATE tbl_stdresult set gp='$gp' and grade='$grade' and storedstatus='U' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and semesterid='$semesterid'";
				if($myDb->update_sql($query)){
				$msg="Data update successfully"; 
				}else{
					$msg=$myDb->last_error;
				} 	
				
			}*/		
				$queryupd="UPDATE tbl_stdinfo set stdcursemester='$stdcursemester' where stdid='$stdid'";
				$myDb->update_sql($queryupd);
	
  		}
		echo $msg;
		
 	}
	else
	{
  		header("Location:index.php");
	}
}  
?>

