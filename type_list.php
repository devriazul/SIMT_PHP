<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='stdinfo.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  

header("Content-type: text/xml");

$manid = $_POST['man'];

echo "<?xml version=\"1.0\" ?>\n";
echo "<printertypes>\n";
$select = "SELECT batchname,depcode FROM tbl_batch WHERE depcode='$manid' order by id desc";
	foreach($dbh->query($select) as $row) {
		echo "<Printertype>\n\t<id>".$row['type_id']."</id>\n\t<name>".$row['type_text']."</name>\n</Printertype>\n";
	}
echo "</printertypes>";



   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>
