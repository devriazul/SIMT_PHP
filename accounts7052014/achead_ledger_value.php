<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  $accname=!empty($_POST['accname_m'])?mysql_real_escape_string($_POST['accname_m']):'';
  $accname=urlencode($accname);
  $accname=str_replace("+"," ",$accname);
  //echo $accname;
 /*echo "SELECT (sum(amountdr)-sum(amountcr)) 'Remaining Value'
  						FROM tbl_2ndjournal
						WHERE accname='$accname'";
  exit;
   */						
  $jrq=$myDb->select("SELECT (sum(amountdr)-sum(amountcr)) 'Remaining Value',
  											(SELECT (sum(amountcr))
												FROM tbl_tmpjurnal
												WHERE accname='$accname'
												and opby = '$_SESSION[userid]'
												and vdate='$_SESSION[vdate]' 
												) 'Tmp Value'
  						FROM tbl_2ndjournal
						WHERE accname='$accname'");
  $jrqf=$myDb->get_row($jrq,'MYSQL_ASSOC');
  if(!empty($jrqf['Remaining Value'])){
     echo $jrqf['Remaining Value']-$jrqf['Tmp Value'];
    //echo "<div style='font-style:italic;font-size:11px;margin:5px;'>Remaining Value: ".$jrqf['Remaining Value']."</div>";						 
  }else{
     echo $jrqf['Remaining Value']-$jrqf['Tmp Value'];
    //echo "<div style='font-style:italic;font-size:11px;margin:5px;'>Remaining Value: ".$jrqf['Remaining Value']."</div>";						 
  }


}else{     

	$msg="Sorry,you are not authorized to access this page";
    header("Location:login.php?msg=$msg");
}
?>