<?php 
ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  	if($_SESSION['userid'])
	{
		$chka="SELECT*FROM  tbl_accdtl WHERE flname='view_chart_ofacc.php' AND userid='$_SESSION[userid]'";
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
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php echo $_GET['msg'];?></font></p>
		<form id="form1" name="form1" method="post" action="ins_chartofacc.php">
          <div align="center"><br />
          <table width="98%" border="0" align="center" cellpadding="0" cellspacing="2" id="stdtbl">

            <tr>
              <td width="18%" class="style2">Account Code</td>
              <td width="2%" height="20" class="style2"><div align="center">: </div></td>
              <td width="80%" height="20"><div align="left">
                <input name="acccode" type="text" id="acccode" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="20" />
              </div></td>
            </tr>
            <tr>
              <td class="style2">Account Name</td>
              <td height="20" class="style2"><div align="center">:</div></td>
              <td height="20"><div align="left">
                <input name="accname" type="text" id="accname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="60" />
              </div></td>
            </tr>
            <tr>
              <td class="style2">Parent Head</td>
              <td height="20" class="style2"><div align="center">:</div></td>
              <td height="20" ><div align="left">
                <select name="parenthead" id="parenthead" class="style2" onkeypress="return handleEnter(this, event)">
                    <option value="-1" selected="selected">Parent Head</option>
                    <?php 
			  	$cat=mysql_query("select id, accname from tbl_accchart") or die(mysql_error());
	 			while($cfetch=mysql_fetch_array($cat)){
	 			?>
                    <option value="<?php echo $cfetch['id']; ?>"><?php echo $cfetch['accname']; ?></option>
                    <?php } ?>
                </select>
              </div></td>
            </tr>
            <tr>
              <td class="style2">Account Type </td>
              <td height="20" class="style2"><div align="center">:</div></td>
              <td height="20"><div align="left">
                <select name="acctype" id="acctype" class="style2" onkeypress="return handleEnter(this, event)">
                    <option selected="selected">Select Type</option>
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
              <td><input type="submit" value="Create" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" /> 
                <input type="reset" name="Submit2" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/></td></tr>
          </table>          
          <p>&nbsp;</p>
          </div>

            </form>
          <?php 
 $accname=mysql_real_escape_string($_GET['accname']);
    $query="SELECT id, accno, accname, display FROM tbl_accchart WHERE accname like '%$_GET[accname]%' and storedstatus<>'D' order by id asc";
    //$r=$myDb->select_one($query);
                //$sdq="select * from tbl_accchart where accname='$accname' AND storedstatus='I' OR storedstatus='U' order by id asc";
			    $sdep=$myDb->dump_query($query,'edit_chart_of_acc.php','del_chart_of_acc.php',$car['upd'],$car['delt']);

?>          <br />
          <p align="center">
            <input type="submit" value="Save" name="B12" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />
            <input type="reset" name="Submit22" value="Edit" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/>
            <input type="button" name="Submit222" value="Refresh" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/>
			
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
    header("Location:home.php?msg=$msg");
}
}else{
  header("Location:login.php");
}
}  
?>
