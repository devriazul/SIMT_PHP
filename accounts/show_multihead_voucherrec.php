<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='voucherEntry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  $voucherid=mysql_real_escape_string($_GET['voucherid']);
  $count=$_GET['count'];
?>  
<script language="javascript">
 $(document).ready(function(){
   /*var arr=$('#cfrm<?php echo $count; ?>').serializeArray();
   $('#supd<?php echo $count; ?>').click(function(){   

     $.post('update_vrec.php',arr,function(rec){
	    $('#smsg<?php echo $count; ?>').html(rec);
	 });
   });
   */
   
   
   
   
 });
</script>
<script>
    $(document).ready(function(){
	
 
        //iterate through each textboxes and add keyup
        //handler to trigger sum event
		
		$('.submit-btn').click(function(){
		
			var sum=0;
			var sum1=0;
		   $(".adr<?php echo $count; ?>").each(function(i) {
			   sum +=parseFloat(this.value);
			   
			});
			
		   $(".acr<?php echo $count; ?>").each(function(i) {
			   sum1 +=parseFloat(this.value);
			   
			});
		
		  if(sum!=sum1){
		     alert("Debit and credit not equal");
		     return false;
		  }
		
		});
	 
 
    });
 
    
	
	$(document).ready(function(){
		$(".adr<?php echo $count; ?>").keyup(function(){
			var id=$(this).attr('attr');
			var sum = 0;
			var sum1=0;
			var vid=$('input[name="vid"]').val();

		    if($(this).val()==0&&$(this).val().length==1){
				 window.location.href = "http://localhost/simt/accounts/manage_multihead_voucher.php";
			}
			
			//iterate through each textboxes and add the values
			$(".acr<?php echo $count; ?>").each(function() {
	 
				//add only if the value is number
				if(!isNaN(this.value) && this.value.length!=0) {
					sum += parseFloat(this.value);
				}
	 
			});
			$.get("check_master.php?id="+id+"&sum="+sum+"&vid="+vid,function(r){
				$("#mstr").html(r);
				if(r.length!=13){
				  $('.submit-btn').hide();
				}else{
				  $('.submit-btn').show();
				}
				$(this).focus();
				return false;
				
			});
 

		});
		$(".adr<?php echo $count; ?>").focus(function(){
		    if($(this).val()==0&&$(this).val().length==1){
				 window.location.href = "http://localhost/simt/accounts/manage_multihead_voucher.php";
			}
		});	
		
		$(".acr<?php echo $count; ?>").keyup(function(){
		    if($(this).val()==0&&$(this).val().length==1){
				 window.location.href = "http://localhost/simt/accounts/manage_multihead_voucher.php";
			}
		});	
		$(".acr<?php echo $count; ?>").focus(function(){
		    if($(this).val()==0&&$(this).val().length==1){
				 window.location.href = "http://localhost/simt/accounts/manage_multihead_voucher.php";
			}
		});	
		
		
	
	});
</script>

<script language="javascript">
$(function() {
 
    $("form").bind("keypress", function(e) {
            if (e.keyCode == 13) return false;
    });
	
	$('input').keydown('input', function(e) { 
	  var keyCode = e.keyCode || e.which; 
	
	  if (keyCode == 9) { //tab key
		e.preventDefault(); 
		// call custom function here
	  } 
	});
});
</script>

