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
<style type="text/css">
   .m-header{
  font: normal 17px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif;
  }	
   .s-header{
	  font: normal 13px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif;
		
  }	
  #header{
  font: normal 15px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif;
  }	
  #sub-header{
  font: normal 13px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif;
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
  font: normal 13px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif;

     padding-left:5px;
  }
  #right-most{
  font: normal 13px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif;
     padding-left:15px;
  }
  .heading{
  font: normal 13px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif;
   }	 
	
</style>
	<link href="../css/core.css" rel="stylesheet" type="text/css" />

    <style type="text/css">
.style17 {color: #FFFFFF; font-style:italic; font-weight:bold;}
    </style>
</head>
<body>
<div align="center" style="margin:0 auto; width:700px;">
<?php include("report_head.php"); ?>
<h3>Income Statement </h3>
<?php //$fdate=mysql_real_escape_string($_POST['fdate']);
								        //$tdate=mysql_real_escape_string($_POST['tdate']);
	                                    //echo "From:".mysql_real_escape_string($_POST['fdate'])."   "."To:".mysql_real_escape_string($_POST['tdate']);					
										 
	                              ?>  
</div>
<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
    
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="30" bgcolor="#0033FF" style="padding-left:5px;padding-top:5px;"><span class="style17">Particulars</span></td>
      <td height="30" bgcolor="#0033FF" style="padding-top:5px;"><span class="style17">Dr</span></td>
      <td height="30" bgcolor="#0033FF" style="padding-top:5px;"><span class="style17">Cr</span></td>
      <td bgcolor="#0033FF" style="padding-top:5px;"><span class="style17">Balance</span></td>
    </tr>
    <?php $bb=0;$cc=0;$pL=0;$dL=0;
	 $sm=mysql_query("select*from tbl_accchart where parentid=0 and groupname=0 and (accname like '%income%' or accname like '%expenses%') order by id") or die(mysql_error());
	 while($smf=mysql_fetch_array($sm)){
	 
		
	 
     ?>
    <?php  		$b=0;$c=0;$d=0;$e=0;


		$tps=mysql_query("
		SELECT sum( c.amountdr ) tamountdr, sum( c.amountcr ) tamountcr, (
			( sum( c.amountdr ) - sum( c.amountcr ) )
			)balance
			FROM tbl_accchart p
			INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
			and (p.parentid='$smf[id]' or p.id='$smf[id]')
			group by p.accname
		") or die(mysql_error());
		while($tpsf=mysql_fetch_array($tps)){
		  if($tpsf['balance']>0){ $b=$b+$tpsf['balance'];  }
		  
		  if($tpsf['balance']<0){ $c=$c+$tpsf['balance']; 
		   }
		   
		
		}$d +=$b; $e -=$c; $pL +=$e-$d;
	?>
	<?php if(($d>0||$d<0)||($e>0||$e<0)){ ?>
    <tr>
      <td height="30" valign="middle" class="m-header" style="padding-top:5px;"><?php echo "<span style='padding-left:15px'>".$smf['accname']."</span></br>"; ?></td>
      <td height="30" valign="middle" class="m-header" style="padding-top:5px;"><span style="font-size:16px;  ">
        <?php if($b>0){ echo number_format($b,2); }else{ ?>
        </span>
          <?php  echo 0; } ?></td>
      <td height="30" valign="middle" class="m-header" style="padding-top:5px;"><span style="font-size:16px; ">
        <?php if($c<0){ echo number_format(-($c),2); }else{ ?>
        </span>
          <?php  echo 0; }  ?></td>
      <td height="30" valign="middle" class="m-header" style="padding-top:5px;"><?php if($d){echo number_format($d,2); } if($e){ echo number_format($e,2); } ?></td>
    </tr>
	<?php } ?>
    <?php  
	    
		$ts=mysql_query("
		SELECT p.accname parentname, p.id pid,c.accno chid,sum( c.amountdr ) tamountdr, sum( c.amountcr ) tamountcr, (
			( sum( c.amountdr ) - sum( c.amountcr ) )
			)balance
			FROM tbl_accchart p
			INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
			and (p.parentid='$smf[id]' or c.groupname='$smf[id]')
			GROUP BY p.accname
		") or die(mysql_error());
		while($tsf=mysql_fetch_array($ts)){
		  $smq=mysql_query("SELECT accname,(sum(amountdr)-sum(amountcr)) balance
		   from tbl_2ndjournal
		   where parentid='$tsf[pid]' and groupname='$tsf[pid]'
		  
		   group by accname
		  ") or die(mysql_error());
		  while($smqf=mysql_fetch_array($smq)){
	?>
	<tr>
      <?php if($smqf['accname']!=""){ ?>
      <td height="30" class="s-header"><?php echo "<span style='padding-left:35px'>".$smqf['accname']."</span></br>"; ?> </td>
      <td height="30" class="s-header"><?php if($smqf['balance']>0){ echo number_format($smqf['balance'],2);}else{ echo 0; } ?></td>
      <td height="30" class="s-header"><?php if($smqf['balance']<0){ echo number_format((-($smqf['balance'])),2); }else{ echo 0; } ?></td>
	  <td height="30" class="s-header">&nbsp;</td>
	</tr>
	<?php }else{ ?>
	<tr>  
      
      <td height="30" class="s-header"><?php echo "<span style='padding-left:35px'>".$tsf['parentname']."</span></br>"; ?> </td>
      <td height="30" class="s-header"><?php if($tsf['balance']>0){ echo number_format($tsf['balance'],2);}else{ echo 0; } ?></td>
      <td height="30" class="s-header"><?php if($tsf['balance']<0){ echo number_format((-($tsf['balance'])),2); }else{ echo 0; } ?></td>
	 
      <td height="30" class="s-header">&nbsp;</td>
	</tr>		 
	 <?php }} ?>
    <?php 
	
		 }
	  }	
     ?>
    <tr>
      <td height="30" class="m-header" style="border-top:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC;"><?php if($pL>0){ echo "Net Profit:"; }else if($pL<0){ echo "Net Loss:"; }else{ echo "Profit/Loss:"; } ?></td>
      <td height="30" class="m-header" style="border-top:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC;">&nbsp;</td>
      <td height="30" class="m-header" style="border-top:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC;" >&nbsp;</td>
      <td height="30" class="m-header" style="border-top:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC;" ><?php echo number_format($pL,2); ?></td>
    </tr>
</table>
<div style="margin-bottom:20px; padding:10px; color:#CCCCCC; text-align:center">Developed By DesktopBd</div>

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