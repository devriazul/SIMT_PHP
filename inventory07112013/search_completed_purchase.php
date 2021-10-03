<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

/*$sql = "SELECT distinct p.pname 'Product Name'
	       FROM tbl_buyproduct c
		   INNER JOIN tbl_product p
		   ON p.id=c.pid
		   INNER JOIN tbl_supplier s
		   ON c.supid=s.id 
		   where p.pname LIKE '%$q%' order by c.id desc";
*/
$sql="SELECT DISTINCT reqid FROM tbl_buyproduct
      WHERE reqid LIKE '$q%' and pstatus='P'
	  ";		   
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$reqid = $rs['reqid'];
	echo "$reqid\n";
}

}else{
  header("Location:index.php");
}
}  
?>

