<?php 
ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  	if($_SESSION['userid'])
	{
		if(isset($_GET['id'])) {$id=mysql_real_escape_string($_GET['id']);
	  	$eqry="SELECT id, accname, type, (SELECT parentid FROM `tbl_accchart` WHERE id='$id') as ParentId, (SELECT accname FROM tbl_accchart WHERE id in(SELECT parentid FROM `tbl_accchart` WHERE id='$id')) as ParentHead FROM tbl_accchart WHERE id='$id'";
		$edt=$myDb->select($eqry);
  		$egr=$myDb->get_row($edt,'MYSQL_ASSOC');}
		$chka="SELECT*FROM  tbl_accdtl WHERE flname='view_chart_ofacc.php' AND userid='$_SESSION[userid]'";
  		$caq=$myDb->select($chka);
  		$car=$myDb->get_row($caq,'MYSQL_ASSOC');
		if($car['upd']=="y")
		{
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
	$("#parenthead").autocomplete("search.php", {
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
<script src="acrsedit.js" type="text/javascript"></script>
<script src="accid.js" type="text/javascript"></script>


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
        <td width="79%" valign="top" class="style2">
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){  echo $_GET['msg'];}?></font></p>
		<form name="MyForm" autocomplete="off" action="edit_chart_of_acc.php" method="post" onsubmit="xmlhttpPost('ed_chart_of_acc.php?id=<?php echo $id;?>', 'MyForm', 'MyResult', '<img src=\'loader.gif\'>'); return false;">		
		
          <div align="center"><br />
          <table width="70%" border="0" align="center" cellpadding="0" cellspacing="5" id="stdtbl">
            <tr>
              <td height="20" colspan="3" align="center" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">
                <div align="left">EDIT CHART OF ACCOUNTS (<span class="stars">*</span>Mandatory Field) 
                </div></td>
              </tr>
            <tr>
              <td class="style2">&nbsp;</td>
              <td height="20" class="style2">&nbsp;</td>
              <td height="20">&nbsp;</td>
            </tr>
            <tr>
              <td width="29%" class="style2">Account Name <span class="stars">*</span></td>
              <td width="14%" height="20" class="style2"><div align="center">:</div></td>
              <td width="57%" height="20"><div align="left">
                <input name="accname" type="text" id="accname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="60" value="<?php echo $egr['accname'];?>" />
              </div></td>
            </tr>
            <tr>
              <td class="style2">Parent Head <span class="stars">*</span></td>
              <td height="20" class="style2"><div align="center">:</div></td>
              <td height="20" ><div align="left">               
              <input name="parenthead" type="text" id="parenthead"  style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onblur="xmlhttpPost1('accid.php', 'MyForm', 'myDiv2', '<img src=\'loader.gif\'>');" onkeypress="return handleEnter(this, event)" value="<?php echo $egr['ParentHead'];?>" size="60" />
				</div> <div id="myDiv2"></div>
               
              </td>
            </tr>
            <tr>
              <td class="style2">Account Type <span class="stars">*</span></td>
              <td height="20" class="style2"><div align="center">:</div></td>
              <td height="20"><div align="left">
                <select name="acctype" id="acctype" class="style2" onkeypress="return handleEnter(this, event)">
                    
					<option value="<?php echo $egr['type']; ?>" selected><?php echo $egr['type']; ?></option>
                    <option value="None">None</option>
				    <option value="Trading Account">Trading Account</option>
                    <option value="Profit Loss Account">Profit Loss Account</option>
                    <option value="Profit Loss App">Profit Loss App</option>
                    <option value="Expense Account">Expense Account</option>
                    <option value="Balance Sheet">Balance Sheet</option>
                </select>
              </div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><div align="center"></div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><input type="submit" value="Update" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" /> 
                <input type="reset" name="Submit2" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/>
                <span class="style2">
                <input name="accidload" type="hidden" id="accidload" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF"  size="10" value="<?php echo $egr['ParentId'];?>"  onkeypress="return handleEnter(this, event)"/>
                </span></td>
            </tr>
          </table>          
          <p>&nbsp;</p>
          </div>

            </form>
          <br />
          <div id="MyResult" align="center"></div>
          <p align="center">&nbsp;
            </p>
<p></p>
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
}
else
{
	$msg="Sorry, You are not authorized to access this page.";
    header("Location:view_chart_ofacc.php?msg=$msg");
}
}else{
  header("Location:login.php");
}
}  
?>
