<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
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
?>
<?php if (!empty($_SESSION['userid'])) { 
		
		?>
          
			<table cellpadding="0" cellspacing="0" border="0" class="tbl_repeat" width="100%">
			
				<tr ><td colspan="4" height="30"></td>
				<tr>
					<th>Acc name</th>
					<th class="col_1 ta_r">Acc Type</th>
					<th class="col_1 ta_r">Amountdr</th>
					<th class="col_1 ta_r">Amountcr</th>
				</tr>
				
				<?php 
				$uac=$myDb->select("SELECT * FROM tbl_tmpjurnal WHERE masteraccno<>0 AND opby='$_SESSION[userid]' AND vdate='".date("Y-m-d")."'");
				while($uacf=$myDb->get_row($uac,'MYSQL_ASSOC')){
				?>
									
					<tr>
						<td><?php echo $uacf['accname']; ?></td>
						<td class="ta_r"><?php echo $uacf['drcr']; ?></td>
						<td class="ta_r"><?php echo $uacf['amountdr']; ?></td>
						<td class="ta_r"><?php echo $uacf['amountcr']; ?></td>
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