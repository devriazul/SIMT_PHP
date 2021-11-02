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
  				$timezone = "Asia/Dhaka";
                if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);  

 $products = null;

if (!empty($_SESSION['products'])) {
	$products = $_SESSION['products'];
}
//$_SESSION['sdate']=$_POST['voucherdate'];
?>


<div id="table_wrapper">
	<?php if (!empty($_SESSION['userid'])) { 
		
		?>
          
			<table cellpadding="0" cellspacing="0" border="0" class="tbl_repeat" width="100%">
			
				<tr>
					<th class="col_1 ta_r">Date</th>
					<th class="col_1 ta_r">VoucherID</th>
					<th class="col_1 ta_r">Explanation</th>
					<th class="col_1 ta_r">Voucher Type</th>
					<th class="col_1 ta_r">Date</th>
					<th class="col_1 ta_r">Action</th>
				</tr>
				
				<?php 
				$src=mysql_real_escape_string($_POST['searchid']);
				$uac=$myDb->select("SELECT * FROM tbl_masterjournal WHERE opby='$_SESSION[userid]' AND voucherid LIKE '$src%' order by id desc");
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
					</tr>
					
				<?php } ?>
			</table>
		<?php } else { ?>
			
			<p>There are currently no records available.</p>
		
		<?php } ?>
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.html?msg=$msg");
   }	 

}else{
  header("Location:login.html");
}
}  
?>		