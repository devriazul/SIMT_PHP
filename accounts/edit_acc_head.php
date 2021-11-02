<?php 
ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  	if($_SESSION['userid'])
	{
		$chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_root_acc_head.php' AND userid='$_SESSION[userid]'";
  		$caq=$myDb->select($chka);
  		$car=$myDb->get_row($caq,'MYSQL_ASSOC');
		if($car['ins']=="y")
		{ @$id=mysql_real_escape_string($_GET['id']);
		  $edrec=$myDb->select("SELECT*FROM tbl_accchart where id='$id' and storedstatus<>'D'");
		  $edrecf=$myDb->get_row($edrec,'MYSQL_ASSOC');
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
<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>
<script language="javascript" src="jquery.js"></script>
<script language="javascript">
 $(document).ready(function(){
   $('input[name="B1"]').click(function(){
    var arr=$('#form1').serializeArray();
	$.post("ed_acc_head.php",arr,function(r){
	  $('#shwrec').html(r);
	  
	});
	var searchid = $('#accname').val();
	var msg = "Ac/head transfered successfully";
	$.get("acchead_pagination.php?page=1&msg="+msg+"&searchid="+searchid,function(r){
		$('#container').html(r);
		$('.accpopup').hide();
	});

   
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
		//matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	$('.clsar').click(function(){
	  $('.accpopup').hide();
	});
});
</script>

<body>
          <div align="center" style="width:50%; margin:15% auto; background-color:#fff; padding:10px; ">

		<form id="form1" name="form1" method="post">
          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="2" >
            <tr>
              <td height="30" colspan="3" class="style2" style="border-bottom:1px solid #999999; ">MODIFY GROUP HEAD<div style="width:50px; height:20px; float:right; cursor:pointer; " class="clsar">X</div></td>
            </tr>
            <tr>
              <td class="style2">&nbsp;</td>
              <td height="20" class="style2">&nbsp;</td>
              <td height="20">&nbsp;</td>
            </tr>
            <tr>
              <td width="18%" class="style2">Account Name</td>
              <td width="2%" height="20" class="style2"><div align="center">:</div></td>
              <td width="80%" height="20"><div align="left"><input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
                <input name="accname" type="text" id="accname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="40" value="<?php echo $edrecf['accname']; ?>" />
              </div></td>
            </tr>
            <tr>
              <td class="style2">Parent</td>
              <td height="20" class="style2">:</td>
              <td height="20"><select name="parentid" id="parentid" class="style2" style="width:300px; " onkeypress="return handleEnter(this, event)">
				
				<?php $rt=$myDb->select("SELECT id,accname from tbl_accchart where storedstatus<>'D' order by id asc");
				while($rtf=$myDb->get_row($rt,'MYSQL_ASSOC')){
				?>
                <?php if($edrecf['parentid']==$rtf['id']){ ?>
				<option selected="selected" value="<?php echo $edrecf['parentid']; ?>"><?php echo $rtf['accname']; ?></option>
				<?php }else{ ?>
				<option  value=""></option>
				<?php } ?>
                <option value="<?php echo $rtf['id']; ?>"><?php echo $rtf['accname']; ?></option>
				<?php } ?>
              </select></td>
            </tr>
            <tr>
              <td class="style2">Group</td>
              <td height="20" class="style2">:</td>
              <td height="20"><select name="groupname" id="groupname" class="style2" style="width:300px; " onkeypress="return handleEnter(this, event)">
				<?php $rt=$myDb->select("SELECT id,accname from tbl_accchart where storedstatus<>'D' order by id asc");
				while($rtf=$myDb->get_row($rt,'MYSQL_ASSOC')){
				?>
                <?php if($edrecf['groupname']==$rtf['id']){ ?>
				<option selected="selected" value="<?php echo $edrecf['groupname']; ?>"><?php echo $rtf['accname']; ?></option>
				<?php }else{ ?>
				<option value=""></option>
				<?php } ?>
                <option value="<?php echo $rtf['id']; ?>"><?php echo $rtf['accname']; ?></option>
				<?php } ?>
              </select></td>
            </tr>
            <tr>
              <td class="style2">Account Type </td>
              <td height="20" class="style2"><div align="center">:</div></td>
              <td height="20"><div align="left">
                <select name="type" id="type" class="style2" onkeypress="return handleEnter(this, event)">
                    <option selected="selected" value="<?php echo $edrecf['type']; ?> "><?php echo $edrecf['type']; ?></option>
                    <option value="None">None</option>
				    <option value="Trading Account">Trading Account</option>
                    <option value="Profit Loss Account">Profit Loss Account</option>
                    <option value="Profit Loss App">Profit Loss App</option>
                    <option value="Expense Account">Expense Account</option>
                    <option value="Balance Sheet">Balance Sheet</option>
                </select>
              </div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><div align="center"></div></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><input type="button" value="Modify" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" /> 
                <input type="reset" name="Submit2" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/></td></tr>
          </table>          
          <p>&nbsp;</p>

            </form>
			
</table>
</div>

</body>
</html>
<?php 
}
else
{
	$msg="Sorry, You are not authorized to access this page.";
    header("Location:home.php?msg=$msg");
}
}else{
  header("Location:login.php");
}
}  
?>
