<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_schedule_map.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
    if(!empty($_POST['facultyid'])){
	$facultyid=mysql_real_escape_string(!empty($_POST['facultyid'])?$_POST['facultyid']:'');
	   //separate facultyid from value;
	   $fltid=explode('->',$facultyid);
	   $farr=array();
	   $farr=$fltid;
	   $facultyid=$farr[0];  // $facultyid=$farr[1];
	}
	if(!empty($_POST['deptid'])){
		$deptid=mysql_real_escape_string(!empty($_POST['deptid'])?$_POST['deptid']:'');
	}
	if(!empty($_POST['roomno'])){
		$vnuid=mysql_real_escape_string(!empty($_POST['roomno'])?$_POST['roomno']:'');
	}
	
	if(!empty($_POST['ownid'])){
		$routineforid=mysql_real_escape_string(!empty($_POST['ownid'])?$_POST['ownid']:'');
	}
	
	if(!empty($_POST['section'])){
		$section=mysql_real_escape_string(!empty($_POST['section'])?$_POST['section']:'');
	}
?>
<style type="text/css">
  table td{
     padding:2px;
	 font-family:"Times New Roman", Times, serif;
	 font-size:11px;
	 border:1px solid #333333;
  }	 
  .timeclass{
    width:800px;
	margin:0 auto;
  }	
