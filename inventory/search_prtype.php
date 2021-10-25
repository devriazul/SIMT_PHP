<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "SELECT distinct s.storename prtype
	 		FROM tbl_product p
			inner join tbl_store s
			on s.storeid=p.prtype
			WHERE s.storename LIKE '$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$prtype = $rs['prtype'];
	echo "$prtype\n";
}

}else{
  header("Location:index.php");
}
}