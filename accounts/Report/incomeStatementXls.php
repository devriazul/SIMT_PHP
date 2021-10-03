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
  if($car['ins']=="y"){
  $fdate = !empty($_POST['fdate']) ? $_POST['fdate'] : '';
  $tdate = !empty($_POST['tdate']) ? $_POST['tdate'] : '';
  header("Content-type: application/vnd-ms-excel");
  // Defines the name of the export file "codelution-export.xls"
  header("Content-Disposition: attachment; filename=incomeStatement-".date("Y-m-d")."-".date("H:i:s", strtotime(time())).".xls");
?>  
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Income Statement</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>
 .pltable{
 	width:950px;
	margin:0 auto;
	font-size:14px;
 }
 
 .pltable td{
   border-top:1px solid #2e2e2e;
   padding:0 30px;
 }
 
 .cltable{
   width:100%;
   margin:0 20px;
 }
 .cltable td{
   border-top:0;
 }
 .parent{
    font-weight:700;
 }
</style>
</head>

<body>
<div style="text-align:center; ">
<?php include("report_head.php"); ?>
<h3>Income Statement </h3>
</div>
<table cellpadding="0" border="0" cellspacing="0" class="pltable">
  <tr>
  	<td colspan="3" align="right" class="parent">SAIC INSTITUTE OF</td>
	<td colspan="3" align="right" class="parent">SAIC INSTITUE OF</td>
  </tr>
  <tr>
  	<td colspan="1" class="parent">Particulars</td>
	<td colspan="2" class="parent"><?php echo $fdate ."To ".$tdate; ?></td>
	<td colspan="1" class="parent">Particulars</td>
	<td colspan="2" class="parent"><?php echo $fdate ."To ".$tdate; ?></td>
  </tr>
  <tr>
  	<td colspan="3" valign="top">
	   <table class="cltable">
	     <?php
		    $expqry = $myDb->select("SELECT p.accname parentacc,p.id cgroup, SUM( ifnull( g.amountdr,0 ) ) totaldr, SUM( ifnull( g.amountcr,0 ) ) totalcr
										FROM tbl_accchart p
										LEFT JOIN  tbl_2ndjournal g ON g.groupname = p.id
										WHERE (p.type = 'Expense Account')
										AND g.vdate BETWEEN '$fdate' AND '$tdate'
										GROUP BY p.accname
			");
			$totalpexp = 0;
			while($expf = $myDb->get_row($expqry,'MYSQL_ASSOC')){
		 ?>
	     <tr>
		 	<td class="parent"><?php echo $expf['parentacc']; ?></td>
			<td></td>
			<td align="right" class="parent"><?php $expamount=($expf['totaldr']-$expf['totalcr']); echo number_format($expamount,2); ?></td>
		</tr>
		<tr>	
			<td colspan="3">
			   <table class="cltable">
			   <?php $cexpqry =$myDb->select("SELECT g.accname childacc,g.accno cgroup, SUM( ifnull( g.amountdr,0 ) ) totaldr, SUM( ifnull( g.amountcr,0 ) ) totalcr
										FROM tbl_accchart p
										LEFT JOIN  tbl_2ndjournal g ON g.accno = p.id
										WHERE g.groupname = '$expf[cgroup]'
										AND g.vdate BETWEEN '$fdate' AND '$tdate'
										GROUP BY g.accname
				");
				while($cexpf = $myDb->get_row($cexpqry,'MYSQL_ASSOC')){
			?>
			   	<tr>
					<td><?php echo $cexpf['childacc']; ?></td>
					<td align="right"><?php echo number_format(($cexpf['totaldr']-$cexpf['totalcr']),2); ?></td>
					<td></td>
				</tr>
			<?php } ?>	
			   </table>
			</td>
			
		 </tr>
		 <?php $totalpexp += $expamount;} ?>
	   </table>	</td>
	<td colspan="3" valign="top">
	   <table class="cltable">
	     <?php
		    $incqry = $myDb->select("SELECT p.accname parentacc,p.id cgroup, SUM( ifnull( g.amountdr,0 ) ) totaldr, SUM( ifnull( g.amountcr,0 ) ) totalcr
										FROM tbl_accchart p
										LEFT JOIN  tbl_2ndjournal g ON g.groupname = p.id
										WHERE (p.type = 'Income Account')
										AND g.vdate BETWEEN '$fdate' AND '$tdate'
										GROUP BY p.accname
			");
			$totalinc = 0;
			while($incf = $myDb->get_row($incqry,'MYSQL_ASSOC')){
		 ?>
	     <tr>
		 	<td class="parent"><?php echo $incf['parentacc']; ?></td>
			<td></td>
			<td align="right" class="parent"><?php $inamount=($incf['totalcr']-$incf['totaldr']); echo number_format($inamount,2); ?></td>
		</tr>
		<tr>	
			<td colspan="3">
			   <table class="cltable">
			   <?php $cintqry =$myDb->select("SELECT g.accname childacc,g.accno cgroup, SUM( ifnull( g.amountdr,0 ) ) totaldr, SUM( ifnull( g.amountcr,0 ) ) totalcr
										FROM tbl_accchart p
										LEFT JOIN  tbl_2ndjournal g ON g.accno = p.id
										WHERE g.groupname = '$incf[cgroup]'
										AND g.vdate BETWEEN '$fdate' AND '$tdate'
										GROUP BY g.accname
				");
				while($cintf = $myDb->get_row($cintqry,'MYSQL_ASSOC')){
			?>
			   	<tr>
					<td><?php echo $cintf['childacc']; ?></td>
					<td align="right"><?php echo number_format(($cintf['totalcr']-$cintf['totaldr']),2); ?></td>
					<td></td>
				</tr>
			<?php } ?>	
			   </table>
			</td>
			
		 </tr>
		 <?php $totalinc += $inamount;} ?>
	   </table>	
  </tr>
  <tr>
    <td valign="top" class="parent">Excess of Income over Expenditure</td>
    <td valign="top">&nbsp;</td>
	<td align="right" class="parent"><?php echo number_format(($totalinc-$totalpexp),2); ?></td>
	<td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
	<td></td>

  </tr>
  <tr>
    <td valign="top" class="parent">Total</td>
    <td valign="top">&nbsp;</td>
	<td align="right" class="parent"><?php echo number_format($totalpexp,2); ?></td>
	<td valign="top" class="parent">Total</td>
    <td valign="top">&nbsp;</td>
	<td align="right" class="parent"><?php echo number_format($totalinc,2); ?></td>

  </tr>
  
  
</table>
</body>
</html>

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
