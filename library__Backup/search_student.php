<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "select stdid
		from tbl_stdinfo 
		where deptname='$_GET[deptid]' 
		and storedstatus<>'D' AND 
		stdid LIKE '$q%' 
		UNION ALL
		select facultyid stdid
		from tbl_faculty 
		where deptid='$_GET[deptid]' 
		and storedstatus<>'D' AND 
		facultyid LIKE '$q%' 
		";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$stdid = $rs['stdid'];
	echo "$stdid\n";
}

}else{
  header("Location:index.php");
}
}  
?>

