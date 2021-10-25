<?php ob_start();
session_start();
require_once('dbClass.php');
require_once('class/productfilter.class.php');
include("config.php"); 
//$pft=new ProductFilter();
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $reqid=mysql_real_escape_string($_GET['reqid']);
  $supid=mysql_real_escape_string($_GET['supid']);
  $sname=mysql_real_escape_string($_GET['sname']);
  $accname=mysql_real_escape_string($_GET['accid']);
  $pamount=mysql_real_escape_string($_GET['pamount']);
  
  
  $chkst=$myDb->select("Select * from tbl_buyproduct Where reqid='$reqid' and pstatus='P' and accposting='0'");
  $chkstf=$myDb->get_row($chkst,'MYSQL_ASSOC');
  if(!empty($chkstf['id']))
  {
  $chkpp=$myDb->select("select (select count(*) totalAP from tbl_buyproduct where reqid='$reqid') totalRPP,
  						(select count(*) totalAP from tbl_buyproduct where reqid='$reqid' and pstatus='P') totalPP  
  						from tbl_buyproduct where reqid='$reqid'
						");
  $chkppf=$myDb->get_row($chkpp,'MYSQL_ASSOC');
  if($chkppf['totalRPP']==$chkppf['totalPP']){
	  $tp="SELECT ifnull(SUM(pqty * pprice),0) as TotalPrice FROM tbl_buyproduct WHERE reqid='$reqid' and pstatus='P'";
	  $tpq=$myDb->select($tp);
	  $tpf=$myDb->get_row($tpq,'MYSQL_ASSOC');
	  
	  /*
  //----------Start Auto Hit to accounts-------------
						$ptype="";
						if($accname=="Cash")
						{
							$ptype="Cash";
						}
						elseif($accname=="Select Account Head")
						{
							$ptype="Credit";
						}
						else
						{
							$ptype="Bank";
						}
						//-------------Select Purchase Expense Head-------------				
						$puracc=$myDb->select("Select * from tbl_accchart Where accname='Purchase'");
						$puraccf=$myDb->get_row($puracc,'MYSQL_ASSOC');
						if($puraccf['groupname']==0)
						{
							$groupnameA=$puraccf['parentid'];
						}
						else
						{
							$groupnameA=$puraccf['groupname'];
						}
						
						//-------------Select Accounts Payable(/Supplier) Head-------------	
									
						$supacc=$myDb->select("Select * from tbl_accchart Where accname='$sname'");
						$supaccf=$myDb->get_row($supacc,'MYSQL_ASSOC');
						if($supaccf['groupname']==0)
						{
							$groupnameB=$supaccf['parentid'];
						}
						else
						{
							$groupnameB=$supaccf['groupname'];
						}
						

						//-------------Select Cash/Bank Head-------------					
	
						$cbacc=$myDb->select("Select * from tbl_accchart Where accname='$accname'");
						$cbaccf=$myDb->get_row($cbacc,'MYSQL_ASSOC');
						if($cbaccf['groupname']==0)
						{
							$groupnameC=$cbaccf['parentid'];
						}
						else
						{
							$groupnameC=$cbaccf['groupname'];
						}
	
						//-------------Select Re-agent Head-------------					
	
						$raacc=$myDb->select("Select * from tbl_accchart Where accname='Reagent'");
						$raaccf=$myDb->get_row($raacc,'MYSQL_ASSOC');
						if($raaccf['groupname']==0)
						{
							$groupnameD=$raaccf['parentid'];
						}
						else
						{
							$groupnameD=$raaccf['groupname'];
						}

							
						//----------------------For Purchase-------------------------
						$vid=$myDb->select("SELECT ifnull(count(id),0) mvid FROM tbl_masterjournal WHERE vouchertype='P'");
						$vidf=$myDb->get_row($vid,'MYSQL_ASSOC');
						$maxvid=$vidf['mvid']+1;
						$opdate=date("Y-m-d");
						$voucherid="PV/-".$opdate."-"."0".$maxvid;													 
						$vexpl="Product Purchase From : ".$sname;
						$vgroup=substr($puraccf['accname'],0,7);

						$myDb->insert_sql("INSERT INTO tbl_masterjournal(voucherid,voucherdate,vouchertype,preparedby, paytype,opby,opdate,storedstatus,accountno,voucherexpl, multi_single,voucher_group) VALUES('$voucherid','$opdate','P','$_SESSION[userid]','$ptype','$_SESSION[userid]','$opdate','I','$puraccf[id]','$vexpl','single','$vgroup')");
						//--------------Start Debit Entry----------------
						$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$puraccf[id]','$groupnameA','$puraccf[accname]','$tpf[TotalPrice]','0','$voucherid','P','$ptype','$opdate','$puraccf[parentid]','0','I','$_SESSION[userid]','single','$vgroup')");
						
						
						//--------------Start Credit Entry----------------
						if($pamount>0)
						{
							$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$cbaccf[id]','$groupnameC','$cbaccf[accname]','0','$pamount','$voucherid','P','$ptype','$opdate','$cbaccf[parentid]','$puraccf[id]','I','$_SESSION[userid]','single','$vgroup')");
						}
						$ramount=$tpf['TotalPrice']-$pamount;
						if($ramount>0)
						{
							$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$supaccf[id]','$groupnameB','$supaccf[accname]','0','$ramount','$voucherid','P','$ptype','$opdate','$supaccf[parentid]','$puraccf[id]','I','$_SESSION[userid]','single','$vgroup')");
						}

						//----------------------For Store Posting-------------------------
						
						$vid=$myDb->select("SELECT ifnull(count(id),0) mvid FROM tbl_masterjournal WHERE vouchertype='J'");
						$vidf=$myDb->get_row($vid,'MYSQL_ASSOC');
						$maxvid=$vidf['mvid']+1;
						$opdate=date("Y-m-d");
						$voucherid="JV/-".$opdate."-"."0".$maxvid;													 
						$vexpl="Product Posted to Stock on : ".$opdate;
						$vgroup=substr($puraccf['accname'],0,7);

						
						$myDb->insert_sql("INSERT INTO tbl_masterjournal(voucherid,voucherdate,vouchertype,preparedby, paytype,opby,opdate,storedstatus,accountno,voucherexpl, multi_single,voucher_group) VALUES('$voucherid','$opdate','J','$_SESSION[userid]','$ptype','$_SESSION[userid]','$opdate','I','$raaccf[id]','$vexpl','single','$vgroup')");
						//--------------Start Debit Entry----------------
						$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$raaccf[id]','$groupnameD','$raaccf[accname]','$tpf[TotalPrice]','0','$voucherid','J','$ptype','$opdate','$raaccf[parentid]','0','I','$_SESSION[userid]','single','$vgroup')");
						//--------------Start Credit Entry----------------
						$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$puraccf[id]','$groupnameA','$puraccf[accname]','0','$tpf[TotalPrice]','$voucherid','J','$ptype','$opdate','$puraccf[parentid]','$raaccf[id]','I','$_SESSION[userid]','single','$vgroup')");
             
			 			echo "<div style='width:100%; height:25px;padding:5px; background-color:#999999;color:#ffffff; font-weight:bold;' align='center'>All the transactions are successfully hit to account.</div>";
//-----------------End of Auto Hit--------------
*/
			}
			$updst="UPDATE tbl_buyproduct SET accposting='1' WHERE reqid='$reqid' and pstatus='P'";
			$myDb->update_sql($updst);
	}
?>


<?php 
}else{
  header("Location:index.php");
}
}