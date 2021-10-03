<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
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


<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript">
$(document).ready(function() {	

		var id = '#dialog';
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 	
	
	//if close button is clicked
	$('.window .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});		
	
});

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
			$("#opdate").datepicker($.datepicker);

			
			//$("#datepicker-3").datepicker($.datepicker.regional["de"]).datepicker("option", {
			//	changeMonth: true,
			//	changeYear: true
			//});
		});
	</script>




<style type="text/css">
body {
font-family:verdana;
font-size:15px;
}

a {color:#333; text-decoration:none}
a:hover {color:#ccc; text-decoration:none}

#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#000;
  display:none;
}  
#boxes .window {
  position:absolute;
  left:0;
  top:0;
  width:440px;
  height:200px;
  display:none;
  z-index:9999;
  padding:20px;
}
#boxes #dialog {
  width:500px; 
  height:200px;
  padding:10px;
  background-color:#ffffff;
}
</style>


<style type="text/css">
<!--
@import url("main.css");

-->
</style>
<script language="javascript" src="jquery-1.4.2.js"></script>
<script type="text/javascript" src="jquery.js"></script>

<script language="javascript">
 $(document).ready(function(){
     $('#smonth').change(function(){
         var smonth=$('#smonth').val();
         var arr=$('#frm').serializeArray();
        $.post('monthdayscount.php?smonth='+smonth,arr,function(rec){
           $('#workingdays').val(rec);
        });
     });
  });

</script>



