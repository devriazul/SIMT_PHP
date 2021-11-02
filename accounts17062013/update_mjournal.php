<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_jurnal.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){

  //$cnt=$_POST['id'];
  //for($i=0;$i<$cnt;$i++){
	  if(mysql_query("update tbl_masterjournal set voucherdate='".@mysql_real_escape_string($_POST['voucherdate'])."'
										   ,voucherexpl='".@mysql_real_escape_string($_POST['voucherexpl'])."' 
										   where id='".@$_POST['id']."'")){ 
				mysql_query("update tbl_2ndjournal set vdate='".@mysql_real_escape_string($_POST['voucherdate'])."' where voucherid='".@mysql_real_escape_string($_POST['voucherid'])."'") or die(mysql_error());					   
										   
										   echo "Record updated....";
										   
	  }else{
										   
											  echo mysql_error();
	  }
  
?>  
           
  
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>		  