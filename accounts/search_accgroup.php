<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "SELECT distinct p.id,p.accname  FROM tbl_accchart p inner join tbl_accchart g on p.id=g.parentid where p.accname LIKE '%$q%'";
//$sql = "SELECT distinct groupalias  FROM tbl_accchart";
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

