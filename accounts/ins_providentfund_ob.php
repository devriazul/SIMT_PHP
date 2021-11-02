<?php 
ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  	if($_SESSION['userid'])
	{
		$chka="SELECT*FROM  tbl_accdtl WHERE flname='add_providentfund_ob.php' AND userid='$_SESSION[userid]'";
  		$caq=$myDb->select($chka);
  		$car=$myDb->get_row($caq,'MYSQL_ASSOC');
		if($car['ins']=="y")
		{ 
		
			for($i=0;$i<count($_POST['accno']);$i++)
			{
				$accid=$_POST['accno'][$i];
			 	$rcvamount=$_POST['rcvamount'][$i];
				$accname=$_POST['accname'][$i];
				
				//$efname=trim(substr($_POST['accname'][$i],4));
				//$proname="";
				//if(substr($_POST['accname'][$i],0,1)=="E")
				//{
				//	$proname="ESecRcv ".$efname;
				//}
				//elseif(substr($_POST['accname'][$i],0,1)=="F")
				//{
				//	$proname="FSecRcv ".$efname;
				//} 
				
							//---------------Auto hit to accounts for security money-----------------
							$accpfob=$myDb->select("select*from tbl_accchart where accname='Provident Fund Opening Balance'");
							$accpfobf=$myDb->get_row($accpfob,'MYSQL_ASSOC');

							
							$accpf=$myDb->select("select*from tbl_accchart where accname='$accname'");
							$accpff=$myDb->get_row($accpf,'MYSQL_ASSOC');
							
														
							$vid=$myDb->select("SELECT ifnull(count(id),0) mvid FROM tbl_masterjournal WHERE vouchertype='J'");
							$vidf=$myDb->get_row($vid,'MYSQL_ASSOC');
							$maxvid=$vidf['mvid']+1;
							$opdate=date("Y-m-d");
                            $voucherid="JV/-".$opdate."-"."0".$maxvid;													  
							$vexpl="Provident fund opening balance entry.";
							$vgroup=substr($accpfobf['accname'],0,7);

							
							if($accpff['groupname']==0)
		  					{
		    					$groupnamep=$accpff['parentid'];
		  					}else{
		    					$groupnamep=$accpff['groupname'];
		  					}

							if($accpfobf['groupname']==0)
		  					{
		    					$groupnames=$accpfobf['parentid'];
		  					}else{
		    					$groupnames=$accpfobf['groupname'];
		  					}

		  					
							$myDb->insert_sql("INSERT INTO tbl_masterjournal(voucherid,voucherdate,vouchertype,preparedby, paytype,opby,opdate,storedstatus,accountno,voucherexpl, multi_single,voucher_group)	
													VALUES('$voucherid','$opdate','J','$_SESSION[userid]','','$_SESSION[userid]','$opdate','I','$accpfobf[id]','$vexpl','single','$vgroup')");

							$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group)
									VALUES('$accpfobf[id]','$groupnames','$accpfobf[accname]','$rcvamount','0','$voucherid','J','','$opdate','$accpfobf[parentid]','0','I','$_SESSION[userid]','single','$vgroup')");

							$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group)
									VALUES('$accpff[id]','$groupnamep','$accpff[accname]','0','$rcvamount','$voucherid','J','','$opdate','$accpff[parentid]','$accpfobf[id]','I','$_SESSION[userid]','single','$vgroup')");
		  					
							//------------------End of auto hit---------------
				
				
				$myDb->update_sql("UPDATE tbl_accchart SET pftrace='1' WHERE id='$accid'");

			}
			header("Location: add_providentfund_ob.php");

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
