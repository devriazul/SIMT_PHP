<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  	if($_SESSION['userid'])
	{
		$uname= $_SESSION['userid'];
		$edate=date("Y-m-d");
		$queryx="SELECT*FROM tbl_attendance WHERE efid='$uname' AND edate='$edate'";
     	$rx=$myDb->select($queryx);
	 	$rowx=$myDb->get_row($rx,'MYSQL_ASSOC');



		$id=$myDb->select("Select * from tbl_faculty WHERE facultyid='$_SESSION[userid]'");
		$fid=$myDb->get_row($id,'MYSQL_ASSOC');

		$tc=mysql_query("SELECT COUNT(st.id) as TotalClass  FROM `tbl_schedule_map_teacher` st inner join tbl_schedule_day sd on st.dyid=sd.id inner join tbl_department d on st.deptid=d.id inner join tbl_semester s on st.semesterid=s.id inner join  tbl_routine_for rf on st.routineforid=rf.id inner join tbl_courses c on st.courseid=c.coursecode inner join tbl_time_interval ti on st.interval_fid=ti.id inner join tbl_venue v on st.vnuid=v.id WHERE st.facultyid='$_SESSION[userid]' and st.courseid<>'' and sd.dyname=dayname(NOW()) order by ti.id")or die(mysql_error());
		$tcfetch=mysql_fetch_array($tc);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<style type="text/css">
<!--
@import url("main.css");
.style17 {
	font-size: 10; 
	font:Calibri; 
	font-weight:bold;
}
.style18 {
	color:#000000;
	font-weight: bold;
}

-->
</style>

<script type="text/javascript" src="jquery.min.js"></script>
<script language="javascript">
$(document).ready(function() {
 $('#me').hide();

     $('#clickme').click(function() {
          $('#me').animate({
               height: 'toggle'
               }, 100
          );
     });
});
</script>

</head>

<body>
<table width="1047" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1047" height="152" valign="top" background="images/1.jpg"><span class="style17"><?php include("topdefault.php");?>    </span></span></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" id="tblleft">
      <tr>
        <td height="28" colspan="2" bgcolor="#0C6ED1"><div align="center" class="style1">SAIC INSTITUTE OF MANAGEMENT TECHNOLOGY</div></td>
        </tr>
      <tr>
        <td background="images/leftbg.jpg">&nbsp;</td>
        <td><div align="center"><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])) {echo $_GET['msg'];}?></font></div></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php");?>         <br />
          <p>&nbsp;</p>
          <p>&nbsp;</p></td><td width="79%" height="300" valign="top"><blockquote>

        </blockquote>
            <p>&nbsp;</p>
            <p align="center">Intregrated Institute Management System (IIMS)</p>
            <p align="center">Welcome </br></br><?php echo $fid['name']; ?></p>
			
            <p align="center"><?php if($fid['img']!=""){?><img name="" src="../facultyphoto/<?php echo $fid['img']; ?>" width="100" height="105" border="1" alt="" /><?php } else { if($fid['sex']=="Male"){?><img name="" src="../facultyphoto/male.jpg" width="100" height="105" border="1" alt="" /><?php }else{?> <img name="" src="../facultyphoto/female.jpg" width="100" height="105" border="1" alt="" /><?php }}?></p>
	        <p align="center"><span class="style16"><?php if(($rowx['efid']==$uname) && ($rowx['edate']==$edate))
		  {?> 
		  		<span style="font-size:12px; color:#FF0000; font-weight:bold; ">Your attendance has already been collected for today.</span>
		  <?php }else
		  { 
				$query="SELECT*FROM tbl_login WHERE userid='$uname'";
     			$r=$myDb->select($query);
	 			$row=$myDb->get_row($r,'MYSQL_ASSOC');

				
				$userid=$row['userid'];
				$accid=$row['accid'];
				$curmonth= date('F');
				$curyear= date('Y');
				$inreason= $_POST['me'];
				
				
	    		$query="INSERT INTO tbl_attendance(`efid`,`edate`,`intime`,`accid`,`monthname`,`yearname`,`instatus`) VALUES('$userid',CURDATE(),CURTIME(),'$accid','$curmonth','$curyear','$inreason')";
				$myDb->insert_sql($query);

				$st="SELECT `tbl_attendancesettings`.*, TIMEDIFF(CURTIME(),stdintime) as td, HOUR(TIMEDIFF(CURTIME(),stdintime)) as hrs, MINUTE(TIMEDIFF(CURTIME(),stdintime)) as mins FROM `tbl_attendancesettings` WHERE accid=37";
				$stq=$myDb->select($st);
				$str=$myDb->get_row($stq,'MYSQL_ASSOC');
				//$td=$str['td'];
				$totalmins=($str['hrs']*60)+$str['mins'];

				if($totalmins<$str['maxallow'])
				{
					$mg='<span style="font-size:12px; color:#006600; font-weight:bold; ">Present</span>';
				}


				else if(($totalmins>$str['minallow']) && ($totalmins<$str['maxallow']))
				{
					$mg='<span style="font-size:12px; color:#00FF00; font-weight:bold; ">Late Present</span>';
				}
				else if($totalmins>$str['maxallow'])
				{
					$mg='<span style="font-size:12px; color:#FF0000; font-weight:bold; ">Absent</span>';
				}

		 ?>
				<span style="font-size:12px; color:#006600; font-weight:bold; ">Your attendance is collected successfully. And you are: <?php echo $mg;?> today.</span>
		  <?php }?>
			<p align="center">
			  <?php
			$getjd="Select * from tbl_faculty Where facultyid='$uname'";
			$getr=$myDb->select($getjd);
			$getd=$myDb->get_row($getr,'MYSQL_ASSOC');

			$start_date = new DateTime($getd['joiningdate']);
			$since_start = $start_date->diff(new DateTime(date('y-m-d')));
			//echo $since_start->days.' days total<br>';
			echo 'Your working experience in SIMT is: '.$since_start->y.' years, '. $since_start->m.' months and '.$since_start->d.' days.';
				//echo $since_start->m.' months<br>';
				//echo $since_start->d.' days<br>';
				//echo $since_start->h.' hours<br>';
				//echo $since_start->i.' minutes<br>';
				//echo $since_start->s.' seconds<br>';
			?>
			</p>
            <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" class="gridTbl">
              <tr>
                <td width="70%" height="34" bgcolor="#A5E7FF"><span class="style18"><div id="clickme"  style=" font:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;  width: 200px; cursor:pointer;">
  Today you have: <?php echo $tcfetch['TotalClass'];?> classes.
