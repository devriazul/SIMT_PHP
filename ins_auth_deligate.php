<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $refurl=substr($_SERVER['HTTP_REFERER'],0,strpos($_SERVER['HTTP_REFERER'], '?'));
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='macclevel.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
	
    for($i=0;$i<count($_POST['id']);$i++){
	 $accname=$_POST['accname'];
	 $catid=$_POST['catid'];
	 	if(!empty($_POST['ins'][$i])&&!empty($_POST['upd'][$i])&&!empty($_POST['delt'][$i])){
		  $apq=$myDb->select("SELECT*FROM tbl_applicationauth where accid='$accname' and catid='$catid' and scatid='".$_POST['id'][$i]."'");
		  $apqf=$myDb->get_row($apq,'MYSQL_ASSOC');
		  if(empty($apqf['id'])){
			 $ins_str="INSERT INTO tbl_applicationauth(accid,catid,scatid,ins,upd,delt)
			 			VALUES('$accname','$catid','".$_POST['id'][$i]."'
							  ,'".$_POST['ins'][$i]."','".$_POST['upd'][$i]."','".$_POST['delt'][$i]."')";
			 if($myDb->insert_sql($ins_str)){ 
			    $msg="Data inserted successfully";
				header("Location:access_deligates.php?msg=$msg");
			 }else{
				echo $myDb->last_error;
			 }
		  }else{
		    $myDb->update_sql("UPDATE tbl_applicationauth SET
								ins='".$_POST['ins'][$i]."',
								upd='".$_POST['upd'][$i]."',
								delt='".$_POST['delt'][$i]."'
								WHERE accid='$accname'
								AND catid='$catid'
								AND scatid='".$_POST['id'][$i]."'");
			    $msg="Data update successfully";
				header("Location:access_deligates.php?msg=$msg");
		  } 	 	
		 }
	} 



   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:index.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}
?>