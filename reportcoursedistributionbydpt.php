<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
    if(isset($_GET['msg'])){ $msg=$_GET['msg']; }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<style type="text/css">
<!--
@import url("main.css");
.style15 {
	font-size: 12px; font-weight:bold;
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

 <link rel="stylesheet" href="libs/style.css"/>
 <script src='libs/jquery.js' type="text/javascript"></script>
 
  <script language="JavaScript" type="text/javascript">
<!--

/*function copy<?php //echo $count; ?>() {
   var sel = document.getElementById("session<?php //echo $count; ?>");
   var text = sel.options[sel.selectedIndex].text;
   document.getElementById("year<?php //echo $count; ?>").value=text;
   //var out = document.getElementById("output");
   //out.value += text+"\n";
}*/




//-->
</script>
<script language="javascript">
 /*$(document).ready(function(){
   $('#sbt').click(function(){
	var courseid=$('#hostel').val();
    var arr=$('#MyForm').serializeArray();	 
	$.post('rpthosteldetails_search.php?hostelname='+courseid,arr,function(result){
		 $('#MyResult').hide().html(result).fadeIn('slow');
	 });
	 //$("#MyResult").html("<img src='bigLoader.gif' />");
   });
 });*/
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
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['t'])==1){ if(isset($msg)){ echo "<span style='color:#00CC00; font-weight:bold;'>$msg</span>";} ?><?php } if(isset($_GET['t'])==0){ if(isset($msg)){ echo "<span style='color:#FF9900; font-weight:bold;'>$msg</span>"; } } ?></font></p>
 <div class="search-background1">
			<label><img src="load.gif" alt="" /></label>
	</div>
	<div id="top-search-div"> 
           <div id="content">
		   <label>Course Distribution Report</label>
		   <div class="input">
		     <label></label>
		     <label></label>
			 <label></label>
			 <label style="float:right"></label>
		   </div>
		</div>
		</div>
	
	
	<table width="98%" border="0" align="center" cellpadding="3" cellspacing="0" id="stdtbl">
					<form name="MyForm" id="MyForm" action="rptcoursedistributionbydpt.php" autocomplete="off"  method="post" target="_blank" >


           <tr>
             <td width="14%" class="style11"><div align="right">Department Name  :</div></td>
             <td width="15%">
                 <div align="left">
                   <label>
                   <select name="department" id="department" style="font-family: Verdana; font-size: 8pt;padding:3px; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                     <option value="-1" selected="selected">Select Department</option>
                     <?php 
			  	$cat=mysql_query("select id, name from tbl_department") or die(mysql_error());
				while($cfetch=mysql_fetch_array($cat)){
	 			?>
                     <option value="<?php echo $cfetch['id']; ?>"><?php echo $cfetch['name']; ?></option>
                     <?php } ?>
                   </select>
                   </label>
                 </div></td>
             </tr>
           <tr>
             <td class="style11"><div align="right">Session : </div></td>
             <td><select name="session" class="style2" id="session" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" onchange="showSelected();">
               <option>Select Session</option>
               <?php 
					$vssn="SELECT distinct  session AS SESSION  FROM tbl_stdinfo ";
  					$rss=$myDb->select($vssn);
				   while($srow=$myDb->get_row($rss,'MYSQL_ASSOC')){
					
				   ?>
               <option value="<?php echo $srow['SESSION']; ?>"><?php echo $srow['SESSION'];//echo "20".substr_replace($srow['SESSION'],'-20',-2,-2); ?></option>
               <?php } ?>
             </select></td>
             </tr>
           <tr>
             <td class="style15">&nbsp;</td>
             <td>&nbsp;</td>
             </tr>
           <tr>
             <td class="style11">&nbsp;</td>
             <td><input type="submit"  value="Generate Report" name="B" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB;" /></td>
             </tr>
           <tr>
             <td colspan="5"> 
			 </td>
           </tr>		   </form>
         </table>
	
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
  header("Location:index.php");
}
}