<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM tbl_accdtl WHERE flname='system_access_level.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
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
<script src="system_access_level.js" type="text/javascript"></script>

</head>

<body>
<table width="1047" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1047" height="18" valign="top" background="images/1.jpg"><span class="style17"><?php include("top.php");?>    </span></span></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" id="tblleft">
      <tr>
        <td background="images/leftbg.jpg"></td>
        <td><img src="images/spaer.gif" width="1" height="1" /></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php"); ?>
          <br />
          
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        <td width="79%" valign="top">
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></span></font></p>
				<form name="MyForm" autocomplete="off" action="ins_system_level.php" method="post" enctype="multipart/form-data" >
          <div align="center"><br />
          <table width="70%" border="0" align="center" cellpadding="0" cellspacing="3" id="stdtbl">

            <tr>
              <td width="29%" height="20" class="style2"><div align="left">Access Type</div></td>
              <td width="3%"><div align="center"><span class="style2">:</span></div></td>
              <td width="68%" height="20"><label>
                <input name="accname" type="text" id="accname" onkeypress="return handleEnter(this, event)" />
              </label></td>
            </tr>
            <tr>
              <td height="20" class="style2"><div align="left">Description</div></td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><textarea name="description" cols="60" id="description" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"></textarea></td>
            </tr>
            <tr>
              <td class="style12">Image</td>
              <td align="center" class="style12">:</td>
              <td><input name="img" type="file" class="style4" id="img" onkeypress="return handleEnter(this, event)"/></td>
            </tr>
            <tr>
              <td><span class="style12">Order</span></td>
              <td align="center"><span class="style12">:</span></td>
              <td>
			  <select name="orderid" id="orderid">
			    <option value=""></option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
			  </select></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><input type="submit" value="Submit" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"> <input type="reset" name="Submit2" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/></td>
            </tr>
          </table>          
          </div>

            </form>
          <p align="center"><?php $sdq="select * from tbl_access order by id desc";
			    $sdep=$myDb->dump_query($sdq,'edit_access_level.php','del_access_level.php',$car['upd'],$car['delt']);	?>
</p>
<p></p>
</td>
      </tr>
	         <tr>
    <td bgcolor="#0099CC"><img src="../images/spacer.gif" width="1" height="5"></td>
  </tr>

    </table></td>
  </tr>
</table>
</body>
</html>
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg&t=0");
   }	 

}else{
  header("Location:index.php");
}
}