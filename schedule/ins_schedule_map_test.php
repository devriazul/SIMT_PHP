<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_time_interval.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){

    $mapyear=mysql_real_escape_string(!empty($_POST['mapyear'])?$_POST['mapyear']:'');
	$deptid=mysql_real_escape_string(!empty($_POST['mdeptid'])?$_POST['mdeptid']:'');
	$semesterid=mysql_real_escape_string(!empty($_POST['semesterid'])?$_POST['semesterid']:'');
	$section=mysql_real_escape_string(!empty($_POST['section'])?$_POST['section']:'');
    $routineforid=mysql_real_escape_string(!empty($_POST['ownid'])?$_POST['ownid']:'');
    $guideteacher=mysql_real_escape_string(!empty($_POST['guideteacher'])?$_POST['guideteacher']:'');
	$coursecode=mysql_real_escape_string(!empty($_POST['coursecode'])?$_POST['coursecode']:'');
    $dyid=mysql_real_escape_string(!empty($_POST['dyid'])?$_POST['dyid']:'');
	echo $interval_fid=mysql_real_escape_string(!empty($_POST['frmtime'])?$_POST['frmtime']:'');
	echo $interval_toid=mysql_real_escape_string(!empty($_POST['totime'])?$_POST['totime']:'');
	$vnuid=mysql_real_escape_string(!empty($_POST['roomno'])?$_POST['roomno']:'');
	$facultyid=mysql_real_escape_string(!empty($_POST['facultyid'])?$_POST['facultyid']:'');
	$shortName=mysql_real_escape_string(!empty($_POST['shortname'])?$_POST['shortname']:'');
	$theory=mysql_real_escape_string(!empty($_POST['theory'])?$_POST['theory']:'');
	$practical=mysql_real_escape_string(!empty($_POST['practical'])?$_POST['practical']:'');
	$yrpart=mysql_real_escape_string(!empty($_POST['yrpart'])?$_POST['yrpart']:'');
	
	exit;
   //separate facultyid from value;
   $agname=explode('->',$guideteacher);
   $arr=array();
   $arr=$agname;
   $guidefaultyid=$arr[0];  //$guidfacultyid=$arr[1];
   
   //separate coursecode from value;
   
   $crscode=explode('->',$coursecode);
   $ccode=array();
   $ccode=$crscode;
   $coursecode=$ccode[0];
   
   
   //separate facultyid from value;
   $fltid=explode('->',$facultyid);
   $farr=array();
   $farr=$fltid;
   $faculty=$farr[0];  // $facultyid=$farr[1];
   
	 include("check_course_code.php");
	 
	 //generate department schedule
	 $tval=$myDb->select("select*from tbl_time_interval where (id not in(select interval_fid from tbl_schedule_map where routineforid='$routineforid' and dyid='$dyid' and yrpart='$yrpart' and mapyear='$mapyear')
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
      $tval_t=$myDb->select("select*from tbl_time_interval where (id not in(select interval_fid from tbl_schedule_map_teacher where facultyid='$faculty' and dyid='$dyid' and yrpart='$yrpart' and mapyear='$mapyear')
	 															and id not in(select interval_toid from tbl_schedule_map_teacher where facultyid='$faculty' and dyid='$dyid' and yrpart='$yrpart' and mapyear='$mapyear')) 
	 														   order by orderid");
	  while($tval_tf=$myDb->get_row($tval_t,'MYSQL_ASSOC')){
		if(!empty($tval_tf['id'])){
			$myDb->insert_sql("INSERT INTO tbl_schedule_map_teacher(mapyear,deptid,semesterid,section,routineforid,guidefaultyid,courseid,dyid,
															interval_fid,interval_toid,vnuid,facultyid,shortName,
															orderid,yrpart)
										VALUES('$mapyear','','','','','','','$dyid',
											   '$tval_tf[id]','$tval_tf[id]','','$faculty','',
											   '','$yrpart')");	
		}
	  }   
	  //generate venue schedule	
      $tval_st=$myDb->select("select*from tbl_time_interval where (id not in(select interval_fid from tbl_schedule_map_venue where vnuid='$vnuid' and dyid='$dyid' and yrpart='$yrpart' and mapyear='$mapyear')
	 															and id not in(select interval_toid from tbl_schedule_map_venue where vnuid='$vnuid' and dyid='$dyid' and yrpart='$yrpart' and mapyear='$mapyear')
																) 
	 														   order by orderid");
	  while($tval_stf=$myDb->get_row($tval_st,'MYSQL_ASSOC')){
		if(!empty($tval_stf['id'])){
			$myDb->insert_sql("INSERT INTO tbl_schedule_map_venue(mapyear,deptid,semesterid,section,routineforid,guidefaultyid,courseid,dyid,
															interval_fid,interval_toid,vnuid,facultyid,shortName,
															orderid,yrpart)
										VALUES('$mapyear','','','','','','','$dyid',
											   '$tval_stf[id]','$tval_stf[id]','$vnuid','','',
											   '','$yrpart')");	
		}
	  }   
	  //generate section
	  if(!empty($section)){
		  $tval_t=$myDb->select("select*from tbl_time_interval where (id not in(select interval_fid from tbl_schedule_map_section where routineforid='$routineforid' and dyid='$dyid' and yrpart='$yrpart' and mapyear='$mapyear')
																	and id not in(select interval_toid from tbl_schedule_map_section where routineforid='$routineforid' and dyid='$dyid' and yrpart='$yrpart' and mapyear='$mapyear')
																	) 
																   order by orderid");
		  while($tval_tf=$myDb->get_row($tval_t,'MYSQL_ASSOC')){
			if(!empty($tval_tf['id'])){
				$myDb->insert_sql("INSERT INTO tbl_schedule_map_section(mapyear,deptid,semesterid,section,routineforid,guidefaultyid,courseid,dyid,
																interval_fid,interval_toid,vnuid,facultyid,shortName,
																orderid,yrpart)
											VALUES('$mapyear','','','$section','$routineforid','','','$dyid',
												   '$tval_tf[id]','$tval_tf[id]','','','',
												   '','$yrpart')");	
			}
		  }   
	  }
   if(!empty($routineforid)&&!empty($guideteacher)&&!empty($coursecode)&&!empty($dyid)&&
      !empty($interval_fid)&&!empty($interval_toid)&&!empty($vnuid)&&!empty($facultyid)&&
	  !empty($shortName)){
	  $myDb->update_sql("DELETE FROM tbl_schedule_map where interval_fid between '$interval_fid' and '$interval_fid' and dyid='$dyid' and routineforid='$routineforid' and yrpart='$yrpart' and mapyear='$mapyear'");
	  $myDb->update_sql("DELETE FROM tbl_schedule_map where interval_fid between '$interval_toid' and '$interval_toid' and dyid='$dyid' and routineforid='$routineforid' and yrpart='$yrpart' and mapyear='$mapyear'");
	  if($myDb->insert_sql("INSERT INTO tbl_schedule_map(mapyear,deptid,semesterid,section,routineforid,guidefaultyid,courseid,theory,practical,dyid,
	  													interval_fid,interval_toid,vnuid,facultyid,shortName,yrpart)
									VALUES('$mapyear','$deptid','$semesterid','$section','$routineforid','$guidefaultyid','$coursecode','$theory','$practical','$dyid',
										   '$interval_fid','$interval_toid','$vnuid','$faculty','$shortName','$yrpart')")){
	      $tchmp=$myDb->select("select*from tbl_schedule_map_teacher where facultyid='$faculty' and dyid='$dyid' and yrpart='$yrpart'");
		  //echo "select*from tbl_schedule_map_teacher where facultyid='$faculty' and dyid='$dyid'";
		  //exit;
		  $tchmpf=$myDb->get_row($tchmp,'MYSQL_ASSOC');
		  if($tchmpf['facultyid']==$faculty){
			  $myDb->update_sql("DELETE FROM tbl_schedule_map_teacher where interval_fid between '$interval_fid' and '$interval_fid' and dyid='$dyid' and facultyid='$faculty' and yrpart='$yrpart' and mapyear='$mapyear'");
			  $myDb->update_sql("DELETE FROM tbl_schedule_map_teacher where interval_fid between '$interval_toid' and '$interval_toid' and dyid='$dyid' and facultyid='$faculty' and yrpart='$yrpart' and mapyear='$mapyear'");
			  $myDb->insert_sql("INSERT INTO tbl_schedule_map_teacher(mapyear,deptid,semesterid,section,routineforid,guidefaultyid,courseid,theory,practical,dyid,
															interval_fid,interval_toid,vnuid,facultyid,shortName,yrpart)
										VALUES('$mapyear','$deptid','$semesterid','$section','$routineforid','$guidefaultyid','$coursecode','$theory','$practical','$dyid',
											   '$interval_fid','$interval_toid','$vnuid','$faculty','$shortName','$yrpart')");  
		  }
		  $vnq=$myDb->select("select*from tbl_schedule_map_venue where vnuid='$vnuid' and dyid='$dyid' and yrpart='$yrpart'");
		  $vnqf=$myDb->get_row($vnq,'MYSQL_ASSOC');
		  if($vnqf['vnuid']==$vnuid	){
			  $myDb->update_sql("DELETE FROM tbl_schedule_map_venue where interval_fid between '$interval_fid' and '$interval_fid' and dyid='$dyid' and vnuid='$vnuid' and yrpart='$yrpart' and mapyear='$mapyear'");
			  $myDb->update_sql("DELETE FROM tbl_schedule_map_venue where interval_fid between '$interval_toid' and '$interval_toid' and dyid='$dyid' and vnuid='$vnuid' and yrpart='$yrpart' and mapyear='$mapyear'");
			  $myDb->insert_sql("INSERT INTO tbl_schedule_map_venue(mapyear,deptid,semesterid,section,routineforid,guidefaultyid,courseid,theory,practical,dyid,
															interval_fid,interval_toid,vnuid,facultyid,shortName,yrpart)
										VALUES('$mapyear','$deptid','$semesterid','$section','$routineforid','$guidefaultyid','$coursecode','$theory','$practical','$dyid',
											   '$interval_fid','$interval_toid','$vnuid','$faculty','$shortName','$yrpart')");  
		  }
		  if(!empty($section)){ 
			  $sq=$myDb->select("select*from tbl_schedule_map_section where routineforid='$routineforid' and dyid='$dyid' and yrpart='$yrpart'");
			  $sqf=$myDb->get_row($sq,'MYSQL_ASSOC');
			  if($sqf['section']==$section){
				  $myDb->update_sql("DELETE FROM tbl_schedule_map_section where interval_fid between '$interval_fid' and '$interval_fid' and routineforid='$routineforid' and dyid='$dyid' and yrpart='$yrpart' and mapyear='$mapyear'");
				  $myDb->update_sql("DELETE FROM tbl_schedule_map_section where interval_fid between '$interval_toid' and '$interval_toid' and routineforid='$routineforid' and dyid='$dyid' and yrpart='$yrpart' and mapyear='$mapyear'");
				  $myDb->insert_sql("INSERT INTO tbl_schedule_map_section(mapyear,deptid,semesterid,section,routineforid,guidefaultyid,courseid,theory,practical,dyid,
																interval_fid,interval_toid,vnuid,facultyid,shortName,
																orderid,yrpart)
											VALUES('$mapyear','$deptid','$semesterid','$section','$routineforid','$guidefaultyid','$coursecode','$theory','$practical','$dyid',
												   '$interval_fid','$interval_toid','$vnuid','$faculty','$shortName',
												   '$orderid','$yrpart')");  
			  }
		  }
      echo "<div style='width:500px; padding:5px; height:25px;background-color:#999999; color:#FFFFFF;font-size:13px;'>Record successfully saved</div>";
	  }else{
	    echo $myDb->last_error;
	  
	  }													
	  
	  
   }  

 }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
 }	 

}else{
  header("Location:index.php");
}
}