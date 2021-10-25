<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select facultyid from tbl_faculty where storedstatus IN('I','U') AND facultyid LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
    
    	$cname = $rs['facultyid'];
	    echo "$cname\n";
	
}

}else{
  header("Location:login.php");
}
}  
?>

