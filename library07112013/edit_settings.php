<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_settings.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  $libs=$myDb->select("SELECT*FROM tbl_libsetting WHERE id='$_GET[id]'");
  $libsf=$myDb->get_row($libs,'MYSQL_ASSOC');
?>  

<style type="text/css">
<!--
@import url("main.css");
@import url("library.css");

.style12 {font-size: 10px}
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style16 {font-size: 12px}

-->
</style>
<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>

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
  $('#button').click(function(){
    var arr=$('#frm').serializeArray();
    if($('#maxval').val()==''){
	   alert("Meximum Allow book can not left empty");
	   $('#maxval').focus();
	   return false;
	}
    if($('#fine').val()==''){
	   alert("Fine can not left empty");
	   $('#fine').focus();
	   return false;
	}   
    $.post('ed_settings.php',arr,function(data){
	  $('#load').html('<img src=loader.gif>');
	  $('#ms').html(data);
	  $('#load').hide();
	  $('#maxval').focus();
	  //window.location.reload();
	  $('#Lset').hide().fadeIn();
	  });	 
	    $('#mask').hide();
		$('.window').hide();
		
	  document.getElementById('maxval').value='';
      document.getElementById('fine').value='';
  });
 });
</script>
<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>

		<div id="load"></div>
		<div id="ms"></div>
		  <div style="padding-top:20px;">
		 		   
		  <form method="post" id="frm">
          <table width="500" border="0" cellspacing="0" cellpadding="0" id="tbl-border">
            <tr>
              <td width="157">Library Setting </td>
              <td width="343">&nbsp;</td>
            </tr>
            <tr>
              <td width="157" id="tbl_heading">Maximum Book Allow:</td>
              <td width="343" id="align"><input type="text" name="maxval" id="maxval" value="<?php echo $libsf['maxallow']; ?>" style="width:50px;" onKeyPress="return handleEnter(this, event)" size="29"/></td>
            </tr>
            <tr>
              <td width="157" id="tbl_heading">Fine:</td>
              <td width="343" id="align"><input type="text" name="fine" id="fine" value="<?php echo $libsf['fine']; ?>" style="width:50px;" onKeyPress="return handleEnter(this, event)" size="29"/></td>
            </tr>
            <tr>
              <td width="157"></td>
              <td width="343"><input type="button" name="Add" id="button" value="Add" /></td>
            </tr><input type="hidden" name="id" id="id" value="<?php echo $libsf['id']; ?>" />
          </table>
		  </form>
		  </div>
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>
