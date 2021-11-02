<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='voucherEntry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  				//$timezone = "Asia/Dhaka";
                //if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);  

 $products = null;

if (!empty($_SESSION['products'])) {
	$products = $_SESSION['products'];
}
//$_SESSION['sdate']=$_POST['voucherdate'];
?>

<style type="text/css">
 table td{
   font: normal 14px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif;

 
 }
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style2 {font-size: 10px}
.style3 {color: #666666}
.style8 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
</style>
<script type="text/javascript">
function toggleAndChangeText(r) {
     $('#myDiv'+r).toggle('fast');
     if ($('#myDiv'+r).css('display') == 'none') {
	     $('#aTag'+r).html('CLOSE &#9658');
     }
     else if($('#myDiv'+r).css('display')!= 'none') {                    
	 
	     $('#aTag'+r).html('VIEW &#9660');

     }
}


</script>
<script language="javascript">
  $(document).ready(function(){
    $('a[name=correct]').click(function(e){
	   e.preventDefault();
	   var vid=$(this).attr('alt');
	   var id=$(this).attr('id');
	   $('#myDiv'+id).slideDown().load('show_multihead_voucherrec.php?voucherid='+vid+'&count='+id);
	   
	});
	$('a[name=correct]').dblclick(function(e){
	   e.preventDefault();
	   var vid=$(this).attr('alt');
	   var id=$(this).attr('id');
	   $('#myDiv'+id).slideUp().load('show_multihead_voucherrec.php?voucherid='+vid+'&count='+id);
	   
	});  });
</script>
<div id="table_wrapper">
	<?php if (!empty($_SESSION['userid'])) { 
		
		?>
          
			<table cellpadding="0" cellspacing="0" border="0" class="gridTbl" width="90%">
			
				<tr align="center" valign="middle">
					<th width="21%" height="25" class="col_1 ta_r gridTblHead">Date</th>
					<th width="11%" height="25" class="col_1 ta_r gridTblHead">VoucherID</th>
					<th width="21%" height="25" class="col_1 ta_r gridTblHead">Explanation</th>
					<th width="12%" height="25" class="col_1 ta_r gridTblHead">&nbsp;</th>
					<th width="13%" height="25" class="col_1 ta_r gridTblHead">Voucher Type</th>
					<th height="25" colspan="2" class="col_1 ta_r gridTblHead">Action</th>
			  </tr>
				
				<?php 
				$src=mysql_real_escape_string($_POST['searchid']);
				$year=mysql_real_escape_string($_POST['year']);
				$month=mysql_real_escape_string($_POST['month']);
				$uac=$myDb->select("SELECT * FROM tbl_masterjournal 
									WHERE opby='$_SESSION[userid]' 
									AND voucherid ='$src' 
									and year(voucherdate)='$year' 
									and monthname(voucherdate)='$month'
									and multi_single in('multi') 
									order by id desc");
				$count12=0;
				while($uacf=$myDb->get_row($uac,'MYSQL_ASSOC')){
				?>
				<form id="mstj<?php echo $count12; ?>" method="post" action="update_vrec.php">
					
					<tr>
					  <td class="ta_r gridTblValue"><input type="text" name="voucherdate" id="voucherdate<?php echo $count12; ?>" value="<?php echo $uacf['voucherdate']; ?>" style="width:100px;" /></td>
						<td class="ta_r gridTblValue"><span class="style8"><?php echo $uacf['voucherid']; ?></span></td>
						<td class="ta_r style1 style2 gridTblValue"><input type="text" name="voucherexpl" id="voucherexpl<?php echo $count12; ?>" value="<?php echo $uacf['voucherexpl']; ?>" style="width:150px;"  />
						<input type="hidden" name="id" id="id<?php echo $count12; ?>" value="<?php echo $uacf['id']; ?>" />
					  <input type="hidden" name="voucherid" id="voucherid<?php echo $count12; ?>" value="<?php echo $uacf['voucherid']; ?>"  />					  </td>
						<td class="ta_r style1 style2 gridTblValue"><label>
						  <input type="button" name="btn" class="btn<?php echo $count12; ?>" id="submit-btn" value="Submit" style="display:none; " />
					  </label><div class="upd<?php echo $count12; ?>"></div></td>
						<td class="ta_r gridTblValue"><span class="style8"><?php echo $uacf['vouchertype']; ?></span></td>
						<td width="10%" class="ta_r style1 style2 gridTblValue">
						<a class="remove" target="_blank" href="Report/voucherReport.php?vid=<?php echo $uacf['voucherid']; ?>"  name="modal">Preview</a>
									</td>
					    <td width="12%" class="ta_r gridTblValue"><a href="#" name="correct" class="corr style1 style2" id="<?php echo $count12; ?>" alt="<?php echo $uacf['voucherid']; ?>" style="color:#333333; " >Correction</a></td>
					</tr>
					<tr>
					  <td colspan="7">					
					  <div id="myDiv<?php echo $count12; ?>" style="display:none;width:700px;" align="center"></div></td>
				  </tr>
					
					
				
				
				</form>
				<script language="javascript" type="text/javascript">
				 $(document).ready(function(){
					   $('.btn<?php echo $count12; ?>').click(function(){
					          //alert('success');
							   var arr=$('#mstj<?php echo $count12; ?>').serializeArray();
							   $.post('update_mjournal.php',arr,function(rec){
								 $('.upd<?php echo $count12; ?>').html(rec);
							   });
					  });
				 });
				
				</script>
				<?php $count12++; ?>
				<?php 
				} 
				?>
</table>
		<?php } else { ?>
			
			<p>There are currently no records available.</p>
		
		<?php } ?>
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