</div></span></td>
              </tr>
              <tr>
                <td><table align="center" width="100%" border="0" cellpadding="0" cellspacing="0" class="gridTbl" id="me">
                  <tr valign="middle" bgcolor="#F4F4F4">
                    <td class="gridTblHead "><span style=" font:Calibri; font-size:10px; font-weight:bold;">SN.</span></td>
                    <td class="gridTblHead "><span style=" font:Calibri; font-size:10px; font-weight:bold;">Department</span></td>
                    <td height="21" class="gridTblHead "><span style=" font:Calibri; font-size:10px; font-weight:bold;">Semester</span></td>
                    <td height="21" class="gridTblHead "><span style=" font:Calibri; font-size:10px; font-weight:bold;">CourseName</span></td>
                    <td class="gridTblHead "><span style=" font:Calibri; font-size:10px; font-weight:bold;">RoutineFor</span></td>
                    <td height="21" class="gridTblHead "><span style=" font:Calibri; font-size:10px; font-weight:bold;">VenuName</span></td>
                    <td height="21" class="gridTblHead "><span style=" font:Calibri; font-size:10px; font-weight:bold;">TimeInterval</span></td>
                  </tr>
                  <?php $y=date("Y"); $sn=1;
	$scat=mysql_query("SELECT st.*, sd.dyname, d.name as Department, s.name as Semester, rf.alias as RoutineFor, c.coursename as CourseName, ti.intervalName, CONCAT(v.venuname,' (',v.roomno,')') as Venu  FROM `tbl_schedule_map_teacher` st inner join tbl_schedule_day sd on st.dyid=sd.id inner join tbl_department d on st.deptid=d.id inner join tbl_semester s on st.semesterid=s.id inner join  tbl_routine_for rf on st.routineforid=rf.id inner join tbl_courses c on st.courseid=c.coursecode inner join tbl_time_interval ti on st.interval_fid=ti.id inner join tbl_venue v on st.vnuid=v.id WHERE st.facultyid='$_SESSION[userid]' and st.courseid<>'' and sd.dyname=dayname(NOW()) order by ti.id")or die(mysql_error());
	while($sfetch=mysql_fetch_array($scat))
	{	$ha="Select af.status, af.attndstatus tbl_assignfaculty af inner join tbl_faculty f on af.facultyid=f.id where f.facultyid='$sfetch[facultyid]'";
		$hafetch=$myDb->select($ha);
		$harow=$myDb->get_row($hafetch,'MYSQL_ASSOC');
		if($harow['status']<>'0')
		{
	?>
                  <tr valign="middle" bgcolor="#F4F4F4">
                    <td width="20" class="gridTblValue"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $sn; ?></span></td>
                    <td width="150" class="gridTblValue"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $sfetch['Department']; ?></span></td>
                    <td width="90" height="21" class="gridTblValue"><div align="left"><span style="font-family: Calibri; font-size: 8pt;"><?php echo $sfetch['Semester']; ?></span></div></td>
                    <td width="120" height="21" class="gridTblValue"><div align="left"><span style="font-family: Calibri; font-size: 8pt;"><?php if($sfetch['theory']<>'0'){echo $sfetch['CourseName']." (Theory)";}elseif($sfetch['practical']<>'0'){echo $sfetch['CourseName']." (Practical)";} ?></span></div></td>
                    <td width="85" class="gridTblValue"><div align="left"><span style="font-family: Calibri; font-size: 8pt;"><?php echo $sfetch['RoutineFor']; ?></span></div></td>
                    <td width="110" height="21" class="gridTblValue"><div align="left"><span style="font-family: Calibri; font-size: 8pt;"><?php echo $sfetch['Venu']; ?></span></div></td>
                    <td width="78" height="21" class="gridTblValue"><div align="center"><span style="font-family: Calibri; font-size: 8pt;"><?php echo $sfetch['intervalName']; ?></span></div></td>
                  </tr>
  <?php }
		else
		{
			echo "Sorry, No course is assigned for you in current semester period."; exit;
		}
		$sn++; } ?>
                </table></td>
              </tr>
<tr>
                <td width="70%" height="34" bgcolor="#009933"><span class="style18"><div id="clickme"  style=" font:Verdana, Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:12px; font-weight:bold;  width: 200px; cursor:pointer;">
  Your 0 tasks pending.
</div></span></td>
              </tr>            </table>            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p></td></tr>
      <tr>
        <td height="60" colspan="2" valign="middle" bgcolor="#D3F3FE"><?php include("bot.php"); ?></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<?php 
}else{
  header("Location:index.php");
	echo "sorry! u did mistake. please check corresponding.";
}
}  
?>
