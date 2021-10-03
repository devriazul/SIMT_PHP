<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM tbl_accdtl WHERE flname='system_access_level.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
    $userid1=mysql_real_escape_string(ucfirst(strtolower($_POST['userid1'])));
	$username=mysql_real_escape_string($_POST['username']);
	$emailid=mysql_real_escape_string($_POST['emailid']);
	$password=md5($_POST['password']);
	$opdate=date("Y-m-d");
    $query="INSERT INTO tbl_login(`userid`,`username`,`emailid`,`password`,`accid`) VALUES('$userid1','$username','$emailid','$password','$accid')";
	if($r=$myDb->insert_sql($query)){
	   $msg="Data inserted successfully";
	   echo $msg;
	   $sdq="SELECT l.userid,l.username,l.emailid,l.password,a.accname FROM tbl_access a
				              INNER JOIN tbl_login l
							  ON a.id=l.accid";
			    $sdep=$myDb->dump_query($sdq,'edit_user.php','del_user.php',$car[upd],$car[delt]);			
	   /*$sdq="select l.userid UserID,a.accname AccessName,a.id AccessID 
	         from tbl_access a
			 left join tbl_login l 
			 on a.id=l.accid order by a.id desc";
			    $sdep=$myDb->dump_query($sdq,'edit_access_level.php','del_access_level.php',$car[upd],$car[delt]);
	   */			
    }else{
	   $msg=$myDb->last_error;
	   echo $msg;	
	   /*$sdq="select l.userid UserID,a.accname AccessName,a.id AccessID 
	         from tbl_access a
			 left join tbl_login l 
			 on a.id=l.accid order by a.id desc";
			    $sdep=$myDb->dump_query($sdq,'edit_access_level.php','del_access_level.php',$car[upd],$car[delt]);
	  */
	  $sdq="SELECT l.userid,l.username,l.emailid,l.password,a.accname FROM tbl_access a
				              INNER JOIN tbl_login l
							  ON a.id=l.accid";
			    $sdep=$myDb->dump_query($sdq,'edit_user.php','del_user.php',$car[upd],$car[delt]);			
	} 			
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>