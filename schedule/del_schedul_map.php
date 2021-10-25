<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_time_interval.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');

	
	$dpid=mysql_real_escape_string(!empty($_GET['dpid'])?$_GET['dpid']:'');
	$semid=mysql_real_escape_string(!empty($_GET['semid'])?$_GET['semid']:'');
    $routineforid=mysql_real_escape_string(!empty($_GET['routineforid'])?$_GET['routineforid']:'');
    $dyid=mysql_real_escape_string(!empty($_GET['dyid'])?$_GET['dyid']:'');
	$ftimeid=mysql_real_escape_string(!empty($_GET['ftimeid'])?$_GET['ftimeid']:'');
	$totimeid=mysql_real_escape_string(!empty($_GET['totimeid'])?$_GET['totimeid']:'');
	$venuid=mysql_real_escape_string(!empty($_GET['venuid'])?$_GET['venuid']:'');
	$mapyear=mysql_real_escape_string(!empty($_GET['mapyear'])?$_GET['mapyear']:'');
	$yrpart=!empty($_GET['yrpart'])?mysql_real_escape_string($_GET['yrpart']):'';
	$shortname=!empty($_GET['shortname'])?mysql_real_escape_string($_GET['shortname']):'';
	$facultyid=mysql_real_escape_string(!empty($_GET['facultyid'])?$_GET['facultyid']:'');

	
	  if($_GET['facultyid']):
		$facultyid=str_replace(" "," ",$_GET['facultyid']);
	  endif;	
															
	  $myDb->update_sql("DELETE FROM tbl_schedule_map where mapyear='$mapyear' and routineforid='$routineforid' and dyid='$dyid' and interval_fid='$ftimeid' and interval_toid='$totimeid' and yrpart='$yrpart'");		
	  //$myDb->update_sql("DELETE FROM tbl_schedule_map_backup where mapyear='$mapyear' and routineforid='$routineforid' and dyid='$dyid' and interval_fid='$ftimeid' and interval_toid='$totimeid'");		
	  
	  
	  $myDb->update_sql("DELETE FROM tbl_schedule_map_teacher where mapyear='$mapyear' and facultyid='$facultyid' and dyid='$dyid' and interval_fid='$ftimeid' and interval_toid='$totimeid' and yrpart='$yrpart'");		
	  //$myDb->update_sql("DELETE FROM tbl_schedule_map_teacher_backup where mapyear='$mapyear' and facultyid='$facultyid' and dyid='$dyid' and interval_fid='$ftimeid' and interval_toid='$totimeid'");		
	  
	  $myDb->update_sql("DELETE FROM tbl_schedule_map_venue where mapyear='$mapyear' and vnuid='$venuid' and dyid='$dyid' and interval_fid='$ftimeid' and interval_toid='$totimeid' and yrpart='$yrpart'");		
	  //$myDb->update_sql("DELETE FROM tbl_schedule_map_venue_backup where mapyear='$mapyear' and vnuid='$venuid' and dyid='$dyid' and interval_fid='$ftimeid' and interval_toid='$totimeid'");		
															
	//generate department schedule
	 $tval=$myDb->select("select*from tbl_time_interval where yrpart='$yrpart' and (id not in(select interval_fid from tbl_schedule_map where routineforid='$routineforid' and dyid='$dyid' and yrpart='$yrpart' and mapyear='$mapyear')
	 															and id not in(select interval_toid from tbl_schedule_map where routineforid='$routineforid' and dyid='$dyid' and yrpart='$yrpart' and mapyear='$mapyear')) 
																
	 														   order by orderid");
	 
	  while($tvalf=$myDb->get_row($tval,'MYSQL_ASSOC')){
		if(!empty($tvalf['id'])){
			$myDb->insert_sql("INSERT INTO tbl_schedule_map(mapyear,deptid,semesterid,section,routineforid,guidefaultyid,courseid,dyid,
															interval_fid,interval_toid,vnuid,facultyid,shortName,
															orderid,yrpart)
										VALUES('$mapyear','','','','$routineforid','','','$dyid',
											   '$tvalf[id]','$tvalf[id]','','','',
											   '','$yrpart')");	
											   
		}
	  
	  
	  }	   
      //generate teacher schedule
      $tval_t=$myDb->select("select*from tbl_time_interval where yrpart='$yrpart' and  (id not in(select interval_fid from tbl_schedule_map_teacher where facultyid='$facultyid' and dyid='$dyid' and yrpart='$yrpart' and mapyear='$mapyear')
	 															and id not in(select interval_toid from tbl_schedule_map_teacher where facultyid='$facultyid' and dyid='$dyid' and yrpart='$yrpart' and mapyear='$mapyear')) 
																
	 														   order by orderid");
	 
	  while($tval_tf=$myDb->get_row($tval_t,'MYSQL_ASSOC')){
		if(!empty($tval_tf['id'])){
			$myDb->insert_sql("INSERT INTO tbl_schedule_map_teacher(mapyear,deptid,semesterid,section,routineforid,guidefaultyid,courseid,dyid,
															interval_fid,interval_toid,vnuid,facultyid,shortName,
															orderid,yrpart)
										VALUES('$mapyear','','','','','','','$dyid',
											   '$tval_tf[id]','$tval_tf[id]','','$facultyid','$shortname',
											   '','$yrpart')");	
		}
	  
	  
	  }   


	  //generate venue schedule	
      $tval_st=$myDb->select("select*from tbl_time_interval where yrpart='$yrpart' and  (id not in(select interval_fid from tbl_schedule_map_venue where vnuid='$venuid' and dyid='$dyid' and yrpart='$yrpart' and mapyear='$mapyear')
	 															and id not in(select interval_toid from tbl_schedule_map_venue where vnuid='$venuid' and dyid='$dyid' and yrpart='$yrpart' and mapyear='$mapyear')
																) 
																
	 														   order by orderid");
	 
	  while($tval_stf=$myDb->get_row($tval_st,'MYSQL_ASSOC')){
		if(!empty($tval_stf['id'])){
			$myDb->insert_sql("INSERT INTO tbl_schedule_map_venue(mapyear,deptid,semesterid,section,routineforid,guidefaultyid,courseid,dyid,
															interval_fid,interval_toid,vnuid,facultyid,shortName,
															orderid,yrpart)
										VALUES('$mapyear','','','','','','','$dyid',
											   '$tval_stf[id]','$tval_stf[id]','$venuid','','',
											   '','$yrpart')");	
		}
	  
	  
	  } 	
	  
      echo $msg="Record deleted";
	  header("Location:add_schedule_map.php?msg=$msg");
 }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
 }	 

}else{
  header("Location:index.php");
}
