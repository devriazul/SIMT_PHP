<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='rptattendance.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>

<style type="text/css">
<!--
@import url("main.css");
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}

-->
</style>


<script type="text/javascript" src="jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>

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





<style type="text/css">
<!--
.style17 {color: #000033}
.style18 {color: #FFFFFF}
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
      <tr bgcolor="#0C6ED1">
        <td height="28" colspan="2"><div align="center" class="style1"><?php include("company.php"); ?></div></td>
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
<p align="center" id="msgerr" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></font></p>
<div id="top-search-div"> 
           <div id="content">
		   <label> Attendance Report </label>
		   <div class="input">
<!--		<form name="MyForm" id="MyForm" action="reportattendance.php"  autocomplete="off"  method="post" target="_blank" > -->

		<form name="MyForm" id="MyForm" action="reportattendancehtml.php"  autocomplete="off"  method="post" target="_blank" >
		     <label></label>
		     <label></label>
             <label>             </label>
             <table width="100%" border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td>Search Form : </td>
                 <td><input type="date" id="fromdate" name="fromdate" style="width:125px" value="<?php echo date('Y-m-d');?>" /></td>
                 <td><input type="date" id="todate" name="todate" style="width:125px" value="<?php echo date('Y-m-d');?>"/>                   </td>
                 <td><select name="emptype" id="select" onkeypress="return handleEnter(this, event)" style="width:120px; ">
               <option value="Select Year" selected="selected">Select Type</option>
               <option value="E">Eemployee</option>
               <option value="F">Faculty</option>
             </select></td>

                 <td><input type="submit"  value="Generate Report" name="B" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB;" /></td>
               </tr>
             </table>
             <label>             </label>
             <label></label>
             <label></label>
			 <label></label>
		   </form>
		   </div>
		   
		</div>
		</div><br />
		

 
		  </Td></tr></table>
	</div>		       
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