<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "SELECT voucherid
            FROM tbl_masterjournal
			where opby='$_SESSION[userid]'
			and voucherid LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$name = $rs['voucherid'];
	echo "$name\n";
}

}else{
  header("Location:login.php");
}
}  
?>

