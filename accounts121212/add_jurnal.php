<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_jurnal.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
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
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script type="text/javascript">
$().ready(function() {
	$("#searchid").autocomplete("search_hostelname.html", {
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
});
</script>

<script language="javascript">
 $(document).ready(function() {
    var arr = $(this).closest('form').serializeArray();
    $('.add_new').blur('click',function(){
       $.post('unique_valid.php', arr, function(data) {
	       $('#sum').load("unique_valid.php");
	   });
	});
	
	$('#accname').focus(function(){
	   $.get('remaning_value.php', function(result) {
         $('#amountdr').val(result);
       });
       
         $('#amval').load('amount_level.php');
       	 
	}); 
	
	$("#accname").keypress(function(e){
                if (e.which ==32) 
                {
					$('#description').focus();
                };
    });
	
	$("#save").click(function(){
	
	   $("#fsave").load('save_journal.php');
	
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

			<table cellpadding="0" cellspacing="0" border="0" class="tbl_rep">
			
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

    <div style="float:left;width:395px;height:280px;border:1px solid #CCCCCC;margin-left:150px;">
	<div style="border-bottom:1px solid #CCCCCC;width:auto;padding:10px;">Voucher Entry</div>
	<form action="new_entry.php" method="post" id="form_products" name="form_products">
	<div style="padding:10px;">
	<label style="float:left;margin-left:10px;">Voucher Date:</label>
		<div style="margin-left:125px;"><input name="voucherdate" type="text" id="DPC_voucherdate_YYYY-MM-DD" onkeypress="return handleEnter(this, event)" class="field field_medium"
			placeholder="Voucher Date" value="<?php echo date("Y-m-d"); ?>" />
	</div>		
	<label style="float:left;margin-left:10px;">Voucher Type:</label>
		<div style="margin-left:125px;"><select name="vouchertype" id="vouchertype" class="field field_medium"
			placeholder="Voucher Type"  onkeypress="return handleEnter(this, event)">
                <option value="">Select Voucher type</option>
                <option value="R">Receive</option>
                <option value="P">Payment</option>
                <option value="J">Jurnal</option>
              </select></div>
			  
	<label style="float:left;margin-left:10px;">Pay Type:</label>
		<div style="margin-left:125px;"><select name="paytype" id="paytype" class="field field_medium"
			placeholder="Pay Type"  onkeypress="return handleEnter(this, event)">
                <option value="">Select Pay type</option>
                <option value="cash">Cash</option>
                <option value="bank">Bank</option>
                
              </select></div>		  
	<label style="float:left;margin-left:10px;">Account Name:</label>
	       <div style="margin-left:125px;"><input type="text" id="accname" name="accname"
			class="field field_medium"
			placeholder="Account name" value="" onkeypress="return handleEnter(this, event)" />
			<div id='accname_availability_result'></div>

			</div>
		
			  
			 <label style="float:left;margin-left:10px;">Account Type:</label>
			 <div style="margin-left:125px;"><select name="acctype" id="acctype" onkeypress="return handleEnter(this, event)" class="field field_medium"
			placeholder="Account Type" >
			      <option value="">Select Account Type</option>
                  <option value="DR">Debit</option>
                  <option value="CR">Credit</option>
                </select></div>
		    <label style="float:left;margin-left:10px;">Amount:</label>
			<div style="margin-left:125px;"><input type="text" id="amountdr" name="amountdr"
			class="field field_small"
			placeholder="Amount" value="" onkeypress="return handleEnter(this, event)" />
			
			
			</div>
		
		<div style="margin-left:130px;margin-top:10px;">
		<input type="button" name="anew" class="button add_new" value="Add" style="color:#666666;font-size:10px;padding-bottom:17px;" />
		<input type="submit" name="anew" class="button anew" value="Add New" style="color:#666666;font-size:10px;padding:4px;padding-bottom:16px;" />
		</div>
		<div style="margin-left:100px;margin-top:10px;">
		<div id="amval" style="margin-top:200px;"></div>
		<input type="hidden" id="amountcr" name="amountcr"
			class="field field_small"
			placeholder="Amount" value="" onkeypress="return handleEnter(this, event)" />
			<input type="hidden" id="err" name="err" value="" onkeypress="return handleEnter(this, event)">
		
		</div>
	</div>
	
	</form>
    </div>
	<div id="error"></div>
	
		
	
	<div id="table_wrapper">
	<?php if (!empty($products)) { 
		
		?>
          
			<table cellpadding="0" cellspacing="0" border="0" class="tbl_repeat">
			
				<tr>
					<th>Acc name</th>
					<th class="col_1 ta_r">Acc Type</th>
					<th class="col_1 ta_r">Amountdr</th>
					<th class="col_1 ta_r">Amountcr</th>
					<th class="col_1 ta_r">Remove</th>
				</tr>
				
				<?php foreach($products as $key => $row) { ?>
					
					<tr>
						<td><?php echo $row['accname']; ?></td>
						<td class="ta_r"><?php echo $row['acctype']; ?></td>
						<td class="ta_r"><?php echo $row['amountdr']; ?></td>
						<td class="ta_r"><?php echo $row['amountcr']; ?></td>
						<td class="ta_r">
							<a href="#" class="remove" rel="<?php echo $key; ?>">
								Remove
							</a>								
						</td>
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
  <tr class="ef">
    <td class="d"><textarea name="description" id="description" cols="93"> 
	</textarea>
  </tr>
  <tr>
    <td class="d"><div style="margin-left:350px;"><input type="button" id="save" value="Save" class="button snew" style="color:#666666;font-size:10px;padding:4px;padding-bottom:16px;"/></div></td>
  </tr>
    <tr>
    <td class="d"><div id="fsave"></div></td>
  </tr>

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