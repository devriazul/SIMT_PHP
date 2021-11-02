<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
	if($_SESSION['userid'])
	{
		$chka="SELECT*FROM  tbl_accdtl WHERE flname='view_chart_ofacc.php' AND userid='$_SESSION[userid]'";
  		$caq=$myDb->select($chka);
  		$car=$myDb->get_row($caq,'MYSQL_ASSOC');
        if($car['ins']=="y"){
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<title><?php include("title.php");?></title>
	
		

	    <style type="text/css">
<!--
@import url("main.css");
.style1 {font-family: Calibri; font-size:12px;}
.style3 {font-family: Calibri; font-size: 14px; font-weight: bold; }
-->
        </style>
		
			<link href="css/core.css" rel="stylesheet" type="text/css" />
<style type="text/css">
 #chart{
   position:relative;
   left:50px;
 }
 #chart td{
     padding:5px;
  }	 
 #chart td#head{
    font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:13px;
  } 
 #chart input[type=text]{
    width:250px;
	height:15px;
	padding:5px; 
 }	
 .small{
    width:50px;
	height:15px;
	padding:5px; 
 }	
  #chart input[type=submit]{
    padding:5px;
	border: 1px solid #CCCCFF;
	height:30px;
	width:70px;
 }	
 #chart #label{
    font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:14px;
 }	 

.style1 {color: #FFFFFF}
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
}
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

<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>

<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script language="javascript" type="text/javascript">
 $(document).ready(function(){
	$('#accname_g').blur('live',function(){
	   var accname_g=$("#accname_g").val();
	   var  acc_parent=$('#acc_parent').val();
	   $.get('acc_group_id.php?accname='+accname_g+'&pid='+acc_parent,function(rec1){
	     $('#acc_group').val(parseInt(rec1));
	   });
	});
 
	$('#accname_p').keypress(function(){
	  var accname_p=$("#accname_p").val();
	  //alert(accname_p);
	   $.get('acc_parent_id.php?accname='+accname_p,function(rec){
	     $('#acc_parent').val($.trim(rec));
	   });
	});
	
	$('#accname_p').keyup(function(){
	  var accname_p=$("#accname_p").val();
	  //alert(accname_p);
	   $.get('acc_parent_id.php?accname='+accname_p,function(rec){
	     $('#acc_parent').val($.trim(rec));
	   });
	});
	
	$('#accname_p').blur(function(){
	  var accname_p=$("#accname_p").val();
	  //alert(accname_p);
	   $.get('acc_parent_id.php?accname='+accname_p,function(rec){
	     $('#acc_parent').val($.trime(rec));
	   });
	});
  });

</script>


<script type="text/javascript">
$(document).ready(function() {
    
	$("#accname_p").autocomplete("acc_parenthead.php", {
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
<script language="javascript" type="text/javascript">
 $(document).ready(function(){
   	$('#accname_g').keypress('live',function(){
		 var  acc_parent=$('#acc_parent').val();
		$("#accname_g").autocomplete("acc_grouphead.php?pid="+acc_parent, {
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
	 
	 

 });
 
</script>
<script language="javascript" type="text/javascript">
 $(document).ready(function(){
   	//$('#accname_bottom').keyup('live',function(){
		$("#accname_bottom").autocomplete("acc_bottom_head_specific.php", {
			width: 260,
			matchContains: true,
			//mustMatch: true,
			//minChars: 0,
			//multiple: true,
			//highlight: false,
			//multipleSeparator: ",",
			selectFirst: false
		});
	 //});	

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
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php"); ?>
                   <br />
          
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        <td width="79%" valign="top">
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){echo $_GET['msg'];}?></font></p>
<form id="chfrm" method="post">
<table width="500" border="0" cellspacing="0" cellpadding="0" id="chart">
  <tr>
    <td height="30" colspan="3" bgcolor="#0099CC" id="head"><span class="style1">CHART OF ACCOUNTS ENTRY </span></td>
  </tr>
  <tr>
    <td><span class="style2">Primary Head </span></td>
    <td>:</td>
    <td><label id="label">
      <input type="text" name="acc_parent" id="acc_parent" style="width:50px; height:15px; padding:5px;" disabled="disabled" />
	  <input type="text" name="accname_p" id="accname_p" />
    </label></td>
  </tr>
  <tr>
    <td class="style2">Group Head </td>
    <td>:</td>
    <td><label id="label">
      <input type="text" name="acc_group" id="acc_group" style="width:50px; height:15px; padding:5px;" disabled="disabled" />
	  
	  <input type="text" name="accname_g" id="accname_g" />
    </label></td>
  </tr>
  <tr>
    <td class="style2">Bottom Head </td>
    <td>:</td>
    <td><label id="label">
      <input type="text" name="accname_bottom" id="accname_bottom" />
    </label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><label id="label">
      <input type="submit" name="Submit" value="Submit" />
    </label></td>
  </tr>
</table>
</form>



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