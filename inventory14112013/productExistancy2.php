<?php ob_start();
@session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select pname from tbl_product where pname='$q' order by id desc";
$rsd = mysql_query($sql);
$tr=mysql_num_rows($rsd);
if($tr>0){
	while($rs = mysql_fetch_array($rsd)) {
		$pname = $rs['pname'];
		if(!empty($pname)){
		  echo "Waring!This product name "."$pname"." exists"."</br>";
		  exit;
		}  
	}
}

}else{
  header("Location:index.php");
}
}  
?>

