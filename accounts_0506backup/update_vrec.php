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

  $rcount=count($_POST['id']);
  for($i=0; $i<$rcount; $i++){
  if($myDb->update_sql("update tbl_2ndjournal set amountdr='".$_POST['amountdr'][$i]."',
                                               amountcr='".$_POST['amountcr'][$i]."'
											   where id='".$_POST['id'][$i]."'
											   and voucherid='$_POST[vid]'")){ 
											   
											   //echo "Successfully Updated";
											   }else{
											     echo $myDb->last_error;
												 }

  }
  $msg="Record updated successfully";
  header("Location:manage_voucher.php?msg=$msg");  
  											   
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