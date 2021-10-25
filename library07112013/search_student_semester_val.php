<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){

$sql = "select semester from tbl_stdinfo where stdid='$_GET[stdid]' and storedstatus<>'D'";
$rsd = mysql_query($sql);
$rs=mysql_fetch_array($rsd);


$semsql = "select id from tbl_semester where id='$rs[semester]' and storedstatus<>'D'";
$semrsd = mysql_query($semsql);
$semrs=mysql_fetch_array($semrsd);

echo $semrs['id'];


}else{
  header("Location:index.php");
}
}  
?>

