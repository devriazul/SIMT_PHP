<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid'])
  { 
  	$chka="SELECT*FROM  tbl_accdtl WHERE flname='managestaffinfonew.php' AND userid='$_SESSION[userid]'";
  	$caq=$myDb->select($chka);
  	$car=$myDb->get_row($caq,'MYSQL_ASSOC');
  	if(($car['ins']=="y")||($_SESSION['userid']=="administrator"))
	{
					//if($_POST['profund']!="")
					//{
							$apar=$myDb->select("SELECT sid, name FROM `tbl_staffinfo` WHERE jobstatus='Active' and etype='Full Time'");
							while($aparf=$myDb->get_row($apar,'MYSQL_ASSOC'))
							{
								
							   
									$chkchart=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE accname='Sundry Debtors') 
												 AND accname='Employees Security Money (Rcv)'");
									$chartf=$myDb->get_row($chkchart,'MYSQL_ASSOC');
									$secname="ESecRcv ".$aparf['name'];			
									$sid=$aparf['sid'];
									
									$inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid)
																   VALUES('$secname','$chartf[id]','$chartf[id]',
																		  'Expense Account','$_SESSION[userid]',
																		  '".date("Y-m-d")."','I','$sid')");
									
						 	}			
					//}
							   
				if($myDb->insert_sql($inschart))
				{
					$msg="Data inserted successfully";
			
				}
				else
				{
					$msg=$myDb->last_error;
					echo $msg;
				}   
		  

	}
	else
	{
		 $msg="Sorry,you are not authorized to access this page";
		 header("Location:home.php?msg=$msg");
	}	 
}else{
  header("Location:index.php");
}
}