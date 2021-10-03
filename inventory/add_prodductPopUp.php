<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='requisition_list.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
?>
<style type="text/css">
@import url("main.css");

.form-table1{
   margin-left:10px;
   font-family:Verdana, Arial, Helvetica, sans-serif;
   font-size:12px;
   
}
.form-table1 td{
   padding:3px;
   color:#FFFFFF;
}      
</style>

<script language="javascript" src="jquery-1.4.2.js"></script>

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
     $('#submit').css({'margin-left':'5px','margin-top':'5px','margin-bottom':'5px','border':'1px solid #999999'});
	 $('#submit').click(function(){
	   var pname=$('#pname').val();

	   var arr=$('#sfrm').serializeArray();
	   if($('#pname').val()==""){
	     alert("Product Name can not left empty");
		 $('#pname').focus();
		 return false;
	   }
	   if($('#prtype').val()==""){
	     alert("Product type can not left empty");
		 $('#prtype').focus();
		 return false;
	   }
	  
	   $.post('ins_product.php?q='+pname,arr,function(res){
	      $('#insup').html(res).hide().fadeIn('slow');
		  $('#pname').focus();

		  document.sfrm.reset();
		  
		  
		  	   $("#preview").html('');
				$("#current").hide();
			$("#imageform").ajaxForm({
						target: '#preview'
		    }).submit();
			

	   }); 
	 
	 });

  });
</script>

<script type="text/javascript" src="jquery.js"></script>
<script language="javascript" type="text/javascript">
 $(document).ready(function(){
   /*$('#prtype').keyup(function(e){
     
	   var prtype=$('#prtype').val();   
	   $.get("validatetext.php?prtype="+prtype+"&equip=1",function(r){
	     $('#validatetext').html(r);
	   });
	   $.get("formetText.php?prtype="+prtype+"&equip=1",function(r){
	     $('#prtype').val(r);
	   });
   
   });
  $('#prtype').keypress(function(e){
     
	   var prtype=$('#prtype').val();   
	   $.get("validatetext.php?prtype="+prtype+"&equip=1",function(r){
	     $('#validatetext').html(r);
	   });
   
   });*/
   
   
   
   $('#mname').focus(function(){
	   var prtype=$('#prtype').val();   
	   $.get("validatetext.php?prtype="+prtype+"&equip=1",function(r){
	     $('#validatetext').html(r);
	   });
	   $.get("formetText.php?prtype="+prtype+"&equip=1",function(r){
	     $('#prtype').val(r);
	   });
   
   });
   
   
      
   /*$('#mname').keyup(function(e){
	   var prtype=$('#mname').val();   
	   $.get("validatetext.php?prtype="+prtype+"&equip=2",function(r){
	     $('#validatetext').html(r);
	   });
	   $.get("formetText.php?prtype="+prtype+"&equip=1",function(r){
	     $('#mname').val(r);
	   });
   });
   
   $('#mname').keypress(function(e){
	   var prtype=$('#mname').val();   
	   $.get("validatetext.php?prtype="+prtype+"&equip=2",function(r){
	     $('#validatetext').html(r);
	   });
   });
   */
   $('#qty').focus(function(){
	   var prtype=$('#mname').val();   
	   $.get("validatetext.php?prtype="+prtype+"&equip=2",function(r){
	     $('#validatetext').html(r);
	   });
	   $.get("formetText.php?prtype="+prtype+"&equip=1",function(r){
	     $('#mname').val(r);
	   });
   
   });
   
   
   /*$('#pname').keyup(function(e){
	   var prtype=$('#pname').val();   
	   $.get("validatetext.php?prtype="+prtype+"&equip=3",function(r){
	     $('#validatetext').html(r);
	   });
	   $.get("formetText.php?prtype="+prtype+"&equip=1",function(r){
	     $('#pname').val(r);
	   });
   });
   
   $('#pname').keypress(function(e){
	   var prtype=$('#pname').val();   
	   $.get("validatetext.php?prtype="+prtype+"&equip=3",function(r){
	     $('#validatetext').html(r);
	   });
   });
   */
   
   $('#packsize').focus(function(){
	   var prtype=$('#pname').val();   
	   $.get("validatetext.php?prtype="+prtype+"&equip=2",function(r){
	     $('#validatetext').html(r);
	   });
	   $.get("formetText.php?prtype="+prtype+"&equip=1",function(r){
	     $('#pname').val(r);
	   });
   
   });
   
 
 });

