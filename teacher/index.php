<?php 
// Database connection
//include("connection.php");
ob_start();
session_start();
require_once('dbClass.php');
$myDb=new DbClass;
$host='localhost';
$user='root';
$pwd='';    //dtbd13adm1n
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





<style type="text/css">
<!--




* {
    margin: 0;
}
html, body {
/*    height: 100%;*/
height:auto !important;
}
body {
    font-family:arial;
    margin: 0;
    background-color:#eeeeee;
    height:auto !important;
}
#content_wrapper {
    height:auto !important;
}
#top_logo {
    float:left;
    height:115px; width:155px;
    margin-top:15px;
    /*background:#fff url(../../images/login/fedena_logo.jpg) no-repeat;*/
}
#top_logo h1 {
    text-indent:-9999px;
}
#help_top {
    margin:0px auto;
    width:614px;height:1.5em;
}
#help_top #help_link {float:right;}
#help_top #help_link a {color:#b00;padding-right:10px;}

#login_strip {
    margin-top: 34px;
    height: 156px;
    width: 100%;
/*    background: #B00 url(/images/application/bg_pattern.png) repeat;*/
}
/*#login_area_bg{margin-top: -175px; height:362px;}*/
#login_area {width:255px;float:left;padding-left:30px;}
#login_area label {display:block;width:200px;margin-left:25px;padding-top:20px;font-weight:bold;color:#333333;padding-bottom:5px;font-size:13px;}

#username_textbox_bg, #password_textbox_bg {height:30px;margin:0px auto;margin-left:10px;width:250px;}
#username_textbox_bg input{width:235px;height:25px;font-family:arial !important;margin:0 0 20px 0px;float:left;background-color:#f9f9f9;border:1px solid #d9d9d9;border-top:1px solid #c0c0c0;font-size:13px;color:#333333;padding-left:5px;padding-right:5px;}

#password_textbox_bg input {
    width:235px;
    height:25px;
    margin:0px;
    float:left;background-color:#f9f9f9;
    border:1px solid #d9d9d9;
    border-top:1px solid #c0c0c0;
    font-size:13px;
    color:#333333;
    padding-left:5px;
    padding-right:5px;
    font-family:arial !important;
}

#password_ddbox_bg input {
    width:235px;
    height:25px;
    margin:0px;
    float:left;background-color:#f9f9f9;
    border:1px solid #d9d9d9;
    border-top:1px solid #c0c0c0;
    font-size:13px;
    color:#333333;
    padding-left:10px;
    font-family:arial !important;
}



#login_box {
    margin:0px auto;
    margin-top:150px;
    background-color:#ffffff;
    border: 1px solid #CCCCCC;
    border-radius:3px;
    width:540px;
}
#login-input-box {
    height:170px;
    padding:30px;
    width:480px;
}
#school-name {
    font-weight:bold;
    font-size:15px;
    text-align:center;
    color:#333333;
    padding-left:30px;
    padding-right:30px;
    padding-top:20px;
}
#logo_area {
    float:left;
    width:160px;
    padding-right:30px;
    border-right: 1px solid #CCCCCC;
    height:170px;
}

#submit_area {
    padding-left:10px;
    margin-top:5px;
    float:left;
    width:245px;
}
.openid_identifier {
    margin-top: 38px;
    overflow: hidden;
    padding: 0 !important;
    width: 350px !important;
}
#submit_area input {
    border: medium none;
    border-radius: 5px 5px 5px 5px;
    color: #FFFFFF;
    cursor: pointer;
    display: block;
    float: left;
    font-size: 15px;
    font-weight:bold;
    padding: 5px 10px;
    text-decoration: none;
    font-family: arial !important;

}
.forgot_pwd {
  float:right;
  text-decoration:none;
  display:block;
  font-size:11px;
  cursor:pointer;
  color:#666666;
  padding-top:10px;
}
#powered_by_div{
    color: #666666;
    float: left;
    font-size: 11px;
    height: 20px;
    margin: 10px auto 0;
    text-align: center;
    width: 100%;
}
#powered_by_div a{
    text-decoration:none;
}

#resetpw_area input {width:85px;height:38px;float:right;margin-right:58px;margin-top:55px;}

#checkbox_area {width:300px;float:left;}
#checkbox_area label {margin:0;display:inline;padding-left:5px;}
#checkbox_area input {margin:25px 5px 0 50px;padding:0;}

