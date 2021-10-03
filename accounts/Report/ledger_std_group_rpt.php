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
    $fdate=!empty($_POST['fdate'])?$_POST['fdate']:$_GET['fdate'];
    $tdate=!empty($_POST['tdate'])?$_POST['tdate']:$_GET['tdate'];
	$accno=!empty($_POST['accno'])?$_POST['accno']:$_GET['accno'];
	$acnm=!empty($_GET['stgroup'])?$_GET['stgroup']:$_POST['accno'];
	$stgroup=!empty($_GET['stgroup'])?$_GET['stgroup']:$_POST['accno'];
	  $prdq=$myDb->select("select accname,voucherid,vouchertype,vdate,sum(amountdr) amountdr,sum(amountcr) amountcr
	   					from tbl_2ndjournal 
						where  parentid in (select id from tbl_accchart where accname like '$acnm%') 
						and vdate between '$fdate' and '$tdate'
						group by accname");
	  $prdr=mysql_num_rows($prdq);
	  if(empty($page)){
	    $page=1;
	  }	
	  $page -=1;
	  $perpage=25;
	  $totalPage=ceil($prdr/$perpage);
	  
?>  
<style type="text/css">
@import url("../main.css");
  body{ 	 font-size:10px; }
 .pagebreak{
     page-break-before:always;
	 width:800px;
	 margin:0 auto;
	 font-size:13px;
 }	 
 h1,h2{
    font-size:18px;
 }			
.style32 {font-size: 15px; font-weight: bold; padding: 13px; color: #FFFFFF; font-style: italic;}
.rmvh{
  background-color:#fbfbfb;
  font-size:large;
}

.addh{
  background-color:#e8ecee;
  font-size:large;
}
</style>
<script language="javascript" src="../jquery.js"></script>
  <?php 
        /*if(empty($_POST['accno'])){
		    $getacc=mysql_real_escape_string($_GET['accno']);
			$ts=mysql_query("select * from tbl_accchart 
							 where id='$getacc'") or die(mysql_error());
			$tsf=mysql_fetch_array($ts);
		}else{
    
			$posi=strpos($_POST['accno'],'->');
			$getacc=substr($_POST['accno'],0,$posi);		
			$ts=mysql_query("select * from tbl_accchart 
							 where id='$getacc'") or die(mysql_error());
			$tsf=mysql_fetch_array($ts);
        }
		*/
		

  ?>
<?php	  
$i=1;
while($i<=$totalPage){
  $x=$i-1;
  $start=$x*$perpage;		
  if($i>=1){

?>
<div class="pagebreak">
<div align="center">
<?php include('report_head.php'); ?>
<h4><?php echo "Account of ".$stgroup; ?></h4>
<h5><?php echo $fdate." to ".$tdate; ?></h5>

</div>


<table border="0" align="center" cellpadding="0" cellspacing="0" class="tbl_repeat" style="width:800px;">
  <tr>
    <td width="42%" height="30" bgcolor="#0066FF"><span class="style32">Particulars</span></td>
    <td width="16%" height="30" bgcolor="#0066FF"><span class="style32">Dr</span></td>
    <td width="16%" height="30" bgcolor="#0066FF"><span class="style32">Cr</span></td>
	<td width="26%" align="right" bgcolor="#0066FF"><div align="right"><span class="style32">Closing Balance</span></div></td>
	</tr>

  <?php 
  $adr=0;$acr=0;$count=0;
	 //$ts1=mysql_query("select accname,accno,voucherid from tbl_2ndjournal where accname like '$_POST[accno]%' and vdate between '$_POST[fdate]' and '$_POST[tdate]' and voucher_group like '$_POST[accno]%'") or die(mysql_error());
	// echo "select accname,accno,voucherid from tbl_2ndjournal where accname like '$_POST[accno]%' and vdate between '$_POST[fdate]' and '$_POST[tdate]' and voucher_group like '$_POST[accno]%'";
	 
	// while($tsf1=mysql_fetch_array($ts1)){
       $cq=mysql_query("select accno,accname,voucherid,vouchertype,vdate,sum(amountdr) amountdr,sum(amountcr) amountcr
	   					from tbl_2ndjournal 
						where parentid in (select id from tbl_accchart where accname like '$acnm%') 
						and vdate between '$fdate' and '$tdate' 
						group by accname
						LIMIT $start, $perpage
						") or die(mysql_error());
						//LIMIT $start, $perpage
	   while($cqf=mysql_fetch_array($cq)){
	   //if($tsf1['voucherid']==$cqf['voucherid']){
	   
	 
  ?>  
	  <tr class="tr<?php echo $count.$i; ?>">

    <td height="30"><a href="#" name="clk<?php echo $count.$i; ?>" alt="<?php echo $cqf['accno']."->".$cqf['accname']; ?>"><?php echo $cqf['accname']; ?></a><a href="#" id="mins<?php echo $count.$i; ?>" style="width:3px; display:none;margin-left:10px; "><img src="../images/16-circle-red-remove1.png"></a><a href="#" id="pls<?php echo $count.$i; ?>" style="width:3px; display:none;margin-left:10px; ">+</a></td>
    <td height="30"><?php echo number_format($cqf['amountdr'],2);  ?></td>
    <td height="30"><?php  echo number_format($cqf['amountcr'],2);  ?></td>
	<td height="30" align="right"><?php $clv=$cqf['amountdr']-$cqf['amountcr']; if($clv>=0){ echo number_format($clv,2)." Dr"; }else{ echo number_format($clv,2)." Cr"; }?>	  <div align="right"></div></td>
    <?php $adr=($adr+$cqf['amountdr']); $acr=($acr+$cqf['amountcr']);    
	
	//view_ledger_consulate.php?accno=<?php echo $cqf['accno']."->".$cqf['accname'];
	?>
  </tr>
    <tr class="trTg<?php echo $count.$i; ?>">
      <td colspan="4"><div id="dtlvch<?php echo $count.$i; ?>" style="width:700px; margin:0 auto; "> </div></td>
    </tr>
  <script language="javascript">
    $(document).ready(function(){
	  $('a[name="clk<?php echo $count.$i; ?>"]').click(function(e){
		e.preventDefault();
		$("body, html").animate({ 
		   scrollTop: $(this).offset().top
        }, 1000);			
		 var accno=$(this).attr('alt');
		 var fdate='<?php echo $fdate; ?>';
		 var tdate='<?php echo $tdate; ?>';
		 $('#mins<?php echo $count.$i; ?>').show();
		 $.get("view_ledger_consulate_group.php?accno="+accno+"&fdate="+fdate+"&tdate="+tdate,function(r){
		   $('#dtlvch<?php echo $count.$i; ?>').fadeIn("slow").show().html(r);
		 });
			

      });
	  $('#mins<?php echo $count.$i; ?>').click(function(e){
	     e.preventDefault();
	     $('#dtlvch<?php echo $count.$i; ?>').fadeOut("slow");
		 $('#mins<?php echo $count.$i; ?>').hide();
	  });
	  

	  $('.tr<?php echo $count.$i; ?>').mouseover(function(){
	  
	    $('.tr<?php echo $count.$i; ?> td').css({'background-color':'#e8ecee'}).css({'font-size':'normal'});
	  });
	  
	  $('.tr<?php echo $count.$i; ?>').mouseout(function(){
	  
	    $('.tr<?php echo $count.$i; ?> td').css({'background-color':'#ffffff'}).css({'font-size':'normal'});
	  });
	  

	});
  </script>
  
  <?php 
  	  $count++;}
  ?>  
  
  
    <tr>
    <td height="30">&nbsp;</td>
    <td height="30" style="border-top:1px solid #999999; "><?php  echo number_format($adr,2);  ?></td>
    <td height="30" style="border-top:1px solid #999999; "><?php echo number_format($acr,2); ?></td>
    <td height="30" align="right" style="border-top:1px solid #999999; "><?php $fval=$adr-$acr; if($fval>=0){ echo number_format($fval,2)." Dr"; }else{ echo $fval." Cr"; } ?></td>
    </tr>
    <tr>
      <td height="30">&nbsp;</td>
      <td height="30" style="border-top:3px double #999999; "><?php   //if($opvalue<0){ echo (-($opvalue))+$adr; }else{ echo $opvalue+$adr; }  ?></td>
      <td height="30" style="border-top:3px double #999999; "><?php   //if($opvalue<0){ echo (((-($opvalue))+$adr)); }else{ echo (($opvalue+$adr)); }  ?></td>
      <td height="30" style="border-top:3px double #999999; ">&nbsp;</td>
    </tr>
</table>

<?php } ?>
</div>
<?php $i++;
} 
?>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">

  <?php 
  $adr=0;$acr=0;
	 //$ts1=mysql_query("select accname,accno,voucherid from tbl_2ndjournal where accname like '$_POST[accno]%' and vdate between '$_POST[fdate]' and '$_POST[tdate]' and voucher_group like '$_POST[accno]%'") or die(mysql_error());
	// echo "select accname,accno,voucherid from tbl_2ndjournal where accname like '$_POST[accno]%' and vdate between '$_POST[fdate]' and '$_POST[tdate]' and voucher_group like '$_POST[accno]%'";
	 
	// while($tsf1=mysql_fetch_array($ts1)){
       $cq=mysql_query("select accname,voucherid,vouchertype,vdate,sum(amountdr) amountdr,sum(amountcr) amountcr
	   					from tbl_2ndjournal 
						where  parentid in (select id from tbl_accchart where accname like '$acnm%') 
						and vdate between '$fdate' and '$tdate'
						group by accname
						") or die(mysql_error());
						//LIMIT $start, $perpage
	   while($cqf=mysql_fetch_array($cq)){
	   //if($tsf1['voucherid']==$cqf['voucherid']){
	   
	 
  ?>  

    <?php $adr=($adr+$cqf['amountdr']); $acr=($acr+$cqf['amountcr']);    
	?>
  <?php 
  	  }
  ?>  
    <tr>
      <td height="30">&nbsp;</td>
      <td height="30" style="border-top:1px solid #999999; "><strong><em>Dr</em></strong></td>
      <td height="30" style="border-top:1px solid #999999; "><strong><em>Cr</em></strong></td>
      <td height="30" colspan="2" align="right" style="border-top:1px solid #999999; "><strong><em>Closing Balance</em></strong></td>
    </tr>
    <tr>
    <td width="26%" height="30"><strong>Grand Total: </strong></td>
    <td width="23%" height="30" style="border-top:1px solid #999999; " ><?php  echo number_format($adr,2);  ?></td>
    <td width="16%" height="30" style="border-top:1px solid #999999; "><?php echo number_format($acr,2); ?></td>
    <td width="23%" height="30" colspan="2" style="border-top:1px solid #999999; "><div align="right">     <?php $fval=$adr-$acr; if($fval>=0){ echo number_format($fval,2)." Dr"; }else{ echo $fval." Cr"; } ?></div> </td>
    </tr>
</table>
<div align="center" style="color:#CCCCCC; font-size:9px; ">Developed By DesktopBd</div>

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
