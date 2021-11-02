<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_attendance.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
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
?>
<script type="text/javascript" src="jquery.js"></script>




<div class="data">


<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" class="gridTbl">
            <tr bgcolor="#DFF4FF">
              <td width="47" height="25" bgcolor="#DFF4FF" class="style11 gridTblHead">ID</td>
              <td width="109" height="25" class="style11 gridTblHead">E/F ID</td>
			   <td width="232" height="25" bgcolor="#DFF4FF" class="style11 gridTblHead">Name</td>
              <td width="90" height="25" class="style11 gridTblHead">In Time </td>
              <td width="250" class="style11 gridTblHead">Delay</td>
              <td width="80" height="25" class="style11 gridTblHead">Type</td>
              <td width="60" class="style11 gridTblHead">Status</td>
            </tr>
			<?php
			      if(isset($_POST['fdate'])){
				    $fdate=mysql_real_escape_string($_POST['fdate']);
				  }
				  if(isset($_POST['tdate'])){
				    $tdate=mysql_real_escape_string($_POST['tdate']);
				  }
			
			      if(!empty($fdate)&&!empty($tdate)){
				  
				  //$std="SELECT id,stdid,stdname,hostel,concat(fname,' / ',mname) parents,img FROM tbl_stdinfo WHERE stdid like '%".$_POST['stdid']."%' and storedstatus<>'D' order by id asc  LIMIT $start, $per_page";
				  $std="SELECT at . * , s.name AS EmpName, a.accname 
				  		FROM  `tbl_attendance` at 
						INNER JOIN  `tbl_staffinfo` s 
						ON at.efid = s.sid 
						INNER JOIN  `tbl_access` a 
						ON at.accid = a.id 
						WHERE at.edate BETWEEN  '$fdate' AND  '$tdate' 
						UNION SELECT at . * , f.name AS FacName, a.accname 
						FROM  `tbl_attendance` at 
						INNER JOIN  `tbl_faculty` f 
						ON at.efid = f.facultyid 
						INNER JOIN  `tbl_access` a 
						ON at.accid = a.id 
						WHERE at.edate BETWEEN  '$fdate' AND  '$tdate'  
						limit $start,$per_page";	
			      }else{ 
				    $std="SELECT at . * , s.name AS EmpName, a.accname 
							FROM  `tbl_attendance` at 
							INNER JOIN  `tbl_staffinfo` s 
							ON at.efid = s.sid 
							INNER JOIN  `tbl_access` a 
							ON at.accid = a.id   
							
							UNION 
							SELECT at . * , f.name AS FacName, a.accname 
							FROM  `tbl_attendance` at 
							INNER JOIN  `tbl_faculty` f 
							ON at.efid = f.facultyid 
							INNER JOIN  `tbl_access` a 
							ON at.accid = a.id   
							limit $start,$per_page
							";
				  }
				  $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){

				  $stdtime="SELECT * FROM tbl_attendancesettings WHERE accid='$stdr[accid]'";	
			      $stdqtime=$myDb->select($stdtime);
				  $stdrtime=$myDb->get_row($stdqtime,'MYSQL_ASSOC');
 				  
				  $t1= new DateTime($stdr['intime']);
				  $t2= new DateTime($stdrtime['stdintime']);
				  $interval = $t2->diff($t1);
				  $a=(int)$interval->format('%i');

//				  $td=date('H:i:s',(strtotime($stdr['intime'])-strtotime($stdrtime['stdintime'])));
//				  $td=strtotime($stdr['intime'])-strtotime($stdrtime['stdintime']);
				
				  
              ?>
			  <tr>
              <td height="25" class="gridTblValue"><?php echo $stdr['id']; ?></td>
              <td height="25" class="gridTblValue"><?php echo $stdr['efid']; ?></td>
              <td height="25" class="gridTblValue"><?php echo $stdr['EmpName']; ?></td>
			  <td height="25" class="gridTblValue"><?php echo $stdr['intime']; ?></td>
              <td class="gridTblValue"><?php echo $interval->format('%H hour(s) %i min(s) %s second(s)');//echo $td; ?></td>
              <td height="25" class="gridTblValue" ><?php echo $stdr['accname']; ?></td>
              <td height="25" class="gridTblValue"><?php if ($a<=$stdrtime['minallow']){ ?> <span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#009966; text-align:center; ">Present</span><?php }else if ($a<=$stdrtime['maxallow']){?><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#FF9966; text-align:center;">Late</span><?php }else{?><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#FF0000; text-align:center;">Absent</span><?php }?></td>
            </tr>
   			<?php } ?>
  </table>

<?php 
 /* --------------------------------------------- */
 $msg='';
$query_pag_num = "SELECT COUNT(*) AS count FROM tbl_attendance";
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