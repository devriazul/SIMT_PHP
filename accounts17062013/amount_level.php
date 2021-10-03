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
if(($rmval['amountdr']==$rmval['amountcr'])&&($rmval['amountdr']!=0&&$rmval['amountcr']!=0)){
   $level="<div style='color:#00CC33;font-weight:bold;'>Debit and Credit level you can save</div>";
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