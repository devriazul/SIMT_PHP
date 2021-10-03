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
			$stdcursemester=$_POST['semesterid'] +1;
			$gp=$_POST['gp'][$i];
			$grade=$_POST['grade'][$i];
			$opby=$_SESSION['userid'];
			
			$vs="Select * from tbl_stdresult WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and semesterid='$semesterid' and storedstatus<>'D' ";
  			$r=$myDb->select($vs);
  			$row=$myDb->get_row($r,'MYSQL_ASSOC');
			if($row==0)
			{
				$query="INSERT into tbl_stdresult (stdid, deptid, courseid, semesterid, session, gp, grade, opby, opdate, storedstatus) VALUES ('$stdid','$deptid','$courseid','$semesterid','$session','$gp','$grade','$opby','$opdate','I')";
				
				if($myDb->insert_sql($query)){
				// update student promoted semester
				$queryupd="UPDATE tbl_stdinfo set stdcursemester='$stdcursemester' where stdid='$stdid'";
				$myDb->update_sql($queryupd);

				$msg="Data inserted successfully"; 
				}else{
					//$msg=$myDb->last_error;
?><span style="color:#FF0000;"> <?php echo "This result is already submited.";	?> </span><?php
				} 	
			}
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
  		}echo $msg;
		
 	}
	else
	{
  		header("Location:index.php");
	}
}  
?>

