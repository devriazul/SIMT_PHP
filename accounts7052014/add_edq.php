<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='stdinfo.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  $mq="SELECT*FROM tbl_stdinfo WHERE id=(SELECT MAX(id) FROM tbl_stdinfo)";
  $mqr=$myDb->select($mq);
  $msf=$myDb->get_row($mqr,'MYSQL_ASSOC');

  
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php"); ?></title>
    <link rel="stylesheet" href="style.css" />

<link href="main.css" rel="stylesheet" type="text/css" />
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


    function getExstid() {
        var checkbox = document.getElementById("sh");
        if(checkbox.checked == true){
             document.getElementById("ex").style.display = "block";
        }else if(checkbox.checked == false) {
             document.getElementById("ex").style.display = "none";
        }
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

<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>
<script>  
    /* 
    This script is identical to the above JavaScript function. 
    */  
function add_feed()
{
	var div1 = document.createElement('div');
 
	// Get template data
	div1.innerHTML = document.getElementById('newlinktpl').innerHTML;
 
	// append to our form, so that template data
	//become part of form
	document.getElementById('newlink').appendChild(div1);
 
}
 
var ct = 0;
 
function new_link()
{
	ct++;
	var div1 = document.createElement('div');
	div1.id = ct;
 
	// link to delete extended form elements
	var delLink = '<div style="width:250px;text-align:center; font-size:13px; background-color:#666666 padding:12px; height:20px;padding:5px"><a href="javascript:delIt('+ ct +')">DELETE EDUCATIONAL QUALIFICATION</a></div>';
 
	div1.innerHTML = document.getElementById('newlinktpl').innerHTML + delLink;
 
	document.getElementById('newlink').appendChild(div1);
 
}
// function to delete the newly added set of elements
function delIt(eleId)
{
	d = document;
 
	var ele = d.getElementById(eleId);
 
	var parentEle = d.getElementById('newlink');
 
	parentEle.removeChild(ele);
 
}
</script>  
<script language="javascript">
function checkedq(){
     if(document.getElementById("nexemination[]").value==""){
         alert('Exemination name can not left empty!');
	     document.getElementById("nexemination[]").focus();
	     return false;
     }
     if(document.getElementById("group1[]").value==""){
         alert('Group name can not left empty!');
	     document.getElementById("group1[]").focus();
	     return false;
     }
     if(document.getElementById("board[]").value==""){
         alert('Board name can not left empty!');
	     document.getElementById("board[]").focus();
	     return false;
     }
     if(document.getElementById("passyear[]").value==""){
         alert('Pass year can not left empty!');
	     document.getElementById("passyear[]").focus();
	     return false;
     }
     if(document.getElementById("gcsubject[]").value==""){
         alert('Special subject can not left empty!');
	     document.getElementById("gcsubject[]").focus();
	     return false;
     }
     if(document.getElementById("cgpas[]").value==""){
         alert('Special subject CGPA can not left empty!');
	     document.getElementById("cgpas[]").focus();
	     return false;
     }
     if(document.getElementById("tcgpa[]").value==""){
         alert('CGPA can not left empty!');
	     document.getElementById("tcgpa[]").focus();
	     return false;
     }
  }	 	

</script>

</head>

<body>
<table width="1047" border="0" align="center" cellpadding="0" cellspacing="0" id="tblborder">
  <tr>
    <td width="1047" height="152" valign="top" background="images/1.jpg"><span class="style17"><?php include("topdefault.php");?>    </span></span></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="28" colspan="2" bgcolor="#0C6ED1"><div align="center" class="style1">SAIC INSTITUTE OF MANAGEMENT TECHNOLOGY</div></td>
        </tr>
      <tr>
        <td width="19%" valign="top" background="images/leftbg.jpg"><?php include("left.php"); ?>
                   <br />
          
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        <td valign="top"><div align="center"><font face="Arial, Helvetica, sans-serif" size="2"><?php echo $_GET['msg'];?></font></div>
		
<form name="MyForm1" action="insertEXE.php" method="post" onsubmit="Javascript:return checkedq();">

         
<span id="tblhead" style="padding:5px;">Number of Educational Qualifications entry:<a href="javascript:new_link()">Add New </a>Id of:<?php if($msf['stdid']){echo $msf['stdid'];}else{ echo $msf['exstid']; } ?></span>
<div id="newlink" style="border-top:1px solid #CCCCCC;">
<div class="feed">
<table width="650" border="0" align="center" cellpadding="0" cellspacing="0" id="stdtbl">
  <tr>
    <td width="196" height="30"><span class="style11">Educational Qualification </span></td>
    <td width="18" height="30">&nbsp;</td>
    <td width="315">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" class="style2">Name of Exemination<span class="stars">*</span> </td>
    <td height="30" class="style2">:</td>
    <td><input name="nexemination[]" id="nexemination[]" type="text" class="style4" size="50" onkeypress="return handleEnter(this, event)" /></td>
    </tr>
  <tr>
    <td height="30" class="style2">Group/Trade<span class="stars">*</span></td>
    <td height="30" class="style2">:</td>
    <td><input name="group1[]" id="group1[]" type="text" class="style4" size="50" onkeypress="return handleEnter(this, event)" /></td>
  </tr>
  <tr>
    <td height="30" class="style2">Board<span class="stars">*</span></td>
    <td height="30" class="style2">:</td>
    <td><input name="board[]" id="board[]" type="text" class="style4" size="50" onkeypress="return handleEnter(this, event)" /></td>
  </tr>
  <tr>
    <td height="30" class="style2">Pass Year<span class="stars">*</span> </td>
    <td height="30" class="style2">:</td>
    <td><input name="passyear[]" id="passyear[]" type="text" class="style4" size="20" onkeypress="return handleEnter(this, event)" /></td>
  </tr>
  <tr>
    <td height="30" class="style2">Special Subject Name<span class="stars">*</span> </td>
    <td height="30" class="style2">:</td>
    <td><label>
      <select name="gcsubject[]" id="gcsubject[]">
        <option value="">Select</option>
        <option value="GM">General Math</option>
        <option value="HM">Higher Math</option>
        <option value="GS">General Science</option>
            </select>
    </label></td>
  </tr>
  <tr>
    <td height="30" class="style2">Got CGPA(GM/HM/SC)<span class="stars">* </span></td>
    <td height="30" class="style2">:</td>
    <td><input name="cgpas[]" id="cgpas[]" type="text" class="style4" onkeypress="return handleEnter(this, event)" /></td>
  </tr>
  <tr>
    <td height="30" class="style2">Total CGPA<span class="stars">* </span></td>
    <td height="30" class="style2">:</td>
    <td><input name="tcgpa[]" id="tcgpa[]" type="text" class="style4" onkeypress="return handleEnter(this, event)" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    </tr>
</table>
</div>
</div>
<p id="addnew"></p>
<div id="newlinktpl" style="display:none; border-top:1px solid #999999;">
	<div class="feed">
<table width="650" border="0" align="center" cellpadding="0" cellspacing="0" id="stdtbl">
  <tr>
    <td width="196" height="30"><span class="style11">Educational Qualification </span></td>
    <td width="18" height="30">&nbsp;</td>
    <td width="315">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" class="style2">Name of Exemination </td>
    <td height="30" class="style2">:</td>
    <td><input name="nexemination[]" id="nexemination[]" type="text" class="style4" size="50" onkeypress="return handleEnter(this, event)" /></td>
    </tr>
  <tr>
    <td height="30" class="style2">Group/Trade</td>
    <td height="30" class="style2">:</td>
    <td><input name="group1[]" id="group1[]" type="text" class="style4" size="50" onkeypress="return handleEnter(this, event)" /></td>
  </tr>
  <tr>
    <td height="30" class="style2">Board</td>
    <td height="30" class="style2">:</td>
    <td><input name="board[]" id="board[]" type="text" class="style4" size="50" onkeypress="return handleEnter(this, event)" /></td>
  </tr>
  <tr>
    <td height="30" class="style2">Pass Year </td>
    <td height="30" class="style2">:</td>
    <td><input name="passyear[]" id="passyear[]" type="text" class="style4" size="20" onkeypress="return handleEnter(this, event)" /></td>
  </tr>
  <tr>
    <td height="30" class="style2">Special Subject Name </td>
    <td height="30" class="style2">:</td>
    <td><label>
      <select name="gcsubject[]" id="gcsubject[]">
        <option>Select</option>
        <option value="GM">General Math</option>
        <option value="HM">Higher Math</option>
        <option value="GS">General Science</option>
            </select>
    </label></td>
  </tr>
  <tr>
    <td height="30" class="style2">Got CGPA(GM/HM/SC) </td>
    <td height="30" class="style2">:</td>
    <td><input name="cgpas[]" id="cgpas[]" type="text" class="style4" onkeypress="return handleEnter(this, event)" /></td>
  </tr>
  <tr>
    <td height="30" class="style2">Total CGPA </td>
    <td height="30" class="style2">:</td>
    <td><input name="tcgpa[]" id="tcgpa[]" type="text" class="style4" onkeypress="return handleEnter(this, event)" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    </tr>
</table>
</div>
</div>
<div align="center" style="padding:5px;"><input type="submit" name="Submit" value="Submit" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" /></div>
  </form>


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
