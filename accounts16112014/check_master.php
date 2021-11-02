<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='voucherEntry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
    $id=mysql_real_escape_string($_GET['id']);
	$sum=mysql_real_escape_string($_GET['sum']);
	$voucherid=mysql_real_escape_string($_GET['vid']);
	$vrec=$myDb->select("select masteraccno,vouchertype,sum(amountdr) vdr,sum(amountcr)vcr
						 from tbl_2ndjournal 
						 where voucherid='$voucherid'");
	$vrecf=$myDb->get_row($vrec,'MYSQL_ASSOC');
	
	
			

	
	   /*if($vrecf['vouchertype']=="R"){
			$mst=$myDb->select("select accno,accname,sum(amountdr)msttotaldr,sum(amountcr) msttotalcr
														
															from tbl_2ndjournal
												where accno=(select distinct masteraccno from tbl_2ndjournal where id='$id')");
						$mstf=$myDb->get_row($mst,'MYSQL_ASSOC');
						
						$mrec=$myDb->select("select sum(amountdr) msamdr from tbl_2ndjournal where id='$id'");
						$mrecf=$myDb->get_row($mrec,'MYSQL_ASSOC');
						$nvl=0;
						if($mrecf['msamdr']>$sum){
						  $nvl=$mrecf['msamdr']-$sum;
						  
							$jrec=$myDb->select("select sum(amountdr) jamdr from tbl_2ndjournal where accno='$mstf[accno]' and vouchertype='J'");
				
							$jrecf=$myDb->get_row($jrec,'MYSQL_ASSOC');
							
							$jrecr=$myDb->select("select sum(amountcr) jamcr from tbl_2ndjournal where accno='$mstf[accno]' and vouchertype='R'");
							$jrecrf=$myDb->get_row($jrecr,'MYSQL_ASSOC');
							if($jrecf['jamdr']<($jrecrf['jamcr']-$nvl)){
							   echo $mstf['accname']." have Insufficient balance";
							   exit;
							
							}
						  
						  
			
						}else if($mrecf['msamdr']<$sum){
						  $nvl=$sum-$mrecf['msamdr'];			  
						  
							$jrec=$myDb->select("select sum(amountdr) jamdr from tbl_2ndjournal where accno='$mstf[accno]' and vouchertype='J'");
				
							$jrecf=$myDb->get_row($jrec,'MYSQL_ASSOC');
							
							$jrecr=$myDb->select("select sum(amountcr) jamcr from tbl_2ndjournal where accno='$mstf[accno]' and vouchertype='R'");
							$jrecrf=$myDb->get_row($jrecr,'MYSQL_ASSOC');
							if($jrecf['jamdr']<($jrecrf['jamcr']+$nvl)){
							   $curval=$jrecf['jamdr']-$jrecrf['jamcr'];
							   echo $mstf['accname']." have Insufficient balance,current balance is ".$curval;
							   exit;
							
							}
						  
			
						}	   
		 
		 
		 
	   }else */
	   if($vrecf['vouchertype']=="P"){
			$mst=$myDb->select("select accno,accname,sum(amountdr)msttotaldr,sum(amountcr) msttotalcr
														
															from tbl_2ndjournal
												where accno=(select distinct masteraccno from tbl_2ndjournal where id='$id')");
						$mstf=$myDb->get_row($mst,'MYSQL_ASSOC');
						
						$mrec=$myDb->select("select sum(amountdr) msamdr from tbl_2ndjournal where id='$id'");
						$mrecf=$myDb->get_row($mrec,'MYSQL_ASSOC');
						$nvl=0;
						if($mrecf['msamdr']>$sum){
						  $nvl=$mrecf['msamdr']-$sum;
						  
							$jrec=$myDb->select("select sum(amountdr) jamdr from tbl_2ndjournal where accno='$mstf[accno]' and vouchertype='R'");
							$jrecf=$myDb->get_row($jrec,'MYSQL_ASSOC');
							
							$jrecr=$myDb->select("select sum(amountcr) jamcr from tbl_2ndjournal where accno='$mstf[accno]' and vouchertype='P'");
							$jrecrf=$myDb->get_row($jrecr,'MYSQL_ASSOC');
							if($jrecf['jamdr']<($jrecrf['jamcr']-$nvl)){
							   echo $mstf['accname']." have Insufficient balance";
							   exit;
							
							}
						  
						  
			
						}else if($mrecf['msamdr']<$sum){
						  $nvl=$sum-$mrecf['msamdr'];			  
						  
							$jrec=$myDb->select("select sum(amountdr) jamdr from tbl_2ndjournal where accno='$mstf[accno]' and vouchertype='R'");
							$jrecf=$myDb->get_row($jrec,'MYSQL_ASSOC');
							
							$jrecr=$myDb->select("select sum(amountcr) jamcr from tbl_2ndjournal where accno='$mstf[accno]' and vouchertype='P'");
							$jrecrf=$myDb->get_row($jrecr,'MYSQL_ASSOC');
							if($jrecf['jamdr']<($jrecrf['jamcr']+$nvl)){
							   $curval=$jrecf['jamdr']-$jrecrf['jamcr'];
							   echo $mstf['accname']." have Insufficient balance,current balance is ".$curval;
							   exit;
							
							}
						  
			
						}	   
	   
	   }	 
						 
	
						//echo $mstf['msttotalcr']+$sum;
  											   
?>  

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