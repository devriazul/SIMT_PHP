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
        <td height="28" bgcolor="#0C6ED1"><div align="center" class="style1">SAIC INSTITUTE OF MANAGEMENT TECHNOLOGY</div></td>
        </tr>
      <tr>
        <td height="257">
		
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ $str=$_GET['msg']; echo $str;}?></font></p>

<form name="login" method="post" action="vusr.php">

  <table width="359" border="0" align="center" cellpadding="2" cellspacing="0" id="tblleft">

    <tr bgcolor="#009900">

      <td height="25" colspan="3" bgcolor="#43ACEE"><p align="center" class="style1 style7">&nbsp;<strong>&raquo;<span class="style13"> Admin Login</span> &laquo;<br />
      <span class="style2 style3 style8"><span class="style2 style3 style5">Enter a Valid User Name/ Password to access</span></span></strong></p>        </td>
    </tr>

    <tr>

      <td height="21" colspan="3"><div align="center"><span class="style2 style3 style8"></span></div></td>
      </tr>

    <tr>

      <td width="106" height="21"><div align="right" class="style2 style3 style5">Username:</div></td>

      <td width="166" height="21"><input name="uname" type="text" id="uname" tabindex="1"></td>

      <td width="113">&nbsp;</td>
    </tr>

    <tr>
      <td height="3"></td>
      <td height="3"></td>
      <td></td>
    </tr>
    <tr>

      <td height="21"><div align="right" class="style4 style5"><strong>Password:</strong></div></td>

      <td height="21"><input name="password" type="password" id="password" tabindex="2" style="width:140px; "></td>
      <td>&nbsp;</td>
    </tr>

    <tr>

      <td height="21">&nbsp;</td>

      <td height="21"><input type="submit" name="Submit" value="Submit" tabindex="3"style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/></td>
      <td height="21">&nbsp;</td>
    </tr>

    <tr bgcolor="#009900">

      <td height="28" colspan="3" bgcolor="#43ACEE">&nbsp;</td>
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
