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
  
    $fdate=!empty($_POST['fdate'])?$_POST['fdate']:$_GET['fdate'];
    $tdate=!empty($_POST['tdate'])?$_POST['tdate']:$_GET['tdate'];
	$accno=!empty($_POST['accno'])?$_POST['accno']:$_GET['accno'];
	//$acnm=!empty($_GET['stgroup'])?$_GET['stgroup']:$_POST['accno'];
	//$stgroup=!empty($_GET['stgroup'])?$_GET['stgroup']:$_POST['accno'];
	  
?>  
<style type="text/css">
  body{
	font-size:10px;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
 .pagebreak{
     page-break-before:always;
	 width:800px;
	 margin:0 auto;
	 font-size:13px;
 }	 
 h1,h2{
    font-size:18px;
 }			
.rmvh{
  background-color:#fbfbfb;
  font-size:large;
}

.addh{
  background-color:#e8ecee;
  font-size:large;
}
.style18 {
	font-size: 14px;
	font-weight: bold;
}
.style19 {font-size: 14px;}
.style20 {font-size: 14px; font-style:italic;}
</style>
<script language="javascript" src="../jquery.js"></script>
  <?php 
        /*if(empty($_POST['accno'])){
		    $getacc=mysql_real_escape_string($_GET['accno']);
			$ts=mysql_query("select * from tbl_accchart 
							 where id='$getacc'") or die(mysql_error());
			$tsf=mysql_fetch_array($ts);
		}else{
    
			$posi=strpos($_POST['accno'],'->');
			$getacc=substr($_POST['accno'],0,$posi);		
			$ts=mysql_query("select * from tbl_accchart 
							 where id='$getacc'") or die(mysql_error());
			$tsf=mysql_fetch_array($ts);
        }
		*/
		

  ?>
<?php	  

?>
<div class="pagebreak">
<div align="center">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="27" colspan="2"><div align="center">
      <?php include('../companyRpt.php');?>
    </div></td>
  </tr>
  <tr>
    <td height="27" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="27" colspan="2"><div align="center">
      <p style=" font-size:18px; font-weight:bold; font:'Lucida Bright'; text-decoration:underline; ">Group Ledger (Summery Report) </p>
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"><span style="text-decoration:underline; "><span style="font-weight:bold; ">Group Name:</span> <?php echo $accno;?></span></div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"><span style=" font-weight:bold; ">Date Between: </span><?php echo "'".date("d-M-Y",strtotime($fdate))."'"?> <span style=" font-weight:bold; ">And:</span> <?php echo "'".date("d-M-Y", strtotime($tdate))."'";?></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="99%"  border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#F3F3F3">
  <tr>
    <td width="36%" rowspan="2"><span class="style18">Particulars</span></td>
    <td width="15%" rowspan="2"><div align="right"><span class="style18">Opening Balance </span></div></td>
    <td colspan="2" class="style18"><div align="center">Transactions</div></td>
    <td width="16%" rowspan="2"><div align="right"><span class="style18"><strong>Closing Balance </strong></span></div></td>
  </tr>
    <tr>
    <td height="20"  class="style18"><div align="right"><strong>Debit</strong></div></td>
    <td  class="style18"><div align="right"><strong>Credit</strong></div></td>
  </tr>
  <?php 
  $bal=0;
  //echo "SELECT sj.accname from tbl_2ndjournal sj inner join tbl_accchart ac on sj.accname=ac.accname WHERE  sj.groupalias='$accno' and sj.groupname<>'4270'  group by sj.accname"; exit;
  //------original
  //$dq=$myDb->select("SELECT sj.accname from tbl_2ndjournal sj inner join tbl_accchart ac on sj.accname=ac.accname WHERE  ac.groupalias = '$accno' and sj.groupname<>'4270'  group by sj.accname");
  $dqx=$myDb->select("SELECT * from tbl_accchart ac WHERE  ac.accname = '$accno'");
  $dfx=$myDb->get_row($dqx,'MYSQL_ASSOC');
  
  $dq=$myDb->select("SELECT * from tbl_2ndjournal WHERE  parentid = '$dfx[id]' order by accname");
  
  //$dq=$myDb->select("SELECT accname from tbl_2ndjournal WHERE  accname like '$accno%' and groupname<>'4270'  group by accname");
  //$dq=$myDB->select("SELECT accname, (Select ifnull(Sum(`amountdr`)-sum(`amountcr`),0) as balance FROM `tbl_2ndjournal` WHERE vdate<'2015-01-20'  and accname like 'cmt1415%' and groupname<>'4270'  group by accname), ifnull(Sum(`amountdr`)-sum(`amountcr`),0) as balance FROM `tbl_2ndjournal` WHERE vdate between '2015-01-25' and '2015-01-30'  and accname like 'cmt1415%' and groupname<>'4270'  group by accname");
  while($df=$myDb->get_row($dq,'MYSQL_ASSOC'))
  {
  		//------original
		//$dataop=$myDb->select("Select ifnull(Sum(`amountdr`)-sum(`amountcr`),0) as openingbalance FROM `tbl_2ndjournal` WHERE vdate<'$fdate'  and accname = '$df[accname]' and groupname<>'4270' ");
		//$dataopf=$myDb->get_row($dataop,'MYSQL_ASSOC');
		
		//$datad=$myDb->select("SELECT ifnull(Sum(`amountdr`),0) as debit, ifnull(sum(`amountcr`),0) as credit FROM `tbl_2ndjournal` WHERE vdate between '$fdate' and '$tdate'  and accname = '$df[accname]' and groupname<>'4270'");
		//$dataf=$myDb->get_row($datad,'MYSQL_ASSOC');
		//--------------
		
		
		
		$dataop=$myDb->select("Select ifnull(Sum(`amountdr`)-sum(`amountcr`),0) as openingbalance FROM `tbl_2ndjournal` WHERE vdate<'$fdate'  and accname= '$df[accname]' ");
		$dataopf=$myDb->get_row($dataop,'MYSQL_ASSOC');
		
		$datad=$myDb->select("SELECT accname, voucherid, ifnull(`amountdr`,0) as debit, ifnull(`amountcr`,0) as credit FROM `tbl_2ndjournal` WHERE vdate between '$fdate' and '$tdate'  and accname= '$df[accname]' ");
		//echo "SELECT accname, ifnull(`amountdr`,0) as debit, ifnull(`amountcr`,0) as credit FROM `tbl_2ndjournal` WHERE vdate between '$fdate' and '$tdate'  and parentid = '$df[id]' "; exit;
		$dataf=$myDb->get_row($datad,'MYSQL_ASSOC');

  ?>
  <tr>
    <td height="20" class="style19"><?php echo $dataf['accname'];?></td>
    <td class="style19"><div align="right"><?php if($dataopf['openingbalance']<0){echo number_format(-$dataopf['openingbalance'],2)." Cr"; }else{echo number_format($dataopf['openingbalance'],2)." Dr";} ?>
    </div></td>
    <td  class="style20" width="16%"><div align="right"><?php echo number_format($dataf['debit'],2);?></div></td>
    <td  class="style20" width="17%"><div align="right"><?php echo number_format($dataf['credit'],2);?></div></td>
    <td class="style19"><div align="right"><?php $bal=($dataopf['openingbalance']+$dataf['debit'])-$dataf['credit']; if($bal<0){echo number_format(-($bal),2)." Cr";}else{echo number_format($bal,2)." Dr";}?></div></td>
  </tr>
  <?php }?>
  <tr>
    <td>&nbsp;</td>
    <td><div align="right"><span class="style18">Total :</span></div></td>
    <td><div align="right"><strong>
      <?php $dqb=$myDb->select("SELECT sum(amountdr) as totaldr from tbl_2ndjournal WHERE  parentid = '$dfx[id]'"); $dfb=$myDb->get_row($dqb,'MYSQL_ASSOC'); echo number_format($dfb['totaldr'],2);?>
    </strong></div></td>
    <td><div align="right"><strong>
      <?php $dqb=$myDb->select("SELECT sum(amountcr) as totalcr from tbl_2ndjournal WHERE  parentid = '$dfx[id]'"); $dfb=$myDb->get_row($dqb,'MYSQL_ASSOC'); echo number_format($dfb['totalcr'],2);?>
    </strong></div></td>
    <td>&nbsp;</td>
  </tr>
</table>
</br><div align="center" style="color:#CCCCCC; font-size:9px; ">Developed By <a href="https://riaz.fastitbd.com">(Web Developer) </a><a href="https://www.saicgroupbd.com">Saic Group</a></div>

<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}  
?>
