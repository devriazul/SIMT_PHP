<?php ob_start();
@session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select pname from tbl_product where pname like '$q%' order by id desc";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$pname = $rs['pname'];
	  echo "Waring!This product name "."$pname"." exists"."</br>";
}

}else{
  header("Location:index.php");
}
}  
?>