<form id="cfrm<?php echo $count; ?>" method="post" action="update_vrec.php">
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="vrec">
  <tr>
    <td height="25">Particulars</td>
    <td height="25">Dr</td>
    <td height="25" colspan="2">Cr</td>
  </tr>
  <?php $vrec=$myDb->select("select*,(select sum(amountdr) from tbl_2ndjournal where voucherid='$voucherid') tamountdr,
									 (select sum(amountdr) from tbl_2ndjournal where voucherid='$voucherid') tamountcr                          
							 from tbl_2ndjournal where voucherid='$voucherid' order by masteraccno");
    //$count=0;
	while($vrecf=$myDb->get_row($vrec,'MYSQL_ASSOC')){
	
	if($vrecf['tamountdr']==$vrecf['tamountcr']){
  ?>
	   <tr>
		<td><?php echo $vrecf['accname']; ?><input type="hidden" name="id_a[]" value="<?php echo $vrecf['id']; ?>" />
		
		<input type="hidden" name="vid" value="<?php echo $voucherid; ?>" >	</td>
		<td>
		<?php if($vrecf['masteraccno']==0){ ?>
			   <input type="text" class="adr<?php echo $count; ?>" name="amountdr[]" id="amountdr_m<?php echo $count; ?>"  value="<?php echo $vrecf['amountdr']; ?>"  style="width:100px; background-color:#CCCCFF;" attr="<?php echo $vrecf['id']; ?>" />
		<?php }else{ ?>
		
				<input type="text" class="adr<?php echo $count; ?>" name="amountdr[]" id="amountdr_m<?php echo $count; ?>"  value="<?php echo $vrecf['amountdr']; ?>"  style="width:100px;" attr="<?php echo $vrecf['id']; ?>" />
		<?php } ?>
		</td>
		<td>
		<?php if($vrecf['masteraccno']==0){ ?>
		
		
				<input type="text" class="acr<?php echo $count; ?>" name="amountcr[]" id="amountcr_m<?php echo $count; ?>"  value="<?php echo $vrecf['amountcr']; ?>"  style="width:100px; background-color:#CCCCFF;" attr="<?php echo $vrecf['id']; ?>"/>
		
		<?php }else{ ?>
				<input type="text" class="acr<?php echo $count; ?>" name="amountcr[]" id="amountcr_m<?php echo $count; ?>"  value="<?php echo $vrecf['amountcr']; ?>"  style="width:100px;" attr="<?php echo $vrecf['id']; ?>" />
		
		<?php } ?>
		
		</td>
		<td><div id="sum<?php echo $count; ?>"></div></td>
	   </tr>
   <?php }else{ ?>
		<tr>
			<td style="background-color:#CC6600;"><?php echo $vrecf['accname']; ?><input type="hidden" name="id_a[]" value="<?php echo $vrecf['id']; ?>" />
			
			<input type="hidden" name="vid" value="<?php echo $voucherid; ?>" >	</td>
			<td style="background-color:#CC6600;">
			<?php if($vrecf['masteraccno']==0){ ?>
					<input type="text" class="adr<?php echo $count; ?>" name="amountdr[]" id="amountdr_m<?php echo $count; ?>"  value="<?php echo $vrecf['amountdr']; ?>"  style="width:100px; background-color:#CCCCFF;"  attr="<?php echo $vrecf['id']; ?>" />
			<?php }else{ ?>
			
					<input type="text" class="adr<?php echo $count; ?>" name="amountdr[]" id="amountdr_m<?php echo $count; ?>"  value="<?php echo $vrecf['amountdr']; ?>"  style="width:100px;" attr="<?php echo $vrecf['id']; ?>" />
			<?php } ?>
			</td>
			<td style="background-color:#CC6600;">
			<?php if($vrecf['masteraccno']==0){ ?>
			
					<input type="text" class="acr<?php echo $count; ?>" name="amountcr[]" id="amountcr_m<?php echo $count; ?>"  value="<?php echo $vrecf['amountcr']; ?>"  style="width:100px; background-color:#CCCCFF;"  attr="<?php echo $vrecf['id']; ?>" />
			<?php }else{ ?>
					<input type="text" class="acr<?php echo $count; ?>" name="amountcr[]" id="amountcr_m<?php echo $count; ?>"  value="<?php echo $vrecf['amountcr']; ?>"  style="width:100px;" attr="<?php echo $vrecf['id']; ?>"/>
			<?php } ?>
			
			</td>
			<td><div id="sum<?php echo $count; ?>"></div></td>
    </tr>
   <?php } ?>
  
  <?php } ?>
   <tr align="center" valign="middle">
     <td height="35"></td>
     <td height="35">&nbsp;</td>
     <td height="35" colspan="2" style="padding:5px; "><label>
       <input type="submit" name="supd" id="supd<?php echo $count; ?>" value="Update" class="submit-btn" style="padding:5px;height:25px; " >
     </label></td>
   </tr>
   <tr align="center" valign="middle">
     <td height="35"></td>
     <td height="35" colspan="3"><div id="mstr"></div></td>
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