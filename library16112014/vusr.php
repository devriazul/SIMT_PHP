<?php ob_start();
session_start();
require_once('dbClass.php');
include('config.php');
if($myDb->connect($host,$user,$pwd,$db,true))
{  
  $uname=mysql_real_escape_string($_POST['uname']);
  $password=mysql_real_escape_string(md5($_POST['password']));
  $_SESSION['sdate']=date("Y-m-d");
  
  $query="SELECT*FROM tbl_login WHERE userid='$uname' AND password='$password'";
     $r=$myDb->select($query);
	 echo "<span style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; color:#FF0000; font-weight:bold;'>User ID & Password not match!<a href='login.php'>tye latter</a></span>";  
	 while($row=$myDb->get_row($r,'MYSQL_ASSOC')){
     if($row['userid']!=""){
        $aq="SELECT*FROM tbl_access WHERE id='$row[accid]'";
        $a=$myDb->select($aq);
	    $arow=$myDb->get_row($a,'MYSQL_ASSOC');
	    if($arow['id']==$row['accid']){
		    switch($arow['accname']){
		    
		       case "Administrator":
                     $_SESSION['userid']=$row['userid'];
		             header("Location:home.php");
				     break;
		       case "Accounts":	
                     $_SESSION['userid']=$row['userid'];
		             header("Location:acchome.php");
				     break;
			   case "Library Management":
                     $_SESSION['userid']=$row['userid'];
		             header("Location:home.php");
				     break;
			   default:
	                 $msg="Your access not matched with user table".$arow['accname']."\t";
	                 header("Location:login.php?msg=$msg");
		     }		
		
          }else{
	         $msg="Your access not matched with user table";
	         header("Location:login.php?msg=$msg");
          }
	 		
	   }
   	   }
}

?>    