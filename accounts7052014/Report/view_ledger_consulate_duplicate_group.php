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
  
  }?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include('title.php'); ?></title>
<style type="text/css">
<!--
@import url("../main.css");

-->
</style>
	<link href="../css/core.css" rel="stylesheet" type="text/css" />
<style type="text/css">
  #header{
        font-family:"Courier New", Courier, monospace,Verdana;
		font-size:25px;
		font-weight:bold;
  }	
  #sub-header{
        font-family:"Courier New", Courier, monospace,Verdana;
		font-size:15px;
		font-weight:bold;
  }
  #td-line-top{
      border-top:1px dashed #CCCCCC;
  }	
  #td-line-bottom{
      border-bottom:1px dashed #CCCCCC;
  }
  #td-line-left{
        border-top:1px dashed #CCCCCC;

      border-left:1px dashed #CCCCCC;
  }
  #sub-header,#align-right{
     font-family:"Courier New", Courier, monospace,Verdana;
	 font-size:15px;
	 font-weight:bold;

     padding-left:5px;
  }
  #right-most{
     font-family:"Courier New", Courier, monospace,Verdana;
	 font-size:13px;

     padding-left:15px;
  }
  .heading{
     font-family:"Courier New", Courier, monospace,Verdana;
	 font-size:15px;
   }
   .logo{
    background-image:url(logo.png);
	background-position:right;
	background-repeat:no-repeat;
	height:70px;
	width:100px;
	height:88px;
	top:120px;
	left:100px;
	position:relative;
}	
  table td{
      padding:5px;
	  
  }
	 
	
