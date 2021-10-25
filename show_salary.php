<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  	if($_SESSION['userid'])
	{
		$q=$_GET['q'];
		
		//$s_scat=mysql_query("select ps.basicpay from tbl_staffinfo s inner join `tbl_payscale` ps on s.payscaleid=ps.id where s.payscaleid='$q'") or die(mysql_error());
		$s_scat=mysql_query("select ps.basicpay from `tbl_payscale` ps where id='$q'") or die(mysql_error());
		
		$bs=mysql_fetch_array($s_scat);
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
 
		 
</script><body leftmargin="0" topmargin="0">
<table width="70%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="55%"><input name="showsal" type="text" id="showsal" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" value="<?php echo $bs['basicpay'];?>" onkeypress="return handleEnter(this, event)" size="29" /></td>
  </tr>
</table>
<?php 
	}
}
?>