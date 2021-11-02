<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managenotice.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
	$id=mysql_real_escape_string($_GET['id']);
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
	   
	   $qup="Delete from tbl_notice WHERE `id`='$id'";
	   $upd=$myDb->update_sql($qup);
		$opdate=date("Y-m-d");
		//$optime=date("Y-m-d");

	    $query="INSERT INTO `tbl_logdetails` (`formname`, `tblname`, `tblid`, `opby`, `opdate`, `optime`) VALUES ('Notice Board', 'tbl_notice', '$id',  '$_SESSION[userid]','$opdate',CURTIME())";
		if(mysqldb->insert_sql($query))
		{		

	   		$msg="Data deleted successfully";
       		header("Location:managenotice.php?msg=$msg");
		}
	//}   
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}