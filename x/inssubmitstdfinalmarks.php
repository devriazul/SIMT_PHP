<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
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
			$ctmarks=$_POST['fmarks'][$i];
			$year=$_POST['year'];
			$opby=$_SESSION['userid'];
			
			//$crs="SELECT * FROM tbl_marksentryfinal WHERE deptid='$deptid' and courseid= '$courseid' and semesterid='$semesterid' and session='$session' and year='$year' and examtype='$examtype'";
  			//$crq=$myDb->select($crs);

			if($examname=="Class Test")
			{
				//$query="INSERT INTO tbl_marksentryfinal(stdid,deptid,courseid,session,year,semesterid,examname,classtestmarks,opby,opdate,storedstatus)VALUES('$stdid','$deptid','$courseid','$session','$year','$semesterid','$examname','$ctmarks','$opby','$opdate','I')";
				//if($myDb->insert_sql($query)){
				$query="Update tbl_marksentryfinal set classtestmarks='$ctmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid' and opby='$opby'";
				if($myDb->update_sql($query)){
			 	
					$msg="Data inserted successfully"; 
				
		  		}else{
			 		$msg=$myDb->last_error;
		  		} 	
				//echo $msg;
			}
			else if($examname=="Quiz Test")
			{
				//$query="INSERT INTO tbl_marksentryfinal(stdid,deptid,courseid,session,year,semesterid,examname,quiztestmarks,opby,opdate,storedstatus)VALUES('$stdid','$deptid','$courseid','$session','$year','$semesterid','$examname','$ctmarks','$opby','$opdate','I')";
				//if($myDb->insert_sql($query)){
				$query="Update tbl_marksentryfinal set quiztestmarks='$ctmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid' and opby='$opby'";
				if($myDb->update_sql($query)){
			 	
					$msg="Data inserted successfully"; 
				
		  		}else{
			 		$msg=$myDb->last_error;
		  		} 	
				//echo $msg;
			}
			else if($examname=="Home Work")
			{
				//$query="INSERT INTO tbl_marksentryfinal(stdid,deptid,courseid,session,year,semesterid,examname,hwmarks,opby,opdate,storedstatus)VALUES('$stdid','$deptid','$courseid','$session','$year','$semesterid','$examname','$ctmarks','$opby','$opdate','I')";
				//if($myDb->insert_sql($query)){
				$query="Update tbl_marksentryfinal set hwmarks='$ctmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid' and opby='$opby'";
				if($myDb->update_sql($query)){
			 	
					$msg="Data inserted successfully"; 
				
		  		}else{
			 		$msg=$myDb->last_error;
		  		} 	
				//echo $msg;
			}
			else if($examname=="Behavior")
			{
				//$query="INSERT INTO tbl_marksentryfinal(stdid,deptid,courseid,session,year,semesterid,examname,behaviormarks,opby,opdate,storedstatus)VALUES('$stdid','$deptid','$courseid','$session','$year','$semesterid','$examname','$ctmarks','$opby','$opdate','I')";
				//if($myDb->insert_sql($query)){
				$query="Update tbl_marksentryfinal set behaviormarks='$ctmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid' and opby='$opby'";
				if($myDb->update_sql($query)){
			 	
					$msg="Data inserted successfully"; 
				
		  		}else{
			 		$msg=$myDb->last_error;
		  		} 	
				//echo $msg;
			}
			else if($examname=="Job/Experiment")
			{
				//$query="INSERT INTO tbl_marksentryfinal(stdid,deptid,courseid,session,year,semesterid,examname,jobexpr,opby,opdate,storedstatus)VALUES('$stdid','$deptid','$courseid','$session','$year','$semesterid','$examname','$ctmarks','$opby','$opdate','I')";
				//if($myDb->insert_sql($query)){
				$query="Update tbl_marksentryfinal set jobexpr='$ctmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid' and opby='$opby'";
				if($myDb->update_sql($query)){
			 	
					$msg="Data inserted successfully"; 
				
		  		}else{
			 		$msg=$myDb->last_error;
		  		} 	
				//echo $msg;
			}
			else if($examname=="Job/Experiment Report")
			{
				//$query="INSERT INTO tbl_marksentryfinal(stdid,deptid,courseid,session,year,semesterid,examname,jobexprreport,opby,opdate,storedstatus)VALUES('$stdid','$deptid','$courseid','$session','$year','$semesterid','$examname','$ctmarks','$opby','$opdate','I')";
				//if($myDb->insert_sql($query)){
				$query="Update tbl_marksentryfinal set jobexprreport='$ctmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid' and opby='$opby'";
				if($myDb->update_sql($query)){
			 	
					$msg="Data inserted successfully"; 
				
		  		}else{
			 		$msg=$myDb->last_error;
		  		} 	
				//echo $msg;
			}
			else if($examname=="Job/Experiment Viva")
			{
				//$query="INSERT INTO tbl_marksentryfinal(stdid,deptid,courseid,session,year,semesterid,examname,jobexprviva,opby,opdate,storedstatus)VALUES('$stdid','$deptid','$courseid','$session','$year','$semesterid','$examname','$ctmarks','$opby','$opdate','I')";
				//if($myDb->insert_sql($query)){
				$query="Update tbl_marksentryfinal set jobexprviva='$ctmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid' and opby='$opby'";
				if($myDb->update_sql($query)){
			 	
					$msg="Data inserted successfully"; 
				
		  		}else{
			 		$msg=$myDb->last_error;
		  		} 	
				//echo $msg;
			}

			else if($examname=="Job/Experiment Final")
			{
				//$query="INSERT INTO tbl_marksentryfinal(stdid,deptid,courseid,session,year,semesterid,examname,jobexprfinal,opby,opdate,storedstatus)VALUES('$stdid','$deptid','$courseid','$session','$year','$semesterid','$examname','$ctmarks','$opby','$opdate','I')";
				//if($myDb->insert_sql($query)){
				$query="Update tbl_marksentryfinal set jobexprfinal='$ctmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid' and opby='$opby'";
				if($myDb->update_sql($query)){
			 	
					$msg="Data inserted successfully"; 
				
		  		}else{
			 		$msg=$myDb->last_error;
		  		} 	
				//echo $msg;
			}
			else if($examname=="Job/Experiment Report Final")
			{
				//$query="INSERT INTO tbl_marksentryfinal(stdid,deptid,courseid,session,year,semesterid,examname,jobexprreportfinal,opby,opdate,storedstatus)VALUES('$stdid','$deptid','$courseid','$session','$year','$semesterid','$examname','$ctmarks','$opby','$opdate','I')";
				//if($myDb->insert_sql($query)){
				$query="Update tbl_marksentryfinal set jobexprreportfinal='$ctmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid' and opby='$opby'";
				if($myDb->update_sql($query)){
			 	
					$msg="Data inserted successfully"; 
				
		  		}else{
			 		$msg=$myDb->last_error;
		  		} 	
				//echo $msg;
			}
			else if($examname=="Job/Experiment Viva Final")
			{
				//$query="INSERT INTO tbl_marksentryfinal(stdid,deptid,courseid,session,year,semesterid,examname,jobexprvivafinal,opby,opdate,storedstatus)VALUES('$stdid','$deptid','$courseid','$session','$year','$semesterid','$examname','$ctmarks','$opby','$opdate','I')";
				//if($myDb->insert_sql($query)){
				$query="Update tbl_marksentryfinal set jobexprvivafinal='$ctmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid' and opby='$opby'";
				if($myDb->update_sql($query)){
			 	
					$msg="Data inserted successfully"; 
				
		  		}else{
			 		$msg=$myDb->last_error;
		  		} 	
				//echo $msg;
			}


			else if($examname=="Theory Final Exam")
			{
				//$query="INSERT INTO tbl_marksentryfinal(stdid,deptid,courseid,session,year,semesterid,examname,finalexammarks,opby,opdate,storedstatus)VALUES('$stdid','$deptid','$courseid','$session','$year','$semesterid','$examname','$ctmarks','$opby','$opdate','I')";
				//if($myDb->insert_sql($query)){
				$query="Update tbl_marksentryfinal set finalexammarks='$ctmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid' and opby='$opby'";
				if($myDb->update_sql($query)){
			 	
					$msg="Data inserted successfully"; 
				
		  		}else{
			 		$msg=$myDb->last_error;
		  		} 	
				//echo $msg;
			}
			else if($examname=="Practical Final Exam")
			{
				//$query="INSERT INTO tbl_marksentryfinal(stdid,deptid,courseid,session,year,semesterid,examname,finalexamprac,opby,opdate,storedstatus)VALUES('$stdid','$deptid','$courseid','$session','$year','$semesterid','$examname','$ctmarks','$opby','$opdate','I')";
				//if($myDb->insert_sql($query)){
				$query="Update tbl_marksentryfinal set finalexamprac='$ctmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid' and opby='$opby'";
				if($myDb->update_sql($query)){
			 	
					$msg="Data inserted successfully"; 
				
		  		}else{
			 		$msg=$myDb->last_error;
		  		} 	
				//echo $msg;
			}
			$queryNew="UPDATE   tbl_examinitionsettings set resultstatus='1' Where deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid' and examtype='$examname'";
			$op=$myDb->update_sql($queryNew);
  		}echo $msg;	
		
  		
  		
 	}
	else
	{
  		header("Location:login.php");
	}
}  
?>

