<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "SELECT id,accname
            FROM tbl_accchart
			where accname LIKE '%$q%'
			and id not in(select parentid from tbl_accchart)";
$rsd = mysql_query($sql);
?>
<?php 
while($rs = mysql_fetch_array($rsd)) {
?>

<?php 	
	$name = $rs['id']."->".$rs['accname'];
	echo "$name\n";
}
?>
<?php 
}else{
  header("Location:login.php");
}
}  
?>

