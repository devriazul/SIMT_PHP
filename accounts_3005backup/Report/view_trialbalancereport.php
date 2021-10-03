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
.style12 {font-size: 10px}
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style16 {font-size: 12px}

-->
</style>
<style type="text/css">
   .m-header{
        font-family:"Courier New", Courier, monospace,Verdana;
		font-size:16px;
		font-weight:bold;
  }	
   .s-header{
        font-family:"Courier New", Courier, monospace,Verdana;
		font-size:14px;
		color:#666666;
		
  }	
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
	
</style>
	<link href="../css/core.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div align="center">
  <table width="70%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="3" align="center"><div align="center"><span id="header">SAIC INSTITUTE OF MANAGEMENT AND TECHNOLOGY</span> </div></td>
    </tr>
    <tr>
      <td colspan="3" align="center"><div align="center"><span id="sub-header">Road#2, House #1, Block -B, Section-6,<br />
        Mirpur, Dhaka -1216<br />
        E-Mail :simt140@gmail.com</span></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="30" bgcolor="#CCCCCC" style="padding-left:5px;padding-top:5px;">Account's Head </td>
      <td height="30" bgcolor="#CCCCCC" style="padding-top:5px;">Dr</td>
      <td height="30" bgcolor="#CCCCCC" style="padding-top:5px;">Cr</td>
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
    <tr>
      <?php if($smqf['accname']!=""){ ?>
      <td height="30" class="s-header"><?php echo "<span style='padding-left:35px'>".$smqf['accname']."</span></br>"; ?> </td>
      <?php }else{ ?>
      <td height="30" class="s-header"><?php echo "<span style='padding-left:35px'>".$tsf['parentname']."</span></br>"; ?> </td>
      <?php } ?>
      <td height="30" class="s-header"><?php if($tsf['balance']>0){ echo $tsf['balance'];}else{ echo 0; } ?></td>
      <td height="30" class="s-header"><?php if($tsf['balance']<0){ echo (-($tsf['balance'])); }else{ echo 0; } ?></td>
    </tr>
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