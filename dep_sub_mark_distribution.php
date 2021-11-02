<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='dep_sub_mark_distribution.php' AND userid='$_SESSION[userid]'";
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
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}

-->
</style>
<script type="text/javascript" src="jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#stdid").autocomplete("search_stdid.php", {
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
 
function handleEnter12 (field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
			i = (i + 4) % field.form.elements.length;
			field.form.elements[i].focus();
			return false;
		} 
		else
		return true;
	}      
 
</script>
<script type="text/javascript" src="datepickercontrol.js"></script>
  <script language="JavaScript">
  if (navigator.platform.toString().toLowerCase().indexOf("linux") != -1){
	 	document.write('<link type="text/css" rel="stylesheet" href="datepickercontrol_lnx.css">');
	 }
	 else{
	 	document.write('<link type="text/css" rel="stylesheet" href="datepickercontrol.css">');
	 }

</script>
<script src="depsub_mark_distribution.js" type="text/javascript"></script>

<script src="dep_sub_mark_val.js" type="text/javascript">

</script>

<style type="text/css">
<!--
.style17 {font-weight: bold}
-->
</style>
  <script language="JavaScript" type="text/javascript">
<!--

/*function copy<?php //echo $count; ?>() {
   var sel = document.getElementById("session<?php //echo $count; ?>");
   var text = sel.options[sel.selectedIndex].text;
   document.getElementById("year<?php //echo $count; ?>").value=text;
   //var out = document.getElementById("output");
   //out.value += text+"\n";
}*/

function showSelected()
{
    var selObj = document.getElementById('session');
	var inVal;
	var selIndex = selObj.selectedIndex;
	inVal=selIndex;
	switch(selObj.options[selIndex].text){
	
	  case '2005-2006':
	     document.getElementById('year').value='2005';
		 break;
      case '2006-2007':
	     document.getElementById('year').value='2006';
	     break;	 
      case '2007-2008':
	     document.getElementById('year').value='2007';
	     break;	  
      case '2008-2009':
	     document.getElementById('year').value='2008';
	     break;	
      case '2009-2010':
	     document.getElementById('year').value='2009';
	     break;
      case '2010-2011':
	     document.getElementById('year').value='2010';
	     break;	  
      case '2011-2012':
	     document.getElementById('year').value='2011';
	     break;	  
      case '2012-2013':
	     document.getElementById('year').value='2012';
	     break;	  
      case '2013-2014':
	     document.getElementById('year').value='2013';
	     break;	
      case '2014-2015':
	     document.getElementById('year').value='2014';
	     break;
      case '2015-2016':
	     document.getElementById('year').value='2015';
	     break;	 
      case '2016-2017':
	     document.getElementById('year').value='2016';
	     break;	  
      case '2017-2018':
	     document.getElementById('year').value='2017';
	     break;	  
      case '2018-2019':
	     document.getElementById('year').value='2018';
	     break;	  
      case '2019-2020':
	     document.getElementById('year').value='2019';
	     break;	  
      case '2020-2021':
	     document.getElementById('year').value='2020';
	     break;	  
      case '2021-2022':
	     document.getElementById('year').value='2021';
	     break;	  
      case '2022-2023':
	     document.getElementById('year').value='2022';
	     break;	  
      case '2023-2024':
	     document.getElementById('year').value='2023';
	     break;	  
      case '2024-2025':
	     document.getElementById('year').value='2024';
	     break;	  
      
	  default:
	     document.getElementById('year').value='<?php echo date("Y"); ?>';
	}	 
}


//-->
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
		
		</p>
        <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" id="stdtbl">
           <tr>
             <td width="32%" height="30" bgcolor="#D9F0FB" style="font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:14px;	">DEPARTMENT</td>
             <td width="16%" height="30" bgcolor="#D9F0FB" style="font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:14px;	">YEAR</td>
             <td width="19%" height="30" bgcolor="#D9F0FB" style="font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:14px;	">SESSION</td>
             <td width="20%" bgcolor="#D9F0FB" style="font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:14px;	">SEMESTER</td>
             <td height="30" bgcolor="#D9F0FB" style="font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:14px;	">&nbsp;</td>
           </tr>
				<form name="MyForm" autocomplete="off" action="dep_sub_mark_distribution.php" method="post" onsubmit="xmlhttpPost('mark_dis_subjectlist.php', 'MyForm', 'MyResult', '<img src=\'loader.gif\'>'); return false;">
           <tr>
             <td><label>
               <select name="department" id="department" style="font-family: Verdana; font-size: 8pt;padding:3px; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                <option value="-1" selected="selected">Select Department</option>
                <?php 
			  	$cat=mysql_query("select id, name from tbl_department") or die(mysql_error());
				while($cfetch=mysql_fetch_array($cat)){
	 			?>
                <option value="<?php echo $cfetch['id']; ?>"><?php echo $cfetch['name']; ?></option>
                <?php } ?>
              </select>
             </label></td>
             <td><label>
               <input name="year" type="text" id="year" size="15" style="font-family: Verdana; font-size: 8pt;padding:3px; border: 1px solid #3399FF" value="<?php echo date("Y"); ?>" onkeypress="return handleEnter(this, event)" readonly="true" />
             </label></td>
             <td><label>
               <select name="session" id="session" style="font-family: Verdana; font-size: 8pt;padding:3px; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" onchange="showSelected();">
                <option value="">Select session</option>
				<option value="0506">2005-2006</option>
				<option value="0607">2006-2007</option>
				<option value="0708">2007-2008</option>
				<option value="0809">2008-2009</option>
				<option value="0910">2009-2010</option>
				<option value="1011">2010-2011</option>
				<option value="1112">2011-2012</option>
				<option value="1213">2012-2013</option>
				<option value="1314">2013-2014</option>
				<option value="1415">2014-2015</option>
				<option value="1516">2015-2016</option>
				<option value="1617">2016-2017</option>
				<option value="1718">2017-2018</option>
				<option value="1819">2018-2019</option>
				<option value="1920">2019-2020</option>
				<option value="2021">2020-2021</option>
				<option value="2122">2021-2022</option>
				<option value="2223">2022-2023</option>
				<option value="2324">2023-2024</option>
				<option value="2425">2024-2025</option>
              </select>
             </label></td>
             <td><label>
               <select name="semester" id="semester" style="font-family: Verdana; font-size: 8pt;padding:3px; border: 1px solid #3399FF">
                  <option value="-1" selected="selected">Select Department</option>
                   <?php $std="SELECT id,name,description FROM tbl_semester WHERE storedstatus<>'D' order by id asc";
			      $stdq=$myDb->select($std);
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
				  ?>
                  <option value="<?php echo $stdr['id']; ?>"><?php echo $stdr['name']; ?></option>
                <?php } ?>               </select>
             </label></td>
             <td width="13%"><label>
               <input type="submit" name="submit1"  value="Next" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB">
             </label></td>
           </tr>
           <tr>
             <td colspan="5">&nbsp;</td>
           </tr>
           <tr>
             <td colspan="5"> 
<div id="MyResult" align="center"></div>			 </td>
           </tr>		   </form>
         </table>
        <p>
</p>
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
  header("Location:login.php");
}
}  
?>