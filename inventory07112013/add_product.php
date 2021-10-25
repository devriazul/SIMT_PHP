<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='requisition_list.php' AND userid='$_SESSION[userid]'";
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
@import url("main.css");
.style12 {font-size: 10px}
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style16 {font-size: 12px}

.form-table{
   margin:10px;
   padding-left:100px;
   font-family:Verdana, Arial, Helvetica, sans-serif;
   font-size:12px;
   
}
.form-table td{
   padding:3px;
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
	   if($('#pname').val()==""){
	     alert("Product Name can not left empty");
		 $('#pname').focus();
		 return false;
	   }
	   if($('#prtype').val()==""){
	     alert("Product type can not left empty");
		 $('#prtype').focus();
		 return false;
	   }
	  
	   $.post('ins_product.php',arr,function(res){
	      $('#insup').html(res).hide().fadeIn('slow');
		  $('#pname').focus();

		  document.sfrm.reset();
		  
		  
		  	   $("#preview").html('');
				$("#current").hide();
			    $("#preview").html('<img src="ajax-loader.gif" alt="Uploading...."/>');
			$("#imageform").ajaxForm({
						target: '#preview'
		    }).submit();

	   }); 
	 
	 });

  });
</script>

<script type="text/javascript" src="jquery.js"></script>
<script language="javascript" type="text/javascript">
 $(document).ready(function(){
   $('#prtype').keyup(function(e){
     
	   var prtype=$('#prtype').val();   
	   $.get("validatetext.php?prtype="+prtype+"&equip=1",function(r){
	     $('#validatetext').html(r);
	   });
	   $.get("formetText.php?prtype="+prtype+"&equip=1",function(r){
	     $('#prtype').val(r);
	   });
   
   });
  $('#prtype').keypress(function(e){
     
	   var prtype=$('#prtype').val();   
	   $.get("validatetext.php?prtype="+prtype+"&equip=1",function(r){
	     $('#validatetext').html(r);
	   });
   
   });   
   $('#mname').keyup(function(e){
	   var prtype=$('#mname').val();   
	   $.get("validatetext.php?prtype="+prtype+"&equip=2",function(r){
	     $('#validatetext').html(r);
	   });
	   $.get("formetText.php?prtype="+prtype+"&equip=1",function(r){
	     $('#mname').val(r);
	   });
   });
   
   $('#mname').keypress(function(e){
	   var prtype=$('#mname').val();   
	   $.get("validatetext.php?prtype="+prtype+"&equip=2",function(r){
	     $('#validatetext').html(r);
	   });
   });
   $('#pname').keyup(function(e){
	   var prtype=$('#pname').val();   
	   $.get("validatetext.php?prtype="+prtype+"&equip=3",function(r){
	     $('#validatetext').html(r);
	   });
	   $.get("formetText.php?prtype="+prtype+"&equip=1",function(r){
	     $('#pname').val(r);
	   });
   });
   
   $('#pname').keypress(function(e){
	   var prtype=$('#pname').val();   
	   $.get("validatetext.php?prtype="+prtype+"&equip=3",function(r){
	     $('#validatetext').html(r);
	   });
   });
 
 });

</script>




<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#searchid").autocomplete("search_product.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#prtype").autocomplete("search_prtype.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#mname").autocomplete("search_manufacturer.php", {
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

<script type="text/javascript" src="jquery.form.js"></script>


<style>

body
{
font-family:arial;
}
.preview
{
max-width:200px;
max-height:250px;
border:solid 1px #dedede;
padding:5px;
margin-left:90px;
}
#preview
{
color:#cc0000;
font-size:12px
}

</style>
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
		  
		 
           <div id="content">
		 
		</div>
		</div>
		<br />
		  
		  <style type="text/css">
<!--
.style10 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 8px;
	color:#333333;
}
-->
</style>
<table width="700" border="0" cellspacing="0" cellpadding="0" class="form-table">
  <tr>
    <td height="30" colspan="3" style="border-bottom:1px solid #333333; background-color:#CCCCCC; ">Add Product </td>
  </tr>
  <form name="sfrm" id="sfrm" method="post">
  <tr>
    <td width="141">Name*</td>
    <td width="11">:</td>
    <td width="548"><label>
      <input type="text" name="pname" id="pname" onKeyPress="return handleEnter(this, event)" />
    </label></td>
  </tr>
  <tr>
    <td>Pack Size</td>
    <td>:</td>
    <td><label>
      <input type="text" name="packsize" id="packsize" onKeyPress="return handleEnter(this, event)" />
    </label></td>
  </tr>
   

  <tr>
    <td>Product Type*</td>
    <td>:</td>
    <td><label>
        <input type="text" name="prtype" id="prtype" onKeyPress="return handleEnter(this, event)"/>
        <span class="style10">[Auto complete Box ,Example:stationary,HouseKeeping]
  </span></label></td>
  </tr>
  <tr>
    <td>Equipment Type </td>
    <td>:</td>
    <td><label>
      <input type="text" name="mname" id="mname" onkeypress="return handleEnter(this, event)"/>
      <span class="style10">[Auto complete Electrical,Computer] </span></label></td>
  </tr>
  <tr>
    <td>Opening Value </td>
    <td>:</td>
    <td><input type="text" name="qty" id="qty" onkeypress="return handleEnter(this, event)"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><label>
      <input type="button" name="submit" id="submit" value="Submit" />
    </label></td>
  </tr>
  </form>

<tr><td colspan="3">
<div id='preview'></div>
<div id="validatetext" style="width:500px; "></div>
</td></tr>


</table>

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