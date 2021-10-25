<?php
ob_start();
@session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_schedule_map.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
    $mapyear=mysql_real_escape_string(!empty($_POST['mapyear'])?$_POST['mapyear']:'');
   $mdeptid=mysql_real_escape_string(!empty($_POST['mdeptid'])?$_POST['mdeptid']:'');
   $semesterid=mysql_real_escape_string(!empty($_POST['semesterid'])?$_POST['semesterid']:'');
   $section=mysql_real_escape_string(!empty($_POST['section'])?$_POST['section']:'');
   $coursecode=mysql_real_escape_string(!empty($_POST['coursecode'])?$_POST['coursecode']:'');
   $dyid=mysql_real_escape_string(!empty($_POST['dyid'])?$_POST['dyid']:'');
   $frmtime=mysql_real_escape_string(!empty($_POST['frmtime'])?$_POST['frmtime']:'');
   $totime=mysql_real_escape_string(!empty($_POST['totime'])?$_POST['totime']:'');
   $vname=mysql_real_escape_string(!empty($_POST['vname'])?$_POST['vname']:'');
   $roomno=mysql_real_escape_string(!empty($_POST['roomno'])?$_POST['roomno']:'');
   $routineforid=mysql_real_escape_string(!empty($_POST['ownid'])?$_POST['ownid']:'');
   $facultyid=mysql_real_escape_string(!empty($_POST['facultyid'])?$_POST['facultyid']:'');
   $yrpart=mysql_real_escape_string(!empty($_POST['yrpart'])?$_POST['yrpart']:'');
   $crscode=explode('->',$coursecode);
   $ccode=array();
   $ccode=$crscode;
   $coursecode=$ccode[0];
   
	if(isset($facultyid)){
		$teacher=$facultyid?mysql_real_escape_string($facultyid):'';
		$fid=explode('->',$teacher);
		$farr=array();
		$farr=$fid;
		$teacher=$farr[0];
	}
   $chq=$myDb->select("select c.id,c.mapyear 'Year',d.code,c.section,s.name semname,rm.alias 'Routine Owner',rm.id routineforid,gm.facultyid guidefacultyid,
								   gm.name,gm.contactno,cm.coursecode,dm.dyname dayname,dm.id dyid,
								   ftm.id ftimeid,ftm.intervalName frominterval,ftm.ordernum,ttm.id totimeid ,
								   ttm.intervalName tointerval,vm.id venuid,vm.venuname,vm.roomno,
								   fm.facultyid,fm.name 'Faculty Name',c.shortName,c.interval_fid,c.interval_toid
						from tbl_schedule_map c
						left join tbl_department d
						on d.id=c.deptid
						left join tbl_semester s
						on s.id=c.semesterid
						left join tbl_routine_for rm
						on c.routineforid=rm.id
						left join tbl_faculty gm
						on c.guidefaultyid=gm.facultyid
						left join tbl_courses cm
						on cm.coursecode=c.courseid
						left join tbl_schedule_day dm
						on dm.id=c.dyid
						left join  tbl_time_interval ftm
						on ftm.id=c.interval_fid
						left join tbl_time_interval ttm
						on ttm.id=c.interval_toid
						left join tbl_venue vm
						on c.vnuid=vm.id
						left join tbl_faculty fm
						on fm.facultyid=c.facultyid
						WHERE c.mapyear='$mapyear'
						and c.yrpart='$yrpart'
						and c.dyid='$dyid'
						and c.vnuid='$roomno'
						order by c.interval_fid
                     ");
   
	while($chqf=$myDb->get_row($chq,'MYSQL_ASSOC')){
		if((($frmtime==$chqf['interval_fid'])||($totime==$chqf['interval_toid']))||(($totime==$chqf['interval_fid'])||($frmtime==$chqf['interval_toid']))){
		  echo "<div id='smsg' style='width:550px; padding:5px; height:auto;overflow:auto;background-color:#FF3300; color:#FFFFFF;font-size:13px; font-weight:bold;'>";
		   echo "<img src=\"images\error.jpg\" style=\"float:left;\" />";
		   echo "Schedule not fitted, please see the history bellow "."<br/>";
		   echo "Course Code: ".$chqf['coursecode']."<br/>";
		   echo "Department ID: ".$chqf['code']."<br/>";
		   echo "Semester Name: ".$chqf['semname']."<br/>";
		   echo "From period: ".$chqf['frominterval']." To period: ".$chqf['tointerval']."<br/>";
		   echo "Day: ".$chqf['dayname']."<br/>";
		   echo "Faculty: ".$chqf['Faculty Name']."<br/>";
		   echo "Faculty: ".$chqf['facultyid']."<br/>";
		   echo "Venu: ".$chqf['venuname']."R - ".$chqf['roomno'];
		   echo "</div>";  
		   exit;
		}
		echo "<br/>";
	}
	
						
    $chqd=$myDb->select("select c.id,c.mapyear 'Year',d.code,c.section,s.name semname,rm.alias 'Routine Owner',rm.id routineforid,gm.facultyid guidefacultyid,
								   gm.name,gm.contactno,cm.coursecode,dm.dyname dayname,dm.id dyid,
								   ftm.id ftimeid,ftm.intervalName frominterval,ftm.ordernum,ttm.id totimeid ,
								   ttm.intervalName tointerval,vm.id venuid,vm.venuname,vm.roomno,
								   fm.facultyid,fm.name 'Faculty Name',c.shortName,c.interval_fid,c.interval_toid
						from tbl_schedule_map c
						inner join tbl_department d
						on d.id=c.deptid
						inner join tbl_semester s
						on s.id=c.semesterid
						inner join tbl_routine_for rm
						on c.routineforid=rm.id
						inner join tbl_faculty gm
						on c.guidefaultyid=gm.facultyid
						inner join tbl_courses cm
						on cm.coursecode=c.courseid
						inner join tbl_schedule_day dm
						on dm.id=c.dyid
						inner join  tbl_time_interval ftm
						on ftm.id=c.interval_fid
						inner join tbl_time_interval ttm
						on ttm.id=c.interval_toid
						inner join tbl_venue vm
						on c.vnuid=vm.id
						inner join tbl_faculty fm
						on fm.facultyid=c.facultyid
						WHERE c.mapyear='$mapyear'
						and c.yrpart='$yrpart'
						and c.dyid='$dyid'
						and c.routineforid='$routineforid'
						order by c.interval_fid
                     ");
					 
   
	while($chqdf=$myDb->get_row($chqd,'MYSQL_ASSOC')){ 
		if((($frmtime==$chqdf['interval_fid'])||($totime==$chqdf['interval_toid']))||(($totime==$chqdf['interval_fid'])||($frmtime==$chqdf['interval_toid'])||
		($coursecode==$chqdf['coursecode']))){
		  echo "<div id='smsg' style='width:550px; padding:5px; height:auto; overflow:auto;background-color:#FF3300; color:#FFFFFF;font-size:13px; font-weight:bold;'>";
		   echo "<img src=\"images\error.jpg\" style=\"float:left;\" />";
		   echo "Schedule not fitted, please see the history bellow "."<br/>";
		   echo "Course Code: ".$chqdf['coursecode']."<br/>";
		   echo "Department ID: ".$chqdf['code']."<br/>";
		   echo "Semester Name: ".$chqdf['semname']."<br/>";
		   echo "From period: ".$chqdf['frominterval']." To period: ".$chqdf['tointerval']."<br/>";
		   echo "Day: ".$chqdf['dayname']."<br/>";
		   echo "Faculty: ".$chqdf['Faculty Name']."<br/>";
		   echo "Faculty ID: ".$chqdf['facultyid']."<br/>";
		   echo "Venu: ".$chqdf['venuname'].$chqdf['roomno'];
		   echo "</div>";  
		   exit;
		}
	}
	
	
    $ftq=$myDb->select("select c.id,c.mapyear 'Year',d.code,c.section,s.name semname,rm.alias 'Routine Owner',rm.id routineforid,gm.facultyid guidefacultyid,
								   gm.name,gm.contactno,cm.coursecode,dm.dyname dayname,dm.id dyid,
								   ftm.id ftimeid,ftm.intervalName frominterval,ftm.ordernum,ttm.id totimeid ,
								   ttm.intervalName tointerval,vm.id venuid,vm.venuname,vm.roomno,
								   fm.facultyid,fm.name 'Faculty Name',c.shortName,c.interval_fid,c.interval_toid
						from tbl_schedule_map c
						inner join tbl_department d
						on d.id=c.deptid
						inner join tbl_semester s
						on s.id=c.semesterid
						inner join tbl_routine_for rm
						on c.routineforid=rm.id
						inner join tbl_faculty gm
						on c.guidefaultyid=gm.facultyid
						inner join tbl_courses cm
						on cm.coursecode=c.courseid
						inner join tbl_schedule_day dm
						on dm.id=c.dyid
						inner join  tbl_time_interval ftm
						on ftm.id=c.interval_fid
						inner join tbl_time_interval ttm
						on ttm.id=c.interval_toid
						inner join tbl_venue vm
						on c.vnuid=vm.id
						inner join tbl_faculty fm
						on fm.facultyid=c.facultyid
						WHERE c.mapyear='$mapyear'
						and c.yrpart='$yrpart'
						and c.dyid='$dyid'
						and c.facultyid='$teacher'
						and (c.interval_fid='$frmtime'
						or c.interval_toid='$totime'
						or c.interval_fid='$totime'
						or c.interval_toid='$frmtime')
						order by c.interval_fid
                     ");
	 
    
	while($ftqf=$myDb->get_row($ftq,'MYSQL_ASSOC')){
		if((($frmtime==$ftqf['interval_fid'])||($totime==$ftqf['interval_toid']))||(($totime==$ftqf['interval_fid'])||($frmtime==$ftqf['interval_toid']))){
		  echo "<div id='smsg' style='width:550px; padding:5px; height:auto;overflow:auto;background-color:#FF3300; color:#FFFFFF;font-size:13px; font-weight:bold;'>";
		   echo "<img src=\"images\error.jpg\" style=\"float:left;\" />";
		   echo "Schedule not fitted, please see the history bellow "."<br/>";
		   echo "Faculty: ".$ftqf['Faculty Name']."<br/>";
		   echo "Faculty ID: ".$ftqf['facultyid']."<br/>";
		   echo "Course Code: ".$ftqf['coursecode']."<br/>";
		   echo "Department ID: ".$ftqf['code']."<br/>";
		   echo "Semester Name: ".$ftqf['semname']."<br/>";
		   echo "From period: ".$ftqf['frominterval']." To period: ".$ftqf['tointerval']."<br/>";
		   echo "Day: ".$ftqf['dayname']."<br/>";
		   echo "Venu: ".$ftqf['venuname'].$ftqf['roomno'];
		   echo "</div>";  
		   exit;
		}
	}	
	
?>

<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}
