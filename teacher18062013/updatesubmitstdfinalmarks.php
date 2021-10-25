<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
	if($_SESSION['userid'])
	{
		/*$TR = count($_POST['stdid']);
  		for ($i=0; $i <$TR; $i++)
  		{*/
			$opdate=date("Y-m-d");
			$stdid=$_POST['stdid']; 
			$session=$_POST['session'];
			$deptid=$_POST['deptid'];
			$courseid=$_POST['courseid'];
			$semesterid=$_POST['semesterid']; 
			$examname=$_POST['examtype']; 
			$ctmarks=$_POST['fmarks'];
			$year=$_POST['year'];
			$opby=$_SESSION['userid'];
			
			if($examname=="Class Test")
			{
				$query="UPDATE tbl_marksentryfinal set classtestmarks='$ctmarks', opby='$opby', opdate='$opdate', storedstatus='U' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
				if($myDb->insert_sql($query))
				{
			 		$msg="Data Update Successfully."; 
				}else{
			 		$msg=$myDb->last_error;
				}
				echo $msg;
		  	} 	
			else if($examname=="Quiz Test")
			{
				$query="UPDATE tbl_marksentryfinal set quiztestmarks='$ctmarks', opby='$opby', opdate='$opdate', storedstatus='U' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
				if($myDb->insert_sql($query))
				{
			 		$msg="Data Update Successfully."; 
				}else{
			 		$msg=$myDb->last_error;
				}
				echo $msg;
		  	}
			else if($examname=="Home Work")
			{
				$query="UPDATE tbl_marksentryfinal set hwmarks='$ctmarks', opby='$opby', opdate='$opdate', storedstatus='U' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
				if($myDb->insert_sql($query))
				{
			 		$msg="Data Update Successfully."; 
				}else{
			 		$msg=$myDb->last_error;
				}
				echo $msg;
		  	}
			else if($examname=="Attendance Theory Cont")
			{
				$query="UPDATE tbl_marksentryfinal set attendancemarks='$ctmarks', opby='$opby', opdate='$opdate', storedstatus='U' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
				if($myDb->insert_sql($query))
				{
			 		$msg="Data Update Successfully."; 
				}else{
			 		$msg=$myDb->last_error;
				}
				echo $msg;
		  	}
			else if($examname=="Attendance Practical Cont")
			{
				$query="UPDATE tbl_marksentryfinal set attendancemarksprac='$ctmarks', opby='$opby', opdate='$opdate', storedstatus='U' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
				if($myDb->insert_sql($query))
				{
			 		$msg="Data Update Successfully."; 
				}else{
			 		$msg=$myDb->last_error;
				}
				echo $msg;
		  	}
			else if($examname=="Behavior")
			{
				$query="UPDATE tbl_marksentryfinal set behaviormarks='$ctmarks', opby='$opby', opdate='$opdate', storedstatus='U' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
				if($myDb->insert_sql($query))
				{
			 		$msg="Data Update Successfully."; 
				}else{
			 		$msg=$myDb->last_error;
				}
				echo $msg;
		  	}
			else if($examname=="Job/Experiment")
			{
				$query="UPDATE tbl_marksentryfinal set jobexpr='$ctmarks', opby='$opby', opdate='$opdate', storedstatus='U' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
				if($myDb->insert_sql($query))
				{
			 		$msg="Data Update Successfully."; 
				}else{
			 		$msg=$myDb->last_error;
				}
				echo $msg;
		  	}
			else if($examname=="Job/Experiment Report")
			{
				$query="UPDATE tbl_marksentryfinal set jobexprreport='$ctmarks', opby='$opby', opdate='$opdate', storedstatus='U' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
				if($myDb->insert_sql($query))
				{
			 		$msg="Data Update Successfully."; 
				}else{
			 		$msg=$myDb->last_error;
				}
				echo $msg;
		  	}
			else if($examname=="Job/Experiment Viva")
			{
				$query="UPDATE tbl_marksentryfinal set jobexprviva='$ctmarks', opby='$opby', opdate='$opdate', storedstatus='U' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
				if($myDb->insert_sql($query))
				{
			 		$msg="Data Update Successfully."; 
				}else{
			 		$msg=$myDb->last_error;
				}
				echo $msg;
		  	}
			else if($examname=="Job/Experiment Final")
			{
				$query="UPDATE tbl_marksentryfinal set jobexprfinal='$ctmarks', opby='$opby', opdate='$opdate', storedstatus='U' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
				if($myDb->insert_sql($query))
				{
			 		$msg="Data Update Successfully."; 
				}else{
			 		$msg=$myDb->last_error;
				}
				echo $msg;
		  	}
			else if($examname=="Job/Experiment Report Final")
			{
				$query="UPDATE tbl_marksentryfinal set jobexprreportfinal='$ctmarks', opby='$opby', opdate='$opdate', storedstatus='U' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
				if($myDb->insert_sql($query))
				{
			 		$msg="Data Update Successfully."; 
				}else{
			 		$msg=$myDb->last_error;
				}
				echo $msg;
		  	}
			else if($examname=="Job/Experiment Viva Final")
			{
				$query="UPDATE tbl_marksentryfinal set jobexprvivafinal='$ctmarks', opby='$opby', opdate='$opdate', storedstatus='U' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
				if($myDb->insert_sql($query))
				{
			 		$msg="Data Update Successfully."; 
				}else{
			 		$msg=$myDb->last_error;
				}
				echo $msg;
		  	}
			else if($examname=="Practical Final Exam")
			{
				$query="UPDATE tbl_marksentryfinal set finalexamprac='$ctmarks', opby='$opby', opdate='$opdate', storedstatus='U' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
				if($myDb->insert_sql($query))
				{
			 		$msg="Data Update Successfully."; 
				}else{
			 		$msg=$myDb->last_error;
				}
				echo $msg;
		  	}


			else if($examname=="Theory Final Exam")
			{
				$query="UPDATE tbl_marksentryfinal set finalexammarks='$ctmarks', opby='$opby', opdate='$opdate', storedstatus='U' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
				if($myDb->insert_sql($query))
				{
			 		$msg="Data Update Successfully."; 
				}else{
			 		$msg=$myDb->last_error;
				}
				echo $msg;
		  	}
			//$queryNew="UPDATE   tbl_examinitionsettings set resultstatus='1' Where deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid' and examtype='$examname'";
			//$op=$myDb->update_sql($queryNew);
  		//}	
		
  		
  		
 	}
	else
	{
  		header("Location:login.php");
	}
}  
?>

