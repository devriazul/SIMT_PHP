<?php ob_start();
session_start();
require_once('../dbClass.php');
include("../config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_voucher.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
?>

<link rel="stylesheet" href="../main.css"/>
<style type="text/css">
 .brk{
    page-break-before:always;
 }

</style>
<script language="javascript" src="../jquery.js"></script>
<div align="center">
  <div class="logo"></div><h2>SAIC GROUP OF INSTITUTIONS
House-1,Road-2,Block-B,Section-6<br /></h2>
<h3>Mirpur,Dhaka-1216<br />
Receipts & Payments</h3>
<h5><?php echo $_POST['fdate']." To ".$_POST['tdate']; ?></h5>
</div>
<table width="900" border="0" align="center" cellpadding="3" cellspacing="0" class="style5" style="padding:3px; ">
  <!--DWLayoutTable-->
  <tr class="gridTblHead" style="padding:3px; ">
    <td width="354" height="23">Receipts</td>
    <td width="58">&nbsp;</td>
    <td width="377">Payments</td>
    <td width="70">&nbsp;</td>
  </tr>
  <?php $sumobl=0;$val=0;
  		$bnk=$myDb->select("SELECT p.id, p.accname, (SUM( c.amountdr )-SUM( c.amountcr ))totalval 
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
									AND p.parentid>0
									and c.vdate<'$_POST[fdate]'
									and c.groupname in(1879,1884)
									group by p.accname");
		while($bnkf=$myDb->get_row($bnk,'MYSQL_ASSOC')){
		   $sumobl+=$bnkf['totalval'];
		}
  ?>						
  <tr>
    <td height="23"><strong>Opening Balance </strong></td>
    <td><strong><?php echo number_format($sumobl,2); ?></strong></td>
    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="23" valign="top">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
      <?php $bnkname2='';$bnksum2=0; $cshname2='';$cshsum2=0;
  		$bnk2=$myDb->select("SELECT p.id, p.accname, (SUM( c.amountdr )-SUM( c.amountcr ))totalval 
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
									AND p.parentid>0
									and c.vdate<'$_POST[fdate]'
									and c.groupname in(1879,1884)
									group by p.accname
								  ");
		while($bnkf2=$myDb->get_row($bnk2,'MYSQL_ASSOC')){						
		 $bnksum2+=$bnkf2['totalval'];  
      ?>
      <tr>
        <td width="128" height="19" valign="top"><em><?php  echo "<div style='margin-left:20px;'>".$bnkf2['accname']."</div>"; ?></em>
        </td>
        <td width="91" valign="top">&nbsp;</td>
        <td width="63" valign="top"><em><?php echo number_format($bnkf2['totalval'],2);?></em></td>
      </tr>
	  <?php }  ?>
      
    </table>
	
	</td>
    <td>&nbsp;</td>
    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="23" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <?php 
	  $rcvtotal=0;
	  $rtq=$myDb->select("SELECT *from tbl_accchart where parentid=0 and groupname=0  
	  							order by accname asc"); 
	  		while($rtqf=$myDb->get_row($rtq,'MYSQL_ASSOC')){
	  ?>
	  
	  <?php $prq_3=$myDb->select("SELECT c.id, c.accname, (SUM( c.amountcr ))totalval 
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
									AND p.parentid =0
									AND c.groupname='$rtqf[id]'
									and c.vouchertype='R'
									and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'									
									group by c.accname
									UNION ALL 
									SELECT p.id, p.accname, (SUM( c.amountcr )) totalval 
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
									AND p.parentid >0
									and p.parentid='$rtqf[id]'
									and c.vouchertype='R'
									and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'									
									GROUP BY p.accname
								 ");
	  $pycbal=0;
	  while($prqf_3=$myDb->get_row($prq_3,'MYSQL_ASSOC')){
	    if(($prqf_3['id']!=1879)&&($prqf_3['id']!=1884)){
		  $pycbal+=$prqf_3['totalval'];
		}
	  
	  }
	  $rcvtotal+=$pycbal;
	  ?>      
	  <?php if($pycbal>0){ ?>
	  <tr>
        <td height="19" valign="top"><strong><?php echo $rtqf['accname']; ?></strong></td>
        <td height="19" valign="top">&nbsp;</td>
        <td height="19" align="right" valign="top"><strong><?php echo number_format($pycbal,2); ?></strong></td>
      </tr>
	  <?php } ?>
      <?php $prq=$myDb->select("SELECT c.accno id, c.accname, (SUM( c.amountcr ))totalval 
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
									AND p.parentid =0
									AND c.groupname='$rtqf[id]'
									and c.vouchertype='R'
									and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'									
									group by c.accname
									UNION ALL 
									SELECT p.id, p.accname, (SUM( c.amountcr )) totalval 
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
									AND p.parentid >0
									and p.parentid='$rtqf[id]'
									and c.vouchertype='R'
									and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'									
									GROUP BY p.accname
								 ");
	  while($prqf=$myDb->get_row($prq,'MYSQL_ASSOC')){
	  ?>
      <?php if(($prqf['id']!=1879)&&($prqf['id']!=1884)){ ?>
      <tr>
        <td width="238" height="19" valign="top"><em><?php echo "<div style='margin-left:20px;'>".$prqf['accname']."</div>"; ?></em> </td>
        <td width="75" valign="top"><em><?php echo number_format($prqf['totalval'],2); ?></em></td>
        <td width="71" valign="top">&nbsp;</td>
      </tr>	   
	  <tr>
		    <td valign="top"></td>
		    <td valign="top" style="border-bottom:1px solid #999999; "></td>
		    <td valign="top"></td>
	    </tr>

      <?php } ?>
      <?php } ?> 
	  <?php  }?>
    </table></td>
    <td valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <?php $pbtotal=0;
	   		$rtq=$myDb->select("SELECT *from tbl_accchart where parentid=0 and groupname=0  order by accname asc"); 
	  		while($rtqf=$myDb->get_row($rtq,'MYSQL_ASSOC')){
	  ?>
	  
	  <?php $prq_3=$myDb->select("SELECT c.accno id, c.accname, (SUM( c.amountdr ))totalval 
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
									AND p.parentid =0
									AND c.groupname='$rtqf[id]'
									and c.vouchertype='P'
									and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'									
									group by c.accname
									UNION ALL 
									SELECT p.id, p.accname, (SUM( c.amountdr )) totalval 
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
									AND p.parentid >0
									and p.parentid='$rtqf[id]'
									and c.vouchertype='P'
									and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'									
									GROUP BY p.accname
								 ");
	  $pycbal=0;
	  while($prqf_3=$myDb->get_row($prq_3,'MYSQL_ASSOC')){
	    if(($prqf_3['id']!=1879)&&($prqf_3['id']!=1884)){
		  $pycbal+=$prqf_3['totalval'];
		}
	  
	  }
	  $pbtotal+=$pycbal;
	  ?>  
	  <?php if($pycbal>0){ ?>    
	  <tr>
        <td height="19" valign="top"><strong><?php echo $rtqf['accname']; ?></strong></td>
        <td height="19" valign="top">&nbsp;</td>
        <td height="19" align="right" valign="top"><strong><?php echo number_format($pycbal,2); ?></strong></td>
      </tr>
	  <?php } ?>
      <?php $prq=$myDb->select("SELECT c.id, c.accname, (SUM( c.amountdr ))totalval 
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
									AND p.parentid =0
									AND c.groupname='$rtqf[id]'
									and c.vouchertype='P'
									and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'									
									group by c.accname
									UNION ALL 
									SELECT p.id, p.accname, (SUM( c.amountdr )) totalval 
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
									AND p.parentid >0
									and p.parentid='$rtqf[id]'
									and c.vouchertype='P'
									and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'									
									GROUP BY p.accname
								 ");
	  while($prqf=$myDb->get_row($prq,'MYSQL_ASSOC')){
	  ?>
      <?php if(($prqf['id']!=1879)&&($prqf['id']!=1884)){ ?>
      <tr>
        <td width="238" height="19" valign="top"><em><?php echo "<div style='margin-left:20px;'>".$prqf['accname']."</div>"; ?></em> </td>
        <td width="75" valign="top"><em><?php echo number_format($prqf['totalval'],2); ?></em></td>
        <td width="71" valign="top">&nbsp;</td>
      </tr>	  
	  <tr>
		    <td valign="top"></td>
		    <td valign="top" style="border-bottom:1px solid #999999; "></td>
		    <td valign="top"></td>
	    </tr>

      <?php } ?>	   

      <?php } ?> 
	  <?php  }?>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <?php $sumcbl=0;$val=0;
  		$bnk=$myDb->select("SELECT p.id, p.accname, (SUM( c.amountdr )-SUM( c.amountcr ))totalval 
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
									AND p.parentid>0
									and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'
									and c.groupname in(1879,1884)
									group by p.accname");
		while($bnkf=$myDb->get_row($bnk,'MYSQL_ASSOC')){
		   $sumcbl+=$bnkf['totalval'];
		}
  ?>						
  <tr>
    <td height="23"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong>Closing Balance </strong></td>
    <td><strong><?php echo number_format(($sumcbl+$sumobl),2); ?></strong></td>
  </tr>
  <tr>
    <td height="23"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td>&nbsp;</td>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <?php $bnkname3='';$bnksum3=0; $cshname3='';$cshsum3=0;
  		$bnk3=$myDb->select("SELECT p.id, p.accname, (SUM( c.amountdr )-SUM( c.amountcr )) totalval 
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
									AND p.parentid>0
									and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'
									and c.groupname in(1879,1884)
									group by p.accname
								  ");
		while($bnkf3=$myDb->get_row($bnk3,'MYSQL_ASSOC')){						
		 //$bnksum2+=$bnkf2['totalval'];  
      ?>
      <tr>
        <td width="128" height="19" valign="top"><em><?php  echo "<div style='margin-left:20px;'>".$bnkf3['accname']."</div>"; ?></em>
        </td>
        <td width="91" valign="top">&nbsp;</td>
        <td width="63" valign="top"><em><?php echo number_format(($bnkf3['totalval']),2);?></em></td>
      </tr>
	  <?php }  ?>
      
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="23" style="border-top:1px solid #999999; ">Total</td>
    <td style="border-top:1px solid #999999; "><strong><em><?php echo number_format($rcvtotal+$sumobl,2); ?></em></strong></td>
    <td style="border-top:1px solid #999999; ">Total</td>
    <td style="border-top:1px solid #999999; "><em><strong><?php echo number_format($pbtotal+$sumcbl+$sumobl,2); ?></strong></em></td>
  </tr>
</table>
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>
