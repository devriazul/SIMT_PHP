<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='depname.php' AND userid='$_SESSION[userid]'";
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
<script src="jquery-1.6.2.min.js" type="text/javascript"></script>

<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#searchid").autocomplete("search_department.php", {
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
<script language="javascript">
 $(document).ready(function() {
	$('#noofsemester').focus(function(){    
	var arr = $('#MyForm').serialize();
    var admissionfee=$("#admissionfee").val();

	   $.post('total_fee.php', arr, function(data) {
		  
			$('#onetimefee').val(data);
	   });
	}); 
  
  
  
 });

</script>
<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>
<script src="add_depname.js" type="text/javascript"></script>
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
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></font></p>
<div id="top-search-div"> 
           <div id="content">
		   <label>Add Department</label>
		   <div class="input">
		   <form method="post" autocomplete="off" action="depname1.php">
		     <label>Search Form</label>
			 <label><input type="text" id="searchid" name="searchid" placeholder="search Department"/></label>
			 <label><input type="submit" name="subs" id="submit-btn" value="Search" /></label>
			 <label><a href="add_depname.php"><input type="button" name="addbtn" id="submit-btn" value="Add New" /></a></label>
		   </form>
		   </div>
		</div>
		</div>
		<form name="MyForm" id="MyForm" autocomplete="off" action="add_depname.php" method="post" onsubmit="xmlhttpPost('ins_depname.php', 'MyForm', 'MyResult', '<img src=\'loader.gif\'>'); return false;">
          <div align="center"><br />
          <table width="750" border="0" align="center" cellpadding="0" cellspacing="3" id="stdtbl">

            <tr>
              <td height="20" colspan="2" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">DEPARTMENT INFORMATION </td>
              <td height="20" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">&nbsp;</td>
              <td height="20" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><span class="stars">*</span>(Mandatory Field) </td>
            </tr>
            <tr>
              <td width="21%" height="20" class="style2">Code:<span class="stars">*</span> </td>
              <td height="20"><input name="code" placeholder="Department Code" type="text" id="code" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td height="20" colspan="2"><span class="style2">Name:<span class="stars">*</span></span>                <input name="name" type="text" id="name" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" placeholder="Department Name" onkeypress="return handleEnter(this, event)" size="50" /></td>
              </tr>
            <tr>
              <td height="20" class="style2">Admission Fee :<span class="stars">*</span></td>
              <td width="23%" height="20"><input name="admissionfee" type="text" id="admissionfee" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td width="23%"><span class="style2">Lab Fee :</span></td>
              <td width="33%"><input name="labfee" type="text" id="labfee" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            
            <tr>
              <td height="20" class="style2">Library Fee :<span class="stars">*</span></td>
              <td height="20"><input name="libraryfee" type="text" id="libraryfee" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29"/></td>
              <td height="20"><span class="style2">Id Card Fee :<span class="stars">*</span></span></td>
              <td height="20"><input name="idcardfee" type="text" id="idcardfee" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29"/></td>
            </tr>
            <tr>
              <td height="20" class="style2">Registration Fee :<span class="stars">*</span></td>
              <td height="20"><input name="regifee" type="text" id="regifee" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29"/></td>
              <td height="20"><span class="style2">One Time Fee (Total) :</span></td>
              <td height="20"><input name="onetimefee" type="text" id="onetimefee" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" readonly="true" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">No. of Semester :<span class="stars">*</span></td>
              <td height="20"><input name="noofsemester" type="text" id="noofsemester" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td height="20"><span class="style2">Semester Fee(/Semester):<span class="stars">*</span></span></td>
              <td height="20"><input name="semesterfee" type="text" id="semesterfee" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
			<tr>
              <td height="20" class="style2">Admission Form :<span class="stars">*</span></td>
              <td height="20"><input name="admform" type="text" id="admform" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td height="20"><span class="style2">Receive Book :<span class="stars">*</span></span></td>
              <td height="20"><input name="rcvbook" type="text" id="rcvbook" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>

            <tr>
              <td height="20" class="style2">No. of Months :<span class="stars">*</span></td>
              <td height="20"><input name="noofmonths" type="text" id="noofmonths" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" placeholder="Total number of months for this degree"/></td>
              <td height="20"><span class="style2">Tuition Fee (/Months) :<span class="stars">*</span></span></td>
              <td height="20"><input name="tuitionfee" type="text" id="tuitionfee" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Credit :<span class="stars">*</span></td>
              <td height="20" colspan="3"><input name="credit" type="text" id="credit" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" placeholder="Total Number of credits for this degree"  /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Description:</td>
              <td height="20" colspan="3"><textarea name="description" cols="85" rows="5" id="description" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"></textarea></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="3"><input type="submit" value="Submit" name="B1" id="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"> <input type="reset" name="Submit2" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/></td>
            </tr>
          </table>          
          </div>

            </form>
          <br />
          		<div id="MyResult" align="center"></div>          
          <p align="center">&nbsp;</p>
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
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}