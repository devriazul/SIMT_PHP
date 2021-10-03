<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $id=mysql_real_escape_string($_GET['id']);
  $vs="SELECT * FROM tbl_employeesalary WHERE storedstatus <>'D' AND id='$id'";
  $r=$myDb->select($vs);
  $row=$myDb->get_row($r,'MYSQL_ASSOC');
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manageemployeesalary.php' AND userid='$_SESSION[userid]'";
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
<script type="text/javascript" src="jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
/*$().ready(function() {
	$("#efname").autocomplete("search_empfac.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
});*/

$(function () {
  	$('#gsalary').keyup(function () {
	        $('#gsalary').focus();

			var TxtBox = document.getElementById("gsalary");
        	TxtBox.value = parseInt($("#basicpay").val()) + parseInt($("#houserent").val()) + parseInt($("#medallow").val()) + parseInt($("#tada").val()) + parseInt($("#otherallow").val()) + parseInt($("#increment").val());

        	
			var dedperday = document.getElementById("dedperday");
			dedperday.value= parseInt($(this).val()/30); //$("#workingdays").val()); //alert(dedperday);

			var totded = document.getElementById("totded");
			totded.value= parseInt($('#dedperday').val()) * parseInt($('#totabs').val())+".00"; //alert(dedperday);

			var netpay = document.getElementById("netpay");
			netpay.value= parseInt($(this).val())-(parseInt($('#dedperday').val()) * parseInt($('#totabs').val()))+".00"; //alert(dedperday);

			//var TxtBox = document.getElementById("sm");
        	//TxtBox.value = parseInt($("#basicpay").val());


	});



	$('#pfp').keyup(function () {
	        //$('#netpay').focus();

			var pfa = document.getElementById("pfa");
        	pfa.value = parseFloat($("#basicpay").val() * $("#pfp").val() / 100) + ".00"; //TxtBox.value = parseFloat(Math.round($("#gsalary").val() * 5 / 100)*100)/100).toFixed(2); 
        	//$('#netpay').focus();
			//alert(netpay);
			///var x = document.getElementById("netpay");
			///x.value= parseInt($(this).val())-(parseInt($('#totded').val())+".00"; //alert(dedperday);
	});

	$('#fb').keyup(function () {
	        //$('#netpay').focus();

			var netpay = document.getElementById("netpay");
        	netpay.value = (parseInt($("#gsalary").val()) + parseInt($("#fb").val())) - (parseInt($("#totded").val()) + parseInt($("#pfa").val()) + parseInt($("#securitymoney").val())) + ".00"; //TxtBox.value = parseFloat(Math.round($("#gsalary").val() * 5 / 100)*100)/100).toFixed(2); 
			$('#remarks').focus();
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
<script src="courseinformation.js" type="text/javascript"></script>

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
 <font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></font>

   		<form name="MyForm" action="ed_employeesalary.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data" onsubmit="">
          <div align="left">          <table width="100%" height="442" border="0" align="center" cellpadding="0" cellspacing="3" id="stdtbl">
 <tr bgcolor="#F5F5F5">
              <td height="27" colspan="6" class="style2" style="border-bottom:1px solid #CCCCCC; font-weight: bold; font-style: italic;">Edit Employee Salary </td>
              </tr>
            <tr>
            <tr>
              <td width="19%" height="20" class="style2">Month</td>
              <td width="1%"><div align="center"><span class="style2">:</span></div></td>
              <td width="29%" height="20"><input name="monthname" type="text" id="monthname" style="font-family: Verdana; width:120px; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['monthname']; ?>" />
                <input name="yearname" type="text" id="yearname" style="font-family: Verdana; width:60px; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['yearname']; ?>" /></td>
              <td width="18%"><span class="style2">Working Days </span></td>
              <td width="1%"><span class="style2">:</span></td>
              <td width="32%"><input name="workingdays" type="text" id="workingdays" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['tworkingdays']; ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Employee Name</td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><input name="efname" type="text" id="efname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['empname']; ?>" readonly="true" /></td>
              <td><span class="style2">Employee  ID</span></td>
              <td><span class="style2">:</span></td>
              <td><input name="efid" type="text" id="efid" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['empid']; ?>" readonly="true" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Designation</td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><input name="desig" type="text" id="desig" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['designation']; ?>" readonly="true" /></td>
              <td><span class="style2">Payscale</span></td>
              <td><span class="style2">:</span></td>
              <td><input name="payscale" type="text" id="payscale" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['payscale']; ?>" readonly="true" /></td>
            </tr>
            <tr bgcolor="#F5F5F5">
              <td height="20" colspan="6" class="style2" style="border-bottom:1px solid #CCCCCC;">Attendance &amp; Leave Information </td>
              </tr>
            <tr>
              <td height="20" class="style2">Late Attendance</td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><input name="lateattnd" id="lateattnd" type="text" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="15" value="<?php echo $row['lateattendance']; ?>" /></td>
              <td><span class="style2">Absent (In Office)</span></td>
              <td><span class="style2">:</span></td>
              <td><input name="absinoffice" type="text" id="absinoffice" value="<?php echo $row['absentinoffice']; ?>" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="21"><span class="style2">Total Absent</span></td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td><input name="totabs" type="text" id="totabs" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['totalabsent']; ?>" /></td>
              <td><span class="style2">Total Leave(CL/SL/AL)</span></td>
              <td><span class="style2">:</span></td>
              <td><input name="totleave" type="text" id="totleave" value="<?php echo $row['totalleave']; ?>" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr bgcolor="#F5F5F5">
              <td height="20" colspan="6" class="style2" style="border-bottom:1px solid #CCCCCC;">Salary Basic Information </td>
              </tr>
            <tr>
              <td height="20" class="style2">Basic Pay</td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><input name="basicpay" type="text" id="basicpay" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['basicpay']; ?>" readonly="true" /></td>
              <td><span class="style2">House Rent</span></td>
              <td><span class="style2">:</span></td>
              <td><input name="houserent" type="text" id="houserent" value="<?php echo $row['houserent']; ?>" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Medical Allowance</td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><input name="medallow" type="text" id="medallow" value="<?php echo $row['medicalallow']; ?>" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td><span class="style2">TA/ DA</span></td>
              <td><span class="style2">:</span></td>
              <td><input name="tada" type="text" id="tada" value="<?php echo $row['tada']; ?>" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Other Allowance</td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><input name="otherallow" type="text" id="otherallow" value="<?php echo $row['otherallow']; ?>" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td><span class="style2">Increment</span></td>
              <td><span class="style2">:</span></td>
              <td><input name="increment" type="text" id="increment" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="<?php echo $row['increment'];?>" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Gross Salary</td>
              <td>&nbsp;</td>
              <td height="20"><input name="gsalary" type="text" id="gsalary" value="<?php echo $row['grosssalary']; ?>" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td><span class="style2">Security Money :</span></td>
              <td>&nbsp;</td>
              <td><input name="securitymoney" type="text" id="securitymoney" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="<?php echo $row['securitymoney'];?>" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">DeductionPerDays(Amount)</td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><input name="dedperday" type="text" id="dedperday" value="<?php echo $row['dedperday']; ?>" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td><span class="style2">Total Deduction</span></td>
              <td><span class="style2">:</span></td>
              <td><input name="totded" type="text" id="totded" value="<?php echo $row['totded']; ?>" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="18"><span class="style2">Provident Fund (%)</span></td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td><input name="pfp" type="text" id="pfp" value="<?php echo $row['pfundpercent']; ?>" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td><span class="style2">Provident Fund(Amount)</span></td>
              <td><span class="style2">:</span></td>
              <td><input name="pfa" type="text" id="pfa" value="<?php echo $row['pfundamount']; ?>" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="18"><span class="style2">Festival Bonnus </span></td>
              <td>:</td>
              <td><input name="fb" type="text" id="fb" value="<?php echo $row['festivalbouns']; ?>" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td><input type="hidden" name="bankacc" id="bankacc" style="width:50px; font-size:10px; font-weight:bold;" value="<?php echo $row['bankaccno']; ?>" readonly="true"/></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="18">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr bgcolor="#AED7FF">
              <td height="18" colspan="3"><div align="right">Net Payable for this Month :</div></td>
              <td colspan="3"><input name="netpay" type="text" id="netpay" style="font-family: Verdana; font-size: 12pt; font-weight:bold; border: 1px solid #3399FF; height:23px;" onkeypress="return handleEnter(this, event)" value="<?php echo $row['netpay'];?>" size="29" readonly="true" />
                (DTB)</td>
              </tr>
            <tr>
              <td height="18">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="19">&nbsp;</td>
              <td>&nbsp;</td>
              <td><input type="submit" value="Update" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"> 
              <input type="reset" name="Submit" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>          
          </div>

            </form>
          <br />
            <p align="center"><div id="MyResult" align="center"></div>
</p>
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