<?php 
ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  	if($_SESSION['userid'])
	{
		$chka="SELECT*FROM  tbl_accdtl WHERE flname='add_securitymoney_rcvlb.php' AND userid='$_SESSION[userid]'";
  		$caq=$myDb->select($chka);
  		$car=$myDb->get_row($caq,'MYSQL_ASSOC');
		if($car['ins']=="y")
		{ 
		
			for($i=0;$i<count($_POST['accno']);$i++)
			{
				$accid=$_POST['accno'][$i];
			 	$rcvamount=$_POST['rcvamount'][$i];
				$accname=$_POST['accname'][$i];
				
				$efname=trim(substr($_POST['accname'][$i],4));
				$secnameR="";
				if(substr($_POST['accname'][$i],0,1)=="E")
				{
					$secnameR="ESecRcv ".$efname;
				}
				elseif(substr($_POST['accname'][$i],0,1)=="F")
				{
					$secnameR="FSecRcv ".$efname;
				} 
				
							//---------------Auto hit to accounts for security money-----------------
							$accsmrcv=$myDb->select("select*from tbl_accchart where accname='$secnameR'");
							$accsmrcvf=$myDb->get_row($accsmrcv,'MYSQL_ASSOC');
							
							
							$accsmcl=$myDb->select("select*from tbl_accchart where accname='$accname'");
							$accsmclf=$myDb->get_row($accsmcl,'MYSQL_ASSOC');
							
							$vid=$myDb->select("SELECT ifnull(count(id),0) mvid FROM tbl_masterjournal WHERE vouchertype='J'");
							$vidf=$myDb->get_row($vid,'MYSQL_ASSOC');
							$maxvid=$vidf['mvid']+1;
							$opdate=date("Y-m-d");
                            $voucherid="JV/-".$opdate."-"."0".$maxvid;													 
							$vexpl="Receivable for Security Money.";
							$vgroup=substr($accsmrcvf['accname'],0,7);

							
							if($accsmrcvf['groupname']==0)
		  					{
		    					$groupnamep=$accsmrcvf['parentid'];
		  					}else{
		    					$groupnamep=$accsmrcvf['groupname'];
		  					}

							if($accsmclf['groupname']==0)
		  					{
		    					$groupnames=$accsmclf['parentid'];
		  					}else{
		    					$groupnames=$accsmclf['groupname'];
		  					}

		  					
							$myDb->insert_sql("INSERT INTO tbl_masterjournal(voucherid,voucherdate,vouchertype,preparedby, paytype,opby,opdate,storedstatus,accountno,voucherexpl, multi_single,voucher_group)	
													VALUES('$voucherid','$opdate','J','$_SESSION[userid]','','$_SESSION[userid]','$opdate','I','$accsmrcvf[id]','$vexpl','single','$vgroup')");

							$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group)
									VALUES('$accsmrcvf[id]','$groupnamep','$accsmrcvf[accname]','$rcvamount','0','$voucherid','J','','$opdate','$accsmrcvf[parentid]','0','I','$_SESSION[userid]','single','$vgroup')");

							$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group)
									VALUES('$accsmclf[id]','$groupnames','$accsmclf[accname]','0','$rcvamount','$voucherid','J','','$opdate','$accsmclf[parentid]','$accsmrcvf[id]','I','$_SESSION[userid]','single','$vgroup')");
		  					
							//------------------End of auto hit---------------
				
				
				$myDb->update_sql("UPDATE tbl_accchart SET srtrace='1' WHERE id='$accid'");

			}
			header("Location: add_securitymoney_rcvlb.php");

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
