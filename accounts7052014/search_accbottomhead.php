<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select accname from tbl_accchart where id not in(select parentid from tbl_accchart) and groupname!=0 and accname like '$q%'";
$rsd = mysql_query($sql);
?>
<?php 
while($rs = mysql_fetch_array($rsd)) {
?>

<?php 	
	$name = $rs['accname'];
	echo "$name\n";
}
?>
<?php 
}else{
  header("Location:login.php");
}
}  
?>

