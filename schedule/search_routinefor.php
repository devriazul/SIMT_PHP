<?php ob_start();
session_start();

include('../config.php');  
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "SELECT id,alias
            FROM tbl_routine_for
			where alias LIKE '$q%'
			";
$rsd = mysql_query($sql);
?>
<?php 
while($rs = mysql_fetch_array($rsd)) {
?>

<?php 	
	$name = $rs['id']."->".$rs['alias'];
	echo "$name\n";
}
?>
<?php 
}else{
  header("Location:login.php");
}
}  
?>

