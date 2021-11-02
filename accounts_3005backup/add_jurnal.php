<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_jurnal.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  				$timezone = "Asia/Dhaka";
                if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);  

 $products = null;

if (!empty($_SESSION['products'])) {
	$products = $_SESSION['products'];
}
//$_SESSION['sdate']=$_POST['voucherdate'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>


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
	<link href="css/core.css" rel="stylesheet" type="text/css" />




<style type='text/css'>
#check_accname_availability{
	background: #225384;
	border:1px solid black;
	color:white;
}
body{
	font-family: 'tahoma';
}
input{
	padding:5px;
	font-family: 'tahoma';
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

<script type="text/javascript" src="datepickercontrol.js"></script>
  <script language="JavaScript">
  if (navigator.platform.toString().toLowerCase().indexOf("linux") != -1){
	 	document.write('<link type="text/css" rel="stylesheet" href="datepickercontrol_lnx.css">');
	 }
	 else{
	 	document.write('<link type="text/css" rel="stylesheet" href="datepickercontrol.css">');
	 }

</script>

<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="js/jquery.hotkeys.js"></script>

<script language="javascript">
 $(document).ready(function() {
    var arr = $(this).closest('form').serializeArray();
    $('.add_new').blur('click',function(){
       $.post('unique_valid.php', arr, function(data) {
	       $('#sum').load("unique_valid.php");
	   });
	});
	
	
	$("#accname").keypress(function(e){
                if (e.which ==32) 
                {
					$('#description').focus();
                };
    });
	$("#accname_m").keypress(function(e){
                if (e.which ==32) 
                {
					$('#description').focus();
                };
    });
	
	$(".snew").click(function(){
		   var arr = $('#savejournal').serializeArray();
           
		   
		   var descri=$("#description").val();
		   if(($("#description").val()=="")){
				  alert('Description can not left empty');
				  $('#accname').focus();
				  //alert(descri);
		   }else{
			   $.post('save_journal.php', arr, function(data) {
					 
					  $('#fsave').html(data);
					  $('#description').val('');		       
					  window.location.reload();

					  
			   });
			 
		   
			   $("#flash").show();
			   $("#flash").fadeIn(400).html('<img src="ajax-loader.gif" align="absmiddle">&nbsp;<span class="loading">Saving...</span>');
	
			   $('#accname').focus();
			   $('.tbl_repeat').fadeOut(300, function() {
						var msg = '<p>There are currently no records available.</p>';
						$('#table_wrapper').hide().html(msg).fadeIn(300);
			   });
				$('.tbl_rep').fadeOut(300, function() {
						var msg='';
						$('#table_wrap').hide().html(msg).fadeIn(300);
			   });
			   $('.sumacc').fadeOut(300,function(){  });
			   $('#amval').fadeOut(300,function(){ });
			   $("#flash").hide();
		}  
	});
	
	$('#vouchertype').change(function(){
	    var vtpe=$('#vouchertype').val();
	    switch(vtpe){
		  case "P":
			  //$("#atpe").fadeIn(900,0);
			  //$("#atpe").html('<img src="ajax-loader.gif" align="absmiddle">&nbsp;<span class="loading">Loading...</span>');
		      $('#acctype').val("CR");
			  $('#dc').show();
			  $('#dc').text("DR");
			  $('#dcc').show();
			  $('#dcc').text("CR");
			  $('#am').fadeIn(900,0).show();
			 $("#paytype").keypress(function(e){
			    if(e.which ==13){
			      $("#accname_m").focus();
			    };
			 });			  
			 
			 /*$('#accname').keypress(function(e){
			    if(e.which==13){
				  $('#amountdr').focus();
				}
			 
			 });
			 */
			 $('#accname_m').focus(function(){
			   $.get('remaning_value.php', function(result) {
				   $('#amountdr').val(result);
			   });
			   
				 $('#amval').load('amount_level.php').fadeIn(300);
				 
			 }); 
			  //$('#atpe').fadeOut('slow');
			 break;
		  case "R":
		     $('#acctype').val("DR");
			 $('#dc').show();
			 $('#dc').text("CR");
			 $('#dcc').show();
			 $('#dcc').text("DR");
			 $('#am').fadeIn(900,0).show();
			 $("#paytype").keypress(function(e){
			    if(e.which ==13){
			      $("#accname_m").focus();
			    };
			 });
			 /*$('#accname').keypress(function(e){
			    if(e.which==13){
				  $('#amountdr').focus();
				}
			 
			 });
			 */
			 $('#accname_m').focus(function(){
			   $.get('remaning_value.php', function(result) {
				   $('#amountdr').val(result);
			   });
			   
				 $('#amval').load('amount_level.php').fadeIn(300);
				 
			 });
			 

			 break;
		  case "J":
		     $('#acctype').val("DR");
			 $('#dc').hide();
			 $('#dcc').hide();
			 $('#am').fadeOut('slow');
			 $("#paytype").keypress(function(e){
			    if(e.which ==13){
			      $("#accname").focus();
			    };
			 });
			 
			 /*$('#accname').keypress(function(e){
			    if(e.which==13){
				  $('#acctype').focus();
				}
			 
			 });
			 */
			 $('#accname').focus(function(){
			   $.get('remaning_value.php', function(result) {
				   $('#amountdr').val(result);
			   });
			   
				 $('#amval').load('amount_level.php').fadeIn(300);
				 
			 }); 
			 
			 break;
		  default:
		     $('#acctype').val("DR");	
			 $('#accname_m').focus(function(){
			    $.get('remaning_value.php', function(result) {
				   $('#amountdr').val(result);
			    });
			   
				 $('#amval').load('amount_level.php').fadeIn(300);
				 
			 }); 
		
		}
				 

		   
	});

	 
});

</script>

<script language="javascript">
  $(document).ready(function(){
  
			 $('#accname_m').keyup(function(){
			    var p=$('#accname_m').val();
			    $.get('accname_bottomhead.php?p='+p,function(result){
				    $('#bothead').show();
				    $('#bothead').html(result);
					//$('#selectmenu').focus();
				
				});
	       $("#bothead").fadeIn('slow');
		   $("#bothead").html("<img src='bigLoader.gif' />");
			 
			 });
			 
			 $('#accname_m').keypress(function(e){
			   if(e.which==13){
			      $('#selectmenu').focus();
			   }	  
			 
			 }); 
			 
			 
			 $('#accname').keyup(function(){
			    var p=$('#accname').val();
			    $.get('accname_bottomhead_child.php?p='+p,function(result){
				    $('#bothead').show();
				    $('#bothead').html(result);
					//$('#selectmenu').focus();
				
				});
	       $("#bothead").fadeIn('slow');
		   $("#bothead").html("<img src='bigLoader.gif' />");
			 
			 });
			 
			 $('#accname').keypress(function(e){
			   if(e.which==13){
			      $('#selectmenu1').focus();
			   }	  
			 
			 }); 
			 
			 
			 

  
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
					<th class="col_1 ta_r" colspan="4">Error</th>
				</tr>
				
				<?php foreach($prod as $key => $row) { ?>
					
					<tr>
						<td   colspan="4" class="remove" rel="<?php echo $key; ?>"><?php echo $row['err']; ?></td>
					</tr >
					
				<?php } ?>
			
			</table>
		<?php }?>
	</div>

		
		
<div id="wrapper">

    <div style="float:left;width:420px;height:320px;border:1px solid #CCCCCC;margin-left:50px;">
	<div style="border-bottom:1px solid #CCCCCC;width:auto;padding:10px;">Voucher Entry</div>
	<form action="new_entry.php" method="post" id="form_products" name="form_products">
	<div style="padding:10px;">
	
	<label style="float:left;margin-left:10px;margin-top:10px;">Voucher Date:</label>
		<div style="margin-left:135px;"><input name="voucherdate" type="text" id="DPC_voucherdate_YYYY-MM-DD" onkeypress="return handleEnter(this, event)" class="field field_medium"
			placeholder="Voucher Date" value="<?php echo date("Y-m-d"); ?>" />
	</div>		
	
	<label style="float:left;margin-left:10px;margin-top:10px;">Voucher Type:</label>
		<div style="margin-left:135px;"><select name="vouchertype" id="vouchertype" class="field field_medium"
			placeholder="Voucher Type"  onkeypress="return handleEnter(this, event)">
                <option value="">Select Voucher type</option>
                <option value="R">Receive</option>
                <option value="P">Payment</option>
                <option value="J">Journal</option>
              </select>
		 </div>
			  
	<label style="float:left;margin-left:10px;margin-top:10px;">Pay Type:</label>
		<div style="margin-left:135px;"><select name="paytype" id="paytype" class="field field_medium"
			placeholder="Pay Type"  onkeypress="return handleEnter(this, event)">
                <option value="">Select Pay type</option>
                <option value="cash">Cash</option>
                <option value="bank">Bank</option>
                
              </select></div>		
			  
	  <div id="am">
	  <label style="float:left;margin-left:10px;margin-top:10px;">Account Name:</label>
	       <div style="margin-left:135px;">  <input type="text" id="accname_m" name="accname_m"
			class="field field_medium"
			placeholder="Through Account name" value="" onkeypress="return handleEnter(this, event)" />
			
			<div id='accname_availability_result'><div id="dc" style="margin-left:200px;margin-top:80px;"></div></div>

			</div>
	 </div>		
	
	 <label style="float:left;margin-left:10px;margin-top:10px;">Account Name:</label>
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
			class="field field_small"
			placeholder="Amount" value="" onkeypress="return handleEnter(this, event)" />
			
			
			</div>
		<br/>
		<div id="amval" style="position:absolute;top:500px;"></div>
		
		<div style="margin-left:128px;padding:10px;">
		<input type="button" name="anew" class="button add_new" value="Add" style="color:#666666;font-size:10px;padding-bottom:17px;" />
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
	
	<div id="error"></div>
	<div id="boxes">

       <div id="dialog" class="window">
        
       <a href="#"class="close" style="margin-left:450px;"/>X</a>

       <div id="table_wrapper"></div>


     </div>
    </div>
  <div id="mask"></div>
<div id="bothead" style="float:right;width:300px; height:200px;">
 

</div>		
	
	<div id="table_wrapper">
	<?php if (!empty($_SESSION['userid'])) { 
		
		?>
          
			<table cellpadding="0" cellspacing="0" border="0" class="tbl_repeat" width="100%">
			
				<tr ><td colspan="4" height="30"><div align="right"><a href="#dialog" name="modal">DELETE VOUCHER</a></div></td>
				<tr>
					<th>Acc name</th>
					<th class="col_1 ta_r">Acc Type</th>
					<th class="col_1 ta_r">Amountdr</th>
					<th class="col_1 ta_r">Amountcr</th>
				</tr>
				
				<?php 
				$uac=$myDb->select("SELECT * FROM tbl_tmpjurnal WHERE masteraccno<>0 AND opby='$_SESSION[userid]' AND vdate='".date("Y-m-d")."'");
				while($uacf=$myDb->get_row($uac,'MYSQL_ASSOC')){
				?>
									
					<tr>
						<td><?php echo $uacf['accname']; ?></td>
						<td class="ta_r"><?php echo $uacf['drcr']; ?></td>
						<td class="ta_r"><?php echo $uacf['amountdr']; ?></td>
						<td class="ta_r"><?php echo $uacf['amountcr']; ?></td>
					</tr>
					
				<?php } ?>
			
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
	<textarea name="description" id="description" cols="93" onkeypress="return handleEnter(this, event)"></textarea>
  </tr>
  <tr>
    <td class="d"><div style="margin-left:350px;"><input type="button" id="save" value="Save" class="button snew" style="color:#666666;font-size:10px;padding:4px;padding-bottom:16px;"/></div></td>
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
	 header("Location:acchome.html?msg=$msg");
   }	 

}else{
  header("Location:login.html");
}
}  
?>