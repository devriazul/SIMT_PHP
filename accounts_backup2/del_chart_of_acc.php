<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
	if($_SESSION['userid'])
	{
		$chka="SELECT*FROM  tbl_accdtl WHERE flname='view_chart_ofacc.php' AND userid='$_SESSION[userid]'";
  		$caq=$myDb->select($chka);
  		$car=$myDb->get_row($caq,'MYSQL_ASSOC');
		if($car['delt']=="y")
		{  	
			$chkph="SELECT * FROM  `tbl_accchart` WHERE parentid='$id' OR id in(select accno from tbl_seconderyjournal) AND opby='$_SESSION[userid]'";
	  		$cph=$myDb->select($chkph);
  			$carph=$myDb->get_row($cph,'MYSQL_ASSOC');
			if(!$carph)
			{
				$id=mysql_real_escape_string($_GET['id']);
				$qup="UPDATE  tbl_accchart SET `storedstatus`='D' WHERE `id`='$id'";
				$upd=$myDb->update_sql($qup);
				$msg="Data deleted successfully";
    			header("Location:view_chart_ofacc.php?msg=$msg");
			}
			else
			{
				$msg="Can't delete record. Either it is Parent Head OR this account has transactions.";
		    	header("Location:view_chart_ofacc.php?msg=$msg");
			}
		}
		else
		{
			$msg="Sorry, You are not authorized to delete records.";
		    header("Location:view_chart_ofacc.php?msg=$msg");
		}
	}
	else
	{
  		header("Location:login.php");
	}
}  
?>