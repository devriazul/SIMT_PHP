<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 

	$vs="SELECT * from tbl_noticeboard WHERE storedstatus<>'D' and id='$_GET[id]'";
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
.style8 {font-family:Trebuchet MS; font-size:12px; font-weight:bold;}
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
          <table width="90%" height="147" border="0"  cellpadding="8" cellspacing="1" id="stdtbl" align="center">
            <tr bgcolor="#CCCCCC">
              <td height="35" colspan="3"><div align="center"><strong>Notice Borad </strong></div></td>
              </tr>
            <tr>
              <td width="24%" bgcolor="#DFF4FF"><span class="style8">Published Date </span></td>
              <td width="1%">:</td>
              <td width="75%" bgcolor="#F5F5F5"><?php echo $row['adate'];?></td>
            </tr>
            <tr>
              <td bgcolor="#DFF4FF"><span class="style8">Headline</span></td>
              <td>:</td>
              <td bgcolor="#F5F5F5"><?php echo $row['headline'];?></td>
            </tr>
            <tr>
              <td bgcolor="#DFF4FF"><span class="style8">Full Notice </span></td>
              <td>:</td>
              <td bgcolor="#F5F5F5"><?php echo $row['description'];?></td>
            </tr>
          </table>          <p class="style4">&nbsp;</p>
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
        <td width="99%"><div align="center" class="style7">� Copyright All Rights Reserved. Powered By: <a href="https://riaz.fastitbd.com">(Web Developer) </a><a href="https://www.saicgroupbd.com">Saic Group</a></div></td>
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
?>
