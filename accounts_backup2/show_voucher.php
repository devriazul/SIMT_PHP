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
	   $('#myDiv'+id).slideDown().load('show_voucherrec.php?voucherid='+vid+'&count='+id);
	   
	});
	$('a[name=correct]').dblclick(function(e){
	   e.preventDefault();
	   var vid=$(this).attr('alt');
	   var id=$(this).attr('id');
	   $('#myDiv'+id).slideUp().load('show_voucherrec.php?voucherid='+vid+'&count='+id);
	   
	});  });
</script>



<div id="table_wrapper">
	<?php if (!empty($_SESSION['userid'])) { 
		
		?>
          
			<table cellpadding="0" cellspacing="0" border="0" class="tbl_repeat" width="90%">
			
				<tr>
					<th class="col_1 ta_r">Date</th>
					<th class="col_1 ta_r">VoucherID</th>
					<th class="col_1 ta_r">Explanation</th>
					<th class="col_1 ta_r">Voucher Type</th>
					<th class="col_1 ta_r">Date</th>
					<th colspan="2" class="col_1 ta_r">Action</th>
				</tr>
				
				<?php 
				$src=mysql_real_escape_string($_POST['searchid']);
				$year=mysql_real_escape_string($_POST['year']);
				$month=mysql_real_escape_string($_POST['month']);
				$uac=$myDb->select("SELECT * FROM tbl_masterjournal WHERE opby='$_SESSION[userid]' AND voucherid LIKE '$src%' and year(voucherdate)='$year' and monthname(voucherdate)='$month' order by voucherid asc");
				$count=0;
				while($uacf=$myDb->get_row($uac,'MYSQL_ASSOC')){
				?>
									
					<tr>
						<td class="ta_r"><?php echo $uacf['voucherdate']; ?></td>
						<td class="ta_r"><?php echo $uacf['voucherid']; ?></td>
						<td class="ta_r"><?php echo $uacf['voucherexpl']; ?></td>
						<td class="ta_r"><?php echo $uacf['vouchertype']; ?></td>
						<td class="ta_r"><?php echo $uacf['opdate']; ?></td>
						<td class="ta_r">
						<a class="remove" target="_blank" href="Report/voucherReport.php?vid=<?php echo $uacf['voucherid']; ?>"  name="modal">Preview</a>
							<!---<a href="#" class="remove" rel="">
								Preview
							</a>-->						</td>
					    <td class="ta_r"><a href="#" name="correct" class="corr" alt="<?php echo $uacf['voucherid']; ?>" id="<?php echo $count; ?>" >Correction</a></td>
					</tr>
					<tr>
					  <td colspan="7" class="ta_r">					
					  <div id="myDiv<?php echo $count; ?>" style="display: none;width:700px;" align="center">
                         
                   </div>
</td>
			  </tr>
					
					
				<?php $count++;} ?>
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