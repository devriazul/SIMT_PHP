<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
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
        <td background="images/leftbg.jpg">&nbsp;</td>
        <td><div align="center"><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])) {echo $_GET['msg'];}?></font></div></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php");?><br />
          <p>&nbsp;</p>
          <p>&nbsp;</p></td><td width="79%" height="300" valign="top"><blockquote>
          <p><span class="style4">Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..</span></p>
        </blockquote>
            <p>&nbsp;</p></td></tr>
      <tr>
        <td height="60" colspan="2" valign="middle" bgcolor="#D3F3FE"><?php include("bot.php"); ?></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<?php 
}else{
  header("Location:login.php");
}
}  
?>
