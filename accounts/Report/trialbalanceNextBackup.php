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
  <?php $mqry = $myDb->select("select p.id,p.accname,ifnull(sum(g.amountdr),0) amountdr,ifnull(sum(g.amountcr),0) amountcr
  								from tbl_accchart p
								left join tbl_2ndjournal g
								on p.id = g.groupname
								where p.groupname = 0
								and p.parentid=0
								and g.vdate between '$fdate' and '$tdate'
								group by p.accname
								");
	    $totaldr = 0;
		$totalcr = 0;
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
			<td class="child"><?php echo $mdf['accname']; ?> </td>
			<td align="right" class="child"><?php echo number_format(($totalccadddr),2); ?></td>
			<td align="right" class="child"><?php echo number_format(($totalccaddcr),2); ?></td>
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
					while($cdf = $myDb->get_row($cqry,'MYSQL_ASSOC')){ ?>
				<tr>
					<td width="45%"><?php echo $cdf['accname']; ?></td>
					<td width="26%" align="right"><?php echo $cdf['amountdr']; ?></td>
					<td width="29%" align="right"><?php echo $cdf['amountcr']; ?></td>
				</tr>
				<?php } ?>
			</table>
		  </td>
		</tr>
		
		
							
		
		<?php $totaldr +=$mdf['amountdr']; $totalcr +=$mdf['amountcr']; } ?>
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