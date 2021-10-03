<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
?>
<form name="MyForm" action="rptstdattandreports.php" id="frm" autocomplete="off"  method="post" target="new" >           
<input type="submit"  value="Generate Report" name="B" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" /></br>
<div class="data">
<?php 
  
	 $sdq="Select s.stdid as StudentID, s.stdname as Name, s.section as Section, sar.totalworkingdays as TotalWorkingDays, sar.attndays as PresentDays, sar.attendancepercent as '(%)' From tbl_stdattandence sar inner join tbl_stdinfo s on sar.stdid=s.stdid Where sar.deptid='$_POST[deptid]' and sar.courseid='$_GET[courseid]' and sar.semesterid='$_POST[semester]' and sar.session='$_POST[session]' and sar.storedstatus<>'D' order by sar.section";
	 $sdep=$myDb->dump_query($sdq,'','');

?>
</div><input name="deptid" type="hidden" value="<?php echo $_POST['deptid'];?>"><input name="courseid" type="hidden" value="<?php echo $_GET['courseid'];?>"><input name="semester" type="hidden" value="<?php echo $_POST['semester'];?>"><input name="session" type="hidden" value="<?php echo $_POST['session'];?>">	
</form>

<?php }}?>