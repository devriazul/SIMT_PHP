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
  $accno=!empty($_POST['accno'])?$_POST['accno']:$_GET['accno'];
  $fdate=!empty($_POST['fdate'])?$_POST['fdate']:$_GET['fdate'];
  $tdate=!empty($_POST['tdate'])?$_POST['tdate']:$_GET['tdate'];
  $monthname=!empty($_POST['monthname'])?$_POST['monthname']:$_GET['monthname'];
?>
<style type="text/css">
@import url("../main.css");
table td{
  padding:5px;
  }
.style26 {color: #FFFFFF; font-weight: bold; font-style: italic; }
</style>

<table width="700" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; ">
  <tr bgcolor="#0000FF">
    <td>&nbsp;</td>
    <td><span class="style26">Particular</span></td>
    <td><span class="style26">VID</span></td>
    <td><span class="style26">Dr</span></td>
    <td><span class="style26">Cr</span></td>
  </tr>  
  <?php $fdate11='';
    $curYear=date("Y");
    $prevYear=$curYear-1;
    switch($monthname){
	  case "January":
	     $fdate11=$prevYear."-12-".date('t',strtotime('December'));
		 $fdate_f=date("Y")."-01-01";
		 $fdate_t=date("Y")."-01-".date('t',strtotime('January'));
		 break;
	  case "February":	
	     $fdate11=date("Y")."-01-".date('t',strtotime('January'));
		 $fdate_f=date("Y")."-02-01";
		 $fdate_t=date("Y")."-02-".date('t',strtotime('February'));
		 break;
	  case "March": 
	     $fdate11=date("Y")."-02-".date('t',strtotime('February'));
		 $fdate_f=date("Y")."-03-01";
		 $fdate_t=date("Y")."-03-".date('t',strtotime('March'));
		 break;
	  case "April":	 
	     $fdate11=date("Y")."-03-".date('t',strtotime('March'));
		 $fdate_f=date("Y")."-04-01";
		 $fdate_t=date("Y")."-04-".date('t',strtotime('April'));
		 break;
	  case "May":	 
	     $fdate11=date("Y")."-04-".date('t',strtotime('April'));
		 $fdate_f=date("Y")."-05-01";
		 $fdate_t=date("Y")."-05-".date('t',strtotime('May'));
		 break;
	  case "June":	 
	     $fdate11=date("Y")."-05-".date('t',strtotime('May'));
		 $fdate_f=date("Y")."-06-01";
		 $fdate_t=date("Y")."-06-".date('t',strtotime('June'));
		 break;
	  case "July":	 
	     $fdate11=date("Y")."-06-".date('t',strtotime('June'));
		 $fdate_f=date("Y")."-07-01";
		 $fdate_t=date("Y")."-07-".date('t',strtotime('July'));
		 break;
	  case "August":	
	     $fdate11=date("Y")."-07-".date('t',strtotime('July'));
		 $fdate_f=date("Y")."-08-01";
		 $fdate_t=date("Y")."-08-".date('t',strtotime('August'));
		 break;
	  case "September":	 
	     $fdate11=date("Y")."-08-".date('t',strtotime('August'));
		 $fdate_f=date("Y")."-09-01";
		 $fdate_t=date("Y")."-09-".date('t',strtotime('September'));
		 break;
	  case "October":	 
	     $fdate11=date("Y")."-09-".date('t',strtotime('September'));
		 $fdate_f=date("Y")."-10-01";
		 $fdate_t=date("Y")."-10-".date('t',strtotime('October'));
		 break;
	  case "November":	 
	     $fdate11=date("Y")."-10-".date('t',strtotime('October'));
		 $fdate_f=date("Y")."-11-01";
		 $fdate_t=date("Y")."-11-".date('t',strtotime('November'));
		 break;
	  case "December":	 
	     $fdate11=date("Y")."-11-".date('t',strtotime('November'));
		 $fdate_f=date("Y")."-12-01";
		 $fdate_t=date("Y")."-12-".date('t',strtotime('December'));
		 break;
		 
	}
  ?>      
  <?php $oprec=$myDb->select("SELECT ifnull(SUM( amountdr ) - SUM( amountcr ),0) opbal 
								FROM tbl_2ndjournal
								WHERE accno ='$accno'
								AND vdate <  '$fdate11'");
   $oprecf=$myDb->get_row($oprec,'MYSQL_ASSOC');
  ?>							  
  <tr>
    <td><strong><em>Opening Balance </em></strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong><em>
      <?php if($oprecf['opbal']<0){ echo "Cr. ".number_format((($oprecf['opbal'])),2); }else{ echo "Dr. ".number_format($oprecf['opbal'],2); } ?>
    </em></strong></td>
  </tr>

  <?php $mrec=$myDb->select("select accno,voucherid from tbl_2ndjournal where accno='$accno' and monthname(vdate)='$monthname'
  							 and vdate between '$fdate' and '$tdate'");
	$tcount=0;						 
    while($mrecf=$myDb->get_row($mrec,'MYSQL_ASSOC')){
    $crec=$myDb->select("select accname,voucherid,sum(amountdr) amountdr,sum(amountcr) amountcr 
						from tbl_2ndjournal where voucherid='$mrecf[voucherid]' 
						and accno<>'$mrecf[accno]'
						group by accname");
	$icount=0;
	while($crecf=$myDb->get_row($crec,'MYSQL_ASSOC')){
	
  ?>
  <tr>
    <td></td>
    <td><a href="#" name="vch<?php echo $icount.$tcount; ?>" alt="<?php echo $crecf['voucherid']; ?>"><?php echo $crecf['accname']; ?></a></td>
    <td><?php echo $crecf['voucherid']; ?></td>
    <td><?php echo number_format($crecf['amountdr'],2); ?></td>
    <td><?php echo number_format($crecf['amountcr'],2); ?></td>
  </tr>
    <tr>
    <td height="5" colspan="5"><div class="cls<?php echo $icount.$tcount; ?>" style="float:right;display:none;background-image:url(../icons/cancel.png); height:50px; position:absolute; width:50px; background-position:right; background-repeat:no-repeat; "></div><div id="Lg<?php echo $icount.$tcount; ?>"></div></td>
  </tr>
  <script language="javascript">
   $(document).ready(function(){
     $('a[name="vch<?php echo $icount.$tcount; ?>"]').unbind().click(function(e){
	   e.preventDefault();
	   var vcid=$(this).attr('alt');
       var accno='<?php echo $accno; ?>';
	   var fdate='<?php echo $fdate; ?>';
	   var tdate='<?php echo $tdate; ?>';
	   var scount='<?php echo $icount; ?>'; 
	   $.get("view_bank_cash_ledger_edit.php?vchid="+vcid+"&fdate="+fdate+"&tdate="+tdate+"&accno="+accno+"&scount="+scount,function(r){
	     $('#Lg<?php echo $icount.$tcount; ?>').css({'box-shadow':'2px 2px 10px #999999'});

		 $('#Lg<?php echo $icount.$tcount; ?>').html('<img src="../loader.gif"/>');
		 $('#Lg<?php echo $icount.$tcount; ?>').html(r);
		 $('.cls<?php echo $icount.$tcount; ?>').show();
		 
	   });

	 });
	 $('.cls<?php echo $icount.$tcount; ?>').click(function(){
	   $('#Lg<?php echo $icount.$tcount; ?>').fadeOut("slow");
	   $('.cls<?php echo $icount.$tcount; ?>').hide();
	   window.location.href = "monthly_ledger_report.php?accno=<?php echo $accno; ?>&fdate=<?php echo $fdate; ?>&tdate=<?php echo $tdate; ?>&monthname=<?php echo $monthname; ?>";
	 });
   
   });
  
  </script>
  <?php $icount++;} $tcount++;} ?>
  <tr>
  <td><em><strong>Closing Balance </strong></em></td>
  <td align="right">&nbsp; </td>
  <td align="right" >&nbsp;</td>
  <td align="right">&nbsp;</td>
  <td align="left" style="border-top:3px double #999999; "><em><strong>
    <?php $clos=$myDb->select("SELECT ifnull(SUM( amountdr ) - SUM( amountcr ),0) opbal 
								FROM tbl_2ndjournal
								WHERE accno ='$accno'
								AND vdate between '$fdate_f' and '$fdate_t'");
   $closf=$myDb->get_row($clos,'MYSQL_ASSOC');
   
  ?>
    <?php $clbal=$oprecf['opbal']+$closf['opbal']; if($clbal<0){ echo "Cr. ".number_format((($clbal)),2); }else{ echo "Dr. ".number_format(($clbal),2); }?></strong></em></td>
  </tr>
  <tr>
    <td style="color:#CCCCCC; font-size:8px; ">Developed by <a href="https://riaz.fastitbd.com">(Web Developer) </a><a href="https://www.saicgroupbd.com">Saic Group</a></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="left">&nbsp;</td>
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
