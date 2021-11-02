<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
	if($_SESSION['userid'])
	{
		$chka="SELECT*FROM  tbl_accdtl WHERE flname='view_chart_ofacc.php' AND userid='$_SESSION[userid]'";
  		$caq=$myDb->select($chka);
  		$car=$myDb->get_row($caq,'MYSQL_ASSOC');
        if($car['ins']=="y"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
	<link type="text/css" href="css/jquery-ui-1.8.5.custom.css" rel="Stylesheet" />

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
	$("#accname").autocomplete("search.php", {
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
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){echo $_GET['msg'];}?></font></p>
<div id="content">
<form autocomplete="off" action="view_chart_ofacc.php">
		<table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0" id="tblborder">
          <tr>
            <td width="44%"><div align="right"><span class="style2">Accout Name</span></div></td>
            <td width="1%"><div align="right" class="style2">
              <div align="center">: </div>
            </div></td>
            <td width="55%">
	
		
			<input type="text" name="accname" id="accname" />
			<!--input type="button" value="Get Value" /-->
		<input type="submit" value="Submit" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/>
</td>
          </tr>
        </table>
</form>	</div>	<br />
<?php 
 if(isset($_GET['accname'])){$accname=mysql_real_escape_string($_GET['accname']);
    //$query="SELECT id, accname, display FROM tbl_accchart WHERE accname like '%$accname%' and storedstatus<>'D' order by id asc";
    $query="SELECT id, accname, (select accname from tbl_accchart where id in(select parentid from tbl_accchart where accname ='$accname')) as ParentHead FROM tbl_accchart WHERE accname= '$accname' AND storedstatus <>  'D' ORDER BY id ASC";
	//$r=$myDb->select_one($query);
                //$sdq="select * from tbl_accchart where accname='$accname' AND storedstatus='I' OR storedstatus='U' order by id asc";
			    $sdep=$myDb->dump_query($query,'edit_chart_of_acc.php','del_chart_of_acc.php',$car['upd'],$car['delt']);
}
?>
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
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>