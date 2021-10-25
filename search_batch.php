<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "SELECT distinct d.name AS name
            FROM tbl_batch b
            LEFT JOIN tbl_department d ON b.depcode = d.id where d.name LIKE '$q%'
			AND b.storedstatus<>'D'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$name = $rs['name'];
	echo "$name\n";
}

}else{
  header("Location:login.html");
}
}  
?>

