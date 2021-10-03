<?php session_start();

if(!$_SESSION['emagasesid']){

   include("index.php");

}else{

   include("config.php");
	  $sadmin=mysql_query("SELECT*FROM tbl_softadmin WHERE userid='$_SESSION[emagasesid]'") or die(mysql_error());
	  $sfetch=mysql_fetch_array($sadmin);?>  

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>

<title> !@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&* </title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="refresh" content="60" />
<link href="links.css" rel="stylesheet" type="text/css">







<style type="text/css">

<!--

body {

	background-color: #CCCCCC;

	margin-left: 5px;

	margin-top: 5px;

	margin-right: 5px;

	margin-bottom: 5px;

}
.style10 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }

-->

</style>
</head>



<body>

<table width="100%"  border="0" cellpadding="0" cellspacing="0" >

  <tr bgcolor="#FFFFFF">
    <td><?php include("top.php"); ?></td>
  </tr>
  <tr bgcolor="#FFFFFF">

    <td bgcolor="#0099CC">&nbsp;</td>

  </tr>

  <tr>

    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td width="9%" bgcolor="#FFFFFF"><img src="../images/specer.gif" width="225" height="1"></td>

        <td width="91%" bgcolor="#FFFFFF"><img src="../images/spacer.gif" width="1" height="1"></td>

      </tr>

      <tr>

        <td valign="top" background="../images/bg.gif"><?php include("left.php"); ?></td>

        <td valign="top" bgcolor="#FFFFFF"><div align="center">
<form id="frm1" action="" method="post">
            </form>
          

        </div></td>

      </tr>

    </table></td>

  </tr>

  <tr>

    <td bgcolor="#0099CC"><img src="../images/spacer.gif" width="1" height="5"></td>

  </tr>

  <tr>

    <td bgcolor="#FFFFFF">&nbsp;</td>

  </tr>

</table>

</body>

</html>

<?php } ?>