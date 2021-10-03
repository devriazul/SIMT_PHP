<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select sid from tbl_staffinfo where storedstatus IN('I','U') AND sid LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
    
    	$cname = $rs['sid'];
	    echo "$cname\n";
	
}

}else{
  header("Location:login.php");
}
}  
?>

