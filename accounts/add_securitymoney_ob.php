<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  	if($_SESSION['userid'])
	{
		$chka="SELECT*FROM  tbl_accdtl WHERE flname='add_securitymoney_ob.php' AND userid='$_SESSION[userid]'";
  		$caq=$myDb->select($chka);
  		$car=$myDb->get_row($caq,'MYSQL_ASSOC');
		if($car['ins']=="y")
		{
		
		
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
	font-weight:bold;
}
.style16 {
	font-size: 12px; 
	font-family: Verdana, Arial, Helvetica, sans-serif;
}

-->
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
<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>
<script language="javascript" src="jquery.js"></script>
<script language="javascript">
 $(document).ready(function(){

  	//$("#rcvamount").keypress(function (e) {
 	$('input[name="rcvamount[]"]').keypress(function(e){

     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
 
 
   /*
   $('input[name="B1[]"]').click(function(){

 	if($('#rcvamount').val()==''||$('#rcvamount').val()=='0')
	{
		alert("Amount can't be 0 or empty.");
		$('#rcvamount').focus();
		return false;
	}
   
   
    var arr=$('#form1').serializeArray();
	$.post("ins_securitymoney_rcvlb.php",arr,function(r){
	  $('#accname').val('');
	  $('#shwrec').html(r);
	  
	});
   
   });
   */
   $('input[name="B1[]"]').click(function(){

 	//if($('input[name="rcvamount[]"]').val()==''||$('input[name="rcvamount[]"]').val()=='0')
	if($('input[name="rcvamount[]"]').val()=='')
	{
		alert("Amount can't be 0 or empty.");
		$(this).focus();
		return false;
	}
   
   /*
   
    var arr=$('#form1').serializeArray();
	$.post("ins_securitymoney_rcvlb.php",arr,function(r){
	  //$('#accname').val('');
	  $('#shwrec').html(r);
	  
	});
   */
   
   });

   
   
 });
</script>
</head>

<body>
<table width="1047" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1047" height="152" valign="top" background="images/1.jpg"><span class="style17"><?php include("topdefault.php");?>    </span></span></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" id="tblleft">
      <tr>
        <td height="28" colspan="2" bgcolor="#0C6ED1"><div align="center" class="style1"><?php include('../company.php'); ?></div></td>
        </tr>
      <tr>
        <td background="images/leftbg.jpg"><img src="images/leftbg.jpg" width="252" height="3" /></td>
        <td><img src="images/spaer.gif" width="1" height="1" /></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php"); ?>
                   <br />
          
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        <td width="79%" valign="top">
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></font></p>
		<div id="shwrec" style="width:500px; margin:0 auto;"></div>
          <div align="center"><span style="font-weight:bold; font-size:14px; text-decoration:underline; ">Employee/ Faculty Security Money Opening Balance Entry</span><br />
          <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" id="stdtbl">
            <tr>
              <td class="style15 gridTblHead">SLNo.</td>
              <td class="style15 gridTblHead">Account Name</td>
              <td class="style15 gridTblHead"><div align="center">Security Money</div></td>
              <td height="31" class="style15 gridTblHead"><div align="center">Amount</div></td>
              <td height="31" class="style15 gridTblHead">Action</td>
            </tr>
			<?php
			$j=0;
			$idata=$myDb->select("SELECT sj.*,ac.srtrace FROM `tbl_2ndjournal` sj inner join tbl_accchart ac on sj.accno=ac.id WHERE sj.parentid='5002' and ac.srtrace<>'1' order by ac.accname");
			while($idataf=$myDb->get_row($idata,'MYSQL_ASSOC'))
			{ $j++;
			?>
					<form id="form1" name="form1" method="post" action="ins_securitymoney_ob.php" enctype="multipart/form-data" >

            <tr>
              <td width="9%" class="style16 gridTblValue"><?php echo $j;?></td>
              <td width="48%" class="style16 gridTblValue"><?php echo $idataf['accname'];?><input name="accno[]" type="hidden" id="accno" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF; width:50px;" value="<?php echo $idataf['accno'];?>" /><input name="accname[]" type="hidden" id="accname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF; width:50px;" value="<?php echo $idataf['accname'];?>" /></td>
              <td width="31%" class="style16 gridTblValue"><div align="center"><?php echo number_format($idataf['amountdr'],2);?></div></td>
              <td width="31%" height="20" class="style16 gridTblValue"><div align="center">
                <input name="rcvamount[]" type="text" id="rcvamount" style="text-align:center; font-family: Verdana; font-size: 10pt; border: 1px solid #3399FF; width:80px;" onkeypress="return handleEnter(this, event)" />
              <span id="errmsg"></span></div></td>
              <td width="12%" height="20" class="style16 gridTblValue"><div align="center">
              <input type="submit" value="Submit" name="B1[]" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" /></div></td>
            </tr>
			            </form>

			<?php }?>
          </table>
		                  
          
          <p>&nbsp;</p>
          </div>

			
</p>
<p></p>
</td>
      </tr>
	        <tr>
        <td height="60" colspan="2" valign="middle" bgcolor="#D3F3FE"><?php include("bot.php"); ?></td>
        </tr>

    </table></td>
  </tr>
</table>
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
  header("Location:index.php");
}
}  
?>
