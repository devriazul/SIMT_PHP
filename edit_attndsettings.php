<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  $chka="SELECT ats.*, a.accname From tbl_attendancesettings ats inner join tbl_access a on ats.accid=a.id WHERE ats.id='$_GET[id]'";
  $caq=$myDb->select($chka);
  $cdata=$myDb->get_row($caq,'MYSQL_ASSOC');

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
<script language="javascript">
function checkedq(){
     if(document.getElementById("stdintime").value==""){
         alert('stdintime can not left empty!');
	     document.getElementById("stdintime").focus();
	     return false;
     }
     if(document.getElementById("stdouttime").value==""){
         alert('stdouttime can not left empty!');
	     document.getElementById("stdouttime").focus();
	     return false;
     }
     
     if(document.getElementById("minallow").value==""){
         alert('minallow can not left empty!');
	     document.getElementById("minallow").focus();
	     return false;
     }
	
     if(document.getElementById("maxallow").value==""){
         alert('maxallow can not left empty!');
	     document.getElementById("maxallow").focus();
	     return false;
     }


  }	 	

</script>


<form name="MyForm1" action="ed_attndsettings.php" method="post" onsubmit="Javascript:return checkedq();">

<table width="430" border="0" align="center" cellpadding="0" cellspacing="0" id="stdtbl">
  
  <tr bgcolor="#F5F5F5">
    <td height="30" colspan="3"><div align="center"><span class="style11">Edit Attendance Settings</span></div></td>
    </tr>
  <tr>
    <td width="189" height="30" class="style2">Type <span class="stars">*</span> </td>
    <td width="8" height="30" class="style2">:</td>
    <td width="233"><?php echo $cdata['accname'];?></td>
    </tr>
  <tr>
    <td height="30" class="style2">Standard In Time <span class="stars">*</span></td>
    <td height="30" class="style2">:</td>
    <td><input name="stdintime" id="stdintime5" type="text" class="style2" size="0" value="<?php echo $cdata['stdintime'];?>" onKeyPress="return handleEnter(this, event)" /></td>
  </tr>
  <tr>
    <td height="30" class="style2">Standard Out Time <span class="stars">*</span></td>
    <td height="30" class="style2">:</td>
    <td><input name="stdouttime" id="stdouttime" type="text" class="style2" size="20" value="<?php echo $cdata['stdouttime'];?>" onKeyPress="return handleEnter(this, event)" /></td>
  </tr>
  <tr>
    <td height="30" class="style2">Minimum Delay Allow <span class="stars">*</span> </td>
    <td height="30" class="style2">:</td>
    <td><input name="minallow" id="minallow" type="text" class="style2" size="20" value="<?php echo $cdata['minallow'];?>" onKeyPress="return handleEnter(this, event)" /></td>
  </tr>
  <tr>
    <td height="30" class="style2">Maximum Delay Allow <span class="stars">*</span> </td>
    <td height="30" class="style2">:</td>
    <td><label>
      <input name="maxallow" id="maxallow" type="text" class="style4" size="20" value="<?php echo $cdata['maxallow'];?>" onKeyPress="return handleEnter(this, event)" />
    </label></td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Submit" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />
<input type="hidden" name="id" id="id" value="<?php echo mysql_real_escape_string($_GET['id']); ?>" /></td>
    </tr>
</table>
</form>
<?php 
}
?>