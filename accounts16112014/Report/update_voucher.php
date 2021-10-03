<?php ob_start();
session_start();
require_once('../dbClass.php');
include("../config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='voucherEntry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  $_SESSION['vdate']=$_GET['voucherdate']?$_GET['voucherdate']:date("Y-m-d");
  
  $evid=mysql_real_escape_string($_POST['evid']);
  $vexpl=mysql_real_escape_string($_POST['vexpl']); 
  
  $mvch=$myDb->select("select*from tbl_masterjournal where voucherid='$evid'");
  $mvchf=$myDb->get_row($mvch,'MYSQL_ASSOC');
  if(empty($_GET['voucherdate'])){
	  if(!$myDb->update_sql("UPDATE tbl_masterjournal SET voucherexpl='$vexpl' WHERE voucherid='$evid'")){
		echo $myDb->last_error;
	  
	  }else{
	  
		$chead=$myDb->select("SELECT * 
							  FROM  `tbl_2ndjournal` 
							  WHERE voucherid='$evid' 
							  order by amountdr desc");
			$icount=0;						
			while($cheadf=$myDb->get_row($chead,'MYSQL_ASSOC')){  
			  if($cheadf['masteraccno']==0){
				 if($cheadf['amountdr']>0){
					 $dr=mysql_real_escape_string($_POST["dr$cheadf[accno]"]);
					 $myDb->update_sql("UPDATE tbl_2ndjournal SET amountdr='$dr' WHERE voucherid='$evid' and id='$cheadf[id]'");
				 }else{
					 $cr=mysql_real_escape_string($_POST["cr$cheadf[accno]"]);
					 $myDb->update_sql("UPDATE tbl_2ndjournal SET amountcr='$cr' WHERE voucherid='$evid' and id='$cheadf[id]'");
				 }
			  
			  
			  }else{
				 if($cheadf['amountdr']>0){
					 $dr=mysql_real_escape_string($_POST["dr$cheadf[accno]"]);
					 $myDb->update_sql("UPDATE tbl_2ndjournal SET amountdr='$dr' WHERE voucherid='$evid' and id='$cheadf[id]'");
				 }else{
					 $cr=mysql_real_escape_string($_POST["cr$cheadf[accno]"]);
					 $myDb->update_sql("UPDATE tbl_2ndjournal SET amountcr='$cr' WHERE voucherid='$evid' and id='$cheadf[id]'");
				 }
			  }
	
			
			
			}		  echo "Update successfully";
	
	  }	 	
  }else{
  
	  if(!$myDb->update_sql("UPDATE tbl_masterjournal SET voucherexpl='$vexpl',voucherdate='$_GET[voucherdate]' WHERE voucherid='$evid'")){
		echo $myDb->last_error;
	  
	  }else{
	  
		$chead=$myDb->select("SELECT * 
							  FROM  `tbl_2ndjournal` 
							  WHERE voucherid='$evid' 
							  order by amountdr desc");
			$icount=0;						
			while($cheadf=$myDb->get_row($chead,'MYSQL_ASSOC')){  
			  if($cheadf['masteraccno']==0){
				 if($cheadf['amountdr']>0){
					 $dr=mysql_real_escape_string($_POST["dr$cheadf[accno]"]);
					 $myDb->update_sql("UPDATE tbl_2ndjournal SET amountdr='$dr',vdate='$_GET[voucherdate]' WHERE voucherid='$evid' and id='$cheadf[id]'");
				 }else{
					 $cr=mysql_real_escape_string($_POST["cr$cheadf[accno]"]);
					 $myDb->update_sql("UPDATE tbl_2ndjournal SET amountcr='$cr',vdate='$_GET[voucherdate]' WHERE voucherid='$evid' and id='$cheadf[id]'");
				 }
			  
			  
			  }else{
				 if($cheadf['amountdr']>0){
					 $dr=mysql_real_escape_string($_POST["dr$cheadf[accno]"]);
					 $myDb->update_sql("UPDATE tbl_2ndjournal SET amountdr='$dr',vdate='$_GET[voucherdate]' WHERE voucherid='$evid' and id='$cheadf[id]'");
				 }else{
					 $cr=mysql_real_escape_string($_POST["cr$cheadf[accno]"]);
					 $myDb->update_sql("UPDATE tbl_2ndjournal SET amountcr='$cr',vdate='$_GET[voucherdate]' WHERE voucherid='$evid' and id='$cheadf[id]'");
				 }
			  }
	
			
			
			}		  echo "Update successfully";
	
	  }	 	
  
  } 
		  
	 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>