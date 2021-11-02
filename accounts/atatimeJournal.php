<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='voucherEntry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  				//$timezone = "Asia/Dhaka";
                //if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);  

 $products = null;
 @$_SESSION['vdate']=$_SESSION['vdate']?$_SESSION['vdate']:date("Y-m-d");


if (!empty($_SESSION['products'])) {
	$products = $_SESSION['products'];
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
<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
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
<script language="javascript">
 $(document).ready(function(){
   $('#submit-btn1').click(function(){
     $('#shwj1').show();   	   
	 $('#shwj1').html("<img src='loader.gif' />");

     var arr=$('#jfrm').serializeArray();
     $.post("ins_atatimejournal.php",arr,function(r){
	   $('#shwj1').html(r);
	 
	 });
   });	 
	 
   $('#submit-btn2').click(function(){
     $('#shwj2').show();   	   
	 $('#shwj2').html("<img src='loader.gif' />");
	 
     var arr=$('#jfrm2').serializeArray();
     $.post("ins_atatimejournal2.php",arr,function(r){
	   $('#shwj2').html(r);
	 
	 });
   }); 
	 
	 
   $('#submit-btn3').click(function(){
     $('#shwj3').show();   	   
	 $('#shwj3').html("<img src='loader.gif' />");
	 
     var arr=$('#jfrm3').serializeArray();
     $.post("ins_atatimejournal3.php",arr,function(r){
	   $('#shwj3').html(r);
	 
	 });
   }); 
	   
	 
   $('#submit-btn4').click(function(){
     $('#shwj4').show();   	   
	 $('#shwj4').html("<img src='loader.gif' />");
	 
     var arr=$('#jfrm4').serializeArray();
     $.post("ins_atatimejournal4.php",arr,function(r){
	   $('#shwj4').html(r);
	 
	 });
   }); 
	   
	 
   $('#submit-btn5').click(function(){
     $('#shwj5').show();   	   
	 $('#shwj5').html("<img src='loader.gif' />");
	 
     var arr=$('#jfrm5').serializeArray();
     $.post("ins_atatimejournal5.php",arr,function(r){
	   $('#shwj5').html(r);
	 
	 });
   }); 


	 
   $('#submit-btn6').click(function(){
     $('#shwj6').show();   	   
	 $('#shwj6').html("<img src='loader.gif' />");
	 
     var arr=$('#jfrm6').serializeArray();
     $.post("ins_atatimejournal6.php",arr,function(r){
	   $('#shwj6').html(r);
	 
	 });
   }); 

   $('#submit-btn7').click(function(){
     $('#shwj7').show();   	   
	 $('#shwj7').html("<img src='loader.gif' />");
	 
     var arr=$('#jfrm7').serializeArray();
     $.post("ins_atatimejournal7.php",arr,function(r){
	   $('#shwj7').html(r);
	 
	 });
   }); 
	 
   $('#submit-btn8').click(function(){
     $('#shwj8').show();   	   
	 $('#shwj8').html("<img src='loader.gif' />");
	 
     var arr=$('#jfrm8').serializeArray();
     $.post("ins_atatimejournal8.php",arr,function(r){
	   $('#shwj8').html(r);
	 
	 });
   }); 

   
   $('#1st').click(function(){
   	 $('#shwj1').hide();
   	 $('#shwj2').hide();
   	 $('#shwj3').hide();
   	 $('#shwj4').hide();
   	 $('#shwj5').hide();
   	 $('#shwj6').hide();
   	 $('#shwj7').hide();
   	 $('#shwj8').hide();
     $('#1stfrm').fadeOut( function(){ $(this).fadeIn(),"slow"});
	 $('#2ndfrm').hide();
	 $('#3rdfrm').hide();
	 $('#4thfrm').hide();
	 $('#5thfrm').hide();
	 $('#6thfrm').hide();
	 $('#7thfrm').hide();
	 $('#8thfrm').hide();
   
   });
   
   $('#2nd').click(function(){
   	 $('#shwj1').hide();
   	 $('#shwj2').hide();
   	 $('#shwj3').hide();
   	 $('#shwj4').hide();
   	 $('#shwj5').hide();
   	 $('#shwj6').hide();
   	 $('#shwj7').hide();
   	 $('#shwj8').hide();
     $('#1stfrm').hide();
	 $('#2ndfrm').fadeOut(function(){ $(this).fadeIn(); });
	 $('#3rdfrm').hide();
	 $('#4thfrm').hide();
	 $('#5thfrm').hide();
	 $('#6thfrm').hide();
	 $('#7thfrm').hide();
	 $('#8thfrm').hide();
   
   });
   $('#3rd').click(function(){
   	 $('#shwj1').hide();
   	 $('#shwj2').hide();
   	 $('#shwj3').hide();
   	 $('#shwj4').hide();
   	 $('#shwj5').hide();
   	 $('#shwj6').hide();
   	 $('#shwj7').hide();
   	 $('#shwj8').hide();
     $('#1stfrm').hide();
	 $('#2ndfrm').hide();
	 $('#3rdfrm').fadeOut(function(){ $(this).fadeIn(); });
	 $('#4thfrm').hide();
	 $('#5thfrm').hide();
	 $('#6thfrm').hide();
	 $('#7thfrm').hide();
	 $('#8thfrm').hide();
   
   });
   $('#4th').click(function(){
   	 $('#shwj1').hide();
   	 $('#shwj2').hide();
   	 $('#shwj3').hide();
   	 $('#shwj4').hide();
   	 $('#shwj5').hide();
   	 $('#shwj6').hide();
   	 $('#shwj7').hide();
   	 $('#shwj8').hide();
     $('#1stfrm').hide();
	 $('#2ndfrm').hide();
	 $('#3rdfrm').hide();
	 $('#4thfrm').fadeOut(function(){ $(this).fadeIn(); });
	 $('#5thfrm').hide();
	 $('#6thfrm').hide();
	 $('#7thfrm').hide();
	 $('#8thfrm').hide();
   
   });
   
   $('#5th').click(function(){
   	 $('#shwj1').hide();
   	 $('#shwj2').hide();
   	 $('#shwj3').hide();
   	 $('#shwj4').hide();
   	 $('#shwj5').hide();
   	 $('#shwj6').hide();
   	 $('#shwj7').hide();
   	 $('#shwj8').hide();
     $('#1stfrm').hide();
	 $('#2ndfrm').hide();
	 $('#3rdfrm').hide();
	 $('#4thfrm').hide();
	 $('#5thfrm').fadeOut(function(){ $(this).fadeIn()});
	 $('#6thfrm').hide();
	 $('#7thfrm').hide();
	 $('#8thfrm').hide();
   
   });
   
   $('#6th').click(function(){
   	 $('#shwj1').hide();
   	 $('#shwj2').hide();
   	 $('#shwj3').hide();
   	 $('#shwj4').hide();
   	 $('#shwj5').hide();
   	 $('#shwj6').hide();
   	 $('#shwj7').hide();
   	 $('#shwj8').hide();
     $('#1stfrm').hide();
	 $('#2ndfrm').hide();
	 $('#3rdfrm').hide();
	 $('#4thfrm').hide();
	 $('#5thfrm').hide();
	 $('#6thfrm').fadeOut(function(){ $(this).fadeIn() });
	 $('#7thfrm').hide();
	 $('#8thfrm').hide();
   
   });
   
   $('#7th').click(function(){
   	 $('#shwj1').hide();
   	 $('#shwj2').hide();
   	 $('#shwj3').hide();
   	 $('#shwj4').hide();
   	 $('#shwj5').hide();
   	 $('#shwj6').hide();
   	 $('#shwj7').hide();
   	 $('#shwj8').hide();
     $('#1stfrm').hide();
	 $('#2ndfrm').hide();
	 $('#3rdfrm').hide();
	 $('#4thfrm').hide();
	 $('#5thfrm').hide();
	 $('#6thfrm').hide();
	 $('#7thfrm').fadeOut(function(){ $(this).fadeIn() });
	 $('#8thfrm').hide();
   
   });
   
   $('#8th').click(function(){
   	 $('#shwj1').hide();
   	 $('#shwj2').hide();
   	 $('#shwj3').hide();
   	 $('#shwj4').hide();
   	 $('#shwj5').hide();
   	 $('#shwj6').hide();
   	 $('#shwj7').hide();
   	 $('#shwj8').hide();
     $('#1stfrm').hide();
	 $('#2ndfrm').hide();
	 $('#3rdfrm').hide();
	 $('#4thfrm').hide();
	 $('#5thfrm').hide();
	 $('#6thfrm').hide();
	 $('#7thfrm').hide();
	 $('#8thfrm').fadeOut(function(){ $(this).fadeIn() });
   
   });
   
 });

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
        <td height="28" colspan="2" bgcolor="#0C6ED1"><div align="center" class="style1"><?php include('../company.php'); ?></div></td>
        </tr>
      <tr>
        <td background="images/leftbg.jpg">&nbsp;</td>
        <td><div align="center"><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])) {echo $_GET['msg'];}?></font></div></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php");?><br />
          <p>&nbsp;</p>
          <p>&nbsp;</p></td><td width="79%" height="300" valign="top">
		<div style="width:800px; height:30px; padding:10px; margin-left:5px; border:1px solid #999999;color:#FFFFFF; ">
		  <input type="button" name="1st" id="1st" class="submit-btn" value="1st Semester" />
		  <input type="button" name="2nd" id="2nd" class="submit-btn" value="2nd Semester" />
		  <input type="button" name="3rd" id="3rd" class="submit-btn" value="3rd Semester" />
		  <input type="button" name="4th" id="4th" class="submit-btn" value="4th Semester" />
		  <input type="button" name="5th" id="5th" class="submit-btn" value="5th Semester" />
		  <input type="button" name="6th" id="6th" class="submit-btn" value="6th Semester" />
		  <input type="button" name="7th" id="7th" class="submit-btn" value="7th Semester" />
		  <input type="button" name="8th" id="8th" class="submit-btn" value="8th Semester" />
		</div>
		
		  <div style="width:700px;" id="shwj1" align="center"></div>
		  <div style="width:700px;" id="shwj2" align="center"></div>
		  <div style="width:700px;" id="shwj3" align="center"></div>
		  <div style="width:700px;" id="shwj4" align="center"></div>
		  <div style="width:700px;" id="shwj5" align="center"></div>
		  <div style="width:700px;" id="shwj6" align="center"></div>
		  <div style="width:700px;" id="shwj7" align="center"></div>
		  <div style="width:700px;" id="shwj8" align="center"></div>
		  <div class="appset" style="width:500px;margin:0 auto;">
		  <div id="1stfrm" style="display:none; width:700px; ">
            <form action="ins_atatimejournal.php" id="jfrm" name="jfrm" method="post">
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" style="border-bottom:1px solid #999999; ">&nbsp;</td>
    <td height="30" colspan="2" style="border-bottom:1px solid #999999; " align="left">		
	  Date: <input type="date" name="voucherdate" id="voucherdate" size="30" value="<?php echo date("Y-m-d"); ?>" onkeypress="return handleEnter(this, event)" class="field field_medium" >
