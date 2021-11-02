<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
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
	
});  

</script>
</head>

<body>
<form method="post" id="dfrm<?php echo $_GET['i']; ?>">
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="104" height="25" align="center" valign="middle"><span class="style17 style18 style22">Depriciable Cost</span></td>
    <td width="96" height="25" align="center" valign="middle"><span class="style17 style18 style22">Residual Value </span></td>
    <td width="79" height="25" align="center" valign="middle"><span class="style17 style18 style22">Useful Year </span></td>
    <td width="106" height="25" align="center" valign="middle"><span class="style17 style18 style22">Depriciated Value</span></td>
  </tr>
  <tr>
    <td height="30" align="center" valign="middle" class="style22"><label>
      <input name="depcost" id="depcost<?php echo $_GET['i']; ?>" value="<?php echo $_GET['total']; ?>" type="text" class="style22" style="width:80px;height:10px;" />
    </label></td>
    <td height="30" align="center" valign="middle" class="style22"><input name="drate" type="text" class="style22" id="drate<?php echo $_GET['i']; ?>" style="width:50px;height:10px;" size="10" value="<?php echo $drate; ?>" /></td>
    <td height="30" align="center" valign="middle" class="style22"><span class="style18">
      <label>
        <input type="hidden" name="accno" id="accno<?php echo $_GET['i']; ?>" value="<?php echo $_GET['accno']; ?>"/>
		<input type="hidden" name="aid" id="id<?php echo $_GET['i']; ?>" value="<?php echo $_GET['aid']; ?>"/>
        <input name="pyear" type="text" class="style22" id="pyear<?php echo $_GET['i']; ?>" style="width:30px;height:10px;" size="5" value="<?php echo $pyear; ?>"/>
        <input type="hidden" name="mtype" id="mtype" value="Straight Line" />
		</label>
    </span></td>
	<td height="30" align="center" valign="middle" class="style22"><label>
      <input name="depriciateval" id="depriciateval<?php echo $_GET['i']; ?>" value="<?php echo round($depriciatedcost,3); ?>" type="text" class="style22" style="width:80px;height:10px;" />
    </label></td>

    <td width="54" height="30" valign="middle"><label>
      <input type="button" name="Submit" id="Submit<?php echo $_GET['i']; ?>" value="Add" style="height:20px;border:1px solid #66FFFF; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px;margin-top:2px;" />
    </label>	</td>
    <td width="61" valign="middle"><a href="javascript:toggleAndChangeText(<?php echo $_GET['i']; ?>);" name="vh<?php echo $_GET['i']; ?>" class="style23" id="aTag<?php echo $_GET['i']; ?>" >View &#9658</a></td>
  </tr>
  <tr>
    <td height="30" colspan="6" align="center" valign="middle" class="style22">
	<div id="tview<?php echo $_GET['i']; ?>" style="display:none">
	<table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="30"><span class="style18">Depriciated Year </span></td>
        <td height="30"><span class="style18">Historical Cost </span></td>
        <td height="30"><span class="style18">Depriciated Vaue Per Year </span></td>
        <td height="30"><span class="style18">Depriciated Value of The Year </span></td>
      </tr>
	  <?php 
	    $pr=$myDb->select("SELECT id,aid,YEAR(ddate) tyear,pyear,drate,accno from fixed_dep WHERE accno='$_GET[accno]' AND aid='$_GET[aid]' and methodtype='Straight Line'");
		$prf=$myDb->get_row($pr,'MYSQL_ASSOC');
		$i=0;
		$j=1;
		while($i<$prf['pyear']){
	  
	  ?>
      <tr>
        <td height="30"><?php echo $prf['tyear']+$i; ?></td>
        <td height="30"><?php echo $_GET['total']; ?></td>
        <td height="30"><?php echo $depval=(($_GET['total']-$prf['drate'])/$prf['pyear'])*$j; ?></td>
        <td height="30"><?php echo $_GET['total']-$depval; ?></td>
      </tr>
	  <?php $i++;$j++;} ?>
    </table></div></td>
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