</script>

<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#prtype").autocomplete("search_prtype.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#mname").autocomplete("search_manufacturer.php", {
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



<script language="javascript" type="text/javascript">
 $(document).ready(function(){
	 
	 
	 $('#close').click(function(e){
	   e.preventDefault();
	   $('#addPrForm').fadeOut();
	 });
	 
	 $('#pname').keypress(function(){
	   var pname=$('#pname').val();
	   var prtype=$('#prtype').val();
	   $.get("productExistancy.php?pname="+pname+"&prtype="+prtype,function(r){
	     $('#prdshow').css({'color':'#999','overflow':'auto'}).html(r);
	   });
	 
	 });
	 
	 $('#pname').keyup(function(){
	   var pname=$('#pname').val();
	   var prtype=$('#prtype').val();
	   $.get("productExistancy.php?pname="+pname+"&prtype="+prtype,function(r){
	     $('#prdshow').css({'color':'#999','overflow':'auto'}).html(r);
	   });
	 
	 });
	 
 });

</script>
<script type="text/javascript" src="jquery.form.js"></script>


<style>

body
{
font-family:arial;
}
.preview
{
max-width:200px;
max-height:250px;
border:solid 1px #dedede;
padding:5px;
margin-left:90px;

}
#preview
{
color:#cc0000;
font-size:12px
}

.style17 {color: #333333}
</style>
<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>

<table width="300" border="0" cellspacing="0" cellpadding="0" class="form-table1" style="height:auto; ">
  <tr>
    <td height="30" colspan="3" style="border-bottom:1px solid #333333; background-color:#CCCCCC; "><span class="style17">Add Product </span>
    <div  style="width:20px; float:right" ><a href="#" id="close">[x]</a></div></td>
  </tr>
  <form name="sfrm" id="sfrm" method="post">
  <tr>
    <td>Product Type*</td>
    <td>:</td>
    <td><label>
<select name="prtype" id="prtype" onkeypress="return handleEnter(this, event)" >
		  <option value="">Select product type</option>
		  <?php $prt=$myDb->select("SELECT*FROM tbl_store");
		        while($prtf=$myDb->get_row($prt,'MYSQL_ASSOC')){
		  ?>
		   <option value="<?php echo $prtf['storeid']; ?>"><?php echo $prtf['storename']; ?></option>
		   <?php } ?>		
		</select> 
  </span></label></td>
  </tr>
      <input type="hidden" name="mname" id="mname" onkeypress="return handleEnter(this, event)"/>
  
  <tr>
    <td width="141">Name*</td>
    <td width="11">:</td>
    <td width="548"><label>
      <input type="text" name="pname" id="pname" onKeyPress="return handleEnter(this, event)" />
    </label>
	<div id="prdshow" style="color:#FF0000; "></div>
	</td>
  </tr>
  <tr>
    <td>Pack Size</td>
    <td>:</td>
    <td><label>
      <input type="text" name="packsize" id="packsize" onKeyPress="return handleEnter(this, event)" />
    </label></td>
  </tr>
   

  <tr>
    <td>Opening Value </td>
    <td>:</td>
    <td><input type="text" name="qty" id="qty" onkeypress="return handleEnter(this, event)"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><label>
      <input type="button" name="submit" id="submit" value="Submit" />
    </label></td>
  </tr>
  </form>

<tr><td colspan="3">
<div id='preview'></div>
<div id="validatetext" style="width:500px; overflow:auto; "></div>
</td></tr>


</table>
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}