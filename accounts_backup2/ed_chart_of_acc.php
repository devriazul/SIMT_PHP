<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  
    //$acccode=mysql_real_escape_string($_POST['acccode']);
	//echo $acccode;
	$accname=mysql_real_escape_string(ucfirst($_POST['accname']));
	$acctype=mysql_real_escape_string(ucfirst($_POST['acctype']));
	$id=mysql_real_escape_string($_GET['id']);
	
	if(($_POST['accid'])=="")
	{
		$parenthead=mysql_real_escape_string(ucfirst($_POST['accidload']));
		$query="UPDATE  tbl_accchart set `accname`='$accname',`parentid`='$parenthead',`type`='$acctype',`storedstatus`='U' WHERE `id`='$id'";
		$r=$myDb->update_sql($query);
	
	
		$msg="Data updated successfully";
        echo $msg;
    	//header("Location:edit_chart_of_acc.php?msg=$msg");
	}
	else
	{
        $parenthead=mysql_real_escape_string($_POST['accid']);
		$query="UPDATE  tbl_accchart set `accname`='$accname',`parentid`='$parenthead',`type`='$acctype',`storedstatus`='U' WHERE `id`='$id'";
		$r=$myDb->update_sql($query);
	
	
		$msg="Data updated successfully";
        echo $msg;
    	//header("Location:edit_chart_of_acc.php?msg=$msg");
		//$display1=mysql_real_escape_string($_POST['parenthead']);  
        //$hv="SELECT display from tbl_accchart where id='$display1'";
        //$r=$myDb->select($hv);
        //$sh=$myDb->get_row($r,'MYSQL_ASSOC');
		//$display=$sh['display']."/".mysql_real_escape_string($_POST['accname']);
	}
	

	
}else{
  header("Location:login.php");
}
}  
?>