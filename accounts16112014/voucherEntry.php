<?php ob_start();
session_start();
include("config.php"); 
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

<script type="text/javascript" src="js/datepickercontrol.js"></script>
<script language="JavaScript">
 if (navigator.platform.toString().toLowerCase().indexOf("linux") != -1){
	document.write('<link type="text/css" rel="stylesheet" href="css/datepickercontrol_lnx.css">');
 }
 else{
	document.write('<link type="text/css" rel="stylesheet" href="css/datepickercontrol.css">');
 }
</script>

<script type="text/javascript" src="js/jquery-latest.pack.js"></script>
<script>

$(document).ready(function() {	
	//select all the a tag with name equal to modal

	$('a[name=modal]').click(function(e) {
		//Cancel the link behavior
       
		e.preventDefault();
		//Get the A tag
		var id = $(this).attr('href');
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
			    $('#table_wrapper').load('delete_acc.php');
       
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
	
	});
	
	//if close button is clicked
	$('.window .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		
		
        // or opener.location.href = opener.location.href;
       // window.close(); // or self.close();
		$('#mask').hide();
		$('.window').hide();
		window.location.reload();
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});			

	$(window).resize(function () {
	 
 		var box = $('#boxes .window');
 
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
      
        //Set height and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});
               
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);
	 
	});
	
});

</script>
<style>
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
  width:auto;
  height:auto;
  display:none;
  z-index:9999;
  padding:20px;

}

#boxes #dialog {
  width:auto; 
  height:auto;
  padding:10px;
  background-color:#ffffff;

}

#boxes #dialog1 {
  width:375px; 
  height:203px;
}

#dialog1 .d-header {
  background:url(images/login-header.png) no-repeat 0 0 transparent; 
  width:375px; 
  height:150px;
}
#dialog1 .d-header input {
  position:relative;
  top:60px;
  left:100px;
  border:3px solid #cccccc;
  height:22px;
  width:200px;
  font-size:15px;
  padding:5px;
  margin-top:4px;
}

#dialog1 .d-blank {
  float:left;
  background:url(images/login-blank.png) no-repeat 0 0 transparent; 
  width:267px; 
  height:53px;
}

#dialog1 .d-login {
  float:left;
  width:108px; 
  height:53px;
}

#boxes #dialog2 {
  background:url(images/notice.png) no-repeat 0 0 transparent; 
  width:326px; 
  height:229px;
  padding:50px 0 20px 25px;
}
</style>



	<link href="css/core.css" rel="stylesheet" type="text/css" />

<style type="text/css">
@import url("main.css");
.style12 {font-size: 10px}
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style16 {font-size: 12px}

</style>




<style type='text/css'>
#check_accname_availability{
	background: #225384;
	border:1px solid black;
	color:white;
}
.is_available{
	color:green;
}
.is_not_available{
	color:red;
}
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
 
		 
</script>


<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="jdtp/jquery-ui.css" />
  <script src="jdtp/jquery-ui.js"></script>
  <link rel="stylesheet" href="jdtp/style.css" />
 


<script src="js/jquery.hotkeys.js"></script>

