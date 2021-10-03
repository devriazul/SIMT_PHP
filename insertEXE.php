<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
      $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_student.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){ 
  $stdid = !empty( $_SESSION['stdf'] ) ? $_SESSION['stdf'] : $_SESSION['exstid'];
  $mq="SELECT*FROM tbl_stdinfo WHERE stdid='$stdid'";//(SELECT MAX(id) FROM tbl_stdinfo)";
  $mqr=$myDb->select($mq);
  $msf=$myDb->get_row($mqr,'MYSQL_ASSOC');
  
  $len = count($_POST['nexemination']);
  //echo print_r($_POST['nexemination']);
  //exit;
  for ($i=0; $i <$len-1; $i++)
  {
    $ei="INSERT INTO tbl_educationalq(stdtid,stdid,exstid,nexemination,group1,board,passyear,cgpas,tcgpa,gcsubject,opby,opdate,storedstatus,othtrade)VALUES('$msf[id]','$msf[stdid]','$msf[exstid]','".mysql_real_escape_string($_POST['nexemination'][$i])."','".mysql_real_escape_string($_POST['group1'][$i])."','".mysql_real_escape_string($_POST['board'][$i])."','".mysql_real_escape_string($_POST['passyear'][$i])."','".mysql_real_escape_string($_POST['cgpas'][$i])."','".mysql_real_escape_string($_POST['tcgpa'][$i])."','".mysql_real_escape_string($_POST['gcsubject'][$i])."','$_SESSION[userid]','".date("Y-m-d")."','I','".mysql_real_escape_string($_POST['othtrade'][$i])."')";
    $ein=$myDb->insert_sql($ei);
	//echo "success";
	//exit;
  }	
	$msg="Student information successfully saved.";
	header("Location:stdinfo.php?msg=$msg");
 
 
 }else{
     $msg="Sorry,you are not authorized to access this page";
 }	 

}else{
  header("Location:login.php");
}
}  
?>

