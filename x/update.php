<?php include_once("config.php"); // the connection to the database 
if($myDb->connectDefaultServer())
{
?>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #000000;
}
-->
</style>

<div style="overflow:hidden; margin:1em;">
<h1 class="style1">Update Accounts </h1>
<?php if(isset($_GET['submitted'])) { 
	$opdate=date("Y-m-d");
	$newCategory = mysql_query("UPDATE tbl_accchart SET accname= '".$_POST['accname']."', type='".$_POST['acctype']."', opdate='$opdate' WHERE id = ".$_POST['category_id']) or die(mysql_error());
	?>
	<script type="text/javascript">	
		$(document).ready(function(){
			$.nyroModalRemove();
		});
	</script>	
	<?php
	
} else { 

// extract the max order number: the new category will have this order number + 1
$rsCategoryName = mysql_query("SELECT accname, type FROM tbl_accchart WHERE id = ".$_GET['category_id']) or die(mysql_error());
$results = mysql_fetch_array($rsCategoryName);
$categoryName = $results[0];

?>

<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]."?submitted=true" ?>" name="modify" id="modify" class="nyroModal">
	<label for="category_name"></label>
	<table width="262" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="95">Account Name:</td>
        <td width="155"><input type="text" value="<?php echo $categoryName ?>" name="accname" id="accname2" /></td>
        <td width="12">&nbsp;</td>
      </tr>
      <tr>
        <td>Account Type: </td>
        <td><select name="acctype" id="acctype" class="style2" onkeypress="return handleEnter(this, event)">
          <option value="<?php echo $results[1]; ?>" selected><?php echo $results[1]; ?></option>
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
        <td><input name="submit" type="submit" id="submit2" value="Modify" /></td>
        <td>&nbsp;</td>
      </tr>
    </table>
	<input type="hidden" value="<?php echo $_GET['category_id'] ?>" name="category_id" id="category_id" />
</form>
<script type="text/javascript">	
	$(document).ready(function(){
		$("#form_submit").click(function(e){
			e.preventDefault();
			if ( $("#category_name").val() != "" ) $("#modify").submit();
			else alert("Please insert the name of the new category");
		});
	});
</script>	 
<?php }} ?>
</div>