<?php include_once("config.php"); // the connection to the database 
if($myDb->connect($host,$user,$pwd,$db,true))
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
	$newCategory = mysql_query("UPDATE tbl_accchart SET accname= '".$_POST['accname']."', type='".$_POST['acctype']."', 
	                                                    opdate='$opdate',
														groupname='".$_POST['groupname']."'
														WHERE id = ".$_POST['category_id']) or die(mysql_error());
	?>
	<script type="text/javascript">	
		$(document).ready(function(){
			$.nyroModalRemove();
		});
	</script>	
	<?php
	
} else { 

// extract the max order number: the new category will have this order number + 1
$rsCategoryName = mysql_query("SELECT accname, type,groupname FROM tbl_accchart WHERE id = ".$_GET['category_id']) or die(mysql_error());
$results = mysql_fetch_array($rsCategoryName);
$categoryName = $results[0];

?>
<?php 
$pr=mysql_query("select*from tbl_accchart where id='$_GET[category_id]'") or die(mysql_error());
$prf=mysql_fetch_array($pr);

$p=mysql_query("select*from tbl_accchart where id='$_GET[category_id]'") or die(mysql_error());
$pf=mysql_fetch_array($p);

$gp=mysql_query("select*from tbl_accchart where id='$pf[parentid]'") or die(mysql_error());
$gpf=mysql_fetch_array($gp);
//echo "The parent id is:".$prf['parentid']."<br/>";
//echo "The 




if(($prf['parentid']==0)&&($gpf['parentid']==0)){

?>

<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]."?submitted=true" ?>" name="modify" id="modify" class="nyroModal">
	<label for="category_name"></label>
	<table width="450" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="95">Account Name:</td>
        <td width="155"><input type="text" value="<?php echo $categoryName ?>" name="accname" id="accname2" /></td>
        <td width="12">&nbsp;</td>
      </tr>
      <tr>
        <td>Account Type: </td>
        <td><select name="acctype" id="acctype" class="style2" onkeypress="return handleEnter(this, event)">
          <option selected="selected" value="<?php echo $results['type']; ?>"><?php echo $results['type']; ?></option>
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
        <td><input name="submit" type="submit" id="submit2" value="Modify" /></td>
        <td>&nbsp;</td>
      </tr>
    </table> <input type="hidden" name="groupname" id="groupname" value="0" />
	<input type="hidden" value="<?php echo $_GET['category_id'] ?>" name="category_id" id="category_id" />
</form>
<?php }else{ ?>

<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]."?submitted=true" ?>" name="modify" id="modify" class="nyroModal">
	<label for="category_name"></label>
	<table width="450" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="95">Account Name:</td>
        <td width="155"><input type="text" value="<?php echo $categoryName ?>" name="accname" id="accname2" /></td>
        <td width="12">&nbsp;</td>
      </tr>
      <tr>
        <td height="30"><span class="stars style2">*</span>Group Name: </td>
        <td height="30"><select name="groupname" class="style3" id="groupname" onkeypress="return handleEnter(this, event)">
            <?php $gnn=mysql_query("select*from tbl_accchart where id='$results[groupname]'") or die(mysql_error());
		          $gnnf=mysql_fetch_array($gnn);
		   ?>
		   <option selected="selected" value="<?php echo $gnnf['id']; ?>"><?php echo $gnnf['accname']; ?></option>
		   <?php $gn=mysql_query("select*from tbl_accchart where groupname in(select id from tbl_accchart where parentid=0 and groupname=0)") or die(mysql_error());
		        while($gnf=mysql_fetch_array($gn)){
		   ?>
		 
          <option value="<?php echo $gnf['id']; ?>"><?php echo $gnf['accname']; ?></option>
		  <?php } ?>
        </select></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Account Type: </td>
        <td><select name="acctype" id="acctype" class="style2" onkeypress="return handleEnter(this, event)">
          <option value="<?php echo $results[1]; ?>" selected><?php echo $results[1]; ?></option>
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
        <td><input name="submit" type="submit" id="submit2" value="Modify" /></td>
        <td>&nbsp;</td>
      </tr>
    </table>
	<input type="hidden" value="<?php echo $_GET['category_id'] ?>" name="category_id" id="category_id" />
</form>
<?php } ?>
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