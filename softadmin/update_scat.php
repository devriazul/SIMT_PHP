<?php session_start();
if(!$_SESSION['emagasesid']){
  include("logout.php");
}else{
include("config.php");

echo $_POST['id'];


				mysql_query("UPDATE `tbl_menuscat` SET `cid` = '$_POST[cid]',
									`name` = '$_POST[name]',
									`status` = '$_POST[status]',
									`morder` = '$_POST[mord]',
									`url`='$_POST[url]' WHERE id='$_POST[id]'")
				or die(mysql_error());


				echo "<script> window.location='view_subcat.php?msg=Successfully Data Updated'; </script>\n";
	
}
?> 

  