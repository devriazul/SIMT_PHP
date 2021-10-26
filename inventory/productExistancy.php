<?php ob_start();
@session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = !empty($_POST["pname"])?$_POST["pname"]:$_GET['pname'];
$prtype=!empty($_POST['prtype'])?$_POST['prtype']:$_GET['prtype'];
if (!$q) return;

$sql = "select pname from tbl_product where pname like '$q%' and prtype='$prtype' order by id desc";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$pname = $rs['pname'];
	  echo "Waring! product "."$pname"." exists"."</br>";
}

}else{
  header("Location:index.php");
}
}  
?>

