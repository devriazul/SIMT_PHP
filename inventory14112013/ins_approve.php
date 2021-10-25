<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $pid=mysql_real_escape_string($_POST['pid']);
  $rqty=mysql_real_escape_string($_POST['rqty']);
  $id=mysql_real_escape_string($_POST['id']);
  $empid=mysql_real_escape_string($_POST['empid']);
  $aqty=mysql_real_escape_string($_POST['aqty']);
  $appdate=mysql_real_escape_string($_POST['appdate']);
  $pstatus='A';

  if($myDb->update_sql("UPDATE tbl_buyproduct SET 
												  aqty='$aqty',
												  appdate='$appdate',
												  pstatus='$pstatus',
												  appdate='$appdate'
							   WHERE id='$id'")){
?>							   
<table width="700" border="0" cellspacing="0" cellpadding="0" class="tbl_repeat" >
  <tr>
    <td height="30" bgcolor="#3366FF"><span class="style1">PRODUCT ID </span></td>
    <td height="30" bgcolor="#3366FF"><span class="style1">NAME</span></td>
    <td height="30" bgcolor="#3366FF"><span class="style1">EMPLOYEE NAME </span></td>
    <td height="30" bgcolor="#3366FF"><span class="style1">RQTY</span></td>
    <td height="30" bgcolor="#3366FF"><span class="style1">AQTY</span></td>
    <td height="30" bgcolor="#3366FF"><span class="style1">APPROVE DATE </span></td>
  </tr>

  <?php $bpr=mysql_query("select p.id prid,p.pname,e.name 'Employee Name',c.rqty 'Requisition Qty',c.aqty 'Approve Qty',c.appdate 'Approve Date'
        from tbl_product p
        inner join tbl_buyproduct c
		on p.id=c.pid
		inner join tbl_staffinfo e
		on e.id=c.empid
		where c.pstatus='A'") or die(mysql_error());
  while($bprf=mysql_fetch_array($bpr)){ 
  ?>

  <tr>
    <td height="30"><?php echo $bprf["prid"]; ?></td>
    <td height="30"><?php echo $bprf["pname"]; ?></td>
    <td height="30"><?php echo $bprf["Employee Name"]; ?></td>
    <td height="30"><?php echo $bprf["Requisition Qty"]; ?></td>
    <td height="30"><?php echo $bprf["Approve Qty"]; ?></td>
    <td height="30"><?php echo $bprf["Approve Date"]; ?></td>
  </tr>
  <?php } ?>
</table>

<?php 							   
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