<script language="javascript">
 $(document).ready(function(){
     	   $('#efname').keyup(function(){
	      var p=$('#efname').val();
	      $.get('pick_staff.php?p='+p,function(rec){
		  
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
		//--load Designation----------
		$('#efid').blur(function(){
			var efid=$('#efid').val();
			var arr=$('#MyForm').serializeArray();
			$.post('loaddesigpt.php?efid='+efid,arr,function(rec){
			   //$('#desig').load('loaddataforsalary.php?efid='+efid);
                    $('#desig').val($.trim(rec));
                     
			});$('#increment').focus();
		 });
		 
		//--load Bank account----------
		$('#efid').blur(function(){
			var efid=$('#efid').val();
			var arr=$('#MyForm').serializeArray();
			$.post('loadbankacc.php?efid='+efid,arr,function(rec){
			   //$('#desig').load('loaddataforsalary.php?efid='+efid);
                    $('#bankacc').val($.trim(rec));
                     
			});
		 });
		 
		//---------load Paysacle-------
		$('#efid').blur(function(){
			var efid=$('#efid').val();
 			var arr=$('#MyForm').serializeArray();
			$.post('loadpayscale.php?efid='+efid,arr,function(rec){
			   //$('#desig').load('loaddataforsalary.php?efid='+efid);
                     $('#payscale').val($.trim(rec));
                     
			});
		 });
		//---------load Basicpay-------
		$('#efid').blur(function(){
			var efid=$('#efid').val();
 			var arr=$('#MyForm').serializeArray();
			$.post('loadbasicpay.php?efid='+efid,arr,function(rec){
			   //$('#desig').load('loaddataforsalary.php?efid='+efid);
                    //var str= $('#basicpay').val(rec); 
					//str=$.trim(str);
					$('#basicpay').val($.trim(rec));
					$('#sm').val($.trim(rec));
                     
			});
		 });
	
		//---------load houserent-------
		$('#efid').blur(function(){
			var efid=$('#efid').val();
 			var arr=$('#MyForm').serializeArray();
			$.post('loadhouserent.php?efid='+efid,arr,function(rec){
			   //$('#desig').load('loaddataforsalary.php?efid='+efid);
                    //var str= $('#basicpay').val(rec); 
					//str=$.trim(str);
					$('#houserent').val($.trim(rec));
                     
			});
		 });

		//---------load PF-------
		$('#efid').blur(function(){
			var efid=$('#efid').val();
 			var arr=$('#MyForm').serializeArray();
			$.post('loadpfp.php?efid='+efid,arr,function(rec){
			   //$('#desig').load('loaddataforsalary.php?efid='+efid);
                    //var str= $('#basicpay').val(rec); 
					//str=$.trim(str);
					$('#pfp').val($.trim(rec));
                     
			});
		 });


		//---------load medical allow-------
		$('#efid').blur(function(){
			var efid=$('#efid').val();
 			var arr=$('#MyForm').serializeArray();
			$.post('loadmedallow.php?efid='+efid,arr,function(rec){
			   //$('#desig').load('loaddataforsalary.php?efid='+efid);
                    //var str= $('#basicpay').val(rec); 
					//str=$.trim(str);
					$('#medallow').val($.trim(rec));
                     
			});
		 });

		//---------load TA/DA-------
		$('#efid').blur(function(){
			var efid=$('#efid').val();
 			var arr=$('#MyForm').serializeArray();
			$.post('loadtada.php?efid='+efid,arr,function(rec){
			   //$('#desig').load('loaddataforsalary.php?efid='+efid);
                    //var str= $('#basicpay').val(rec); 
					//str=$.trim(str);
					$('#tada').val($.trim(rec));
                     
			});
		 });

		//---------load other allow-------
		$('#efid').blur(function(){
			var efid=$('#efid').val();
 			var arr=$('#MyForm').serializeArray();
			$.post('loadotherallow.php?efid='+efid,arr,function(rec){
			   //$('#desig').load('loaddataforsalary.php?efid='+efid);
                    //var str= $('#basicpay').val(rec); 
					//str=$.trim(str);
					$('#otherallow').val($.trim(rec));
                     
			});
		 });

		//---------load Total Leave-------
		$('#efid').blur(function(){
			var efid=$('#efid').val();
			var smonth=$('#smonth').val(); 
			var syear=$('#syear').val(); 
 			var arr=$('#MyForm').serializeArray();
			$.post('loadtotleave.php?efid='+efid+'&smonth='+smonth+'&syear='+syear,arr,function(rec){
			   //$('#desig').load('loaddataforsalary.php?efid='+efid);
                    //var str= $('#basicpay').val(rec); 
					//str=$.trim(str);
					$('#totleave').val($.trim(rec));
                     
			});
		 });

		//---------load Join Date-------
		$('#efid').blur(function(){
			var efid=$('#efid').val();
			var smonth=$('#smonth').val(); 
			var syear=$('#syear').val(); 
 			var arr=$('#MyForm').serializeArray();
			$.post('loadjoindate.php?efid='+efid+'&smonth='+smonth+'&syear='+syear,arr,function(rec){
			   //$('#desig').load('loaddataforsalary.php?efid='+efid);
                    //var str= $('#basicpay').val(rec); 
					//str=$.trim(str);
					$('#joindate').val($.trim(rec));
                     
			});
		 });

		//---------load Security Money paid-------
		$('#efid').blur(function(){
			var efid=$('#efid').val();
			var smonth=$('#smonth').val(); 
			var syear=$('#syear').val(); 
 			var arr=$('#MyForm').serializeArray();
			$.post('loadsecuritymoneypaid.php?efid='+efid+'&smonth='+smonth+'&syear='+syear,arr,function(rec){
			   //$('#desig').load('loaddataforsalary.php?efid='+efid);
                    //var str= $('#basicpay').val(rec); 
					//str=$.trim(str);
					parseInt($('#smp').val($.trim(rec)));
                     
			});
		 });

		//---------load default Holiday-------
		$('#efid').blur(function(){
			var efid=$('#efid').val();
			var smonth=$('#smonth').val(); 
			var syear=$('#syear').val(); 
 			var arr=$('#MyForm').serializeArray();
			$.post('loaddefaultholiday.php?efid='+efid+'&smonth='+smonth+'&syear='+syear,arr,function(rec){
			   //$('#desig').load('loaddataforsalary.php?efid='+efid);
                    //var str= $('#basicpay').val(rec); 
					//str=$.trim(str);
					$('#tothol').val($.trim(rec));
                     
			});
		 });


		//---------load Late Present-------
		$('#efid').blur(function(){
			var efid=$('#efid').val();
			var smonth=$('#smonth').val(); 
			var syear=$('#syear').val(); 
 			var arr=$('#MyForm').serializeArray();
			$.post('loadlateattnd.php?efid='+efid+'&smonth='+smonth+'&syear='+syear,arr,function(rec){
			   //$('#desig').load('loaddataforsalary.php?efid='+efid);
                    //var str= $('#basicpay').val(rec); 
					//str=$.trim(str);
					$('#lateattnd').val($.trim(rec));
                     
			});
		 });


		//---------load Absent in Office-------
		$('#efid').blur(function(){
			var efid=$('#efid').val();
			var smonth=$('#smonth').val(); 
			var syear=$('#syear').val(); 
 			var arr=$('#MyForm').serializeArray();
			$.post('loadabsentinoffice.php?efid='+efid+'&smonth='+smonth+'&syear='+syear,arr,function(rec){
			   //$('#desig').load('loaddataforsalary.php?efid='+efid);
                    //var str= $('#basicpay').val(rec); 
					//str=$.trim(str);
					$('#absinoffice').val($.trim(rec));
                     
			});
		 });

/*
		//---------load Late Present day deductioin-------
		$('#efid').blur(function(){
			var efid=$('#efid').val();
			var smonth=$('#smonth').val(); 
			var syear=$('#syear').val(); 
 			var arr=$('#MyForm').serializeArray();
			$.post('loadlpdd.php?efid='+efid+'&smonth='+smonth+'&syear='+syear,arr,function(rec){
			   //$('#desig').load('loaddataforsalary.php?efid='+efid);
                    //var str= $('#basicpay').val(rec); 
					//str=$.trim(str);
					$('#lpdd').val($.trim(rec));
                     
			});
		 });
*/




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
			
			//var ta = document.getElementById("totabs");
			//ta.value= parseInt($('#totabs').val())-parseInt($('#totleave').val()); //alert(dedperday);
                     
			});

		 });
		 
		/* 
		 	$('#efid').blur(function(){
	        
				//var pfa = document.getElementById("pfa");
        		$('#pfa').val(parseFloat($("#basicpay").val() * $("#pfp").val() / 100) + ".00"); //TxtBox.value = parseFloat(Math.round($("#gsalary").val() * 5 / 100)*100)/100).toFixed(2); 
			});
		*/



  });

