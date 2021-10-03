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
if($rmval['amountdr']>$rmval['amountcr']){
   $valrm=(($rmval['amountdr'])-($rmval['amountcr']));
  
   echo $valrm;
}else{

      $valrm=(($rmval['amountcr'])-($rmval['amountdr']));
      echo $valrm;


}
if($rmval['amountdr']==$rmval['amountcr']){
 // $level="Debit and Credit level you can save";
 // echo $level;
}  

 /*if($rmval['amountcr']>$rmval['amountdr'])
      $valrm=(($rmval['amountcr'])-($rmval['amountdr']));
      echo $valrm;
   }else{
      $valrm=(($rmval['amountcr'])-($rmval['amountdr']));
      echo $valrm;
   }*/
?>