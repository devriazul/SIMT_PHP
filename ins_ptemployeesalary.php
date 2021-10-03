<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){ 

	$monthname=mysql_real_escape_string($_POST['smonth']);
	$yearname=mysql_real_escape_string($_POST['syear']);
	$efid=mysql_real_escape_string($_POST['efid']);
	$efname=mysql_real_escape_string($_POST['efname']);
	$desig=mysql_real_escape_string($_POST['desig']);
	$ttc=mysql_real_escape_string($_POST['ttc']);
	$tcr=mysql_real_escape_string($_POST['tcr']);
	$tpc=mysql_real_escape_string($_POST['tpc']);
	$pcr=mysql_real_escape_string($_POST['pcr']);
	$others=mysql_real_escape_string($_POST['otherallow']);
	$remarks=mysql_real_escape_string($_POST['remarks']);
	$netpay=mysql_real_escape_string($_POST['netpay']);
	//$opdate=date("Y-m-d");
	$opdate=$_POST['opdate'];


	$chkd="SELECT * FROM tbl_parttimeemployeesalary WHERE empname='$efname' and monthname='$monthname' and yearname='$yearname'";
	$chkdq=$myDb->select($chkd);
	$chkdf=$myDb->get_row($chkdq,'MYSQL_ASSOC');
	if(!empty($chkdf['empname']))
	{
		echo $msg="Sorry! This Record is already inserted.";
		exit;
	} 
	else
	{
    	$query="INSERT INTO `tbl_parttimeemployeesalary` (`monthname`, `yearname`, `efid`, `empname`, `designation`, `ttclass`, `tpclass`, `tamountpc`, `pamountpc`, `others`, `opby`, `opdate`, `storedstatus`, `remarks`, `netpay`) VALUES ('$monthname', '$yearname', '$efid', '$efname', '$desig', '$ttc', '$tpc', '$tcr', '$pcr', '$others', '$_SESSION[userid]','$opdate','I', '$remarks', '$netpay')";
		
	//-------------------Auto Accounts Hit-----------------------------
							/*$ptype="";
							if(($bankacc=='cash')||($bankacc=='Cash'))
							{
								$ptype="Cash";
							}
							else
							{
								$ptype="Bank";
							}*/

							
							//-------------Select Teacher Salary Head----------
							$tsacc=$myDb->select("Select * from tbl_accchart Where id='1821'");
							$tsaccf=$myDb->get_row($tsacc,'MYSQL_ASSOC');
							if($tsaccf['groupname']==0)
		  					{
		    					$groupnameA=$tsaccf['parentid'];
		  					}
							else
							{
		    					$groupnameA=$tsaccf['groupname'];
		  					}

							//-------------Select Employee/ Faculty Salary Payable Head-------------					
							$sp="FSalPay ".$efname;
							
							$fspacc=$myDb->select("Select * from tbl_accchart Where accname='".$sp."'");
							$fspaccf=$myDb->get_row($fspacc,'MYSQL_ASSOC');
							if($fspaccf['groupname']==0)
		  					{
		    					$groupnameB=$fspaccf['parentid'];
		  					}
							else
							{
		    					$groupnameB=$fspaccf['groupname'];
		  					}
							
							
							$vid=$myDb->select("SELECT ifnull(count(id),0) mvid FROM tbl_masterjournal WHERE vouchertype='J'");
							$vidf=$myDb->get_row($vid,'MYSQL_ASSOC');
							$maxvid=$vidf['mvid']+1;
							//$opdate=date("Y-m-d");
							$opdate=$_POST['opdate'];
                            $voucherid="JV/-".$opdate."-"."0".$maxvid;													 
							$vexpl="Salary Payable for : ".$efname." for the month of".$monthname.", ".$yearname;
							$vgroup=substr($tsaccf['accname'],0,7);

							
		  					
							//--------------Start Debit Entry----------------
							if($netpay!=0)
							{
								$myDb->insert_sql("INSERT INTO tbl_masterjournal(voucherid,voucherdate,vouchertype,preparedby, paytype,opby,opdate,storedstatus,accountno,voucherexpl, multi_single,voucher_group) VALUES('$voucherid','$opdate','J','$_SESSION[userid]','Cash','$_SESSION[userid]','$opdate','I','$tsaccf[id]','$vexpl','multi','$vgroup')");

								//--------------Start Debit Entry----------------
								$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$tsaccf[id]','$groupnameA','$tsaccf[accname]','$netpay','0','$voucherid','J','Cash','$opdate','$tsaccf[parentid]','0','I','$_SESSION[userid]','Single','$vgroup')");
								//--------------Start Credit Entry----------------
								$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$fspaccf[id]','$groupnameB','$fspaccf[accname]','0','$netpay','$voucherid','J','Cash','$opdate','$fspaccf[parentid]','$tsaccf[id]','I','$_SESSION[userid]','Single','$vgroup')");
							}
	
	
	//-------------------End of Auto Accounts Hit-----------------------------
		
		
		
		if($myDb->insert_sql($query))
		{
		   	$msg="Data inserted successfully";
			header("Location:add_ptemployeesalary.php?msg=$msg");
		}else
		{
		   	$msg=$myDb->last_error;
			header("Location:add_ptemployeesalary.php?msg=$msg");
		}   
	}
	

}else{
  header("Location:index.php");
}
}  
?>