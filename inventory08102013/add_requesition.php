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
   margin:5px;
   padding-left:10px;
   font-family:Verdana, Arial, Helvetica, sans-serif;
   font-size:12px;
}
.form-table,td{
   border-bottom:1px dotted #999999;
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
	   if($('#pid').val()==""){
	     alert("Product ID can not left empty");
		 $('#pid').focus();
		 return false;
	   }
	   if($('#rqty').val()==""){
	     alert("Requesition Qty can not left empty");
		 $('#rqty').focus();
		 return false;
	   }
	   
	  
	   $.post('ins_requesition.php',arr,function(res){
	      $('#insup').html(res).hide().fadeIn('slow');
		  document.sfrm.reset();
		  $('#empid').focus();
	   }); 
	 
	 });
	  $('#price').focus(function(){
		 var qty=$('#qty').val();
		 var rate=$('#prate').val();
		 var total=qty*rate;
	     $('#price').val(total);
	   });	 
	   
	   $('#pid').keyup(function(){
	      var p=$('#pid').val();
	      $.get('pick_product.php?p='+p,function(rec){
		    $('#showpick').show();
		    $('#showpick').html(rec);
		  });	   
		  $('#showpick').fadeIn('slow');
		  $('#showpick').html("<img src='bigLoader.gif' />");

	   });

	   
	    $('#pid').keypress(function(e){
			   if(e.which==13){
			      $('#selectmenu').focus();
			   }	  
			 
		}); 
			 
		
		
	   $('#empid').keyup(function(){
	      var p=$('#empid').val();
	      $.get('pick_staff.php?p='+p,function(rec){
		  
		    $('#showpick').show();
		    $('#showpick').html(rec);
		  });
		  $('#showpick').fadeIn('slow');
		  $('#showpick').html("<img src='bigLoader.gif' />");

	   });

	   
	    $('#empid').keypress(function(e){
			   if(e.which==13){
			      $('#selectmenu').focus();
			   }	  
			 
		}); 
		

  });
  
		$(function (){ var rid=$('#expdate').val();
		
			$('#expdate').dateEntry({spinnerImage: 'img/calendar_icon.png'});
		
		});
  
</script>

<script type="text/javascript" src="jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#searchid").autocomplete("search_requisition.php", {
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
<script type="text/javascript" src="jquery.dateentry.js"></script>
<script language="javascript">
		$(function (){ var rid=$('#expdate').val();
		
			$('#expdate').dateEntry({spinnerImage: 'img/calendar_icon.png'});
		
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
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php");?><br />
		
          <p>&nbsp;</p>
          <p>&nbsp;</p></td><td valign="top">
		  
		  <div id="top-search-div"> 
           <div id="content">
		   <label>Product Requesition</label>
		   <div class="input">
		   <form method="post" autocomplete="off" action="requisition1.php">
		     <label>Search Form</label>
			 <label><input type="text" id="searchid" name="searchid" /></label>
			 <label><input type="submit" name="subs" id="submit-btn" value="Search" /></label>
			 <label><a href="add_requesition.php"><input type="button" name="addbtn" id="submit-btn" value="Add New" /></a></label>
			  
		   </form>
		   </div>
		</div>
		</div>
		<br />
<form name="sfrm" id="sfrm" method="post">
		  
		  <table width="400" border="0" cellspacing="0" cellpadding="0" class="form-table">
  <tr>
    <td colspan="3">Add Requesition </td>
  </tr>
  
  
  
    <tr>
    <td width="135">Employee ID</td>
    <td width="6">:</td>
    <td width="259"><label>
      <input type="text" name="empid" id="empid" onkeypress="return handleEnter(this, event)" /></label></td>
  </tr>
  </tr>
    <tr>
    <td width="135">Employee Name</td>
    <td width="6">:</td>
    <td width="259"><label>
      <input type="text" name="ename" id="ename" onkeypress="return handleEnter(this, event)" readonly="true" /></label></td>
  </tr>
  <tr>
    <td width="135">Product ID</td>
    <td width="6">:</td>
    <td width="259"><label>
      <input type="text" name="pid" id="pid" onkeypress="return handleEnter(this, event)" />
    </label></td>
  </tr>
  <tr>
    <td width="135">Name</td>
    <td width="6">:</td>
    <td width="259"><label>
      <input type="text" name="pname" id="pname" onkeypress="return handleEnter(this, event)" readonly="true" />
    </label></td>
  </tr>
  <tr>
    <td>Requesition Qty</td>
    <td>:</td>
    <td><label>
      <input type="text" name="rqty" id="rqty" onkeypress="return handleEnter(this, event)" >
    </label></td>
  </tr>
  <tr>
    <td>Expected Date</td>
    <td>:</td>
    <td><label>
      <input name="expdate" type="text" class="style4" id="expdate" size="30" onkeypress="return handleEnter(this, event)" />
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
           <div id="showpick" style="width:400px; height:500px; float:right; height:auto;margin-top:-240px;"></div>
	

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