<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_student.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
			  $session=mysql_real_escape_string($_POST['session']);
			  $deptname=mysql_real_escape_string($_POST['deptname']);

									$acc=$myDb->select("select*from tbl_accchart where id in(select parentid from tbl_accchart where parentid=7)");
									$accf=$myDb->get_row($acc,'MYSQL_ASSOC');
									if($accf['id']==""){
									   $accname="Session".$session;
									   //$dn=$myDb->select("select*from tbl_department where id='$deptname'");
									  // $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
									   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,session)
											   VALUES('$accname',7,6,'Trading Account',1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session')";
									   $ai=$myDb->insert_sql($accin);
										   echo "Session Accounts head saved";
									}else{
									   $dn=$myDb->select("select*from tbl_department where id='$deptname'");
									   $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
									   $cac=$myDb->select("select*from tbl_accchart where parentid=7 and session='$session'");
									   $cacf=$myDb->get_row($cac,'MYSQL_ASSOC');
									   if($cacf['id']!=""){		
										   $accname=$dnf['name'].$session;
										   $chk=$myDb->select("select*from tbl_accchart where parentid='$cacf[id]' and session='$session' and dname='$dnf[name]'");
										   $chkf=$myDb->get_row($chk,'MYSQL_ASSOC');
										   if($chkf['id']==""){
											   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,session,dname)
													   VALUES('$accname','$cacf[id]',6,'Trading Account',1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
											   $ai=$myDb->insert_sql($accin);
											   echo "Department Accounts head saved";
										   }
									   }else{
										   $accname="Session".$session;
										   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,session)
												   VALUES('$accname',7,6,'Trading Account',1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session')";
										   $ai=$myDb->insert_sql($accin);
										   echo "Session Accounts head entered";
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