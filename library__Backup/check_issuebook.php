<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){ 
	$stdid=mysql_real_escape_string($_GET['stdid']);
	$opby=mysql_real_escape_string($_SESSION['userid']);
	
	$ls=$myDb->select("select*from tbl_libsetting");
	$lsf=$myDb->get_row($ls,'MYSQL_ASSOC');
	
	$tbq=$myDb->select("select ifnull(count(*),0) totalbook from tbl_bookissue WHERE stdid='$stdid' and irstatus='ISSUE'");
	$tbf=$myDb->get_row($tbq,'MYSQL_ASSOC');
	
	$isb=$myDb->select("SELECT*,DATEDIFF(curdate(),returndate) as dated,curdate()  as currentdate FROM tbl_bookissue 
	                    WHERE stdid='$stdid' and irstatus='ISSUE' 
						and returndate<=curdate()");
	while($isbf=$myDb->get_row($isb,'MYSQL_ASSOC')){
	   
	    if(isset($isbf['id'])){
		   $crs=$myDb->select("SELECT*FROM tbl_courses WHERE id='$isbf[courseid]'");
		   $crsf=$myDb->get_row($crs,'MYSQL_ASSOC');
		  
		   echo round($isbf['dated']*$lsf['fine']); 
		}
	
	}
				
}else{
  header("Location:login.php");
}
}  
?>