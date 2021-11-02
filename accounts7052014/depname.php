<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='depname.php' AND userid='$_SESSION[userid]'";
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
.style12 {font-size: 10px}
.style15 {
	font-size: 12px;
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
 
function valdepname(){
  		if(document.getElementById("code").value==''){
		alert('Code can not left empty');
		 document.getElementById("code").focus();
	     return false;
		 
	    }
		if(document.getElementById("name").value==''){
		alert('Department name can not left empty');
		 document.getElementById("name").focus();
	     return false;
		 
	    }
		if(document.getElementById("admissionfee").value==''){
		alert('Admissionfee can not left empty');
		 document.getElementById("admissionfee").focus();
	     return false;
		 
	    }
		if(document.getElementById("labfee").value==''){
		alert('Labfee can not left empty');
		 document.getElementById("labfee").focus();
	     return false;
		 
	    }
		if(document.getElementById("libraryfee").value==''){
		alert('Libraryfee can not left empty');
		 document.getElementById("libraryfee").focus();
	     return false;
		 
	    }
		if(document.getElementById("idcardfee").value==''){
		alert('ID cardfee can not left empty');
		 document.getElementById("idcardfee").focus();
	     return false;
		 
	    }
		if(document.getElementById("regifee").value==''){
		alert('Registrationfee can not left empty');
		 document.getElementById("regifee").focus();
	     return false;
		 
	    }
		if(document.getElementById("noofsemester").value==''){
		alert('No of semesterfee can not left empty');
		 document.getElementById("noofsemester").focus();
	     return false;
		 
	    }
		if(document.getElementById("semesterfee").value==''){
		alert('Semesterfee can not left empty');
		 document.getElementById("semesterfee").focus();
	     return false;
		 
	    }
		if(document.getElementById("noofmonths").value==''){
		alert('No of monthfee can not left empty');
		 document.getElementById("noofmonths").focus();
	     return false;
		 
	    }
		if(document.getElementById("tuitionfee").value==''){
		alert('Tuitionfee can not left empty');
		 document.getElementById("tuitionfee").focus();
	     return false;
		 
	    }
		if(document.getElementById("credit").value==''){
		alert('Total credit can not left empty');
		 document.getElementById("credit").focus();
	     return false;
		 
	    }

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
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php echo $_GET['msg'];?></font></p>
		<form id="form1" name="form1" method="post" action="ins_depname.php" onsubmit="Javascript:return valdepname();">
          <div align="center"><br />
          <table width="750" border="0" align="center" cellpadding="0" cellspacing="3" id="stdtbl">

            <tr>
              <td height="20" colspan="2" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">DEPARTMENT INFORMATION </td>
              <td height="20" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">&nbsp;</td>
              <td height="20" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><span class="stars">*</span>(Mandatory Field) </td>
            </tr>
            <tr>
              <td width="21%" height="20" class="style2">Code:<span class="stars">*</span> </td>
              <td height="20"><input name="code" type="text" id="code" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td height="20" colspan="2"><span class="style2">Name:<span class="stars">*</span></span>                <input name="name" type="text" id="name" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="50" /></td>
              </tr>
            <tr>
              <td height="20" class="style2">Admission Fee :<span class="stars">*</span></td>
              <td width="23%" height="20"><input name="admissionfee" type="text" id="admissionfee" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td width="23%"><span class="style2">Lab Fee :</span></td>
              <td width="33%"><input name="labfee" type="text" id="labfee" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            
            <tr>
              <td height="20" class="style2">Library Fee :<span class="stars">*</span></td>
              <td height="20"><input name="libraryfee" type="text" id="libraryfee" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td height="20"><span class="style2">Id Card Fee :<span class="stars">*</span></span></td>
              <td height="20"><input name="idcardfee" type="text" id="idcardfee" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Registration Fee :<span class="stars">*</span></td>
              <td height="20"><input name="regifee" type="text" id="regifee" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td height="20"><span class="style2">One Time Fee (Total) :</span></td>
              <td height="20"><input name="onetimefee" type="text" id="onetimefee" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">No. of Semester :<span class="stars">*</span></td>
              <td height="20"><input name="noofsemester" type="text" id="noofsemester" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td height="20"><span class="style2">Semester Fee :<span class="stars">*</span></span></td>
              <td height="20"><input name="semesterfee" type="text" id="semesterfee" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">No. of Months :<span class="stars">*</span></td>
              <td height="20"><input name="noofmonths" type="text" id="noofmonths" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td height="20"><span class="style2">Tuition Fee (/Months) :<span class="stars">*</span></span></td>
              <td height="20"><input name="tuitionfee" type="text" id="tuitionfee" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Credit :<span class="stars">*</span></td>
              <td height="20" colspan="3"><input name="credit" type="text" id="credit" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Description:</td>
              <td height="20" colspan="3"><textarea name="description" cols="85" rows="5" id="description" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"></textarea></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="3"><input type="submit" value="Submit" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"> <input type="reset" name="Submit2" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/></td>
            </tr>
          </table>          
          </div>

            </form>
          <br />
          <?php $sdq="select id,code as Code,name as Name,admissionfee as AdFee,labfee as LabFee,libraryfee as LibFee,idcardfee as IDCardFee,regifee as RegiFee,onetimefee as TotalFee,(noofsemester * semesterfee) as TotalSemesterFee,(noofmonths * tuitionfee) as TotalTuitionFee, credit as Credit from tbl_department where storedstatus='I' OR storedstatus='U' order by id desc";
			    $sdep=$myDb->dump_query($sdq,'edit_depname.php','del_depname.php',$car[upd],$car[delt]);
		  ?>		          
          <p align="center">&nbsp;</p>
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
