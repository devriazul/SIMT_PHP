<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  	if($_SESSION['userid'])
	{
		$q=$_GET['q'];
		$s_scat=mysql_query("SELECT distinct c.id, c.coursename AS CourseName FROM tbl_assignfaculty a INNER JOIN tbl_faculty f ON a.facultyid = f.id INNER JOIN tbl_department d ON a.deptid = d.id INNER JOIN tbl_courses c ON a.courseid = c.id INNER JOIN tbl_semester s ON a.semesterid = s.id WHERE c.storedstatus<>'D' and c.departmentid='$q'") or die(mysql_error());
		
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

	
		 
</script><body leftmargin="0" topmargin="0">
<table width="100%" align="right" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="55%"><div align="right"><strong><font face="Verdana" size="1">Subject Name:<font color="#FF0000">*</font></font></strong> :</div></td>
    <td width="45%"><select name="courseid" id="courseid" style="font-size:12px;" onkeypress="return handleEnter(this, event)">
      <option value="" selected="selected">Select Subject</option>
      <?php 
		while($s_sfetch=mysql_fetch_array($s_scat)){
	?>
      <option value="<?php echo $s_sfetch['id']; ?>"><?php echo $s_sfetch['CourseName']; ?></option>
      <?php } ?>
    </select></td>
  </tr>
</table>
<?php 
	}
}
?>