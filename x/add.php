<?php 
ob_start();
session_start();
include_once("config.php"); // the connection to the database
if($myDb->connectDefaultServer())
{
 ?>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
<style type="text/css">
<!--
.style1 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #000000;
}
.style2 {color: #FF0000}
.style3 {color: #000000}
-->
</style>


<div style="overflow:hidden; margin:1em;">
<h1><span class="style1">Add New Account</span></h1>
<?php if(isset($_GET['submitted'])) { 
	$opdate=date("Y-m-d");
	$newCategory = mysql_query("INSERT INTO tbl_accchart (parentid, accname, type, orderby, opby, opdate, storedstatus) 
								VALUES ('".$_POST['parent_id']."','".$_POST['accname']."','".$_POST['acctype']."','".$_POST['orderby']."','$_SESSION[userid]','$opdate','I')
								") or die(mysql_error());
	//$cas=mysql_query("select max(id) mid from category") or die(mysql_error());
	//$casf=mysql_fetch_array($cas); 							
	//$newPCategory = mysql_query("INSERT INTO persistenttree_category (parent_id, category_id, orderby) 
		//						VALUES ('".$_POST['parent_id']."','$casf[mid]','".$_POST['orderby']."')
		//						") or die(mysql_error());							
	?>
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
	<script type="text/javascript">	
		$(document).ready(function(){
			$.nyroModalRemove();
		});
	</script>	



	<?php
	
} else { 

// extract the max order number: the new category will have this order number + 1
$rsMaxOrder = mysql_query("SELECT MAX(orderby) FROM tbl_accchart WHERE parentid ='$_GET[category_id]'") or die(mysql_error());
$results = mysql_fetch_array($rsMaxOrder);
$maxOrderby = $results[0];

?>
<form action="<?php echo $_SERVER["PHP_SELF"]."?submitted=true" ?>" method="POST" name="add_new" class="nyroModal" id="add_new" onSubmit="MM_validateForm('accname','','R');return document.MM_returnValue">
<table width="297" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="35" colspan="3"><div align="left"><span class="stars style2">*</span>(Mandatory Field) </div></td>
      </tr>
      <tr>
        <td><span class="stars style2">*</span>Account Name:</td>
        <td><input type="text" value="" name="accname" id="accname" onKeyPress="return handleEnter(this, event)" /></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><span class="stars style2">*</span>Account Type: </td>
        <td><select name="acctype" class="style3" id="select" onkeypress="return handleEnter(this, event)">
          <option value="Trading Account">Trading Account</option>
          <option value="Profit Loss Account">Profit Loss Account</option>
          <option value="Profit Loss App">Profit Loss App</option>
          <option value="Expense Account">Expense Account</option>
          <option value="Balance Sheet">Balance Sheet</option>
                </select></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" id="submit" value="Add" /></td>
        <td>&nbsp;</td>
      </tr>
    </table>
	<input type="hidden" value="<?php echo $_GET['category_id'] ?>" name="parent_id" id="parent_id" />
	<input type="hidden" value="<?php echo $maxOrderby+1 ?>" name="orderby" id="orderby" />
</form>
<script type="text/javascript">	
	$(document).ready(function(){
		$("#form_submit").click(function(e){
			e.preventDefault();
			if ( $("#category_name").val() != "" ) $("#add_new").submit();
			else alert("Please insert the name of the new Account.");
		});
	});
</script>	 
<?php } } ?>
</div>