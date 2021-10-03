<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
	if($_SESSION['userid']){
  	$vs="SELECT s.id, s.stdname, s.stdid, s.password, s.session, d.name as Department, b.batchname as Batch, sm.name as Semester, s.fname, s.mname, s.nationality, s.praddress, s.peraddress, s.phone, s.sexstatus, s.dob, s.bgroup, s.religion, s.img FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_semester sm on s.semester=sm.id WHERE s.storedstatus<>'D' and s.stdid='$_SESSION[userid]'";
  	$r=$myDb->select($vs);
  	$row=$myDb->get_row($r,'MYSQL_ASSOC');

  	$vsn="SELECT s.*, mf.* FROM `tbl_stdinfo` s inner join tbl_marksentryfinal mf on s.stdid=m.stdid WHERE s.storedstatus<>'D' and mf.stdid='$_SESSION[userid]' and mf.courseid='$_GET[courseid]'";
  	$rn=$myDb->select($vsn);
  	$rown=$myDb->get_row($rn,'MYSQL_ASSOC');

  	$vsc="SELECT c.* FROM `tbl_marksentryfinal` mf inner join tbl_courses c on mf.courseid=c.id WHERE mf.storedstatus<>'D' and mf.stdid='$_SESSION[userid]' and mf.courseid='$_GET[courseid]'";
  	$rc=$myDb->select($vsc);
  	$rowc=$myDb->get_row($rc,'MYSQL_ASSOC');


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
.style15 {	font-size: 12px; font-weight:bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>



</head>

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
          <table width="70%" border="0" align="center" cellpadding="0" cellspacing="0" id="stdtbl">
            <form name="MyForm" id="MyForm" autocomplete="off"  method="post" >
              <tr bgcolor="#F2F2F2">
                <td height="35" colspan="2" class="style15">Examinition Name</td>
                <td colspan="3" align="left"><span class="style15">Assigned Marks</span></td>
                <td align="left"><span class="style15">Obtained Marks</span></td>
              </tr>
              <tr>
                <td colspan="2" class="style15">&nbsp;</td>
                <td colspan="3" align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" class="style15">Quiz Test : </td>
                <td colspan="3" align="left">&nbsp;</td>
                <td width="26%" align="left">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" class="style15">Class Test : </td>
                <td colspan="3" align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" class="style15">Home Work : </td>
                <td colspan="3" align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" class="style15"><p>Job Experiment :</p>                  </td>
                <td colspan="3" align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" class="style15">Job Experiment Report : </td>
                <td colspan="3" align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" class="style15">Job Experiment Viva : </td>
                <td colspan="3" align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" class="style15">Job Experiment Final :</td>
                <td colspan="3" align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" class="style15">Job Experiment Report Final : </td>
                <td colspan="3" align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" class="style15">Job Experiment Viva Final : </td>
                <td colspan="3" align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" class="style15">General Attendance Marks : </td>
                <td colspan="3" align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" class="style15">Practical Attendance Marks : </td>
                <td colspan="3" align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" class="style15">Behavior Marks : </td>
                <td colspan="3" align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" class="style15">Final Examinition </td>
                <td colspan="3" align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" class="style15">&nbsp;</td>
                <td colspan="3" align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" class="style15">&nbsp;</td>
                <td colspan="3" align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" class="style15">&nbsp;</td>
                <td colspan="3" align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="6"> </td>
              </tr>
            </form>
          </table>
          <p class="style4">&nbsp;</p>
          <p class="style4">&nbsp;</p>
           
          <p class="style4">&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
           
          </td>
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
