<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $pid=mysql_real_escape_string($_POST['pid']);
  $supid=mysql_real_escape_string($_POST['supid']);
  $rqty=mysql_real_escape_string($_POST['rqty']);
  $id=mysql_real_escape_string($_POST['id']);
  $empid=mysql_real_escape_string($_POST['empid']);
  $aqty=mysql_real_escape_string($_POST['aqty']);
  $pqty=mysql_real_escape_string($_POST['pqty']);
  $pdate=mysql_real_escape_string($_POST['pdate']);
  $pprice=mysql_real_escape_string($_POST['pprice']);
  $pstatus='P';
  
  $chkpo=$myDb->select("SELECT*FROM tbl_purorder WHERE opby='$_SESSION[userid]' AND usestatus='INU'");
  $chkpof=$myDb->get_row($chkpo,'MYSQL_ASSOC');
  
  if($myDb->update_sql("UPDATE tbl_buyproduct SET pid='$pid',
                                                  supid='$supid',
												  rqty='$rqty',
												  empid='$empid',
												  aqty='$aqty',
												  pqty='$pqty',
												  pdate='$pdate',
												  pstatus='$pstatus',
												  porderid='$chkpof[porderid]',
												  pprice='$pprice'
							   WHERE id='$id'")){
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
		and c.porderid='$chkpof[porderid]'
		and o.usestatus='INU'") or die(mysql_error());
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
     echo "Purchase Product successfully";
  }else{
     echo $myDb->last_error;
  }	 	 

?>


<?php 
}else{
  header("Location:index.php");
}
}  
?>
