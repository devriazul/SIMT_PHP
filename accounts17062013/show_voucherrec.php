<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
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
<script>
    $(document).ready(function(){
 
        //iterate through each textboxes and add keyup
        //handler to trigger sum event
        $(".adr<?php echo $count; ?>").each(function() {
 
            $(this).keyup(function(){
                calculateSum();
            });
        });
		
        $(".acr<?php echo $count; ?>").each(function() {
 
            $(this).keyup(function(){
                calculateSum1();
            });
        });
		$("#cfrm<?php echo $count; ?> input").attr("tabindex", "-1");
 
    });
 
    function calculateSum() {
 
        var sum = 0;
        //iterate through each textboxes and add the values
        $(".adr<?php echo $count; ?>").each(function() {
 
            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }
 
        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("#amountcr_m<?php echo $count; ?>").val(sum.toFixed(2));
    }
	
    function calculateSum1() {
 
        var sum = 0;
        //iterate through each textboxes and add the values
        $(".acr<?php echo $count; ?>").each(function() {
 
            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }
 
        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("#amountdr_m<?php echo $count; ?>").val(sum.toFixed(2));
    }
</script>


<form id="cfrm<?php echo $count; ?>" method="post" action="update_vrec.php">
<table width="700" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Particulars</td>
    <td>Dr</td>
    <td colspan="2">Cr</td>
  </tr>
  <?php $vrec=$myDb->select("select*,(select sum(amountdr) from tbl_2ndjournal where voucherid='$voucherid') tamountdr,
									 (select sum(amountdr) from tbl_2ndjournal where voucherid='$voucherid') tamountcr                          
							 from tbl_2ndjournal where voucherid='$voucherid' order by masteraccno");
    //$count=0;
	while($vrecf=$myDb->get_row($vrec,'MYSQL_ASSOC')){
	
	if($vrecf['tamountdr']==$vrecf['tamountcr']){
  ?>
	   <tr>
		<td><?php echo $vrecf['accname']; ?><input type="hidden" name="id[]" value="<?php echo $vrecf['id']; ?>" />
		
		<input type="hidden" name="vid" value="<?php echo $voucherid; ?>" >	</td>
		<td>
		<?php if($vrecf['masteraccno']==0){ ?>
		<input type="text" class="adr<?php echo $count; ?>" name="amountdr[]" id="amountdr_m<?php echo $count; ?>"  value="<?php echo $vrecf['amountdr']; ?>"  style="width:100px; background-color:#CCCCFF;" />
		<?php }else{ ?>
		<input type="text" class="adr<?php echo $count; ?>" name="amountdr[]" id="amountdr_m<?php echo $count; ?>"  value="<?php echo $vrecf['amountdr']; ?>"  style="width:100px;" />
		
		<?php } ?>
		</td>
		<td>
		<?php if($vrecf['masteraccno']==0){ ?>
	
		<input type="text" class="acr<?php echo $count; ?>" name="amountcr[]" id="amountcr_m<?php echo $count; ?>"  value="<?php echo $vrecf['amountcr']; ?>"  style="width:100px; background-color:#CCCCFF;" />
		<?php }else{ ?>
		<input type="text" class="acr<?php echo $count; ?>" name="amountcr[]" id="amountcr_m<?php echo $count; ?>"  value="<?php echo $vrecf['amountcr']; ?>"  style="width:100px;" />
		<?php } ?>
		
		</td>
		<td><div id="sum<?php echo $count; ?>"></div></td>
	   </tr>
   <?php }else{ ?>
		<tr>
			<td style="background-color:#CC6600;"><?php echo $vrecf['accname']; ?><input type="hidden" name="id[]" value="<?php echo $vrecf['id']; ?>" />
			
			<input type="hidden" name="vid" value="<?php echo $voucherid; ?>" >	</td>
			<td style="background-color:#CC6600;">
			<?php if($vrecf['masteraccno']==0){ ?>
			<input type="text" class="adr<?php echo $count; ?>" name="amountdr[]" id="amountdr_m<?php echo $count; ?>"  value="<?php echo $vrecf['amountdr']; ?>"  style="width:100px; background-color:#CCCCFF;" />
			<?php }else{ ?>
			<input type="text" class="adr<?php echo $count; ?>" name="amountdr[]" id="amountdr_m<?php echo $count; ?>"  value="<?php echo $vrecf['amountdr']; ?>"  style="width:100px;" />
			
			<?php } ?>
			</td>
			<td style="background-color:#CC6600;">
			<?php if($vrecf['masteraccno']==0){ ?>
		
			<input type="text" class="acr<?php echo $count; ?>" name="amountcr[]" id="amountcr_m<?php echo $count; ?>"  value="<?php echo $vrecf['amountcr']; ?>"  style="width:100px; background-color:#CCCCFF;" />
			<?php }else{ ?>
			<input type="text" class="acr<?php echo $count; ?>" name="amountcr[]" id="amountcr_m<?php echo $count; ?>"  value="<?php echo $vrecf['amountcr']; ?>"  style="width:100px;" />
			<?php } ?>
			
			</td>
			<td><div id="sum<?php echo $count; ?>"></div></td>
		   </tr>
   <?php } ?>
  
  <?php } ?>
   <tr>
     <td></td>
     <td></td>
     <td colspan="2"><label>
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