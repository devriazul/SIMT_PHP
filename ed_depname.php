<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='depname.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
    $code=mysql_real_escape_string(strtoupper($_POST['code']));
	$name=mysql_real_escape_string(ucfirst($_POST['name']));
	$admissionfee=mysql_real_escape_string($_POST['admissionfee']);
	$labfee=mysql_real_escape_string($_POST['labfee']);
	$libraryfee=mysql_real_escape_string($_POST['libraryfee']);
	$idcardfee=mysql_real_escape_string($_POST['idcardfee']);
	$regifee=mysql_real_escape_string($_POST['regifee']);
	$onetimefee=mysql_real_escape_string($_POST['onetimefee']);
	$noofsemester=mysql_real_escape_string($_POST['noofsemester']);
	$semesterfee=mysql_real_escape_string($_POST['semesterfee']);
	$noofmonths=mysql_real_escape_string($_POST['noofmonths']);
	$tuitionfee=mysql_real_escape_string($_POST['tuitionfee']);
	$credit=mysql_real_escape_string($_POST['credit']);
	$description=mysql_real_escape_string($_POST['description']);
	$admform=mysql_real_escape_string($_POST['admform']);
	$rcvbook=mysql_real_escape_string($_POST['rcvbook']);
	$id=mysql_real_escape_string($_GET['id']);
	$qup="UPDATE  tbl_department SET `code`='$code',`name`='$name',`admissionfee`='$admissionfee',`labfee`='$labfee',`libraryfee`='$libraryfee',`idcardfee`='$idcardfee',`regifee`='$regifee',`onetimefee`='$onetimefee',`noofsemester`='$noofsemester',`semesterfee`='$semesterfee',`noofmonths`='$noofmonths',`tuitionfee`='$tuitionfee',`credit`='$credit',`description`='$description',`storedstatus`='U',`admform`='$admform',`rcvbook`='$rcvbook',opby='$_SESSION[userid]' WHERE `id`='$id'";
	$upd=$myDb->update_sql($qup);
	$msg="Data updated successfully";
	echo $msg;
    //header("Location:depname.html?msg=$msg");
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 echo $msg;
	 //header("Location:home.html?msg=$msg");
   }	 

}else{
  header("Location:login.html");
}
}  
?>
