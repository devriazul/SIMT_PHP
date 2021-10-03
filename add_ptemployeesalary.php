<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manageptemployeesalary.php' AND userid='$_SESSION[userid]'";
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
<script type='text/javascript' src='jquery.autocomplete.js'></script>

<script type="text/javascript" src="jquery.js"></script>

<script language="javascript">
 $(document).ready(function(){
     $('#smonth').change(function(){
         var smonth=$('#smonth').val();
         var arr=$('#frm').serializeArray();
        $.post('monthdayscount.php?smonth='+smonth,arr,function(rec){
           $('#workingdays').val(rec);
		   $('#efname').focus();
        });
     });
  });

</script>



<script language="javascript">
$(document).ready(function(){
     	   $('#efname').keyup(function(){
	      var p=$('#efname').val();
	      $.get('pick_ptstaff.php?p='+p,function(rec){
		  
		    $('#showpick').show();
		    $('#showpick').html(rec);
		  });
		  $('#showpick').fadeIn('slow');
		  $('#showpick').html("<img src='bigLoader.gif' />");

	   });



	   
	    $('#efname').keypress(function(e){
			   if(e.which==13){
			      $('#selectmenu').focus();
			   }	  
			 
		}); 
		
		//--load Theory Class Rate----------

		$('#efid').blur(function(){

			var efname=$('#efname').val();
			var arr=$('#MyForm').serializeArray();
			$.post('loadtheoryamountrate.php?efname='+efname,arr,function(rec){
			   //$('#desig').load('loaddataforsalary.php?efid='+efid);
                    $('#tcr').val($.trim(rec));
                     
			});
		 });

		//--load Parctical Class Rate----------
		$('#efid').blur(function(){
			var efname=$('#efname').val();
			var arr=$('#MyForm').serializeArray();
			$.post('loadpracticalamountrate.php?efname='+efname,arr,function(rec){
			   //$('#desig').load('loaddataforsalary.php?efid='+efid);
                    $('#pcr').val($.trim(rec));
                     
			});
		 });

		//--load Designation----------
		$('#efid').blur(function(){
			var efid=$('#efid').val();
			var arr=$('#MyForm').serializeArray();
			$.post('loaddesigpt.php?efid='+efid,arr,function(rec){
			   //$('#desig').load('loaddataforsalary.php?efid='+efid);
                    $('#desig').val($.trim(rec));
                     
			});
		 });

/*

		//---------load Total Absent-------
		$('#efid').blur(function(){
			var efid=$('#efid').val();
			var smonth=$('#smonth').val(); 
			var syear=$('#syear').val(); 
			var workingdays=$('#workingdays').val(); 
			//var tl=$('#totleave').val(); 
 			var arr=$('#MyForm').serializeArray();
			$.post('loadtotabs.php?efid='+efid+'&smonth='+smonth+'&syear='+syear+'&wd='+workingdays,arr,function(rec){
			   //$('#desig').load('loaddataforsalary.php?efid='+efid);
                    //var str= $('#basicpay').val(rec); 
					//str=$.trim(str);
					$('#totabs').val($.trim(rec));

			var ta = document.getElementById("totabs");
			ta.value= parseInt($('#totabs').val())-parseInt($('#totleave').val()); //alert(dedperday);
                     
			});

		 });

*/
  });

</script>

<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />


