<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){ 
  
  $deptid=mysql_real_escape_string($_GET['deptid']);
  $courseid=mysql_real_escape_string($_GET['courseid']);

    $cq=$myDb->select("SELECT*FROM tbl_courses WHERE id='$courseid'");
	$cqf=$myDb->get_row($cq,'MYSQL_ASSOC');

	$dq=$myDb->select("SELECT*FROM tbl_department WHERE id='$deptid'");
	$dqf=$myDb->get_row($dq,'MYSQL_ASSOC');

  
  $q=$myDb->select("SELECT courseid,deptid FROM tbl_bookentry WHERE deptid='$deptid' AND courseid='$courseid'");
  $ftch=$myDb->get_row($q,'MYSQL_ASSOC');
  if(!empty($ftch['deptid']) && !empty($ftch['courseid'])){
     $msg="<script>  
			 $(document).ready(function() {
			   $('#courseid').focus(function(){
					$('#chkbook').hide('slow');
			   });
			 
			 
			 });
			  </script>
		  ";
	$myDb->last_error="Course {$cqf['coursename']} for department {$dqf['name']} </br>already in the database.";
	echo $myDb->last_error.$msg;
	exit;
  }else{
     $msg="<script>  
			 $(document).ready(function() {
					$('#chkbook').hide();
			 
			 
			 
			 });
			  </script>
		  ";
  echo $msg;
 
  }	
  
  
}else{
  header("Location:index.php");
}
}