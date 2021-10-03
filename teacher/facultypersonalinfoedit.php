<?php session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  //$id=mysql_real_escape_string($_GET['id']);
  //$vs="SELECT*FROM tbl_payscale WHERE id='$id'";
  $vs="SELECT f.id, f.facultyid, f.password, f.name, f.fname, f.mname, f.sex, f.dob, f.mstatus, f.bloodgroup, f.address,f.designationid, d.name as designation, f.joiningdate, f.deptid, dp.name as department, f.expartincourse, f.eduqualification, f.expyear, f.expmonth, f.contactno, f.type, f.payscaleid, p.name as payscale FROM `tbl_faculty` f inner join tbl_designation d on f.designationid=d.id inner join tbl_department dp on f.deptid=dp.id inner join tbl_payscale p on f.payscaleid=p.id WHERE f.storedstatus<>'D' and f.facultyid='$_SESSION[userid]'";
  $r=$myDb->select($vs);
  $row=$myDb->get_row($r,'MYSQL_ASSOC');
  
 /* $chka="SELECT*FROM  tbl_accdtl WHERE flname='managefacultyinfo.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  */
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
div.transbox
  {
  background-color:#ffffff;

  opacity:0.9;
  filter:alpha(opacity=60); /* For IE8 and earlier */
  }

