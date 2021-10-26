<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
	
	$ct=$myDb->select("Select * from tbl_access Where id='$_GET[accid]'");
	$pct=$myDb->get_row($ct,"MYSQL_ASSOC");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<style type="text/css">
<!--
@import url("main.css");
.style17 {font-family: Impact}
.style19 {
	font-family: Impact;
	font-size: 24px;
	color: #8000FF;
}
.style21 {
	font-family: "Trebuchet MS";
	font-size: 16px;
	color: #FF33CC;
	font-weight: bold;
}

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
        <td height="28" colspan="2" bgcolor="#0C6ED1"><div align="center" class="style1"><?php include("company.php");?></div></td>
        </tr>
      <tr>
        <td background="images/leftbg.jpg">&nbsp;</td>
        <td><div align="center"><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['t'])==0){ ?><span style="color:#FF6600; font-weight:bold;"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></span><?php } ?></font></div></td>
      </tr>
	  
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php");?><br />
          <p>&nbsp;</p>
          <p>&nbsp;</p></td><td width="79%" valign="top"><blockquote>
          <p align="center">&nbsp;</p>
          <p align="center">&nbsp;</p>
          <p align="center">&nbsp;</p>
          <p align="center">&nbsp;</p>
          <p align="center"><span class="style4"><span class="style19">Welcome</span> to <span class="style21"><?php echo $pct['accname'];?> Panel</span>.</span></p>
          </blockquote>
          <p>&nbsp;</p></td></tr>
		  <tr>
	  <div class="input">
		     <label><a href="dbbackup_code/save.php" style="margin-left:100px;"><b>Save Database</b></a></label>
		     <label><a href="dbbackup_code/download.php" style="margin-left:50px;"><b>Download Database</b></a></label>
			 <label></label>
			 <label style="float:right"></label>
		   </div>
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
}else{
  header("Location:login.php");
}
}  
?>
