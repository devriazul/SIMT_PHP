<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_admissionfees.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  
  $stdid=mysql_real_escape_string($_POST['stdid']);
  $frommonth=mysql_real_escape_string($_POST['frommonth']);
  $tomonth=mysql_real_escape_string($_POST['tomonth']);
  $eyear=mysql_real_escape_string($_POST['eyear']);
  $tuitionfee=mysql_real_escape_string($_POST['tuitionfee']);
  $admissionfeetext=mysql_real_escape_string($_POST['admissionfeetext']);
  $admissionfee=mysql_real_escape_string($_POST['admissionfee']);
  $latefee=mysql_real_escape_string($_POST['latefee']);
  $semesterfeetext=mysql_real_escape_string($_POST['semesterfeetext']);
  $semesterfee=mysql_real_escape_string($_POST['semesterfee']);
  $registrationfee=mysql_real_escape_string($_POST['registrationfee']);
  $formfillupfee=mysql_real_escape_string($_POST['formfillupfee']);
  $fieldtrainingfee=mysql_real_escape_string($_POST['fieldtrainingfee']);
  $idcardfee=mysql_real_escape_string($_POST['idcardfee']);
  $libraryfee=mysql_real_escape_string($_POST['libraryfee']);
  $admissionform=mysql_real_escape_string($_POST['admissionform']);
  $testimonialtext=mysql_real_escape_string($_POST['testimonialtext']);
  $testimonialfee=mysql_real_escape_string($_POST['testimonialfee']);
  $midtremtesttext=mysql_real_escape_string($_POST['midtremtesttext']);
  $midtremtestfee=mysql_real_escape_string($_POST['midtremtestfee']);
  $marksheetfee=mysql_real_escape_string($_POST['marksheetfee']);
  $labfee=mysql_real_escape_string($_POST['labfee']);
  $others=mysql_real_escape_string($_POST['others']);
  $edate=mysql_real_escape_string($_POST['edate']);
  $id=mysql_real_escape_string($_GET['id']);
  
  if((($edate)&&($stdid))==""){
    $msg="Cureent date & Student id can not left empty";
	echo $msg;
  }else{
    $insd="UPDATE tbl_feescollection SET edate='$edate',                                                                 
	                                     frommonth='$frommonth',
	                                     tomonth='$tomonth',
                                         eyear='$eyear',
                                         tuitionfee='$tuitionfee',
                                         admissionfeetext='$admissionfeetext',
                                         admissionfee='$admissionfee',
                                         latefee='$latefee',
                                         semesterfeetext='$semesterfeetext',
                                         semesterfee='$semesterfee',
                                         registrationfee='$registrationfee',
                                         formfillupfee='$formfillupfee',
                                         fieldtrainingfee='$fieldtrainingfee',
                                         idcardfee='$idcardfee',
                                         libraryfee='$libraryfee',
                                         admissionform='$admissionform',
                                         testimonialtext='$testimonialtext',
                                         testimonialfee='$testimonialfee',
                                         midtremtesttext='$midtremtesttext',
                                         midtremtestfee='$midtremtestfee',
                                         marksheetfee='$marksheetfee',
                                         labfee='$labfee',
                                         others='$others',
                                         opby='$_SESSION[userid]',
                                         opdate='".date("Y-m-d")."',
                                         storedstatus='I'
			WHERE id='$id'";
  
	                $sin=$myDb->update_sql($insd);
	                $msg="Update record successfully";
					echo $msg;  
  
  }						
}else{
  header("Location:login.php");
}
}
}  
?>
  