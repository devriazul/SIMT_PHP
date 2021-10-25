<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  	if($_SESSION['userid'])
	{
		//$q=$_GET['q'];
		$deptid=!empty($_POST['deptid'])?$_POST['deptid']:'';
		$session=!empty($_POST['session'])?$_POST['session']:'';
		$semester=!empty($_POST['semester'])?$_POST['semester']:'';
		
		
//		$s_scat=mysql_query("select*from `tbl_courses` where id in(select courseid from tbl_semesterwisesubj  where deptid='$deptid' and session='$session' and semesterid='$semester')  and storedstatus<>'D'") or die(mysql_error());
				$s_scat=mysql_query("select*from `tbl_courses` where id in(select courseid from tbl_semesterwisesubj  where deptid='$deptid' and semesterid='$semester')  and storedstatus<>'D'") or die(mysql_error());

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
<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0" align="left">
  <tr>
    <td width="55%"><select name="courseid" id="courseid" style="font-size:12px;" onkeypress="return handleEnter(this, event)">
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