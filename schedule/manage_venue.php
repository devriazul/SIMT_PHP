<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_venue.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<style type="text/css">
@import url("main.css");
.style12 {font-size: 10px}
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style16 {font-size: 12px}
#MyResult table{
 width:700px;
}
</style>
<script src="jquery-1.6.2.min.js" type="text/javascript"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#guideteacher").autocomplete("search_gudie_faculty.php", {
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
 $('#B1').click(function(){   
   var arr=$('#MyForm').serializeArray();
   if($('#venuname').val()==""){
     alert("Venue name can not be left empty");
	 $('#venuname').focus();
	 return false;
   }
   if($('#roomno').val()==""){
     alert("Room no can not be left empty");
	 $('#roomno').focus();
	 return false;
   }
   if($('#orderid').val()==""){
     alert("Orderid can not be left empty");
	 $('#orderid').focus();
	 return false;
   }
   $.post("ins_venue.php",arr,function(r){
     $('#shw').html(r);
   });
	 $('#MyResult').load("venue_pagination.php");
	 //$('#MyForm')[0].reset();
	 $('#roomno').val('');
	 $('#orderid').val('');
	 $('#venuname').val('');
	 $('#roomno').focus();
 });
 	// $('#MyResult').load("venue_pagination.php");

});

</script>
<script language="javascript">
$(document).ready(function(){
  $('a[name="dlt"]').unbind().click(function(e){
    e.preventDefault();
	var id=$(this).attr('alt');
	var trigger = $(this);
	var rows=$('.dmpquery tr').length;
	var checkstr =  confirm('are you sure you want to delete this?');
	if(checkstr == true){	
		$.get("delvenue.php?id="+id,function(r){
		
			if(rows>2){
		
				trigger.closest('tr').fadeOut(300, function() {
							$(this).remove();			
				});	
			}
			$('#shw').html(r);
			//$('.data').load("macclevel_pagination?page=1");

		});
	}else{
	  return false;
	}	
  
  });
  
  
  $('a[name="edt"]').click(function(e){
    e.preventDefault();
    var id=$(this).attr('alt');
	var venuname=$(this).attr('venuname');
	var dorder=$(this).attr('dorder');
	var roomno=$(this).attr('roomno');
	$('#venuname').val(venuname);
	$('#orderid').val(dorder);
	$('#roomno').val(roomno);
	$('#id').val(id);

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
    <td width="1047" height="152" valign="top" background="images/1.jpg"><span class="style17"><?php include("topdefault.php");?>    </span></span></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" id="tblleft">
      <tr>
        <td height="28" colspan="2" bgcolor="#0C6ED1"><div align="center" class="style1"><?php include("company.php"); ?></div></td>
        </tr>
      <tr>
        <td background="images/leftbg.jpg"><img src="images/leftbg.jpg" width="252" height="3" /></td>
        <td><img src="images/spaer.gif" width="1" height="1" /></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php"); ?>
          ���������<br />
          
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        <td width="79%" valign="top">
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></font></p>
<form name="MyForm" id="MyForm" autocomplete="off" action="#" method="post" >
          <div align="center"><br />
          <table width="700" border="0" align="center" cellpadding="0" cellspacing="3" id="stdtbl">

            <tr>
              <td height="20" colspan="2" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">ADD VENUE &amp; ROOM </td>
              <td width="14%" height="20" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">&nbsp;</td>
              <td width="31%" height="20" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><span class="stars">*</span>(Mandatory Field) </td>
            </tr>
            <tr>
              <td width="20%" height="20" class="style2">Venue :<span class="stars">*</span></td>
              <td width="35%" height="20"><input name="venuname" type="text" id="venuname" placeholder="Venue Name" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" />
			  </td>
              <td colspan="2"><input name="roomno" type="text" id="roomno" placeholder="Room No" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td><span class="style2">Order ID  :<span class="stars">*</span></span></td>
              <td colspan="3"><select name="orderid" id="orderid" onkeypress="return handleEnter(this, event)">
                <option value="">Select Orderid</option>
                <?php for($i=1;$i<=100;$i++){ ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
              </select>
			  <input type="hidden" name="id" id="id" value="" />
			  </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="3"><input type="button" value="Submit" name="B1" id="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"> <input type="reset" name="Submit2" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/></td>
            </tr>
          </table>          
          </div>

            </form>
          <br />
		     <div id="shw" style="width:500px; margin:0 auto;" align="center"></div>
			 <br/>
          		<div id="MyResult" align="center">
				<?php 
				   $sdq="SELECT*FROM tbl_venue ORDER BY id desc";
   				   $sdep=$myDb->dump_query($sdq,'','delvenue.php','y','y');
   
                ?>
				</div>          
          <p align="center">&nbsp;</p>
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
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}