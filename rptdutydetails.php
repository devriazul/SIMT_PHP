<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='rptdutydetails.php' AND userid='$_SESSION[userid]'";
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

-->
</style>
<script language="javascript" src="jquery-1.4.2.js"></script>
<script type="text/javascript" src="jquery.js"></script>




<script language="javascript">
 $(document).ready(function(){
     	   $('#efname').keyup(function(){
	      var p=$('#efname').val();
	      $.get('pick_staff.php?p='+p,function(rec){
		  
		    $('#showpick').show();
		    $('#showpick').html(rec);
		  });
		  $('#showpick').fadeIn('slow');
		  $('#showpick').html("<img src='bigLoader.gif' />");

	   });

	   
	    $('#efname').keypress(function(e){
			   if(e.which==13){
			      $('#selectmenu').focus();
			   }	  
			 
		}); 



  });

</script>

<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />





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

	function checksalarydata()
	{

		if(document.getElementById("efid").value==''){
		alert('EmployeeID can not left empty');
		 document.getElementById("efname").focus();
	     return false;
		 
	    }


	}    

 
</script>





<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>


<style type="text/css">
<!--
.style17 {font-size: 18px}
.style19 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
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
          
          <p></p>
          <p>&nbsp;</p></td>
        <td width="79%" valign="top">
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></font></p>
   		<form name="MyForm" id="frm" action="reportemployeeduty.php" method="post"  target="_blank" >
          <div align="center">            <table width="99%" border="0" align="center" cellpadding="0" cellspacing="3" id="stdtbl">

            <tr>
              <td height="36" colspan="4" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">Individual Employee/ Faculty wise Attendance Report</td>
              </tr>
            <tr>
              <td width="26%" height="20" class="style2">Employee/Faculty Name :<span class="stars">*</span> </td>
              <td width="27%" height="20"><input name="efname" type="text" id="efname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td width="20%"><span class="style2">Employee ID  :<span class="stars">*</span></span></td>
              <td width="27%"><input name="efid" type="text" id="efid"  style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" readonly="true" />
              </td>
            </tr>
            <tr>
              <td><span class="style2">Search From  :</span></td>
              <td><input type="date" id="fromdate" name="fromdate" style="width:140px" value="<?php echo date('Y-m-d');?>" onkeypress="return handleEnter(this, event)" /></td>
              <td><span class="style2">To :</span></td>
              <td><input type="date" id="todate" name="todate" style="width:140px" value="<?php echo date('Y-m-d');?>" onkeypress="return handleEnter(this, event)"/></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" value="Preview" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"> </td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>          
          </div>

            </form>
          <br />
          		<div id="MyResult" align="center"></div>  		          
           <div id="showpick" style=" position:absolute; width:400px; height:500px; left:700px; float:right; height:auto;top:286px;"></div>
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