<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managestaffinfo.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
	$id=mysql_real_escape_string($_GET['id']);
	$f=mysql_query("select*from tbl_staffinfo where id='$id'") or die(mysql_error());
	$ff=mysql_fetch_array($f);
	/*$htq="SELECT p.id psid,p.name psname,s.payscaleid payscaleid 
	      FROM tbl_payscale p
		  INNER JOIN tbl_staffinfo s
		  ON p.id=s.payscaleid
		  WHERE p.id='$id'";
	$htr=$myDb->select($htq);
	$htrow=$myDb->get_row($htr,'MYSQL_ASSOC');	  
	
	if(($htrow['psid']==$htrow['payscaleid'])&&($htrow['psid']!="")&&($htrow['payscaleid']!="")){
	   $msg="Intrigrity constant error,you can not delete master record,please delete details record first then delete master";
       header("Location:managepayscale.php?msg=$msg");
	}else{*/
		//---------Insert data into log table-----------------
	   $opdate=date("Y-m-d");
	   $optime=date("H:i:s");
	   $qupld="INSERT into tbl_logdetails (formname,tblname,tblid,opby,opdate,optime) VALUES('del_staffinfo.php','tbl_staffinfo','$id','$_SESSION[userid]','$opdate','$optime')";
	   $updld=$myDb->update_sql($qupld);

		//---------Delete data from `tbl_login`---------------
	   mysql_query("delete from tbl_login where userid='$ff[sid]'") or die(mysql_error());
		//---------Delete data from `tbl_attendance`---------------
	   mysql_query("delete from tbl_attendance where efid='$ff[sid]'") or die(mysql_error());
		//---------Delete data from `tbl_leaveapplication`---------------
	   mysql_query("delete from tbl_leaveapplication where empid='$ff[sid]'") or die(mysql_error());
		//---------Delete data from `tbl_leaveassignedhistory`---------------
	   mysql_query("delete from tbl_leaveassignedhistory where efid='$ff[sid]'") or die(mysql_error());
		//---------Delete data from `tbl_leavedetails`---------------
	   mysql_query("delete from tbl_leavedetails where efid='$ff[sid]'") or die(mysql_error());
	   //----------Delete data from `tbl_employeesalary`---------------
	   mysql_query("delete from tbl_employeesalary where empid='$ff[sid]'") or die(mysql_error());
		//---------Delete data from `tbl_staffinfo`---------------
	   mysql_query("delete from tbl_staffinfo where sid='$ff[sid]'") or die(mysql_error());

	   //$qup="UPDATE tbl_staffinfo SET `storedstatus`='D' WHERE `id`='$id'";
	   //$upd=$myDb->update_sql($qup);
	   $msg="Data deleted successfully";
       header("Location:managestaffinfo.php?msg=$msg");
	//}   
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}