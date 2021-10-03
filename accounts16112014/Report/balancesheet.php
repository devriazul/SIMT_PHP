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
    <?php $bb=0;$cc=0;$pL=0;$dL=0;
	 $sm=mysql_query("select*from tbl_accchart where parentid=0 and groupname=0 and (accname like '%income%' or accname like '%expenses%')") or die(mysql_error());
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
			and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'	
			group by p.accname
		") or die(mysql_error());
		while($tpsf=mysql_fetch_array($tps)){
		  if($tpsf['balance']>0){ $b=$b+$tpsf['balance'];  }
		  
		  if($tpsf['balance']<0){ $c=$c+$tpsf['balance']; 
		   }
		   
		
		}$d +=$b; $e -=$c; $pL +=$e-$d;
	?>
      <?php "<span style='padding-left:15px'>".$smf['accname']."</span></br>"; ?></td>
        <?php if($b>0){ number_format($b,2); }else{ ?>
          <?php  0; } ?></td>
        <?php if($c<0){ number_format(-($c),2); }else{ ?>
          <?php   0; }  ?></td>
      <?php if($d){ number_format($d,2); } if($e){ number_format($e,2); } ?>
    <?php  
	    
		$ts=mysql_query("
		SELECT p.accname parentname, p.id pid,c.accno chid,sum( c.amountdr ) tamountdr, sum( c.amountcr ) tamountcr, (
			( sum( c.amountdr ) - sum( c.amountcr ) )
			)balance
			FROM tbl_accchart p
			INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
			and (p.parentid='$smf[id]' or c.groupname='$smf[id]')
			and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'	
			GROUP BY p.accname
		") or die(mysql_error());
		while($tsf=mysql_fetch_array($ts)){
		  $smq=mysql_query("SELECT accname,(sum(amountdr)-sum(amountcr)) balance
		   from tbl_2ndjournal
		   where parentid='$tsf[pid]' and groupname='$tsf[pid]'
		   and vdate between '$_POST[fdate]' and '$_POST[tdate]'	

		   group by accname
		  ") or die(mysql_error());
		  while($smqf=mysql_fetch_array($smq)){
	?>
      <?php if($smqf['accname']!=""){ ?>
      <?php "<span style='padding-left:35px'>".$smqf['accname']."</span></br>"; ?> 
      <?php if($smqf['balance']>0){ number_format($smqf['balance'],2);}else{ 0; } ?>
      <?php if($smqf['balance']<0){ number_format((-($smqf['balance'])),2); }else{ 0; } ?>
	<?php }else{ ?>
      
      <?php echo "<span style='padding-left:35px'>".$tsf['parentname']."</span></br>"; ?>
      <?php if($tsf['balance']>0){ number_format($tsf['balance'],2);}else{  0; } ?>
      <?php if($tsf['balance']<0){ number_format((-($tsf['balance'])),2); }else{ 0; } ?>
	 <?php }} ?>
    <?php 
	
		 }
	  }	
     ?>
      <?php if($pL>0){ "Net Profit:"; }else if($pL<0){ "Net Loss:"; }else{ "Profit/Loss:"; } ?>
      <?php $final_val=$pL; ?>
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
Balance Sheet</h3>
<h5><?php echo $_POST['fdate']." To ".$_POST['tdate']; ?></h5>
</div>
<table width="900" border="0" align="center" cellpadding="3" cellspacing="0" class="style5" style="padding:3px; ">
  <!--DWLayoutTable-->
  <tr class="gridTblHead" style="padding:3px; ">
    <td width="354" height="23">Assets</td>
    <td width="58">&nbsp;</td>
    <td width="377">Liabilities</td>
    <td width="70">&nbsp;</td>
  </tr>
  <?php $sumobl=0;$val=0;
  		/*$bnk=$myDb->select("SELECT p.id, p.accname, (SUM( c.amountdr )-SUM( c.amountcr ))totalval 
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
									AND p.parentid>0
									and c.vdate<'$_POST[fdate]'
									and c.groupname in(1879,1884)
									group by p.accname");
		while($bnkf=$myDb->get_row($bnk,'MYSQL_ASSOC')){
		   $sumobl+=$bnkf['totalval'];
		}
		*/
  ?>						
  <tr>
    <td height="23" valign="top">
	
	
	</td>
    <td>&nbsp;</td>
    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="23" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <?php 
	  $rcvtotal=0;
	  $rtq=$myDb->select("SELECT *from tbl_accchart where accname in('Current Assets','Fixed Assets')  
	  							order by accname asc"); 
	  		while($rtqf=$myDb->get_row($rtq,'MYSQL_ASSOC')){
	  ?>
	  
	  <?php $prq_3=$myDb->select("SELECT c.accno id, c.accname, (SUM(c.amountdr)-SUM( c.amountcr ))totalval 
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
									AND p.parentid =0
									AND c.groupname='$rtqf[id]'
									and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'	
									group by c.accname
									UNION ALL 
									SELECT p.id, p.accname, (SUM(c.amountdr)-SUM( c.amountcr )) totalval 
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
									AND p.parentid >0
									and p.parentid='$rtqf[id]'
									and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'			
									GROUP BY p.accname
								 ");
	  $pycbal=0;
	  while($prqf_3=$myDb->get_row($prq_3,'MYSQL_ASSOC')){
		  $pycbal+=$prqf_3['totalval'];

	  
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
      <?php $prq=$myDb->select("SELECT c.accno id, c.accname, (SUM(c.amountdr)-SUM( c.amountcr ))totalval 
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
									AND p.parentid =0
									AND c.groupname='$rtqf[id]'
									and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'		
									group by c.accname
									UNION ALL 
									SELECT p.id, p.accname, (SUM(c.amountdr)-SUM( c.amountcr )) totalval 
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
									AND p.parentid >0
									and p.parentid='$rtqf[id]'
									and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'
									GROUP BY p.accname
								 ");
	  while($prqf=$myDb->get_row($prq,'MYSQL_ASSOC')){
	  ?>
      <?php //if(($prqf['id']!=1879)&&($prqf['id']!=1884)){ ?>
      <tr>
        <td width="238" height="19" valign="top"><em><?php echo "<div style='margin-left:20px;'>".$prqf['accname']."</div>"; ?></em> </td>
        <td width="75" valign="top"><em><?php if($prqf['totalval']<0){echo number_format(($prqf['totalval']),2);}else{  echo number_format(($prqf['totalval']),2); } ?></em></td>
        <td width="71" valign="top">&nbsp;</td>
      </tr>	   
	  <tr>
		    <td valign="top"></td>
		    <td valign="top" style="border-bottom:1px solid #999999; "></td>
		    <td valign="top"></td>
	    </tr>

      <?php //} ?>
      <?php } ?> 
	  <?php  }?>
    </table></td>
    <td valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td valign="top">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
      <?php 
	  $rcvtotal2=0;
	  $rtq=$myDb->select("SELECT *from tbl_accchart where accname in('Capital Account','Current Liabilities') 
	  							order by accname asc"); 
	  		while($rtqf=$myDb->get_row($rtq,'MYSQL_ASSOC')){
	  ?>
	  
	  <?php $prq_3=$myDb->select("SELECT c.accno id, c.accname, (SUM(c.amountdr)-SUM( c.amountcr ))totalval 
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
									AND p.parentid =0
									AND c.groupname='$rtqf[id]'
									and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'	
									group by c.accname
									UNION ALL 
									SELECT p.id, p.accname, (SUM(c.amountdr)-SUM( c.amountcr )) totalval 
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
									AND p.parentid >0
									and p.parentid='$rtqf[id]'
									and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'			
									GROUP BY p.accname
								 ");
	  $pycbal2=0;
	  while($prqf_3=$myDb->get_row($prq_3,'MYSQL_ASSOC')){
	    if(($prqf_3['totalval']<0)){
		  $pycbal2+=-($prqf_3['totalval']);
		}else{
		  $pycbal2+=$prqf_3['totalval'];

		}
	  
	  }
	  
	  $rcvtotal2+=$pycbal2;
	  ?>      
	  <?php if($pycbal2>0){ ?>
	  <tr>
        <td height="19" valign="top"><strong><?php echo $rtqf['accname']; ?></strong></td>
        <td height="19" valign="top">&nbsp;</td>
        <td height="19" align="right" valign="top"><strong><?php echo number_format($pycbal2,2); ?></strong></td>
      </tr>
	  <?php } ?>
      <?php $prq=$myDb->select("SELECT c.accno id, c.accname, (SUM(c.amountdr)-SUM( c.amountcr ))totalval 
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
									AND p.parentid =0
									AND c.groupname='$rtqf[id]'
									and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'		
									group by c.accname
									UNION ALL 
									SELECT p.id, p.accname, (SUM(c.amountdr)-SUM( c.amountcr )) totalval 
									FROM tbl_accchart p
									INNER JOIN tbl_2ndjournal c ON p.id = c.groupname
									AND p.parentid >0
									and p.parentid='$rtqf[id]'
									and c.vdate between '$_POST[fdate]' and '$_POST[tdate]'
									GROUP BY p.accname
								 ");
	  while($prqf=$myDb->get_row($prq,'MYSQL_ASSOC')){
	  ?>
      <?php //if(($prqf['id']!=1879)&&($prqf['id']!=1884)){ ?>
      <tr>
        <td width="238" height="19" valign="top"><em><?php echo "<div style='margin-left:20px;'>".$prqf['accname']."</div>"; ?></em> </td>
        <td width="75" valign="top"><em><?php if($prqf['totalval']<0){echo number_format(-($prqf['totalval']),2);}else{  echo number_format(($prqf['totalval']),2); } ?></em></td>
        <td width="71" valign="top">&nbsp;</td>
      </tr>	   

      <?php //} ?>
      <?php } ?> 
	  <?php  }?>
	  <tr>
		    <td valign="top" class="style11">Excess of Income over Expenditure</td>
		    <td valign="top" style="border-bottom:1px solid #999999; "></td>
		    <td valign="top"><strong><?php echo number_format($final_val,2); ?></strong></td>
	    </tr>
	  <tr>
		    <td valign="top"></td>
		    <td valign="top" style="border-bottom:1px solid #999999; "><?php echo number_format($final_val,2); ?></td>
		    <td valign="top">&nbsp;</td>
	    </tr>
    </table>	
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="23"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="23" style="border-top:1px solid #999999; ">Total</td>
    <td style="border-top:1px solid #999999; "><strong><em><?php echo number_format($rcvtotal,2); ?></em></strong></td>
    <td style="border-top:1px solid #999999; ">Total</td>
    <td style="border-top:1px solid #999999; "><em><strong><?php echo number_format($rcvtotal2+$final_val,2); ?></strong></em></td>
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
