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
	<link href="../css/core.css" rel="stylesheet" type="text/css"/>
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
  table{
    margin-bottom:15px;
  }	
  table td{
      padding:5px;
  }
.logo{
   margin:0 auto;
    background-image:url(logo.png);
	background-position:right;
	background-repeat:no-repeat;
	height:70px;
	width:100px;
	height:88px;
	top:120px;
	position:relative;
}	
.style33 {color: #FFFFFF; font-weight: bold; font-style: italic; }
</style>
<script language="javascript">
window.open(url,'liveMatches','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=720,height=800');</script>
</head>
<body>
  <?php 
  	    $posi=strpos($_POST['accno'],'->');
		$getacc=substr($_POST['accno'],0,$posi);		
		$ts=mysql_query("select * from tbl_accchart 
						 where id='$getacc'") or die(mysql_error());
		$tsf=mysql_fetch_array($ts);

		

  ?>
<div style="width:800px; margin:0 auto;">
<?php include("report_head.php"); ?>
<h4><?php echo "Account of ".$tsf['accname']; ?></h4>
<h5><?php echo $_POST['fdate']." To ".$_POST['tdate']; ?></h5>
</div>

<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" bgcolor="#0066FF"><span class="style33">Date</span></td>
    <td height="30" bgcolor="#0066FF">&nbsp;</td>
    <td height="30" bgcolor="#0066FF"><span class="style33">Particulars</span></td>
    <td height="30" bgcolor="#0066FF"><span class="style33">Vch Type </span></td>
    <td height="30" bgcolor="#0066FF"><span class="style33">Vch No </span></td>
    <td height="30" bgcolor="#0066FF"><span class="style33">Debit</span></td>
    <td height="30" bgcolor="#0066FF"><span class="style33">Credit</span></td>
	<td bgcolor="#0066FF">&nbsp;</td>
	<td bgcolor="#0066FF">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30">Cr</td>
    <td height="30"><strong>Opening Balance </strong></td>
    <td height="30"><?php  
	 
	    
	?>
	<?php $sum1=0;$sum2=0;$ob1=0;$ob2=0;
		$cht=mysql_query("select ifnull(sum(c.amountdr),0) amountdr,ifnull(sum(c.amountcr),0) amountcr
		                    from tbl_masterjournal p
							inner join tbl_2ndjournal c
							on p.voucherid=c.voucherid
							and c.accno<>'$tsf[id]'
							and c.groupname!=4270
							and c.voucherid in(select voucherid from tbl_2ndjournal where accno='$tsf[id]')
							and c.vdate<'$_POST[fdate]'
							
							") or die(mysql_error());
		while($chtf=mysql_fetch_array($cht)){
		  // $ob1=$ob1+$tsf['ob'];
		 
		   $sum1=$sum1+$chtf['amountdr'];
		   $sum2=$sum2+$chtf['amountcr'];
		  
		
		} 
		$opvalue=(($sum1-$sum2));
	   ?></td>
    <td height="30">&nbsp;</td>
    <td height="30"><?php if($opvalue<0){ echo (-($opvalue)); }else{ echo $opvalue; }  ?></td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
  <?php 
  $adr=0;$acr=0;
		$ts1=mysql_query("select * from tbl_2ndjournal where accno='$getacc' and groupname!=4270 and vdate between '$_POST[fdate]' and '$_POST[tdate]'") or die(mysql_error());
		while($tsf1=mysql_fetch_array($ts1)){
 
     $cq=mysql_query("select*from tbl_2ndjournal where  accno!='$tsf1[accno]' and groupname!=4270 and vdate between '$_POST[fdate]' and '$_POST[tdate]' order by vouchertype") or die(mysql_error());
	 while($cqf=mysql_fetch_array($cq)){ 
	 if($tsf1['voucherid']==$cqf['voucherid']){
	 
  ?>
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
    <td height="30" ><?php  
	 $exq=mysql_query("select*from tbl_masterjournal where voucherid='$cqf[voucherid]'") or die(mysql_error());
	 $expf=mysql_fetch_array($exq);
	 echo $cqf['accname']."<br />"."<span style='font-style:italic'>".$expf['voucherexpl']."</span>";
	?></td>
    <td height="30"><?php if($cqf['vouchertype']=="P"){ echo "Payment"; }else if($cqf['vouchertype']=="R"){ echo "Receive"; }else{ echo "Journal"; } ?></td>
    <td height="30"><?php echo $cqf['voucherid']; ?></td>
    <?php  if($cqf['vouchertype']=="J"){ ?>
	<td height="30"><?php echo $cqf['amountcr'];  ?></td>
    <td height="30"><?php  echo $cqf['amountdr'];  ?></td>
	<?php }else{ ?>
	<td height="30"><?php echo $cqf['amountcr'];  ?></td>
    <td height="30"><?php  echo $cqf['amountdr'];  ?></td>
	<?php }  $adr=($adr+$cqf['amountcr']); $acr=($acr+$cqf['amountdr']);    } ?>
  </tr>
  <?php  } } ?>  
  
    <tr>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
    <td height="30" style="border-top:1px solid #999999; "><?php   if($opvalue<0){ echo (-($opvalue))+$adr; }else{ echo $opvalue+$adr; }  ?></td>
    <td height="30" style="border-top:1px solid #999999; "><?php echo $acr; ?></td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
  </tr>
    <tr>
      <td height="30">&nbsp;</td>
      <td height="30">Dr</td>
      <td height="30"><strong>Closing Balance </strong></td>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td height="30" style="border-top:3px double #999999; ">&nbsp;</td>
      <td height="30" style="border-top:3px double #999999; "><?php   if($opvalue<0){ echo (((-($opvalue))+$adr)-($acr)); }else{ echo (($opvalue+$adr)-($acr)); }  ?></td>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
    </tr>
    <tr>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td height="30" style="border-top:3px double #999999; "><?php   if($opvalue<0){ echo (-($opvalue))+$adr; }else{ echo $opvalue+$adr; }  ?></td>
      <td height="30" style="border-top:3px double #999999; "><?php   if($opvalue<0){ echo (((-($opvalue))+$adr)); }else{ echo (($opvalue+$adr)); }  ?></td>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
    </tr>
</table>
<div style="margin-bottom:20px; color:#CCCCCC;">Developed By <a href="https://riaz.fastitbd.com">(Web Developer) </a><a href="https://www.saicgroupbd.com">Saic Group</a></div>
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
