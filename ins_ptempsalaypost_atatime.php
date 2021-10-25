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
			
			
			$tr="SELECT * FROM tbl_parttimeemployeesalary WHERE monthname='$monthname' and yearname='$yearname' and accposting='0'";
			$trq=$myDb->select($tr);
			while($trf=$myDb->get_row($trq,'MYSQL_ASSOC'))
			{
					$netpay=$trf['netpay'];//($trf['ttclass']*$trf['ttclass'])+($trf['tpclass']*$trf['pamountpc']);
					$efname=$trf['empname'];
					$ptype="Cash";
	
	
					
					if($ptype=="Cash")
					{
						//-------------Select Cash Head-------------				
						$cashacc=$myDb->select("Select * from tbl_accchart Where accname='".$accname."'");
						$cashaccf=$myDb->get_row($cashacc,'MYSQL_ASSOC');
						if($cashaccf['groupname']==0)
						{
							$groupnameA=$cashaccf['parentid'];
						}
						else
						{
							$groupnameA=$cashaccf['groupname'];
						}
						
						//-------------Select Employee/ Faculty Salary Payable Head-------------					
						$sp="FSalPay ".$trf['empname'];
						
	
						$espacc=$myDb->select("Select * from tbl_accchart Where accname='".$sp."'");
						$espaccf=$myDb->get_row($espacc,'MYSQL_ASSOC');
						if($espaccf['groupname']==0)
						{
							$groupnameB=$espaccf['parentid'];
						}
						else
						{
							$groupnameB=$espaccf['groupname'];
						}
	
						$vid=$myDb->select("SELECT ifnull(count(id),0) mvid FROM tbl_masterjournal WHERE vouchertype='P'");
						$vidf=$myDb->get_row($vid,'MYSQL_ASSOC');
						$maxvid=$vidf['mvid']+1;
						$opdate=date("Y-m-d");
						$vdate=$_POST["voucherdate"];
						$voucherid="PV/-".$opdate."-"."0".$maxvid;													 
						$vexpl="Salary Given to : ".$efname." for the month of".$monthname.", ".$yearname;
						$vgroup=substr($espaccf['accname'],0,7);
	
								
								
						$myDb->insert_sql("INSERT INTO tbl_masterjournal(voucherid,voucherdate,vouchertype,preparedby, paytype,opby,opdate,storedstatus,accountno,voucherexpl, multi_single,voucher_group) VALUES('$voucherid','$vdate','P','$_SESSION[userid]','$ptype','$_SESSION[userid]','$opdate','I','$espaccf[id]','$vexpl','single','$vgroup')");
						//--------------Start Debit Entry----------------
						$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$espaccf[id]','$groupnameB','$espaccf[accname]','$netpay','0','$voucherid','P','$ptype','$vdate','$espaccf[parentid]','0','I','$_SESSION[userid]','single','$vgroup')");
						//--------------Start Credit Entry----------------
						$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$cashaccf[id]','$groupnameA','$cashaccf[accname]','0','$netpay','$voucherid','P','$ptype','$vdate','$cashaccf[parentid]','$espaccf[id]','I','$_SESSION[userid]','single','$vgroup')");
	
					}	
					$uap="UPDATE tbl_parttimeemployeesalary SET accposting='1' WHERE id='$trf[id]'";
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

