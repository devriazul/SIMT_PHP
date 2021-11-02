<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_admission_fees.php' AND userid='$_SESSION[userid]'";
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
  
  $std="SELECT id FROM tbl_stdinfo WHERE stdid='$stdid'";
  $stdq=$myDb->select($std);
  $stdr=$myDb->get_row($stdq,'MYSQL_ASSOC');
  
  if((($edate)&&($stdid))==""){
    $msg="Cureent date & Student id can not left empty";
	echo $msg;
  }else{
    $insd="INSERT INTO tbl_feescollection(stdid,stid,edate, frommonth,tomonth,eyear,tuitionfee,admissionfeetext,admissionfee,latefee,semesterfeetext,semesterfee,registrationfee,formfillupfee,fieldtrainingfee,idcardfee,libraryfee,admissionform,testimonialtext,testimonialfee,midtremtesttext,midtremtestfee,marksheetfee,labfee,others,opby,opdate,storedstatus)VALUES('$stdid','$stdr[id]','$edate','$frommonth','$tomonth','$eyear','$tuitionfee','$admissionfeetext','$admissionfee','$latefee','$semesterfeetext','$semesterfee','$registrationfee','$formfillupfee','$fieldtrainingfee','$idcardfee','$libraryfee','$admissionform','$testimonialtext','$testimonialfee','$midtremtesttext','$midtremtestfee','$marksheetfee','$labfee','$others','$_SESSION[userid]','".date("Y-m-d")."','I')";
  
	                $sin=$myDb->insert_sql($insd);
	                $msg="Insert fee successfully";
					echo $msg;  
  
  }						
}else{
  header("Location:login.php");
}
}
}  
?>
  