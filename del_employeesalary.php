<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manageemployeesalary.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['delt']=="y"){
  $id=mysql_real_escape_string($_GET['id']);
   $chkstd=" SELECT * From tbl_employeesalary Where id='$id'";
			 
	$stds=$myDb->select($chkstd);
	$stdq=$myDb->get_row($stds,'MYSQL_ASSOC');

  /*   if(($stdq['crsid']==$stdq['coursename'])&&($stdq['crsid']!="")&&($stdq['coursename']!="")){  
	
	   $msg="Intrigrity constant error,you can not delete master record,please delete details record first then delete master";
       header("Location:managecourseinformation.html?msg=$msg");	
	}else{*/
		$opdate=date("Y-m-d");
		//$optime=date("Y-m-d");

	    $query="INSERT INTO `tbl_logdetails` (`formname`, `tblname`, `tblid`, `opby`, `opdate`, `optime`) VALUES ('Add Employee Salary', 'tbl_employeesalary', '$id',  '$_SESSION[userid]','$opdate',CURTIME())";
		$myDb->insert_sql($query);
				
	   $qup="Delete From tbl_employeesalary WHERE `id`='$id'";
	   if($myDb->update_sql($qup))
	   {

			$msg="Data deleted successfully";
          	header("Location:manageemployeesalary.php?msg=$msg");
	   }else{
	      $msg=$myDb->last_error;
		  echo $msg;
	   }	  	  	
	//}   
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}  
?>