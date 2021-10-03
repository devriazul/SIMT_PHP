<?php ob_start();
session_start();
require_once('dbClass.php');
$myDb=new DbClass;
$host='localhost';
$user='root';
$pwd='';
$db='simt_edu';

if($myDb->connect($host,$user,$pwd,$db,true))
{  
  $uname=mysql_real_escape_string($_POST['adminid']);
  $password=mysql_real_escape_string(md5($_POST['password']));
  //echo "Password Is:".$password;
  
  $query="SELECT*FROM tbl_login WHERE userid='$uname' AND password='$password'";
  $r=$myDb->select($query);
  while($row=$myDb->get_row($r,'MYSQL_ASSOC')){
  if($row['userid']!=""){
     $aq="SELECT*FROM tbl_access WHERE id='$row[accid]'";
     $a=$myDb->select($aq);
	 $arow=$myDb->get_row($a,'MYSQL_ASSOC');
	 if($arow['id']==$row['accid']){
		switch($arow['accname']){
		    
		    case "Accounts":	
                 $_SESSION['userid']=$row['userid'];
		         header("Location:acchome.php");
				 break;
			default:
	            $msg="Your access not matched with user table".$arow['accname']."\t";
	            echo $msg;
				//header("Location:login.php?msg=$msg");
		}		
		
     }else{
	       $msg="Your access not matched with user table";
	       //header("Location:login.php?msg=$msg");
	       echo $msg;
     }
   }	   
  }	 		
}

?>    