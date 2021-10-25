<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='book_entry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
?> 
<style type="text/css">
.style1 {color: #FFFFFF}
.tbl_repeat td{
    padding:5px;
	border-bottom:1px solid #CCCCCC;
}	
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style3 {font-size: 14px}
.tbl_repeat td{
   border-right:1px solid #999999;

}   
</style>
 <div align="center">
<h2>SAIC GROUP OF INSTITUTIONS<br />
<h4>House-1,Road-2,Block-B,Section-6</h4>
<h4>Mirpur,Dhaka-1216</h4>
Stock Status Report<br />

</h2>
</div>

<table width="90%" border="0" cellspacing="0" cellpadding="0" class="tbl_repeat" style="padding:5px;margin:5px;" >
<tr><td colspan="8"><label>Product Type: </label><?php echo htmlspecialchars($_GET['searchid']); ?></td></tr>
  <tr>
    <td bgcolor="#3366FF"><span class="style5 style1">Product ID </span></td>
    <td height="30" bgcolor="#3366FF"><span class="style5 style1">Product Name</span></td>
    <td height="30" bgcolor="#3366FF"><span class="style5 style1">Requisition Qty</span></td>
    <td height="30" bgcolor="#3366FF"><span class="style5 style1">Approve Qty</span></td>  
    <td height="30" bgcolor="#3366FF"><span class="style5 style1">Purchase Qty</span></td>    
	<td height="30" bgcolor="#3366FF"><span class="style5 style1">Inventory Stock Qty</span></td>
	<td height="30" bgcolor="#3366FF"><span class="style5 style1">Library OV</span></td>
	<td height="30" bgcolor="#3366FF"><span class="style5 style1">Library Stock</span></td>
	<td height="30" bgcolor="#3366FF"><span class="style5 style1">Issue Qty</span></td>
	<td height="30" bgcolor="#3366FF"><span class="style5 style1">Remaining Qty</span></td>
  </tr>

 <?php 
  $pr=$myDb->select("select*from tbl_product  where prtype like '$_GET[searchid]%' and mname='Library' order by pname asc");
  while($prf=$myDb->get_row($pr,'MYSQL_ASSOC')){
  
  $bpr=mysql_query("select id 'Product ID',pname 'Product Name',
                                                                (select ifnull(sum(rqty),0) from tbl_buyproduct where pid='$prf[id]') 'Requisition Qty',
                                                                (select ifnull(sum(aqty),0) from tbl_buyproduct where pid='$prf[id]') 'Approve Qty',
																(select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$prf[id]') 'Purchase Qty',
																(select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$prf[id]' and storeid<>'') 'Inventory Stock Qty',
																(select ifnull(sum(totalbook),0) from tbl_bookentry where bookid=(select bookid from tbl_product where id='$prf[id]')) 'Library OV',
																((select ifnull(sum(totalbook),0) from tbl_bookentry where bookid=(select bookid from tbl_product where id='$prf[id]'))+
																(select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$prf[id]' and storeid<>'')) 'Library Stock'
																,(select ifnull(count(courseid),0) from tbl_bookissue where bookid=(select bookid from tbl_product where id='$prf[id]')
																  AND irstatus='ISSUE') 'Issue Qty',
																(select ifnull(count(courseid),0) from tbl_bookissue where bookid=(select bookid from tbl_product where id='$prf[id]')
																  AND irstatus='RETURN') 'Return Qty',																
																  (((select ifnull(sum(totalbook),0) from tbl_bookentry where bookid=(select bookid from tbl_product where id='$prf[id]'))+
																     (select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$prf[id]' and storeid<>''))
																  -((select ifnull(count(courseid),0) from tbl_bookissue where bookid=(select bookid from tbl_product where id='$prf[id]') AND irstatus='ISSUE'))) 'Remaining Qty'
																
																
																
																
        from tbl_product 
		where id='$prf[id]'
		and mname='Library'
		") or die(mysql_error());
  while($bprf=mysql_fetch_array($bpr)){ 
  ?>

  <tr>
    <td><span class="style8 style2 style3"><?php echo $bprf["Product ID"]; ?></span></td>
    <td height="30"><span class="style8 style2 style3"><?php echo $bprf["Product Name"]; ?></span></td>
    <td height="30"><span class="style8 style2 style3"><?php echo $bprf["Requisition Qty"]; ?></span></td>
    <td height="30"><span class="style8 style2 style3"><?php echo $bprf["Approve Qty"]; ?></span></td>    
    <td height="30"><span class="style8 style2 style3"><?php echo $bprf["Purchase Qty"]; ?></span></td>    
	<td height="30"><span class="style8 style2 style3"><?php echo $bprf["Inventory Stock Qty"]; ?></span></td>
	<td height="30"><span class="style8 style2 style3"><?php echo $bprf["Library OV"]; ?></span></td>
	<td height="30"><span class="style8 style2 style3"><?php echo $bprf["Library Stock"]; ?></span></td>
	<td height="30"><span class="style8 style2 style3"><?php echo $bprf["Issue Qty"]; ?></span></td>
	<td height="30"><span class="style8 style2 style3"><?php echo $bprf["Remaining Qty"]; ?></span></td>
  </tr>
  <?php } }?>
</table>

<?php   
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>