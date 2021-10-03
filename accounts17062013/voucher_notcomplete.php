<?php session_start();
include("conn.php");
//--------------------------------Total Sum of debit and credit--------------------------------------------------------------// 

@$_SESSION['vdate']=$_SESSION['vdate']?$_SESSION['vdate']:$_GET['vdate'];

$res = mysql_query("SELECT sum(amountdr)amountdr,
						 (SELECT sum( amountcr ) amountcr 
						  FROM tbl_tmpjurnal 
						  WHERE opby = '$_SESSION[userid]'
						  and vdate='$_SESSION[vdate]' 
						 
						 )amountcr

					from  tbl_tmpjurnal
					where opby='$_SESSION[userid]'
					and vdate='$_SESSION[vdate]'
	") or die(mysql_error());

$rmval=mysql_fetch_array($res);
if($rmval['amountdr']==$rmval['amountcr']){
 // $level="Debit and Credit level you can save";
 // echo $level;
}else{
  $level="<div style='color:#CC6600;font-weight:bold;'>Debit and Credit not level <br/>you have to complete the voucher first or delete the voucher from queue</div>";
  echo $level;

}  

 /*if($rmval['amountcr']>$rmval['amountdr'])
      $valrm=(($rmval['amountcr'])-($rmval['amountdr']));
      echo $valrm;
   }else{
      $valrm=(($rmval['amountcr'])-($rmval['amountdr']));
      echo $valrm;
   }*/
?>