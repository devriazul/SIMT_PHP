<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
$q = $_GET["q"];
if (!$q) return;

/*$sql = "SELECT id,accname
            FROM tbl_accchart
			where accname LIKE '%$q%'
			and id not in(select parentid from tbl_accchart)";
			*/
			
$sql = "SELECT distinct p.id,p.accname 
								   from tbl_accchart p
								   inner join tbl_accchart c
								   on (p.id=c.parentid
								   or p.id=c.groupname)
				where (p.storedstatus<>'D' or p.id not in(select accno from tbl_2ndjournal)) and p.accname like '$q%'
				UNION ALL
				SELECT distinct id,accname 
								   from tbl_accchart
				where (storedstatus<>'D' or id not in(select accno from tbl_2ndjournal)) and id not in(select parentid from tbl_accchart) and id not in(select groupname from tbl_accchart) and accname like '$q%' order by id asc				
				";			
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

