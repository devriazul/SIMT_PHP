<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  	if($_SESSION['userid'])
	{
		$q=$_GET['q'];
		$r=$_GET['r']; 
		//echo $cv="select c.* from tbl_semesterwisesubj ss inner join `tbl_courses` c on ss.courseid=c.id inner join  tbl_department d on ss.deptid=d.id inner join tbl_semester s on ss.semesterid=s.id where ss.deptid='$q' and ss.semesterid='$r' and ss.storedstatus<>'D'"; exit;
		$s_scat=mysql_query("select c.* from tbl_semesterwisesubj ss inner join `tbl_courses` c on ss.courseid=c.id inner join  tbl_department d on ss.deptid=d.id inner join tbl_semester s on ss.semesterid=s.id where ss.deptid='$q' and ss.semesterid='$r' and ss.storedstatus<>'D'") or die(mysql_error());

?>

<body leftmargin="0" topmargin="0">
<select name="courseid" id="courseid" style="font-size:12px;">
  <option value="" selected="selected">Select Subject</option>
  <?php 
		while($s_sfetch=mysql_fetch_array($s_scat)){
	?>
  <option value="<?php echo $s_sfetch['id']; ?>"><?php echo $s_sfetch['coursename']." (".$s_sfetch['coursecode'].")"; ?></option>
  <?php } ?>
</select>
<?php 
	}
}
?>