</script>

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

	$('#dedperday').keyup(function () {
	        $('#dedperday').focus();

			//var dedperday = document.getElementById("dedperday");
			//dedperday.value= parseInt($(this).val()/30); //$("#workingdays").val()); //alert(dedperday);

			var totded = document.getElementById("totded");
			totded.value= parseInt($('#dedperday').val()) * parseInt($('#totabs').val())+".00"; //alert(dedperday);

			//var netpay = document.getElementById("netpay");
			//netpay.value= parseInt($(this).val())-(parseInt($('#dedperday').val()) * parseInt($('#totabs').val()))+".00"; //alert(dedperday);

			//var TxtBox = document.getElementById("sm");
        	//TxtBox.value = parseInt($("#basicpay").val());


	});


	$('#gsalary').keyup(function () {
	        //$('#netpay').focus();

			var pfa = document.getElementById("pfa");
        	pfa.value = parseFloat($("#basicpay").val() * $("#pfp").val() / 100) + ".00"; //TxtBox.value = parseFloat(Math.round($("#gsalary").val() * 5 / 100)*100)/100).toFixed(2); 
        	//$('#netpay').focus();
			//alert(netpay);
			///var x = document.getElementById("netpay");
			///x.value= parseInt($(this).val())-(parseInt($('#totded').val())+".00"; //alert(dedperday);
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
			//$('#remarks').focus();
	});


});
</script>


