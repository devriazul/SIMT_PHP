<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='batchinfo.php' AND userid='$_SESSION[userid]'";
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
<script src="batch.js" type="text/javascript"></script>

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
<p align="center"><font face="Arial, Helvetica, sans-serif" size="2"><?php echo $_GET['msg'];?></font></p>
<form name="MyForm" action="batchinfo.php" method="post" onsubmit="xmlhttpPost('insBatch.php', 'MyForm', 'MyResult', '<img src=\'loader.gif\'>'); return false;">          <div align="center"><br />
          <table width="70%" border="0" align="center" cellpadding="0" cellspacing="3" id="stdtbl">

            <tr>
              <td width="29%" height="20" class="style2"><div align="left">Batch Name </div></td>
              <td width="3%"><div align="center"><span class="style2">:</span></div></td>
              <td width="68%" height="20"><input name="batchname" type="text" id="batchname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            
            <tr>
              <td height="20" class="style2"><div align="left">Session</div></td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><select name="session" class="style2" id="session" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                <option selected value="">Select session</option>
                <option value="0506">2005-2006</option>
                <option value="0607">2006-2007</option>
                <option value="0708">2007-2008</option>
                <option value="0809">2008-2009</option>
                <option value="0910">2009-2010</option>
                <option value="1011">2010-2011</option>
                <option value="1112">2011-2012</option>
                <option value="1213">2012-2013</option>
                <option value="1314">2013-2014</option>
                <option value="1415">2014-2015</option>
                <option value="1516">2015-2016</option>
                <option value="1617">2016-2017</option>
                <option value="1718">2017-2018</option>
                <option value="1819">2018-2019</option>
                <option value="1920">2019-2020</option>
                <option value="2021">2020-2021</option>
                <option value="2122">2021-2022</option>
                <option value="2223">2022-2023</option>
                <option value="2324">2023-2024</option>
                <option value="2425">2024-2025</option>
              </select></td>
            </tr>
            <tr>
              <td height="20" class="style2"><div align="left">Department</div></td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><label>
                <select name="depcode" id="depcode" onkeypress="return handleEnter(this, event)">
				<option value=""></option>
				 <?php $dep="SELECT*FROM tbl_department WHERE storedstatus IN('I','U')";
				       $depq=$myDb->select($dep);
					   while($depr=$myDb->get_row($depq,'MYSQL_ASSOC')){
					   ?>
					   <option value="<?php echo $depr['id']; ?>"><?php echo $depr['name']; ?></option>
					   <?php } ?>
                </select>
              </label></td>
            </tr>
            
            
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><input type="submit" value="Submit" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"> <input type="reset" name="Submit2" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/></td>
            </tr>
          </table>          
          </div>

            </form>
<p><div id="MyResult" align="center"></div>
</p>
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
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>