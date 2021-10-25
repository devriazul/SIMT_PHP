<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

$sql = "SELECT facultyid jobid
		FROM tbl_faculty
		WHERE facultyid LIKE '$q%'
		AND facultyid in(SELECT empid FROM tbl_employeesalary where storedstatus<>'D')
		UNION 
		SELECT sid jobid
		FROM tbl_staffinfo
		WHERE sid LIKE '$q%'
		AND sid in(SELECT empid FROM tbl_employeesalary where storedstatus<>'D')
	   ";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$sid = $rs['jobid'];
	echo "$sid\n";
}

}else{
  header("Location:index.php");
}
}  
?>

