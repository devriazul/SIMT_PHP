<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='supplier_list.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  $id=mysql_real_escape_string($_GET['id']);
  $eds=$myDb->select("SELECT*FROM tbl_supplier WHERE id='$id'");
  $edf=$myDb->get_row($eds,'MYSQL_ASSOC');
  
  
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
.form-table{
   margin:10px;
   padding-left:100px;
   font-family:Verdana, Arial, Helvetica, sans-serif;
   font-size:12px;
}
.form-table td{
   padding:4px;
}      
</style>
<script language="javascript" src="jquery-1.4.2.js"></script>

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


<script language="javascript">
  $(document).ready(function(){
     $('#submit').css({'margin-left':'5px','margin-top':'5px','margin-bottom':'5px','border':'1px solid #999999'});
	 $('#submit').click(function(){
	   var arr=$('#sfrm').serializeArray();
	   if($('#sname').val()==""){
	     alert("Supplier Name can not left empty");
		 $('#sname').focus();
		 return false;
	   }
	   if($('#sphone').val()==""){
	     alert("Supplier Phone can not left empty");
		 $('#sphone').focus();
		 return false;
	   }	 
	   if($('#saddress').val()==""){
	     alert("Supplier Address can not left empty");
		 $('#saddress').focus();
		 return false;
	   }	 
	  
	   $.post('ed_supplier.php',arr,function(res){
	      $('#insup').html(res).hide().fadeIn('slow');
		  document.sfrm.reset();
		  $('#sname').focus();
		  window.location.reload();
	   }); 
	 
	 });
  });
</script>

<script type="text/javascript" src="jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#searchid").autocomplete("search_supplier.php", {
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
        <td background="images/leftbg.jpg">&nbsp;</td>
        <td><div align="center"><font face="Arial, Helvetica, sans-serif" size="2">
		<div id="insup"></div>
		
		<?php if(isset($_GET['t'])==0){ ?><span style="color:#FF6600; font-weight:bold;"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></span><?php } ?></font></div></td>
      </tr>
	  
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php");?>���������<br />
		
          <p>&nbsp;</p>
          <p>&nbsp;</p></td><td valign="top">
		  
		  <div id="top-search-div"> 
           <div id="content">
		   <label>Hostel Information</label>
		   <div class="input">
		   <form method="post" autocomplete="off" action="supplier1.php">
		     <label>Search Form</label>
			 <label><input type="text" id="searchid" name="searchid" /></label>
			 <label><input type="submit" name="subs" id="submit-btn" value="Search" /></label>
			 <label><a href="add_supplier.php"><input type="button" name="addbtn" id="submit-btn" value="Add New" /></a></label>
			  
		   </form>
		   </div>
		</div>
		</div>
		<br />
		  <form name="sfrm" id="sfrm" method="post">
		  <table width="500" border="0" cellspacing="0" cellpadding="0" class="form-table">
  <tr>
    <td height="30" colspan="3" style="background-color:#CCCCCC; border-bottom:1px solid #333333; ">Edit Supplier </td>
  </tr>
  <tr>
    <td width="135">Name</td>
    <td width="6">:</td>
    <td width="259"><label>
      <input type="text" name="sname" id="sname" onkeypress="return handleEnter(this, event)" value="<?php echo $edf['sname']; ?>" />
    </label></td>
  </tr>
  <tr>
    <td>Phone</td>
    <td>:</td>
    <td><label>
      <input type="text" name="sphone" id="sphone" onkeypress="return handleEnter(this, event)" value="<?php echo $edf['sphone']; ?>" />
    </label><input type="hidden" name="id" id="id" value="<?php echo $id; ?>" /></td>
  </tr>
  <tr>
    <td>Address</td>
    <td>:</td>
    <td><label>
      <textarea name="saddress" id="saddress" onkeypress="return handleEnter(this, event)" ><?php echo $edf['saddress']; ?></textarea>
    </label></td>
  </tr>
  <tr>
    <td>Email</td>
    <td>:</td>
    <td><label>
      <input type="text" name="semail" id="semail" onkeypress="return handleEnter(this, event)" value="<?php echo $edf['semail']; ?>"  />
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
    <td><label>
      <input type="button" name="submit" id="submit" value="Submit" />
    </label></td>
  </tr>
</table>
</form>
		  </td></tr>
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