<script language="javascript">
 $(document).ready(function() {

    var arr = $(this).closest('form').serializeArray();
    $('.add_new').blur('click',function(){
       $.post('unique_valid.php', arr, function(data) {
	       $('#sum').load("unique_valid.php");
	   });
	});
			   var drcrtype='<?php echo $_SESSION["drcrtype"]; ?>';
				   if(drcrtype=="sdmcscmd"){
					   if($('#amountdr').val()>0){
						 $('#acctype').val('CR');
					   
					   }else{
						 $('#acctype').val('DR');
					   }
				   }
	$(".snew").click('live',function(){
		   var arr = $('#savejournal').serializeArray();
		   var vdate=$('#DPC_voucherdate_YYYY-MM-DD').val();		   
		   var descri=$("#description").val();
		   if(($("#description").val()=="")){
				  alert('Description can not left empty');
				  $('#accname').focus();
		   }else{
			   $.post('save_journal.php?vdate='+vdate, arr, function(data) {
					 
					  $('#fsave').html(data);
					  $('#description').val('');
					  $('#accname_m').focus();		      
					  
			   });
			 
		   
			   $("#flash").fadeIn(400).html('<img src="ajax-loader.gif" align="absmiddle">&nbsp;<span class="loading">Saving...</span>');
			   $('.tbl_repeat').load('show_tmpjournal.php');
				$('.tbl_rep').fadeOut(300, function() {
						var msg='';
						$('#table_wrap').hide().html(msg).fadeIn(300);
			   });
			   $('.sumacc').fadeOut(300,function(){  });
			   $('#amval').fadeOut(300,function(){ });
			   $("#flash").hide();
			   
		}  
	});
	
	
	
	$('#accname_m').focus('live',function(){
	
			  // $('.tbl_repeat').load('show_tmpjournal.php');


	});
	$('input[name="voucherdate"]').focus('live',function(){
			   	$('#sum').load("voucher_nosave.php");
			    $('#sum').load("voucher_notcomplete.php");
	
	});
	
	//Derived from application sesssion
	var sessiontype=$('#vouchertype').val('<?php echo $_SESSION["sessiontype"]; ?>');
	if($('#vouchertype').val()=="P"){
		      $('#acctype').val("CR");
			  $('#dc').show();
			  $('#dc').text("DR");
			  $('#dcc').show();
			  $('label[for="m"]').text('Debit Head:');
			  $('#dcc').text("CR");
			  $('label[for="ch"]').text('Credit Head:');
			  $('#am').fadeIn('fast').show();
			  $('#ptpe').show();
			  $('#ptpe').fadeIn('fast');
			  $('#paytype').val('<?php echo $_SESSION["pytype"]; ?>');
			  $('#accname_m').focus();
			 if($('#paytype').val()=="cash"){
			   $('#accname').val('Cash');
			 }
			 $("#paytype").keypress(function(e){
			    if(e.which ==13){
			      $("#accname_m").focus();
			    };
			 });			  
			 
			 $('#accname_m').focus(function(){
			   var vdate=$('#DPC_voucherdate_YYYY-MM-DD').val();
			   $.get('remaning_value.php', function(result) {
				   $('#amountdr').val(result);
			   });
			   
				 $('#amval').load('amount_level.php?vdate='+vdate).fadeIn(300);
				 
			 }); 
	
	}else if($('#vouchertype').val()=="R"){
		     $('#acctype').val("DR");
			 $('#dc').show();
			 $('#dc').text("CR");
			 $('#dcc').show();
			 $('label[for="m"]').text("Credit Head:");
			 $('#dcc').text("DR");
			 $('label[for="ch"]').text("Debit Head:");
			 $('#am').fadeIn('fast').show();
			 $('#ptpe').show();
			 $('#ptpe').fadeIn('fast');
			 $('#paytype').val('<?php echo $_SESSION["pytype"]; ?>');
			 $('#accname_m').focus();
			 if($('#paytype').val()=="cash"){
			   $('#accname').val('Cash');
			 }


			 $("#paytype").keypress(function(e){
			    if(e.which ==13){
			      $("#accname_m").focus();
			    };
			 });
			 $('#accname_m').focus(function(){
			   var vdate=$('#DPC_voucherdate_YYYY-MM-DD').val();

			   $.get('remaning_value.php', function(result) {
				   $('#amountdr').val(result);
			   });
			   
				 $('#amval').load('amount_level.php?vdate='+vdate).fadeIn(300);
				 
			 });
	
	
	}else if($('#vouchertype').val()=="J"){
		     $('#acctype').val("DR");
			 $('#dc').hide();
			 $('#dcc').hide();
			 $('label[for="ch"]').text("Debit Head:");
			 $('#am').fadeOut('fast');
			 $('#ptpe').fadeOut('fast');
			 $('#accname').focus();

			 $("#vouchertype").keypress(function(e){
			    if(e.which ==13){
			      $("#accname").focus();
			    };
			 });
			 
			 $('#accname').focus(function(){
			   var vdate=$('#DPC_voucherdate_YYYY-MM-DD').val();
			   var drcrtype='<?php echo $_SESSION["drcrtype"]; ?>';

			   $.get('remaning_value.php', function(result) {
				   $('#amountdr').val(result);
				   if(drcrtype=="sdmcscmd"){
					   if($('#amountdr').val()>0){
						 $('#acctype').val('CR');
					   
					   }else{
						 $('#acctype').val('DR');
					   }
				   }
			   });
			   
				 $('#amval').load('amount_level.php?vdate='+vdate).fadeIn(300);
				 
			 }); 
	}else if($('#vouchertype').val()=="C"){
		     $('#acctype').val("DR");
			 $('#dc').show();
			 $('#dc').text("CR");
			 $('#dcc').show();
			 $('label[for="m"]').text("Credit Head:");
			 $('#dcc').text("DR");
			 $('label[for="ch"]').text("Debit Head:");
			 $('#am').fadeIn('fast').show();
			 $('#ptpe').show();
			 $('#ptpe').fadeIn('fast');
			 $('#paytype').val('<?php echo $_SESSION["pytype"]; ?>');
			 $('#accname_m').focus();
			 if($('#paytype').val()=="cash"){
			   $('#accname_m').val('Cash');
			 }

			 $("#paytype").keypress(function(e){
			    if(e.which ==13){
			      $("#accname_m").focus();
			    };
			 });
			 $('#accname_m').focus(function(){
			   var vdate=$('#DPC_voucherdate_YYYY-MM-DD').val();

			   $.get('remaning_value.php', function(result) {
				   $('#amountdr').val(result);
			   });
			   
				 $('#amval').load('amount_level.php?vdate='+vdate).fadeIn(300);
				 
			 });
	
	
	}
	
	$('#vouchertype').change(function(){
	    var vtpe=$('#vouchertype').val();
	    switch(vtpe){
		  case "P":
		      $('#acctype').val("CR");
			  $('#dc').show();
			  $('#dc').text("DR");
			  $('#dcc').show();
			  $('label[for="m"]').text('Debit Head:');
			  $('#dcc').text("CR");
			  $('label[for="ch"]').text('Credit Head:');
			  $('#am').fadeIn('fast').show();
			  $('#ptpe').show();
			  $('#ptpe').fadeIn('fast');
			  $('#accname_m').focus();
			 if($('#paytype').val()=="cash"){
			   $('#accname').val('Cash');
			 }
			 $("#paytype").keypress(function(e){
			    if(e.which ==13){
			      $("#accname_m").focus();
			    };
			 });			  
			 
			 $('#accname_m').focus(function(){
			   var vdate=$('#DPC_voucherdate_YYYY-MM-DD').val();
			   $.get('remaning_value.php', function(result) {
				   $('#amountdr').val(result);
			   });
			   
				 $('#amval').load('amount_level.php?vdate='+vdate).fadeIn(300);
				 
			 }); 
			 break;
		  case "R":
		     $('#acctype').val("DR");
			 $('#dc').show();
			 $('#dc').text("CR");
			 $('#dcc').show();
			 $('label[for="m"]').text('Credit Head:');
			 $('#dcc').text("DR");
			 $('label[for="ch"]').text('Debit Head:');
			 $('#am').fadeIn('fast').show();
			 $('#ptpe').show();
			 $('#ptpe').fadeIn('fast');
			 $('#accname_m').focus();
			 if($('#paytype').val()=="cash"){
			   $('#accname').val('Cash');
			 }

			 $("#paytype").keypress(function(e){
			    if(e.which ==13){
			      $("#accname_m").focus();
			    };
			 });
			 $('#accname_m').focus(function(){
			   var vdate=$('#DPC_voucherdate_YYYY-MM-DD').val();

			   $.get('remaning_value.php', function(result) {
				   $('#amountdr').val(result);
			   });
			   
				 $('#amval').load('amount_level.php?vdate='+vdate).fadeIn(300);
				 
			 });
			 

			 break;
		case "C":
		     $('#acctype').val("DR");
			 $('#dc').show();
			 $('#dc').text("CR");
			 $('#dcc').show();
			 $('label[for="m"]').text('Credit Head:');
			 $('#dcc').text("DR");
			 $('label[for="ch"]').text('Debit Head:');
			 $('#am').fadeIn('fast').show();
			 $('#ptpe').show();
			 $('#ptpe').fadeIn('fast');
			 $('#accname_m').focus();
			 if($('#paytype').val()=="cash"){
			   $('#accname_m').val('Cash');
			 }

			 $("#paytype").keypress(function(e){
			    if(e.which ==13){
			      $("#accname_m").focus();
			    };
			 });
			 $('#accname_m').focus(function(){
			   var vdate=$('#DPC_voucherdate_YYYY-MM-DD').val();

			   $.get('remaning_value.php', function(result) {
				   $('#amountdr').val(result);
			   });
			   
				 $('#amval').load('amount_level.php?vdate='+vdate).fadeIn(300);
				 
			 });
			 

			 break;		  
		case "J":
		     $('#acctype').val("DR");
			 $('#dc').hide();
			 $('#dcc').hide();
			 $('label[for="ch"]').text("Debit Head");
			 $('#am').fadeOut('fast');
			 $('#ptpe').fadeOut('fast');
			 $('#accname').focus();

			 $("#vouchertype").keypress(function(e){
			    if(e.which ==13){
			      $("#accname").focus();
			    };
			 });
			 
			 $('#accname').focus(function(){
			   var vdate=$('#DPC_voucherdate_YYYY-MM-DD').val();
			   var drcrtype='<?php echo $_SESSION["drcrtype"]; ?>';
			   $.get('remaning_value.php', function(result) {
				   $('#amountdr').val(result);
				   if(drcrtype=="sdmcscmd"){
					   if($('#amountdr').val()>0){
						 $('#acctype').val('CR');
					   
					   }else{
						 $('#acctype').val('DR');
					   }
				   }
			   });
			   
				 $('#amval').load('amount_level.php?vdate='+vdate).fadeIn(300);
				 
			 }); 
			 
			 break;
		  default:
		     $('#acctype').val("DR");	
			 $('#accname_m').focus(function(){
			 	var vdate=$('#DPC_voucherdate_YYYY-MM-DD').val();

			    $.get('remaning_value.php', function(result) {
				   $('#amountdr').val(result);
			    });
			   
				 $('#amval').load('amount_level.php?vdate='+vdate).fadeIn(300);
				 
			 }); 
		
		}
				 

		   
	});

	 
});

