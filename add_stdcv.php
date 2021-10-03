<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managestdcv.php' AND userid='$_SESSION[userid]'";
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
     	   $('#stdname').keyup(function(){
	      var p=$('#stdname').val();
	      $.get('pick_student.php?p='+p,function(rec){
		  
		    $('#showpick').show();
		    $('#showpick').html(rec);
		  });
		  $('#showpick').fadeIn('slow');
		  $('#showpick').html("<img src='bigLoader.gif' />");

	   });

	   
	    $('#stdname').keypress(function(e){
			   if(e.which==13){
			      $('#selectmenu').focus();
			   }	  
			 
		}); 

		//--load Father Name----------
		$('#stdid').blur(function(){
			var stdid=$('#stdid').val(); 
			var arr=$('#MyForm').serializeArray();
			//---------------load Father Name--------------
			$.post('loadstdinfo.php?stdid='+stdid+'&a=1',arr,function(rec){
                    $('#fname').val($.trim(rec));
			});
			//---------------load Mother Name--------------
			$.post('loadstdinfo.php?stdid='+stdid+'&b=1',arr,function(rec){
                    $('#mname').val($.trim(rec));
			});
			//---------------load DOB--------------
			$.post('loadstdinfo.php?stdid='+stdid+'&c=1',arr,function(rec){
                    $('#dob').val($.trim(rec));
			});
			//---------------load Department Name--------------
			$.post('loadstdinfo.php?stdid='+stdid+'&d=1',arr,function(rec){
                    $('#department').val($.trim(rec));
			});
			//---------------load Session--------------
			$.post('loadstdinfo.php?stdid='+stdid+'&e=1',arr,function(rec){
                    $('#session').val($.trim(rec));
			});
			//---------------load Present Address--------------
			$.post('loadstdinfo.php?stdid='+stdid+'&f=1',arr,function(rec){
                    $('#presentaddress').val($.trim(rec));
			});
			//---------------load Permanent Address--------------
			$.post('loadstdinfo.php?stdid='+stdid+'&g=1',arr,function(rec){
                    $('#permanentaddress').val($.trim(rec));
			});
			//---------------load Phone No--------------
			$.post('loadstdinfo.php?stdid='+stdid+'&h=1',arr,function(rec){
                    $('#phoneno').val($.trim(rec));
			});
			//---------------load Image--------------
			$.post('loadstdinfo.php?stdid='+stdid+'&i=1',arr,function(rec){
                    $('#img').val($.trim(rec));
			});

		 });

  });

</script>

