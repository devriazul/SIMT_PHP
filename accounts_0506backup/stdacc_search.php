<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select ucase(concat(stdid,' ',stdname))  as accname from tbl_stdinfo where stdid LIKE '%$q%' and storedstatus<>'D'

        UNION
		select ucase(concat(exstid,' ',stdname))  as accname from tbl_stdinfo where exstid LIKE '%$q%' and storedstatus<>'D'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['accname'];
	echo "$cname\n";
}

}else{
  header("Location:login.php");
}
}  
?>