</style>
<div style="width:500px; margin:0 auto; ">
<h2>SAIC Institute of Management & Technology</h2>
<h4 align="center">Mirpur-6, Dhaka-1216<br/>Class Schedule-2014</h4>
</div>

  <?php 
  if(!empty($routineforid)){
  $tabrec=$myDb->select("select distinct f.name,f.contactno,d.code,c.section,s.name semestername
  								from tbl_schedule_map c
								inner join tbl_faculty f
								on c.guidefaultyid=f.facultyid
								inner join tbl_department d
								on d.id=c.deptid
								inner join tbl_semester s
								on c.semesterid=s.id
								where c.routineforid='$routineforid'
								and c.mapyear='".date("Y")."'
								");
  $tabrecf=$myDb->get_row($tabrec,'MYSQL_ASSOC');
  $sem=substr($tabrecf['semestername'],0,3);
  echo "<div style='width:800px;margin:0 auto; font-weight:bold;'><div style='width:400px; float:left;'>Guide Teacher: {$tabrecf['name']}<br/>Phone: {$tabrecf['contactno']}</div>
        <div style='float:right; width:200px;'>{$tabrecf['code']}-{$sem}</div>
  </div>";
  
  }								
  ?>
  
    <?php 
  if(!empty($facultyid)){
  $tabrec=$myDb->select("select distinct f.name,f.contactno,d.code,c.section,s.name semestername,c.shortName
  								from tbl_schedule_map c
								inner join tbl_faculty f
								on c.facultyid=f.facultyid
								inner join tbl_department d
								on d.id=c.deptid
								inner join tbl_semester s
								on c.semesterid=s.id
								where c.facultyid='$facultyid'
								and c.mapyear='".date("Y")."'
								");
  $tabrecf=$myDb->get_row($tabrec,'MYSQL_ASSOC');
  $sem=substr($tabrecf['semestername'],0,3);
  echo "<div style='width:800px;margin:0 auto; font-weight:bold;'><div style='width:400px; float:left;'>Total Load: <br/>Phone: {$tabrecf['contactno']}</div>
        <div style='float:right; width:200px;'>{$tabrecf['name']}"."("."{$tabrecf['shortName']}".")"."</div></div>";
  
  }								
  ?>

  <br/>
  

   <table border="0" cellpadding="0" cellspacing="0" class="timeclass">
     <tr>
	 <td><strong>DAY/TIME</strong></td>
	   <?php 
	   
	   $tval=$myDb->select("select*from tbl_time_interval order by orderid");
	   while($tvalf=$myDb->get_row($tval,'MYSQL_ASSOC')){ ?>
	   
	   <td><?php 
	   
	   echo $tvalf['ordernum']; ?></td>
	   

	   <?php } 
	   ?>
     <tr>
	   <td><strong>PERIOD</strong></td>
	   
	   <?php $intname='';$tval=$myDb->select("select*from tbl_time_interval order by orderid");
	   while($tvalf=$myDb->get_row($tval,'MYSQL_ASSOC')){ 
	   $intname.=",".$tvalf['intervalName'];
	   
	   ?>
	   <td valign="top"><?php echo $tvalf['intervalName']; ?></td>
	   

	   <?php } ?>
     </tr>
	   <?php 
	     $dn=$myDb->select("select*from tbl_schedule_day order by orderid");
		 while($dnf=$myDb->get_row($dn,'MYSQL_ASSOC')){
		   
       ?>
	   <tr>

						<td><strong><?php echo $dnf['dyname']; ?></strong> </td>
						
						
						  
		 <?php 
		 if(!empty($facultyid)){
		 $sdq=$myDb->select("select c.id,c.mapyear 'Year',d.code,c.section,s.name semname,rm.alias 'Routine Owner',rm.id routineforid,gm.facultyid guidefacultyid,
								   gm.name,gm.contactno,cm.coursecode,dm.dyname dayname,dm.id dyid,
								   ftm.id ftimeid,ftm.intervalName frominterval,ftm.ordernum,ttm.id totimeid ,
								   ttm.intervalName tointerval,vm.id venuid,vm.venuname,vm.roomno,
								   fm.facultyid,fm.name 'Faculty Name',c.shortName,c.interval_fid,c.interval_toid,c.courseid
						from tbl_schedule_map_teacher c
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
						where dm.dyname='$dnf[dyname]'
						and c.facultyid='$facultyid'
						order by c.interval_fid
						
						");
				}elseif(!empty($deptid)){
						$sdq=$myDb->select("select c.id,c.mapyear 'Year',d.code,c.section,s.name semname,rm.alias 'Routine Owner',rm.id routineforid,gm.facultyid guidefacultyid,
								   gm.name,gm.contactno,cm.coursecode,dm.dyname dayname,dm.id dyid,
								   ftm.id ftimeid,ftm.intervalName frominterval,ftm.ordernum,ttm.id totimeid ,
								   ttm.intervalName tointerval,vm.id venuid,vm.venuname,vm.roomno,
								   fm.facultyid,fm.name 'Faculty Name',c.shortName,c.interval_fid,c.interval_toid,c.courseid
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
						where dm.dyname='$dnf[dyname]'
						and c.routineforid='$routineforid'
						order by c.interval_fid
						
						");				
				}elseif(!empty($vnuid)){
						$sdq=$myDb->select("select c.id,c.mapyear 'Year',d.code,c.section,s.name semname,rm.alias 'Routine Owner',rm.id routineforid,gm.facultyid guidefacultyid,
								   gm.name,gm.contactno,cm.coursecode,dm.dyname dayname,dm.id dyid,
								   ftm.id ftimeid,ftm.intervalName frominterval,ftm.ordernum,ttm.id totimeid ,
								   ttm.intervalName tointerval,vm.id venuid,vm.venuname,vm.roomno,
								   fm.facultyid,fm.name 'Faculty Name',c.shortName,c.interval_fid,c.interval_toid,c.courseid
						from tbl_schedule_map_venue c
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
						where dm.dyname='$dnf[dyname]'
						and c.vnuid='$vnuid'
						order by c.interval_fid
						
						");				
				}
				
					    $f=0;			
						while($recf=$myDb->get_row($sdq,'MYSQL_ASSOC')){ 
						$snm=substr($recf['semname'],0,4);															
						
						?>
							 <?php if(($recf['interval_fid']!=$recf['interval_toid'])){ ?>
							     <?php if(empty($recf['facultyid'])){ ?>
									 <?php if(empty($recf['section'])){ ?>
									 <td valign="top"  colspan="2" align="center"><?php echo $recf['coursecode']."<br/>".$recf['code']."-".$snm."<br/>".$recf['shortName']; ?></td>
									 <?php }else{ ?>
									 <td valign="top"  colspan="2" align="center"><?php echo $recf['coursecode']."<br/>".$recf['code']."-".$snm." ".$recf['section'].""."<br/>".$recf['shortName']; ?></td>
									 <?php } ?>
								 
								 <?php }else{ ?>
									 <?php if(empty($recf['section'])){ ?>
									 <td valign="top"  colspan="2" align="center"><?php echo $recf['coursecode']."<br/>".$recf['code']."-".$snm."<br/>".$recf['shortName']."<br/>".$recf['venuname']." ".$recf['roomno'].""; ?></td>
									 <?php }else{ ?>
									 <td valign="top"  colspan="2" align="center"><?php echo $recf['coursecode']."<br/>".$recf['code']."-".$snm."(".$recf['section'].")"."<br/>".$recf['shortName']."<br/>".$recf['venuname']." ".$recf['roomno'].""; ?></td>
									 <?php } ?>
								 <?php } ?>
							 <?php }elseif(($recf['interval_fid']==$recf['interval_toid'])){ ?>
							     <?php if(empty($recf['facultyid'])){ ?>
									 <?php if(empty($recf['section'])){ ?>
									 <td valign="top" align="center"><?php echo $recf['coursecode']."<br/>".$recf['code']."-".$snm."<br/>".$recf['shortName']; ?></td>
									 <?php }else{ ?>
									 <td valign="top" align="center"><?php echo $recf['coursecode']."<br/>".$recf['code']."-".$snm."<br/>".$recf['shortName']; ?></td>
									 <?php } ?>
								 
								 <?php }else{ ?>
									 <?php if(empty($recf['section'])){ ?>
									 <td valign="top" align="center"><?php echo $recf['coursecode']."<br/>".$recf['code']."-".$snm."<br/>".$recf['shortName']."<br/>".$recf['venuname']." ".$recf['roomno'].""; ?></td>
									 <?php }else{ ?>
									 <td valign="top" align="center"><?php echo $recf['coursecode']."<br/>".$recf['code']."-".$snm."(".$recf['section'].")"."<br/>".$recf['shortName']."<br/>".$recf['venuname']." ".$recf['roomno'].""; ?></td>
									 <?php } ?>
								 <?php } ?>
							 
							 
							<?php } ?>
					  <?php $f=1;} ?>
					  
					  <?php if($f==0){ ?>
					    <td style="width:72px; height:62px; text-align:center; ">-</td>
						<td style="width:72px; height:62px;text-align:center; ">-</td>
						<td style="width:72px; height:62px;text-align:center; ">-</td>
						<td style="width:72px; height:62px;text-align:center; ">-</td>
						<td style="width:72px; height:62px;text-align:center; ">-</td>
						<td style="width:72px; height:62px;text-align:center; ">-</td>
						<td style="width:72px; height:62px; text-align:center;">-</td>
						<td style="width:72px; height:62px;text-align:center; ">-</td>
						<td style="width:72px; height:62px; text-align:center;">-</td>
					  <?php } ?>
	   </tr>
	   <?php } ?>
	 
</table>
<br/>
<?php if(!empty($deptid)){ ?>
<table border="0" cellspacing="0" cellpadding="0" class="timeclass" style="width:500px; ">
  <tr>
    <td align="center">SL/NO</td>
    <td align="center">Subject<br/>
    Code</td>
    <td>Name of the Subject</td>
    <td>Teacher's Name</td>
    <td align="center">Short Name</td>
  </tr>
  <?php $tabrec=$myDb->select("select distinct p.coursecode,p.coursename,f.name,c.shortName
  								from tbl_schedule_map c
								inner join tbl_courses p
								on c.courseid=p.coursecode
								inner join tbl_faculty f
								on c.facultyid=f.facultyid
								where c.routineforid='$routineforid'
								and c.mapyear='".date("Y")."'
								");
		$si=1;						
	  while($tabrecf=$myDb->get_row($tabrec,'MYSQL_ASSOC')){
  ?>	  							
  <tr>
    <td align="center"><?php echo $si; ?></td>
    <td align="center"><?php echo $tabrecf['coursecode']; ?></td>
    <td><?php echo $tabrecf['coursename']; ?></td>
    <td><?php echo $tabrecf['name']; ?></td>
    <td align="center"><?php echo $tabrecf['shortName']; ?></td>
  </tr>
  <?php $si++;} ?>
</table>
<?php } ?>

<?php if(!empty($facultyid)){ ?>
<table border="0" cellspacing="0" cellpadding="0" class="timeclass" style="width:500px; ">
  <tr>
    <td align="center">SL/NO</td>
    <td align="center">Subject<br/>
    Code</td>
    <td align="center">Theory</td>
    <td align="center">Practical</td>
    <td>Subject Name</td>
  </tr>
  <?php $tabrec=$myDb->select("select distinct p.coursecode,p.coursename,f.name,c.shortName,c.theory,c.practical
  								from tbl_schedule_map c
								inner join tbl_courses p
								on c.courseid=p.coursecode
								inner join tbl_faculty f
								on c.facultyid=f.facultyid
								where c.facultyid='$facultyid'
								and c.mapyear='".date("Y")."'
								");
		$si=1;						
	  while($tabrecf=$myDb->get_row($tabrec,'MYSQL_ASSOC')){
  ?>	  							
  <tr>
    <td align="center"><?php echo $si; ?></td>
    <td align="center"><?php echo $tabrecf['coursecode']; ?></td>
    <td align="center"><?php echo $tabrecf['theory']; ?></td>
    <td align="center"><?php echo $tabrecf['practical']; ?></td>
    <td><?php echo $tabrecf['coursename']; ?></td>
  </tr>
  <?php $si++;} ?>
</table>
<?php } ?>
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}