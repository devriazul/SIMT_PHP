<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
	if($_SESSION['userid'])
	{
		$q = $_GET["q"];
		if (!$q) return;

		$sql = "select rollno from tbl_stdtestimonial where storedstatus <>'D' AND rollno LIKE '%$q%' ";
		$rsd = mysql_query($sql);
		while($rs = mysql_fetch_array($rsd)) 
		{
    		$cname = $rs['rollno'];
	   		echo "$cname\n";
		}

	}
	else
	{
  		header("Location:index.php");
	}
}  
?>

