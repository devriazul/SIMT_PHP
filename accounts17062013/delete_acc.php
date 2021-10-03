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
  				//$timezone = "Asia/Dhaka";
                //if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);  

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
					<th width="20%">Acc name</th>
					<th width="10%" class="col_1 ta_r">Acc Type</th>
					<th width="13%" class="col_1 ta_r">Voucher Type </th>
					<th width="20%" class="col_1 ta_r">Amountdr</th>
					<th width="20%" class="col_1 ta_r">Amountcr</th>
					<th width="17%" class="col_1 ta_r">Remove</th>
				</tr>
				
				<?php 
				$uac=$myDb->select("SELECT * FROM tbl_tmpjurnal WHERE masteraccno=0 AND opby='$_SESSION[userid]' AND vdate='".$_SESSION['vdate']."'");
				while($uacf=$myDb->get_row($uac,'MYSQL_ASSOC')){
				?>
									
					<tr>
						<td><?php echo $uacf['accname']; ?></td>
						<td class="ta_r"><?php echo $uacf['drcr']; ?></td>
						<td class="ta_r"><?php echo $uacf['vouchertype']; ?></td>
						<td class="ta_r"><?php echo $uacf['amountdr']; ?></td>
						<td class="ta_r"><?php echo $uacf['amountcr']; ?></td>
						<td class="ta_r">
							<a href="#" class="remove" rel="<?php echo $uacf['accno']; ?>">
								Remove							</a>						</td>
					</tr>
					
				<?php } ?>
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