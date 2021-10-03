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
		$_SESSION['getacc']=$getacc;
		//$getacc=$_SESSION['getacc'];
  }else if(!empty($_GET['accno'])){
     
	    $posi=strpos($_GET['accno'],'->');
		$getacc=substr($_GET['accno'],0,$posi);
		$_SESSION['getacc']=$getacc;
		//$getacc=$_SESSION['getacc'];
  }
  
  if(!empty($_POST['fdate'])){
    $fdate=$_POST['fdate'];
	$_SESSION['fdate']=$fdate;
	//$fdate=$_SESSION['fdate'];
  }else if(!empty($_GET['fdate'])){
    $fdate=$_GET['fdate'];
	$_SESSION['fdate']=$fdate;
	//$fdate=$_SESSION['fdate'];
  }
  if(!empty($_POST['tdate'])){
    $tdate=$_POST['tdate'];
	$_SESSION['tdate']=$tdate;
	//$tdate=$_SESSION['tdate'];
  
  }else if(!empty($_GET['tdate'])){
    $tdate=$_GET['tdate'];
	$_SESSION['tdate']=$tdate;
	//$tdate=$_SESSION['tdate'];
  
  }
	 
	  $ts1=mysql_query("select * from tbl_2ndjournal where accno='".$_SESSION['getacc']."' and groupname!=4270 ") or die(mysql_error());
	  $tsf1=mysql_fetch_array($ts1);
		
	  $ts=mysql_query("select * from tbl_accchart 
						 where id='".$_SESSION['getacc']."'") or die(mysql_error());
	  $tsf=mysql_fetch_array($ts);
      
	  $prdq=$myDb->select("select distinct voucherid,vdate
		                  from tbl_2ndjournal
						  where accno='$tsf[id]'
						  and groupname!=4270 
						  and vdate between '$_SESSION[fdate]' and '$_SESSION[tdate]'
						  order by vdate");
	  $prdr=mysql_num_rows($prdq);
	  if(empty($page)){
	    $page=1;
	  }	
	  $page -=1;
	  $perpage=8;
	  $totalPage=ceil($prdr/$perpage);
	  

  
?>  
<style type="text/css">
@import url("../main.css");

</style>
<style type="text/css">
 .pagebreak-bfr{
     page-break-before:always;
 }	 
  .pagebreak-aft{
     page-break-after:always;
 }	 

.style17 {color: #333333}
.style20 {color: #FFFFFF; font-style: italic; }
.td{
  border-top:1px solid #333;
}
.tblmain{
  border-left:1px solid #333;
  border-right:1px solid #333;
  border-bottom:1px solid #333;

}
</style>
<?php	  
$j=1;
while(($j<=$totalPage)||$j==1){
  $x=$j-1;
  $start=$x*$perpage;		
  if($j==1){
  
  }
  if($j>1){
    echo "<div class='pagebreak-bfr'>";
  }

?>
<div align="center">
<?php include("report_head.php"); ?>
<h3>Ledger Book </h3>

<h4><?php echo "Ledger of ".$tsf1['accname']; ?></h4>
<h5><?php echo $_SESSION['fdate']." To ".$_SESSION['tdate']; ?></h5>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="tblmain">
  <tr>
    <td width="41%" bgcolor="#0066FF" style="padding-left:5px;padding-top:5px;"><span class="style20">Particulars</span></td>
    <td height="30" bgcolor="#0066FF" style="padding-left:5px;padding-top:5px;"><span class="style20">Voucherid</span></td>
    <td width="12%" height="30" bgcolor="#0066FF" style="padding-left:5px;padding-top:5px;"><span class="style20">Dr</span></td>
    <td width="8%" height="30" bgcolor="#0066FF" style="padding-left:5px;padding-top:5px;"><span class="style20">Cr</span></td>
    <td colspan="2" bgcolor="#0066FF" style="padding-left:5px;padding-top:5px;"><span class="style20">Balance</span></td>
  </tr>
  <?php if($j==1){?>
  <?php $sum1=0;$sum2=0;$ob1=0;$ob2=0;
		$cht=mysql_query("select ifnull(sum(c.amountdr),0) amountdr,ifnull(sum(c.amountcr),0) amountcr
		                    from tbl_masterjournal p
							inner join tbl_2ndjournal c
							on p.voucherid=c.voucherid
							where c.accno='$tsf[id]'
							and c.groupname!=4270 
							and c.vdate<'$_SESSION[fdate]'
							
							") or die(mysql_error());
		while($chtf=mysql_fetch_array($cht)){
		  // $ob1=$ob1+$tsf['ob'];
		 
		   $sum1=$sum1+$chtf['amountdr'];
		   $sum2=$sum2+$chtf['amountcr'];
		  
		
		} 
		$opvalue=(($sum1-$sum2));
	   ?>
  <tr>
    <td class="td"><em>Opening Balance</em></td>
    <td width="14%" class="td"></td>
    <td width="12%" class="td"></td>
    <td class="td"></td>
    <td colspan="2" class="td"><em>
      <?php if($opvalue<0){ echo "Cr. ".number_format((-($opvalue)),2); }else{ echo "Dr. ".number_format($opvalue,2); }  ?>
    </em></td>
  </tr>
  <?php } ?>
  <?php $count=0;$amountd=0;$amountc=0;
        $vch=mysql_query("select distinct voucherid,vdate
		                  from tbl_2ndjournal
						  where accno='$tsf[id]'
						  and groupname!=4270 
						  and vdate between '$_SESSION[fdate]' and '$_SESSION[tdate]'
						  order by vdate
						  LIMIT $start, $perpage
							") or die(mysql_error());
		while($vchf=mysql_fetch_array($vch)){
	?>
  <?php 	
		$chs=mysql_query("
						  select c.accname accname,sum(c.amountdr) amountdr,sum(c.amountcr)amountcr,p.voucherexpl
		                  from tbl_masterjournal p
						  inner join tbl_2ndjournal c
						  on p.voucherid=c.voucherid
						  and c.voucherid='$vchf[voucherid]'
						  and c.accno<>'$tsf[id]'
						  and c.vdate between '$_SESSION[fdate]' and '$_SESSION[tdate]'
							") or die(mysql_error());
	
		while($chsf=mysql_fetch_array($chs)){
	   ?>
  <script language="javascript">
   $(document).ready(function(){
     $('.edj<?php echo $count.$j; ?>').unbind().click(function(e){
	    e.preventDefault();
		var vchid=$(this).attr('alt');
		var fdate='<?php echo $_SESSION["fdate"]; ?>';
		var tdate='<?php echo $_SESSION["tdate"]; ?>';
		var accno='<?php echo $_SESSION["getacc"]; ?>';
		var pleft=parseInt(($(this).position().left)+105);
		var ptop=parseInt(($(this).position().top)-50);
		var scount='<?php echo $count.$j; ?>';
		$('#shwj<?php echo $count.$j; ?>').show();
		
		$('#shwj<?php echo $count.$j; ?>').css({'box-shadow':'2px 2px 10px #999999'});
		$('#shwj<?php echo $count.$j; ?>').load("view_ledger.php?vchid="+vchid+"&fdate="+fdate+"&tdate="+tdate+"&accno="+accno+"&scount="+scount);
		$('.cls<?php echo $count.$j; ?>').show();
	 });
	 $('.cls<?php echo $count.$j; ?>').click(function(){
	   $('#shwj<?php echo $count.$j; ?>').fadeOut("slow");
	   $('.cls<?php echo $count.$j; ?>').hide();
	   window.location.href = "view_ledger_consulate.php?accno=<?php echo $_SESSION['getacc']; ?>&fdate=<?php echo $_SESSION['fdate']; ?>&tdate=<?php echo $_SESSION['tdate']; ?>";
	 });
   });
  
  </script>
  <tr>
    <td colspan="7"><div class="cls<?php echo $count.$j; ?>" style="float:right;display:none;background-image:url(../icons/cancel.png); height:50px; position:absolute; width:50px; background-position:right; background-repeat:no-repeat; "></div>
        <div id="shwj<?php echo $count.$j; ?>" style="width:700px;"  align="right"></div></td>
  </tr>
  <tr>
    <td class="td"><?php echo $vchf['vdate']."   ";  ?>
        <?php //if($tsf['accname']==$chsf['accname']){echo "<span style='padding-left:35px'>As per details</span></br>"; }
	if($tsf['accname']!=$chsf['accname']){echo "<span style='padding-left:35px'>".$chsf['accname']."<br/>".$chsf['voucherexpl']."</span></br>"; }?>
        <?php ?>
    </td>
    <td class="td"><span class="style17"><?php echo $vchf['voucherid'];  ?></span>
        <?php //if($tsf['accname']!=$chsf['accname']){ ?>
        <?php //if($chsf['amountdr']>0){ echo "Cr.".$chsf['amountdr']; } ?>
        <?php //if($chsf['amountcr']>0){ echo "Dr.".$chsf['amountcr']; } ?>
        <?php //} ?></td>
    <td class="td">
      <?php if($tsf['accname']!=$chsf['accname']){  $amountc+=$chsf['amountcr']; ?>
      <?php //if($chsf['amountdr']>0){ echo "Cr.".$chsf['amountdr']; } ?>
      <?php if($chsf['amountcr']>0){ echo "<a href='#' class='edj$count$j' alt='$vchf[voucherid]' target=new>"."Dr.".number_format($chsf['amountcr'],2)."</a>"; } ?>
      <?php } ?>
      <?php //if($tsf['accname']==$chsf['accname']){ ?>
      <?php //if($chsf['amountdr']>0){ echo "Dr.".$chsf['amountdr']; } ?>
      <?php //} ?></td>
    <td class="td">
      <?php if($tsf['accname']!=$chsf['accname']){ $amountd+=$chsf['amountdr'];?>
      <?php if($chsf['amountdr']>0){ echo "<a href='#' class='edj$count$j' alt='$vchf[voucherid]' target=new>"."Cr.".number_format($chsf['amountdr'],2)."</a>"; } ?>
      <?php //if($chsf['amountcr']>0){ echo "Dr.".$chsf['amountcr']; } ?>
      <?php } ?>
      <?php //if($tsf['accname']==$chsf['accname']){ ?>
      <?php //if($chsf['amountcr']>0){ echo "Cr.".$chsf['amountcr']; } ?>
      <?php //} ?></td>
    <td width="17%" class="td" colspan="2"></td>
  </tr>
  <?php 
	
		
		}
	  
     ?>
  <?php $count++;} ?>
  <tr>
    <td align="right" class="td">&nbsp;</td>
    <td align="right" class="td">&nbsp;</td>
    <td align="left" style="border-top:1px solid #999999;" class="td"><?php echo "Dr. ".number_format($amountc,2);  ?></td>
    <td align="right" style="border-top:1px solid #999999;" class="td"><?php echo "Cr. ". number_format($amountd,2); ?></td>
    <td class="td"></td>
    <td width="8%" class="td"></td>
  </tr>
</table>
<?php //} ?>
</div>
<?php $j++;
} 
?>
<table width="70%" border="0" cellspacing="0" cellpadding="0">
	<?php
	
	 $sum11=0;$sum22=0;$ob11=0;$ob22=0;
		$cht1=mysql_query("select ifnull(sum(c.amountdr),0) amountdr,ifnull(sum(c.amountcr),0) amountcr
		                    from tbl_masterjournal p
							inner join tbl_2ndjournal c
							on p.voucherid=c.voucherid
							where c.accno='$tsf[id]'
							and groupname!=4270
							and c.vdate between '$_SESSION[fdate]' and '$_SESSION[tdate]'
							
        ") or die(mysql_error());
		while($chtf1=mysql_fetch_array($cht1)){
		  // $ob1=$ob1+$tsf['ob'];
		 
		   $sum11=$sum11+$chtf1['amountdr'];
		   $sum22=$sum22+$chtf1['amountcr'];
		  
		
		} 
		$opvalue1=($opvalue+($sum11-$sum22));
	   ?>   
  <tr>
    <td class="td"><em>Closing Balance</em></td>
    <td class="td">&nbsp;</td>
    <td style="border-top:3px double #999999; " class="td">&nbsp;</td>
    <td colspan="2" style="border-top:3px double #999999; " class="td"><em>
      <?php if($opvalue1<=0){ echo "Cr ".number_format((-($opvalue1)),2); }else{ echo "Dr ".number_format($opvalue1,2); }  ?>
    </em></td>
  </tr>
</table>
<div style="color:#fbfbfb; font-size:9px;margin-top:10px;">Developed By DesktopBd</div>
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