<?php 
ob_start();
session_start();
require_once('dbClass.php');
$myDb=new DbClass;
$host='localhost';
$user='root';
$pwd='dtbd13adm1n';
$db='simtdb';
$abc='';
if($myDb->connect($host,$user,$pwd,$db,true))
{  
  
	// AJAX JQuery Validation 
	include("validation/validation.php");

	// Condition checks Submit button is set or not
	if(isset($_POST["btnlogin"]))
	{
		$uname=mysql_real_escape_string($_POST['adminid']);
		$password=mysql_real_escape_string(md5($_POST['password']));
	
		// Select username and password from admin table
		$result = mysql_query("SELECT tbl_login.*,tbl_access.accname as dept FROM `tbl_login`,`tbl_access` WHERE `tbl_login`.accid=`tbl_access`.id and `tbl_access`.accname='Students Portal' and userid='$uname' AND password='$password'");
		$row=mysql_fetch_array($result);
		// Query checks Entered user id is valid or not...
		if(mysql_num_rows($result) == 1)
		{
			// 	redirects to admindashboard.php
			$_SESSION['userid']=$row['userid'];
			header("Location: stdhome.php");
			//echo "u got accessed.";
		}
		else
		{
	
			// "Login Failed.. Please try again" message stores in variable $abc
			$abc="Login Failed.. Please try again";
		}
	}
}
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
	background-image: url(images/bg.jpg);
	background-repeat: repeat;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style1 {
	color: #999999;
	font-weight: bold;
}
-->
</style>
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



</head>

<body>
<div align="center">
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){echo $_GET['msg'];}?></font></p>
<form name="formID" id="formID"  method="post" action="">
<TABLE WIDTH=80 align="center" BORDER=0 CELLPADDING=0 CELLSPACING=0>
	<TR>
		<TD COLSPAN=5>
			<IMG SRC="images/1stpage_01.jpg" WIDTH=855 HEIGHT=125 ALT=""></TD>
	</TR>
	<TR>
		<TD ROWSPAN=5>
			<IMG SRC="images/1stpage_02.jpg" WIDTH=239 HEIGHT=339 ALT=""></TD>
		<TD COLSPAN=3>
			<IMG SRC="images/1stpage_03.jpg" WIDTH=366 HEIGHT=19 ALT=""></TD>
		<TD ROWSPAN=5>
			<IMG SRC="images/1stpage_04.jpg" WIDTH=250 HEIGHT=339 ALT=""></TD>
	</TR>
	<TR>
		<TD>
			<IMG SRC="images/1stpage_05.jpg" WIDTH=17 HEIGHT=64 ALT=""></TD>
		<TD>
			<IMG SRC="images/1stpage_06.jpg" WIDTH=333 HEIGHT=64 ALT=""></TD>
		<TD>
			<IMG SRC="images/1stpage_07.jpg" WIDTH=16 HEIGHT=64 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=3>
			<IMG SRC="images/1stpage_08.jpg" WIDTH=366 HEIGHT=8 ALT=""></TD>
	</TR>
	<TR>
		<TD>
			<IMG SRC="images/1stpage_09.jpg" WIDTH=17 HEIGHT=228 ALT=""></TD>
		<TD bgcolor="#03597A" valign="top">
			<div align="center">
              <center>
              <table width="50%" border="0" cellpadding="2">
                <tr>
                  <td width="310"><div align="left"><font face="Verdana" size="2" color="#FFFFFF">
                  Username</font></div></td>
                </tr>
                <tr>
                  <td width="310"><div align="left">
				<input name="adminid" type="text" size="30" class="validate[required] text-input" id="adminid" value=""  style="height:25px;" onkeypress="return handleEnter(this, event)"/>                  
				</div></td>
                </tr>
                <tr>
                  <td width="310">&nbsp;</td>
                </tr>
                <tr>
                  <td width="310"><div align="left"><font face="Verdana" size="2" color="#FFFFFF">
                  Password</font></div></td>
                </tr>
                <tr>
                  <td width="310">
                    <div align="left">
          		<input type="password" name="password" id="password" class="validate[required] text-input" size="30" style="height:25px;" onkeypress="return handleEnter(this, event)"/>
                  </div></td>
                </tr>
                <tr>
                  <td width="310">&nbsp;</td>
                </tr>
                <tr>
                  <td width="310">
                    <div align="right">
                      <input class="submit"  type="submit" name="btnlogin" id="btnlogin" value="Login" border="0"  align="right" width="82" height="34" >
                  </div></td>
                </tr>
                <tr>
                  <td><div align="center" style="font:Verdana, Arial, Helvetica, sans-serif; color:#FF0000;"><?php 
											// prints if its invalid password
											echo $abc; 
										?></div></td>
                </tr>
              </table>
              </center>
            </div>
        </TD>
		<TD>
			<IMG SRC="images/1stpage_11.jpg" WIDTH=16 HEIGHT=228 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=3>
			<IMG SRC="images/1stpage_12.jpg" WIDTH=366 HEIGHT=20 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=5>
			<IMG SRC="images/1stpage_13.jpg" WIDTH=855 HEIGHT=57 ALT=""></TD>
	</TR>
</TABLE>
 
  </form>
</div>
</body>
</html>
