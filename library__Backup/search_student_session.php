<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){

$sql = "select session from tbl_stdinfo where stdid='$_GET[stdid]' and storedstatus<>'D'";
$rsd = mysql_query($sql);
$rs=mysql_fetch_array($rsd);

if(!empty($rs['session'])){
$f=substr($rs['session'],0,2);
$s=substr($rs['session'],-2,4);
echo "20".$f."-"."20".$s;
}

}else{
  header("Location:index.php");
}
}  
?>

