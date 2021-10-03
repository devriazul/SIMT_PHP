<?php ob_start();
session_start();
require_once('dbClass.php');
if(!$_SESSION['emagasesid']){
   include("logout.php");
}else{
	 include("config.php");
     $id=mysql_real_escape_string($_GET['id']);
     $eds="SELECT*FROM tbl_access WHERE id='$id'";
	 $edq=$myDb->select($eds);
	 $edrow=$myDb->get_row($edq,'MYSQL_ASSOC');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>!@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&*</title>
<style type="text/css">
<!--
@import url("main.css");
.style12 {font-size: 10px}
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style16 {font-size: 12px}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

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
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1047"><table width="100%" border="0" cellspacing="0" cellpadding="0" id="tblleft">
      <tr bgcolor="#FFFFFF">
        <td height="28" colspan="2"><div align="left" class="style1">
          <?php include("top.php"); ?>
        </div></td>
        </tr>
      <tr>
        <td background="images/leftbg.jpg"><img src="images/leftbg.jpg" width="252" height="3" /></td>
        <td><img src="images/spaer.gif" width="1" height="1" /></td>
      </tr>
      <tr>
        <td valign="top" background="../images/bg.gif"><?php include("left.php"); ?></td>
        <td width="79%" valign="top">
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></font></p>
				<form name="MyForm" autocomplete="off" action="ed_dashboard.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
          <div align="center"><br />
          <table width="70%" border="0" align="center" cellpadding="0" cellspacing="3" id="stdtbl">

            <tr>
              <td width="29%" height="20" class="style2"><div align="left">Access Type</div></td>
              <td width="3%"><div align="center"><span class="style2">:</span></div></td>
              <td width="68%" height="20"><label>
                <input name="accname" type="text" id="accname" value="<?php echo $edrow['accname']; ?>" />
              </label></td>
            </tr>
            <tr>
              <td height="20" class="style2"><div align="left">Description</div></td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><textarea name="description" cols="60" id="description" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"><?php echo $edrow['description']; ?></textarea></td>
            </tr>
            <tr>
              <td class="style12">Image</td>
              <td align="center" class="style12">:</td>
			    <input type="hidden" name="imgname" id="imgname" value="<?php echo $edrow['img']; ?>" />
              <td><input name="img" type="file" class="style4" id="img" onkeypress="return handleEnter(this, event)"/></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><?php if(!empty($edrow['img'])){ ?>
			    <img src="dashboardimg/<?php echo $edrow['img']; ?>" width="100" height="80" /> 
			  <?php } ?></td>
            </tr>
			<tr>
              <td><span class="style12">Order</span></td>
              <td align="center"><span class="style12">:</span></td>
              <td>
			  <select name="orderid" id="orderid">
			    <option selected value="<?php echo $edrow['orderid']; ?>"><?php echo $edrow['orderid']; ?></option>
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
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
			  </select></td>
            </tr>            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><input type="submit" value="Submit" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"> <input type="reset" name="Submit2" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/></td>
            </tr>
          </table>          
          </div>

            </form>
                      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="2" class="Vlink">
                  <tr bgcolor="#F8F8F8">
                    <td height="23"><strong><font face="Verdana" size="2">View Dashboard </font></strong></td>
                  </tr>
                  <tr>
                    <td><hr /></td>
                  </tr>
                  <tr>
                    <td><table width="100%"  border="1" cellpadding="2" cellspacing="0" bordercolor="#000000" class="Vlink">
                        <tr bgcolor="#0066CC">
                          <td width="5%" height="30"><div align="center" style="color:#FFFFFF; font-weight:bold; " ><font size="2" face="Verdana">ID</font></div></td>
                          <td width="29%" height="30"><div align="left" style="color:#FFFFFF; font-weight:bold; " ><font face="Verdana" size="2">Access Name</font></div></td>
                          <td width="31%"><span style="color:#FFFFFF; font-weight:bold; " ><font face="Verdana" size="2">Description</font></span></td>
                          <td width="9%"><div align="center" style="color:#FFFFFF; font-weight:bold; "><span ><font face="Verdana" size="2">Image</font></span></div></td>
                          <td width="15%" height="30"><div align="center" style="color:#FFFFFF; font-weight:bold; " ><font face="Verdana" size="2">Order ID </font></div></td>
                          <td width="11%" height="30"><div align="center" style="color:#FFFFFF; font-weight:bold; " ><font face="Verdana" size="2">Action</font></div></td>
                        </tr>
                        <!-- Start loop -->
                        <?php

					

					$cat=mysql_query("select * from tbl_access order by id desc") or die(mysql_error());

					//$cat=mysql_query("select*from cat order by rating  desc ") or die(mysql_error());
					$i=0;

					$count=0;

					while($catfetch=mysql_fetch_array($cat)){ $i++ ;

					if(($count%2)==0){

					$bgcolor="#ffffff";

					

				?>
                        <tr bgcolor="<?php echo $bgcolor ;?>">
                          <td width="5%" height="24"><div align="center"><font face="Verdana" size="1">
                              <?php  echo $catfetch['id']; ?>
                          </font></div></td>
                          <td width="29%" height="24"><div align="left"><font face="Verdana" size="1"><?php echo $catfetch['accname']; ?></font></div></td>
                          <td width="31%"><font face="Verdana" size="1"><?php echo $catfetch['description']; ?></font></td>
                          <td width="9%"><div align="center"><img src="dashboardimg/<?php echo $catfetch['img']; ?>" width="50" height="50" /></div></td>
                          <td width="15%" height="24"><div align="center"><font face="Verdana" size="1"><?php echo $catfetch['orderid']; ?></font></div></td>
                          <td width="11%" height="24"><div align="center"><font face="Verdana" size="1"><a href="edit_dashboard.php?id=<?php echo $catfetch['id']; ?>">EDIT</a> - <a href="del_access_level.php?id=<?php echo $catfetch['id']; ?>" onclick="return confirm('Are you sure you want to delete?')">DELETE</a></font></div></td>
                      </tr>
                        <?php }else{

				$bgcolor="#F0F0FF";

				?>
                        <tr bgcolor="<?php echo $bgcolor ;?>">
                          <td width="5%" height="24"><div align="center"><font face="Verdana" size="1">
                              <?php  echo $i ?>
                          </font></div></td>
                          <td width="29%" height="24"><div align="left"><font face="Verdana" size="1"><?php echo $catfetch['accname']; ?></font></div></td>
                          <td width="31%"><font face="Verdana" size="1"><?php echo $catfetch['description']; ?></font></td>
                          <td width="9%"><div align="center"><img src="dashboardimg/<?php echo $catfetch['img']; ?>" width="50" height="50" /></div></td>
                          <td width="15%" height="24"><div align="center"><font face="Verdana" size="1"><?php echo $catfetch['orderid']; ?></font></div></td>
                          <td width="11%" height="24"><div align="center"><font face="Verdana" size="1"><a href="edit_dashboard.php?id=<?php echo $catfetch['id']; ?>">EDIT</a> - <a href="del_access_level.php?id=<?php echo $catfetch['id']; ?>" onclick="return confirm('Are you sure you want to delete?')">DELETE</a></font></div></td>
                      </tr>
                        <?php 

					}

					$count++;

					}

				?>
                        <!-- End loop -->
                    </table></td>
                  </tr>
                  <tr>
                    <td><hr /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table>            <p align="center">            </p>
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
   }