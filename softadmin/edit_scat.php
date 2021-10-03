<?php session_start();
if(!$_SESSION['emagasesid']){
   include("logout.php");
}else{
   include("config.php");
   $scatid=$_GET['id'];



					$st=mysql_query("SELECT * FROM `tbl_menuscat` WHERE `id` ='$scatid'") or die(mysql_error());
					$vfetch=mysql_fetch_array($st);
					
					$ct=mysql_query("SELECT * FROM `tbl_menucat` WHERE `id` ='$_GET[cid]'") or die(mysql_error());
					$cfetch=mysql_fetch_array($ct);
					//echo $_GET[id].$sfetch[cid];

   
?>  
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title> !@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&* </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
.style1 {font-weight: bold}
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
</head>

<body>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" >
  <tr bgcolor="#FFFFFF">
    <td><?php include("top.php"); ?></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="9%" bgcolor="#FFFFFF"><img src="../images/specer.gif" width="225" height="1"></td>
        <td width="91%" bgcolor="#FFFFFF"><img src="../images/spacer.gif" width="1" height="1"></td>
      </tr>
      <tr valign="top">
        <td background="../images/bg.gif"><?php include("left.php"); ?></td>
        <td bgcolor="#FFFFFF"><div align="center">
          <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="50%"><div align="left"></div></td>
              <td width="50%"><div align="right">
                  <input name="Button" type="button" onClick="MM_goToURL('parent','Javascript:history.back();');return document.MM_returnValue" value="BACK">
              </div></td>
            </tr>
          </table>
          <span class="style1"></span>
          </div>
          <form action="update_scat.php?id=<? echo $_GET[id];?>" method="post" enctype="multipart/form-data" name="form1">
            <table width="99%" border="0" align="center" cellpadding="0" cellspacing="2">
              <tr bgcolor="#F8F8F8">
                <td height="23" colspan="3" bgcolor="#FFFFFF"><div align="left"><span class="style1"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#FF0000"><?php if(isset($_GET['msg'])){ echo $_GET['msg'] ;  }?></font></span></div></td>
              </tr>
              <tr bgcolor="#F8F8F8">
                <td height="23" colspan="3"><strong><font face="Verdana" size="2">Edit Sub Menu </font></strong></td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="160" height="25"><strong><font face="Verdana" size="2">Menu Name</font></strong></td>
                <td width="15" height="25"><span class="style5">:</span></td>
                <td width="614" height="25">
			<select name="cid" id="cid" style="font-size:16px;">
              <option value="<?php echo $cfetch['id'];?>" selected="selected"><?php echo $cfetch['section'].'-'.$cfetch['name'];?></option>
              	<?php 
			  	$c1at=mysql_query("select*from tbl_menucat order by id asc") or die(mysql_error());
	 			while($c1fetch=mysql_fetch_array($c1at)){
	 			?>
              <option value="<?php echo $c1fetch['id']; ?>"><?php echo $c1fetch['section'].'-'.$c1fetch['name']; ?></option>
			  	<?php } ?>
			</select>		  </td>
              </tr>
              <tr>
                <td height="25"><strong><font face="Verdana" size="2">Sub Menu Name</font></strong></td>
                <td height="25"><span class="style5">:</span></td>
                <td height="25"><input name="name" type="text" id="name" value="<?php echo $vfetch['name'];?>" size="40"></td>
              </tr>
              <tr>
                <td height="25"><strong><font size="2" face="Verdana">URL</font></strong></td>
                <td height="25"><span class="style5">:</span></td>
                <td height="25"><input name="url" type="text" id="url" value="<?php echo $vfetch['url'];?>" size="40"></td>
              </tr>
			  <tr>
                <td><strong><font face="Verdana" size="2">Menu Order </font></strong></td>
                <td><span class="style5">:</span></td>
                <td><input name="mord" type="text" id="mord" value="<?php echo $vfetch['morder'];?>" size="10"></td>
              </tr>
              <tr>
                <td height="25"><strong><font face="Verdana" size="2">Status</font></strong></td>
                <td height="25"><span class="style5">:</span></td>
                <td height="25"><font face="Verdana" size="2">
				<select name="status" id="status">
					<option value="<?php echo $vfetch['status'];?>" selected="selected"><?php echo $vfetch['status'];?></option>
					<option value="Active">Active</option>
					<option value="InActive">InActive</option>
				</select>
                </font></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><input name="vdate" type="hidden" id="vdate" value="<?php $today = date("Y-m-d"); echo $today; ?>">
				<input name="id" type="hidden" value="<?php echo $vfetch['id'];?>">
				</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><input type="submit" name="Submit" value="Submit"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </form>
          <p><br>          
              <br>
          </p></td>
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