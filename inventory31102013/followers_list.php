<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
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
$per_page = 100;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;
$searchid=$_GET['searchid'];
?>
<script type="text/javascript" src="jquery.js"></script>
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



<div class="data"> 


<table width="80%" border="0" cellspacing="0" cellpadding="0" class="tbl_repeat" style="padding:5px;margin:5px;" >
  <tr>
    <td bgcolor="#3366FF"><span class="style5 style1">Product ID </span></td>
    <td height="30" bgcolor="#3366FF"><span class="style5 style1">Product Name</span></td>
    <td height="30" bgcolor="#3366FF"><span class="style5 style1">Requisition Qty</span></td>
    <td height="30" bgcolor="#3366FF"><span class="style5 style1">Approve Qty</span></td>  
    <td height="30" bgcolor="#3366FF"><span class="style5 style1">Purchase Qty</span></td>    
	<td height="30" bgcolor="#3366FF"><span class="style5 style1">Issue Qty</span></td>
		<td height="30" bgcolor="#3366FF"><span class="style5 style1">Stock Qty</span></td>
		<td height="30" bgcolor="#3366FF"><span class="style5 style1">Remaining Qty</span></td>
  </tr>

  <?php 
  $pr=$myDb->select("select*from tbl_product  where pname like '$_GET[searchid]%' order by pname asc LIMIT $start, $per_page");
  while($prf=$myDb->get_row($pr,'MYSQL_ASSOC')){
  
  $bpr=mysql_query("select id 'Product ID',pname 'Product Name',
                                                                (select sum(rqty) from tbl_buyproduct where pid='$prf[id]') 'Requisition Qty',
                                                                (select sum(aqty) from tbl_buyproduct where pid='$prf[id]') 'Approve Qty',
																(select sum(pqty) from tbl_buyproduct where pid='$prf[id]') 'Purchase Qty',
																(select sum(pqty) from tbl_buyproduct where pid='$prf[id]' and storeid<>'') 'Stock Qty'
																,(select sum(iqty) from tbl_issue where pid='$prf[id]') 'Issue Qty',
																((select sum(pqty) from tbl_buyproduct where pid='$prf[id]' and storeid<>'')-(select sum(iqty) from tbl_issue where pid='$prf[id]')) 'Remaining Qty'
																
																
																
																
        from tbl_product 
		where id='$prf[id]'
		") or die(mysql_error());
  while($bprf=mysql_fetch_array($bpr)){ 
  ?>

  <tr>
    <td><span class="style8 style2 style3"><?php echo $bprf["Product ID"]; ?></span></td>
    <td height="30"><span class="style8 style2 style3"><?php echo $bprf["Product Name"]; ?></span></td>
    <td height="30"><span class="style8 style2 style3"><?php echo $bprf["Requisition Qty"]; ?></span></td>
    <td height="30"><span class="style8 style2 style3"><?php echo $bprf["Approve Qty"]; ?></span></td>    
    <td height="30"><span class="style8 style2 style3"><?php echo $bprf["Purchase Qty"]; ?></span></td>    
	<td height="30"><span class="style8 style2 style3"><?php echo $bprf["Issue Qty"]; ?></span></td>
		<td height="30"><span class="style8 style2 style3"><?php echo $bprf["Stock Qty"]; ?></span></td>
	<td height="30"><span class="style8 style2 style3"><?php echo $bprf["Remaining Qty"]; ?></span></td>
  </tr>
  <?php } }?>
</table>


<?php 
 /* --------------------------------------------- */
 $msg='';
$query_pag_num = "SELECT count(*) AS count
	       FROM tbl_product where pname like '$searchid%'
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
