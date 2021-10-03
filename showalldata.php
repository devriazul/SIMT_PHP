<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  	if($_SESSION['userid'])
	{
		//$q=$_GET['q'];
		$deptid=$_GET['deptid'];
		$semester=$_GET['semester'];
		$s=$_GET['s'];
		//$y=$_GET['y'];
		//echo "select c.id as id, concat(c.coursename,' (',right(c.coursecode,4),', Total Marks:',SUM(md.totalmarks),')') as coursename from tbl_semesterwisesubj ss inner join `tbl_courses` c on ss.courseid=c.id inner join tbl_marksdistribution md on ss.courseid=md.courseid  where ss.deptid='$deptid' and ss.semesterid='$semester' and ss.storedstatus<>'D' and md.storedstatus<>'D' and c.storedstatus<>'D' GROUP BY c.id,c.coursecode,c.coursename"; exit;
		//$s_scat=mysql_query("select c.id as id, concat(c.coursename,' (',right(c.coursecode,4),', Total Marks:',SUM(md.totalmarks),')') as coursename from tbl_semesterwisesubj ss inner join `tbl_courses` c on ss.courseid=c.id inner join tbl_marksdistribution md on ss.courseid=md.courseid  where ss.deptid='$deptid' and ss.semesterid='$semester' and ss.session='$s' and ss.storedstatus<>'D' and md.storedstatus<>'D' and c.storedstatus<>'D' GROUP BY c.id,c.coursecode,c.coursename") or die(mysql_error());
		$s_scat=mysql_query("select c.id as id, concat(c.coursename,' (',right(c.coursecode,5),', Total Marks:',SUM(md.totalmarks),')') as coursename from tbl_semesterwisesubj ss inner join `tbl_courses` c on ss.courseid=c.id inner join tbl_marksdistribution md on ss.courseid=md.courseid  where ss.deptid='$deptid' and ss.semesterid='$semester' and ss.storedstatus<>'D' and md.storedstatus<>'D' and c.storedstatus<>'D' GROUP BY c.id,c.coursecode,c.coursename") or die(mysql_error());

?>

<script language type="text/javascript"> 
function handleEnter (field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
			i = (i + 1) % field.form.elements.length;
			field.form.elements[i].focus();
			return false;
		} 
		else
		return true;
	}      

	function checkstaffdata()
	{
		if(document.getElementById("courseid").value=='Select Subject'){
		alert('Subject Name can not left empty');
		 document.getElementById("courseid").focus();
	     return false;
		 
	    }

		
	}
		 
</script><body leftmargin="0" topmargin="0">
<table width="70%" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="#E6F2FF">
    <td width="30%"><strong><font face="Verdana" size="1">Subject Name:<font color="#FF0000">*</font></font></strong> :</td>
    <td width="70%" ><select name="courseid" id="courseid" style="font-size:12px; width:380px" onkeypress="return handleEnter(this, event)">
      <option value="" selected="selected">Select Subject</option>
      <?php 
		while($s_sfetch=mysql_fetch_array($s_scat)){
	?>
      <option value="<?php echo $s_sfetch['id']; ?>"><?php echo $s_sfetch['coursename']; ?></option>
      <?php } ?>
    </select></td>
  </tr>
</table>
<?php 
	}
}
?>