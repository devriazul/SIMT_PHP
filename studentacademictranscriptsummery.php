<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='studentacademictranscript.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
	
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
 
 function checkValidity(){

     if(document.getElementById("deptid").text=="Select Department"){
         alert('Please select Department.');
	     document.getElementById("deptid").focus();
	     return false;
     }
     if(document.getElementById("session").text=="Select Session"){
         alert('Please select session.');
	     document.getElementById("session").focus();
	     return false;
     }
     if(document.getElementById("semester").value=="-1"){
         alert('Please select semester.');
	     document.getElementById("Select Semester").focus();
	     return false;
     }
     if(document.getElementById("stdid").value==""){
         alert('Please type/select student ID.');
	     document.getElementById("stdid").focus();
	     return false;
     }
     if(document.getElementById("heldmonths").value=="-1"){
         alert('Please select examination month.');
	     document.getElementById("heldmonths").focus();
	     return false;
     }
     if(document.getElementById("serialno").value==""){
         alert('Please type Serial No.');
	     document.getElementById("serialno").focus();
	     return false;
     }
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
<script language="javascript">
 $(document).ready(function(){
   $('#sbt').click(function(){
	var courseid=$('#courseid').val();
    var arr=$('#MyForm').serializeArray();	 
	$.post('studentmarksidwise_search.php?courseid='+courseid,arr,function(result){
		 $('#MyResult').hide().html(result).fadeIn('slow');
	 });
	 //$("#MyResult").html("<img src='bigLoader.gif' />");
   });
 });
</script>
<script language="javascript" src="jquery-1.4.2.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>

<script type="text/javascript" src="jquery.js"></script>
<script language="javascript">
$(document).ready(function(){
     	   $('#stdbr').keyup(function(){
	      var p=$('#stdbr').val();
	      $.get('pick_satstdbr.php?p='+p,function(rec){
		  
		    $('#showpick').show();
		    $('#showpick').html(rec);
		  });
		  $('#showpick').fadeIn('slow');
		  $('#showpick').html("<img src='bigLoader.gif' />");

	   });



	   
	    $('#stdbr').keypress(function(e){
			   if(e.which==13){
			      $('#selectmenu').focus();
			   }	  
			 
		}); 
		
  });

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
		   <label>Student Academic Transcript</label>
(ID Wise)	Report	   
<div class="input">
		     <label></label>
		     <label></label>
			 <label></label>
			 <label style="float:right"></label>
		   </div>
		</div>
		</div>
	
<form name="MyForm" action="rptstudentacademictranscriptsummery.php" id="MyForm" method="post" enctype="multipart/form-data"   onsubmit="Javascript:return checkValidity();"  target="_blank" >           
	
	<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" id="stdtbl">
           <tr>
             <td width="20%" class="style11"><div align="left">Department :</div></td>
             <td width="28%"><select name="deptid" id="deptid" onchange="show(this.value);" onkeypress="return handleEnter(this, event)">
               <option>Select Department</option>
               <?php  $y=date("Y");
					$vsd="SELECT d.id as did, d.name AS DepartmentName FROM tbl_department d WHERE storedstatus<>'D' ";
  					$rd=$myDb->select($vsd);
				   while($hrow=$myDb->get_row($rd,'MYSQL_ASSOC')){
					
				   ?>
               <option value="<?php echo $hrow['did']; ?>"><?php echo $hrow['DepartmentName']; ?></option>
               <?php } ?>
             </select></td>
             <td class="style11"><div align="left">Session :</div></td>
             <td colspan="2"><select name="session" class="style2" id="select" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" onchange="showSelected();">
               <option>Select Session</option>
               <?php 
					$vssn="SELECT distinct session AS SESSION  FROM tbl_stdinfo  WHERE storedstatus<>'D'";
  					$rss=$myDb->select($vssn);
				   while($srow=$myDb->get_row($rss,'MYSQL_ASSOC')){
					
				   ?>
               <option value="<?php echo $srow['SESSION']; ?>"><?php echo "20".substr_replace($srow['SESSION'],'-20',-2,-2); ?></option>
               <?php } ?>
             </select>
               <input name="year" type="text" id="year" size="15" style="font-family: Verdana; width:60px; font-size: 8pt;padding:3px; border: 1px solid #3399FF" value="<?php echo date("Y"); ?>" onkeypress="return handleEnter(this, event)" /></td>
             </tr>
           <tr>
             <td class="style11"><div align="left">Semester :</div></td>
             <td><select name="semester" id="select" style="font-family: Verdana; font-size: 8pt;padding:3px; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
               <option value="-1" selected="selected">Select Semester</option>
               <?php 
					$vsse="SELECT id as sid, name AS SemesterName FROM tbl_semester WHERE storedstatus<>'D'";
  					$rse=$myDb->select($vsse);
				  while($stdr=$myDb->get_row($rse,'MYSQL_ASSOC')){
				  ?>
               <option value="<?php echo $stdr['sid']; ?>"><?php echo $stdr['SemesterName']; ?></option>
               <?php } ?>
             </select></td>
             <td class="style11"><div align="left">Student ID :</div></td>
             <td>               <input name="stdbr" type="hidden" id="stdbr" size="15" style="font-family: Verdana;  font-size: 8pt;padding:3px; border: 1px solid #3399FF"  onkeypress="return handleEnter(this, event)" />
               <input name="stdid" type="text" id="stdid" size="15" style="font-family: Verdana;  font-size: 8pt;padding:3px; border: 1px solid #3399FF"  onkeypress="return handleEnter(this, event)" /></td>

             <td>&nbsp;</td>
           </tr>
           <tr>
             <td height="28" class="style11"><div align="left">Exam Held in Month  :</div></td>
             <td><select name="heldmonths" id="heldmonths" onkeypress="return handleEnter(this, event)">
               <option value="-1" selected="selected">Select Months</option>
			   <option value="January-February">January-February</option>
               <option value="February-March">February-March</option>
               <option value="March-April">March-April</option>
               <option value="April-May">April-May</option>
               <option value="May-June">May-June</option>
               <option value="June-July">June-July</option>
               <option value="July-August">July-August</option>
               <option value="August-September">August-September</option>
               <option value="September-October">Septemer-October</option>
               <option value="October-November">October-November</option>
               <option value="November-December">November-December</option>
               <option value="December-January">December-January</option>
             </select>
             </td>
             <td width="11%" class="style11"><div align="left"></div></td>
             <td width="24%"><input name="serialno" type="hidden" id="serialno" size="15" style="font-family: Verdana;  font-size: 8pt;padding:3px; border: 1px solid #3399FF"  onkeypress="return handleEnter(this, event)" /></td>
             <td width="17%"></td>
           </tr>
           <tr>
             <td height="9" colspan="5">&nbsp;</td>
           </tr>
           <tr>
             <td height="9" colspan="5"> 
			   <div align="center"><input type="submit"  value="Generate Report" name="B" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" /></div></td>
           </tr>		   

         </table>
</form>	
 <div id="MyResult" align="center">	
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
