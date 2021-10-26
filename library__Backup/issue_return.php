<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){ 
    $session=!empty($_POST['session'])?$_POST['session']:$_GET['session'];
    $semesterid=!empty($_POST['semesterid'])?$_POST['semesterid']:$_GET['semesterid'];

	$stdid=mysql_real_escape_string($_POST['stdid']);
	$opby=mysql_real_escape_string($_SESSION['userid']);
	$courseid=mysql_real_escape_string($_POST['courseid']);
	$bookid=mysql_real_escape_string($_POST['bookid']);
	$session=mysql_real_escape_string($session);
	$issue=mysql_real_escape_string($_POST['issue']);
	$fine=mysql_real_escape_string($_POST['fine']);
	$rowid=mysql_real_escape_string($_GET['rowid']); 
	$deptid=mysql_real_escape_string($_POST['deptid']);
	$semesterid=mysql_real_escape_string($semesterid);
	//include("check_return.php"); 
	
	$chkb=$myDb->select("SELECT*,substr(stdid,1,1) bstdid FROM tbl_bookissue WHERE stdid='$stdid' AND courseid='$courseid' AND bookid='$bookid' AND fine=0.00 AND irstatus='ISSUE'");
	$cbf=$myDb->get_row($chkb,'MYSQL_ASSOC');
	if(!empty($cbf['stdid'])){
	  
			$lss=$myDb->select("select*from tbl_libsetting");
			$lssf=$myDb->get_row($lss,'MYSQL_ASSOC');
			if(($cbf['bstdid']!="F")&&($lssf['stdfine']=="y")){
					$issb=$myDb->select("SELECT*,DATEDIFF(curdate(),returndate) as dated,curdate()  as currentdate FROM tbl_bookissue 
										WHERE stdid='$stdid' and irstatus='ISSUE' 
										and (`return`<>'R' or `return`='R')
										and fine=0
										AND courseid='$cbf[courseid]' AND bookid='$cbf[bookid]'
										and returndate<curdate()");
					$sum=0;
					$issbf=$myDb->get_row($issb,'MYSQL_ASSOC');
					   
						if(!empty($issbf['id'])){
						
						   $crrs=$myDb->select("SELECT*FROM tbl_courses WHERE id='$issbf[courseid]'");
						   $crrsf=$myDb->get_row($crrs,'MYSQL_ASSOC');
						   $sum=($sum+($issbf['dated']*$lssf['fine']));
						  
						   echo "<br/>";
						   
							$cdate=$myDb->select("select curdate() cdate");
							$cdatef=$myDb->get_row($cdate,'MYSQL_ASSOC');
							$rtu="UPDATE tbl_bookissue
								  SET rcvdate='$cdatef[cdate]',
								  `return`='R',
								  opby='$_SESSION[userid]',
								  storedstatus='U',
								  fine='$sum',
								  irstatus='RETURN'
								  where stdid='$stdid'
								  and bookid='$bookid'
								  and courseid='$courseid'
								  ";
							if($ru=$myDb->update_sql($rtu)){
							   echo "Your book is return successfully";	  
							}else{
							   echo $myDb->last_error;
							}				
						
						}else{
							$cdate=$myDb->select("select curdate() cdate");
							$cdatef=$myDb->get_row($cdate,'MYSQL_ASSOC');
							$rtu="UPDATE tbl_bookissue
								  SET rcvdate='$cdatef[cdate]',
								  `return`='R',
								  opby='$_SESSION[userid]',
								  storedstatus='U',
								  irstatus='RETURN'
								  where stdid='$stdid'
								  and bookid='$bookid'
								  and courseid='$courseid'
								  ";
							if($ru=$myDb->update_sql($rtu)){
							   echo "Your book is return successfully";	  
							}else{
							   echo $myDb->last_error;
							}				
						
						} 
					
	        }else if(($cbf['bstdid']!="F")&&($lssf['stdfine']=="n")){
					
						   
							$cdate=$myDb->select("select curdate() cdate");
							$cdatef=$myDb->get_row($cdate,'MYSQL_ASSOC');
							$rtu="UPDATE tbl_bookissue
								  SET rcvdate='$cdatef[cdate]',
								  `return`='R',
								  opby='$_SESSION[userid]',
								  storedstatus='U',
								  irstatus='RETURN'
								  where stdid='$stdid'
								  and bookid='$bookid'
								  and courseid='$courseid'
								  ";
							if($ru=$myDb->update_sql($rtu)){
							   echo "Your book is return successfully";	  
							}else{
							   echo $myDb->last_error;
							}				
			
	        }else if(($cbf['bstdid']=="F")&&($lssf['teacherfine']=="y")){
					$issb=$myDb->select("SELECT*,DATEDIFF(curdate(),returndate) as dated,curdate()  as currentdate FROM tbl_bookissue 
										WHERE stdid='$stdid' and irstatus='ISSUE' 
										and (`return`<>'R' or `return`='R')
										and fine=0
										AND courseid='$cbf[courseid]' AND bookid='$cbf[bookid]'
										and returndate<curdate()");
					$sum=0;
					$issbf=$myDb->get_row($issb,'MYSQL_ASSOC');
					   
						if(!empty($issbf['id'])){
						
						   $crrs=$myDb->select("SELECT*FROM tbl_courses WHERE id='$issbf[courseid]'");
						   $crrsf=$myDb->get_row($crrs,'MYSQL_ASSOC');
						   $sum=($sum+($issbf['dated']*$lssf['fine']));
						  
						   echo "<br/>";
						   
							$cdate=$myDb->select("select curdate() cdate");
							$cdatef=$myDb->get_row($cdate,'MYSQL_ASSOC');
							$rtu="UPDATE tbl_bookissue
								  SET rcvdate='$cdatef[cdate]',
								  `return`='R',
								  opby='$_SESSION[userid]',
								  storedstatus='U',
								  fine='$sum',
								  irstatus='RETURN'
								  where stdid='$stdid'
								  and bookid='$bookid'
								  and courseid='$courseid'
								  ";
							if($ru=$myDb->update_sql($rtu)){
							   echo "Your book is return successfully";	  
							}else{
							   echo $myDb->last_error;
							}				
						
						}else{
							$cdate=$myDb->select("select curdate() cdate");
							$cdatef=$myDb->get_row($cdate,'MYSQL_ASSOC');
							$rtu="UPDATE tbl_bookissue
								  SET rcvdate='$cdatef[cdate]',
								  `return`='R',
								  opby='$_SESSION[userid]',
								  storedstatus='U',
								  irstatus='RETURN'
								  where stdid='$stdid'
								  and bookid='$bookid'
								  and courseid='$courseid'
								  ";
							if($ru=$myDb->update_sql($rtu)){
							   echo "Your book is return successfully";	  
							}else{
							   echo $myDb->last_error;
							}				
						
						} 
					
	        }else if(($cbf['bstdid']=="F")&&($lssf['teacherfine']=="n")){
					
						   
							$cdate=$myDb->select("select curdate() cdate");
							$cdatef=$myDb->get_row($cdate,'MYSQL_ASSOC');
							$rtu="UPDATE tbl_bookissue
								  SET rcvdate='$cdatef[cdate]',
								  `return`='R',
								  opby='$_SESSION[userid]',
								  storedstatus='U',
								  irstatus='RETURN'
								  where stdid='$stdid'
								  and bookid='$bookid'
								  and courseid='$courseid'
								  ";
							if($ru=$myDb->update_sql($rtu)){
							   echo "Your book is return successfully";	  
							}else{
							   echo $myDb->last_error;
							}				
			
	        }	
			 
	}else{
	  echo "This book is not issued to you";
	}    	   
	
	
	
}else{
  header("Location:index.php");
}
}	