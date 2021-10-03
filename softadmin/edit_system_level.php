<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='system_access_level.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
	$rurl=$_SERVER['HTTP_REFERER'];
	$id=mysql_real_escape_string($_GET['id']);
	$accname=!empty($_POST['accname'])?$_POST['accname']:'';
	$accname=mysql_real_escape_string($accname);
	$description=!empty($_POST['description'])?$_POST['description']:'';
	$description=mysql_real_escape_string($description);
	$imgname=!empty($_POST['imgname'])?$_POST['imgname']:$id.time();
	$orderid=mysql_real_escape_string($_POST['orderid']);
	$opdate=date("Y-m-d");
	$a=$imgname.".jpg";
	if($_FILES[img][tmp_name]!=""){	
			copy($_FILES[img][tmp_name],"moduleImage/".$a);	    
			$query="UPDATE tbl_access SET `accname`='$accname', `description`='$description',img='$a',orderid='$orderid' WHERE id='$id'";
			if($r=$myDb->update_sql($query)){
			   $msg="Data updated successfully";
			   $sdq="select * from tbl_access order by id desc";
						$sdep=$myDb->dump_query($sdq,'edit_access_level.php','del_access_level.php',$car['upd'],$car['delt']);		
		  		   header("Location:$rurl?id=$id&msg=$msg");			
			}else{
			   $msg=$myDb->last_error;
			  $sdq="select * from tbl_access order by id desc";
						$sdep=$myDb->dump_query($sdq,'edit_access_level.php','del_access_level.php',$car['upd'],$car['delt']);	
		  		   header("Location:$rurl?id=$id&msg=$msg");			
			}
	
	}else{
			$query="UPDATE tbl_access SET `accname`='$accname', `description`='$description',orderid='$orderid' WHERE id='$id'";
			if($r=$myDb->update_sql($query)){
			   $msg="Data updated successfully";
			   $sdq="select * from tbl_access order by id desc";
						$sdep=$myDb->dump_query($sdq,'edit_access_level.php','del_access_level.php',$car['upd'],$car['delt']);		
		  		   header("Location:$rurl?id=$id&msg=$msg");			
			}else{
			   $msg=$myDb->last_error;
			  $sdq="select * from tbl_access order by id desc";
						$sdep=$myDb->dump_query($sdq,'edit_access_level.php','del_access_level.php',$car['upd'],$car['delt']);	
		  		   header("Location:$rurl?id=$id&msg=$msg");			
			}

	} 			
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}