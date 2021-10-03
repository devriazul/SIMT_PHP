<?php ob_start();
session_start();
$user=addslashes($_POST['userid']);
echo "The userid is:".$user;
$pass=addslashes($_POST['pass']);
include("config.php");
$quser=mysql_query("select*from tbl_softadmin where userid='$user' and password='$pass'") or die(mysql_error());
$ufetch=mysql_fetch_array($quser);

   if(($user==$ufetch['userid'])&&($pass==$ufetch['password'])){
       $_SESSION['emagasesid']=$ufetch['userid'];
       header("Location:home.php");
   }else{
       header("Location:index.php?msg=Invalid USERID or PASSWORD");
   }	   
   	   


?>      

