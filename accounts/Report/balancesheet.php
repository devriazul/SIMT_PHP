<?php ob_start();
session_start();
require_once('../dbClass.php');
include("../config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_voucher.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  $fdate = !empty($_POST['fdate'])?mysql_real_escape_string($_POST['fdate']):'';
  $tdate = !empty($_POST['tdate'])?mysql_real_escape_string($_POST['tdate']):'';
?>
   
<link rel="stylesheet" href="../main.css"/>
<style type="text/css">
 .brk{
    page-break-before:always;
 }

</style>
<script language="javascript" src="../jquery.js"></script>
<div align="center">
<?php include('report_head.php'); ?>
<h3>Balance Sheet</h3>
<h5><?php echo $_POST['fdate']." To ".$_POST['tdate']; ?></h5>
</div>
<div style="width:100px; padding:5px; text-align:center;  margin:0 130px;">
  <form action="BalancesheetXls.php" method="post">
    <input type="hidden" name="fdate" value="<?php echo $fdate; ?>" />
	<input type="hidden" name="tdate" value="<?php echo $tdate; ?>"/>
  	<input type="submit" value="Populate XLS Report"/>
  </form>
  
</div>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" class="style5" style="padding:3px; ">
  <!--DWLayoutTable-->
  <tr class="gridTblHead" style="padding:3px; ">
    <td width="354" height="23">Liabilities</td>
    <td width="58">&nbsp;</td>
    <td width="377">Assets</td>
    <td width="70">&nbsp;</td>
  </tr>
  <?php $sumobl=0;$val=0;
  		/*$bnk=$myDb->select("SELECT p.id, p.accname, (SUM( c.amountdr )-SUM( c.amountcr ))totalval 
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
									AND p.parentid>0
									and c.vdate<'$_POST[fdate]'
									and c.groupname in(1879,1884)
									group by p.accname");
		while($bnkf=$myDb->get_row($bnk,'MYSQL_ASSOC')){
		   $sumobl+=$bnkf['totalval'];
		}
		*/
  ?>						
  <tr>
    <td height="23" valign="top">
	
	
	</td>
    <td>&nbsp;</td>
    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="23" valign="top"><table width="90%" class="pltable">
  <?php $mqry = $myDb->select("select p.id,p.accname,ifnull(sum(g.amountdr),0) amountdr,ifnull(sum(g.amountcr),0) amountcr
  								from tbl_accchart p
								left join tbl_2ndjournal g
								on p.id = g.groupname
								where p.groupname = 0
								and p.parentid=0
								and p.id in(1,1041)
								and g.vdate between '$fdate' and '$tdate'
								group by p.accname
								");
		$totaldr = 0;
		$totalcr = 0;
		$totallib = 0;
		while($mdf = $myDb->get_row($mqry,'MYSQL_ASSOC')){ 
				$totalccadddr = 0;
		$totalccaddcr = 0;

		$cqqry = $myDb->select("select p.accname accname, ifnull(sum(g.amountdr),0) amountdr, ifnull(sum(g.amountcr),0) amountcr
							from tbl_accchart p
							left join tbl_2ndjournal g
							on (p.id=g.parentid or p.id=g.groupname)
							where p.groupname='$mdf[id]'
							and p.id in(select parentid from tbl_accchart)
							and g.vdate between '$fdate' and '$tdate'
							group by p.accname
							
							union all
							
							select g.accname accname, ifnull(sum(g.amountdr),0) amountdr, ifnull(sum(g.amountcr),0) amountcr
							from tbl_accchart p
							left join tbl_2ndjournal g
							on p.id=g.groupname and p.id=g.parentid
							where g.parentid='$mdf[id]'
							and g.groupname='$mdf[id]'
							and g.vdate between '$fdate' and '$tdate'
							group by g.accname
							");
					while($cddf = $myDb->get_row($cqqry,'MYSQL_ASSOC')){
						$totalccadddr +=$cddf['amountdr'];
						$totalccaddcr +=$cddf['amountcr'];
					}
					$rootval = ($totalccaddcr-$totalccadddr);
		?>
		<tr>
			<td width="227" class="child"><strong><?php echo $mdf['accname']; ?> </strong></td>
			<td width="205" align="right" class="child"></td>
			<td width="114" align="right" class="child"><strong><?php echo number_format(($rootval),2); ?></strong></td>
		</tr>
		
		<tr>
		  <td colspan="3"  >
			<table width="100%" style="margin:0 30px; width:100%; " class="cltable">
			<?php $cqry = $myDb->select("select p.accname accname, ifnull(sum(g.amountdr),0) amountdr, ifnull(sum(g.amountcr),0) amountcr
							from tbl_accchart p
							left join tbl_2ndjournal g
							on (p.id=g.parentid or p.id=g.groupname)
							where p.groupname='$mdf[id]'
							and p.id in(select parentid from tbl_accchart)
							and g.vdate between '$fdate' and '$tdate'
							group by p.accname
							
							union all
							
							select g.accname accname, ifnull(sum(g.amountdr),0) amountdr, ifnull(sum(g.amountcr),0) amountcr
							from tbl_accchart p
							left join tbl_2ndjournal g
							on p.id=g.groupname and p.id=g.parentid
							where g.parentid='$mdf[id]'
							and g.groupname='$mdf[id]'
							and g.vdate between '$fdate' and '$tdate'
							group by g.accname
							");
		
					while($cdf = $myDb->get_row($cqry,'MYSQL_ASSOC')){ 
					$cval = ($cdf['amountcr']-$cdf['amountdr']);
					?>
				<tr>
					<td width="45%"><?php echo $cdf['accname']; ?></td>
					<td width="26%" align="right"><?php echo number_format($cval,2); ?></td>
					<td width="29%" align="right"></td>
				</tr>
				<?php $totaldr +=$cdf['amountdr']; $totalcr +=$cdf['amountcr']; } ?>
				
			</table>
		  </td>
		</tr>
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
				$expamount=($expf['totaldr']-$expf['totalcr']);
				$cexpqry =$myDb->select("SELECT g.accname childacc,g.accno cgroup, SUM( ifnull( g.amountdr,0 ) ) totaldr, SUM( ifnull( g.amountcr,0 ) ) totalcr
										FROM tbl_accchart p
										LEFT JOIN  tbl_2ndjournal g ON g.accno = p.id
										WHERE g.groupname = '$expf[cgroup]'
										AND g.vdate BETWEEN '$fdate' AND '$tdate'
										GROUP BY g.accname
				");
				while($cexpf = $myDb->get_row($cexpqry,'MYSQL_ASSOC')){	
				}
				$totalpexp += $expamount;
				}		
		    $incqry = $myDb->select("SELECT p.accname parentacc,p.id cgroup, SUM( ifnull( g.amountdr,0 ) ) totaldr, SUM( ifnull( g.amountcr,0 ) ) totalcr
										FROM tbl_accchart p
										LEFT JOIN  tbl_2ndjournal g ON g.groupname = p.id
										WHERE (p.type = 'Income Account')
										AND g.vdate BETWEEN '$fdate' AND '$tdate'
										GROUP BY p.accname
			");
			$totalinc = 0;
			while($incf = $myDb->get_row($incqry,'MYSQL_ASSOC')){
				$inamount=($incf['totalcr']-$incf['totaldr']);
				$cintqry =$myDb->select("SELECT g.accname childacc,g.accno cgroup, SUM( ifnull( g.amountdr,0 ) ) totaldr, SUM( ifnull( g.amountcr,0 ) ) totalcr
										FROM tbl_accchart p
										LEFT JOIN  tbl_2ndjournal g ON g.accno = p.id
										WHERE g.groupname = '$incf[cgroup]'
										AND g.vdate BETWEEN '$fdate' AND '$tdate'
										GROUP BY g.accname
				");
				while($cintf = $myDb->get_row($cintqry,'MYSQL_ASSOC')){			
				
				}
				$totalinc += $inamount;
			}
			
			?>
			<tr>
			<td><strong>Excess of Income over Expenditure</strong></td>
			<td><?php $totalincome = ($totalinc-$totalpexp); ?></td>
			<td align="right"><strong><?php echo number_format($totalincome,2); ?></strong></td>
			
			</tr>		
							
		
		<?php  $totallib = (($totalcr-$totaldr)+$totalincome);} ?>
</table></td>
    <td valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td valign="top">
<table width="90%" class="pltable">
  <?php $mqry = $myDb->select("select p.id,p.accname,ifnull(sum(g.amountdr),0) amountdr,ifnull(sum(g.amountcr),0) amountcr
  								from tbl_accchart p
								inner join tbl_2ndjournal g
								on p.id = g.groupname
								where p.groupname = 0
								and p.parentid=0
								and p.id in(2,3)
								and g.vdate between '$fdate' and '$tdate'
								group by p.accname
								");
		$totalas = 0;				
		$totaladr = 0;
		$totalacr = 0;
		while($mdf = $myDb->get_row($mqry,'MYSQL_ASSOC')){ 
				$totalccadddr = 0;
		$totalccaddcr = 0;

		$cqqry = $myDb->select("select p.accname accname, ifnull(sum(g.amountdr),0) amountdr, ifnull(sum(g.amountcr),0) amountcr
							from tbl_accchart p
							left join tbl_2ndjournal g
							on (p.id=g.parentid or p.id=g.groupname)
							where p.groupname='$mdf[id]'
							and p.id in(select parentid from tbl_accchart)
							and g.vdate between '$fdate' and '$tdate'
							group by p.accname
							
							union all
							
							select g.accname accname, ifnull(sum(g.amountdr),0) amountdr, ifnull(sum(g.amountcr),0) amountcr
							from tbl_accchart p
							left join tbl_2ndjournal g
							on p.id=g.groupname and p.id=g.parentid
							where g.parentid='$mdf[id]'
							and g.groupname='$mdf[id]'
							and g.vdate between '$fdate' and '$tdate'
							group by g.accname
							");
					while($cddf = $myDb->get_row($cqqry,'MYSQL_ASSOC')){
						$totalccadddr +=$cddf['amountdr'];
						$totalccaddcr +=$cddf['amountcr'];
					}
		?>
		<tr>
			<td width="212" class="child"><strong><?php echo $mdf['accname']; ?> </strong></td>
			<td width="208" align="right" class="child"></td>
			<td width="113" align="right" class="child"><strong><?php echo ($totalccadddr-$totalccaddcr); ?></strong></td>
		</tr>
		
		<tr>
		  <td colspan="3"  >
			<table width="100%" style="margin:0 30px; width:100%; " class="cltable">
			<?php $cqry = $myDb->select("select p.id,p.accname,sum(g.amountdr) amountdr,sum(g.amountcr) amountcr 
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
					while($cdf = $myDb->get_row($cqry,'MYSQL_ASSOC')){ ?>
				<tr>
					<td width="45%"><?php if($cdf['accname']==="61-Architecture1112"){echo "Sundry Debtors"; }else{ echo $cdf['accname']; } ?></td>
					<td width="26%" align="right"><?php echo number_format(($cdf['amountdr']-$cdf['amountcr']),2); ?></td>
					<td width="29%" align="right"></td>
				</tr>
				<?php $totaladr +=$cdf['amountdr']; $totalacr +=$cdf['amountcr']; } ?>
			</table>
		  </td>
		</tr>
		
		
							
		
		<?php  $totalas = ($totaladr-$totalacr);} ?>
</table>	
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="23"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="23" style="border-top:1px solid #999999; ">Total</td>
    <td style="border-top:1px solid #999999; "><strong><em><?php echo number_format($totallib,2); ?></em></strong></td>
    <td style="border-top:1px solid #999999; ">Total</td>
    <td style="border-top:1px solid #999999; "><em><strong><?php echo number_format($totalas,2); ?></strong></em></td>
  </tr>
</table>
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>
