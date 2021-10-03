<?php ob_start();
session_start();
require_once('../dbClass.php');
include("../config.php"); 
include('../inword2.php');

if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_jurnal.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
?>  
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
.style18 {color: #FFFFFF}
</style>
</head>
<body>
    	<?php  
	    $posi=strpos($_POST['accno'],'->');
		$getacc=substr($_POST['accno'],0,$posi);
		
		$ts1=mysql_query("select * from tbl_2ndjournal where accno='$getacc'") or die(mysql_error());
		$tsf1=mysql_fetch_array($ts1);
		
	   ?>

<div style="width:1063px; margin:0 auto;">
<?php include("report_head.php"); ?>
<h3>Ledger Book </h3>

<h4><?php echo "Ledger of ".$tsf1['accname']; ?></h4>
<div align="center">
<table width="90%" border="0" cellspacing="0" cellpadding="0">
    


  <tr>
    <td colspan="2" bgcolor="#0066FF" style="padding-left:5px;padding-top:5px;"><span class="style18">Account's Head </span></td>
    <td height="30" colspan="2" bgcolor="#0066FF" style="padding-left:5px;padding-top:5px;"><span class="style18">Voucherid</span></td>
    <td width="17%" height="30" bgcolor="#0066FF" style="padding-left:5px;padding-top:5px;"><span class="style18">Dr</span></td>
    <td width="12%" height="30" bgcolor="#0066FF" style="padding-left:5px;padding-top:5px;"><span class="style18">Cr</span></td>
    <td width="14%" bgcolor="#0066FF" style="padding-left:5px;padding-top:5px;"><span class="style18">Balance</span></td>
  </tr>	<?php  
	 
	    
		$ts=mysql_query("select * from tbl_accchart 
						 where id='$getacc'") or die(mysql_error());
		$tsf=mysql_fetch_array($ts);
	?>
	<?php $sum1=0;$sum2=0;$ob1=0;$ob2=0;
		$cht=mysql_query("select ifnull(sum(c.amountdr),0) amountdr,ifnull(sum(c.amountcr),0) amountcr
		                    from tbl_masterjournal p
							inner join tbl_2ndjournal c
							on p.voucherid=c.voucherid
							and c.accno<>'$tsf[id]'
							and c.voucherid in(select voucherid from tbl_2ndjournal where accno='$tsf[id]')
							and c.vdate<'$_POST[fdate]'
							
							") or die(mysql_error());
		while($chtf=mysql_fetch_array($cht)){
		  // $ob1=$ob1+$tsf['ob'];
		 
		   $sum1=$sum1+$chtf['amountdr'];
		   $sum2=$sum2+$chtf['amountcr'];
		  
		
		} 
		$opvalue=(($sum1-$sum2));
	   ?>
	   
  <tr>
    <td colspan="2">Opening Balance</td>
    <td width="7%"></td>
    <td width="15%"></td>
    <td></td>
    <td></td>
    <td><?php if($opvalue<0){ echo (-($opvalue)); }else{ echo $opvalue; }  ?></td>
  </tr>
	<?php 
        $vch=mysql_query("select distinct voucherid,vdate
		                  from tbl_2ndjournal
						  where accno<>'$tsf[id]'
						  and voucherid in(select voucherid from tbl_2ndjournal where accno='$tsf[id]')
						  and vdate between '$_POST[fdate]' and '$_POST[tdate]'
						  order by voucherid
							") or die(mysql_error());
		while($vchf=mysql_fetch_array($vch)){
	?>
  <tr>
    <td width="35%" bgcolor="#CCCCFF"><span class="style17">Date:<?php echo $vchf['vdate'];  ?></span></td>
    <td width="35%" bgcolor="#CCCCFF"><span class="style17">VoucherID</span></td>
    <td colspan="2" bgcolor="#CCCCFF"><span class="style17"><?php echo $vchf['voucherid'];  ?></span></td>
    <td bgcolor="#CCCCFF"><span class="style17"></span></td>
    <td bgcolor="#CCCCFF"><span class="style17"></span></td>
    <td bgcolor="#CCCCFF"><span class="style17"></span></td>
  </tr>
	
	<?php 	$amountd=0;$amountc=0;
		$chs=mysql_query("
						  select c.accname,sum(c.amountdr) amountdr,sum(c.amountcr)amountcr
		                  from tbl_masterjournal p
						  inner join tbl_2ndjournal c
						  on p.voucherid=c.voucherid
						  
						  and c.voucherid in(select voucherid from tbl_2ndjournal where accno='$tsf[id]')
						  and c.voucherid='$vchf[voucherid]'
						  and c.accno='$tsf[id]'
						  and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'
						  group by c.accname

						  
						  UNION
						  
						  select c.accname,sum(c.amountdr) amountdr,sum(c.amountcr)amountcr
		                  from tbl_masterjournal p
						  inner join tbl_2ndjournal c
						  on p.voucherid=c.voucherid
						  
						  and c.voucherid in(select voucherid from tbl_2ndjournal where accno='$tsf[id]')
						  and c.voucherid='$vchf[voucherid]'
						  and c.accno<>'$tsf[id]'
						  and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'
						  group by c.accname
							") or die(mysql_error());
		while($chsf=mysql_fetch_array($chs)){
	   ?>
  <tr>
    <td colspan="2"><?php if($tsf['accname']==$chsf['accname']){echo "<span style='padding-left:35px'>As per details</span></br>"; }
	if($tsf['accname']!=$chsf['accname']){echo "<span style='padding-left:35px'>".$chsf['accname']."</span></br>"; }?> 
	<?php ?>	</td>
    <td>&nbsp;</td>
    <td><?php if($tsf['accname']!=$chsf['accname']){ ?>
      <?php if($chsf['amountdr']>0){ echo "Dr.".$chsf['amountdr']; } ?>
      <?php if($chsf['amountcr']>0){ echo "Cr.".$chsf['amountcr']; } ?>
      <?php } ?></td>
    <td><?php if($tsf['accname']==$chsf['accname']){ ?>
      <?php if($chsf['amountdr']>0){ echo "Dr.".$chsf['amountdr']; } ?>
     
      <?php } ?></td>
    <td><?php if($tsf['accname']==$chsf['accname']){ ?>
      
      <?php if($chsf['amountcr']>0){ echo "Cr.".$chsf['amountcr']; } ?>
      <?php } ?></td>
    <td></td>
  </tr>
  <?php 
	
		
		}
	  
     ?>	
	<?php } ?>
<tr>
   <td colspan="2" align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right"><div align="right"></div></td>
    <td></td>
    <td></td>
    <td></td>
 </tr>
	<?php
	
	 $sum11=0;$sum22=0;$ob11=0;$ob22=0;
		$cht1=mysql_query("select ifnull(sum(c.amountdr),0) amountdr,ifnull(sum(c.amountcr),0) amountcr
		                    from tbl_masterjournal p
							inner join tbl_2ndjournal c
							on p.voucherid=c.voucherid
							and c.accno<>'$tsf[id]'
							and c.voucherid in(select voucherid from tbl_2ndjournal where accno='$tsf[id]')
							and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'
        ") or die(mysql_error());
		while($chtf1=mysql_fetch_array($cht1)){
		  // $ob1=$ob1+$tsf['ob'];
		 
		   $sum11=$sum11+$chtf1['amountdr'];
		   $sum22=$sum22+$chtf1['amountcr'];
		  
		
		} 
		$opvalue1=($opvalue+($sum11-$sum22));
	   ?>   
	 
  <tr>
    <td colspan="2">Closing Balance</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td><?php if($opvalue1<0){ echo (-($opvalue1)); }else{ echo $opvalue1; }  ?></td>
  </tr>

 
 <tr>
   <td height="40" colspan="7" valign="middle">&nbsp;</td>
   </tr>
</table>
	   	  	
</div>
<div style="margin-bottom:20px; border-top:1px solid #999999;border-bottom:1px solid #999999;">Developed By DesktopBd</div>

</div>
</body>
</html>


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