</script>

<script language="javascript">
  $(document).ready(function(){
  
			 $('#accname_m').focusout(function(){
			   var arr=$('#form_products').serializeArray();
			   $.post("achead_ledger_value.php",arr,function(r){
			     //$('.tremval').html(r);
				 $('#amountdr').val($.trim(r));
			   });

			 }); 
			 $('#accname_m').focus(function(){
			   var arr=$('#form_products').serializeArray();
			   $.post("achead_ledger_value.php",arr,function(r){
			     $('#amountdr').val($.trim(r));
			   });

			 }); 
			 
			 $('#accname').keypress(function(e){
			   var drcrtype='<?php echo $_SESSION["drcrtype"]; ?>';
			   if(e.which==13){
			      //$('#selectmenu1').focus();
				  if(drcrtype=="sdmcscmd" || drcrtype==""){
				  	$('#amountdr').focus();
				  }	
			   }	  
			 
			 }); 
			 
			 
			 
  });

</script>

<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
	<link href="css/core.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
$().ready(function() {
	$("#accname").autocomplete("accname_bottomhead.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#accname_m").autocomplete("accname_bottomhead.php", {
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
<script language="javascript">
$(document).keyup(function(e) {
  if (e.keyCode == 27) { $('#description').focus(); }   // esc
  //if (e.keyCode == 16) { $("#DPC_voucherdate_YYYY-MM-DD").focus(); $("#DPC_voucherdate_YYYY-MM-DD").datepicker(); }  //shift key
  
  if(e.keyCode==17){ //Ctrl key
   	
		
		   var arr = $('#savejournal').serializeArray();
		   var vdate=$('#DPC_voucherdate_YYYY-MM-DD').val();		   
		   var descri=$("#description").val();
		   if(($("#description").val()=="")){
				  alert('Description can not left empty');
				  $('#accname').focus();
		   }else{
			   $.post('save_journal.php?vdate='+vdate, arr, function(data) {
					 
					  $('#fsave').html(data);
					  $('#description').val('');
					  $('#accname_m').focus();		      
					  
			   });
			 
			   $("#flash").fadeIn(400).html('<img src="ajax-loader.gif" align="absmiddle">&nbsp;<span class="loading">Saving...</span>');
			   $('.tbl_repeat').load('show_tmpjournal.php');
				$('.tbl_rep').fadeOut(300, function() {
						var msg='';
						$('#table_wrap').hide().html(msg).fadeIn(300);
			   });
			   $('.sumacc').fadeOut(300,function(){  });
			   $('#amval').fadeOut(300,function(){ });
			   $("#flash").hide();
			   window.location.reload();

		}  
		
		  
  }
  
  if(e.keyCode==45){      //keyboard key (insert)
    $('#bothead').fadeTo('slow',0.9);
  
  
  
  }
  if(e.keyCode==46){   //(delete key)
    $('#bothead').hide();
  
  
  
  }
  if(e.keyCode==36){   //Home key
    $('#vouchertype').val("P");
	$('#acctype').val("CR");
			  $('#dc').show();
			  $('#dc').text("DR");
			  $('#dcc').show();
			  $('#dcc').text("CR");
			  $('#am').fadeIn('fast').show();
			  $('#ptpe').show();
			  $('#ptpe').fadeIn('fast');  
			  $('#accname_m').focus();
			  
			 $('#accname_m').focus(function(){
			   var vdate=$('#DPC_voucherdate_YYYY-MM-DD').val();
			   $.get('remaning_value.php', function(result) {
				   $('#amountdr').val(result);
			   });
			   
				 $('#amval').load('amount_level.php?vdate='+vdate).fadeIn(300);
				 
			 }); 
  }	
  
  
  if(e.keyCode==33){
    $('#vouchertype').val("R");
		     $('#acctype').val("DR");
			 $('#dc').show();
			 $('#dc').text("CR");
			 $('#dcc').show();
			 $('#dcc').text("DR");
			 $('#am').fadeIn('fast').show();
			 $('#ptpe').show();
			 $('#ptpe').fadeIn('fast');
			  $('#accname_m').focus();
			 $('#accname_m').focus(function(){
			   var vdate=$('#DPC_voucherdate_YYYY-MM-DD').val();

			   $.get('remaning_value.php', function(result) {
				   $('#amountdr').val(result);
			   });
			   
				 $('#amval').load('amount_level.php?vdate='+vdate).fadeIn(300);
				 
			 });
			  
  }
  if(e.keyCode==34){
	$('#vouchertype').val("J");  
		     $('#acctype').val("DR");
			 $('#dc').hide();
			 $('#dcc').hide();
			 $('#am').fadeOut('fast');
			 $('#ptpe').fadeOut('fast');
			  $('#accname').focus();
			  
			 $('#accname').focus(function(){
			   var vdate=$('#DPC_voucherdate_YYYY-MM-DD').val();
			   var drcrtype='<?php echo $_SESSION["drcrtype"]; ?>';
			   $.get('remaning_value.php', function(result) {
				   $('#amountdr').val(result);
				   if(drcrtype=="sdmcscmd"){
					   if($('#amountdr').val()>0){
						 $('#acctype').val('CR');
					   
					   }else{
						 $('#acctype').val('DR');
					   }
				   }
			   });
			   
				 $('#amval').load('amount_level.php?vdate='+vdate).fadeIn(300);
				 
			 }); 
  }
  
  
  if(e.keyCode==13){   // (enter key)
	  $('input').focus(function(){
		$(this).select();
	  });
	  
  }
});
</script>

</head>

<body>

<table width="1047" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1047" height="152" valign="top" background="images/1.jpg"><span class="style17"><?php include("topdefault.php");?></span></td>
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
          <p>&nbsp;</p>
		  </td>
        <td width="79%" valign="top">
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></font></p>

		
	<div id="table_wrap">
	<?php if (!empty($prod)) { ?>

			<table cellpadding="0" cellspacing="0" border="0" class="tbl_rep" width="100%">
			
				<tr>
					<th class="col_1 ta_r" colspan="5">Error</th>
				</tr>
				
				<?php foreach($prod as $key => $row) { ?>
					
					<tr>
						<td   colspan="5" class="remove" rel="<?php echo $key; ?>"><?php echo $row['err']; ?></td>
					</tr >
					
				<?php } ?>
			
			</table>
		<?php }?>
	</div>

		
		
<div id="wrapper" >
		   <input type="hidden" id="DPC_TODAY_TEXT" value="today">
        <input type="hidden" id="DPC_BUTTON_TITLE" value="Open calendar...">
        <input type="hidden" id="DPC_MONTH_NAMES" value="['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']">
        <input type="hidden" id="DPC_DAY_NAMES" value="['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']">

    <div style="float:left;width:450px;height:400px;border:1px solid #CCCCCC;margin-left:30px;">
	 <div class="tremval" align="right"></div>  

	<div style="border-bottom:1px solid #CCCCCC;width:auto;padding:10px;">Voucher Entry</div>
	<form action="new_entry.php" method="post" id="form_products" name="form_products">
	<div style="padding:10px;">
	
	<label style="float:left;margin-left:10px;margin-top:10px;">Voucher Date:</label>
		<div style="margin-left:135px;">
		<input type="date" name="voucherdate" id="voucherdate" size="30" value="<?php echo date("Y-m-d"); ?>" onkeypress="return handleEnter(this, event)" class="field field_medium" >
	</div>		
	
	<label style="float:left;margin-left:10px;margin-top:10px;">Voucher Type:</label>
		<div style="margin-left:135px;"><select name="vouchertype" id="vouchertype" class="field field_medium"
			placeholder="Voucher Type"  onkeypress="return handleEnter(this, event)">
                <option value="">Select Voucher type</option>
                <option value="R">Receive</option>
                <option value="P">Payment</option>
                <option value="J">Journal</option>
				<option value="C">Contra</option>
              </select>
		 </div>
	<div id="ptpe">
	<label style="float:left;margin-left:10px;margin-top:10px;">Pay Type:</label>
		<div style="margin-left:135px;"><select name="paytype" id="paytype" class="field field_medium"
			placeholder="Pay Type"  onkeypress="return handleEnter(this, event)">
                <option value="">Select Pay type</option>
                <option value="cash">Cash</option>
                <option value="bank">Bank</option>
                
              </select></div>		
	  </div>		
	  <div id="am">
	  <label style="float:left;margin-left:10px;margin-top:10px;" for="m">Through Account Name:</label>
	       <div style="margin-left:135px;">  <input type="text" id="accname_m" name="accname_m"
			class="field field_medium"
			placeholder="Through Account name" value="" onkeypress="return handleEnter(this, event)" />
			
			<div id='accname_availability_result'><div id="dc" style="margin-left:200px;margin-top:100px;"></div></div>
			</div>
				 

	 </div>		
	
	 <label style="float:left;margin-left:10px;margin-top:10px;" for="ch">Account Name:</label>
	       <div style="margin-left:135px;"><input type="text" id="accname" name="accname"
			class="field field_medium"
			placeholder="Account name" value="" onkeypress="return handleEnter(this, event)" />
			
			<div id='accname_availability_result'> <div id="dcc" style="margin-left:200px;margin-top:20px;"></div></div>

			</div>
		
		  
			 <label style="float:left;margin-left:10px;margin-top:10px;">Account Type:</label>
			 <div style="margin-left:135px;">
			 <select name="acctype" id="acctype" onkeypress="return handleEnter(this, event)" class="field field_medium"
			placeholder="Account Type">
			      <option value="">Account Type</option>
                  <option value="DR">Debit</option>
                  <option value="CR">Credit</option>
                </select></div>
		    <label style="float:left;margin-left:10px;margin-top:10px;">Amount:</label>
			<div style="margin-left:135px;"><input type="text" id="amountdr" name="amountdr"
			class="field field_medium"
			placeholder="Amount" value="" onkeypress="return handleEnter(this, event)" style="text-align:right; " />
			
			
			</div>
		<br/>
		<div id="amval" style="position:absolute;top:550px;"></div>
		<br/>
		<div style="padding:10px;">
		<input type="button" name="anew" class="button add_new" id="submit-btn" value="Add" style="color:#666666;font-size:10px;padding-bottom:17px;" />
		</div>
		<div style="margin-left:100px;padding:5px;">
		<input type="hidden" id="amountcr" name="amountcr"
			class="field field_small"
			placeholder="Amount" value="" onkeypress="return handleEnter(this, event)" />
			<input type="hidden" id="err" name="err" value="" onkeypress="return handleEnter(this, event)">
		
		</div>
	</div>
	
	</form>
    </div>
	<div align="right"  ><a href="#dialog" name="modal" id="submit-btn" style="padding:10px; margin:5px;">DELETE VOUCHER</a></div>
	<div id="error"></div>
	<div id="boxes">

       <div id="dialog" class="window">
        
       <a href="#"class="close" style="margin-left:450px;"/>X</a>

       <div id="table_wrapper"></div>


     </div>
    </div>
  <div id="mask"></div>
<div id="bothead" style="position:fixed;background-color:#333333; margin:0 auto; padding:5px; top:10px; color:#FFFFFF; left:100px;float:right;width:800px; height:auto; display:none; font-family:'Courier New', Courier, monospace; font-size:14px;">
   <label>Press Sift ---- Calender expand</label><br/>
   <label>Press Ctrl OR Click Save Button----- Save Voucher</label><br/>
   <label>Press Insert--- Help</label><br/>
   <label>Press Enter---- Nevigation of fields</label><br />
   <label>Press Tab------ Nevigation of fields</label><br/><br/>
   <label>Press Home key ---------- Voucher type Payment will select</label><br/>
   <label>Press pg up key ---------- Voucher type Receive will select</label><br/>
   VOUCHER TYPE:<br/>
  ----------------<br/><br/>
   <label>After navigation to voucher Type Press R ---- Receive will select</label><br/> 
   <label>After navigation to voucher Type Press P ---- Payment will select</label><br/> 
   <label>After navigation to voucher Type Press J ---- Journal will select</label><br/> <br/>
   
   PAYMENT TYPE:<br/>
  ----------------<br/> 
   <label>After navigation to Pay Type Press C ---- Cash will select</label><br/> 
   <label>After navigation to Pay Type Press B ---- Bank will select</label><br/> 
   
   PRESS ESC<br/>
  ----------------<br/><br/>
   <label>Press ESC ---- Cursor Navigate to the narration field</label><br/>
   
   VOUCHER MISS BALANCED<BR/>
  ----------------------------<BR/><BR/>
   <label>2 Types of miss balanced occuured in the voucher</label><br/>
    <ul>
	 <li style="color:#FFFFFF;">1st Voucher miss balance lavel,this types of error occured for Receive and Payment type voucher,You see messege may be like this
	     <ul>
		   <li style="color:#FFFFFF;">A voucher still waiting for saving!you have to save the voucher first then start new one</li>
		 </ul>
	 </li>	
	 <li style="color:#FFFFFF;">2nd Voucher miss balance occured for journal voucher,You see messege may be like this
	   <ul><li style="color:#FFFFFF;">Debit and Credit not level you have to complete the voucher first or delete the voucher from queue</li></ul>
	 </li>
   </ul>    
	     
</div>		
	
	<div id="table_wrapper">
	<?php if (!empty($_SESSION['userid'])) { 
		
		?>
          
			<table cellpadding="0" cellspacing="0" border="0" class="tbl_repeat" style="width:500px;">
			
				<tr ><td colspan="4" height="30"></td>
				<tr>
					<th>Acc name</th>
					<th class="col_1 ta_r">Acc Type</th>
					<th class="col_1 ta_r">Amountdr</th>
					<th class="col_1 ta_r">Amountcr</th>
					<th class="col_1 ta_r">Action</th>

				</tr>
				
				<?php 
				$uac=$myDb->select("SELECT * FROM tbl_tmpjurnal WHERE opby='$_SESSION[userid]' AND vdate='$_SESSION[vdate]' order by id");
				$count=0;
				while($row=$myDb->get_row($uac,'MYSQL_ASSOC')){
				//foreach($products as $key => $row) {
				?>
									
					<tr>
						<td><?php echo $row['accname']; ?></td>
						<td class="ta_r"><?php echo $row['drcr']; ?></td>
						<td class="ta_r"><?php echo $row['amountdr']; ?></td>
						<td class="ta_r"><?php echo $row['amountcr']; ?></td>
						<td class="ta_r">
							<a href="#" class="remove" rel="<?php echo $row['id']; ?>">
								Remove
							</a>								
						</td>					</tr>
					
				<?php $count++;} ?>
			</table>
		<?php } else { ?>
			
			<p>There are currently no records available.</p>
		
		<?php } ?>
		
	</div>
	<div id="sum"></div>
</div>

<table width="100%" id="def" align="right">
<form method="post" name="savejournal" id="savejournal">
  <tr class="ef">
    <td class="d">
	<textarea name="description" id="description" cols="93" onkeypress="return handleEnter(this, event)" placeholder="Narration for voucher" style="width:400px; "></textarea>
  </tr>
  <tr>
    <td class="d"><div style="margin-left:370px;">
        <input type="button" id="submit-btn" value="Save" class="button snew" style="color:#666666;font-size:10px;padding:4px;padding-bottom:16px;"/>
      </div></td>
  </tr>
  
    <tr>
    <td class="d"><div id="flash"></div><div id="fsave"></div></td>
  </tr>
</form>
</table>
</td>
</tr>

<tr>
 <td height="60" colspan="2" valign="middle" bgcolor="#D3F3FE"><?php include("bot.php"); ?></td>
</tr>

    </table></td>
  </tr>
</table>
<script src="js/core.js" type="text/javascript"></script>

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