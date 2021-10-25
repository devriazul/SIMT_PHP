<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
	if($_SESSION['userid'])
	{
			$opdate=date("Y-m-d");
			$monthname=$_POST['smonth'];
			$yearname=$_POST['syear'];
			$accname=$_POST['accid'];
			$opby=$_SESSION['userid'];
			
			
			$tr="SELECT * FROM tbl_employeesalary WHERE monthname='$monthname' and yearname='$yearname' and accposting='0'";
			$trq=$myDb->select($tr);
			while($trf=$myDb->get_row($trq,'MYSQL_ASSOC'))
			{
					$netpay=$trf['netpay'];
					$efid=$trf['empid'];
					$efname=$trf['empname'];
					$ptype="";
					if(($trf['bankaccno']=='cash')||($trf['bankaccno']=='Cash'))
					{
						$ptype="Cash";
					}
					else
					{
						$ptype="Bank";
					}
	
	
					
					if($ptype=="Cash")
					{
						//-------------Select Employee/ Faculty Salary Payable Head-------------				
						$cashacc=$myDb->select("Select * from tbl_accchart Where accname='Cash'");
						$cashaccf=$myDb->get_row($cashacc,'MYSQL_ASSOC');
						if($cashaccf['groupname']==0)
						{
							$groupnameB=$cashaccf['parentid'];
						}
						else
						{
							$groupnameB=$cashaccf['groupname'];
						}
						
						//-------------Select Employee/ Faculty Salary Payable Head-------------					
						$sp="";
						if(substr($trf['empid'],0,1)=="E")
						{
							$sp="ESalPay ".$trf['empname'];
						}	
						elseif(substr($trf['empid'],0,1)=="F")
						{
							$sp="FSalPay ".$trf['empname'];
						}
	
						$espacc=$myDb->select("Select * from tbl_accchart Where accname='".$sp."'");
						$espaccf=$myDb->get_row($espacc,'MYSQL_ASSOC');
						if($espaccf['groupname']==0)
						{
							$groupnameA=$espaccf['parentid'];
						}
						else
						{
							$groupnameA=$espaccf['groupname'];
						}
	
						$vid=$myDb->select("SELECT ifnull(count(id),0) mvid FROM tbl_masterjournal WHERE vouchertype='P'");
						$vidf=$myDb->get_row($vid,'MYSQL_ASSOC');
						$maxvid=$vidf['mvid']+1;
						$opdate=date("Y-m-d");
						$vdate=$_POST["voucherdate"];
						$voucherid="PV/-".$opdate."-"."0".$maxvid;													 
						$vexpl="Salary Given to : ".$efname."(".$efid.") for the month of".$monthname.", ".$yearname;
						$vgroup=substr($espaccf['accname'],0,7);
	
								
								
						$myDb->insert_sql("INSERT INTO tbl_masterjournal(voucherid,voucherdate,vouchertype,preparedby, paytype,opby,opdate,storedstatus,accountno,voucherexpl, multi_single,voucher_group) VALUES('$voucherid','$vdate','P','$_SESSION[userid]','$ptype','$_SESSION[userid]','$opdate','I','$espaccf[id]','$vexpl','single','$vgroup')");
						//--------------Start Debit Entry----------------
						$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$espaccf[id]','$groupnameA','$espaccf[accname]','$netpay','0','$voucherid','P','$ptype','$vdate','$espaccf[parentid]','0','I','$_SESSION[userid]','single','$vgroup')");
						//--------------Start Credit Entry----------------
						$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$cashaccf[id]','$groupnameB','$cashaccf[accname]','0','$netpay','$voucherid','P','$ptype','$vdate','$cashaccf[parentid]','$espaccf[id]','I','$_SESSION[userid]','single','$vgroup')");
	
					}	
					elseif($ptype=="Bank")
					{
						//-------------Select Employee/ Faculty Salary Payable Head-------------				
						$bankacc=$myDb->select("Select * from tbl_accchart Where accname='".$accname."'");
						$bankaccf=$myDb->get_row($bankacc,'MYSQL_ASSOC');
						if($bankaccf['groupname']==0)
						{
							$groupnameB=$bankaccf['parentid'];
						}
						else
						{
							$groupnameB=$bankaccf['groupname'];
						}
						
						
						//-------------Select Employee/ Faculty Salary Payable Head-------------					
						$sp="";
						if(substr($trf['empid'],0,1)=="E")
						{
							$sp="ESalPay ".$trf['empname'];
						}	
						elseif(substr($trf['empid'],0,1)=="F")
						{
							$sp="FSalPay ".$trf['empname'];
						}
	
						$espacc=$myDb->select("Select * from tbl_accchart Where accname='".$sp."'");
						$espaccf=$myDb->get_row($espacc,'MYSQL_ASSOC');
						if($espaccf['groupname']==0)
						{
							$groupnameA=$espaccf['parentid'];
						}
						else
						{
							$groupnameA=$espaccf['groupname'];
						}
						$vid=$myDb->select("SELECT ifnull(count(id),0) mvid FROM tbl_masterjournal WHERE vouchertype='P'");
						$vidf=$myDb->get_row($vid,'MYSQL_ASSOC');
						$maxvid=$vidf['mvid']+1;
						$opdate=date("Y-m-d");
						$vdate=$_POST["voucherdate"];
						$voucherid="PV/-".$opdate."-"."0".$maxvid;													 
						$vexpl="Salary Given to : ".$efname."(".$efid.") for the month of".$monthname.", ".$yearname;
						$vgroup=substr($espaccf['accname'],0,7);
	
								
								
						$myDb->insert_sql("INSERT INTO tbl_masterjournal(voucherid,voucherdate,vouchertype,preparedby, paytype,opby,opdate,storedstatus,accountno,voucherexpl, multi_single,voucher_group) VALUES('$voucherid','$vdate','P','$_SESSION[userid]','$ptype','$_SESSION[userid]','$opdate','I','$espaccf[id]','$vexpl','single','$vgroup')");
						//--------------Start Debit Entry----------------
						$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$espaccf[id]','$groupnameA','$espaccf[accname]','$netpay','0','$voucherid','P','$ptype','$vdate','$espaccf[parentid]','0','I','$_SESSION[userid]','single','$vgroup')");
						//--------------Start Credit Entry----------------
						$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$bankaccf[id]','$groupnameB','$bankaccf[accname]','0','$netpay','$voucherid','P','$ptype','$vdate','$bankaccf[parentid]','$espaccf[id]','I','$_SESSION[userid]','single','$vgroup')");
					}	
					$uap="UPDATE tbl_employeesalary SET accposting='1' WHERE id='$trf[id]'";
					$uapq=$myDb->update_sql($uap);
				
			}	
  			echo $msg="Salary for the month of :".$monthname.", ".$yearname." has successfully posted to account.";
  	}	
 	
	else
	{
  		header("Location:index.php");
	}
}  
?>

