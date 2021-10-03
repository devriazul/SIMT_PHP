<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managestaffinfonew.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
   if($_GET['page'])
{
$page = $_GET['page'];
$cur_page = $page;
$page -= 1;
$per_page = 15;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;
$searchid=!empty($_POST['searchid'])?$_POST['searchid']:'';
$searchempid=!empty($_POST['searchempid'])?$_POST['searchempid']:'';
?>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$(function() {
$(".delbutton").unbind().click(function(){
//Save the link in a variable called element
var element = $(this);
//Find the id of the link that was clicked
var del_id = element.attr("id");
//Built a url to send
var info = 'id=' + del_id;
 if(confirm("This will DELETE all the records related with this ID. Are you sure you want to delete the record?"))
 {
 $.ajax({
   type: "GET",
   url: "del_staffinfo.php",
   data: info,
   success: function(){
   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");
 }
return false;
});
});
</script>

<div class="data">
<div align="center">
                  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <?php $t=0;
					  if(!empty($searchid)){
							$pro=mysql_query("select s.*, d.name as designation from tbl_staffinfo s inner join tbl_designation d on s.designationid=d.id where s.name LIKE '$searchid%' and s.storedstatus<>'D' and s.jobstatus='Active' Order by id ASC limit $start,$per_page") or die(mysql_error());					  
					  }else if(!empty($searchempid)){
							$pro=mysql_query("select s.*, d.name as designation from tbl_staffinfo s inner join tbl_designation d on s.designationid=d.id where s.sid LIKE '$searchempid%' and s.storedstatus<>'D' and s.jobstatus='Active' Order by id ASC limit $start,$per_page") or die(mysql_error());					  
					  }else{
							$pro=mysql_query("select s.*, d.name as designation from tbl_staffinfo s inner join tbl_designation d on s.designationid=d.id where s.storedstatus<>'D' and s.jobstatus='Active' Order by id ASC limit $start,$per_page") or die(mysql_error());					  
					  }
					
									$nrow=3;
									while($pfetch=mysql_fetch_array($pro)){
									if($t==$nrow){
									?>
                    <tr class="record">
                      <td ><div align="center">
                        <table width="299" border="0" cellspacing="0" cellpadding="3" style="border:1px solid #e7e7e7; ">
                          <tr>
                            <td width="122" rowspan="5" valign="top"><a href="edit_staffinfo.php?id=<?php echo $pfetch['id']; ?>&amp;sid=<?php echo $pfetch['sid']; ?>">
							<?php if($pfetch['img']<>"") {?>
								<img src="staffphoto/<?php echo $pfetch['img']; ?>"  width="75" height="85" hspace="10" vspace="10" style="border:1px solid #e7e7e7; " />
							<?php }else{?>
								<img src="staffphoto/<?php if($pfetch['sex']=="Male"){?>male.jpg<?php }else if($pfetch['sex']=="Female"){?>female.jpg<?php }?>"  width="75" height="85" hspace="10" vspace="10" style="border:1px solid #e7e7e7; " />
							<?php }?>
							</a></td>
                            <td width="186"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#666666; " ></span>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="72%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#666666; " ><a href="edit_staffinfo.php?id=<?php echo $pfetch['id']; ?>&amp;sid=<?php echo $pfetch['sid']; ?>"><?php echo $pfetch['sid'];?></a></span></td>
                                  <td width="28%"><div align="right"><?php if($car['delt']=="y"){ ?><a href="#" id="<?php echo $pfetch["id"]; ?>" class="delbutton"><img src="images/cross.jpg" style="background:#FFFFFF"/></a><?php }?></div></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#666666; " ><?php echo $pfetch['name'];?></span></td>
                          </tr>
                          <tr>
                            <td><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#666666; font-style:italic; " ><?php echo $pfetch['designation'];?></span></td>
                          </tr>
                          <tr>
                            <td><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#666666; " ><?php echo $pfetch['etype'];?></span></td>
                          </tr>
                          <tr>
                            <td valign="top"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#666666; " ><?php echo $pfetch['cellno'];?></span></td>
                          </tr>
                        </table>
</div>
                          <div align="center"></div></td>
                      <?php $t=1; }else{ ?>
                      <td><div align="center">
                        <table width="299" border="0" cellspacing="0" cellpadding="3" style="border:1px solid #e7e7e7; ">
                          <tr>
                            <td width="122" rowspan="5" valign="top"><a href="edit_staffinfo.php?id=<?php echo $pfetch['id']; ?>&amp;sid=<?php echo $pfetch['sid']; ?>">
							<?php if($pfetch['img']<>"") {?>
								<img src="staffphoto/<?php echo $pfetch['img']; ?>"  width="75" height="85" hspace="10" vspace="10" style="border:1px solid #e7e7e7; " />
							<?php }else{?>
								<img src="staffphoto/<?php if($pfetch['sex']=="Male"){?>male.jpg<?php }else if($pfetch['sex']=="Female"){?>female.jpg<?php }?>"  width="75" height="85" hspace="10" vspace="10" style="border:1px solid #e7e7e7; " />
							<?php }?>
							</a> </td>
                            <td width="186"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#666666; " ></span>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="68%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#666666; " ><a href="edit_staffinfo.php?id=<?php echo $pfetch['id']; ?>&amp;sid=<?php echo $pfetch['sid']; ?>"><?php echo $pfetch['sid'];?></a></span></td>
                                  <td width="32%"><div align="right"><?php if($car['delt']=="y"){ ?><a href="#" id="<?php echo $pfetch["id"]; ?>" class="delbutton"><img src="images/cross.jpg" style="background:#FFFFFF"/></a><?php }?></div></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#666666; " ><?php echo $pfetch['name'];?></span></td>
                          </tr>
                          <tr>
                            <td><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px;  color:#666666;font-style:italic; " ><?php echo $pfetch['designation'];?></span></td>
                          </tr>
                          <tr>
                            <td><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#666666; " ><?php echo $pfetch['etype'];?></span></td>
                          </tr>
                          <tr>
                            <td valign="top"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#666666; " ><?php echo $pfetch['cellno'];?></span></td>
                          </tr>
                        </table>
                        </div>
                          <div align="center"></div></td>
                      <?php 
									$t++;
									}
								}
							?>
                    </tr>
                  </table>
                </div>
	<?php 
 /* --------------------------------------------- */
 $msg='';
$query_pag_num = "SELECT COUNT(*) AS count  
                   from tbl_staffinfo s 
				   inner join tbl_designation d 
				   on s.designationid=d.id 
				   where s.storedstatus<>'D' and s.jobstatus='Active'";
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
  header("Location:index.php");
}
}