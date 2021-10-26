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
.style17 {color: #FFFFFF}
-->
    </style>
</head>
<body>
<div align="center" style=" position:relative; top:-40px;margin:0 auto;">
<?php include("report_head.php"); ?>
<h3>Trial Balance Report</h3>
<?php $fdate=mysql_real_escape_string($_POST['fdate']);
								        $tdate=mysql_real_escape_string($_POST['tdate']);
	                                    echo "From:".mysql_real_escape_string($_POST['fdate'])."   "."To:".mysql_real_escape_string($_POST['tdate']);					
										 
	                              ?>  <table width="70%" border="0" cellspacing="0" cellpadding="0">
    
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="30" bgcolor="#0033FF" style="padding-left:5px;padding-top:5px;"><span class="style17">Account's Head </span></td>
      <td height="30" bgcolor="#0033FF" style="padding-top:5px;"><span class="style17">Dr</span></td>
      <td height="30" bgcolor="#0033FF" style="padding-top:5px;"><span class="style17">Cr</span></td>
    </tr>
    <?php $bb=0;$cc=0;
	 $sm=mysql_query("select*from tbl_accchart where parentid=0") or die(mysql_error());
	 while($smf=mysql_fetch_array($sm)){
	 
		
	 
     ?>
    <?php  

		$tps=mysql_query("
		SELECT sum( c.amountdr ) tamountdr, sum( c.amountcr ) tamountcr, (
			( sum( c.amountdr ) - sum( c.amountcr ) )
			)balance
			FROM tbl_accchart p
			INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
			and (p.parentid='$smf[id]' or p.id='$smf[id]')
			and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'
			group by p.accname
		") or die(mysql_error());
		$b=0;$c=0;
		while($tpsf=mysql_fetch_array($tps)){
		  if($tpsf['balance']>0){ $b=$b+$tpsf['balance']; }
		  if($tpsf['balance']<0){ $c=$c+$tpsf['balance']; }
		
		}
	?>
    <tr>
      <td height="30" valign="middle" class="m-header" style="padding-top:5px;"><?php echo "<span style='padding-left:15px'>".$smf['accname']."</span></br>"; ?></td>
      <td height="30" valign="middle" class="m-header" style="padding-top:5px;"><span style="font-size:16px;  ">
        <?php if($b>0){ echo $b; }else{ ?>
        </span>
          <?php  echo 0; } ?></td>
      <td height="30" valign="middle" class="m-header" style="padding-top:5px;"><span style="font-size:16px; ">
        <?php if($c<0){ echo -($c); }else{ ?>
        </span>
          <?php  echo 0; }  ?></td>
    </tr>
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
		  $smq=mysql_query("SELECT *
									FROM tbl_accchart
									WHERE parentid
									IN (
									
									  SELECT id
									  FROM tbl_accchart
									  WHERE id
											IN (
									
												  SELECT groupname
												  FROM tbl_accchart
											)
									  and parentid=0 and groupname=0
		  )
		   and parentid='$tsf[pid]' and groupname='$tsf[pid]'
		   and id='$tsf[chid]'
		  ") or die(mysql_error());
		  $smqf=mysql_fetch_array($smq);
	?>
    <?php 
	
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
            and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'
			group by p.accname
		") or die(mysql_error());
		
		while($tpssf=mysql_fetch_array($tpss)){
		  if($tpssf['balance']>0){ $bb=$bb+$tpssf['balance']; }
		  if($tpssf['balance']<0){ $cc=$cc+$tpssf['balance']; }
	  	}   
     ?>
    <tr>
      <td height="30" class="m-header" style="border-top:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC;">Grand Total:</td>
      <td height="30" class="m-header" style="border-top:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC;"><?php if($bb>0){ echo $bb; }else{ ?>
          <?php  echo 0; } ?></td>
      <td height="30" class="m-header" style="border-top:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC;" ><?php if($cc<0){ echo -($cc); }else{ ?>
          <?php  echo 0; }  ?></td>
    </tr>
  </table>
</div>
<div style="margin-bottom:20px; padding:10px; border-top:1px solid #999999;border-bottom:1px solid #999999; text-align:center">Developed By <a href="https://riaz.fastitbd.com">(Web Developer) </a><a href="https://www.saicgroupbd.com">Saic Group</a></div>

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