.style17 {color: #333333}
.style20 {color: #FFFFFF; font-style: italic; }
</style>
</head>
<body>
    	<?php  //view_ledger.php?vchid=$vchf[voucherid]&fdate=$_POST[fdate]&tdate=$_POST[tdate]&accno=$getacc
	    //$posi=strpos($_POST['accno'],'->');
		//$getacc=substr($_POST['accno'],0,$posi);
		
		$ts1=mysql_query("select * from tbl_2ndjournal where accno='".$_SESSION['getacc']."' and groupname!=4270 ") or die(mysql_error());
		$tsf1=mysql_fetch_array($ts1);
		
	   ?>

<div style="margin:0 auto; width:800px;">
<h4><?php echo "Ledger of ".$tsf1['accname']; ?></h4>

<div align="center" >
<table width="70%" border="0" cellspacing="0" cellpadding="0">
    


  <tr>
    <td width="41%" bgcolor="#0066FF" style="padding-left:5px;padding-top:5px;"><span class="style20">Particulars</span></td>
    <td height="30" bgcolor="#0066FF" style="padding-left:5px;padding-top:5px;"><span class="style20">Voucherid</span></td>
    <td width="12%" height="30" bgcolor="#0066FF" style="padding-left:5px;padding-top:5px;"><span class="style20">Dr</span></td>
    <td width="8%" height="30" bgcolor="#0066FF" style="padding-left:5px;padding-top:5px;"><span class="style20">Cr</span></td>
    <td width="17%" bgcolor="#0066FF" style="padding-left:5px;padding-top:5px;"><span class="style20">Balance</span></td>
	<td width="8%">&nbsp;</td>
  </tr>	<?php  
	 
	    
		$ts=mysql_query("select * from tbl_accchart 
						 where id='".$_SESSION['getacc']."'") or die(mysql_error());
		$tsf=mysql_fetch_array($ts);
	?>
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
    <td><em>Opening Balance</em></td>
    <td width="14%"></td>
    <td width="12%"></td>
    <td></td>
    <td><em>
      <?php if($opvalue<0){ echo number_format((-($opvalue)),2); }else{ echo number_format($opvalue,2); }  ?>
    </em></td>
    <td></td>
  </tr>
	<?php $count=0;$amountd=0;$amountc=0;
        $vch=mysql_query("select distinct voucherid,vdate
		                  from tbl_2ndjournal
						  where accno='$tsf[id]'
						  and groupname!=4270 
						  and vdate between '$_SESSION[fdate]' and '$_SESSION[tdate]'
						  order by voucherid
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
     $('.edj<?php echo $count; ?>').unbind().click(function(e){
	    e.preventDefault();
		var vchid=$(this).attr('alt');
		//view_ledger.php?vchid=$vchf[voucherid]&fdate=$_POST[fdate]&tdate=$_POST[tdate]&accno=$getacc
		var fdate='<?php echo $_SESSION["fdate"]; ?>';
		var tdate='<?php echo $_SESSION["tdate"]; ?>';
		var accno='<?php echo $_SESSION["getacc"]; ?>';
		var pleft=parseInt(($(this).position().left)+105);
		var ptop=parseInt(($(this).position().top)-50);
		var scount='<?php echo $count; ?>';
		$('#shwj<?php echo $count; ?>').show();
		
		$('#shwj<?php echo $count; ?>').css({'box-shadow':'2px 2px 10px #999999'});
		$('#shwj<?php echo $count; ?>').load("view_ledger_group.php?vchid="+vchid+"&fdate="+fdate+"&tdate="+tdate+"&accno="+accno+"&scount="+scount);
		$('.cls<?php echo $count; ?>').show();//.css({top:ptop,left:pleft});
	 });
	 $('.cls<?php echo $count; ?>').click(function(){
	   $('#shwj<?php echo $count; ?>').fadeOut("slow");
	   $('.cls<?php echo $count; ?>').hide();//css({top:ptop,left:pleft}).hide();
	   window.location.href = "ledger_std_group_rpt.php?stgroup=<?php echo substr($tsf['accname'],0,6); ?>&accno=<?php echo $_SESSION['getacc']; ?>&fdate=<?php echo $_SESSION['fdate']; ?>&tdate=<?php echo $_SESSION['tdate']; ?>";
	 });
    //$.ajaxSetup ({ cache: false });
   });
  
  </script>	 
  
  <tr>
    <td colspan="7"><div class="cls<?php echo $count; ?>" style="float:right;display:none;background-image:url(../icons/cancel.png); height:50px; position:absolute; width:50px; background-position:right; background-repeat:no-repeat; "></div><div id="shwj<?php echo $count; ?>" style="width:700px;"  align="right"></div></td>
    </tr>
  <tr>
    
    <td><?php echo $vchf['vdate']."   ";  ?><?php //if($tsf['accname']==$chsf['accname']){echo "<span style='padding-left:35px'>As per details</span></br>"; }
	if($tsf['accname']!=$chsf['accname']){echo "<span style='padding-left:35px'>".$chsf['accname']."<br/>".$chsf['voucherexpl']."</span></br>"; }?> 
	<?php ?>	</td>
    <td><span class="style17"><?php echo $vchf['voucherid'];  ?></span>      <?php //if($tsf['accname']!=$chsf['accname']){ ?>
      <?php //if($chsf['amountdr']>0){ echo "Cr.".$chsf['amountdr']; } ?>
      <?php //if($chsf['amountcr']>0){ echo "Dr.".$chsf['amountcr']; } ?>      <?php //} ?></td>
    <td>
	  <?php if($tsf['accname']!=$chsf['accname']){  $amountc+=$chsf['amountcr']; ?>
      <?php //if($chsf['amountdr']>0){ echo "Cr.".$chsf['amountdr']; } ?>
      <?php if($chsf['amountcr']>0){ echo "<a href='#' class='edj$count' alt='$vchf[voucherid]' target=new>"."Dr.".number_format($chsf['amountcr'],2)."</a>"; } ?>
      <?php } ?>
	
	
	<?php //if($tsf['accname']==$chsf['accname']){ ?>
      <?php //if($chsf['amountdr']>0){ echo "Dr.".$chsf['amountdr']; } ?>
     
      <?php //} ?></td>
    <td>   

	
	<?php if($tsf['accname']!=$chsf['accname']){ $amountd+=$chsf['amountdr'];?>
      <?php if($chsf['amountdr']>0){ echo "<a href='#' class='edj$count' alt='$vchf[voucherid]' target=new>"."Cr.".number_format($chsf['amountdr'],2)."</a>"; } ?>
      <?php //if($chsf['amountcr']>0){ echo "Dr.".$chsf['amountcr']; } ?>
      <?php } ?>	
	<?php //if($tsf['accname']==$chsf['accname']){ ?>
      
      <?php //if($chsf['amountcr']>0){ echo "Cr.".$chsf['amountcr']; } ?>
      <?php //} ?></td>
    <td></td>
  </tr>

  <?php 
	
		
		}
	  
     ?>	
	<?php $count++;} ?>
<tr>
   <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="left" style="border-top:1px solid #999999;"><?php echo number_format($amountc,2); ?></td>
    <td align="right" style="border-top:1px solid #999999;"><?php echo number_format($amountd,2); ?></td>
    <td></td>
    <td></td>
 </tr>
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
    <td><em>Closing Balance</em></td>
    <td>&nbsp;</td>
    <td style="border-top:3px double #999999; ">&nbsp;</td>
    <td colspan="2" style="border-top:3px double #999999; "><em>
      <?php if($opvalue1<=0){ echo "Cr ".number_format((-($opvalue1)),2); }else{ echo "Dr ".number_format($opvalue1,2); }  ?>
    </em></td>
    <td ></td>
  </tr>

 
 <tr>
   <td height="40" colspan="6" valign="middle">&nbsp;</td>
   </tr>
</table>
	   	  	
</div>
<div style="color:#999999; font-size:9px;">Developed By DesktopBd</div>

</div>
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