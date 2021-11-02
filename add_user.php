<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM tbl_accdtl WHERE flname='system_access_level.php' AND userid='$_SESSION[userid]'";
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
<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>
<script src="add_user.js" type="text/javascript"></script>

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
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if($_GET['t']==1){ ?><span style="color:#66CC66; font-weight:bold;"><?php echo $_GET['msg'];?></span><?php }else{ ?><span style="color:#FF0000; font-weight:bold;"><?php echo $_GET['msg'];?></span><?php } ?></font></p>
				<form name="MyForm" autocomplete="off" action="add_user.php" method="post" onsubmit="xmlhttpPost('ins_user.php', 'MyForm', 'MyResult', '<img src=\'loader.gif\'>'); return false;">
          <div align="center"><br />
          <table width="70%" border="0" align="center" cellpadding="0" cellspacing="3" id="stdtbl">

            <tr>
              <td width="29%" height="20" class="style2"><div align="left">User ID </div></td>
              <td width="3%"><div align="center"><span class="style2">:</span></div></td>
              <td width="68%" height="20"><label>
                <input name="userid1" type="text" id="userid1" onkeypress="return handleEnter(this, event)" />
              </label></td>
            </tr>
            <tr>
              <td height="20" class="style2"><div align="left">Name</div></td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><input name="username" type="text" id="username" onkeypress="return handleEnter(this, event)" /></td>
            </tr>
            <tr>
              <td height="20" class="style2"><div align="left">Email ID </div></td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><label>
                <input name="emailid" type="text" id="emailid" onkeypress="return handleEnter(this, event)" />
              </label></td>
            </tr>
            <tr>
              <td height="20" class="style2"><div align="left">Password</div></td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><label>
                <input name="password" type="text" id="password" onkeypress="return handleEnter(this, event)" />
              </label></td>
            </tr>
            <tr>
              <td height="20" class="style2"><div align="left">Access Type </div></td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><label>
                <select name="accid" id="accid" onkeypress="return handleEnter(this, event)">
				  <option></option>
				  <?php $acs="SELECT*FROM tbl_access";
				        $acq=$myDb->select($acs);
						while($acrow=$myDb->get_row($acq,'MYSQL_ASSOC')){
				  ?>
				  <option value="<?php echo $acrow['id']; ?>"><?php echo $acrow['accname']; ?></option>
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
          <p align="center"><div id="MyResult" align="center"><?php $sdq="SELECT l.id,l.userid,l.username,l.emailid,l.password,a.accname FROM tbl_access a
				              INNER JOIN tbl_login l
							  ON a.id=l.accid";
			    $sdep=$myDb->dump_query($sdq,'edit_user.php','del_user.php',$car[upd],$car[delt]);	?></div>
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
	 header("Location:home.php?msg=$msg&t=0");
   }	 

}else{
  header("Location:login.php");
}
}  
?>