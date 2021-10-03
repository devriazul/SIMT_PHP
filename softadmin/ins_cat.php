<?php 
ob_start(); 
session_start(); 
if(!$_SESSION[emagasesid]){
  include("logout.php");
}else{
  include("config.php");

  mysql_query("INSERT INTO `tbl_menucat` ( `name` , `section` , `status` , `toppos`,  `opdate`) 

  									VALUES ( '$_POST[name]', '$_POST[section]', '$_POST[status]', 'y', '$_POST[vdate]')") 

									or die(mysql_error());
  header("Location:add_cat.php?msg=Menu Added Successfully...");
}

?>    

  