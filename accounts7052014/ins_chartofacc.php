<?php ob_start();
session_start();
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
			
			if(($_POST['parenthead'])=="Parent Head")
			{
				$parenthead="-1";
				//$display=mysql_real_escape_string($_POST['accname']);
			}
			else
			{
        		$parenthead=mysql_real_escape_string($_POST['accid']);
				//$display1=mysql_real_escape_string($_POST['parenthead']);  
        		//$hv="SELECT display from tbl_accchart where id='$display1'";
        		//$r=$myDb->select($hv);
        		//$sh=$myDb->get_row($r,'MYSQL_ASSOC');
				//$display=$sh['display']."/".mysql_real_escape_string($_POST['accname']);
			}
			$acctype=mysql_real_escape_string(ucfirst($_POST['acctype']));
			$opdate=date("Y-m-d");
			/*
			echo $code;"\n";
			echo $name;"\n";
			echo $description;
			exit;
			*/
    		$query="INSERT INTO  tbl_accchart(`accname`,`parentid`,`type`,`ob`,opby,opdate,storedstatus) VALUES('$accname','$parenthead','$acctype','0','$_SESSION[userid]','$opdate','I')";
			$r=$myDb->insert_sql($query);
			$msg="Data insert successfully.";
			echo $msg;
		}
		else
		{
			$msg="Sorry, You are not authorized to insert records.";
		    //header("Location:edit_chart_of_acc.php?msg=$msg");
			echo $msg;
		}
	}
	else
	{
  		header("Location:login.php");
	}
}  
?>