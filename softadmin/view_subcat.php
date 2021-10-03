<?php 
session_start();
if(!$_SESSION['emagasesid']){
   include("logout.php");
}else{
   include("config.php");
   
  if(@$_GET['d']==1){
     mysql_query("delete from tbl_menuscat where id='$_GET[id]'") or die(mysql_error());
	 header("Location:view_subcat.php?msg=Successfully Entry Deleted");
  }	 
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
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #000000; }
.style15 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.style16 {font-family: Calibri}
.style17 {font-size: 10px}
.style18 {font-family: Calibri; font-size: 10px; }
.style19 {font-family: Calibri; font-size: 10px; font-weight: bold; }
.style21 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FFFFFF; }
.style22 {color: #FFFFFF}
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
              <td width="50%"><span class="style1"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#FF0000"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></font></span></td>
              <td width="50%"><div align="right">
                  <input name="Button" type="button" onClick="MM_goToURL('parent','Javascript:history.back();');return document.MM_returnValue" value="BACK">
              </div></td>
            </tr>
          </table>
          <span class="style1"></span>
          </div>
          <hr size="1">
          <form name="form1" method="post" action="">
            <table width="996" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="Vlink" >
              <!--DWLayoutTable-->
              <tr align="center" bgcolor="#FF9900">
                <td height="25" colspan="5" bgcolor="#F0FFFF"><span class="style5">View Sub Menu </span></td>
              </tr>
              <tr>
                <td width="260" height="25" bgcolor="#0066CC" style="border-bottom:1px solid #e7e7e7; "><span class="style21">Category</span></td>
                <td width="265" bgcolor="#0066CC" style="border-bottom:1px solid #e7e7e7; "><span class="style21" >Sub-Category</span></td>
                <td width="185" bgcolor="#0066CC" style="border-bottom:1px solid #e7e7e7; "><span class="style21" >URL</span></td>
                <td width="121" bgcolor="#0066CC" style="border-bottom:1px solid #e7e7e7; "><div align="center" class="style22"><span class="style15">Status</span></div></td>
                <td width="153" align="center" bgcolor="#0066CC" class="style15" style="border-bottom:1px solid #e7e7e7; color: #FFFFFF;">Action</td>
              </tr>
              <?php $vuser=mysql_query("select*from tbl_menucat") or die(mysql_error());
  while($ufetch=mysql_fetch_array($vuser)){
  ?>
              <tr>
                <td height="30" valign="middle" bgcolor="#F8F8F8" style="border-bottom:1px solid #e7e7e7; "><div style="font-size:12px;">&nbsp;<span class="style19">-&gt;</span><span class="style16">&nbsp;<?php echo $ufetch['section'].": ".$ufetch['name']; ?></span></div></td>
                <td height="30" colspan="4" valign="middle" style="border-bottom:1px solid #e7e7e7; "><table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC">
                    <!--DWLayoutTable-->
    <?php 
	$scat=mysql_query("select*from tbl_menuscat where cid='$ufetch[id]'")or die(mysql_error());
	while($sfetch=mysql_fetch_array($scat)){
	?>
                    <tr valign="middle" bgcolor="#F4F4F4">
                      <td width="260"><span style="font-family: Calibri; font-size:10px;"><?php echo $sfetch['name']; ?></span></td>
                      <td width="181" height="21"><span style="font-family: Calibri; font-size:10px;"><?php echo $sfetch['url']; ?></span></td>
                      <td width="116" height="21"><div align="center" class="style16 style17"><?php echo $sfetch['status']; ?></div></td>
                      <td width="147" height="21"><div align="center" class="style18"><a href="edit_scat.php?id=<?php echo $sfetch['id']; ?>&cid=<?php echo $ufetch['id']; ?>">EDIT</a> - <a href="view_subcat.php?id=<?php echo $sfetch['id']; ?>&d=1" onClick="return confirm('Are you sure want to delete the record!')">DELETE</a></div></td>
                      </tr>
                    <?php } ?>
                </table></td>
              </tr>
              <?php } ?>
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