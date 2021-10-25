<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $empid=mysql_real_escape_string($_POST['empid']);
  $pid=mysql_real_escape_string($_POST['pid']);
  $qty=mysql_real_escape_string($_POST['qty']);
  $issuedate=mysql_real_escape_string($_POST['issuedate']);
    
  $pro=$myDb->select("SELECT*FROM tbl_product WHERE id='$pid'");
  $prof=$myDb->get_row($pro,'MYSQL_ASSOC');
  $chk_pr=$myDb->select("SELECT (select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$pid' AND pqty >0 AND pstatus =  'P')pqty,
                                (select ifnull(sum(iqty),0) from tbl_issue where pid='$pid') iqty 
			FROM tbl_buyproduct
			WHERE pid='$pid'
			AND pqty >0
			AND pstatus =  'P'
			");
  $chkprf=$myDb->get_row($chk_pr,'MYSQL_ASSOC');
  $cpr=(intval($chkprf['pqty'])-intval($chkprf['iqty']));

  if($cpr>$qty){
  if($myDb->insert_sql("INSERT INTO tbl_issue(empid,pid,iqty,issue_date)VALUES('$empid','$pid','$qty','$issuedate')")){
?>
<style type="text/css">
<!--
.style5 {color: #FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.style8 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
-->
</style>

<table width="80%" border="0" cellspacing="0" cellpadding="0" class="tbl_repeat" >
  <tr>
    <td bgcolor="#3366FF"><span class="style5">Employee Name</span></td>
    <td bgcolor="#3366FF"><span class="style5">Product ID </span></td>
    <td height="30" bgcolor="#3366FF"><span class="style5">Product Name</span></td>
    <td height="30" bgcolor="#3366FF"><span class="style5">Issue Qty</span></td>
    <td height="30" bgcolor="#3366FF"><span class="style5">Issue Date</span></td>
  </tr>

  <?php 
  $empstring=substr($empid,0,3);
  $fltstring=substr($empid,0,1);
  
  $chkstring=!empty($empstring)?$empstring:$ftlstring;

  if($chkstring=='EMP'){
	  $issql="select p.id 'Product ID',p.pname 'Product Name',e.name 'Employee Name',i.issue_date 'Issue Date',i.iqty 'Issue Qty'
			from tbl_product p ";
  }else{
	  $issql="select p.id 'Product ID',p.pname 'Product Name',f.name 'Employee Name',i.issue_date 'Issue Date',i.iqty 'Issue Qty'
			from tbl_product p ";
  
  }			
		
  $issql.="inner join tbl_issue i
		on p.id=i.pid ";
  if($chkstring=='EMP'){
   $instf="inner join tbl_staffinfo e
		on e.sid=i.empid ";
   $issql.=$instf;		
  }else{		
   $inflt="inner join tbl_faculty f
		on f.facultyid=i.empid ";
   $issql.=$inflt;
  }		
  $cond="where i.empid='$empid'
		and i.issue_date='$issuedate' ";
  $issql.=$cond;
  
  
  //echo $issql;
  //exit;
  $bpr=mysql_query($issql) or die(mysql_error());
  while($bprf=mysql_fetch_array($bpr)){ 
  ?>

  <tr>
    <td><span class="style8"><?php echo $bprf["Employee Name"]; ?></span></td>
    <td><span class="style8"><?php echo $bprf["Product ID"]; ?></span></td>
    <td height="30"><span class="style8"><?php echo $bprf["Product Name"]; ?></span></td>
    <td height="30"><span class="style8"><?php echo $bprf["Issue Qty"]; ?></span></td>
    <td height="30"><span class="style8"><?php echo $bprf["Issue Date"]; ?></span></td>
  </tr>
  <?php } ?>
</table>

<?php 							   
     echo "Product issue successfull";
  }else{
     echo $myDb->last_error;
  }	 	 
}else{
  echo "Stock insufficient";
}  
?>


<?php 
}else{
  header("Location:login.php");
}
}  
?>
