<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  	if($_SESSION['userid'])
	{
   		$chka="SELECT*FROM  tbl_accdtl WHERE flname='manageallocatehostel.php' AND userid='$_SESSION[userid]'";
  		$caq=$myDb->select($chka);
  		$car=$myDb->get_row($caq,'MYSQL_ASSOC');
  		if($car['ins']=="y")
		{
 			$stdid=$_SESSION['Studentid'];
			$id=mysql_real_escape_string($_GET['id']);
			$chkdb="SELECT*FROM  tbl_hostelseatdetails WHERE id='$id' AND storedstatus<>'D'";
  			$cadb=$myDb->select($chkdb);
  			$cardb=$myDb->get_row($cadb,'MYSQL_ASSOC');
  			if($cardb['status']=="0")
			{
 				
				//$stdid=$_SESSION['Studentid'];
				$opdate=date("Y-m-d");
				//$id=mysql_real_escape_string($_GET['id']);
	
				$qup="UPDATE tbl_hostelseatdetails SET `stdid`='$stdid', `status`='1', `storedstatus`='U', `opdate`='$opdate', `opby`='$_SESSION[userid]' WHERE `id`='$id'";
				$upd=$myDb->update_sql($qup);
				//$f=true;
				$msg="Data Updated Successfully";
				//echo $msg;
    			header("Location:manageallocatehostel.php?msg=$msg");
   			}
			else
			{
     			$msg="SORRY!! Select Seat is already Allocated to another student.";
				header("Location:manageallocatehostel.php?msg=$msg");
				
   			}	 
		}
		else
		{
			$msg="Sorry,you are not authorized to access this page";
	 		//echo $msg;
	 		header("Location:home.php?msg=$msg");
		}
	}
	else
	{
  		header("Location:index.php");
	}
}  
?>