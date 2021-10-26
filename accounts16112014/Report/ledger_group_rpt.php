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
  $fdate=!empty($_POST['fdate'])?$_POST['fdate']:$_GET['fdate'];
  $tdate=!empty($_POST['tdate'])?$_POST['tdate']:$_GET['tdate'];
  $accno=!empty($_POST['accno'])?$_POST['accno']:$_GET['accno'];
  if($car['ins']=="y"){
	  $prdq=$myDb->select("select *
	   					from tbl_2ndjournal 
						where  accname not like '$_POST[accno]%' 
						and voucher_group like '$_POST[accno]%'
						and vdate between '$_POST[fdate]' and '$_POST[tdate]' 
						and groupname!=4270
						group by accname,vouchertype");
	  $prdr=mysql_num_rows($prdq);
	  if(empty($page)){
	    $page=1;
	  }	
	  $page -=1;
	  $perpage=3;
	  $totalPage=ceil($prdr/$perpage);
	  
?>  
<style type="text/css">
@import url("../main.css");
 .pagebreak{
     page-break-before:always;
 }	 
 h1,h2{
    font-size:18px;
 }			
.style32 {font-size: 15px; font-weight: bold; padding: 13px; color: #FFFFFF; font-style: italic; }
</style>
<script language="javascript" src="../jquery.js"></script>

  <?php 
  	    $posi=strpos($_POST['accno'],'->');
		$getacc=substr($_POST['accno'],0,$posi);		
		$ts=mysql_query("select * from tbl_accchart 
						 where id='$getacc'") or die(mysql_error());
		$tsf=mysql_fetch_array($ts);

		

  ?>
<?php	  
//$i=1;
//while($i<=$totalPage){
//  $x=$i-1;
//  $start=$x*$perpage;		
//  if($i>=1){

?>
<div class="pagebreak">
<div align="center">
<?php include("report_head.php"); ?>
<h3>LEDGER SUMMERY REPORT</h3>
<h4><?php echo "Account of ".$_POST['accno']; ?></h4>
<h5><?php echo $_POST['fdate']." To ".$_POST['tdate']; ?></h5>
</div>


<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="13%" height="30" bgcolor="#0066FF"><span class="style32">Date</span></td>
    <td width="8%" height="30" bgcolor="#0066FF">&nbsp;</td>
    <td width="19%" height="30" bgcolor="#0066FF"><span class="style32">Particulars</span></td>
    <td width="10%" height="30" bgcolor="#0066FF"><span class="style32">VType </span></td>
    <td width="10%" height="30" bgcolor="#0066FF">&nbsp;</td>
    <td width="17%" height="30" bgcolor="#0066FF"><span class="style32">Dr</span></td>
    <td width="12%" height="30" bgcolor="#0066FF"><span class="style32">Cr</span></td>
	<td width="5%" bgcolor="#0066FF">&nbsp;</td>
	<td width="6%" bgcolor="#0066FF">&nbsp;</td>
  </tr>
  <?php $sum1=0;$sum2=0;$ob1=0;$ob2=0;
		$cht=mysql_query("select ifnull(sum(c.amountdr),0) amountdr,ifnull(sum(c.amountcr),0) amountcr
		                    from tbl_masterjournal p
							inner join tbl_2ndjournal c
							on p.voucherid=c.voucherid
							and c.accname not like '$_POST[accno]%'
							and c.voucher_group like '$_POST[accno]%'
							and c.vdate<'$_POST[fdate]'
							and groupname!=4270
							order by c.vdate asc
							
							") or die(mysql_error());
												
		while($chtf=mysql_fetch_array($cht)){
		  // $ob1=$ob1+$tsf['ob'];
		 
		   $sum1=$sum1+$chtf['amountdr'];
		   $sum2=$sum2+$chtf['amountcr'];
		  
		
		} 
		$opvalue=(($sum2-$sum1));
	   ?>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30"><?php if($opvalue<0){ ?>Dr<?php }else{ ?>Cr<?php } ?></td>
    <td height="30"><em><strong>Opening Balance </strong></em></td>
    <td height="30"><em>
      <?php  
	 
	    
	?>
    </em>	</td>
    <td height="30">&nbsp;</td>
    <td height="30"><em>
      <?php if($opvalue>=0){ echo number_format($opvalue,2); } ?>
    </em></td>
    <td height="30"><em>
      <?php if($opvalue<0){ echo number_format((-($opvalue)),2); }  ?>
    </em></td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
  </tr>
  <?php 
  $adr=0;$acr=0;$count=0;
	 //$ts1=mysql_query("select accname,accno,voucherid from tbl_2ndjournal where accname like '$_POST[accno]%' and vdate between '$_POST[fdate]' and '$_POST[tdate]' and voucher_group like '$_POST[accno]%'") or die(mysql_error());
	// echo "select accname,accno,voucherid from tbl_2ndjournal where accname like '$_POST[accno]%' and vdate between '$_POST[fdate]' and '$_POST[tdate]' and voucher_group like '$_POST[accno]%'";
	 
	// while($tsf1=mysql_fetch_array($ts1)){
       $cq=mysql_query("select accno,accname,voucherid,vouchertype,vdate,sum(amountdr) amountdr,sum(amountcr) amountcr
	   					from tbl_2ndjournal 
						where  accname not like '$_POST[accno]%'
						and voucher_group like '$_POST[accno]%'
						and vdate between '$_POST[fdate]' and '$_POST[tdate]'
						and groupname!=4270 
						group by accname,vouchertype
						") or die(mysql_error());
						//LIMIT $start, $perpage
	   while($cqf=mysql_fetch_array($cq)){
	   //if($tsf1['voucherid']==$cqf['voucherid']){
	   
	 
  ?>  <tr class="tr<?php echo $count; ?>">

    <td height="30"><?php echo $cqf['vdate']; ?></td>
    <td height="30"><?php if($cqf['vouchertype']=="P" && $cqf['amountcr']>0){ 
	                            echo "Cr"; 
						  }else if($cqf['vouchertype']=="P" && $cqf['amountdr']>0){
						        echo "Dr";
						  }else if($cqf['vouchertype']=="R" && $cqf['amountdr']>0){ 
						        echo "Dr"; 
						  }else if($cqf['vouchertype']=="R" && $cqf['amountcr']>0){
						        echo "Cr"; 
						  }else{ 
							   if($cqf['vouchertype']=="J"){ 
								   if($cqf['amountdr']>0){
									   echo "Dr"; 
								   }else if($cqf['amountcr']>0){
									   echo "Cr"; 
								   }
							   }  
				  
				  
				  } ?></td>
    <td height="30"><a href="#" name="clk<?php echo $count; ?>" alt="<?php echo $cqf['accno']."->".$cqf['accname']; ?>"><?php echo $cqf['accname']; ?></a><a href="#" id="mins<?php echo $count; ?>" style="width:3px; display:none;margin-left:10px; ">-</a><a href="#" id="pls<?php echo $count; ?>" style="width:3px; display:none;margin-left:10px; ">+</a></td>
    <td height="30"><?php if($cqf['vouchertype']=="P"){ echo "Payment"; }else if($cqf['vouchertype']=="R"){ echo "Receive"; }else{ echo "Journal"; } ?></td>
    <td height="30"><?php //echo $cqf['voucherid']; ?></td>
    <?php  if($cqf['vouchertype']=="J"){ ?>
	<td height="30"><?php echo number_format($cqf['amountcr'],2);  ?></td>
    <td height="30"><?php  echo number_format($cqf['amountdr'],2);  ?></td>
	<?php }else{ ?>
	<td height="30"><?php echo number_format($cqf['amountcr'],2);  ?></td>
    <td height="30"><?php  echo number_format($cqf['amountdr'],2);  ?></td>
	<?php }  $adr=($adr+$cqf['amountcr']); $acr=($acr+$cqf['amountdr']);    
		 //} 
	?>
  </tr>
</tr>
    <tr class="trTg<?php echo $count; ?>">
      <td colspan="9"><div id="dtlvch<?php echo $count; ?>" style="width:700px; margin:0 auto; "> </div></td>
    </tr>
  <script language="javascript">
    /*$(document).ready(function(){
	  $('a[name="clk<?php echo $count; ?>"]').unbind().click(function(e){
		e.preventDefault();
		
		 var accno=$(this).attr('alt');
		 var fdate='<?php echo $fdate; ?>';
		 var tdate='<?php echo $tdate; ?>';
		 $.get("view_ledger_consulate_group.php?accno="+accno+"&fdate="+fdate+"&tdate="+tdate,function(r){
		   $('#dtlvch<?php echo $count; ?>').fadeIn("slow").show().html(r);
		 });
      });
	  
	  
	  

	});*/
  </script>  
  <?php 
  	  $count++;}
  
  		
  
  //} 
  ?>  
  
    <tr>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
    <td height="30" style="border-top:1px solid #999999; "><?php   if($opvalue<0){ echo number_format((-($opvalue))+$adr,2); }else{ echo number_format($opvalue+$adr,2); }  ?></td>
    <td height="30" style="border-top:1px solid #999999; "><?php echo number_format($acr,2); ?></td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
  </tr>
    <tr>
      <td height="30">&nbsp;</td>
      <td height="30"><?php if($opvalue<0){ ?>Cr<?php }else{ ?>Dr<?php } ?></td>
      <td height="30"><em><strong>Closing Balance </strong></em></td>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td height="30" style="border-top:1px solid #999999; "><em>
        <?php //if($adr>$acr){ echo (((-($opvalue))+$adr)-($acr)); }  
	  																if($opvalue<0){ echo number_format((((-($opvalue))+$adr)-($acr)),2); }  
																	?>
      </em> </td>
      <td height="30" style="border-top:1px solid #999999; "><em>
        <?php //if($adr<$acr){ echo (($opvalue+$adr)-($acr)); } 
	  																if($opvalue>=0){ echo number_format((($opvalue+$adr)-($acr)),2); } ?>
      </em> </td>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
    </tr>
    <tr>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td height="30" style="border-top:3px double #999999; "><?php   if($opvalue<0){ echo number_format((-($opvalue))+$adr,2); }else{ echo number_format($opvalue+$adr,2); }  ?></td>
      <td height="30" style="border-top:3px double #999999; "><?php   if($opvalue<0){ echo number_format((((-($opvalue))+$adr)),2); }else{ echo number_format((($opvalue+$adr)),2); }  ?></td>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
    </tr>
</table>
<div align="center" style="color:#CCCCCC; font-size:9px; ">Developed By <a href="https://riaz.fastitbd.com">(Web Developer) </a><a href="https://www.saicgroupbd.com">Saic Group</a></div>
<?php //} ?>
</div>
<?php //$i++;
//} 
?>
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