#notice {
    color: #DD0000;
    display: block;
    font-size: 11px;
    font-weight: normal;
    padding: 5px 0 0;
    text-align:center;
    margin-top:5px;
    height:13px;
    margin-left:10px;
}
#wrapper {
    height:auto !important;
}
#wrapper  #help_forgot_pw {margin:50px auto;text-align:center;width:614px;}
#wrapper  #help_forgot_pw a {text-decoration:none;font-weight:bold;color:#b00;}
#wrapper  #help_forgot_pw a:hover {text-decoration:underline;font-weight:bold;color:#b00;}

#username_texbox_bg input{border:none;margin:0px; padding:0px;text-align:center;}

input[type="text"], input[type="password"], textarea, select {outline: none;}

#footer {
    /* position : relative;
    margin-top : -33px; */
    height : 38px;
    clear : both;
    background-color:#323232;
    width:100%;
    margin-top:40px;
    border-top: 2px solid #4d4d4d;
}
#footer_logo {
    height:38px;
    width:980px;
    margin:0 auto;
}

#footer_logo a.footer-logo{
    display:block;
    float:right;
    height:38px;
    margin-top:-55px;
    width:210px;
}

#footer_logo a.footer-logo:hover {

}

#powered_by {
    height:20px;
    width:auto;
    margin:10px auto 0;
    color:#999999;
    font-size:13px;
    float: right;
}
#powered_by a {
    color:#fff;
    font-size:13px;
    text-decoration:none;
}
#powered_by a:hover {
    color:#fff;
    font-size:13px;
    text-decoration:underline;
}
#wrapper {
    position:relative;
}
.clearfooter {
height: 25px;
clear: both;
}
#username_textbox_bg input:focus,#password_textbox_bg input:focus{
    border: 1px solid #9e0f15;
    background: #fff;
}
.themed-dark-hover-background:hover{
    background-color: #7e0000;
}

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

body {
	background-color: #CCCCCC;
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

<script type="text/javascript" src="../jquery.min.js"></script>
<script language="javascript">
$(document).ready(function() {
 $('#me').hide();

     $('#clickme').click(function() {
          $('#me').animate({
               height: 'toggle'
               }, 100
          );
     });
});
</script>


<html dir="ltr">
  <head>
    
    <title><?php include("title.php");?></title>
    
      <link rel="shortcut icon" href="logo.png" type="" />
    
    
  </head>

  <body>
    
<div id="wrapper">
  <div id="login_box">
    <div id="school-name"></div>
    <div id="login-input-box">
      <div id="logo_area">
        <div id="top_logo">
          <img alt="Dummy_logo" src="logo.png" />
        </div>
      </div>
<form name="formID" id="formID" class="formular" method="post" action="">
<div style="margin:0;padding:0;display:inline"><input name="authenticity_token" type="hidden" value="yVoVAeoqNM8tDBVOs5DghdtoONHfCTidqtoAcbGbpe0=" /></div>

        <div id="login_area">

          <div id="username_textbox_bg">
            <input id="adminid" maxlength="40" name="adminid" placeholder="Username" size="40" type="text" onKeyPress="return handleEnter(this, event)" class="validate[required]" />
          </div>
          <div id="password_textbox_bg">
            <input id="password" name="password" placeholder="Password" size="30" type="password" onKeyPress="return handleEnter(this, event)" class="validate[required]" />
          </div>
		  <!--
		  <div id="clickme"  style="background-color: #FFFFFF; font:Verdana, Arial, Helvetica, sans-serif; font-size:10px; margin-left:12px; margin-top:8px; font-weight:bold; color:#FF0000;  width: 200px; cursor:pointer;">
  			Late In? Click Here
			</div>
          <div id="password_ddbox_bg">
			<select name="me" id="me" style="font-family: Verdana; font-size: 8pt; width:235px; 	margin-left:12px; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
				<option value="Regular In" selected="selected">Regular In</option>
				<option value="Office Work Purpose">Office Work Purpose</option>
				<option value="Exam Purpose">Exam Purpose</option>
				<option value="Bad Weather">Bad Weather</option>
				<option value="Sick">Sick</option>
        		<option value="Political Issue">Political Issue</option>
			  </select>
	       </div>-->
		  
          <div id="notice">
				<p align="left" ><font color="#FF0000" size="1">
				<?php // prints if its invalid password
				echo $abc; 
				?>
				</font></p>
          </div>

          <div id="submit_area">
            <input class="submit themed_bg themed-dark-hover-background" name="btnlogin" id="btnlogin" type="submit" value="Press to Login" />
          </div>

        </div>
      </form>

    </div>
  </div>
  <div id="powered_by_div">
    Powered By: <a href=../../www.desktopbd.com target="_blank" class="themed_text">DesktopBD </a>
  </div>

</div>


<script type="text/javascript">
  document.getElementById('adminid').focus();
</script>
  </body>
</html>
