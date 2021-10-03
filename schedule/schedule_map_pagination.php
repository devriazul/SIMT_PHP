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

if($_GET['page'])
{
	if(!empty($_GET['yrpart'])){
		$yrpart=!empty($_GET['yrpart'])?mysql_real_escape_string($_GET['yrpart']):'';
	}

$page = $_GET['page'];
$cur_page = $page;
$page -= 1;
$per_page = 63;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;
	if(isset($_POST['routinefor'])){
		$routinefor=$_POST['routinefor']?mysql_real_escape_string($_POST['routinefor']):'';
		$rtn=explode('->',$routinefor);
		$rarr=array();
		$rarr=$rtn;
		$routineforid=$rarr[0];
	}
	if(isset($_POST['teacher'])){
		$teacher=$_POST['teacher']?mysql_real_escape_string($_POST['teacher']):'';
		$fid=explode('->',$teacher);
		$farr=array();
		$farr=$fid;
		$teacher=$farr[0];
	}
	if(isset($_POST['mpyear'])){
	  $mpyear=$_POST['mpyear']?mysql_real_escape_string($_POST['mpyear']):'';
	}
?>
<script type="text/javascript" src="jquery.js"></script>
<script language="javascript">
$(document).ready(function(){
  $('a[name="dlt"]').unbind().click(function(e){
    e.preventDefault();
	var id=$(this).attr('alt');
	var trigger = $(this);
	var rows=$('.gridTbl tr').length;
	var checkstr =  confirm('are you sure you want to delete this?');
	if(checkstr == true){	
		$.get("delroutinefor.php?id="+id,function(r){
		
			if(rows>1){
		
				trigger.closest('tr').fadeOut(300, function() {
							$(this).remove();			
				});	
			}
			$('#shw').html(r);
			//$('.data').load("macclevel_pagination?page=1");

		});
	}else{
	  return false;
	}	
  
  });
  
});

</script>
<div class="data">
<table  border="0" cellpadding="0" cellspacing="0" class="gridTbl">
					  <tr class="style11">
						<td height="30" class="gridTblHead">ID</td>
						<td height="30" class="gridTblHead">Day Name</td>
						<td height="30" class="gridTblHead">From</td>
						<td height="30" class="gridTblHead">To</td>
						<td height="30" class="gridTblHead">Venue</td>
						<td height="30" class="gridTblHead">Room No</td>
						<td height="30" class="gridTblHead">Course Code</td>
						<td height="30" class="gridTblHead">Course Name</td>
						<td height="30" class="gridTblHead">TeacherID</td>
						<td height="30" class="gridTblHead">Name</td>
						<td height="30" class="gridTblHead">Action</td>
				  </tr>
					  <?php 
					  
					  if(!empty($routinefor)&&!empty($teacher)){
						  $sdq=$myDb->select("select c.id,c.mapyear 'Year',d.id dpid,d.code,c.section,s.id semid,s.name semname,rm.alias 'Routine Owner',rm.id routineforid,gm.facultyid guidefacultyid,
									   gm.name,gm.contactno,cm.coursecode,cm.coursename 'coursename',dm.dyname dayname,dm.id dyid,
									   ftm.id ftimeid,ftm.intervalName frominterval,ftm.ordernum,ttm.id totimeid ,
									   ttm.intervalName tointerval,vm.id venuid,vm.venuname,vm.roomno,
									   fm.facultyid,fm.name 'Faculty Name',fm.contactno fcontactno,c.shortName,c.yrpart
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
							where c.routineforid='$routineforid'
							and c.facultyid='$teacher'
							and c.mapyear='$mpyear'
							and c.yrpart='$yrpart'
							order by c.dyid
							limit $start,$per_page
							");
						}elseif(!empty($routinefor)&&empty($teacher)){
						  $sdq=$myDb->select("select c.id,c.mapyear 'Year',d.id dpid,d.code,c.section,s.id semid,s.name semname,rm.alias 'Routine Owner',rm.id routineforid,gm.facultyid guidefacultyid,
									   gm.name,gm.contactno,cm.coursecode,cm.coursename 'coursename',dm.dyname dayname,dm.id dyid,
									   ftm.id ftimeid,ftm.intervalName frominterval,ftm.ordernum,ttm.id totimeid ,
									   ttm.intervalName tointerval,vm.id venuid,vm.venuname,vm.roomno,
									   fm.facultyid,fm.name 'Faculty Name',fm.contactno fcontactno,c.shortName,c.yrpart
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
							where c.routineforid='$routineforid'
							and c.mapyear='$mpyear'
							and c.yrpart='$yrpart'
							order by c.dyid
							limit $start,$per_page
							");
						}elseif(empty($routinefor)&&!empty($teacher)){
						  $sdq=$myDb->select("select c.id,c.mapyear 'Year',d.id dpid,d.code,c.section,s.id semid,s.name semname,rm.alias 'Routine Owner',rm.id routineforid,gm.facultyid guidefacultyid,
									   gm.name,gm.contactno,cm.coursecode,cm.coursename 'coursename',dm.dyname dayname,dm.id dyid,
									   ftm.id ftimeid,ftm.intervalName frominterval,ftm.ordernum,ttm.id totimeid ,
									   ttm.intervalName tointerval,vm.id venuid,vm.venuname,vm.roomno,
									   fm.facultyid,fm.name 'Faculty Name',fm.contactno fcontactno,c.shortName,c.yrpart
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
							where c.facultyid='$teacher'
							and c.mapyear='$mpyear'
							and c.yrpart='$yrpart'
							order by c.dyid
							limit $start,$per_page
							");
						}else{
						  $sdq=$myDb->select("select c.id,c.mapyear 'Year',d.id dpid,d.code,c.section,s.id semid,s.name semname,rm.alias 'Routine Owner',rm.id routineforid,gm.facultyid guidefacultyid,
									   gm.name,gm.contactno,cm.coursecode,cm.coursename 'coursename',dm.dyname dayname,dm.id dyid,
									   ftm.id ftimeid,ftm.intervalName frominterval,ftm.ordernum,ttm.id totimeid ,
									   ttm.intervalName tointerval,vm.id venuid,vm.venuname,vm.roomno,
									   fm.facultyid,fm.name 'Faculty Name',fm.contactno fcontactno,c.shortName,c.yrpart
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
							order by c.dyid
							limit $start,$per_page
							");
						
						}
						while($recf=$myDb->get_row($sdq,'MYSQL_ASSOC')){ ?>
						
					  <tr>
						<td height="25" class="gridTblValue"><?php echo $recf['id']; ?></td>
						<td height="25" class="gridTblValue"><?php echo $recf['dayname']; ?></td>
						<td height="25" class="gridTblValue"><?php echo $recf['frominterval']; ?></td>
						<td height="25" class="gridTblValue"><?php echo $recf['tointerval']; ?></td>
						<td height="25" class="gridTblValue"><?php echo $recf['venuname']; ?></td>
						<td height="25" class="gridTblValue"><?php echo $recf['roomno']; ?></td>
						<td height="25" class="gridTblValue"><?php echo $recf['coursecode']; ?></td>
						<td height="25" class="gridTblValue"><?php echo $recf['coursename']; ?></td>
						<td height="25" class="gridTblValue"><?php echo $recf['facultyid']; ?></td>
						<td height="25" class="gridTblValue"><?php echo $recf['Faculty Name']; ?></td>
						<td height="25" class="gridTblValue"><a href="del_schedul_map.php?id=<?php echo $recf['id']; ?>&dpid=<?php echo $recf['dpid']; ?>&semid=<?php echo $recf['semid']; ?>&routineforid=<?php echo $recf['routineforid']; ?>&dyid=<?php echo $recf['dyid']; ?>&ftimeid=<?php echo $recf['ftimeid']; ?>&totimeid=<?php echo $recf['totimeid']; ?>&venuid=<?php echo $recf['venuid']; ?>&facultyid=<?php echo $recf['facultyid']; ?>&mapyear=<?php echo $recf['Year']; ?>&yrpart=<?php echo $recf['yrpart']; ?>&shortname=<?php echo $recf['shortName']; ?>">Delete</a></td>
					  </tr>
					  <?php } ?>
				  </table>
				  
				  
<?php 
 /* --------------------------------------------- */
$msg='';
$query_pag_num = "SELECT COUNT(*) AS count 
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
";
$result_pag_num = mysql_query($query_pag_num);
$row = mysql_fetch_array($result_pag_num);
$count = $row['count'];
$no_of_paginations = ceil($count / $per_page);

/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
if ($cur_page >= 7) {
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;
    }
} else {
    $start_loop = 1;
    if ($no_of_paginations > 7)
        $end_loop = 7;
    else
        $end_loop = $no_of_paginations;
}
/* ----------------------------------------------------------------------------------------------------------- */
$msg .= "<div class='pagination'><ul>";

// FOR ENABLING THE FIRST BUTTON
if ($first_btn && $cur_page > 1) {
    $msg .= "<li p='1' class='active'>First</li>";
} else if ($first_btn) {
    $msg .= "<li p='1' class='inactive'>First</li>";
}

// FOR ENABLING THE PREVIOUS BUTTON
if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $msg .= "<li p='$pre' class='active'>Previous</li>";
} else if ($previous_btn) {
    $msg .= "<li class='inactive'>Previous</li>";
}
for ($i = $start_loop; $i <= $end_loop; $i++) {

    if ($cur_page == $i)
        $msg .= "<li p='$i' style='color:#fff;background-color:#006699;' class='active'>{$i}</li>";
    else
        $msg .= "<li p='$i' class='active'>{$i}</li>";
}

// TO ENABLE THE NEXT BUTTON
if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $msg .= "<li p='$nex' class='active'>Next</li>";
} else if ($next_btn) {
    $msg .= "<li class='inactive'>Next</li>";
}

// TO ENABLE THE END BUTTON
if ($last_btn && $cur_page < $no_of_paginations) {
    $msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
} else if ($last_btn) {
    $msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
}
//$goto = "<input type='hidden' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='hidden' id='catnp' name='catnp' value='".$_POST[catp]."' />";
//$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
$msg = $msg . "</ul></div>";  // Content for pagination
echo $msg;

?>	 
</div>	
<?php 
    }
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}				  