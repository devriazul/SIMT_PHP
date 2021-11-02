<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='report_chartofacc.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
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

<script type="text/javascript" src="jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#accname").autocomplete("searchopac.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
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
<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>

</head>

<body>
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
        <td background="images/leftbg.jpg"><img src="images/leftbg.jpg" width="252" height="3" /></td>
        <td><img src="images/spaer.gif" width="1" height="1" /></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php"); ?>
          <br />
          
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        <td width="79%" valign="top">
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])) {echo $_GET['msg'];}?></font></p>
		<form name="form1" method="post" action="">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="Vlink" >
              <!--DWLayoutTable-->
              <tr align="center" bgcolor="#FF9900">
                <td height="25" colspan="2" bgcolor="#F0FFFF"><span class="style5">View Chart of Accounts </span></td>
              </tr>
              <tr>
                <td width="160" height="19">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="25" bgcolor="#EAEAFF" style="border-bottom:1px solid #e7e7e7; "><span class="style15">Parent</span></td>
                <td bgcolor="#EAEAFF" style="border-bottom:1px solid #e7e7e7; "><div align="center"><span class="style15">Accounting Hierarchy (List of Ledger) </span></div></td>
                </tr>
              <?php $vuser=mysql_query("select*from tbl_accchart Where parentid='-1'") or die(mysql_error());
  while($ufetch=mysql_fetch_array($vuser)){
  ?>
              <tr>
                <td height="30" valign="middle" bgcolor="#F8F8F8" style="border-bottom:1px solid #e7e7e7; "><div style=" font-family:Calibri; font-weight:bold; font-size:12px;">&nbsp;<span class="style15">-&gt;</span>&nbsp;<?php echo $ufetch['accname']; ?></div></td>
                <td height="30" valign="middle" style="border-bottom:1px solid #e7e7e7; "><table width="100%" border="0" cellpadding="0" cellspacing="2">
                    <!--DWLayoutTable-->
    <?php 
	$scat=mysql_query("select*from tbl_accchart where parentid='$ufetch[id]'")or die(mysql_error());
	while($sfetch=mysql_fetch_array($scat)){
	?>
                    <tr valign="middle" bgcolor="#F4F4F4">
                      <td width="153"><span style="font-family: Calibri; font-size:12px;"><?php echo $sfetch['accname']; ?></span></td>
                      <td width="474" height="21" bgcolor="#F8F8F8"><table width="100%" border="0" cellpadding="0" cellspacing="2">
                        <!--DWLayoutTable-->
                        <?php 
	$sscat=mysql_query("select*from tbl_accchart where parentid='$sfetch[id]'")or die(mysql_error());
	while($ssfetch=mysql_fetch_array($sscat)){
	?>
                        <tr valign="middle" bgcolor="#F4F4F4">
                          <td width="145"><span style="font-family: Calibri; font-size:12px;"><?php echo $ssfetch['accname']; ?></span></td>
                          <td width="321" height="21" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="0" cellspacing="2">
                              <!--DWLayoutTable-->
                              <?php 
	$ssscat=mysql_query("select*from tbl_accchart where parentid='$ssfetch[id]'")or die(mysql_error());
	while($sssfetch=mysql_fetch_array($ssscat)){
	?>
                              <tr valign="middle" bgcolor="#F4F4F4">
                                <td width="135"><span style="font-family: Calibri; font-size:12px;"><?php echo $sssfetch['accname']; ?></span></td>
                                <td width="178" height="21" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="0" cellspacing="2">
                                  <!--DWLayoutTable-->
                                  <?php 
	$sssscat=mysql_query("select*from tbl_accchart where parentid='$sssfetch[id]'")or die(mysql_error());
	while($ssssfetch=mysql_fetch_array($sssscat)){
	?>
                                  <tr valign="middle" bgcolor="#F4F4F4">
                                    <td width="146"><span style="font-family: Calibri; font-size:12px;"><?php echo $ssssfetch['accname']; ?></span></td>
                                    <td width="35" height="21"><!--DWLayoutEmptyCell-->&nbsp;</td>
                                  </tr>
                                  <?php } ?>
                                </table></td>
                              </tr>
                              <?php } ?>
                          </table></td>
                        </tr>
                        <?php } ?>
                      </table></td>
                      </tr>
                    <?php } ?>
                </table></td>
              </tr>
              <?php } ?>
              <tr>
                <td height="19">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </form>
          <div align="center"><br />
          	  <input name="submit" type="submit" id="submit" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" value="Print"/>	          
          </div>
          <p align="center">&nbsp;</p>
</td>
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
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>