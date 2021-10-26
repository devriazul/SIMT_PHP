<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='book_entry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
if($_GET['page'])
{
$page = $_GET['page'];
$cur_page = $page;
$page -= 1;
$per_page = 30;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;
$searchid=!empty($_GET['searchid'])?mysql_real_escape_string($_GET['searchid']):'';
$searchid=urlencode($searchid);
$searchid=str_replace("+"," ",$searchid);
$searchid=substr($searchid,0,strpos($searchid,"-%"));
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
.gridTbl tr td{
  font-size:9px;
}   

</style>



<div class="data"> 


<table width="80%" border="0" cellspacing="0" cellpadding="0" class="gridTbl" style="padding:5px;margin:5px;" >
  <tr class="style2">
    <th bgcolor="#3366FF" class="gridTblHead">Product ID </th>
    <th bgcolor="#3366FF" class="gridTblHead">Book ID </th>
    <th height="30" bgcolor="#3366FF" class="gridTblHead">Product Name</th>
    <th height="30" bgcolor="#3366FF" class="gridTblHead">Requisition Qty</th>
    <th height="30" bgcolor="#3366FF" class="gridTblHead">Approve Qty</th>  
    <th height="30" bgcolor="#3366FF" class="gridTblHead">Purchase Qty</th>    
	<th height="30" bgcolor="#3366FF" class="gridTblHead">Inventory Stock Qty</th>
	<th height="30" bgcolor="#3366FF" class="gridTblHead">Library OB</th>
	<th height="30" bgcolor="#3366FF" class="gridTblHead">Library Stock</th>
	<th height="30" bgcolor="#3366FF" class="gridTblHead">Issue Qty</th>
	<th height="30" bgcolor="#3366FF" class="gridTblHead">Remaining Qty</th>
  </tr>

  <?php 
  $pr=$myDb->select("select*from tbl_product  where prtype='ST012' and courseid in(select id from tbl_courses where departmentid like '$searchid%') order by pname asc LIMIT $start, $per_page");
  while($prf=$myDb->get_row($pr,'MYSQL_ASSOC')){
		  $bpr=mysql_query("select id 'Product ID',bookid 'Book ID',pname 'Product Name',
                                                                (select ifnull(sum(rqty),0) from tbl_buyproduct where pid='$prf[id]') 'Requisition Qty',
                                                                (select ifnull(sum(aqty),0) from tbl_buyproduct where pid='$prf[id]') 'Approve Qty',
																(select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$prf[id]') 'Purchase Qty',
																(select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$prf[id]' and storeid<>'') 'Inventory Stock Qty',
																(select ifnull(sum(totalbook),0) from tbl_bookentry where bookid=(select bookid from tbl_product where id='$prf[id]')) 'Library OB',
																((select ifnull(sum(totalbook),0) from tbl_bookentry where bookid=(select bookid from tbl_product where id='$prf[id]'))+
																(select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$prf[id]' and storeid<>'')) 'Library Stock'
																,(select ifnull(count(courseid),0) from tbl_bookissue where bookid=(select bookid from tbl_product where id='$prf[id]')
																  AND irstatus<>'RETURN') 'Issue Qty',
																(select ifnull(count(courseid),0) from tbl_bookissue where bookid=(select bookid from tbl_product where id='$prf[id]')
																  AND irstatus='RETURN') 'Return Qty',																
																  (((select ifnull(sum(totalbook),0) from tbl_bookentry where bookid=(select bookid from tbl_product where id='$prf[id]'))+
																     (select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$prf[id]' and storeid<>''))
																  -((select ifnull(count(courseid),0) from tbl_bookissue where bookid=(select bookid from tbl_product where id='$prf[id]') AND irstatus<>'RETURN'))) 'Remaining Qty'
							from tbl_product 
							where id='$prf[id]'
							and prtype='ST012'		
							") or die(mysql_error());
  while($bprf=mysql_fetch_array($bpr)){ 
  ?>

  <tr>
    <td class="gridTblValue"><?php echo $bprf["Product ID"]; ?></td>
    <td class="gridTblValue"><?php echo $bprf["Book ID"]; ?></td>
    <td height="30" class="gridTblValue"><?php echo $bprf["Product Name"]; ?></td>
    <td height="30" class="gridTblValue"><?php echo $bprf["Requisition Qty"]; ?></td>
    <td height="30" class="gridTblValue"><?php echo $bprf["Approve Qty"]; ?></td>    
    <td height="30" class="gridTblValue"><?php echo $bprf["Purchase Qty"]; ?></td>    
	<td height="30" class="gridTblValue"><?php echo $bprf["Inventory Stock Qty"]; ?></td>
	<td height="30" class="gridTblValue"><?php echo $bprf["Library OB"]; ?></td>
	<td height="30" class="gridTblValue"><?php echo $bprf["Library Stock"]; ?></td>
	<td height="30" class="gridTblValue"><?php echo $bprf["Issue Qty"]; ?></td>
	<td height="30" class="gridTblValue"><?php echo $bprf["Remaining Qty"]; ?></td>
  </tr>
  <?php } }?>
</table>


<?php 
 /* --------------------------------------------- */
 $msg='';
$query_pag_num = "SELECT count(*) AS count
	       FROM tbl_product where prtype='ST012' and courseid in(select id from tbl_courses where departmentid like '$searchid%')";
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
