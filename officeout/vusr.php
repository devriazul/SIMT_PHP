<?php ob_start();
session_start();
require_once('dbClass.php');
$myDb=new DbClass;
$host='localhost';
$user='root';
$pwd='dtbd13adm1n';
$db='simtdb';
if($myDb->connectDefaultServer())
{  
  $uname=mysql_real_escape_string($_POST['uname']);
  $password=mysql_real_escape_string(md5($_POST['password']));
  


  $query="SELECT*FROM tbl_login WHERE userid='$uname' AND password='$password'";
     $r=$myDb->select($query);
	 echo "<span style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; color:#FF0000; font-weight:bold;'>User ID & Password not match!<a href='index.php'>tye latter</a></span>";  
	 while($row=$myDb->get_row($r,'MYSQL_ASSOC')){
     if($row['userid']!=""){
        $aq="SELECT*FROM tbl_access WHERE id='$row[accid]'";
        $a=$myDb->select($aq);
	    $arow=$myDb->get_row($a,'MYSQL_ASSOC');


	    if($arow['id']==$row['accid']){
                     $_SESSION['userid']=$row['userid'];
		             $_SESSION['reason']=$_POST['reason'];
					 header("Location:home.php");
		
          }else{
	         $msg="Your access not matched with user table";
	         header("Location:index.php?msg=$msg");
          }
	 		
	   }
   	   }
}

?>    