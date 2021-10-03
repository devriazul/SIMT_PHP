<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  	if($_SESSION['userid'])
	{
		$chka="SELECT*FROM  tbl_accdtl WHERE flname='chart_of_acc.php' AND userid='$_SESSION[userid]'";
  		$caq=$myDb->select($chka);
  		$car=$myDb->get_row($caq,'MYSQL_ASSOC');
		if($car['ins']=="y")
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

<script type="text/javascript">
$().ready(function() {
	$("#accname").autocomplete("stdacc_search.php", {
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
 
function handleEnter12 (field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
			i = (i + 4) % field.form.elements.length;
			field.form.elements[i].focus();
			return false;
		} 
		else
		return true;
	}      
 
 
</script>

<script src="acrs.js" type="text/javascript"></script>
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
		
		<form name="MyForm" autocomplete="off" action="chart_of_acc.php" method="post" onsubmit="xmlhttpPost('ins_chartofacc.php', 'MyForm', 'MyResult', '<img src=\'loader.gif\'>'); return false;">
          <div align="center"><br />
          <table width="98%" border="0" align="center" cellpadding="0" cellspacing="2" id="stdtbl">

            <tr>
              <td height="20" colspan="2" align="center" valign="top" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">
                <div align="left">CHART OF ACCOUNTS <img src="images/transactions.png" width="24" height="24" /></div></td>
              <td width="80%" height="20" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><div align="center"><span class="stars">*</span>(Mandatory Field) 
              </div></td>
            </tr>
            <tr>
              <td class="style2">&nbsp;</td>
              <td height="20" class="style2">&nbsp;</td>
              <td height="20">&nbsp;</td>
            </tr>
            <tr>
              <td width="18%" class="style2"><div align="right"><span class="stars">*</span>Account Name</div></td>
              <td width="2%" height="20" class="style2"><div align="center">:</div></td>
              <td height="20"><div align="left">
                <input name="accname" type="text" id="accname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="60" />
              </div></td>
            </tr>
            <tr>
              <td class="style2"><div align="right"><span class="stars">*</span>Parent Head</div></td>
              <td height="20" class="style2"><div align="center">:</div></td>
              <td height="20" ><div align="left">
                <input name="parenthead" type="text" id="parenthead" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onblur="xmlhttpPost1('accid.php', 'MyForm', 'myDiv2', '<img src=\'loader.gif\'>');" onkeypress="return handleEnter(this, event)" value="Parent Head" size="60" />
              </div><div id="myDiv2">
                
              </div></td>
            </tr>
            <tr>
              <td class="style2"><div align="right"><span class="stars">*</span>Account Type</div></td>
              <td height="20" class="style2"><div align="center">:</div></td>
              <td height="20"><div align="left">
                <select name="acctype" id="acctype" class="style2" onkeypress="return handleEnter(this, event)">
                  <option value="Select Type" selected="selected">Select Type</option>
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
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><div align="center"></div></td>

              <td></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><input type="submit" value="Create" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" /> 
                <input type="reset" name="Submit2" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/></td></tr>
          </table>          
          <p>&nbsp;</p>
          </div>

            </form>
<br/>
<div id="MyResult" ></div>
          <?php 
	 if(isset($_GET['accname'])) {$accname=mysql_real_escape_string($_GET['accname']);
    $query="SELECT id, accno, accname, display FROM tbl_accchart WHERE accname like '%$accname%' and storedstatus<>'D' order by id asc";
    //$r=$myDb->select_one($query);
                //$sdq="select * from tbl_accchart where accname='$accname' AND storedstatus='I' OR storedstatus='U' order by id asc";
			    $sdep=$myDb->dump_query($query,'edit_chart_of_acc.php','del_chart_of_acc.php',$car['upd'],$car['delt']);}

?>          <br />
          <p align="center">&nbsp;</p>
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
    header("Location:acchome.php?msg=$msg");
}
}else{
  header("Location:login.php");
}
}  
?>
