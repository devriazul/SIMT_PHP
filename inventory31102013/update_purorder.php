<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='requisition_list.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  $chkp=$myDb->select("SELECT*FROM tbl_buyproduct WHERE porderid=(SELECT porderid FROM tbl_purorder WHERE usestatus='INU' AND opby='$_SESSION[userid]') 
                       AND  opby='$_SESSION[userid]'");
  $chkpf=$myDb->get_row($chkp,'MYSQL_ASSOC');
  
  if($chkpf['porderid']==""){
          echo "<p style='color:#FF0000'>There is no product in purchase table</p>";
  
  }else{
  
		  if($myDb->update_sql("UPDATE tbl_purorder SET usestatus='FINP' WHERE opby='$_SESSION[userid]' AND usestatus='INU'")){
			 echo "Purchase order complete";
		  }else{
			 echo $myDb->last_error;
		  }	 	 
  }
  
  
}else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>  
