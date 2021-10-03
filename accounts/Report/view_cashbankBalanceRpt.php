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
<!--
.style18 {
	font-size: 16px;
	font-weight: bold;
}
.style20 {color: #FFFFFF; font-style: italic; }
-->
    </style>
</head>
<body>
<div style="margin:0 auto; width:600px;">
<?php include("report_head.php"); ?>
<h3>Cash/Bank Group Summery  Report</h3>
<?php $fdate=mysql_real_escape_string($_POST['fdate']);
								        $tdate=mysql_real_escape_string($_POST['tdate']);
	                                    echo "From:".mysql_real_escape_string($_POST['fdate'])."   "."To:".mysql_real_escape_string($_POST['tdate']);					
										 
	                              ?>  
</div>
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
    
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="30" bgcolor="#0033FF" style="padding-left:5px;padding-top:5px;"><span class="style20">Particulars</span></td>
      <td height="30" bgcolor="#0033FF" style="padding-top:5px;"><span class="style20">Dr</span></td>
      <td height="30" bgcolor="#0033FF" style="padding-top:5px;"><span class="style20">Cr</span></td>
    </tr>
    <?php $bb=0;$cc=0;
	 $sm=mysql_query("select*from tbl_accchart where id in(1879,1884) order by id desc") or die(mysql_error());
	 while($smf=mysql_fetch_array($sm)){
	 
		
	 
     ?>
    
    
    <?php  
	    
		$ts=mysql_query("
		SELECT p.accname parentname, p.id pid,c.accno chid,sum( c.amountdr ) tamountdr, sum( c.amountcr ) tamountcr, (
			( sum( c.amountdr ) - sum( c.amountcr ) )
			)balance
			FROM tbl_accchart p
			INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
            and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'			
			and (p.parentid='$smf[id]' or c.groupname='$smf[id]')
			GROUP BY p.accname
		") or die(mysql_error());
		while($tsf=mysql_fetch_array($ts)){
		  
	?>
    <tr>
     
      <td height="30" class="s-header"><span class="style18"><?php echo "<span style='padding-left:35px'>".$tsf['parentname']."</span></br>"; ?> </span></td>
      <td height="30" class="s-header"><span class="style18">
        <?php if($tsf['balance']>0){ echo number_format($tsf['balance'],2);}else{ echo 0; } ?>
      </span></td>
      <td height="30" class="s-header"><span class="style18">
        <?php if($tsf['balance']<0){ echo number_format((-($tsf['balance'])),2); }else{ echo 0; } ?>
      </span></td>
    </tr>
	
	<?php 
	 $ch=mysql_query("SELECT accname, (SUM( amountdr ) - SUM( amountcr )) balance 
						FROM tbl_2ndjournal
						WHERE groupname='$tsf[pid]'
						AND vdate between '$_POST[fdate]' and '$_POST[tdate]'
						GROUP BY accname") or die(mysql_error());
	 while($chf=mysql_fetch_array($ch)){					
	
	?>
    <tr>
     
      <td height="30" class="s-header"><?php echo "<span style='padding-left:55px'>".$chf['accname']."</span></br>"; ?> </td>
      <td height="30" class="s-header"><?php if($chf['balance']>0){ echo number_format($chf['balance'],2);}else{ echo 0; } ?></td>
      <td height="30" class="s-header"><?php if($chf['balance']<0){ echo number_format((-($chf['balance'])),2); }else{ echo 0; } ?></td>
    </tr>
    <?php 
	
		}
	  }	
	 } 
	  //$tsum=mysql_query("select sum(amountdr)amountdr,sum(amountcr)amountcr,((sum(amountdr)-sum(amountcr))) balance from trialbalance") or die(mysql_error());
	  //$tsumf=mysql_fetch_array($tsum);
	  
		$tpss=mysql_query("
		SELECT sum( c.amountdr ) tamountdr, sum( c.amountcr ) tamountcr, (
			( sum( c.amountdr ) - sum( c.amountcr ) )
			)balance
			FROM tbl_accchart p
			INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
			and p.id in(1884,1879)
            and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'
			
		") or die(mysql_error());
		
		while($tpssf=mysql_fetch_array($tpss)){
		  if($tpssf['balance']>0){ $bb=$bb+$tpssf['balance']; }
		  if($tpssf['balance']<0){ $cc=$cc+$tpssf['balance']; }
	  	}   
     ?>
    <tr>
      <td height="30" class="m-header" style="border-top:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC;">Grand Total:</td>
      <td height="30" class="m-header" style="border-top:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC;" colspan="2"><?php if($bb>0){ echo number_format($bb,2)." Dr"; }else{ ?>
          <?php  echo ""; } ?><?php if($cc<0){ echo number_format(-($cc),2)." Cr"; }else{ ?>
          <?php  echo ""; }  ?></td>
    </tr>
</table>
<div style="margin-bottom:20px; color:#CCCCCC; text-align:center">Developed By DesktopBd</div>

</body>
</html>


<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.php?msg=$msg");
   }	 

}else{
  header("Location:login.html");
}
}  
?>