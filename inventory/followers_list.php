<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='requisition_list.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
if($_GET['page'])
{
$page = $_GET['page'];
$cur_page = $page;
$page -= 1;
$per_page = 20;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;
$searchid=!empty($_POST['searchid'])?mysql_real_escape_string($_POST['searchid']):'';
$stn=$myDb->select("SELECT*FROM tbl_store WHERE storename='$searchid'");
$stnf=$myDb->get_row($stn,'MYSQL_ASSOC');
?>
<script type="text/javascript" src="jquery.js"></script>
<style type="text/css">
@import url("main.css");
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



<div class="data"> 


<table width="80%" border="0" cellspacing="0" cellpadding="0" class="gridTbl" style="padding:5px;margin:0 auto;" >
  <tr>
    <td bgcolor="#3366FF" class="gridTblHead"><span class="style5 style1">Product ID </span></td>
    <td height="30" bgcolor="#3366FF" class="gridTblHead"><span class="style5 style1">Product Name</span></td>
    <td height="30" bgcolor="#3366FF" class="gridTblHead"><span class="style5 style1">Requisition Qty</span></td>
    <td height="30" bgcolor="#3366FF" class="gridTblHead"><span class="style5 style1">Approve Qty</span></td>  
    <td height="30" bgcolor="#3366FF" class="gridTblHead"><span class="style5 style1">Purchase Qty</span></td>  
    <td height="30" bgcolor="#3366FF" class="gridTblHead"><span class="style5 style1">Library OB</span></td>    
    <td height="30" bgcolor="#3366FF" class="gridTblHead"><span class="style5 style1">Library Stock</span></td>    
	<td height="30" bgcolor="#3366FF" class="gridTblHead"><span class="style5 style1">Issue Qty</span></td>
		<td height="30" bgcolor="#3366FF" class="gridTblHead"><span class="style5 style1">Stock Qty</span></td>
		<td height="30" bgcolor="#3366FF" class="gridTblHead"><span class="style5 style1">Remaining Qty</span></td>
  </tr>

  <?php 
  $pr=$myDb->select("select*from tbl_product  where prtype like '$stnf[storeid]%' order by pname asc LIMIT $start, $per_page");
  while($prf=$myDb->get_row($pr,'MYSQL_ASSOC')){
		$stn=$myDb->select("SELECT*FROM tbl_store WHERE storeid='$prf[prtype]'");
		$stnf=$myDb->get_row($stn,'MYSQL_ASSOC');
		if($stnf['storename']!="Library Book"){
			$bpr=mysql_query("select id 'ID',pname 'Product Name',
																	(select ifnull(sum(rqty),0) from tbl_buyproduct where pid='$prf[id]') 'Requisition Qty',
																	(select ifnull(sum(aqty),0) from tbl_buyproduct where pid='$prf[id]') 'Approve Qty',
																	(select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$prf[id]') 'Purchase Qty',
																	(select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$prf[id]' and storeid<>'') 'Stock Qty',ifnull('',0) 'Library OB',ifnull('',0) 'Library Stock'
																	,(select ifnull(sum(iqty),0) from tbl_issue where pid='$prf[id]') 'Issue Qty',
																	((select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$prf[id]' and storeid<>'')-(select ifnull(sum(iqty),0) from tbl_issue where pid='$prf[id]')) 'Remaining Qty'
												from tbl_product 
												where id='$prf[id]'
												order by prtype") or die(mysql_error());
		}else{
			$bpr=mysql_query("select bookid 'ID',pname 'Product Name',
                                                                (select ifnull(sum(rqty),0) from tbl_buyproduct where pid='$prf[id]') 'Requisition Qty',
                                                                (select ifnull(sum(aqty),0) from tbl_buyproduct where pid='$prf[id]') 'Approve Qty',
																(select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$prf[id]') 'Purchase Qty',
																(select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$prf[id]' and storeid<>'') 'Stock Qty',
																(select ifnull(sum(totalbook),0) from tbl_bookentry where bookid=(select bookid from tbl_product where id='$prf[id]')) 'Library OB',
																((select ifnull(sum(totalbook),0) from tbl_bookentry where bookid=(select bookid from tbl_product where id='$prf[id]'))+
																(select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$prf[id]' and storeid<>'')) 'Library Stock'
																,(select ifnull(count(courseid),0) from tbl_bookissue where bookid=(select bookid from tbl_product where id='$prf[id]')
																  AND irstatus<>'RETURN') 'Issue Qty',																
																  (((select ifnull(sum(totalbook),0) from tbl_bookentry where bookid=(select bookid from tbl_product where id='$prf[id]'))+
																     (select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$prf[id]' and storeid<>''))
																  -((select ifnull(count(courseid),0) from tbl_bookissue where bookid=(select bookid from tbl_product where id='$prf[id]') AND irstatus<>'RETURN'))) 'Remaining Qty'
												from tbl_product 
												where id='$prf[id]'
												order by prtype") or die(mysql_error());		
		
		}
  while($bprf=mysql_fetch_array($bpr)){ 
  ?>
  <?php if($stnf['storename']!="Library Book"){ ?>

  <tr>
    <td class="gridTblValue"><span class="style15"><?php echo $bprf["ID"]; ?></span></td>
    <td height="30" class="gridTblValue"><span class="style15"><?php echo $bprf["Product Name"]; ?></span></td>
    <td height="30" class="gridTblValue"><span class="style15"><?php echo $bprf["Requisition Qty"]; ?></span></td>
    <td height="30" class="gridTblValue"><span class="style15"><?php echo $bprf["Approve Qty"]; ?></span></td>    
    <td height="30" class="gridTblValue"><span class="style15"><?php echo $bprf["Purchase Qty"]; ?></span></td>    
    <td height="30" class="gridTblValue"><span class="style15"><?php echo $bprf["Library OB"]; ?></span></td> 
    <td height="30" class="gridTblValue"><span class="style15"><?php echo $bprf["Library Stock"]; ?></span></td> 
	<td height="30" class="gridTblValue"><span class="style15"><?php echo $bprf["Issue Qty"]; ?></span></td>
		<td height="30" class="gridTblValue"><span class="style15"><?php echo $bprf["Stock Qty"]; ?></span></td>
	<td height="30" class="gridTblValue"><span class="style15"><?php echo $bprf["Remaining Qty"]; ?></span></td>
  </tr>
  <?php }else{ ?>
  <tr>
    <td class="gridTblValue"><span class="style15"><?php echo $bprf["ID"]; ?></span></td>
    <td height="30" class="gridTblValue"><span class="style15"><?php echo $bprf["Product Name"]; ?></span></td>
    <td height="30" class="gridTblValue"><span class="style15"><?php echo $bprf["Requisition Qty"]; ?></span></td>
    <td height="30" class="gridTblValue"><span class="style15"><?php echo $bprf["Approve Qty"]; ?></span></td>    
    <td height="30" class="gridTblValue"><span class="style15"><?php echo $bprf["Purchase Qty"]; ?></span></td> 
    <td height="30" class="gridTblValue"><span class="style15"><?php echo $bprf["Library OB"]; ?></span></td> 
    <td height="30" class="gridTblValue"><span class="style15"><?php echo $bprf["Library Stock"]; ?></span></td> 
	<td height="30" class="gridTblValue"><span class="style15"><?php echo $bprf["Issue Qty"]; ?></span></td>
		<td height="30" class="gridTblValue"><span class="style15"><?php echo $bprf["Stock Qty"]; ?></span></td>
	<td height="30" class="gridTblValue"><span class="style15"><?php echo $bprf["Remaining Qty"]; ?></span></td>
  </tr>
  
  <?php } ?>
  
  <?php } }?>
</table>


<?php 
 /* --------------------------------------------- */
 $msg='';
$query_pag_num = "SELECT count(*) AS count
	       FROM tbl_product where prtype like '$stnf[storeid]%' 
";
$result_pag_num = mysql_query($query_pag_num);
$row = mysql_fetch_array($result_pag_num);
$count = $row['count'];
$no_of_paginations = ceil($count / $per_page);

/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
if ($cur_page >= 7) {
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;
    }
} else {
    $start_loop = 1;
    if ($no_of_paginations > 7)
        $end_loop = 7;
    else
        $end_loop = $no_of_paginations;
}
/* ----------------------------------------------------------------------------------------------------------- */
$msg .= "<div class='pagination'><ul>";

// FOR ENABLING THE FIRST BUTTON
if ($first_btn && $cur_page > 1) {
    $msg .= "<li p='1' class='active'>First</li>";
} else if ($first_btn) {
    $msg .= "<li p='1' class='inactive'>First</li>";
}

// FOR ENABLING THE PREVIOUS BUTTON
if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $msg .= "<li p='$pre' class='active'>Previous</li>";
} else if ($previous_btn) {
    $msg .= "<li class='inactive'>Previous</li>";
}
for ($i = $start_loop; $i <= $end_loop; $i++) {

    if ($cur_page == $i)
        $msg .= "<li p='$i' style='color:#fff;background-color:#006699;' class='active'>{$i}</li>";
    else
        $msg .= "<li p='$i' class='active'>{$i}</li>";
}

// TO ENABLE THE NEXT BUTTON
if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $msg .= "<li p='$nex' class='active'>Next</li>";
} else if ($next_btn) {
    $msg .= "<li class='inactive'>Next</li>";
}

// TO ENABLE THE END BUTTON
if ($last_btn && $cur_page < $no_of_paginations) {
    $msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
} else if ($last_btn) {
    $msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
}
//$goto = "<input type='hidden' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='hidden' id='catnp' name='catnp' value='".$_POST[catp]."' />";
//$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
$msg = $msg . "</ul></div>";  // Content for pagination
echo $msg;

?>	 

</div>			


<?php   
    } 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>
