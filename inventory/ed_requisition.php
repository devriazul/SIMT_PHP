<?php ob_start();
session_start();
require_once('dbClass.php');
require_once('class/productfilter.class.php');
include("config.php"); 
$pft=new productfilter();
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $pid=mysql_real_escape_string($_POST['pid']);
  $rqty=mysql_real_escape_string($_POST['rqty']);
  $id=mysql_real_escape_string($_POST['id']);
  $empid=mysql_real_escape_string($_POST['empid']);
  $expdate=mysql_real_escape_string($_POST['expdate']);
    $pft->prdresult($id);

  $status='';
  if(($rqty>=$pft->rs["aqty"])&&($rqty>=$pft->rs["pqty"])){
	  if($myDb->update_sql("UPDATE tbl_buyproduct SET pid='$pid',
													  rqty='$rqty',
													  empid='$empid',
													  reqdate='$expdate'
								   WHERE id='$id'")){
		 echo "Requisition Update successfully";
	  

	  }else{
		 echo $myDb->last_error;
	  }	 	 
  }else{
    if($pft->rs["pstatus"]=='A'){
	  $status="Approved";
	}else if($pft->rs["pstatus"]=='P'){
	  $status="Purchased";
	}    
    echo "Requisition qty can not grater than approve qty"." "."Reqid: ".$pft->rs["reqid"]." is ".$status;
	exit;
  }	

?>


<?php 
}else{
  header("Location:index.php");
}
}