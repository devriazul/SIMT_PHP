<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_accheadnew.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
     $voucherid = !empty($_GET['voucherid']) ? mysql_real_escape_string($_GET['voucherid']) : '';
	 if( !empty($voucherid) ) {
	 	$myDb->update_sql("delete from tbl_masterjournal where voucherid='$voucherid'");
		$myDb->update_sql("delete from tbl_2ndjournal where voucherid='$voucherid'");

	 }
	 ?>
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}