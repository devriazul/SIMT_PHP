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
  $tdate = !empty($_POST['tdate']) ? $_POST['tdate'] : '';
  $fdate = !empty($_POST['fdate']) ? $_POST['fdate'] : '';
?>
<style>
 .pltable{
 	width:950px;
	font-size:14px;
	padding:0;
	margin:0 auto;
 }
 
 .pltable td{
   padding:0 30px;
 }
 
 .cltable{
   width:100%;
   margin:0 20px;
   padding:0;
 }
 .cltable td{
   border-top:0;
 }
 .parent{
    font-weight:700;
	border:1px solid #ddd;
	padding:10px;
	margin:0;
 }
 .child{
    font-weight:700;
	border:0
	padding:10px;
	margin:0;
 }
</style>
<div style="text-align:center; ">
<?php include("report_head.php"); ?>
<h3>Trial Balance Statement </h3>
<h2><?php echo $fdate." To ".$tdate; ?></h2>
</div>
<div style="width:100px; padding:5px; text-align:center;  margin:0 130px;">
  <form action="trialbalanceXLS.php" method="post">
    <input type="hidden" name="fdate" value="<?php echo $fdate; ?>" />
	<input type="hidden" name="tdate" value="<?php echo $tdate; ?>"/>
  	<input type="submit" value="Populate XLS Report"/>
  </form>
  
</div>

<table width="90%" class="pltable">
  <tr>
  	<td width="371" class="parent">Particulars</td>
	<td width="320" align="right" class="parent">Debit</td>
	<td width="243" align="right" class="parent">Credit</td>
  </tr>
  <?php 
  		$mqry = $myDb->select("select p.id,p.accname,ifnull(sum(g.amountdr),0) amountdr,ifnull(sum(g.amountcr),0) amountcr
  								from tbl_accchart p
								inner join tbl_2ndjournal g
								on p.id=g.groupname
								where g.vdate between '$fdate' and '$tdate'
								group by p.accname
								");
	    $totaldr = 0;
		$totalcr = 0;
		while($mdf = $myDb->get_row($mqry,'MYSQL_ASSOC')){ 
		
		
		?>
		<tr>
			<td class="child"><?php echo $mdf['accname']; ?> </td>
			<td align="right" class="child"><?php echo number_format(($mdf['amountdr']),2); ?></td>
			<td align="right" class="child"><?php echo number_format(($mdf['amountcr']),2); ?></td>
		</tr>
		
		<tr>
		  <td colspan="3"  >
			<table width="100%" style="margin:0 30px; width:100%; " class="cltable">
			<?php
			$cqry = $myDb->select("select p.id,p.accname,sum(g.amountdr) amountdr,sum(g.amountcr) amountcr 
									from tbl_accchart p 
									inner join tbl_2ndjournal g 
									on p.id=g.parentid 
									where p.parentid='$mdf[id]' 
									and g.vdate between '$fdate' and '$tdate'
									group by p.accname
									union all
									SELECT p.id, p.accname, SUM( g.amountdr ) amountdr, SUM(g.amountcr ) amountcr
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal g ON p.id = g.parentid
									WHERE p.parentid =(select id from tbl_accchart where id=4270 and parentid='$mdf[id]')
									and g.vdate between '$fdate' and '$tdate'
									GROUP BY p.accname
									union all
									select g.id,g.accname, sum(g.amountdr)amountdr,sum(g.amountcr)amountcr
									from tbl_accchart p
									inner join tbl_2ndjournal g
									on p.id=g.accno
									where g.parentid='$mdf[id]'
									and g.vdate between '$fdate' and '$tdate'
									group by g.accname
									union all
									select pcc.id,pcc.accname,sum(gcc.amountdr)amountdr,sum(gcc.amountcr)amountcr
									from tbl_accchart pcc
									inner join tbl_2ndjournal gcc
									on pcc.id=gcc.parentid
									where pcc.parentid in (select id from tbl_accchart where parentid in(select id from tbl_accchart where parentid=6 and groupname='$mdf[id]'))
									and gcc.vdate between '$fdate' and '$tdate'
									");
			while($cqf = $myDb->get_row($cqry,'MYSQL_ASSOC')){
									
								?>
				<tr>
					<td width="45%"><?php if($cqf['accname']==="61-Architecture1112"){ echo "Sundry Debtors"; }else{ echo $cqf['accname'];} ?></td>
					<td width="26%" align="right"><?php echo $cqf['amountdr']; ?></td>
					<td width="29%" align="right"><?php echo $cqf['amountcr']; ?></td>
				</tr>
				<?php } ?>
			</table>
		  </td>
		</tr>
		
		<?php $totaldr +=$mdf['amountdr']; $totalcr +=$mdf['amountcr'];} ?>
							
		
		<tr>
		  <td class="parent child">Total</td>
		  <td align="right" class="parent child"><?php echo $totaldr; ?></td>
		  <td align="right" class="parent child"><?php echo $totalcr; ?></td>
		</tr>
</table>
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