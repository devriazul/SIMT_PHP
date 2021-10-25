<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){ 
  
	include("check_issue.php"); /* if not vaiolate any rule according to the law you can proceed otherwise stop it and kill the process */
    $session=!empty($_POST['session'])?$_POST['session']:$_GET['session'];
    $semesterid=!empty($_POST['semesterid'])?$_POST['semesterid']:$_GET['semesterid'];
	
	$stdid=mysql_real_escape_string($_POST['stdid']);
	$opby=mysql_real_escape_string($_SESSION['userid']);
	$courseid=mysql_real_escape_string($_POST['courseid']);
	$bookid=mysql_real_escape_string($_POST['bookid']);
	$session=mysql_real_escape_string($session);
	$issue=mysql_real_escape_string($_POST['issue']);
	
	$deptid=mysql_real_escape_string($_POST['deptid']);
	$semesterid=mysql_real_escape_string($semesterid);
	
	$ls=$myDb->select("select*,DATE_ADD('$issue',INTERVAL totaldays DAY) rdate from tbl_libsetting");
	$lsf=$myDb->get_row($ls,'MYSQL_ASSOC');
	
	//echo "The return date is:".$lsf['rdate'];
	//exit;
	
	//$return=(mysql_real_escape_string($_POST['issue']);
	
	
	$bq=$myDb->select("SELECT*FROM tbl_bookentry WHERE bookid='$_POST[bookid]'");
    $bqf=$myDb->get_row($bq,'MYSQL_ASSOC');
	
	//Query courseid from courses table for checking is this book issued or not;
	$crsq=$myDb->select("select*from tbl_courses where id='$bqf[courseid]'");
	$crsf=$myDb->get_row($crsq,'MYSQL_ASSOC');
	
	/*Check the stock for courses is available or not */
	$bkq=$myDb->select("SELECT sum(totalbook) totalbook FROM tbl_bookentry WHERE courseid='$crsf[id]'");
	$bkqf=$myDb->get_row($bkq,'MYSQL_ASSOC');
	
	
	$bki=$myDb->select("SELECT ifnull(count(irstatus),0) totalissue,(SELECT count(`return`)  from 
	                                                                 tbl_bookissue
																	 where `return`='R') totalreturn 
	                    FROM tbl_bookissue
						WHERE courseid='$crsf[id]'
						AND irstatus='ISSUE'");
	$bkif=$myDb->get_row($bki,'MYSQL_ASSOC');	
	
	$avi=(($bkqf['totalbook'])+($bkif['totalissue']-$bkif['totalreturn']));
	if($avi<=0){	/* if less than 0 stock empty*/
	
			echo "This Book ".$crsf['coursename']." are not in stock";
	
	
	}else{		/* if gater than 0 stock available */						

	
			$tbq=$myDb->select("select ifnull(count(*),0) totalbook from tbl_bookissue WHERE stdid='$stdid' and irstatus='ISSUE' and `return`<>'R'");
			$tbf=$myDb->get_row($tbq,'MYSQL_ASSOC');
			
			$isb=$myDb->select("SELECT*,DATEDIFF(curdate(),returndate) as dated,curdate()  as currentdate 
			                    FROM tbl_bookissue WHERE stdid='$stdid' and courseid='$crsf[id]' and irstatus='ISSUE' and `return`<>'R'");
			$isbf=$myDb->get_row($isb,'MYSQL_ASSOC');
			
			if(!isset($isbf['courseid'])){ /* if not set courseid that means you can take the course it is available for you */
		
							
									$query="INSERT INTO tbl_bookissue(`courseid`,`deptid`,`stdid`,`session`,`issuedate`,
												  `returndate`,`irstatus`,`bookid`,`semesterid`,`opby`,`storedstatus`)            
									VALUES('$courseid','$deptid','$stdid','$session','$issue','$lsf[rdate]','ISSUE','$bookid','$semesterid','$opby','I')";
									if($r=$myDb->insert_sql($query)){
									  $msg="Data inserted successfully";
									  echo $msg;
									}else{
									  $msg=$myDb->last_error;  
									  echo $msg;
									}
			}else{
								echo "This book is already issued to you";
			
			}
	
	}							
				
}else{
  header("Location:login.php");
}
}  
?>