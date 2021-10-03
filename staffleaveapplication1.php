<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  	if($_SESSION['userid']){
  	$chka="SELECT*FROM  tbl_accdtl WHERE flname='managestaffinfo.php' AND userid='$_SESSION[userid]'";
  	$caq=$myDb->select($chka);
  	$car=$myDb->get_row($caq,'MYSQL_ASSOC');
  	if($car['ins']=="y"){
	
	//--------------Serach Previous Staff Id------------------//
	$chsid="SELECT max(sid) as sid, cast( ifnull( max( substr( sid, 4, 5 ) ) , 0 ) AS signed int ) mid, length( cast(ifnull( max( substr( sid, 4, 5 ) ) , 0 ) AS signed int )) idlength FROM `tbl_staffinfo` WHERE storedstatus<>'D'";
  	$caqs=$myDb->select($chsid);
  	$cars=$myDb->get_row($caqs,'MYSQL_ASSOC');
	if($cars['idlength']=="1")
	{
		if($cars['mid']=="9")
		{
			$autoid="EMP 00".($cars['mid'] + 1);
		}
		else
		{
			$autoid="EMP 000".($cars['mid'] + 1);
		}
	}
	else if($cars['idlength']=="2")
	{
		if($cars['mid']=="99")
		{
			$autoid="EMP 0".($cars['mid'] + 1);
		}
		else
		{
			$autoid="EMP 00".($cars['mid'] + 1);
		}
	}
	else if($cars['idlength']=="3")
	{
		if($cars['mid']=="999")
		{
			$autoid=$cars['mid'] + 1;
		}
		else
		{
			$autoid="EMP 0".($cars['mid'] + 1);
		}
	}
	else if($cars['idlength']=="4")
	{
		$autoid="EMP ".($cars['mid'] + 1);
	}
	else
	{
		$autoid="EMP 0001";
	}

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
	$("#searchid").autocomplete("search_staffinfo.php", {
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

	function checkstaffdata()
	{
		if(document.getElementById("name").value==''){
		alert('Satff Name can not left empty');
		 document.getElementById("name").focus();
	     return false;
		 
	    }

		if(document.getElementById("sid").value==''){
		alert('Staff ID can not be left empty.');
		 document.getElementById("sid").focus();
	     return false;
		 
	    }

		

		if(document.getElementById("cellno").value==''){
		alert('Cell No can not be left empty.');
		 document.getElementById("cellno").focus();
	     return false;
		 
	    }

		
		if(document.getElementById("desigid").value=='Select Designation'){
		alert('Designation Name can not be left empty');
		 document.getElementById("desigid").focus();
	     return false;
		 
	    }

		if(document.getElementById("emptype").value==''){
		alert('Employment type can not be left empty.');
		 document.getElementById("emptype").focus();
	     return false;
		 
	    }
	
		if(document.getElementById("payscaleid").value=='Select Payscale'){
		alert('Payscale can not be left empty.');
		 document.getElementById("payscaleid").focus();
	     return false;
		 
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
		<form name="MyForm" action="ins_staffinfo.php" method="post" enctype="multipart/form-data" onsubmit="Javascript:return checkstaffdata();">
		
          <div align="center">
            <table width="70%" border="0" align="center" cellpadding="0" cellspacing="5" id="stdtbl">

            <tr>
              <td height="28" colspan="4" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">EMPLOYEE LEAVE APPLICATION  (<span class="stars">*</span>Mandatory Field) </span></td>
              </tr>
            <tr>
              <td height="20" colspan="4" class="style6"><table width="100%" height="112" border="0" cellpadding="0" cellspacing="0">
                <tr bgcolor="#DAF5FE">
                  <td width="34%" height="28" bgcolor="#FFE8F3"><span class="style2">Enter Employee ID :<span class="stars">*</span></span></td>
                  <td width="66%" bgcolor="#FFE8F3"><input name="sid" type="text" id="sid" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="<?php echo $autoid;?>" size="29" /></td>
                </tr>
                <tr bgcolor="#DAF5FE">
                  <td height="28" colspan="2" bgcolor="#FFE8F3"><div align="left"><span class="style2">Balance Leave : </span></div></td>
                  </tr>
                <tr bgcolor="#DAF5FE">
                  <td colspan="2"><span class="style2">Casual Leave</span><span class="style2"> <?php echo $cars['sid'];?> days out of <?php echo $cars['sid'];?> days</span></td>
                  </tr>
                <tr bgcolor="#DAF5FE">
                  <td height="23" colspan="2"><span class="style2">Sick Leave</span><span class="style2"> <?php echo $cars['sid'];?> days out of <?php echo $cars['sid'];?> days</span></td>
                  </tr>
                <tr bgcolor="#DAF5FE">
                  <td colspan="2"><span class="style2">Annual Leave</span><span class="style2"> <?php echo $cars['sid'];?> days out of <?php echo $cars['sid'];?> days</span></td>
                  </tr>
              </table></td>
              </tr>
            <tr bgcolor="#F3F3F3">
              <td height="29" colspan="4" class="style2">General Information</td>
              </tr>
			  <tr>
              <td width="20%" height="20" class="style2">Provident Fund :</td>
              <td width="5%" height="20" class="style2"><input name="profund" type="checkbox" id="profund" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="Y" size="29" /></td>
              <td width="20%" class="style2">Security Money :</td>
              <td width="59%" align="left" class="style2"><input name="secmoney" type="checkbox" id="secmoney" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="Y" size="29" /></td>
              
            </tr>
			
            <tr>
              <td width="20%" height="20" class="style2">Employee ID :<span class="stars">*</span></td>
              <td height="20" colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td height="20" class="style2"> Name :<span class="stars">*</span> </td>
              <td height="20" colspan="3">                <input name="name" type="text" id="name" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Sex :<span class="stars">*</span> </td>
              <td height="20" colspan="3"><select name="sex" id="sex" onkeypress="return handleEnter(this, event)">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select></td>
            </tr>
            <tr>
              <td height="20" class="style2">Address:</td>
              <td height="20" colspan="3"><textarea name="paddress" cols="60" id="paddress" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"></textarea></td>
            </tr>
            <tr>
              <td height="20" class="style2">Cell No :<span class="stars">*</span> </td>
              <td height="20" colspan="3"><input name="cellno" type="text" id="cellno" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" maxlength="11" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Designation :<span class="stars">*</span> </td>
              <td height="20" colspan="3"><select name="desigid" id="desigid" onkeypress="return handleEnter(this, event)">
                <option>Select Designation</option>
                <?php $hq=$myDb->select("select id,name from tbl_designation Where storedstatus<>'D'");
				   while($hrow=$myDb->get_row($hq,'MYSQL_ASSOC')){
				   ?>
                <option value="<?php echo $hrow['id']; ?>"><?php echo $hrow['name']; ?></option>
                <?php } ?>
              </select></td>
            </tr>
            <tr>
              <td height="20" class="style2">Employment Type  :<span class="stars">*</span> </td>
              <td height="20" colspan="3"><select name="emptype" id="emptype" onkeypress="return handleEnter(this, event)">
                <option value="Full Time">Full Time</option>
                <option value="Part Time">Part Time</option>
              </select></td>
            </tr>
            <tr>
              <td height="20" class="style2">Joining Date  :</td>
              <td height="20" colspan="3"><input name="jdate" type="text" class="style15" id="DPC_jdate_YYYY-MM-DD" onkeypress="return handleEnter(this, event)" value="<?php echo date("Y-m-d"); ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Payscale :<span class="stars">*</span> </td>
              <td height="20" colspan="3"><select name="payscaleid" id="payscaleid" onkeypress="return handleEnter(this, event)">
                <option>Select Payscale</option>
                <?php $hq=$myDb->select("select id,name from tbl_payscale Where storedstatus<>'D'");
				   while($hrow=$myDb->get_row($hq,'MYSQL_ASSOC')){
				   ?>
                <option value="<?php echo $hrow['id']; ?>"><?php echo $hrow['name']; ?></option>
                <?php } ?>
              </select></td>
            </tr>
            <tr>
              <td height="20" class="style2">Assign Leave:</td>
              <td height="20" colspan="3"><table width="100%" height="20"  border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="5%"><input name="cl" type="checkbox" id="cl5" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="Y" size="29" /></td>
                  <td width="31%">Casual Leave </td>
                  <td width="6%"><input name="sl" type="checkbox" id="sl2" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="Y" size="29" /></td>
                  <td width="24%">Sick Leave </td>
                  <td width="4%"><input name="al" type="checkbox" id="al" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="Y" size="29" /></td>
                  <td width="30%">Annual Leave </td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="20" class="style2">&nbsp;</td>
              <td height="20" colspan="3">&nbsp;</td>
            </tr>
            <tr bgcolor="#F3F3F3">
              <td height="36" colspan="4" class="style2">Personal Information</td>
              </tr>
            <tr>
              <td height="20" class="style2">Father's Name :</td>
              <td height="20" colspan="3"><input name="fname" type="text" id="fname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Mother's Name :</td>
              <td height="20" colspan="3"><input name="mname" type="text" id="mname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">DOB :</td>
              <td height="20" colspan="3"><input name="dob" type="text" class="style15" id="DPC_dob_YYYY-MM-DD" onkeypress="return handleEnter(this, event)" value="<?php echo date("Y-m-d"); ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Marital Status :</td>
              <td height="20" colspan="3"><select name="mstatus" id="mstatus" onkeypress="return handleEnter(this, event)">
                <option value="Married">Married</option>
                <option value="Unmarried">Unmarried</option>
              </select></td>
            </tr>
            <tr>
              <td height="20" class="style2">Religion :</td>
              <td height="20" colspan="3"><span class="style4">
                <select name="religion" id="religion" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                  <option value="">Select</option>
                  <option value="Islam">Islam</option>
                  <option value="Hindu">Hindu</option>
                  <option value="Boddho">Boddho</option>
                  <option value="Khristan">Khristan</option>
                  <option value="Iahudi">Iahudi</option>
                </select>
              </span></td>
            </tr>
            <tr>
              <td height="20" class="style2">Blood Group :</td>
              <td height="20" colspan="3"><input name="bg" type="text" id="bg" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" maxlength="11" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Photo :</td>
              <td height="20" colspan="3"><input name="img" type="file" class="style4" id="img" onkeypress="return handleEnter(this, event)"/></td>
            </tr>
            <tr>
              <td height="20" class="style2">Remarks :</td>
              <td height="20" colspan="3"><textarea name="remarks" cols="60" id="remarks" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"></textarea></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="3"><input type="submit" value="Submit" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"> <input type="reset" name="Submit2" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/></td>
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
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>