<script language="javascript">


 $(document).ready(function(event){
   $('.sbmt').click(function(){
   
     var arr=$('#frm').serializeArray();


	 if($('#smonth').val()=='Select Month'){
	   alert("Please select month.");
	   $('#smonth').focus();
	   $('.ui-state-default').css({'visibility':'collapse'});
	   return false;
	 }

	 if($('#efname').val()==''){
	   alert("Please select Employee/ Faculty.");
	   $('#efname').focus();
	   $('.ui-state-default').css({'visibility':'collapse'});
	   return false;
	 }

	 if($('#efid').val()==''){
	   alert("Please select Employee/ Faculty ID.");
	   $('#efid').focus();
	   $('.ui-state-default').css({'visibility':'collapse'});
	   return false;
	 }

	 if($('#netpay').val()==''){
	   alert("Can't continue without Netpay.");
	   $('#netpay').focus();
	   $('.ui-state-default').css({'visibility':'collapse'});
	   return false;
	 }

	   
	 $.post('ins_employeesalary.php',arr,function(result){
	    $('#shw').html(result);
		
		 $('#efid').val('');
		 $('#efname').val('');
		 $('#desig').val('');
		 $('#payscale').val('');
		 $('#lateattnd').val('0');
		 $('#absinoffice').val('0');
		 $('#tothol').val('0');
		 $('#totabs').val('0');
		 $('#totleave').val('0');
		 $('#joindate').val('');
		 $('#smp').val('');
		 $('#sm').val('');
		 $('#increment').val('0');
		 $('#gsalary').val('');
		 $('#basicpay').val('');
		 $('#medallow').val('');
		 $('#houserent').val('');
		 $('#tada').val('');
		 $('#otherallow').val('');
		 $('#securitymoney').val('0');
		 $('#fb').val('0');
		 $('#dedperday').val('');
		 $('#totded').val('');
		 $('#pfp').val('');
		 $('#pfa').val('0');
		 $('#bankacc').val('');
		 $('#remarks').val('');
		 $('#netpay').val('');
		 $('#smonth').focus();

		
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
.style19 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
</head>

<body>
<div id="boxes">
<div style="top: 199.5px; left: 551.5px; display: none;" id="dialog" class="window">
<a href="#" class="close" style="margin-left:500px;"><img src="images/cross.jpg" /></a></br>
<div style="background:#5A5A5A; color:#B1B193; font-family:Arial; font-size:12px; padding:5px 5px;"><span>Read the following message carefully...</span></div>
<span style="font-size:18px; font-weight:bold; text-decoration:underline;">Attention:</span>
</br></br><span style="color:#FF0000; text-align:center; font-weight:bold; ">Please make sure that you update all the necessary information of a Employee/ Faculty (realted to salary, 
i.e: Salary in Bank/ Cash) before you give entry into salary sheet. Because this entry will hit directly to accounts.
</span></div>
<!-- Mask to cover the whole screen -->
<div style="width: 1478px; height: 602px; display: none; opacity: 1.0;" id="mask"></div>

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
          <div align="center">            
		  <table width="99%" border="0" align="center" cellpadding="0" cellspacing="3" id="stdtbl">
            <tr>
              <td height="36" colspan="4" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">ADD EMPLOYEE SALARY (<span class="stars">*</span>Mandatory Field) </span>
			  </br><div style="background-color: #F4F4FF; width:100%; height:20px; font-size:10px; font-weight:bold; " align="center" id="shw"></div>
			  </td>
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
              <td width="27%"><input name="workingdays" type="text" id="workingdays" style="font-family: Verdana; text-align:center; width:60px; font-size: 10pt; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" readonly="true" />
                <input name="opdate" type="text" class="style15" id="opdate" style="width:90px; " onkeypress="return handleEnter(this, event)" value="<?php echo date("Y-m-d"); ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Employee/Faculty Name :<span class="stars">*</span> </td>
              <td height="20"><input name="efname" type="text" id="efname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td><span class="style2">Employee ID  :<span class="stars">*</span></span></td>
              <td><input name="efid" type="text" id="efid"  style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" readonly="true" />
                <input name="desig" type="hidden" id="desig" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" readonly="true" />
                <input name="payscale" type="hidden" id="payscale" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" readonly="true" />
</td>
            </tr>
            <tr bgcolor="#F4F4FF" >
              <td height="27" colspan="4" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><div align="center" ><strong>Attendance &amp; Leave  Information</strong></div></td>
              </tr>
            <tr>
              <td height="20" class="style2">Total Absent :<span class="stars">*</span></td>
              <td height="20"><input name="lateattnd" type="hidden" id="lateattnd" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="0" size="29" /> <input name="absinoffice" type="hidden" id="absinoffice" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="0" size="29" /> <input name="tothol" type="hidden" id="tothol" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="0" size="29" />                <input name="totabs" type="text" id="totabs" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="0" size="29"  /></td>
              <td><span class="style2">Total Leave(CL/SL/AL) :<span class="stars">*</span></span></td>
              <td><input name="totleave" type="text" id="totleave" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="0" size="29" readonly="true" /></td>
            </tr>
            <tr bgcolor="#F4F4FF">
              <td height="33" colspan="4" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><div align="center"><strong>Salary Basic Information</strong></div></td>
              </tr>
            <tr bgcolor="#F4F4FF">
              <td height="26" colspan="4" style="padding:3px; border-bottom:1px solid #CCCCCC;"><div align="center"><span style="font-size:12px; color:#FF0000; font-weight:bold; ">His/ Her joining date was:
                    <span style="font-size:12px; color:#FF0000; font-weight:bold; ">
                    <input type="text" name="joindate" id="joindate" style="width:70px; font-weight:bold; font-size:10px;" readonly="true"/>
                    </span>                . So far he/ she paid Security Money:<span style="font-size:12px; color:#FF0000; font-weight:bold; ">
                <input type="text" name="smp" id="smp" style="width:50px; font-size:10px; font-weight:bold;" readonly="true"/>
                </span> tk. out of :<span style="font-size:12px; color:#FF0000; font-weight:bold; ">
                <input type="text" name="sm" id="sm" style="width:50px; font-size:10px; font-weight:bold;" readonly="true"/>
                </span> tk. </span></div></td>
              </tr>
            <tr>
              <td height="20" class="style2">Increment:</td>
              <td height="20"><input name="increment" type="text" id="increment" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="0" size="29" />
                <input name="basicpay" type="hidden" id="basicpay" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" />
                <input name="medallow" type="hidden" id="medallow" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" />
                <input name="houserent" type="hidden" id="houserent" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" />
                <input name="tada" type="hidden" id="tada" style="font-family: Verdana; font-size: 8pt;  border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" />
                <input name="otherallow" type="hidden" id="otherallow" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td><span class="style2">Gross Salary :<span class="stars">*</span></span></td>
              <td><input name="gsalary" type="text" id="gsalary" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Provident Fund  :</td>
              <td height="20"><input name="pfp" type="text" id="pfp" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"  size="29" /></td>
              <td height="20" class="style2">Security Money :</td>
              <td><input name="securitymoney" type="text" id="securitymoney" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="0" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2"><p>
                Deduction/Day:</p>                </td>
              <td height="20">                  <input name="dedperday" type="text" id="dedperday" style="font-family: Verdana; font-size: 8pt; color:#FF0000; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" />
                  <input name="totded" type="text" id="totded" style="font-family: Verdana; font-size: 10pt; color:#FF0000; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" />
                  <input name="pfa" type="hidden" id="pfa" style="font-family: Verdana; font-size: 10pt; color:#00CC33; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="0" size="29" />
                  <span style="font-size:12px; color:#FF0000; font-weight:bold; "><span style="font-size:12px; color:#FF0000; font-weight:bold; ">
                  <input type="hidden" name="bankacc" id="bankacc" style="width:50px; font-size:10px; font-weight:bold;" readonly="true"/>
                </span></span></td><td><span class="style2">Festival Bonus :</span></td>
              <td><input name="fb" type="text" id="fb" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" value="0" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Remarks :</td>
              <td height="20" colspan="3"><textarea name="remarks" id="remarks" style="width:98%; height:30px; "></textarea></td>
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
              <td><input name="button" type="button" class="sbmt" style="color: #000000; height:25px; text-decoration:underline; font-weight:bold; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" value="Submit Salary" /> </td>
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