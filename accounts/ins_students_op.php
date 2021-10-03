<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  	if($_SESSION['userid'])
	{
		$chka="SELECT*FROM  tbl_accdtl WHERE flname='add_students_op.php' AND userid='$_SESSION[userid]'";
  		$caq=$myDb->select($chka);
  		$car=$myDb->get_row($caq,'MYSQL_ASSOC');
		if($car['ins']=="y")
		{ 
		
			//for($i=0;$i<count($_POST['accno']);$i++)
			//{
				$obdate=$_POST['obdate'];
				$accname=$_POST['accname'];
			 	$amount=$_POST['amount'];
				$type=$_POST['type'];
				
				//echo "Select * from tbl_accchart where accname='$accname' and stdob<>'1'"; exit;
				$chkacc=$myDb->select("Select * from tbl_accchart where accname='$accname' and stdob<>'1'");
				$chkaccf=$myDb->get_row($chkacc,'MYSQL_ASSOC');			
				//echo $chkaccf['accname']."1";
				//echo $accname."2"; 
				//echo $chkaccf['accname']."1=".$accname."2";
				
				//exit;
				if(trim($chkaccf['accname'])==$accname)
				{ //echo "enter the scope........"; exit;
				
							//---------------Auto hit to accounts for security money-----------------
							$accstdob=$myDb->select("select*from tbl_accchart where accname='Students Opening Balance'");
							$accstdobf=$myDb->get_row($accstdob,'MYSQL_ASSOC');

							
							$accstd=$myDb->select("select*from tbl_accchart where accname='$accname'");
							$accstdf=$myDb->get_row($accstd,'MYSQL_ASSOC');
							
														
							$vid=$myDb->select("SELECT ifnull(count(id),0) mvid FROM tbl_masterjournal WHERE vouchertype='J'");
							$vidf=$myDb->get_row($vid,'MYSQL_ASSOC');
							$maxvid=$vidf['mvid']+1;
							$opdate=$obdate;//date("Y-m-d");
                            $voucherid="JV/-".$opdate."-"."0".$maxvid;													 
							$vexpl="Opening balance entry for: ".$accname;
							$vgroup=substr($accstdobf['accname'],0,7);

							
							if($accstdf['groupname']==0)
		  					{
		    					$groupnamep=$accstdf['parentid'];
		  					}else{
		    					$groupnamep=$accstdf['groupname'];
		  					}

							if($accstdobf['groupname']==0)
		  					{
		    					$groupnames=$accstdobf['parentid'];
		  					}else{
		    					$groupnames=$accstdobf['groupname'];
		  					}

		  					if($type=="Dr")
							{
								$myDb->insert_sql("INSERT INTO tbl_masterjournal(voucherid,voucherdate,vouchertype,preparedby, paytype,opby,opdate,storedstatus,accountno,voucherexpl, multi_single,voucher_group)	
													VALUES('$voucherid','$opdate','J','$_SESSION[userid]','','$_SESSION[userid]','$opdate','I','$accstdf[id]','$vexpl','single','$vgroup')");

								$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group)
									VALUES('$accstdf[id]','$groupnamep','$accstdf[accname]','$amount','0','$voucherid','J','','$opdate','$accstdf[parentid]','0','I','$_SESSION[userid]','single','$vgroup')");

								$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group)
									VALUES('$accstdobf[id]','$groupnames','$accstdobf[accname]','0','$amount','$voucherid','J','','$opdate','$accstdobf[parentid]','$accstdf[id]','I','$_SESSION[userid]','single','$vgroup')");
		  					}
		  					elseif($type=="Cr")
							{
								$myDb->insert_sql("INSERT INTO tbl_masterjournal(voucherid,voucherdate,vouchertype,preparedby, paytype,opby,opdate,storedstatus,accountno,voucherexpl, multi_single,voucher_group)	
													VALUES('$voucherid','$opdate','J','$_SESSION[userid]','','$_SESSION[userid]','$opdate','I','$accstdobf[id]','$vexpl','single','$vgroup')");

								$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group)
									VALUES('$accstdobf[id]','$groupnames','$accstdobf[accname]','$amount','0','$voucherid','J','','$opdate','$accstdobf[parentid]','0','I','$_SESSION[userid]','single','$vgroup')");

								$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group)
									VALUES('$accstdf[id]','$groupnamep','$accstdf[accname]','0','$amount','$voucherid','J','','$opdate','$accstdf[parentid]','$accstdobf[id]','I','$_SESSION[userid]','single','$vgroup')");
		  					}
							//------------------End of auto hit---------------
				
				
							$myDb->update_sql("UPDATE tbl_accchart SET stdob='1' WHERE accname='$accname'");
			  				echo "<div style='width:500px; height:25px;padding:5px; background-color:#999999;color:#ffffff;' align='center'>Record successfully updated</div>";				  
				}
				else
				{
			  				echo "<div style='width:500px; font-weight: bold;height:30px;padding:5px; background-color:#FF0000;color:#ffffff;' align='center'>Sorry, Student ID is not exists/ Opening Balance of selected account is already submitted.</div>";				  
							exit;
				}
		}
					
		else
		{
			$msg="Sorry, You are not authorized to access this page.";
			header("Location:home.php?msg=$msg");
		}
}else{
  header("Location:index.php");
}
}  
?>
