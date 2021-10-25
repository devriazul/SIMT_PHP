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
			$session=$_POST['sess'];
			$deptid=$_POST['deptid'];
			$courseid=$_POST['courseid'];
			$semesterid=$_POST['semesterid'];
			$examname=$_POST['examtype'];
			$ctmarks=$_POST['fmarks'][$i];
			$remarks=$_POST['remarks'][$i];

			$year=$_POST['year'];
			$section=$_POST['section'];
			$opby=$_SESSION['userid'];
			
			//$crs="SELECT * FROM tbl_marksentryfinal WHERE deptid='$deptid' and courseid= '$courseid' and semesterid='$semesterid' and session='$session' and year='$year' and examtype='$examtype'";
  			//$crq=$myDb->select($crs);

			if($examname=="Class Test")
			{
				//$query="INSERT INTO tbl_marksentryfinal(stdid,deptid,courseid,session,year,semesterid,examname,classtestmarks,opby,opdate,storedstatus)VALUES('$stdid','$deptid','$courseid','$session','$year','$semesterid','$examname','$ctmarks','$opby','$opdate','I')";
				//if($myDb->insert_sql($query)){
				$query="Update tbl_marksentryfinal set classtestmarks='$ctmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
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
				$query="Update tbl_marksentryfinal set quiztestmarks='$ctmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
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
				$query="Update tbl_marksentryfinal set hwmarks='$ctmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
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
				$query="Update tbl_marksentryfinal set behaviormarks='$ctmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
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
				$query="Update tbl_marksentryfinal set jobexpr='$ctmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
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
				$query="Update tbl_marksentryfinal set jobexprreport='$ctmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
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
				$query="Update tbl_marksentryfinal set jobexprviva='$ctmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
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
				//echo $r="Update tbl_marksentryfinal set jobexprfinal='$ctmarks', pfinalexamstatus='$remarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'"; exit;
				$query="Update tbl_marksentryfinal set jobexprfinal='$ctmarks', pfinalexamstatus='$remarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
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
				$query="Update tbl_marksentryfinal set jobexprreportfinal='$ctmarks', pfinalexamstatus='$remarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
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
				$query="Update tbl_marksentryfinal set jobexprvivafinal='$ctmarks', pfinalexamstatus='$remarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
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
				$query="Update tbl_marksentryfinal set finalexammarks='$ctmarks', tfinalexamstatus='$remarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
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
				$query="Update tbl_marksentryfinal set finalexamprac='$ctmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
				if($myDb->update_sql($query)){
			 	
					$msg="Data inserted successfully"; 
				
		  		}else{
			 		$msg=$myDb->last_error;
		  		} 	
				//echo $msg;
			}
			else if($examname=="Midterm")
			{
				$query="Update tbl_marksentryfinal set midterm='$ctmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
				if($myDb->update_sql($query)){
			 	
					$msg="Data inserted successfully"; 
				
		  		}else{
			 		$msg=$myDb->last_error;
		  		} 	
				//echo $msg;
			}
			else if($examname=="Assignment")
			{
				$query="Update tbl_marksentryfinal set assignment='$ctmarks' WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid'";
				if($myDb->update_sql($query)){
			 	
					$msg="Data inserted successfully"; 
				
		  		}else{
			 		$msg=$myDb->last_error;
		  		} 	
				//echo $msg;
			}
			
			if($section=="A")
			{
				$queryNew="UPDATE   tbl_examinitionsettings set resultstatusA='1' Where deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid' and examtype='$examname'";
				$op=$myDb->update_sql($queryNew);
			}
			else if($section=="B")
			{
				$queryNew="UPDATE   tbl_examinitionsettings set resultstatusB='1' Where deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid' and examtype='$examname'";
				$op=$myDb->update_sql($queryNew);
			}
			else if($section=="C")
			{
				$queryNew="UPDATE   tbl_examinitionsettings set resultstatusC='1' Where deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid' and examtype='$examname'";
				$op=$myDb->update_sql($queryNew);
			}
			else if($section=="D")
			{
				$queryNew="UPDATE   tbl_examinitionsettings set resultstatusD='1' Where deptid='$deptid' and courseid='$courseid' and session='$session' and year='$year' and semesterid='$semesterid' and examtype='$examname'";
				$op=$myDb->update_sql($queryNew);
			}

			
  		}
		//$updaf="UPDATE   tbl_assignfaculty set status='1' Where facultyid='$ffrow[id]' and deptid='$_POST[deptid]' and courseid='$_POST[courseid]' and session='$_POST[sess]' and year='$_POST[year]' and semesterid='$_POST[semesterid]' and section='$_POST[section]'";
		//$afop=$myDb->update_sql($updaf);

		echo $msg;	
		
  		
  		
 	}
	else
	{
  		header("Location:index.php");
	}
}  
?>

