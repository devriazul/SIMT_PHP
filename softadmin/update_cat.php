<?php session_start();
if(!$_SESSION['emagasesid']){
  include("logout.php");
}else{
include("config.php");

echo $_POST['id'];


				mysql_query("UPDATE `tbl_menucat` SET `name` = '$_POST[name]',
									`section` = '$_POST[section]',
									`status` = '$_POST[status]'
									
									 WHERE id='$_POST[id]'")
				or die(mysql_error());


				echo "<script> window.location='view_cat.php?msg=Successfully Data Updated'; </script>\n";
	
}
?>