</td>
    </tr>
  <tr>
    <td height="30" style="border-bottom:1px solid #999999; ">Particulars</td>
    <td height="30" style="border-bottom:1px solid #999999; ">Debit</td>
    <td height="30" style="border-bottom:1px solid #999999; ">Credit</td>
  </tr>
  <tr>
    <td>  
    <!--<input type="text" name="msthead" id="msthead" onkeypress="return handleEnter(this, event)"> -->
	<select name="msthead" id="msthead">
	  <option value="">Select group</option>
     <?php $gsql=$myDb->select("Select distinct groupalias from tbl_accchart where groupalias<>'' order by groupalias asc");
	 while($gsqlf=$myDb->get_row($gsql,'MYSQL_ASSOC')){
	 ?>
	 
	 <option value="<?php echo $gsqlf['groupalias']; ?>"><?php echo $gsqlf['groupalias']; ?></option>
	 <?php 
	 }
	 ?>
	</select>
	
	</td>
    <td><input type="text" name="dr" id="dr" onkeypress="return handleEnter(this, event)"></td>
    <td></td>
  </tr>
  <?php $chead=$myDb->select("SELECT * 
								FROM  `tbl_accchart` 
								WHERE accname
								IN (
								'Admission Fee',  'Lab Fees',  'Library Fees',  
								'Registration Fees',  'ID Card Fees',  'Form Sales',  
								'Book Sales',  '1st Semester Fee',  
								'Tution Fee', 'Exam Fee-Mid'
								) order by accname asc");
		$count=0;						
		while($cheadf=$myDb->get_row($chead,'MYSQL_ASSOC')){
  ?>			
	<script language="javascript">
	 $(document).ready(function(){
	    var crval=0;
		$('#cr<?php echo $count; ?>').blur(function(){
				var sumcr=0;
				var drval=0;
				var sum=0;

				$('.crv').each(function(){
				   sumcr+=parseInt($(this).val());
				});
				drval=parseInt($('#dr').val());
				sum=drval-sumcr;
				$('#cr<?php echo $count+1; ?>').val(sum);
				$('#cr<?php echo $count+1; ?>').select();
				

		});
		
	 
	 });
	
	</script>
  					
  <tr>
    <td><?php echo $cheadf['accname']; ?></td>
    <td>&nbsp;</td>
    <td><input type="text" value="0" name="cr<?php echo $cheadf['id']; ?>" id="cr<?php echo $count; ?>" class="crv" onkeypress="return handleEnter(this, event)"></td>
  </tr>
  <?php $count++;} ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="button" name="Submit" value="Submit" class="submit-btn" id="submit-btn1"></td>
  </tr>
</table>
</form>  
</div>

<div id="2ndfrm" style="display:none;width:700px ">
            <form action="ins_atatimejourna2.php" id="jfrm2" name="jfrm2" method="post">
	<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" style="border-bottom:1px solid #999999; ">&nbsp;</td>
    <td height="30" colspan="2" style="border-bottom:1px solid #999999; " align="left">		
	  Date: <input type="date" name="voucherdate2" id="voucherdate2" size="30" value="<?php echo date("Y-m-d"); ?>" onkeypress="return handleEnter(this, event)" class="field field_medium" >
</td>
    </tr>
	  <tr>
	    <td height="30" style="border-bottom:1px solid #999999; ">Particulars</td>
		<td height="30" style="border-bottom:1px solid #999999; ">Debit</td>
		<td height="30" style="border-bottom:1px solid #999999; ">Credit</td>
	  </tr>
	  <tr>
		<td> 
	 <select name="msthead2" id="msthead2">
	  <option value="">Select group</option>
     <?php $gsql=$myDb->select("Select distinct groupalias from tbl_accchart where groupalias<>'' order by groupalias asc");
	 while($gsqlf=$myDb->get_row($gsql,'MYSQL_ASSOC')){
	 ?>
	 
	 <option value="<?php echo $gsqlf['groupalias']; ?>"><?php echo $gsqlf['groupalias']; ?></option>
	 <?php 
	 }
	 ?>
	</select>
 </td>
		<td><input type="text" name="dr2" id="dr2" onkeypress="return handleEnter(this, event)"></td>
		<td></td>
	  </tr>
	  <?php $chead=$myDb->select("SELECT * 
								FROM  `tbl_accchart` 
								WHERE accname
								IN (
								'2nd Semester Fee',  
								'Tution Fee', 'Exam Fee-Mid','Referred Fees'
								) order by accname asc");
		$count=0;						
		while($cheadf=$myDb->get_row($chead,'MYSQL_ASSOC')){
  ?>			
	<script language="javascript">
	 $(document).ready(function(){
	    var crval=0;
		$('#cr2<?php echo $count; ?>').focus(function(){
				var sumcr=0;
				var drval=0;
				var sum=0;

				$('.crv2').each(function(){
				   sumcr+=parseInt($(this).val());
				});
				drval=parseInt($('#dr2').val());
				sum=drval-sumcr;
				//$('#cr<?php echo $count+1; ?>').val(sum);
				//$('#cr<?php echo $count+1; ?>').select();
				$(this).val(sum);
				$(this).select();
				

		});
		
	 
	 });
	
	</script>
  					
  <tr>
    <td><?php echo $cheadf['accname']; ?></td>
    <td>&nbsp;</td>
    <td><input type="text" value="0" name="cr2<?php echo $cheadf['id']; ?>" id="cr2<?php echo $count; ?>" class="crv2" onkeypress="return handleEnter(this, event)"></td>
  </tr>
  <?php $count++;} ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="button" name="Submit" value="Submit" class="submit-btn" id="submit-btn2"></td>
  </tr>
</table>
</form>  
</div>

<div id="3rdfrm" style="display:none;width:700px ">
            <form action="ins_atatimejourna3.php" id="jfrm3" name="jfrm3" method="post">
	<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" style="border-bottom:1px solid #999999; ">&nbsp;</td>
    <td height="30" colspan="2" style="border-bottom:1px solid #999999; " align="left">		
	  Date: <input type="date" name="voucherdate3" id="voucherdate3" size="30" value="<?php echo date("Y-m-d"); ?>" onkeypress="return handleEnter(this, event)" class="field field_medium" >
</td>
    </tr>
	  <tr>
	    <td height="30" style="border-bottom:1px solid #999999; ">Particulars</td>
		<td height="30" style="border-bottom:1px solid #999999; ">Debit</td>
		<td height="30" style="border-bottom:1px solid #999999; ">Credit</td>
	  </tr>
	  <tr>
		<td>
			<select name="msthead3" id="msthead3">
	  <option value="">Select group</option>
     <?php $gsql=$myDb->select("Select distinct groupalias from tbl_accchart where groupalias<>'' order by groupalias asc");
	 while($gsqlf=$myDb->get_row($gsql,'MYSQL_ASSOC')){
	 ?>
	 
	 <option value="<?php echo $gsqlf['groupalias']; ?>"><?php echo $gsqlf['groupalias']; ?></option>
	 <?php 
	 }
	 ?>
	</select>
 </td>
		<td><input type="text" name="dr3" id="dr3" onkeypress="return handleEnter(this, event)"></td>
		<td></td>
	  </tr>
	  <?php $chead=$myDb->select("SELECT * 
								FROM  `tbl_accchart` 
								WHERE accname
								IN (
								'3rd Semester Fee',  
								'Tution Fee', 'Exam Fee-Mid','Referred Fees'
								) order by accname asc");
		$count=0;						
		while($cheadf=$myDb->get_row($chead,'MYSQL_ASSOC')){
  ?>			
	<script language="javascript">
	 $(document).ready(function(){
	    var crval=0;
		$('#cr3<?php echo $count; ?>').focus(function(){
				var sumcr=0;
				var drval=0;
				var sum=0;

				$('.crv3').each(function(){
				   sumcr+=parseInt($(this).val());
				});
				drval=parseInt($('#dr3').val());
				sum=drval-sumcr;
				//$('#cr<?php echo $count+1; ?>').val(sum);
				//$('#cr<?php echo $count+1; ?>').select();
				$(this).val(sum);
				$(this).select();
				

		});
		
	 
	 });
	
	</script>
  					
  <tr>
    <td><?php echo $cheadf['accname']; ?></td>
    <td>&nbsp;</td>
    <td><input type="text" value="0" name="cr3<?php echo $cheadf['id']; ?>" id="cr3<?php echo $count; ?>" class="crv3" onkeypress="return handleEnter(this, event)"></td>
  </tr>
  <?php $count++;} ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="button" name="Submit" value="Submit" class="submit-btn" id="submit-btn3"></td>
  </tr>
</table>
</form>  
</div>

 
<div id="4thfrm" style="display:none;width:700px ">
            <form action="ins_atatimejourna4.php" id="jfrm4" name="jfrm4" method="post">
	<table width="500" border="0" cellspacing="0" cellpadding="0">
	
  <tr>
    <td height="30" style="border-bottom:1px solid #999999; ">&nbsp;</td>
    <td height="30" colspan="2" style="border-bottom:1px solid #999999; " align="left">		
	  Date: <input type="date" name="voucherdate4" id="voucherdate4" size="30" value="<?php echo date("Y-m-d"); ?>" onkeypress="return handleEnter(this, event)" class="field field_medium" >
	</td>
    </tr>
	  <tr>
	    <td height="30" style="border-bottom:1px solid #999999; ">Particulars</td>
		<td height="30" style="border-bottom:1px solid #999999; ">Debit</td>
		<td height="30" style="border-bottom:1px solid #999999; ">Credit</td>
	  </tr>
	  <tr>
		<td>  
			<select name="msthead4" id="msthead4">
	  <option value="">Select group</option>
     <?php $gsql=$myDb->select("Select distinct groupalias from tbl_accchart where groupalias<>'' order by groupalias asc");
	 while($gsqlf=$myDb->get_row($gsql,'MYSQL_ASSOC')){
	 ?>
	 
	 <option value="<?php echo $gsqlf['groupalias']; ?>"><?php echo $gsqlf['groupalias']; ?></option>
	 <?php 
	 }
	 ?>
	</select>
 </td>
		<td><input type="text" name="dr4" id="dr4" onkeypress="return handleEnter(this, event)"></td>
		<td></td>
	  </tr>
	  <?php $chead=$myDb->select("SELECT * 
								FROM  `tbl_accchart` 
								WHERE accname
								IN (
								'4th Semester Fee',  
								'Tution Fee', 'Exam Fee-Mid','Referred Fees'
								) order by accname asc");
		$count=0;						
		while($cheadf=$myDb->get_row($chead,'MYSQL_ASSOC')){
  ?>			
	<script language="javascript">
	 $(document).ready(function(){
	    var crval=0;
		$('#cr4<?php echo $count; ?>').focus(function(){
				var sumcr=0;
				var drval=0;
				var sum=0;

				$('.crv4').each(function(){
				   sumcr+=parseInt($(this).val());
				});
				drval=parseInt($('#dr4').val());
				sum=drval-sumcr;
				//$('#cr<?php echo $count+1; ?>').val(sum);
				//$('#cr<?php echo $count+1; ?>').select();
				$(this).val(sum);
				$(this).select();
				

		});
		
	 
	 });
	
	</script>
  					
  <tr>
    <td><?php echo $cheadf['accname']; ?></td>
    <td>&nbsp;</td>
    <td><input type="text" value="0" name="cr4<?php echo $cheadf['id']; ?>" id="cr4<?php echo $count; ?>" class="crv4" onkeypress="return handleEnter(this, event)"></td>
  </tr>
  <?php $count++;} ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="button" name="Submit" value="Submit" class="submit-btn" id="submit-btn4"></td>
  </tr>
</table>
</form>  
</div>  
          
<div id="5thfrm" style="display:none;width:700px ">
            <form action="ins_atatimejourna5.php" id="jfrm5" name="jfrm5" method="post">
	<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" style="border-bottom:1px solid #999999; ">&nbsp;</td>
    <td height="30" colspan="2" style="border-bottom:1px solid #999999; " align="left">		
	  Date: <input type="date" name="voucherdate5" id="voucherdate5" size="30" value="<?php echo date("Y-m-d"); ?>" onkeypress="return handleEnter(this, event)" class="field field_medium" >
</td>
    </tr>
	  <tr>
	    <td height="30" style="border-bottom:1px solid #999999; ">Particulars</td>
		<td height="30" style="border-bottom:1px solid #999999; ">Debit</td>
		<td height="30" style="border-bottom:1px solid #999999; ">Credit</td>
	  </tr>
	  <tr>
		<td> 
			<select name="msthead5" id="msthead5">
	  <option value="">Select group</option>
     <?php $gsql=$myDb->select("Select distinct groupalias from tbl_accchart where groupalias<>'' order by groupalias asc");
	 while($gsqlf=$myDb->get_row($gsql,'MYSQL_ASSOC')){
	 ?>
	 
	 <option value="<?php echo $gsqlf['groupalias']; ?>"><?php echo $gsqlf['groupalias']; ?></option>
	 <?php 
	 }
	 ?>
	</select>
</td>
		<td><input type="text" name="dr5" id="dr5" onkeypress="return handleEnter(this, event)"></td>
		<td></td>
	  </tr>
	  <?php $chead=$myDb->select("SELECT * 
								FROM  `tbl_accchart` 
								WHERE accname
								IN (
								'5th Semester Fee',  
								'Tution Fee', 'Exam Fee-Mid','Referred Fees'
								) order by accname asc");
		$count=0;						
		while($cheadf=$myDb->get_row($chead,'MYSQL_ASSOC')){
  ?>			
	<script language="javascript">
	 $(document).ready(function(){
	    var crval=0;
		$('#cr5<?php echo $count; ?>').focus(function(){
				var sumcr=0;
				var drval=0;
				var sum=0;

				$('.crv5').each(function(){
				   sumcr+=parseInt($(this).val());
				});
				drval=parseInt($('#dr5').val());
				sum=drval-sumcr;
				//$('#cr<?php echo $count+1; ?>').val(sum);
				//$('#cr<?php echo $count+1; ?>').select();
				$(this).val(sum);
				$(this).select();
				

		});
		
	 
	 });
	
	</script>
  					
  <tr>
    <td><?php echo $cheadf['accname']; ?></td>
    <td>&nbsp;</td>
    <td><input type="text" value="0" name="cr5<?php echo $cheadf['id']; ?>" id="cr5<?php echo $count; ?>" class="crv5" onkeypress="return handleEnter(this, event)"></td>
  </tr>
  <?php $count++;} ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="button" name="Submit" value="Submit" class="submit-btn" id="submit-btn5"></td>
  </tr>
</table>
</form>  
</div> 
 
<div id="6thfrm" style="display:none;width:700px ">
            <form action="ins_atatimejourna6.php" id="jfrm6" name="jfrm6" method="post">
	<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" style="border-bottom:1px solid #999999; ">&nbsp;</td>
    <td height="30" colspan="2" style="border-bottom:1px solid #999999; " align="left">		
	  Date: <input type="date" name="voucherdate6" id="voucherdate6" size="30" value="<?php echo date("Y-m-d"); ?>" onkeypress="return handleEnter(this, event)" class="field field_medium" >
</td>
    </tr>
	  <tr>
	    <td height="30" style="border-bottom:1px solid #999999; ">Particulars</td>
		<td height="30" style="border-bottom:1px solid #999999; ">Debit</td>
		<td height="30" style="border-bottom:1px solid #999999; ">Credit</td>
	  </tr>
	  <tr>
		<td> 
			<select name="msthead6" id="msthead6">
	  <option value="">Select group</option>
     <?php $gsql=$myDb->select("Select distinct groupalias from tbl_accchart where groupalias<>'' order by groupalias asc");
	 while($gsqlf=$myDb->get_row($gsql,'MYSQL_ASSOC')){
	 ?>
	 
	 <option value="<?php echo $gsqlf['groupalias']; ?>"><?php echo $gsqlf['groupalias']; ?></option>
	 <?php 
	 }
	 ?>
	</select>
 </td>
		<td><input type="text" name="dr6" id="dr6" onkeypress="return handleEnter(this, event)"></td>
		<td></td>
	  </tr>
	  <?php $chead=$myDb->select("SELECT * 
								FROM  `tbl_accchart` 
								WHERE accname
								IN (
								'6th Semester Fee',  
								'Tution Fee', 'Exam Fee-Mid','Referred Fees'
								) order by accname asc");
		$count=0;						
		while($cheadf=$myDb->get_row($chead,'MYSQL_ASSOC')){
  ?>			
	<script language="javascript">
	 $(document).ready(function(){
	    var crval=0;
		$('#cr6<?php echo $count; ?>').focus(function(){
				var sumcr=0;
				var drval=0;
				var sum=0;

				$('.crv6').each(function(){
				   sumcr+=parseInt($(this).val());
				});
				drval=parseInt($('#dr6').val());
				sum=drval-sumcr;
				//$('#cr<?php echo $count+1; ?>').val(sum);
				//$('#cr<?php echo $count+1; ?>').select();
				$(this).val(sum);
				$(this).select();
				

		});
		
	 
	 });
	
	</script>
  					
  <tr>
    <td><?php echo $cheadf['accname']; ?></td>
    <td>&nbsp;</td>
    <td><input type="text" value="0" name="cr6<?php echo $cheadf['id']; ?>" id="cr6<?php echo $count; ?>" class="crv6" onkeypress="return handleEnter(this, event)"></td>
  </tr>
  <?php $count++;} ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="button" name="Submit" value="Submit" class="submit-btn" id="submit-btn6"></td>
  </tr>
</table>
</form>  
</div> 
 
 
<div id="7thfrm" style="display:none;width:700px ">
            <form action="ins_atatimejourna7.php" id="jfrm7" name="jfrm7" method="post">
	<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" style="border-bottom:1px solid #999999; ">&nbsp;</td>
    <td height="30" colspan="2" style="border-bottom:1px solid #999999; " align="left">		
	  Date: <input type="date" name="voucherdate7" id="voucherdate7" size="30" value="<?php echo date("Y-m-d"); ?>" onkeypress="return handleEnter(this, event)" class="field field_medium" >
</td>
    </tr>
	  <tr>
	    <td height="30" style="border-bottom:1px solid #999999; ">Particulars</td>
		<td height="30" style="border-bottom:1px solid #999999; ">Debit</td>
		<td height="30" style="border-bottom:1px solid #999999; ">Credit</td>
	  </tr>
	  <tr>
		<td>   
			<select name="msthead7" id="msthead7">
	  <option value="">Select group</option>
     <?php $gsql=$myDb->select("Select distinct groupalias from tbl_accchart where groupalias<>'' order by groupalias asc");
	 while($gsqlf=$myDb->get_row($gsql,'MYSQL_ASSOC')){
	 ?>
	 
	 <option value="<?php echo $gsqlf['groupalias']; ?>"><?php echo $gsqlf['groupalias']; ?></option>
	 <?php 
	 }
	 ?>
	</select>
 </td>
		<td><input type="text" name="dr7" id="dr7" onkeypress="return handleEnter(this, event)"></td>
		<td></td>
	  </tr>
	  <?php $chead=$myDb->select("SELECT * 
								FROM  `tbl_accchart` 
								WHERE accname
								IN (
								'7th Semester Fee',  
								'Tution Fee', 'Exam Fee-Mid','Referred Fees'
								) order by accname asc");
		$count=0;						
		while($cheadf=$myDb->get_row($chead,'MYSQL_ASSOC')){
  ?>			
	<script language="javascript">
	 $(document).ready(function(){
	    var crval=0;
		$('#cr7<?php echo $count; ?>').focus(function(){
				var sumcr=0;
				var drval=0;
				var sum=0;

				$('.crv7').each(function(){
				   sumcr+=parseInt($(this).val());
				});
				drval=parseInt($('#dr7').val());
				sum=drval-sumcr;
				//$('#cr<?php echo $count+1; ?>').val(sum);
				//$('#cr<?php echo $count+1; ?>').select();
				$(this).val(sum);
				$(this).select();
				

		});
		
	 
	 });
	
	</script>
  					
  <tr>
    <td><?php echo $cheadf['accname']; ?></td>
    <td>&nbsp;</td>
    <td><input type="text" value="0" name="cr7<?php echo $cheadf['id']; ?>" id="cr7<?php echo $count; ?>" class="crv7" onkeypress="return handleEnter(this, event)"></td>
  </tr>
  <?php $count++;} ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="button" name="Submit" value="Submit" class="submit-btn" id="submit-btn7"></td>
  </tr>
</table>
</form>  
</div> 
 
 
<div id="8thfrm" style="display:none;width:700px ">
            <form action="ins_atatimejourna8.php" id="jfrm8" name="jfrm8" method="post">
	<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" style="border-bottom:1px solid #999999; ">&nbsp;</td>
    <td height="30" colspan="2" style="border-bottom:1px solid #999999; " align="left">		
	  Date: <input type="date" name="voucherdate8" id="voucherdate8" size="30" value="<?php echo date("Y-m-d"); ?>" onkeypress="return handleEnter(this, event)" class="field field_medium" >
</td>
    </tr>
	  <tr>
	    <td height="30" style="border-bottom:1px solid #999999; ">Particulars</td>
		<td height="30" style="border-bottom:1px solid #999999; ">Debit</td>
		<td height="30" style="border-bottom:1px solid #999999; ">Credit</td>
	  </tr>
	  <tr>
		<td>   
			<select name="msthead8" id="msthead8">
	  <option value="">Select group</option>
     <?php $gsql=$myDb->select("Select distinct groupalias from tbl_accchart where groupalias<>'' order by groupalias asc");
	 while($gsqlf=$myDb->get_row($gsql,'MYSQL_ASSOC')){
	 ?>
	 
	 <option value="<?php echo $gsqlf['groupalias']; ?>"><?php echo $gsqlf['groupalias']; ?></option>
	 <?php 
	 }
	 ?>
	</select>
 </td>
		<td><input type="text" name="dr8" id="dr8" onkeypress="return handleEnter(this, event)"></td>
		<td></td>
	  </tr>
	  <?php $chead=$myDb->select("SELECT * 
								FROM  `tbl_accchart` 
								WHERE accname
								IN (
								'8th Semester Fee',  
								'Tution Fee', 'Exam Fee-Mid','Referred Fees'
								) order by accname asc");
		$count=0;						
		while($cheadf=$myDb->get_row($chead,'MYSQL_ASSOC')){
  ?>			
	<script language="javascript">
	 $(document).ready(function(){
	    var crval=0;
		$('#cr8<?php echo $count; ?>').focus(function(){
				var sumcr=0;
				var drval=0;
				var sum=0;

				$('.crv8').each(function(){
				   sumcr+=parseInt($(this).val());
				});
				drval=parseInt($('#dr8').val());
				sum=drval-sumcr;
				//$('#cr<?php echo $count+1; ?>').val(sum);
				//$('#cr<?php echo $count+1; ?>').select();
				$(this).val(sum);
				$(this).select();
				

		});
		
	 
	 });
	
	</script>
  					
  <tr>
    <td><?php echo $cheadf['accname']; ?></td>
    <td>&nbsp;</td>
    <td><input type="text" value="0" name="cr8<?php echo $cheadf['id']; ?>" id="cr8<?php echo $count; ?>" class="crv8" onkeypress="return handleEnter(this, event)"></td>
  </tr>
  <?php $count++;} ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="button" name="Submit" value="Submit" class="submit-btn" id="submit-btn8"></td>
  </tr>
</table>
</form>  
</div> 		  
			</div><p>&nbsp;</p></td></tr>
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
	 header("Location:acchome.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>