<script type="text/javascript">
$(function () {
	$('#otherallow').keyup(function () {
	        //$('#netpay').focus();

			var netpay = document.getElementById("netpay");
        	netpay.value = (parseInt($("#ttc").val()) * parseInt($("#tcr").val())) + (parseInt($("#tpc").val()) * parseInt($("#pcr").val())) + ".00"; //TxtBox.value = parseFloat(Math.round($("#gsalary").val() * 5 / 100)*100)/100).toFixed(2); 
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

	function checksalarydata()
	{
		if(document.getElementById("smonth").value=='Select Month'){
			alert('Please select a Month first.');
			document.getElementById("smonth").focus();
	     	return false;
		 
	    }

		if(document.getElementById("workingdays").value==''){
		alert('Working Days can not left empty');
		 document.getElementById("workingdays").focus();
	     return false;
		 
	    }
	
		if(document.getElementById("efid").value==''){
		alert('EmployeeID can not left empty');
		 document.getElementById("efname").focus();
	     return false;
		 
	    }

		if(document.getElementById("netpay").value==''){
		alert('Net Salary can not left empty');
		 document.getElementById("netpay").focus();
	     return false;
		 
	    }


		
		if(document.getElementById("mealcharge").value=='0'){
		alert('Mealcharge can not be zero');
		 document.getElementById("mealcharge").focus();
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
   		<form name="MyForm" id="frm" action="ins_ptemployeesalary.php" method="post" enctype="multipart/form-data" onsubmit="Javascript:return checksalarydata();">
          <div align="center">            <table width="99%" border="0" align="center" cellpadding="0" cellspacing="3" id="stdtbl">

            <tr>
              <td height="36" colspan="4" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">ADD PART TIME EMPLOYEE SALARY (<span class="stars">*</span>Mandatory Field) </span></td>
              </tr>
            <tr bgcolor="#F4F4FF">
              <td height="26" colspan="4" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><div align="center"><strong>General Information </strong></div></td>
              </tr>
            <tr>
              <td width="26%" height="20" class="style2">Month :<span class="stars">*</span> </td>
              <td width="27%" height="20" valign="top"><select name="smonth" id="smonth" onkeypress="return handleEnter(this, event)" style="width:120px; ">
                <option value="Select Month" selected="selected">Select Month</option>
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
                            </select>                  
                <input name="syear" type="text" id="syear" style="font-family: Verdana; width:60px; height:18px; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo date("Y");?>" /></td>
              <td width="20%"><span class="style2"> Days (Monthly):<span class="stars">*</span></span>
                <div id="shw"></div></td>
              <td width="27%"><input name="workingdays" type="text" id="workingdays" style="font-family: Verdana; width:50px; font-size: 10pt; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" readonly="true" />
			                  <input name="opdate" type="text" class="style15" id="opdate" style="width:90px; " onkeypress="return handleEnter(this, event)" value="<?php echo date("Y-m-d"); ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Employee/Faculty Name :<span class="stars">*</span> </td>
              <td height="20"><input name="efname" type="text" id="efname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td><span class="style2">Designation :<span class="stars">*</span></span></td>
              <td>
			  <input name="efid" type="text" id="efid" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF; width:35px;" onkeypress="return handleEnter(this, event)" size="29" readonly="true" />
			  <input name="desig" type="text" id="desig" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF; width:145px;" onkeypress="return handleEnter(this, event)" size="29" />
                </td>
            </tr>
            <tr bgcolor="#F4F4FF">
              <td height="33" colspan="4" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><div align="center"><strong>Salary Basic Information</strong></div></td>
              </tr>
            <tr>
              <td height="20" class="style2">Total No. of Theory Class :<span class="stars">*</span> </td>
              <td height="20"><input name="ttc" type="text" id="ttc" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td><span class="style2">Theory Rate(/Class) :<span class="stars">*</span></span></td>
              <td><input name="tcr" type="text" id="tcr" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Total No. of Practical Class :<span class="stars">*</span> </td>
              <td height="20"><input name="tpc" type="text" id="tpc" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td><span class="style2">Practical Rate(/class) :<span class="stars">*</span></span></td>
              <td><input name="pcr" type="text" id="pcr" style="font-family: Verdana; font-size: 8pt;  border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Others :<span class="stars">*</span> </td>
              <td height="20"><input name="otherallow" type="text" id="otherallow" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="0" size="29" /></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="20" class="style2">Remarks :</td>
              <td height="20" colspan="3"><textarea name="remarks" id="remarks" style="width:98%; height:30px; " onkeypress="return handleEnter(this, event)"></textarea></td>
              </tr>
            <tr bgcolor="#DFF4FF">
              <td height="31" colspan="2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><div align="right" class="style19"><span style="font-size:16px; font-weight:bold; ">Net Payable for this Month : </span></div></td>
              <td colspan="2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><input name="netpay" type="text" id="netpay" style="font-family: Verdana; font-size: 12pt; font-weight:bold; border: 1px solid #3399FF; height:23px;" onkeypress="return handleEnter(this, event)" size="29" readonly="true" /><span style="font:'Trebuchet MS'; font-size:16px; font-weight:bold; "> (BDT) </span></td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" value="Submit" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"> <input type="reset" name="Submit2" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/></td>
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