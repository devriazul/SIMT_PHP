<?php ob_start();
session_start();

include('../config.php');  
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select facultyid,name from tbl_faculty where name LIKE '$q%' and storedstatus<>'D'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$filename = $rs['facultyid']."->".$rs['name'];
	echo "$filename\n";
}

}else{
  header("Location:login.php");
}
}  
?>

