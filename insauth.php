<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
	if($_SESSION['userid'])
	{
		
		$TR = count($_POST['id']);
  		//if($TR>0)
		//{
			for ($i=0; $i <$TR; $i++)
  			{
				if(!empty($_POST['insm'][$i]) && !empty($_POST['updm'][$i]) && !empty($_POST['deltm'][$i]))
				{	
					$stquery=$myDb->select("Select * from tbl_accdtl WHERE userid='".$_POST['userid']."' and flname='".$_POST['id'][$i]."'");
					$stf=$myDb->get_row($stquery,'MYSQL_ASSOC');
					if(empty($stf['id']))
					{
						$query="INSERT INTO tbl_accdtl(userid,flname,ins,upd,delt,storedstatus)VALUES('$_POST[userid]','".$_POST['id'][$i]."','".$_POST['insm'][$i]."','".$_POST['updm'][$i]."','".$_POST['deltm'][$i]."','I')";
						if($myDb->insert_sql($query))
						{
							$msg="Data inserted successfully"; 
						}
						else
						{
							$msg=$myDb->last_error;
						} 	
					}
					else
					{
						$query="UPDATE tbl_accdtl set ins='".$_POST['insm'][$i]."', upd='".$_POST['updm'][$i]."',delt='".$_POST['deltm'][$i]."' WHERE userid='".$_POST['userid']."' and flname='".$_POST['id'][$i]."'";
						if($myDb->update_sql($query))
						{
							$msg="Data update successfully"; 
						}
						else
						{
							$msg=$myDb->last_error;
						} 	
						
					}

				}
				else
				{
					//$msg="Nothing is selected.";
				}
			}if(!empty($msg)){echo $msg;	}else{ echo $msg="SoRRY! Nothing is Selected.";};
 		//}
	}
		
	else
	{
  		header("Location:index.php");
	}
}  
?>

