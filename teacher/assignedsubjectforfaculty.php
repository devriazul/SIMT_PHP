<?php session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  //$id=mysql_real_escape_string($_GET['id']);
  
  $vs="SELECT a.id, f.facultyid, f.name AS FacultyName, d.name AS DepartmentName, c.coursename AS CourseName, s.name AS SemesterName, a.session AS SESSION , a.year AS YEAR FROM tbl_assignfaculty a INNER JOIN tbl_faculty f ON a.facultyid = f.id INNER JOIN tbl_department d ON a.deptid = d.id INNER JOIN tbl_courses c ON a.courseid = c.id INNER JOIN tbl_semester s ON a.semesterid = s.id WHERE f.storedstatus<>'D' and f.facultyid='$_SESSION[userid]' and a.status='0' and a.attndstatus='0'"; 
  $r=$myDb->select($vs);
  $row=$myDb->get_row($r,'MYSQL_ASSOC');
  
 /* $chka="SELECT*FROM  tbl_accdtl WHERE flname='managefacultyinfo.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>

<style type="text/css">
<!--
@import url("main.css");
.style12 {font-size: 10px}
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style16 {font-size: 12px}

-->
</style>
<script type="text/javascript" src="jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />


</script>
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
</script>





<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>

<style type="text/css">
<!--
.style17 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #000000; }
-->
</style>
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
        <td background="images/leftbg.jpg"><img src="images/leftbg.jpg" width="252" height="3" /></td>
        <td><img src="images/spaer.gif" width="1" height="1" /></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php"); ?>
                   <br />
          
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        <td width="79%" valign="top">
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg'];  }?></font></p>
		<form name="MyForm" autocomplete="off" action="assignedsubjectforfaculty.php" method="post">
          <div align="center">
           
            <table width="91%" border="0" align="center" cellpadding="0" cellspacing="0" class="gridTbl">
			  <!--DWLayoutTable-->
              <tr align="center" >
                <td height="25" colspan="5"><div align="left"><span class="style2">ASSIGNED SUBJECTS/COURSES</span></div></td>
              </tr>
              <?php $y=date("Y");
	$vuser=mysql_query("SELECT distinct f.facultyid, f.name AS FacultyName, d.name AS DepartmentName FROM tbl_assignfaculty a INNER JOIN tbl_faculty f ON a.facultyid = f.id INNER JOIN tbl_department d ON a.deptid = d.id INNER JOIN tbl_courses c ON a.courseid = c.id INNER JOIN tbl_semester s ON a.semesterid = s.id WHERE f.storedstatus<>'D' and f.facultyid='$_SESSION[userid]'  and a.status='0' order by a.id desc") or die(mysql_error());
  while($ufetch=mysql_fetch_array($vuser)){
  ?>
              <tr bgcolor="#DFF4FF">
                <td width="350" height="30" valign="middle" class="gridTblHead"><span style="font-family: Verdana; font-size: 10pt; font-weight:bold;">&nbsp;<?php echo $ufetch['DepartmentName']; ?></span></td>
                
			    <td width="117" height="30" valign="middle" class="gridTblHead"><div align="center"><span class="style2">Semester</span></div></td>
			    <td width="85" height="30" valign="middle" class="gridTblHead"><div align="center"><span class="style2">Session</span></div></td>
			    <td width="96" height="30" valign="middle" class="gridTblHead"><div align="center"><span class="style2">Year</span></div></td>
			    <td width="72" height="30" valign="middle" class="gridTblHead"><div align="center"><span class="style2">Section</span></div></td>
              </tr>
              
              <tr>
                <td height="19" colspan="5"><table align="center" width="100%" border="0" cellpadding="0" cellspacing="0" >
                  <!--DWLayoutTable-->
                  <?php $y=date("Y");
	$scat=mysql_query("SELECT a.id, f.facultyid, f.name AS FacultyName, d.name AS DepartmentName, right(c.coursecode,4) as coursecode, c.coursename AS CourseName, s.name AS SemesterName, a.session AS SESSION ,a.section, a.year AS YEAR FROM tbl_assignfaculty a INNER JOIN tbl_faculty f ON a.facultyid = f.id INNER JOIN tbl_department d ON a.deptid = d.id INNER JOIN tbl_courses c ON a.courseid = c.id INNER JOIN tbl_semester s ON a.semesterid = s.id WHERE f.storedstatus<>'D' and f.facultyid='$_SESSION[userid]' and d.name='$ufetch[DepartmentName]'  and a.status='0' and a.attndstatus='0'")or die(mysql_error());
	while($sfetch=mysql_fetch_array($scat)){
	?>
                  <tr valign="middle" bgcolor="#F4F4F4">
                    <td width="337" class="gridTblValue"><span style="font-family: Verdana; font-size: 8pt;">&nbsp;<?php echo $sfetch['CourseName']." (".$sfetch['coursecode'].")"; ?></span></td>
                    <td width="117" height="21" class="gridTblValue"><div align="center"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $sfetch['SemesterName']; ?></span></div></td>
                    <td width="91" height="21" class="gridTblValue"><div align="center"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $sfetch['SESSION']; ?></span></div></td>
                    <td width="96" class="gridTblValue"><div align="center"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $sfetch['YEAR']; ?></span></div></td>
                    <td width="78" height="21" class="gridTblValue"><div align="center"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $sfetch['section']; ?></span></div></td>
                  </tr>
                  <?php } ?>
                </table></td>
                </tr><?php } ?>
            </table>          
            </div>
		</form>
           <br />
          		<div id="MyResult" align="center"></div> 
          		          
<p></p>
</td>
      </tr>
	        <tr>
        <td height="60" colspan="2" valign="middle" bgcolor="#D3F3FE"><?php include("bot.php"); ?></td>
        </tr>

    </table></td>
  </tr>
</table>
</body>
</html>
<?php 
 /*  }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 
*/
}else{
  header("Location:index.php");
}
}  
?>