-->
</style>
<script type="text/javascript" src="jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#searchid").autocomplete("search_facultyinfo.php", {
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

<script type="text/javascript" src="datepickercontrol.js"></script>
  <script language="JavaScript">
  if (navigator.platform.toString().toLowerCase().indexOf("linux") != -1){
	 	document.write('<link type="text/css" rel="stylesheet" href="datepickercontrol_lnx.css">');
	 }
	 else{
	 	document.write('<link type="text/css" rel="stylesheet" href="datepickercontrol.css">');
	 }

</script>

<script language="javascript">
$(document).keyup(function(e) {
  if(e.keyCode==45){
    $('#bothead').show();
  }
  if(e.keyCode==27){
    $('#bothead').hide();
  }
});
</script>


<script src="facultyinfo.js" type="text/javascript"></script>
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
        <td background="images/leftbg.jpg"><img src="images/leftbg.jpg" width="252" height="3" /></td>
        <td><img src="images/spaer.gif" width="1" height="1" /></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php"); ?>
                   <br />
          
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        <td width="79%" valign="top">
<div class="transbox"><div id="bothead" style=" position:absolute; background-color:#666666;   padding:10px; color:#FFFFFF; left:400px;float:right;width:700px; height:auto; display:none; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px;">
   
   HELP SHORTCUT KEY:<br/>
  ---------------------------<br/><br/>
   <label>Press "Insert" key from keyboard 	---- To open help</label><br/> 
   <label>Press "Esc" key					---- To close help</label><br/> <br/><br/>

	HOW TO EDIT INFORMATION<br/>
  	--------------------------------<br/><br/>
   <label>Edit all the necessary information that you wants to edit</label><br/>
   <label>Click Submit Button----- To Update your personal information</label><br/>
  
	     
</div></div>

<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg'];  }?></font></p>
		<form name="MyForm" action="ed_facultyinfo.php?id=<?php echo '$_SESSION[userid]'; ?>" method="post" enctype="multipart/form-data">

          <div align="center">          <table width="98%" border="0" align="center" cellpadding="0" cellspacing="2" id="stdtbl">

            <tr>
              <td height="20" colspan="4" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">EDIT FACULTY PERSONAL INFORMATION</td>
              </tr>
            <tr bgcolor="#DFF4FF">
              <td height="32" colspan="4" class="style2">General Information</td>
              </tr>
            <tr bgcolor="#F2F2F2">
              <td width="17%" height="20" class="style2">Faculty ID :<span class="stars">*</span></td>
              <td width="26%" height="20"><input name="fid" type="text" id="fid" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['facultyid']; ?>" readonly="true" /></td>
              <td width="18%"><span class="style2">Sex :<span class="stars">*</span></span></td>
              <td width="39%"><select name="sex" id="sex" onkeypress="return handleEnter(this, event)">
                <?php if($row['sex']=="Male"){ ?>
                <option value="<?php echo $row['sex']; ?>" selected="selected">Male</option>
                <?php }else{ ?>
                <option value="<?php echo $row['sex']; ?>">Female</option>
                <?php } ?>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select></td>
            </tr>
            <tr bgcolor="#F2F2F2">
              <td height="20" class="style2">Name:<span class="stars">*</span></td>
              <td height="20"><input name="name" type="text" id="name" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['name']; ?>" /></td>
              <td><span class="style2">Contact No :<span class="stars">*</span> </span></td>
              <td><input name="contactno" type="text" id="contactno" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" maxlength="11" value="<?php echo $row['contactno'];?>" /></td>
            </tr>
            <tr bgcolor="#F2F2F2">
              <td height="20" class="style2">Department :<span class="stars">*</span> </td>
              <td height="20"><select name="deptid" id="deptid" onkeypress="return handleEnter(this, event)">
                <option selected="selected"  value="<?php echo $row['deptid']; ?>"><?php echo $row['department']; ?></option>
                <option>Select Department</option>
                <?php $hq=$myDb->select("select id,name from tbl_department Where storedstatus<>'D'");
				   while($hrow=$myDb->get_row($hq,'MYSQL_ASSOC')){
				   ?>
                <option value="<?php echo $hrow['id']; ?>"><?php echo $hrow['name']; ?></option>
                <?php } ?>
              </select></td>
              <td><span class="style2">Experience :<span class="stars">*</span> </span></td>
              <td><table width="59%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="18%" align="center"><span style="font-size:11px; "><?php echo $row['expyear'];?></span></td>
                  <td width="9%"><span class="style2">Years</span></td>
                  <td width="19%" align="center"><span style="font-size:11px; "><?php echo $row['expmonth'];?></span></td>
                  <td width="54%"><span class="style2">Months</span></td>
                </tr>
              </table></td>
            </tr>
            <tr bgcolor="#F2F2F2">
              <td height="20" class="style2">Designation :<span class="stars">*</span>  </td>
              <td height="20"><span style="font-size:11px; "> <?php echo $row['designation'];?></span></td>
              <td><span class="style2">Type :<span class="stars">*</span> </span></td>
              <td><span style="font-size:11px; "><?php echo $row['type']; ?></span></td>
            </tr>
            <tr bgcolor="#F2F2F2">
              <td height="20" class="style2">Joining Date :<span class="stars">*</span> </td>
              <td height="20"><span class="style2">
                <input name="jdate" type="text" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" id="jdate" onkeypress="return handleEnter(this, event)" value="<?php echo $row['joiningdate']; ?>" readonly="true" />
              </span></td>
              <td><span class="style2">Expart (In Subject) :</span></td>
              <td><input name="expsub" type="text" id="expsub" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['expartincourse'];?>" /></td>
            </tr>
            <tr bgcolor="#F2F2F2">
              <td height="20" class="style2">Payscale :<span class="stars">*</span></td>
              <td height="20"><span style="font-size:11px; "><?php echo $row['payscale']; ?></span></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr bgcolor="#F2F2F2">
              <td height="20" class="style2">EducationQualification :<span class="stars">*</span></td>
              <td height="20" colspan="3"><textarea name="eduq" cols="60" id="eduq" style="font-family: Verdana; width:600px; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"><?php echo $row['eduqualification']; ?></textarea></td>
              </tr>
            <tr bgcolor="#F2F2F2">
              <td height="20" class="style2">Address :</td>
              <td height="20" colspan="3"><textarea name="paddress" cols="60" id="paddress" style="font-family: Verdana; width:600px; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"><?php echo $row['address']; ?></textarea></td>
              </tr>
            <tr bgcolor="#DFF4FF">
              <td height="40" colspan="4" class="style2">Personal Information</td>
              </tr>
            <tr bgcolor="#F2F2F2">
              <td height="20" class="style2">Father's Name :</td>
              <td height="20"><input name="fname" type="text" id="fname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['fname'];?>" /></td>
              <td><span class="style2">Marital Status :</span></td>
              <td><select name="mstatus" id="mstatus" onkeypress="return handleEnter(this, event)">
                <?php if($row['mstatus']=="Married"){ ?>
                <option value="<?php echo $row['mstatus']; ?>" selected="selected">Married</option>
                <?php }else{ ?>
                <option value="<?php echo $row['mstatus']; ?>">Unmarried</option>
                <?php } ?>
                <option value="Married">Married</option>
                <option value="Unmarried">Unmarried</option>
              </select></td>
            </tr>
            <tr bgcolor="#F2F2F2">
              <td height="20" class="style2">Mother's Name :</td>
              <td height="20"><input name="mname" type="text" id="mname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['mname'];?>" /></td>
              <td><span class="style2">DOB :</span></td>
              <td><input name="dob" type="text" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" id="dob" onkeypress="return handleEnter(this, event)" value="<?php echo $row['dob']; ?>" /></td>
            </tr>
            <tr bgcolor="#F2F2F2">
              <td height="20" class="style2">Blood Group :</td>
              <td height="20"><input name="bg" type="text" id="bg" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['bloodgroup'];?>" /></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr bgcolor="#F2F2F2">
              <td height="20" class="style2">&nbsp;</td>
              <td height="20">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr bgcolor="#F2F2F2">
              <td height="20" class="style2">&nbsp;</td>
              <td height="20">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr bgcolor="#F2F2F2">
              <td>&nbsp;</td>
              <td><input type="submit" value="Submit" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />
                <input type="reset" name="Submit" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>          
          </div>

            </form>
           <br />
          		<div id="MyResult" align="center"></div> 
          		          
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
 /*  }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 
*/
}else{
  header("Location:index.php");
}
}  
?>