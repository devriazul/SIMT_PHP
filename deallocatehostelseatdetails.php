<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  	if($_SESSION['userid'])
	{
   		$chka="SELECT*FROM  tbl_accdtl WHERE flname='managedeallocatehostel.php' AND userid='$_SESSION[userid]'";
  		$caq=$myDb->select($chka);
  		$car=$myDb->get_row($caq,'MYSQL_ASSOC');
  		if($car['ins']=="y")
		{
 			//$stdid=$_SESSION['Studentid'];
			$id=mysql_real_escape_string($_GET['id']);
			$chkdb="SELECT tbl_hostelseatdetails.* FROM  tbl_hostelseatdetails, tbl_stdinfo WHERE tbl_hostelseatdetails.stdid=tbl_stdinfo.stdid and tbl_stdinfo.id='$id' AND tbl_stdinfo.storedstatus<>'D'";
  			$cadb=$myDb->select($chkdb);
  			$cardb=$myDb->get_row($cadb,'MYSQL_ASSOC');
  			if($cardb['status']=="1")
			{
 				
				//$stdid=$_SESSION['Studentid'];
				$opdate=date("Y-m-d");
				$hsdid=mysql_real_escape_string($cardb['id']);
				
				$qup="UPDATE tbl_hostelseatdetails SET `stdid`='', `status`='0', `storedstatus`='U', `opdate`='$opdate', `opby`='$_SESSION[userid]' WHERE `id`='$hsdid'";
				$upd=$myDb->update_sql($qup);
				//$f=true;
				$msg="Data Updated Successfully";
				//echo $msg;
    			header("Location:managedeallocatehostel.php?msg=$msg");
   			}
			else
			{
     			$msg="SORRY!! Can't Deallocate, something went wrong.";
				header("Location:managedeallocatehostel.php?msg=$msg");
				
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