<?php session_start();
mysql_connect("localhost","root","");
mysql_select_db("simtdb");
//--------------------------------Total Sum of debit and credit--------------------------------------------------------------// 


$res = mysql_query("SELECT sum(amountdr)amountdr,
						 (SELECT sum( amountcr ) amountcr 
						  FROM tbl_tmpjurnal 
						  WHERE opby = '$_SESSION[userid]'
						  and vdate='$_SESSION[sdate]' 
						 
						 )amountcr

					from  tbl_tmpjurnal
					where opby='$_SESSION[userid]'
					and vdate='$_SESSION[sdate]'
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