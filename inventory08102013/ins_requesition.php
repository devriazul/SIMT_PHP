<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $pid=mysql_real_escape_string($_POST['pid']);
  $rqty=mysql_real_escape_string($_POST['rqty']);
  $empid=mysql_real_escape_string($_POST['empid']);
  $expdate=mysql_real_escape_string($_POST['expdate']);
  $pstatus='R';
  $reqdate=date("Y-m-d");
  
  if($myDb->insert_sql("INSERT INTO tbl_buyproduct(empid,pid,rqty,opby,reqdate,expdate,pstatus)VALUES('$empid','$pid','$rqty','$_SESSION[userid]','$reqdate','$expdate','$pstatus')")){
     echo "Requesition Insert successfully";
  }else{
     echo $myDb->last_error;
  }	 	 

?>


<?php 
}else{
  header("Location:login.php");
}
}  
?>
