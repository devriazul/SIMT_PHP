<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_voucher.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script language="javascript">
$(document).ready(function(){
  $('#Submit<?php echo $_GET['i']; ?>').click(function(){
    var arr=$('#dfrm<?php echo $_GET['i']; ?>').serializeArray();
	$.post('ins_depriciation.php',arr,function(res){
	  $('#ins<?php echo $_GET['i']; ?>').css({'font-family':'verdana','font-size':'12px'});
	  $('#ins<?php echo $_GET['i']; ?>').html(res);
	});
  
  });		  


});
</script>
<?php 

if(isset($_GET['drate'])){
   $drate=$_GET['drate'];
}else{
   $drate=0;
}  


if(isset($_GET['pyear'])){
   $pyear=$_GET['pyear'];
}else{
   $pyear=0;
} 
if($drate!=0 && $pyear!=0){
if($_GET['total']<0){
	$depriciatedcost=(-($_GET['total']-$drate)/$pyear);
}else{
	$depriciatedcost=(($_GET['total']-$drate)/$pyear);
} 

}else{
$depriciatedcost=0;
}
?>
<style type="text/css">
<!--
.style18 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style22 {font-size: 10px}
.style23 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
-->
</style>

<script type="text/javascript" src="jquery.dateentry.js"></script>

<script language="javascript">
$(document).ready(function(){
  $('#aTag<?php echo $_GET['i']; ?>').html('View &#9658');
  $("a[name=vh<?php echo $_GET['i']; ?>]").click(function(e){
  
   if($('#tview<?php echo $_GET['i']; ?>').css('display')=='none'){
	  $('#tview<?php echo $_GET['i']; ?>').toggle('slow').fadeIn();
	  $('#aTag<?php echo $_GET['i']; ?>').html('Hide &#9660');
   }else{
	  $('#aTag<?php echo $_GET['i']; ?>').html('View &#9658');
      $('#tview<?php echo $_GET['i']; ?>').slideUp();
   }
 });
 
 $(function () { 

	$('#fdate<?php echo $_GET['i']; ?>').dateEntry({spinnerImage: 'img/calendar_icon.png'});
	$('#tdate<?php echo $_GET['i']; ?>').dateEntry({spinnerImage: 'img/calendar_icon.png'});
});  


$('#diminishing<?php echo $_GET['i']; ?>').click(function(){
    var arr=$('#dfrm<?php echo $_GET['i']; ?>').serializeArray();
  $.post('diminishing_report.php',arr,function(res){
    $('#showdim<?php echo $_GET['i']; ?>').html(res);
  
  });
 
});
	
});  

</script>

</head>

<body>
<form method="post" id="dfrm<?php echo $_GET['i']; ?>">
<table width="700" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="96" height="25" align="center" valign="middle"><span class="style17 style18 style22">Rate of Dep(%) </span></td>
    </tr>	        <input type="hidden" name="accno" id="accno<?php echo $_GET['i']; ?>" value="<?php echo $_GET['accno']; ?>"/>
		<input type="hidden" name="aid" id="id<?php echo $_GET['i']; ?>" value="<?php echo $_GET['aid']; ?>"/>

  <tr>
    <td height="30" align="center" valign="middle" class="style22"><input name="drate" type="text" class="style22" id="drate<?php echo $_GET['i']; ?>" style="width:50px;height:10px;" size="10" value="<?php echo $drate; ?>" /></td>
    <td width="54" height="30" valign="middle"><label>
      <input type="button" name="Submit" id="Submit<?php echo $_GET['i']; ?>" value="Add" style="height:20px;border:1px solid #66FFFF; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px;margin-top:2px;" />
	          <input type="hidden" name="mtype" id="mtype" value="Diminishing" />

    </label>	</td>
    <td width="61" valign="middle"><a href="javascript:toggleAndChangeText(<?php echo $_GET['i']; ?>);" name="vh<?php echo $_GET['i']; ?>" class="style23" id="aTag<?php echo $_GET['i']; ?>" >View &#9658</a></td>
  </tr>
  <tr>
    <td height="30" colspan="3" align="center" valign="middle" class="style22">
	
	
	
	<div id="tview<?php echo $_GET['i']; ?>" style="display:none">
	
	<table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="101" height="30" valign="middle">&nbsp;</td>
        <td width="153" height="30" valign="middle">&nbsp;</td>
        <td width="84" height="30" valign="middle">&nbsp;</td>
        <td width="181" height="30" valign="middle">&nbsp;</td>
        <td width="81" height="30">&nbsp;</td>
      </tr>
      <tr>
        <td height="30" valign="middle">FROM DATE </td>
        <td height="30" valign="middle"><label>
          <input type="text" name="fdate" id="fdate<?php echo $_GET['i']; ?>" class="style22" style="width:100px;height:10px;" />
        </label></td>
        <td height="30" valign="middle">TO DATE </td>
        <td height="30" valign="middle"><label>
          <input type="text" name="tdate" id="tdate<?php echo $_GET['i']; ?>" class="style22" style="width:100px;height:10px;" />
        </label></td>
        <td height="30" valign="middle"><label>
          <input type="button" name="Submit2" id="diminishing<?php echo $_GET['i']; ?>" value="Submit" />
        </label></td>
      </tr>
      <tr>
        <td height="30" valign="middle">&nbsp;</td>
        <td height="30" valign="middle">&nbsp;</td>
        <td height="30" valign="middle">&nbsp;</td>
        <td height="30" valign="middle">&nbsp;</td>
        <td height="30">&nbsp;</td>
      </tr>
    </table>
	
	</div>
	
	<div id="showdim<?php echo $_GET['i']; ?>"></div>
	</td>
    </tr>
</table>

<div id="ins<?php echo $_GET['i']; ?>"></div>
</form>
</body>
</html>
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

