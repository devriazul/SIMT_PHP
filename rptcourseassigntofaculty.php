<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
	if($_SESSION['userid']){
	
	$dp="SELECT*FROM  tbl_department WHERE id='$_POST[deptid]'";
  	$dpq=$myDb->select($dp);
  	$cardp=$myDb->get_row($dpq,'MYSQL_ASSOC');
	$dep=$cardp['name'];


  	$sm="SELECT*FROM  tbl_semester WHERE id='$_POST[semester]'";
  	$csm=$myDb->select($sm);
  	$carsm=$myDb->get_row($csm,'MYSQL_ASSOC');
	$semester=$carsm['name'];
      
			     
				

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<style type="text/css">
<!--
body {

	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

#Layer1 {
	position:absolute;
	left:118px;
	top:70px;
	width:123px;
	height:21px;
	z-index:1;
}
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style4 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style5 {font-weight: bold}
-->
</style></head>

<body>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" id="tblleft">
  <tr>
    <td height="28" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td height="28" bgcolor="#FFFFFF"><div align="center"><span class="style5">
      <?php include("rptheader.php");?>
    </span></div></td>
  </tr>
  <tr>
    <td height="28" bgcolor="#FFFFFF"><div align="center" class="style5"></div></td>
  </tr>
  <tr>
    <td><img src="images/spaer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td valign="top"><div align="center"><strong>Course Assign to Faculty Report </strong></div></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" ><div align="center"><strong>Department Name:</strong> <?php echo $dep;?></div></td>
  </tr>
  <tr>
    <td valign="top" ><div align="center"><strong>Semester Name:</strong> <?php echo $semester;?></div></td>
  </tr>
  <tr>
    <td valign="top" ><div align="center" ><strong>Session:</strong> <?php echo $_POST['session']." (".$_POST['year'].")";?></div></td>
  </tr>
  <tr>
    <td width="79%" valign="top">
		<?php 
		$mcrs="SELECT distinct f.facultyid, f.name AS FacultyName FROM tbl_assignfaculty a INNER JOIN tbl_faculty f ON a.facultyid = f.id INNER JOIN tbl_department d ON a.deptid = d.id INNER JOIN tbl_courses c ON a.courseid = c.id INNER JOIN tbl_semester s ON a.semesterid = s.id WHERE a.deptid='$_POST[deptid]' and a.semesterid='$_POST[semester]' and a.session='$_POST[session]' and a.year='$_POST[year]' Order By f.name";
  				  
		$mcrq=$myDb->select($mcrs); 
		while($mcrsr=$myDb->get_row($mcrq,'MYSQL_ASSOC'))
		{
?>
      <table width="96%" height="88" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="stdtbl">
        <tr bgcolor="#DFF4FF">
          <td height="25" colspan="4" class="style5">Faculty Name :<span style="font-style:italic; "><?php echo $mcrsr['FacultyName'];?></span></td>
        </tr>
        <tr bgcolor="#F4F4F4">
          <td width="198" height="25" class="style2"><strong>Course Code </strong></td>
          <td width="553" class="style2"><strong>Course Name </strong></td>
          <td width="553" class="style2"><strong>Department Name</strong></td>
          <td width="553" class="style2"><strong>Group</strong></td>
        </tr>
<?php
		
		$crs="SELECT a.id, f.facultyid, f.name AS FacultyName, d.name AS DepartmentName, c.coursecode, c.coursename AS CourseName, s.name AS SemesterName, a.session AS SESSION , a.year AS YEAR, a.section FROM tbl_assignfaculty a INNER JOIN tbl_faculty f ON a.facultyid = f.id INNER JOIN tbl_department d ON a.deptid = d.id INNER JOIN tbl_courses c ON a.courseid = c.id INNER JOIN tbl_semester s ON a.semesterid = s.id WHERE f.facultyid='$mcrsr[facultyid]' and a.deptid='$_POST[deptid]' and a.semesterid='$_POST[semester]' and a.session='$_POST[session]' and a.year='$_POST[year]'";
  				  
		$crq=$myDb->select($crs); 
		$count=0;

		
		while($crsr=$myDb->get_row($crq,'MYSQL_ASSOC')){
			if($count%2==0){
			$bgcolor="#FFFFFF";?>
        <tr bgcolor="<?php echo $bgcolor; ?>">
          <td height="18" class="style4" ><?php echo $crsr['coursecode'];?></td>
          <td class="style4" ><?php echo $crsr['CourseName'];?></td>
          <td class="style4" ><?php echo $crsr['DepartmentName'];?></td>
          <td class="style4" ><?php echo $crsr['section'];?></td>
        </tr>
        <?php }else{ $bgcolor="#F7FCFF"; ?>
        <tr bgcolor="<?php echo $bgcolor; ?>">
          <td height="18" class="style4" ><?php echo $crsr['coursecode'];?></td>
          <td class="style4" ><?php echo $crsr['CourseName'];?></td>
          <td class="style4" ><?php echo $crsr['DepartmentName'];?></td>
          <td class="style4" ><?php echo $crsr['section'];?></td>
        </tr>
        <?php }
			  	 	$count++;
			  }
			  
			?>
      </table>
       <?php }?>
</td>
  </tr>
  <tr>
    <td height="61" valign="middle" bgcolor="#FFFFFF"><?php include("rptbot.php"); ?>
    <div align="center"></div></td>
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
