<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $storeid=mysql_real_escape_string($_POST['storeid']);
  $porderid=mysql_real_escape_string($_POST['porderid']);
  
  $chkpo=$myDb->select("SELECT*FROM tbl_purorder WHERE porderid='$porderid' and opby='$_SESSION[userid]' AND usestatus='FINP'");
  $chkpof=$myDb->get_row($chkpo,'MYSQL_ASSOC');
  
  
  $listpr=$myDb->select("SELECT p.*,c.pid,c.pprice,c.id buyid FROM tbl_product p inner join tbl_buyproduct c on p.id=c.pid where c.porderid='$porderid' and c.opby='$_SESSION[userid]'");
  while($listprf=$myDb->get_row($listpr,'MYSQL_ASSOC')){
  
       $acc=$myDb->select("SELECT*FROM tbl_accchart WHERE productid='$listprf[pid]'");
	   $accf=$myDb->get_row($acc,'MYSQL_ASSOC');
  
       $vid=$myDb->select("SELECT cast( ifnull( max( substr( voucherid, -1, 10 ) ) , 0 ) AS signed int ) mvid
																		  FROM tbl_masterjournal
																		  WHERE vouchertype='J'");									                 
													 $vidf=$myDb->get_row($vid,'MYSQL_ASSOC');
													 $maxvid=$vidf['mvid']+1;
                                                     $mvidf="JV/-".date("Y-m-d")."-"."0".$maxvid;	
	   if($myDb->insert_sql("INSERT INTO tbl_masterjournal(voucherid,voucherdate,vouchertype,preparedby,
																									  paytype,opby,opdate,storedstatus,accountno,voucherexpl)
																					VALUES('$mvidf','".date("Y-m-d")."','J',
																						   '$_SESSION[userid]','cash','$_SESSION[userid]',
																						   '".date("Y-m-d")."','I','$accf[id]',
																						   'Journal for inventory purpose')
																	  ")){  }else{ echo $myDb->last_error; }
																	  
	   if($myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,accname,amountdr,amountcr,voucherid,
																							vouchertype,paytype,vdate,masteraccno,
																							storedstatus,opby,parentid,groupname,invid)
																					VALUES('$accf[id]','$accf[accname]','0',
																						   '$listprf[pprice]','$mvidf','J','cash',
																						   '".date("Y-m-d")."','0','I','$_SESSION[userid]',
																						   '1312','1312','$listprf[buyid]')")){  }else{ echo $myDb->last_error; }																  												 
																	  
																	  
	   if($myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,accname,amountdr,amountcr,voucherid,
																							vouchertype,paytype,vdate,masteraccno,
																							storedstatus,opby,parentid,groupname)
																					VALUES('1321','cash','$listprf[pprice]',
																						   '0','$mvidf','J','cash',
																						   '".date("Y-m-d")."','accf[id]','I','$_SESSION[userid]',
																						   '1320','1320')")){  }else{ echo $myDb->last_error; }
																						   																	  												 
   
  }
  
  if($myDb->update_sql("UPDATE tbl_buyproduct SET storeid='$storeid',stock_date='".date("Y-m-d")."'
							   WHERE porderid='$porderid'")){
?>
<style type="text/css">
<!--
.style5 {color: #FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.style8 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
-->
</style>

<table width="99%" border="0" cellspacing="0" cellpadding="0" class="tbl_repeat" >
  <tr>
    <td bgcolor="#3366FF"><span class="style5">SUPPLIER ID </span></td>
    <td bgcolor="#3366FF"><span class="style5">SUPPLIER NAME </span></td>
    <td height="30" bgcolor="#3366FF"><span class="style5">PRODUCT ID </span></td>
    <td height="30" bgcolor="#3366FF"><span class="style5">NAME</span></td>
    <td height="30" bgcolor="#3366FF"><span class="style5">EMPLOYEE NAME </span></td>
    <td height="30" bgcolor="#3366FF"><span class="style5">RQTY</span></td>
    <td height="30" bgcolor="#3366FF"><span class="style5">AQTY</span></td>
    <td bgcolor="#3366FF"><span class="style5">PQTY</span></td>
    <td height="30" bgcolor="#3366FF"><span class="style5">PURCHASE DATE </span></td>
  </tr>

  <?php $bpr=mysql_query("select s.id 'Supplier ID',s.sname 'Supplier Name',p.id prid,p.pname,e.name 'Employee Name',c.rqty 'Requisition Qty',c.aqty 'Approve Qty',c.appdate 'Approve Date',c.pqty 'Purchase Qty',c.pdate 'Purchase Date'
        from tbl_product p
        inner join tbl_buyproduct c
		on p.id=c.pid
		inner join tbl_staffinfo e
		on e.id=c.empid
		inner join tbl_supplier s
		on s.id=c.supid
		inner join tbl_purorder o
		on c.porderid=o.porderid
		where c.pstatus='P'
		and c.porderid='$porderid'
		and o.usestatus='FINP'") or die(mysql_error());
  while($bprf=mysql_fetch_array($bpr)){ 
  ?>

  <tr>
    <td><span class="style8"><?php echo $bprf["Supplier ID"]; ?></span></td>
    <td><span class="style8"><?php echo $bprf["Supplier Name"]; ?></span></td>
    <td height="30"><span class="style8"><?php echo $bprf["prid"]; ?></span></td>
    <td height="30"><span class="style8"><?php echo $bprf["pname"]; ?></span></td>
    <td height="30"><span class="style8"><?php echo $bprf["Employee Name"]; ?></span></td>
    <td height="30"><span class="style8"><?php echo $bprf["Requisition Qty"]; ?></span></td>
    <td height="30"><span class="style8"><?php echo $bprf["Approve Qty"]; ?></span></td>
    <td><span class="style8"><?php echo $bprf["Purchase Qty"]; ?></span></td>
    <td height="30"><span class="style8"><?php echo $bprf["Purchase Date"]; ?></span></td>
  </tr>
  <?php } ?>
</table>

<?php 							   
     echo "Product storing successfull";
  }else{
     echo $myDb->last_error;
  }	 	 

?>


<?php 
}else{
  header("Location:login.php");
}
}  
?>
