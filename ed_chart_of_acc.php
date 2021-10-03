<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  
    $acccode=mysql_real_escape_string($_POST['acccode']);
	echo $acccode;
	$accname=mysql_real_escape_string(ucfirst($_POST['accname']));
	$parenthead=mysql_real_escape_string(ucfirst($_POST['parenthead']));
	
	if(($_POST['parenthead'])=="-1")
	{
		$display=mysql_real_escape_string($_POST['accname']);
	}
	else
	{
        $display1=mysql_real_escape_string($_POST['parenthead']);  
        $hv="SELECT display from tbl_accchart where id='$display1'";
        $r=$myDb->select($hv);
        $sh=$myDb->get_row($r,'MYSQL_ASSOC');
		$display=$sh['display']."/".mysql_real_escape_string($_POST['accname']);
	}
	
	$acctype=mysql_real_escape_string(ucfirst($_POST['acctype']));
	
	$id=mysql_real_escape_string($_GET['id']);
	
    $query="UPDATE  tbl_accchart set `accno`='$acccode',`accname`='$accname',`parentid`='$parenthead',`display`='$display',`type`='$acctype',`storedstatus`='U',opby='$_SESSION[userid]' WHERE `id`='$id'";
	//$query="UPDATE  tbl_accchart set `accno`='$acccode',`accname`='$accname', `storedstatus`='U' WHERE `id`='$id')";	
	$r=$myDb->update_sql($query);
	
	
	$msg="Data updated successfully";
    header("Location:edit_chart_of_acc.php?msg=$msg");
}else{
  header("Location:login.php");
}
}  
?>