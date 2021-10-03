<?php session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $id=mysql_real_escape_string($_GET['id']);
  //$vs="SELECT*FROM tbl_payscale WHERE id='$id'";
  $vs="Select s.id, s.name as StaffName, s.sid, s.sex, s.remarks, s.cellno, s.etype, s.paddress,s.joindate, s.bankaccno, s.designationid, s.jobstatus, s.fname,s.mname,s.dob,s.maritalstatus, s.religion, s.bloodgroup, s.smob, s.pfob, s.edq, d.name as Designation, s.etype, s.payscaleid, s.img, p.name as Payscale, s.alstatus, s.clstatus, s.slstatus From tbl_staffinfo s inner join tbl_designation d on s.designationid=d.id inner join tbl_payscale p on s.payscaleid=p.id WHERE s.storedstatus<>'D' and s.id='$id'
 order by id";
  $r=$myDb->select($vs);
  $row=$myDb->get_row($r,'MYSQL_ASSOC');
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managestaffinfonew.php' AND userid='$_SESSION[userid]'";
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

<script type="text/javascript" src="JQdtp/jquery.min.js"></script>
<script type="text/javascript" src="JQdtp/jquery-ui.min.js"></script>
<script type="text/javascript" src="JQdtp/jquery-ui-i18n.min.js"></script>
<link rel="stylesheet" type="text/css" href="JQdtp/jquery-ui.css">

	<script type="text/javascript">
		/*
		 * jQuery UI Datepicker: Internationalization and Localization
		 * http://salman-w.blogspot.com/2013/01/jquery-ui-datepicker-examples.html
		 */
		$(function() {
			$("#jdate").datepicker($.datepicker);

			$("#dob").datepicker($.extend({}, $.datepicker, {
				showWeek: true
			}));
			//$("#datepicker-3").datepicker($.datepicker.regional["de"]).datepicker("option", {
			//	changeMonth: true,
			//	changeYear: true
			//});
		});
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
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg'];  }?></font></p>
		<form name="MyForm" action="ed_staffinfo.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data" onsubmit="Javascript:return checkstaffdata();">
          
			<div align="center"><br />
          <table width="95%" border="0" align="center" cellpadding="0" cellspacing="5" id="stdtbl">

            <tr>
              <td height="20" colspan="5" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">EDIT EMPLOYEE INFORMATION (<span class="stars">*</span>Mandatory Field) </span></td>
              </tr>
            <tr bgcolor="#F3F3F3">
              <td height="32" colspan="5" class="style2">General Information</td>
              </tr>
			  <?php $chartp=$myDb->select("SELECT*FROM tbl_accchart WHERE empid='".$row['sid']."' and pro='Y'");
			        $chartf=$myDb->get_row($chartp,'MYSQL_ASSOC');
			  ?>
 			  <?php $charts=$myDb->select("SELECT*FROM tbl_accchart WHERE empid='".$row['sid']."' and sec='Y'");
			        $chartsf=$myDb->get_row($charts,'MYSQL_ASSOC');
			  ?>			   <tr>
              <td width="20%" height="20" class="style2">Provident Fund :</td>
              <td width="4%" height="20" class="style2">
			  
			  <?php if($chartf['pro']=="Y"){ ?>
			  <input name="profund" type="checkbox" id="profund" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="Y" size="29" checked="checked" />
			  <?php }else{ ?>
			  <input name="profund" type="checkbox" id="profund" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="Y" size="29" />
			  <?php } ?>
			  
			  </td>
              <td width="20%" class="style2">Security Money :</td>
              <td width="10%" class="style2">
			  <?php if($chartsf['sec']=="Y"){ ?>
			  <input name="secmoney" type="checkbox" id="secmoney" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="Y" size="29" checked="checked" />
			  <?php }else{ ?>
			  <input name="secmoney" type="checkbox" id="secmoney" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="Y" size="29" />
			  <?php } ?>
			  </td>
              <td width="46%" class="style2">&nbsp;</td>
            </tr>
            <tr>
              <td width="20%" height="20" class="style2">Name:<span class="stars">*</span></td>
              <td height="20" colspan="4"><input name="name" type="text" id="name" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['StaffName']; ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Employee ID :<span class="stars">*</span> </td>
              <td height="20" colspan="4"><input name="sid" type="text" id="sid" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['sid']; ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Sex :<span class="stars">*</span></td>
              <td height="20" colspan="4"><span class="style4">
                <select name="sex" id="sex" onkeypress="return handleEnter(this, event)">
                  <?php if($row['sex']=="Male"){ ?>
                  <option value="<?php echo $row['sex']; ?>" selected="selected">Male</option>
                  <?php }else{ ?>
                  <option value="<?php echo $row['sex']; ?>">Female</option>
                  <?php } ?>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </span></td>
            </tr>
            <tr>
              <td height="20" class="style2">Address:</td>
              <td height="20" colspan="4"><textarea name="paddress" cols="60" id="paddress" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"><?php echo $row['paddress']; ?></textarea></td>
            </tr>
            <tr>
              <td height="20" class="style2">Education Qualification :<span class="stars"></span></td>
              <td height="20" colspan="4"><input name="edq" type="text" id="edq" style="font-family: Verdana; width:500px; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" maxlength="11" value="<?php echo $row['edq'];?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Cell No :<span class="stars">*</span> </td>
              <td height="20" colspan="4"><input name="cellno" type="text" id="cellno" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" maxlength="11" value="<?php echo $row['cellno']; ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Designation :<span class="stars">*</span> </td>
              <td height="20" colspan="4"><select name="desigid" id="desigid" onkeypress="return handleEnter(this, event)">
                <option selected="selected" value="<?php echo $row['designationid']; ?>"><?php echo $row['Designation']; ?></option>
                <?php $hq=$myDb->select("select id,name from tbl_designation");
				   while($hrow=$myDb->get_row($hq,'MYSQL_ASSOC')){
				   ?>
                <option value="<?php echo $hrow['id']; ?>"><?php echo $hrow['name']; ?></option>
                <?php } ?>
              </select></td>
            </tr>
            <tr>
              <td height="20" class="style2">Employment Type:<span class="stars">*</span> </td>
              <td height="20" colspan="4"><select name="emptype" id="emptype" onkeypress="return handleEnter(this, event)">
                <?php if($row['etype']=="Full Time"){ ?><option value="<?php echo $row['etype']; ?>" selected="selected">Full Time</option>
				  <?php }else{ ?>
				  <option value="<?php echo $row['etype']; ?>">Part Time</option>
				  <?php } ?>
				<option value="Full Time">Full Time</option>
                <option value="Part Time">Part Time</option>
                                                        </select></td>
            </tr>
            <tr>
              <td height="20" class="style2">Joining Date :</td>
              <td height="20" colspan="4"><input name="jdate" type="text" class="style15" id="jdate" onkeypress="return handleEnter(this, event)" value="<?php echo $row['joindate']; ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Payscale :<span class="stars">*</span> </td>
              <td height="20" colspan="4"><select name="payscaleid" id="payscaleid" onkeypress="return handleEnter(this, event)">
                <option selected="selected" value="<?php echo $row['payscaleid']; ?>"><?php echo $row['Payscale']; ?></option>
                <?php $hq=$myDb->select("select id,name from tbl_payscale");
				   while($hrow=$myDb->get_row($hq,'MYSQL_ASSOC')){
				   ?>
                <option value="<?php echo $hrow['id']; ?>"><?php echo $hrow['name']; ?></option>
                <?php } ?>
              </select></td>
            </tr>
            <tr bgcolor="#DFEFFF">
              <td height="20" class="style2">Job Status  :<span class="stars"></span></td>
              <td height="20" colspan="4"><select name="jobstatus" id="jobstatus" onkeypress="return handleEnter(this, event)">
                <?php if($row['jobstatus']=="Active"){ ?>
                <option value="<?php echo $row['jobstatus']; ?>" selected="selected">Active</option>
                <?php }else{ ?>
                <option value="<?php echo $row['jobstatus']; ?>">Inactive</option>
                <?php } ?>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select></td>
            </tr>
            <tr>
              <td height="20" class="style2">Assign Leave:</td>
              <td height="20" colspan="4"><table width="100%" height="20"  border="0" cellpadding="0" cellspacing="0">
                <tr class="style2">
                  <td width="5%"><span class="style2">
                    <?php if($row['clstatus']=="1"){ ?>
                    <input name="cl" type="checkbox" id="cl" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="Y" size="29" checked="checked" />
                    <?php }else{ ?>
                    <input name="cl" type="checkbox" id="cl" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="Y" size="29" />
                    <?php } ?>
                  </span></td>
                  <td width="31%">Casual Leave </td>
                  <td width="6%"><span class="style2">
                    <?php if($row['slstatus']=="1"){ ?>
                    <input name="sl" type="checkbox" id="sl" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="Y" size="29" checked="checked" />
                    <?php }else{ ?>
                    <input name="sl" type="checkbox" id="sl" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="Y" size="29" />
                    <?php } ?>
                  </span></td>
                  <td width="24%">Sick Leave </td>
                  <td width="4%"><span class="style2">
                    <?php if($row['alstatus']=="1"){ ?>
                    <input name="al" type="checkbox" id="al" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="Y" size="29" checked="checked" />
                    <?php }else{ ?>
                    <input name="al" type="checkbox" id="al" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="Y" size="29" />
                    <?php } ?>
                  </span></td>
                  <td width="30%">Annual Leave </td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="20" class="style2">Bank Account No:</td>
              <td height="20" colspan="4"><input name="bankaccno" type="text" id="bankaccno" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['bankaccno'];?>" /></td>
            </tr>
            <tr bgcolor="#F3F3F3">
              <td height="27" colspan="5" class="style2"><table width="100%" height="24"  border="1" cellpadding="0" cellspacing="0" bordercolor="#E6F2FF" bgcolor="#F4F4FF">
                <tr>
                  <td width="22%">Security Money OB :</td>
                  <td width="26%"><input name="smob" type="text" id="smob" style="font-family: Verdana; font-size: 8pt; width:80px; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"  size="29" maxlength="11" value="<?php echo $row['smob'];?>"  />(BDT)</td>
                  <td width="26%">Provident Fund OB :</td>
                  <td width="26%"><input name="pfob" type="text" id="pfob" style="font-family: Verdana; font-size: 8pt;  width:80px; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"  size="29" maxlength="11" value="<?php echo $row['pfob'];?>" />(BDT)</td>
                </tr>
              </table></td>
            </tr>
            <tr bgcolor="#F3F3F3">
              <td height="35" colspan="5" class="style2">Personal Information</td>
              </tr>
            <tr>
              <td height="20" class="style2">Father's Name :</td>
              <td height="20" colspan="4"><input name="fname" type="text" id="fname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['fname'];?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Mother's Name :</td>
              <td height="20" colspan="4"><input name="mname" type="text" id="mname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['mname'];?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">DOB :</td>
              <td height="20" colspan="4"><input name="dob" type="text" class="style15" id="dob" onkeypress="return handleEnter(this, event)" value="<?php echo $row['dob']; ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Marital Status :</td>
              <td height="20" colspan="4"><select name="mstatus" id="mstatus" onkeypress="return handleEnter(this, event)">
                <?php if($row['maritalstatus']=="Married"){ ?>
                <option value="<?php echo $row['maritalstatus']; ?>" selected="selected">Married</option>
                <?php }else{ ?>
                <option value="<?php echo $row['maritalstatus']; ?>">Unmarried</option>
                <?php } ?>
                <option value="Married">Married</option>
                <option value="Unmarried">Unmarried</option>
              </select></td>
            </tr>
            <tr>
              <td height="20" class="style2">Religion :</td>
              <td height="20" colspan="4"><span class="style4">
                <select name="religion" id="religion" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                  
				  <?php if($row['religion']=="Islam"){ ?>
                	<option value="<?php echo $row['religion']; ?>" selected="selected">Islam</option>
                	<?php }else if($row['religion']=="Hindu"){ ?>
                	<option value="<?php echo $row['religion']; ?>">Hindu</option>
					<?php }else if($row['religion']=="Boddho"){ ?>
                	<option value="<?php echo $row['religion']; ?>">Boddho</option>
					<?php }else if($row['religion']=="Khristan"){ ?>
                	<option value="<?php echo $row['religion']; ?>">Khristan</option>
					<?php }else{ ?>
                	<option value="<?php echo $row['religion']; ?>">Iahudi</option>
                	
               	  <?php } ?>
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
              <td height="20" colspan="4"><input name="bg" type="text" id="bg" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" maxlength="11" value="<?php echo $row['bloodgroup']?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Photo :</td>
              <td height="20" colspan="4">
			  <?php if($row['img']<>""){?>
				  <img name="" src="staffphoto/<?php echo $row['img']; ?>" width="80" height="80" alt="" />
			  <?php }else{?>
				  <img name="" src="staffphoto/<?php if($row['sex']=="Male"){ ?>male.jpg<?php }elseif($row['sex']=="Female"){?>female.jpg<?php }?>" width="80" height="80" alt="" />
			  <?php }?>
                <input name="img" type="file" class="style4" id="img" onkeypress="return handleEnter(this, event)"/></td>
            </tr>
            <tr>
              <td height="20" class="style2">Remarks:</td>
              <td height="20" colspan="4"><textarea name="remarks" cols="50" id="remarks" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"><?php echo $row['remarks']; ?></textarea></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="4"><input type="submit" value="Submit" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"> <input type="reset" name="Submit2" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/></td>
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
  header("Location:index.php");
}
}