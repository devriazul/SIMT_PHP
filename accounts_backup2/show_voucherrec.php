<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_jurnal.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  $voucherid=mysql_real_escape_string($_GET['voucherid']);
  $count=$_GET['count'];
?>  
<script language="javascript">
 $(document).ready(function(){
   var arr=$('#cfrm<?php echo $count; ?>').serializeArray();
   $('#supd<?php echo $count; ?>').click(function(){   

     $.post('update_vrec.php',arr,function(rec){
	    $('#smsg<?php echo $count; ?>').html(rec);
	 });
   });
   
   
   
   
 });
</script>

<form id="cfrm<?php echo $count; ?>" method="post" action="update_vrec.php">
<table width="700" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Particulars</td>
    <td>Dr</td>
    <td>Cr</td>
  </tr>
  <?php $vrec=$myDb->select("select*from tbl_2ndjournal where voucherid='$voucherid' order by masteraccno");
    //$count=0;
	while($vrecf=$myDb->get_row($vrec,'MYSQL_ASSOC')){
  ?>
   <tr>
    <td><?php echo $vrecf['accname']; ?><input type="hidden" name="id[]" value="<?php echo $vrecf['id']; ?>" />
	
	<input type="hidden" name="vid" value="<?php echo $voucherid; ?>" >
	</td>
    <td><input type="text" name="amountdr[]"  value="<?php echo $vrecf['amountdr']; ?>"  style="width:100px;" /></td>
    <td><input type="text" name="amountcr[]"  value="<?php echo $vrecf['amountcr']; ?>"  style="width:100px;" /></td>
  </tr>


  
  <?php } ?>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td><label>
       <input type="submit" name="supd" id="supd<?php echo $count; ?>" value="Update" style="height:30px; width:70px; padding:10px; border:1px solid #CCCCFF;">
     </label></td>
   </tr>
</table>
</form>
<div id="smsg<?php echo $count; ?>"></div>
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>		  