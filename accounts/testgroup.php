<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='voucherEntry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  
     $gsql=$myDb->select("Select * from tbl_stdinfo order by stdid asc");
	 while($gsqlf=$myDb->get_row($gsql,'MYSQL_ASSOC')){
	 
	 $gsqlf['stdid'];
	 $h=strpos($gsqlf['stdid'],$gsqlf['session']);
	 $h2=strlen($gsqlf['session']);
	 $h3=$h+$h2;
	 $groupalias=substr($gsqlf['stdid'],0,$h3);
	 $myDb->update_sql("UPDATE tbl_accchart set groupalias='$groupalias' where accname like '$gsqlf[stdid]%' and session='$gsqlf[session]' and session<>''");
	 
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