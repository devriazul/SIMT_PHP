<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;
 
$sql = "select accname from tbl_accchart where accname LIKE '$q%' and groupname='6' and session<>'' and storedstatus<>'D' and stdob<>'1'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$accname = $rs['accname'];
	echo "$accname\n";
}

}else{
  header("Location:index.php");
}
}  
?>

