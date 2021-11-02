<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

/*$sql = "SELECT id,accname
            FROM tbl_accchart
			where accname LIKE '%$q%'
			and id not in(select parentid from tbl_accchart)";
			
$sql = "SELECT id,accname FROM tbl_accchart
   WHERE MATCH (accname)
   AGAINST ('$q' WITH QUERY EXPANSION)
   and id not in(select parentid from tbl_accchart) and groupname!=0";			
			
			*/
$sql = "SELECT id,accname FROM tbl_accchart
   WHERE MATCH (accname)
   AGAINST ('$q' WITH QUERY EXPANSION)";			
$rsd = mysql_query($sql);
?>
<?php 
while($rs = mysql_fetch_array($rsd)) {
?>

<?php 	
	$name = $rs['id']."->".$rs['accname'];
	echo "$name\n";
}
?>
<?php 
}else{
  header("Location:login.php");
}
}  
?>

