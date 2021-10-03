<?php 
ob_start(); 
session_start(); 
if(!$_SESSION[emagasesid]){
  include("logout.php");
}else{
  include("config.php");
  
  // echo $_POST[cid];
  

  mysql_query("INSERT INTO `tbl_menuscat` ( `id` , `cid` , `name` , `status` , `opdate`, `url`,`morder`,`user`) 
  VALUES 
  ('' , '$_POST[cid]', '$_POST[name]', '$_POST[status]', '$_POST[vdate]', '$_POST[url]', '$_POST[mord]','$_POST[user]')") 
  or die(mysql_error());
  
  
  header("Location:add_subcat.php?msg=Your record inserted");


}
?>    
  