<?php ob_start();
session_start();
require_once('dbClass.php');
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
<?php $q=$myDb->select("select*from tbl_libsetting");
$rf=$myDb->get_row($q,'MYSQL_ASSOC');
if($rf['id']==""){
?>
<script type="text/javascript" src="js/jquery-latest.pack.js"></script>
<script>

$(document).ready(function() {	
	//select all the a tag with name equal to modal

	$(window).load(function(e) {
		//Cancel the link behavior
       
		e.preventDefault();
		//Get the A tag
		//var id = $('#a').attr('id');
				var id = $('#hr').attr('href');

		//alert(id);
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
			    $('#table_wrapper').load('add_settings.php');
       
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(300);
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(300); 
	
	});
	
	//if close button is clicked
	$('.window .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		
		
        // or opener.location.href = opener.location.href;
       // window.close(); // or self.close();
		$('#mask').hide();
		$('.window').hide();
		window.location.reload();
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});			

	$(window).resize(function () {
	 
 		var box = $('#boxes .window');
 
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
      
        //Set height and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});
               
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);
	 
	});
	
});

</script>
<?php } ?>
<style>
body {
font-family:verdana;
font-size:15px;
}

a {color:#333; text-decoration:none}
a:hover {color:#ccc; text-decoration:none}

#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#000;
  display:none;
  
}
  
#boxes .window {
  position:absolute;
  left:0;
  top:0;
  width:auto;
  height:auto;
  display:none;
  z-index:9999;
  padding:20px;

}

#boxes #dialog {
  width:auto; 
  height:auto;
  padding:10px;
  background-color:#ffffff;

}

#boxes #dialog1 {
  width:375px; 
  height:203px;
}

#dialog1 .d-header {
  background:url(images/login-header.png) no-repeat 0 0 transparent; 
  width:375px; 
  height:150px;
}
#dialog1 .d-header input {
  position:relative;
  top:60px;
  left:100px;
  border:3px solid #cccccc;
  height:22px;
  width:200px;
  font-size:15px;
  padding:5px;
  margin-top:4px;
}

#dialog1 .d-blank {
  float:left;
  background:url(images/login-blank.png) no-repeat 0 0 transparent; 
  width:267px; 
  height:53px;
}

#dialog1 .d-login {
  float:left;
  width:108px; 
  height:53px;
}

#boxes #dialog2 {
  background:url(images/notice.png) no-repeat 0 0 transparent; 
  width:326px; 
  height:229px;
  padding:50px 0 20px 25px;
}
</style>
</head>

<body id="a">
<?php if($rf['id']==""){ ?>

<a id="hr" href="#dialog" name="modal"></a>
 <div id="error"></div>
	<div id="boxes">

       <div id="dialog" class="window">
        
       <a href="#"class="close" style="margin-left:450px;"/>X</a>

       <div id="table_wrapper"></div>


     </div>
    </div>
  <div id="mask"></div>
<?php } ?>  
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
        <td><div align="center"><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['t'])==0){ ?><span style="color:#FF6600; font-weight:bold;"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></span><?php } ?></font></div></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php");?>���������<br />
          <p>&nbsp;</p>
          <p>&nbsp;</p></td><td width="79%" valign="top"><blockquote>
          <p><span class="style4">Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..</span></p>
        </blockquote>
          <table width="695" border="0" align="center" cellpadding="0" cellspacing="2" class="Vlink">
            <tr>
              <td width="25%" height="130" bgcolor="#F9F9F9"><div align="center"><img src="images/studentinfo.gif" width="124" height="116" /></div></td>
              <td width="25%" height="130" bgcolor="#F9F9F9"><div align="center"><img src="images/facultyinfo.gif" width="124" height="116" /></div></td>
              <td width="25%" height="130" bgcolor="#F9F9F9"><div align="center"><img src="images/courceinfo.jpg" width="124" height="116" /></div></td>
              <td width="25%" height="130" bgcolor="#F9F9F9"><div align="center"><img src="images/result.gif" width="124" height="116" /></div></td>
            </tr>
            <tr>
              <td width="25%" height="21" bgcolor="#F2F2F2"><div align="center" class="style4 style15"><a href="#">Student Info</a><br />
              </div></td>
              <td width="25%" height="21" bgcolor="#F2F2F2"><div align="center"><span class="style4 style16"><a href="#">Faculty info</a></span></div></td>
              <td width="25%" height="21" bgcolor="#F2F2F2"><div align="center"><span class="style4 style16"><a href="#">Course  Info</a></span></div></td>
              <td width="25%" bgcolor="#F2F2F2"><div align="center"><span class="style4 style16"><a href="#">Result Processing</a> </span></div></td>
            </tr>
            <tr>
              <td width="25%"><div align="center"><span class="style12"></span></div></td>
              <td width="25%"><div align="center"><span class="style12"></span></div></td>
              <td width="25%"><div align="center"><span class="style12"></span></div></td>
              <td width="25%">&nbsp;</td>
            </tr>
            <tr>
              <td width="25%" height="130" bgcolor="#F9F9F9"><div align="center"><span class="style12"></span><img src="images/feecollection.gif" width="124" height="116" /></div></td>
              <td width="25%" height="130" bgcolor="#F9F9F9"><div align="center"><span class="style12"></span><img src="images/library.jpg" width="124" height="116" /></div></td>
              <td width="25%" height="130" bgcolor="#F9F9F9"><div align="center"><span class="style12"></span><img src="images/payroll.jpg" width="124" height="116" /></div></td>
              <td width="25%" height="130" bgcolor="#F9F9F9"><div align="center"><img src="images/accounting.jpg" width="124" height="116" /></div></td>
            </tr>
            <tr>
              <td width="25%" height="21" bgcolor="#F2F2F2"><div align="center"><a href="#"><span class="style4 style16">Fees Collection</span></a></div></td>
              <td width="25%" height="21" bgcolor="#F2F2F2"><div align="center"><a href="#"><span class="style4 style16">Library Managent</span></a></div></td>
              <td width="25%" height="21" bgcolor="#F2F2F2"><div align="center"><a href="#"><span class="style4 style16">Teachers Payroll</span></a></div></td>
              <td width="25%" bgcolor="#F2F2F2"><div align="center" class="style15"><a href="#">Accounts Management</a></div></td>
            </tr>
            <tr>
              <td width="25%"><div align="center"><span class="style12"></span></div></td>
              <td width="25%"><div align="center"><span class="style12"></span></div></td>
              <td width="25%"><div align="center"><span class="style12"></span></div></td>
              <td width="25%">&nbsp;</td>
            </tr>
            <tr>
              <td width="25%"><div align="center"><span class="style12"></span></div></td>
              <td width="25%"><div align="center"><span class="style12"></span></div></td>
              <td width="25%"><div align="center"><span class="style12"></span></div></td>
              <td width="25%" bgcolor="#F9F9F9"><div align="center"><img src="images/logout.jpg" width="124" height="116" /></div></td>
            </tr>
            <tr>
              <td width="25%" height="21"><div align="center"></div></td>
              <td width="25%" height="21"><div align="center"></div></td>
              <td width="25%" height="21"><div align="center"></div></td>
              <td width="25%" bgcolor="#F2F2F2"><div align="center"><a href="#"><span class="style4 style16">Logout </span></a></div></td>
            </tr>
          </table>
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
