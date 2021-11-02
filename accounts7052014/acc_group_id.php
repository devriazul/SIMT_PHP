<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["accname"];
$pid=$_GET['pid'];
if (!$q) return;

$sql = "SELECT id FROM  `tbl_accchart` 
		WHERE parentid !=0
		AND groupname =0
		and accname='$q'
		and parentid='$pid'

		union

		SELECT id FROM  `tbl_accchart` 
		WHERE id
				IN (
				
					SELECT parentid
					FROM tbl_accchart
				)
		AND id
			  IN (

					SELECT groupname
					FROM tbl_accchart
			  )
		AND parentid =0
		AND groupname =0 
		and id='$pid'
		and accname='$q'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$name = $rs['id'];
	echo intval($name);
}

}else{
  header("Location:login.php");
}
}  
?>

