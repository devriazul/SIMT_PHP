<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
	if($_SESSION['userid'])
	{ 
    	$chka="SELECT*FROM  tbl_accdtl WHERE flname='chart_of_acc.php' AND userid='$_SESSION[userid]'";
  		$caq=$myDb->select($chka);
  		$car=$myDb->get_row($caq,'MYSQL_ASSOC');
		if($car['ins']=="y")
		{ 
			$acccode=mysql_real_escape_string($_POST['acccode']);
			$accname=mysql_real_escape_string(ucfirst($_POST['accname']));
			$parenthead=mysql_real_escape_string(ucfirst($_POST['parenthead']));
			if(($_POST['parenthead'])=="-1")
			{
				$display=mysql_real_escape_string($_POST['accname']);
			}
			else
			{
        		$display1=mysql_real_escape_string($_POST['parenthead']);  
        		$hv="SELECT display from tbl_accchart where id='$display1'";
        		$r=$myDb->select($hv);
        		$sh=$myDb->get_row($r,'MYSQL_ASSOC');
				$display=$sh['display']."/".mysql_real_escape_string($_POST['accname']);
			}
			$acctype=mysql_real_escape_string(ucfirst($_POST['acctype']));
			$opdate=date("Y-m-d");
			/*
			echo $code;"\n";
			echo $name;"\n";
			echo $description;
			exit;
			*/
    		$query="INSERT INTO  tbl_accchart(`accno`,`accname`,`parentid`,`display`,`type`,`ob`,opby,opdate,storedstatus) VALUES('$acccode','$accname','$parenthead','$display','$acctype','0','$_SESSION[userid]','$opdate','I')";
			$r=$myDb->insert_sql($query);
			$msg="Data inserted successfully";
			header("Location:chart_of_acc.php?msg=$msg");
		}
		else
		{
			$msg="Sorry, You are not authorized to insert records.";
		    header("Location:edit_chart_of_acc.php?msg=$msg");
		}
	}
	else
	{
  		header("Location:login.php");
	}
}  
?>