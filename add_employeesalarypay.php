<?php ob_start();
session_start();
include('config.php'); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_employeesalarypay.php' AND userid='$_SESSION[userid]'";
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
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />


<script type="text/javascript">
/*$().ready(function() {
	$("#efname").autocomplete("search_ptemployee.php", {
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
*/
$(function () {
  	/*$('#gsalary').keyup(function () {
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
*/
	$('#otherallow').keyup(function () {
	        //$('#netpay').focus();

			var netpay = document.getElementById("netpay");
        	netpay.value = (parseInt($("#ttc").val()) * parseInt($("#tcr").val())) + (parseInt($("#tpc").val()) * parseInt($("#pcr").val())) + ".00"; //TxtBox.value = parseFloat(Math.round($("#gsalary").val() * 5 / 100)*100)/100).toFixed(2); 
			$('#remarks').focus();
	});


});
</script>

<script language="javascript">


 $(document).ready(function(event){
   $('.sbmt').click(function(){
     $('#shwL').show();   	   
	 $('#shwL').html("<img src='loader.gif' />");
   
     var arr=$('#frm').serializeArray();


	 if($('#smonth').val()=='Select Month'){
	   alert("Please select month.");
	   $('#smonth').focus();
	   $('.ui-state-default').css({'visibility':'collapse'});
	   return false;
	 }

	 if($('#accid').val()=='Select Account Head'){
	   alert("Please select one Account.");
	   $('#accid').focus();
	   $('.ui-state-default').css({'visibility':'collapse'});
	   return false;
	 }


	   
	 $.post('ins_empsalaypost_atatime.php',arr,function(result){
	 	$('#shw').html("<img src='loader.gif' />");
	    $('#shw').html(result);
		
	 });
	 $('#shw').hide().fadeIn('slow');
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





<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>


<style type="text/css">
<!--
.style17 {font-size: 18px}
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
      <form name="MyForm" id="frm" autocomplete="off"  method="post" >
          <div align="center"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="3" id="stdtbl">
            <tr>
              <td height="36" colspan="5" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">PAY  EMPLOYEE/ FACULTY SALARY &amp; POST INTO ACCOUNTS (<span class="stars">*</span>Mandatory Field) </span></td>
              </tr>
            <tr bgcolor="#F4F4FF">
              <td height="26" colspan="5" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><div align="center"><strong>Posting Information </strong></div></td>
              </tr>
            <tr>
              <td height="20" colspan="3" valign="top"><div style="background-color: #F4F4FF; width:100%; height:15px; font-size:10px; font-weight:bold; " align="center" id="shw"></div></td>
            </tr>
            <tr>
              <td height="20" class="style2"><div align="right"><strong>Posting Date <span style="font-size:12px; color:#FF0000;" #invalid_attr_id="Verdana, Arial, Helvetica, sans-serif">*</span></strong></div></td>
              <td><div align="center"><strong><span class="style4">:</span></strong></div></td>
              <td height="20" colspan="3" valign="top"><input type="date" name="voucherdate" id="voucherdate" size="30" value="<?php echo date("Y-m-d"); ?>" onkeypress="return handleEnter(this, event)"  ></td>
            </tr>
            <tr>
              <td width="40%" height="20" class="style2"><div align="right"><strong>Month <span style="font-size:12px; color:#FF0000;" #invalid_attr_id="Verdana, Arial, Helvetica, sans-serif">*</span> </strong></div></td>
              <td width="3%"><div align="center"><strong><span class="style4">:</span></strong></div></td>
              <td width="57%" height="20" colspan="3" valign="top"><select name="smonth" id="smonth" onkeypress="return handleEnter(this, event)" style="width:120px; ">
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
                <input name="syear" type="text" id="syear" style="font-family: Verdana; width:60px; height:18px;  font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo date("Y");?>" />                <span class="style2"> </span>                </td>
              </tr>
            <tr>
              <td height="34" class="style2"><div align="right"><strong>Pay From A/C  <span style="font-size:12px; color:#FF0000;" #invalid_attr_id="Verdana, Arial, Helvetica, sans-serif">*</span> </strong></div></td>
              <td><div align="center"><strong><span class="style4">:</span></strong></div></td>
              <td height="34" colspan="3"><select name="accid" id="accid" onkeypress="return handleEnter(this, event)">
                <option>Select Account Head</option>
                <?php $hq=$myDb->select("Select * From tbl_accchart Where parentid in('1879')");
				   while($hrow=$myDb->get_row($hq,'MYSQL_ASSOC')){
				   ?>
                <option value="<?php echo $hrow['accname']; ?>"><?php echo $hrow['accname']; ?></option>
                <?php } ?>
              </select></td>
              </tr>
            <tr bgcolor="#F4F4FF">
              <td height="33" colspan="5" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><div align="center">
                <input name="button" type="button" class="sbmt" style="color: #000000; height:25px; text-decoration:underline; font-weight:bold; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" value="Click here to Pay Salary" />
              </div></td>
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