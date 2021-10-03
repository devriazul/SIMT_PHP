<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM tbl_accdtl WHERE flname='manage_userinfo.php' AND userid='$_SESSION[userid]' and storedstatus<>'D'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  $id=mysql_real_escape_string($_GET['id']);
  $eds="SELECT*FROM tbl_login WHERE id='$id'";
  $edq=$myDb->select($eds);
  $edrow=$myDb->get_row($edq,'MYSQL_ASSOC');
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
	$("#searchid").autocomplete("search_user.php", {
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
<script src="edit_userinfo.js" type="text/javascript"></script>

</head>

<body>
<table width="1047" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1047" height="152" valign="top" background="images/1.jpg"><span class="style17"><?php include("topdefault.php");?>    </span></span></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" id="tblleft">
      <tr>
        <td height="28" colspan="2" bgcolor="#0C6ED1"><div align="center" class="style1"><?php include("company.php"); ?></div></td>
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
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['t'])==1){ ?><span style="color:#66CC66; font-weight:bold;"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></span><?php }else{ ?><span style="color:#FF0000; font-weight:bold;"><?php if(isset($_GET['msg'])){echo $_GET['msg']; }?></span><?php } ?></font></p>
				
<div id="top-search-div"> 
           <div id="content">
		   <label>Edit Authentication</label>
		   <div class="input">
		   <form method="post" autocomplete="off" action="manage_userinfo_search.php">
		     <label>Search Form</label>
			 <label><input type="text" id="searchid" name="searchid" placeholder="Search by User ID" /></label>
			 <label><input type="submit" name="subs" id="submit-btn" value="Search" /></label>
			 <label><a href="add_userinfo.php"><input type="button" name="addbtn" id="submit-btn" value="Add New" /></a></label>
		   </form>
		   </div>
		</div>
		</div>
				<form name="MyForm" autocomplete="off" action="edit_userinfo.php" method="post" onsubmit="xmlhttpPost('update_userinfo.php?id=<?php echo $_GET['id']; ?>', 'MyForm', 'MyResult', '<img src=\'loader.gif\'>'); return false;">
          <div align="center"><br />
          <table width="70%" border="0" align="center" cellpadding="0" cellspacing="3" id="stdtbl">

            <tr>
              <td height="20" colspan="3" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">EDIT USER INFORMATION </td>
             
			  <td width="37%" height="20" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><span class="stars">*</span>(Mandatory Field) </td>
            </tr>
            <tr>
              <td width="24%" height="20" class="style2"><div align="left">User Name <span class="stars">*</span></div></td>
              <td width="3%"><div align="center"><span class="style2">:</span></div></td>
              <td width="36%" height="20" ><label>
              <input name="uname" class="style4" type="text" id="uname" onkeypress="return handleEnter(this, event)" value="<?php echo $edrow['userid']; ?>"  />
</label></td>
            </tr>
            <tr>
              <td height="20" class="style2">Password <span class="stars">*</span></td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><input name="upass" class="style4" type="text" id="upass" onkeypress="return handleEnter(this, event)" /></td>
            </tr>
            <tr>
              <td height="20" class="style2"><div align="left">Email ID </div></td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><label>
                <input name="emailid" class="style4" type="text" id="emailid" onkeypress="return handleEnter(this, event)" value="<?php echo $edrow['emailid']; ?>" />
              </label></td>
            </tr>
            <tr>
              <td height="20" class="style2"><div align="left">Access Type <span class="stars">*</span></div></td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><label>
                <select name="accessid" class="style4" id="accessid" onkeypress="return handleEnter(this, event)">
				  <?php $acs1="SELECT*FROM tbl_access WHERE id='$edrow[accid]'";
				        $acq1=$myDb->select($acs1);
						while($acrow1=$myDb->get_row($acq1,'MYSQL_ASSOC')){
				  ?>
				  <option selected="selected" value="<?php echo $acrow1['id']; ?>"><?php echo $acrow1['accname']; ?></option>
				  <?php } ?>
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
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><input type="submit" value="Submit" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"> <input type="reset" name="Submit2" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/></td>
            </tr>
          </table>          
          </div>

            </form>
          <div id="MyResult" align="center"></div>
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
  header("Location:index.php");
}
}