<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Login ::</title>



<script type="text/javascript" src="jquery.min.js"></script>
<script language="javascript">

/*function toggleDiv(divId) {

   $("#"+divId).toggle();
}
*/

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

.shadedbox{
    width: 313px;
    height: 66px;
    background: url(/images/note-bg.png) no-repeat;
    float: left;
    margin: 0 0 0 20px;
}
.style17 {color: #3399FF}

-->
</style>
</head>

<body>
<table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="images/1.jpg" width="1047" height="152" /></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" id="tblleft">
      <tr>
        <td height="257">
		
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo "Success"; }?></font></p>

<form name="login" method="post" action="vusr.php">

  <table width="312" border="0" align="center" cellpadding="2" cellspacing="0" id="tblleft">

    <tr background="images/note-bg.png" >

      <td height="63" colspan="3"><p align="center" class="style1 style7"><span class="style17">&nbsp;<strong>&raquo;<span class="style13"> Login</span> &laquo;</strong></span><strong><br />
      <span class="style2 style3 style8"><span class="style2 style3 style5">Enter a Valid User Name/ Password to access</span></span></strong></p>        </td>
    </tr>

    <tr>

      <td width="56" height="21"><div align="right" class="style2 style3 style5">Username:</div></td>

      <td width="228" height="21"><input name="uname" type="text" id="uname" tabindex="1" required></td>

      <td width="16">&nbsp;</td>
    </tr>

    <tr>
      <td height="3"></td>
      <td height="3"></td>
      <td></td>
    </tr>
    <tr>

      <td height="21"><div align="right" class="style4 style5"><strong>Password:</strong></div></td>

      <td height="21"><input name="password" type="password" id="password" tabindex="2" required></td>
      <td>&nbsp;</td>
    </tr>
<!--
    <tr>
      <td height="21" colspan="3"><div id="clickme"  style="background-color: #FFFFFF; font:Verdana, Arial, Helvetica, sans-serif; font-size:8px; font-weight:bold; color:#FF0000;  width: 200px; cursor:pointer;">
  Late In? Click Here
</div>
</td>
      </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td height="21"><select name="me" id="me" style="font-family: Verdana; font-size: 8pt; width:100%; padding:3px; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
        <option value="Regular In" selected="selected">Regular In</option>
        <option value="Office Work Purpose">Office Work Purpose</option>
        <option value="MD Medam Personal Purpose">MD Medam Personal Purpose</option>
        <option value="Chairman Sir Personal Purpose">Chairman Sir Personal Purpose</option>
        <option value="Bad Weather">Bad Weather</option>
        <option value="Sick">Sick</option>
        <option value="Political Issue">Political Issue</option>
      </select>

</td>
      <td height="21"></td>
    </tr>
-->	
    <tr>

      <td height="21">&nbsp;</td>

      <td height="21"><input type="submit" name="Submit" value="Submit" tabindex="3"style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/></td>
      <td height="21">&nbsp;</td>
    </tr>

    <tr>

      <td height="28" colspan="3"><img src="images/note-bg.png" width="308" height="24" /></td>
    </tr>
  </table>

  <p>&nbsp;</p>
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
