<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select latergrade from tbl_gradesystem where storedstatus<>'D' AND latergrade LIKE '%$q%' order by id";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$code = $rs['latergrade'];
	echo "$code\n";
}

}else{
  header("Location:index.php");
}
}  
?>

