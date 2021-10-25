<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
	if($_SESSION['userid']){
  	$vs="SELECT s.id, s.stdname, s.stdid, s.password, s.session, d.name as Department, b.batchname as Batch, sm.name as Semester, s.fname, s.mname, s.nationality, s.praddress, s.peraddress, s.phone, s.sexstatus, s.dob, s.bgroup, s.religion, s.img FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_semester sm on s.semester=sm.id WHERE s.storedstatus<>'D' and s.stdid='$_SESSION[userid]'";
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
.style10 {color: #FFFFFF; font-weight: bold; }
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
          <table width="91%" border="0" align="center" cellpadding="0" cellspacing="2" id="stdtbl">
            <tr>
              <td height="20" colspan="4" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">STUDENT PERSONAL INFORMATION</td>
            </tr>
            <tr bgcolor="#DFF4FF">
              <td height="32" colspan="4" class="style2">General Information</td>
            </tr>
            <tr>
              <td width="23%" height="20" bgcolor="#F2F2F2" class="style2">Student ID :</td>
              <td width="31%" height="20" bgcolor="#F2F2F2"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['stdid'];  ?></span></td>
              <td width="18%" bgcolor="#F2F2F2"><span class="style2">Sex :</span></td>
              <td width="28%" bgcolor="#F2F2F2"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['sexstatus'];  ?></span></td>
            </tr>
            <tr bgcolor="#F2F2F2">
              <td height="20" class="style2">Name:</td>
              <td height="20"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['stdname'];  ?></span></td>
              <td><span class="style2">Contact No :</span></td>
              <td><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['phone'];  ?></span></td>
            </tr>
            <tr bgcolor="#F2F2F2">
              <td height="20" class="style2">Batch :</td>
              <td height="20"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['Batch'];  ?></span></td>
              <td><span class="style2">Department :</span></td>
              <td><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['Department'];  ?></span></td>
            </tr>
            <tr bgcolor="#F2F2F2">
              <td height="20" class="style2">Session :</td>
              <td height="20"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['session'];  ?></span></td>
              <td><span class="style2">Semester :</span></td>
              <td><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['Semester'];  ?></span></td>
            </tr>
            <tr bgcolor="#DFF4FF">
              <td height="42" colspan="4" class="style2">Educational Information</td>
              </tr>
            <tr valign="top" bgcolor="#F2F2F2">
              <td height="20" colspan="4" class="style2"><div align="center">
                
				<table width="80%" height="54" border="1" cellpadding="0" cellspacing="0" >
                  <tr bordercolor="#CCCCCC" bgcolor="#00CCFF">
                    <td height="25"><span class="style10">Exam Name </span></td>
                    <td><span class="style10">Board</span></td>
                    <td><span class="style10">Group</span></td>
                    <td><span class="style10">Passing Year </span></td>
                    <td><span class="style10">CGPA</span></td>
                    </tr>
					<?php 
  				  $crs="SELECT * FROM `tbl_educationalq` WHERE stdid='$_SESSION[userid]'";
				  $crq=$myDb->select($crs); 
				  $count=0;
  				  while($crsr=$myDb->get_row($crq,'MYSQL_ASSOC')){

					?>
                  <tr>
                    <td><?php echo $crsr['nexemination'];?></td>
                    <td><?php echo $crsr['board'];?></td>
                    <td><?php echo $crsr['group1'];?></td>
                    <td><?php echo $crsr['passyear'];?></td>
                    <td><?php echo $crsr['cgpas'];?></td>
                    </tr>
                  <?php }?>
                </table>
              </div></td>
              </tr>
            <tr bgcolor="#DFF4FF">
              <td height="40" colspan="4" class="style2">Personal Information</td>
            </tr>
            <tr bgcolor="#F2F2F2">
              <td height="20" class="style2">Father's Name :</td>
              <td height="20"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['fname'];  ?></span> </td>
              <td><span class="style2">DOB :</span></td>
              <td><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['dob'];  ?></span> </td>
            </tr>
            <tr bgcolor="#F2F2F2">
              <td height="20" class="style2">Mother's Name :</td>
              <td height="20"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['mname'];  ?></span> </td>
              <td><span class="style2">Religion :</span></td>
              <td><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['religion'];  ?></span> </td>
            </tr>
            <tr bgcolor="#F2F2F2">
              <td height="20" class="style2">Blood Group :</td>
              <td height="20"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['bgroup'];  ?></span> </td>
              <td><span class="style2">Nationality :</span></td>
              <td><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['nationality'];  ?></span></td>
            </tr>
            <tr bgcolor="#F2F2F2">
              <td height="20" class="style2">Present Address :</td>
              <td height="20" colspan="2"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['praddress'];  ?></span></td>
              <td>&nbsp;</td>
            </tr>
            <tr bgcolor="#F2F2F2">
              <td height="20" class="style2">Permanent Address :</td>
              <td height="20" colspan="2"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['peraddress'];  ?></span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="20" class="style2">&nbsp;</td>
              <td height="20">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="20" class="style2">&nbsp;                    </td>
              <td height="20">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
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
        <td width="99%"><div align="center" class="style7">� Copyright All Rights Reserved. Powered By: DesktopBD</div></td>
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
