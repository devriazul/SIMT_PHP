<?php ob_start();
session_start();
require_once('../dbClass.php');
include("../config.php"); 
include('../inword2.php');

if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='voucherEntry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
  
  $fdate = '';
  $tdate = '';
  if(!empty($_POST['fdate'])){
    $fdate=$_POST['fdate'];
	$_SESSION['fdate']=$fdate;
  }else{
    $fdate=$_GET['fdate'];
	$_SESSION['fdate']=$fdate;
  }
  if(!empty($_POST['tdate'])){
    $tdate=$_POST['tdate'];
	$_SESSION['tdate']=$tdate;
  
  }else{
    $tdate=$_GET['tdate'];
	$_SESSION['tdate']=$tdate;
  
  }
  
  /*
  $copq=$myDb->select("select sum(amountdr) totaldr,sum(amountcr) totalcr from tbl_2ndjournal where accno='$getacc'	and vdate<'$fdate'");
  $coqf=$myDb->get_row($copq,'MYSQL_ASSOC');
  $totalCashop=($coqf['totaldr']-$coqf['totalcr']);
  $crCashop=0;
  $drCashop=0; 
  if($totalCashop<0){
    //$crCashop=number_format(-($totalCashop),2);
    $crCashop=(-($totalCashop));
  }else{						
    $drCashop=$totalCashop;
  }	
  */
  $iq="select * from tbl_masterjournal where voucherdate between '$fdate' and '$tdate' order by id";
  $iqf=$myDb->select($iq);
  
?>


<div align="center">
  <div style="text-align:center; "><?php if(!empty($_GET['msg'])) { echo $_GET['msg']; } ?></div>
  <table width="80%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><div align="center"><?php include('../companyRpt.php');?></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><div align="center"><span style="font-size:18px; font-weight:bold; font:Arial, Helvetica, sans-serif; text-decoration:underline; ">General Journal Report</span></div></td>
    </tr>
    <tr>
      <td colspan="4"><div align="center">From Date: <?php echo date("d-M-Y",strtotime($fdate));?> To Date: <?php echo date("d-M-Y",strtotime($tdate));?></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table border="0" cellpadding="2" cellspacing="0" bordercolor="#E1E1FF"  style="width:80%; font-size:12px; font:Arial, Helvetica, sans-serif;" align="center" >
  <tr bgcolor="#F2F2FF">
    <th width="21%"><div align="left">Voucher Date</div></th>
    <th width="34%"><div align="left">Particulars</div></th>
    <th width="12%">Type</th>
    <th width="13%" class="col_1 ta_r"><div align="right">Amount Dr.</div></th>
    <th width="20%" class="col_1 ta_r"><div align="right">Amount Cr.</div></th>
	<th colspan="2" width="20%" class="col_1 ta_r">Action</th>
    </tr>
  <?php
  $count=0;
  $dr=0;
  $cr=0;
  $bal=0;
  $drdw=0;
  $crdw=0;
  $a=0;
  $b=0;  
  $sumcr=0;
  $sumdr=0;

  while($iqd=$myDb->get_row($iqf,'MYSQL_ASSOC'))
  {?>
  <tr bgcolor="#F3F3F3">
    <th><div align="left"><?php echo $iqd['voucherdate']?></div></th>
    <th><div align="left">Voucher ID: <?php echo $iqd['voucherid']?></div>      </th>
    <th><?php if($iqd['vouchertype']=="J"){echo "Journal";}elseif($iqd['vouchertype']=="P"){echo "Payment";}elseif($iqd['vouchertype']=="R"){echo "Receive";} ?></th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
	<th colspan="2"></th>
  </tr>
   <?php
//echo "select c.accname accname,sum(c.amountdr) amountdr,sum(c.amountcr)amountcr,p.voucherexpl, p.voucherdate from tbl_masterjournal p inner join tbl_2ndjournal c on p.voucherid=c.voucherid  and c.voucherid='$iqd[voucherid]' and c.accno<>'$getacc' and p.voucherdate between '$fdate' and '$tdate'"; exit;
				$uac=$myDb->select("select * from tbl_2ndjournal WHERE voucherid='$iqd[voucherid]'");
				$dv = 0;
				while($row=$myDb->get_row($uac,'MYSQL_ASSOC')){
				//foreach($products as $key => $row) {
				$sumcr+=$row['amountcr'];
				$sumdr+=$row['amountdr'];
				
				?>

   <tr>
     <td><div align="center"><em><?php echo $row['accno']; ?></em></div></td>
     <td colspan="2"><em><?php echo $row['accname']; ?></em></td>
     <td class="ta_r"><div align="right"><em><?php echo number_format($row['amountdr'],2);?></em></div></td>
     <td class="ta_r"><div align="right"><em><?php echo number_format($row['amountcr'],2); ?></em></div></td>
	 <td class="ta_r" colspan="2"><?php if(0 === $dv){ ?><a href="deleteVoucher.php?voucherid=<?php echo $iqd['voucherid']; ?>&fdate=<?php echo $fdate; ?>&tdate=<?php echo $tdate; ?>">DELETE</a><?php } ?></td>
   </tr>
  <?php $dv = 1;} ?>
    <tr bgcolor="#F2F2FF">
     <td style="padding:3px; border-bottom:1px solid #CCCCCC;"><div align="right"><strong>VoucherExplanation: </strong></div></td>
     <td colspan="2" style="padding:3px; border-bottom:1px solid #CCCCCC;">
       <div align="right">      </div>
       <div align="left"><?php echo $iqd['voucherexpl'];?>       </div></td>
     <td style="padding:3px; border-bottom:1px solid #CCCCCC;"><div align="right"><strong>
	 			<?php $uacdr=$myDb->select("select SUM(amountdr) as tdr from tbl_2ndjournal WHERE voucherid='$iqd[voucherid]'");
					  $rowdrt=$myDb->get_row($uacdr,'MYSQL_ASSOC');
					  echo number_format($rowdrt['tdr'],2);
				?></strong></div></td>
     <td style="padding:3px; border-bottom:1px solid #CCCCCC;"><div align="right"><strong><?php $uacdr=$myDb->select("select SUM(amountcr) as tcr from tbl_2ndjournal WHERE voucherid='$iqd[voucherid]'");
					  $rowdrt=$myDb->get_row($uacdr,'MYSQL_ASSOC');
					  echo number_format($rowdrt['tcr'],2);
				?></strong></div></td>
				<td colspan="2"></td>
    </tr>
  <?php $count++;} ?>
</table>
  <table border="0" cellpadding="2" cellspacing="0" bordercolor="#E1E1FF"  style="width:80%;" align="center" >
    <tr bgcolor="#F3F3F3">
      <th><div align="left"></div>        <div align="left"></div>        <div align="right"><em><strong>Total : </strong></em></div></th>
      <th width="20%" class="col_1 ta_r"><div align="right"><?php echo number_format($sumdr,2);?></div></th>
      <th width="20%" class="col_1 ta_r"><div align="right"><?php echo number_format($sumcr,2);?></div></th>
    </tr>
  </table>
</div>
<?php 
	
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}  
?>