<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){

$sql = "select session from tbl_stdinfo where stdid='$_GET[stdid]' and storedstatus<>'D'";
$rsd = mysql_query($sql);
$rs=mysql_fetch_array($rsd);


echo $rs['session'];

}else{
  header("Location:index.php");
}
}  
?>

