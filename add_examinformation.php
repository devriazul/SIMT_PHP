<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manageexam.php' AND userid='$_SESSION[userid]'";
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
<script type="text/javascript" src="jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#searchid").autocomplete("search_examinformation.php", {
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

<script type="text/javascript">
$(document).ready(function() {
    var mytextbox = document.getElementById('examname');
    var mydropdown = document.getElementById('examtype');

    mydropdown.onchange = function(){
          mytextbox.value = this.value; //to appened
         //mytextbox.innerHTML = this.value;
    }
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
/*
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
*/
		 
</script>

           <script language="javascript">
		   $(document).ready(function(){
		     $('#semester').change(function(){
				/*var deptid=$('#deptid').val();
				var semester=$('#semester').val();
				var s=$('#session').val();
				var y=$('#year').val();
				alert("deptid");
				$.get('show_course.php?deptid='+deptid +'&semester='+semester+'&s='+s'+'&y='+y',function(r){
				  $('#Result').html(r);
				});*/
				var deptid=$('#deptid').val();
				var semester=$('#semester').val();
				var s=$('#session').val();
				var y=$('#year').val();
				  $.get('showalldata.php?deptid='+deptid +'&semester='+semester+'&s='+s,function(r){
				  $('#Result').html(r);
				});
				//alert("deptid");

			 });
		   });
		   
		   </script>



<script type="text/javascript" src="datepickercontrol.js"></script>
  <script language="JavaScript">
  if (navigator.platform.toString().toLowerCase().indexOf("linux") != -1){
	 	document.write('<link type="text/css" rel="stylesheet" href="datepickercontrol_lnx.css">');
	 }
	 else{
	 	document.write('<link type="text/css" rel="stylesheet" href="datepickercontrol.css">');
	 }

	$(document).ready(function() {
    	$("#examtype").change(function() {
        	return $(this).val() == $("#exammarksper").val();
    	}).attr('selected', true);

    	$("#examtype").live("change", function() {
	        $("#exammarksper").val($(this).find("option:selected").attr("value"));
    	});
	});

</script>

<script src="examinformation.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>
<script language="javascript" src="show_course.js"></script>

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
		<form name="MyForm" autocomplete="off" action="add_examinformation.php" method="post" onsubmit="xmlhttpPost('ins_examinformation.php', 'MyForm', 'MyResult', '<img src=\'loader.gif\'>'); return false;">
          <div align="center"><br />
            <table width="90%" border="0" align="center" cellpadding="4" cellspacing="0" id="stdtbl">

            <tr>
              <td height="36" colspan="2" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">ADD EXAMINATION ENTRY (<span class="stars">*</span>Mandatory Field) </td>
            </tr>
            <tr>
              <td height="36" colspan="2" class="style2" style="padding:3px; "><table width="100%"  border="0" cellspacing="0" cellpadding="2" id="stdtbl">
                <tr>
                  <td>Department Name :<span class="stars">*</span></td>
                  <td><select name="deptid" id="deptid"  onkeypress="return handleEnter(this, event)">
                    <option>Select Department</option>
                    <?php $hq=$myDb->select("select id,name from tbl_department Where storedstatus<>'D'");
				   while($hrow=$myDb->get_row($hq,'MYSQL_ASSOC')){
				   ?>
                    <option value="<?php echo $hrow['id']; ?>"><?php echo $hrow['name']; ?></option>
                    <?php } ?>
                  </select></td>
                  <td>Session :<span class="stars">*</span></td>
                  <td><select name="session" class="style4" id="session"  style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF"  onkeypress="return handleEnter(this, event)" onchange="showSelected();" >
                    <option value="" selected="selected">Select Session</option>
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
                  </select></td>
                </tr>
                <tr>
                  <td>Year :<span class="stars">*</span></td>
                  <td><input name="year" type="text" id="year" size="15" style="font-family: Verdana; font-size: 8pt;padding:3px; border: 1px solid #3399FF" value="<?php echo date("Y"); ?>" onkeypress="return handleEnter(this, event)" /></td>
                  <td>Semester Name :<span class="stars">*</span></td>
                  <td><select name="semester" id="semester" style="font-family: Verdana; font-size: 8pt;padding:3px; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                    <option value="-1" selected="selected">Select Semester</option>
                    <?php $std="SELECT id,name,description FROM tbl_semester WHERE storedstatus<>'D' order by id asc";
			      $stdq=$myDb->select($std);
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
				  ?>
                    <option value="<?php echo $stdr['id']; ?>"><?php echo $stdr['name']; ?></option>
                    <?php } ?>
                  </select></td>
                </tr>
              </table></td>
              </tr>
            <tr bgcolor="#E6F2FF">
              <td height="20" colspan="2" class="style2"><div id="Result" align="center"></div> </td>
              </tr>
            <tr>
              <td colspan="2"><div align="center">
                <table width="80%"  border="0" cellspacing="0" cellpadding="2" id="stdtbl">
                  <tr>
                    <td width="11%">&nbsp;</td>
                    <td width="36%"><span class="style2">Examination Type :<span class="stars">*</span></span></td>
                    <td width="43%"><select name="examtype" class="style4" id="examtype"  style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"  >
                      <option value="">Select Examinition Type</option>
                      <option value="Theory Final Exam">Theory Final Exam</option>
                      <!--option value="Practical Final Exam">Practical Final Exam</option-->
                      <option value="Class Test">Class Test</option>
                      <option value="Quiz Test">Quiz Test</option>
					  <option value="Midterm">Mid-term</option>
					  <option value="Assignment">Assignment</option>
                      <option value="Job/Experiment">Job/Experiment</option>
                      <option value="Job/Experiment Final">Job/Experiment Final</option>
                      <option value="Home Work">Home Work</option>
                      <option value="Job/Experiment Report">Job/Experiment Report</option>
                      <option value="Job/Experiment Report Final">Job/Experiment Report Final</option>
                      <option value="Job/Experiment Viva">Job/Experiment Viva</option>
                      <option value="Job/Experiment Viva Final">Job/Experiment Viva Final</option>
                      <option value="Behavior">Behavior</option>
                    </select></td>
                    <td width="10%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><span class="style2">Examination Name :<span class="stars">*</span></span></td>
                    <td><input name="examname" type="text" id="examname" size="15" style="font-family: Verdana; font-size: 8pt;padding:3px; border: 1px solid #3399FF"  onkeypress="return handleEnter(this, event)" /></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><span class="style2">Examination Marks (%) :<span class="stars">*</span></span></td>
                    <td><input name="exammarksper" type="text" id="exammarksper" size="15" style="font-family: Verdana; font-size: 8pt;padding:3px; border: 1px solid #3399FF"  onkeypress="return handleEnter(this, event)" /></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><span class="style2">Examination Deadline :<span class="stars">*</span></span></td>
                    <td><input name="dline" type="text" style="font-family: Verdana; font-size: 8pt;padding:3px; border: 1px solid #3399FF" id="DPC_dline_YYYY-MM-DD" onkeypress="return handleEnter(this, event)" value="<?php echo date("Y-m-d"); ?>" /></td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
                <span class="style2"></span></div></td>
              </tr>
            <tr>
              <td width="31%">&nbsp;</td>
              <td width="69%">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" value="Submit" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"> <input type="reset" name="Submit" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/></td>
            </tr>
          </table>          
          </div>

            </form>
          <br />
<div id="MyResult" align="center"></div>  		
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