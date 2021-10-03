<?php ob_start();
session_start();
require_once('dbClass.php');
if(!$_SESSION['emagasesid']){
   include("logout.php");
}else{
	 include("config.php");
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
			copy($_FILES[img][tmp_name],"dashboardimg/".$a);	    
			$query="UPDATE tbl_access SET `accname`='$accname', `description`='$description',img='$a',orderid='$orderid' WHERE id='$id'";
			if($r=$myDb->update_sql($query)){
			   $msg="Data updated successfully";
		  		   header("Location:$rurl?id=$id&msg=$msg");			
			}else{
			   $msg=$myDb->last_error;
		  		   header("Location:$rurl?id=$id&msg=$msg");			
			}
	
	}else{
			$query="UPDATE tbl_access SET `accname`='$accname', `description`='$description',orderid='$orderid' WHERE id='$id'";
			if($r=$myDb->update_sql($query)){
			   $msg="Data updated successfully";
		  		   header("Location:$rurl?id=$id&msg=$msg");			
			}else{
			   $msg=$myDb->last_error;
		  		   header("Location:$rurl?id=$id&msg=$msg");			
			}

	} 			

}
