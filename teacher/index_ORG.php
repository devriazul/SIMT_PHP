<?php 
// Database connection
//include("connection.php");
ob_start();
session_start();
require_once('dbClass.php');
$myDb=new DbClass;
$host='localhost';
$user='root';
$pwd='dtbd13adm1n';
$db='simtdb';
$abc='';

if($myDb->connectDefaultServer())
{  
  
// AJAX JQuery Validation 
include("validation/validation.php");

// Condition checks Submit button is set or not
if(isset($_POST["btnlogin"]))
{
	$uname=mysql_real_escape_string($_POST['adminid']);
	$password=mysql_real_escape_string(md5($_POST['password']));
	
	// Select username and password from admin table
	$result = mysql_query("SELECT tbl_login.*,tbl_access.accname as dept FROM `tbl_login`,`tbl_access` WHERE `tbl_login`.accid=`tbl_access`.id and `tbl_access`.accname='Teachers Panel' and userid='$uname' AND password='$password'");
	$row=mysql_fetch_array($result);
	// Query checks Entered user id is valid or not...
	if(mysql_num_rows($result) == 1)
	{

		// 	redirects to admindashboard.php
		$_SESSION['userid']=$row['userid'];
		header("Location: acchome.php");
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
<title>:: Login ::</title>
<style type="text/css">
<!--
@import url("main.css");
.style5 {color: #666666}
.style7 {font-size: 16px}
.style8 {
	color: #009966;
	font-size: 9px;
}
.style13 {font-size: 14px}
-->
div.transbox
  {
  background-color:#ffffff;

  opacity:0.9;
  filter:alpha(opacity=60); /* For IE8 and earlier */
  }

</style>

<script type="text/javascript" src="jquery.js"></script>
<script language="javascript">
$(document).ready(function(){
	$.browser.chrome = /chrom(e|ium)/.test(navigator.userAgent.toLowerCase()); 
	
	if(!$.browser.chrome){
	  alert("This application can run only on chrome");
	  $('#tblleft').hide();
	
	}else{
	  $('#tblleft').show(); 
	}
});


</script>
<script language="javascript">
$(document).keyup(function(e) {
  if(e.keyCode==45){
    $('#bothead').show();
  }
  if(e.keyCode==27){
    $('#bothead').hide();
  }
});
</script>

</head>

<body>
<table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="images/1.jpg" width="1047" height="140" /></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" id="tblleft">
      <tr>
        <td height="28" bgcolor="#0C6ED1"><div align="center" class="style1">SAIC INSTITUTE OF MANAGEMENT TECHNOLOGY</div></td>
        </tr>
      <tr>
        <td height="257">

<div class="transbox"><div id="bothead" style=" position:absolute; background-color:#666666;   padding:10px; color:#FFFFFF; left:200px;float:right;width:900px; height:auto; display:none; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
   
   	HELP SHORTCUT KEY:<br/>
  	-----------------------------------<br/><br/>
   <label>Press "Insert" key from keyboard 	---- To open help</label><br/> 
   <label>Press "Esc" key					---- To close help</label><br/> <br/><br/><br/>

	HOW TO LOGIN TO SOFTWARE:<br/>
  	----------------------------------------<br/><br/>
   <label>** First open Internet Explorer/ Fire Fox/ Goole Chrome browser then type: "http:// 192.168.1.138/simt/teacher" on the address bar and then press enter from keyboard.</label><br/>
   <label>** Type your Username (i.e: F XXX) in Username Textbox and Password to password column.</label><br/>
   <label>** Then press "Enter" to login to software. When you logged into software your attendance will collected automatically.</label><br/><br/><br/><br/>

	HOW TO LOGOUT FROM SOFTWARE:<br/>
  	-----------------------------------------------<br/><br/>
   <label>Click Logout Menu from the left menu.</label><br/><br/><br/><br/>
  
	HOW TO EXIT FROM OFFICE DUTY:<br/>
  	--------------------------------------------------<br/><br/>
   <label>** First open Internet Explorer/ Fire Fox/ Goole Chrome browser then type: "http:// 192.168.1.138/simt/officeout" on the address bar and then press enter from keyboard. </label><br/>
   <label>** Type your Username (i.e: F XXX) in Username Textbox and Password to password column. </label><br/>
   <label>** Avoid "Reason" Textbox if you out from office on time. But if you out early from the office then you should put a reason in "Reason" textbox.</label><br/>
	     
</div></div>

		
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){echo $_GET['msg'];}?></font></p>
<form name="formID" id="formID" class="formular" method="post" action="">
<p align="center">Teachers Login</span> <br />
      <span class="style2 style3 style8"><span class="style2 style3 style5">Enter a Valid User Name/ Password to access</span></span></p>
<p align="center"></strong>
    </font>
    <font color="#FF0000">
  <?php 
// prints if its invalid password
echo $abc; 
?>
    </font></b>
</p>
<p> <strong>User Name :
          <input name="adminid" type="text" class="validate[required] text-input" id="adminid" value=""  style="height:25px;"/>
          </strong></p>
          <p><strong>Password :
          <input type="password" name="password" id="password" class="validate[required] text-input" style="height:25px;"/>
          </strong></p>
          <p>
            <strong>
            <input class="submit"  type="submit" name="btnlogin" id="btnlogin" value="Login" />
            <input class="submit"  type="reset" name="button2" id="button2" value="Reset" />
            <br />
          </strong></p>
          <p>&nbsp;</p>
          <p>
</form>
		
		</td>
        </tr>
      <tr>
        <td height="60" valign="middle" bgcolor="#A5DEFC"><?php include("bot.php"); ?></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