<script type="text/javascript" src="nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
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

	function checkstddata()
	{

		if(document.getElementById("stdid").value==''){
		alert('Student ID can not left empty');
		 document.getElementById("stdid").focus();
	     return false;
		 
	    }

		
		if(document.getElementById("cgpa").value=='0'){
		alert('CGPA can not be left empty');
		 document.getElementById("cgpa").focus();
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
   		<form name="MyForm" id="frm" action="ins_stdcv.php" method="post" enctype="multipart/form-data" onsubmit="Javascript:return checkstddata();" target="_blank"><div align="center">
   		  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="3" id="stdtbl">

            <tr>
              <td height="36" colspan="4" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">ADD STUDENT CURRICILUM VITAE (<span class="stars">*</span>Mandatory Field) </span></td>
              </tr>
            <tr bgcolor="#F4F4FF">
              <td height="26" colspan="4"  style="padding:3px; border-bottom:1px solid #CCCCCC;"><div align="center">General Information </div></td>
              </tr>
            <tr>
              <td width="26%" height="20" class="style2">Student Name :<span class="stars">*</span> </td>
              <td height="20" colspan="2" valign="top"><input name="stdname" type="text" id="stdname" style="font-family: Verdana; font-size: 8pt;  font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" />                <span class="style2"> </span>
                <div id="shw"></div></td>
              <td width="27%">&nbsp;                </td>
            </tr>
            <tr>
              <td height="20" class="style2">Student ID :<span class="stars">*</span></td>
              <td width="27%" height="20"><input name="stdid" type="text" id="stdid"  style="font-family: Verdana; font-size: 8pt; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td width="20%"><div align="right"><span class="style2"><span class="stars">*</span>DOB :</span></div></td>
              <td><input name="dob" type="text" id="dob" style="font-family: Verdana; font-size: 8pt; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Father's Name :<span class="stars">*</span></td>
              <td height="20"><input name="fname" type="text" id="fname" style="font-family: Verdana; font-size: 8pt; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29"  /></td>
              <td><div align="right"><span class="style2"><span class="stars">*</span>Mother's Name  :</span></div></td>
              <td><input name="mname" type="text" id="mname" style="font-family: Verdana; font-size: 8pt; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Present Address :<span class="stars">*</span></td>
              <td height="20" colspan="3"><input name="presentaddress" type="text" id="presentaddress" style="font-family: Verdana; font-size: 8pt; font-weight:bold; border: 1px solid #3399FF; width:97%" onkeypress="return handleEnter(this, event)" size="29" /></td>
              </tr>
            <tr>
              <td height="20" class="style2">Permanent Address :<span class="stars">*</span></td>
              <td height="20" colspan="3"><input name="permanentaddress" type="text" id="permanentaddress" style="font-family: Verdana; font-size: 8pt; font-weight:bold; border: 1px solid #3399FF; width:97%" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr bgcolor="#F4F4FF" >
              <td height="27" colspan="4"  style="padding:3px; border-bottom:1px solid #CCCCCC;"><div align="center" >Academic  Information</div></td>
              </tr>
            <tr>
              <td height="20" class="style2">Department  :<span class="stars">*</span> </td>
              <td height="20"><input name="department" type="text" id="department" style="font-family: Verdana; font-size: 8pt; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td><div align="right"><span class="style2"><span class="stars">*</span>Session : </span></div></td>
              <td><input name="session" type="text" id="session" style="font-family: Verdana; font-size: 8pt; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Passing Year:<span class="stars">*</span> </td>
              <td height="20"><input name="syear" type="text" id="syear" style="font-family: Verdana; width:60px; height:18px; font-size: 8pt; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo date("Y");?>" /></td>
              <td><div align="right"><span class="style2"><span class="stars">*</span>CGPA :</span></div></td>
              <td><input name="cgpa" type="text" id="cgpa" style="font-family: Verdana; font-size: 8pt; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Higher Education (If any):</td>
              <td height="20"><input name="higheredu" type="text" id="higheredu" style="font-family: Verdana;  font-size: 8pt; font-weight:bold; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td><div align="right"><span class="style2">Organization Name  :</span></div></td>
              <td><input name="orgname" type="text" id="orgname" style="font-family: Verdana;  font-size: 8pt; font-weight:bold; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr bgcolor="#F4F4FF" >
              <td height="27" colspan="4"  style="padding:3px; border-bottom:1px solid #CCCCCC;"><div align="center" >Professional  Information</div></td>
              </tr>
            <tr>
            <tr>
              <td height="20" class="style2">Career Objectives :</td>
              <td height="20" colspan="3"><textarea name="co" id="co" style="font-family: Verdana;  font-size: 8pt; font-weight:bold; width:98%; font-weight:bold; border: 1px solid #3399FF; " onkeypress="return handleEnter(this, event)">A challenging position in a dynamic and progressive organization where my creative talents and innovative capabilities along with my education, experience and personal qualities can be efficiently utilizes.</textarea></td>
            </tr>
            <tr>
              <td height="20" class="style2">Training Summary  :</td>
              <td height="20" colspan="3"><textarea name="ts" id="ts" style="font-family: Verdana; font-size: 8pt; font-weight:bold; width:98%; height:50px; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"></textarea></td>
            </tr>
            <tr>
              <td height="20" class="style2">Computer Skill :</td>
              <td height="20" colspan="3"><textarea name="cs" id="cs" style="font-family: Verdana; font-size: 8pt; font-weight:bold; width:98%; height:50px; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">

<ul>
    <li>
        Adobe Photoshop
    </li>
    <li>
        Cisco
    </li>
    <li>
        CSS
    </li>
    <li>
        MS Word
    </li>
    <li>
        PHP
    </li>
    <li>
        Windows Server 2000/2003 Server
    </li>
</ul>

</textarea></td>
            </tr>
            <tr>
              <td height="20" class="style2">Language Skill :</td>
              <td height="20" colspan="3"><textarea name="ls" id="ls" style="font-family: Verdana; font-size: 8pt; font-weight:bold; width:98%; height:50px; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">

<table border="1" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <td width="160" valign="top">
                <p align="center">
                    <strong>Language</strong>
                </p>
            </td>
            <td width="160" valign="top">
                <p align="center">
                    <strong>Reading</strong>
                </p>
            </td>
            <td width="160" valign="top">
                <p align="center">
                    <strong>Writing</strong>
                </p>
            </td>
            <td width="160" valign="top">
                <p align="center">
                    <strong>Speaking</strong>
                </p>
            </td>
        </tr>
        <tr>
            <td width="160" valign="top">
                <p align="center">
                    Bengali
                </p>
            </td>
            <td width="160" valign="top">
                <p align="center">
                    High
                </p>
            </td>
            <td width="160" valign="top">
                <p align="center">
                    High
                </p>
            </td>
            <td width="160" valign="top">
                <p align="center">
                    High
                </p>
            </td>
        </tr>
        <tr>
            <td width="160" valign="top">
                <p align="center">
                    English
                </p>
            </td>
            <td width="160" valign="top">
                <p align="center">
                    High
                </p>
            </td>
            <td width="160" valign="top">
                <p align="center">
                    Medium
                </p>
            </td>
            <td width="160" valign="top">
                <p align="center">
                    Medium
                </p>
            </td>
        </tr>
    </tbody>
</table>






</textarea></td>
            </tr>
            <tr>
              <td height="20" class="style2">WorkingOrganizationName&amp;Add:</td>
              <td height="20" colspan="3"><textarea name="wonameadd" id="wonameadd" style="font-family: Verdana; font-size: 8pt; font-weight:bold; width:98%; height:50px; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"></textarea></td>
              </tr>
            <tr>
              <td><span class="style2">Designation :</span></td>
              <td><input name="designation" type="text" id="designation2" style="font-family: Verdana;  font-size: 10pt; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td><div align="right"><span class="style2">Phone No  :</span></div></td>
              <td><input name="phoneno" type="text" id="phoneno" style="font-family: Verdana;  font-size: 10pt; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td><span class="style2">E-mail Address:</span></td>
              <td><input name="email" type="text" id="email" style="font-family: Verdana;  font-size: 10pt; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td>&nbsp;</td>
              <td><input name="img" type="hidden" id="img" style="font-family: Verdana;  font-size: 10pt; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td><span class="style2">Reference 1:</span></td>
              <td><textarea name="ref1" cols="29" id="ref1" style="font-family: Verdana; width:210px;  font-size: 10pt; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"></textarea></td>
              <td><div align="right"><span class="style2">Reference 2:</span></div></td>
              <td><textarea name="ref2" cols="29" id="ref2" style="font-family: Verdana; width:210px;  font-size: 10pt; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"></textarea></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" value="Save & Print" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"> </td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>          
          </div>

            </form>
          <br />
          		<div id="MyResult" align="center"></div>  		          
           <div id="showpick" style=" position:absolute; width:400px; height:500px; left:700px; float:right; height:auto;top:300px;"></div>
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