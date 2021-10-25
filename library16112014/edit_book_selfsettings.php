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
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  $id=mysql_real_escape_string($_GET['id']);
  $bsq=$myDb->select("SELECT*FROM  tbl_bookself WHERE selfno='$id'");
  $bsqf=$myDb->get_row($bsq,'MYSQL_ASSOC');
?>  

<style type="text/css">
@import url("main.css");
@import url("library.css");

.style12 {font-size: 10px}
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style16 {font-size: 12px}

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
  $('#bbutton').click(function(){
    var arr=$('#bfrm').serializeArray();
    if($('#deptid').val()==''){
	   alert("Department ID can not left empty");
	   $('#deptid').focus();
	   return false;
	}
    if($('#selfno').val()==''){
	   alert("SelfNo can not left empty");
	   $('#selfno').focus();
	   return false;
	}
    if($('#noofrow').val()==''){
	   alert("No of Row can not left empty");
	   $('#noofrow').focus();
	   return false;
	}   
    if($('#capacity').val()==''){
	   alert("Self capacity can not left empty");
	   $('#capacity').focus();
	   return false;
	}   
    $.post('ed_bookself.php',arr,function(data){
	  $('#bload').html('<img src=loader.gif>');
	  $('#bms').html(data);
	  $('#bload').hide();
	  $('#deptid').focus();
	  window.location.reload();
	  });	 
	    $('#mask').hide();
		$('.window').hide();
	  document.getElementById('deptid').value='';
	  document.getElementById('selfno').value='';
      document.getElementById('noofrow').value='';
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
		<div id="bload"></div>
		<div id="bms"></div>
		  <div style="padding-top:20px;">
		 		   
		  <form method="post" id="bfrm">
          <table width="400" border="0" cellspacing="0" cellpadding="0" class="global-form">
            <tr>
              <td colspan="2"><div class="input-form-heading">Bookself Settings</div> </td>
            </tr>
            <tr>
              <td class="style15">Deptartment ID: </td>
              <td id="align"><label>
                <select name="deptid" id="deptid" onKeyPress="return handleEnter(this, event)">
				 <?php $dq=$myDb->select("select*from tbl_department where id='$bsqf[deptid]'");
				 $dqf=$myDb->get_row($dq,'MYSQL_ASSOC');
				 ?>
				 <option selected="selected" value="<?php echo $dqf['id']; ?>"><?php echo $dqf['name']; ?></option>
				 <?php $dq=$myDb->select("select*from tbl_department");
				 while($dqf=$myDb->get_row($dq,'MYSQL_ASSOC')){
				 ?>
				  <option value="<?php echo $dqf['id']; ?>"><?php echo $dqf['name']; ?></option>
				 <?php } ?>
                </select>
              </label></td>
            </tr>
            <tr>
              <td width="166" class="style15">Self No :</td>
              <td width="232" id="align"><input type="text" name="selfno" id="selfno" value="<?php echo $bsqf['selfno']; ?>" style="width:50px;" onKeyPress="return handleEnter(this, event)" size="29"/></td>
            </tr>
           
            <tr>
              <td width="166" class="style15">Capacity :</td>
              <td width="232" id="align"><input type="text" name="capacity" id="capacity" value="<?php echo $bsqf['capacity']; ?>" style="width:50px;" onKeyPress="return handleEnter(this, event)" size="29"/></td>
            </tr>
            <tr>
              <td width="166">&nbsp;</td>
              <td width="232"><input type="button" name="Add" id="bbutton" value="Add" /></td>
            </tr><input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
          </table>
		  </form>
		  </div>
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}