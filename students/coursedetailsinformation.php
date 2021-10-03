<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
	if($_SESSION['userid']){
  	$vs="SELECT d.name AS departmentname FROM  `tbl_semesterwisesubj` ss INNER JOIN tbl_semester s ON ss.semesterid = s.id INNER JOIN tbl_department d ON ss.deptid = d.id INNER JOIN tbl_courses c ON ss.courseid = c.id INNER JOIN tbl_stdinfo std ON ss.deptid = std.deptname WHERE std.stdid ='$_SESSION[userid]'";
  	$r=$myDb->select($vs);
  	$row=$myDb->get_row($r,'MYSQL_ASSOC');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<link href="css.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {

	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style1 {
	color: #999999;
	font-weight: bold;
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
.style3 {color: #082F5A}
.style4 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style7 {
	color: #FFFFFF;
	font-family: Calibri;
	font-size: x-small;
}
.style11 {
	font-family: Verdana;
	font-size: 10pt;
}
-->
</style></head>

<body>
<div class="style2" id="Layer1">
  <div align="center" class="style3">Ver : 1.0.0.1 </div>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5%" valign="top" background="images/leftinbg.jpg"><table width="100" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5%"><img src="images/topleft.jpg" width="265" height="113" /></td>
      </tr>
      <tr>
        <td background="images/leftinbg.jpg"><img src="images/leftinbg.jpg" width="265" height="3" /></td>
      </tr>
      <tr>
        <td background="images/leftinbg.jpg" class="Jlink"><table width="254" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td><?php include("left.php"); ?></td>
            </tr>
          </table>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
      </tr>
    </table></td>
    <td width="95%" valign="top" bgcolor="#FFFFFF" style="background-image: url(images/botbg.jpg); background-repeat: no-repeat; background-position: bottom;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td background="images/topbarbg.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="1%"><img src="images/topbarbg.jpg" width="3" height="44" /></td>
            <td width="99%"><div align="center" class="style1" ><font face="verdana" size="5">S t u d e n t &nbsp;W e b &nbsp;P a n e l</font></div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><p>&nbsp;</p>
          <table width="96%" border="0" align="center" cellpadding="0" cellspacing="0" id="stdtbl">
            <!--DWLayoutTable-->
            <tr align="center" >
              <td height="25" colspan="7"><div align="center"><span style="text-shadow:Black; font-style:italic; font-weight:bold; font-size:11px ">Department Name: <?php echo $row['departmentname'];?></span></div></td>
            </tr>
            <?php 
	$vuser=mysql_query("SELECT DISTINCT s.id, s.name AS semestername FROM  `tbl_semesterwisesubj` ss INNER JOIN tbl_semester s ON ss.semesterid = s.id INNER JOIN tbl_department d ON ss.deptid = d.id INNER JOIN tbl_courses c ON ss.courseid = c.id INNER JOIN tbl_stdinfo std ON ss.deptid = std.deptname WHERE std.stdid ='$_SESSION[userid]'") or die(mysql_error());
  while($ufetch=mysql_fetch_array($vuser)){
  ?>
            <tr bgcolor="#006699">
              <td height="30" colspan="7" valign="middle" style="border-bottom:1px solid #e7e7e7; "><span style="font-family: Verdana; font-size: 10pt; font-weight:bold;">&nbsp; <span style="font-family: Verdana; font-size: 10pt; color:#FFFFFF; font-weight:bold;"><?php echo $ufetch['semestername']; ?></span></span></td>
              </tr>
            <tr bgcolor="#DFF4FF">
              <td height="30" valign="middle" style="border-bottom:1px solid #e7e7e7; "><span style="font-family: Verdana; font-size: 10pt; font-weight:bold;">&nbsp;<span class="style2">Course Name</span></span></td>
              <td width="44" height="30" valign="middle" style="border-bottom:1px solid #e7e7e7; "><span style="font-family: Verdana; font-size: 10pt; font-weight:bold;"><span class="style2">Credit</span></span></td>
              <td width="95" height="30" valign="middle" style="border-bottom:1px solid #e7e7e7; "><span style="font-family: Verdana; font-size: 10pt; font-weight:bold;"><span class="style2">Theory Continuous</span></span></td>
              <td width="71" height="30" valign="middle" style="border-bottom:1px solid #e7e7e7; "><span style="font-family: Verdana; font-size: 10pt; font-weight:bold;"><span class="style2">Theory Final</span></span></td>
              <td width="111" valign="middle" style="border-bottom:1px solid #e7e7e7; "><span style="font-family: Verdana; font-size: 10pt; font-weight:bold;"><span class="style2">Practical Continuous</span></span></td>
              <td width="90" valign="middle" style="border-bottom:1px solid #e7e7e7; "><span style="font-family: Verdana; font-size: 10pt; font-weight:bold;"><span class="style2">Practical Final</span></span></td>
              <td width="67" height="30" valign="middle" style="border-bottom:1px solid #e7e7e7; "><div align="right"><span style="font-family: Verdana; font-size: 10pt; font-weight:bold;"><span class="style2">Total Marks</span></span></div></td>
            </tr>
            <tr>
              <td height="19" colspan="7"><table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#E6F2FF" >
                  <!--DWLayoutTable-->
                  <?php $y=date("Y");
	$scat=mysql_query("SELECT DISTINCT s.name AS semestername, d.name AS departmentname, CONCAT( c.coursecode,  ' ', c.coursename ) AS coursename, c.credit, c.cont_assess_t, c.f_exam_t, c.cont_assess_p, c.f_exam_p, (c.cont_assess_t + c.f_exam_t + c.cont_assess_p + c.f_exam_p) as totalmarks FROM  `tbl_semesterwisesubj` ss INNER JOIN tbl_semester s ON ss.semesterid = s.id INNER JOIN tbl_department d ON ss.deptid = d.id INNER JOIN tbl_courses c ON ss.courseid = c.id INNER JOIN tbl_stdinfo std ON ss.deptid = std.deptname WHERE std.stdid =  '$_SESSION[userid]' and ss.semesterid='$ufetch[id]' ")or die(mysql_error());
	while($sfetch=mysql_fetch_array($scat)){
	?>
                  <tr valign="middle" bordercolor="#E6F2FF">
                    <td width="261"><span style="font-family: Verdana; font-size: 8pt;">&nbsp;<?php echo $sfetch['coursename']; ?></span></td>
                    <td width="42" height="21"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $sfetch['credit']; ?></span></td>
                    <td width="94" height="21"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $sfetch['cont_assess_t']; ?></span></td>
                    <td width="71"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $sfetch['f_exam_t']; ?></span></td>
                    <td width="109"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $sfetch['cont_assess_p']; ?></span></td>
                    <td width="88"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $sfetch['f_exam_p']; ?></span></td>
                    <td width="63" height="21"><div align="right"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $sfetch['totalmarks']; ?></span></div></td>
                  </tr>
                  <?php } ?>
              </table></td>
            </tr>
            <?php } ?>
            <tr>
              <td width="266" height="19">&nbsp;</td>
              <td colspan="6">&nbsp;</td>
            </tr>
          </table>
          <p class="style4">&nbsp;</p>
          <p class="style4">&nbsp;</p>
          <p class="style4">&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
      </tr>

    </table></td>
  </tr>
  <tr>
    <td colspan="2" background="images/bbg.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="1%"><img src="images/bbg.jpg" width="3" height="44" /></td>
        <td width="99%"><div align="center" class="style7">© Copyright All Rights Reserved. Powered By: DesktopBD</div></td>
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
