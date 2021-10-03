<?php 
ob_start();
session_start();
if(!$_SESSION[emagasesid]){
   include("login.php");
}else{
   include("config.php");


mysql_query("delete from tbl_menucat where id='$_GET[id]' ") or die(mysql_error());
	echo "<script> window.location='view_cat.php?msg=Successfully Delete Entry'; </script>\n";
}
?>  
