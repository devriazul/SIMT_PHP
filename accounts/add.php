<?php 
ob_start();
session_start();
include_once("config.php"); // the connection to the database
if($myDb->connect($host,$user,$pwd,$db,true))
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
		<script type="text/javascript">	
	$(document).ready(function(){
		$("#submit").click(function(e){
			e.preventDefault();
			//alert($('#accname').val());
			if($("#accname").val()==""){ 
		
			  alert("Please insert the name of the new Account."); 
			  $('#accname').focus();
			  //return false;
			}else if($('#acctype').val()==""){
			  alert("Please insert account type");
			  $('#acctype').focus();
			
			}else if($('#groupname').val()==""){
			  alert("Please insert group name");
			  $('#groupname').focus();
			
			}else{
			
			  $('#add_new').submit();
		   }	    
		});
	});
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
	if($_POST['groupname']>0){
		$newCategory = mysql_query("INSERT INTO tbl_accchart (parentid, accname, type, orderby, opby, opdate, storedstatus,groupname) 
									VALUES ('".$_POST['parent_id']."','".mysql_real_escape_string($_POST['accname'])."','".$_POST['acctype']."',
											'".$_POST['orderby']."','$_SESSION[userid]','$opdate','I','".$_POST['groupname']."')
									") or die(mysql_error());
	}else{
	     if($_POST['gpn']=="Y"){
				$newCategory = mysql_query("INSERT INTO tbl_accchart (parentid, accname, type, orderby, opby, opdate, storedstatus,groupname) 
									VALUES ('".$_POST['parent_id']."','".mysql_real_escape_string($_POST['accname'])."','".$_POST['acctype']."',
											'".$_POST['orderby']."','$_SESSION[userid]','$opdate','I','".$_POST['parent_id']."')
									") or die(mysql_error());
		 
		 }else{
				$newCategory = mysql_query("INSERT INTO tbl_accchart (parentid, accname, type, orderby, opby, opdate, storedstatus,groupname) 
									VALUES ('".$_POST['parent_id']."','".mysql_real_escape_string($_POST['accname'])."','".$_POST['acctype']."',
											'".$_POST['orderby']."','$_SESSION[userid]','$opdate','I','".$_POST['groupname']."')
									") or die(mysql_error());
		 
		 }
	
	
	}							
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

<?php 
$pr=mysql_query("select*from tbl_accchart where id='$_GET[category_id]'") or die(mysql_error());
$prf=mysql_fetch_array($pr);

$p=mysql_query("select*from tbl_accchart where id='$_GET[category_id]'") or die(mysql_error());
$pf=mysql_fetch_array($p);

$gp=mysql_query("select*from tbl_accchart where id='$pf[parentid]'") or die(mysql_error());
$gpf=mysql_fetch_array($gp);


if(($prf['parentid']==0)){//||($gpf['parentid']==0)){

?>
<form action="<?php echo $_SERVER["PHP_SELF"]."?submitted=true" ?>" method="POST" name="add_new" class="nyroModal" id="add_new">


<table width="350" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="35" colspan="3"><div align="left"><span class="stars style2">*</span>(Mandatory Field) <?php echo "parentid is:".$_GET['category_id']; ?>
          <label>
          <input type="checkbox" name="gpn" id="gpn" value="Y" />
          </label>
        Group same as parent </div></td>
      </tr>
      <tr>
        <td height="30"><span class="stars style2">*</span>Account Name:</td>
        <td height="30"><input type="text" name="accname" id="accname" onKeyPress="return handleEnter(this, event)" /></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="30"><span class="stars style2">*</span>Account Type: </td>
        <td height="30"><select name="acctype" class="style3" id="acctype" onkeypress="return handleEnter(this, event)">
		  <option value="">Select acctype</option>
          <option value="Trading Account">Trading Account</option>
          <option value="Profit Loss Account">Profit Loss Account</option>
          <option value="Profit Loss App">Profit Loss App</option>
          <option value="Expense Account">Expense Account</option>
		  <option value="Income Account">Income Account</option>

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
	<input type="hidden" value="0" name="groupname" id="groupname" />
	<input type="hidden" value="<?php echo $_GET['category_id'] ?>" name="parent_id" id="parent_id" />
	<input type="hidden" value="<?php echo $maxOrderby+1 ?>" name="orderby" id="orderby" />
</form>
<?php }else{ ?>
<form action="<?php echo $_SERVER["PHP_SELF"]."?submitted=true" ?>" method="POST" name="add_new" class="nyroModal" id="add_new" onSubmit="MM_validateForm('accname','','R');return document.MM_returnValue">


<table width="350" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="35" colspan="3"><div align="left"><span class="stars style2">*</span>(Mandatory Field) <?php echo "parentid is:".$_GET['category_id']; ?></div></td>
      </tr>
      <tr>
        <td height="30"><span class="stars style2">*</span>Account Name:</td>
        <td height="30"><input type="text" name="accname" id="accname" onKeyPress="return handleEnter(this, event)" /></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="30"><span class="stars style2">*</span>Group Name: </td>
        <td height="30"><select name="groupname" class="style3" id="groupname" onkeypress="return handleEnter(this, event)">
           <option value="">Select group</option>
		   <?php $mg=mysql_query("select*from tbl_accchart where id='$_GET[category_id]'") or die(mysql_error());
		         $mgf=mysql_fetch_array($mg);
				 if($mgf['groupname']==0){
		   ?>
          <option value="<?php echo $mgf['id']; ?>"><?php echo $mgf['accname']; ?></option>
		  <?php }else{ ?>
		   <?php $gn=mysql_query("select*from tbl_accchart where groupname=0 and parentid=0 and id in(select groupname from tbl_accchart where id='$_GET[category_id]')") or die(mysql_error());
		         $gnf=mysql_fetch_array($gn);
				 $cgn=mysql_query("select*from tbl_accchart where id='$gnf[groupname]'") or die(mysql_error());
				 $cgnf=mysql_fetch_array($cgn);
		   ?>
		 
          <option value="<?php echo $gnf['id']; ?>"><?php echo $gnf['accname']; ?></option>
		  <?php  } ?>
        </select></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="30"><span class="stars style2">*</span>Account Type: </td>
        <td height="30"><select name="acctype" class="style3" id="acctype" onkeypress="return handleEnter(this, event)">
		  <option value="">Select acctype</option>
          <option value="Trading Account">Trading Account</option>
          <option value="Profit Loss Account">Profit Loss Account</option>
          <option value="Profit Loss App">Profit Loss App</option>
          <option value="Expense Account">Expense Account</option>
          <option value="Balance Sheet">Balance Sheet</option>
		  <option value="Income Account">Income Account</option>
        </select></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit"  type="submit" id="submit" value="Add" /></td>
        <td>&nbsp;</td>
      </tr>
    </table>
	<input type="hidden" value="<?php echo $_GET['category_id'] ?>" name="parent_id" id="parent_id" />
	<input type="hidden" value="<?php echo $maxOrderby+1 ?>" name="orderby" id="orderby" />
</form>
<?php } ?>
<?php } } ?>
</div>