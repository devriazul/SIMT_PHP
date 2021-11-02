<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select stdid,exstid,stdname as stdname from tbl_stdinfo where storedstatus IN('I','U') AND stdid LIKE '%$q%' OR exstid LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
    if(!$rs['exstid']){
    	$cname = $rs['stdid'];
	    echo "$cname\n";
	}else{
	    $cname=$rs['exstid'];
	    echo "$cname\n";
    }		
}

}else{
  header("Location:login.php");
}
}  
?>

