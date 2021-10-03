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
  	if(!empty($_POST['accno'])){
		$posi=strpos($_POST['accno'],'->');
		$getacc=substr($_POST['accno'],0,$posi);		
		$ts=mysql_query("select * from tbl_accchart 
							 where id='$getacc'") or die(mysql_error());
		$tsf=mysql_fetch_array($ts);
	}else{
		$ts=mysql_query("select * from tbl_accchart 
							 where id='$_GET[accno]'") or die(mysql_error());
		$tsf=mysql_fetch_array($ts);
	}
    
	$accno=!empty($_POST['accno'])?$getacc:$_GET['accno'];
    $fdate=!empty($_POST['fdate'])?$_POST['fdate']:$_GET['fdate'];
	$tdate=!empty($_POST['tdate'])?$_POST['tdate']:$_GET['tdate'];
	//if(!empty($_GET['monthname'])){
	 // $month
	//}
?>
<style type="text/css">
@import url("../main.css");
.style21 {color: #FFFFFF; font-style: italic; font-weight: bold; }
table td{
  padding:5px;
  font-size:13px;
  }
</style>
<script language="javascript" src="../jquery.js"></script>
<div style="margin:0 auto; width:800px;" align="center">
<?php include('report_head.php'); ?>
<h3>Monthly Summery</h3>
<h5><?php echo $fdate." To ".$tdate; ?></h5>

<h4><?php echo "Account of ".$tsf['accname']; ?></h4>

</div>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr bgcolor="#0000FF">
    <td width="280" height="25" bgcolor="#0000FF"><span class="style21">Month</span></td>
    <td width="121" height="25"><span class="style21">Dr</span></td>
    <td width="118" height="25"><span class="style21">Cr</span></td>
    <td height="25" colspan="2"><span class="style21">Balance</span></td>
  </tr>
  <?php $oprec=$myDb->select("SELECT MONTHNAME( vdate ) month, accname, ifnull(SUM( amountdr ),0) Dr, ifnull(SUM( amountcr ),0) Cr
							FROM tbl_2ndjournal
							WHERE accno ='$tsf[id]'
							and vdate<'$fdate'
							and groupname!=4270
							ORDER BY MONTH( vdate )
							");
		$oprecf=$myDb->get_row($oprec,'MYSQL_ASSOC');
		$opvalue=$oprecf['Dr']-$oprecf['Cr'];  
		$opbal=$oprecf['Dr']-$oprecf['Cr'];  

 ?>							
  <tr>
    <td height="30"><em><strong>Opening Balance </strong></em></td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
    <td height="30" colspan="2"><em><strong>
      <?php if($opvalue<0){ echo "Cr. ".number_format((($opvalue)),2); }else{ echo "Dr. ".number_format($opvalue,2); }  ?>
    </strong></em></td>
  </tr>
  <?php $count=0;
  		$rec=$myDb->select("SELECT accno,YEAR(vdate)year,MONTHNAME( vdate ) month,month(vdate) monthnum, accname, SUM( amountdr ) Dr, SUM( amountcr ) Cr
							FROM tbl_2ndjournal
							WHERE accno ='$tsf[id]'
							and vdate between '$fdate' and '$tdate'
							and groupname!=4270
							GROUP BY MONTHNAME( vdate ),month(vdate) 
							ORDER BY YEAR(vdate),MONTH( vdate )");
		$nval=$opbal; $totaldr=0; $totalcr=0; $totalbal=0;						
		while($recf=$myDb->get_row($rec,'MYSQL_ASSOC')){
		$bal=$recf['Dr']-$recf['Cr'];  
		
  ?>							
  <tr>
    <td height="30"><?php echo $recf['year']."  ".$recf['month']; ?></td>
    <td height="30"><?php echo number_format($recf['Dr'],2);  ?></td>
    <td height="30"><?php echo number_format($recf['Cr'],2); ?></td>
    <td width="151" height="30"><a href="#" name="clk<?php echo $count; ?>" target="new" alt="<?php echo $recf['accno']; ?>"><?php $nval=$bal+$nval; $show=$nval; if($nval>0){ echo "Dr. ".number_format($show,2); }else if($nval<0){ echo "Cr. ".number_format(($show),2); }//if($opbal<0){ echo "Cr. ".(-($bal-$opbal)); } if($opbal>0){ echo "Dr. ".$bal+$opbal; } ?></a></td>
    <td width="30"><div id="pls<?php echo $count; ?>" style="display:none;width:4px; float:left; padding:4px; ">+</div><div id="min<?php echo $count; ?>" style="display:none;width:4px; float:left;padding:4px; "><img src="../images/16-circle-red-remove1.png"></div></td>
  </tr>
  <tr>
    <td height="5" colspan="5"><div id="shd<?php echo $count; ?>" style="width:500px; "></div></td>
  </tr>
	<script language="javascript">
	$(document).ready(function(){
	  $('a[name="clk<?php echo $count; ?>"]').click(function(e){
	    e.preventDefault();
		var accno=$(this).attr('alt');
		var fdate='<?php echo $fdate; ?>';
		var tdate='<?php echo $tdate; ?>';
		var monthname='<?php echo $recf["month"]; ?>';
		$('#shd<?php echo $count; ?>').html('<img src="../loader.gif"/>');
		$('#shd<?php echo $count; ?>').show().load("bank_cash_group_details.php?accno="+accno+"&fdate="+fdate+"&tdate="+tdate+"&monthname="+monthname);
		$('#min<?php echo $count; ?>').show();
	  
	  });
	  $('#min<?php echo $count; ?>').click(function(e){
	    e.preventDefault();
		var accno=$('a[name="clk<?php echo $count; ?>"]').attr('alt');
		var fdate='<?php echo $fdate; ?>';
		var tdate='<?php echo $tdate; ?>';
		var monthname='<?php echo $recf["month"]; ?>';
		$('#shd<?php echo $count; ?>').html('<img src="../loader.gif"/>');
		$('#shd<?php echo $count; ?>').hide();
		$('#pls<?php echo $count; ?>').hide();
		$('#min<?php echo $count; ?>').hide();
	  
	  });
	});
	
	</script>
  
  <?php $totaldr+=$recf['Dr']; $totalcr+=$recf['Cr']; $totalbal+=$nval; $count++; } ?>
  <tr>
    <td><strong><em>Grand Total: </em></strong></td>
    <td><strong><em><?php echo "Dr. ".number_format($totaldr,2); ?></em></strong></td>
    <td><strong><em><?php echo "Cr. ".number_format($totalcr,2); ?></em></strong></td>
    <td colspan="2"><strong><em>
      <?php if($nval>0){ echo "Dr. ".number_format($nval,2); }else if($nval<0){ echo "Cr. ".number_format($nval,2); } ?>
    </em></strong></td>
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
