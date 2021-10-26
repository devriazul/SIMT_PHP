<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $pid=mysql_real_escape_string($_POST['pid']);
  $rqty=mysql_real_escape_string($_POST['rqty']);
  $empid=mysql_real_escape_string($_POST['empid']);
  $expdate=mysql_real_escape_string($_POST['expdate']);
  $reqid=mysql_real_escape_string($_POST['reqid']);
  $prtype=mysql_real_escape_string($_POST['prtype']);
  $estprice=mysql_real_escape_string($_POST['estprice']);
  $pstatus='R';
  $reqdate=date("Y-m-d");
  
  if($myDb->insert_sql("INSERT INTO tbl_buyproduct(storeid,empid,pid,rqty,opby,reqdate,expdate,pstatus,reqid,estprice)VALUES('$prtype','$empid','$pid','$rqty','$_SESSION[userid]','$reqdate','$expdate','$pstatus','$reqid','$estprice')")){
     echo "Requesition Insert successfully";
  }else{
     echo $myDb->last_error;
  }	 	 

?>


<?php 
}else{
  header("Location:index.php");
}
}