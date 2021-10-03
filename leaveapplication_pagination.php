<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_leaveapplication.php' AND userid='$_SESSION[userid]'";
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
?>
<script type="text/javascript" src="jquery.js"></script>


	<link rel="stylesheet" href="js/nyroModal-1.3.0/styles/nyroModal.css" type="text/css" media="screen" />
	<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
	<script src="js/nyroModal-1.3.0/js/jquery.nyroModal-1.3.0.pack.js"></script>   
	<script type="text/javascript" src="js/jquery.simple.tree.js"></script>
	<script type="text/javascript">
	var simpleTreeCollection;	
	$(document).ready(function(){
			
			simpleTreeCollection = $('.simpleTree').simpleTree({
				
				autoclose: false,
				docToFolderConvert: false,
				
				afterClick:function(node){
					// nothing to do for now...
				},
				
				afterDblClick:function(node){
					categoryId = $('span:first',node).parent("li").attr("id");
					parentId = $('span:first',node).parent("li").parent("ul").parent("li").attr("id");

					$.nyroModalManual({
						url: 'update.php?category_id='+categoryId,
						width: 290, // default Width If null, will be calculate automatically
						height: 150, // default Height If null, will be calculate automatically
						minWidth: null, // Minimum width
						minHeight: null, // Minimum height
						endRemove: function() {window.location.reload()}
					});		
	
					return false;
		
				},
				afterMove:function(){	
					var serialStr = "";
					var order = "";
					$("ul.simpleTree li span").each(function(){			
						parentId = $(this).parent("li").parent("ul").parent("li").attr("id");
						if (parentId == undefined) parentId = "root";
						order = (($(this).parent("li").prevAll("li").size()+1))/2; 
						if ( parentId != "root") serialStr += ""+parentId+":"+$(this).parent("li").attr("id")+":"+order+"|";
					});
					$.ajax({
					   type: "POST",
					   url: "saveData.php",
					   data: "serialized="+serialStr,
					   success: function(msg){
					   	 $("#serializedList").html(msg);
					   }
					 });
			
					return false;
					
				},
				docToFolderConvert: false,
				afterAjax:function()
				{
					//alert('Loaded');
				},
				animate:true
			});	
			
			
			
			$(".add_categoryfm").click(function(){
				categoryId = $(this).attr("id");
                var empid=$(this).attr('alt');
       			//var count=$('#count').val();
				//var session=$('#sessionnew').val();
				//var deptid=$('#deptid').val();
				//var courseid=$('#courseid').val();
				//var eyear=$('#eyear').val();
				//var semesterid=$('#semesterid').val();

				$.nyroModalManual({
					url: 'leaveapplication_finalop.php?id='+categoryId +'&empid='+empid,// +'&examname='+examname +'&deptid='+deptid +'&courseid='+courseid +'&eyear='+eyear +'&semesterid='+semesterid,
					width: 650, // default Width If null, will be calculate automatically
					height: 360, // default Height If null, will be calculate automatically
					minWidth: null, // Minimum width
					minHeight: null, // Minimum height
					//endRemove: function() {window.location.reload()}

				});
			});
			
			
			
		});
		</script>





<style>
body {
font-family:verdana;
font-size:15px;
}

a {color:#333; text-decoration:none}
a:hover {color:#ccc; text-decoration:none}

#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#000;
  display:none;
  
}
  
#boxes .window {
  position:absolute;
  left:0;
  top:0;
  width:auto;
  height:auto;
  display:none;
  z-index:9999;
  padding:20px;

}

#boxes #dialog {
  width:auto; 
  height:auto;
  padding:10px;
  background-color:#ffffff;

}

#boxes #dialog1 {
  width:375px; 
  height:203px;
}

#dialog1 .d-header {
  background:url(images/login-header.png) no-repeat 0 0 transparent; 
  width:375px; 
  height:150px;
}
#dialog1 .d-header input {
  position:relative;
  top:60px;
  left:100px;
  border:3px solid #cccccc;
  height:22px;
  width:200px;
  font-size:15px;
  padding:5px;
  margin-top:4px;
}

#dialog1 .d-blank {
  float:left;
  background:url(images/login-blank.png) no-repeat 0 0 transparent; 
  width:267px; 
  height:53px;
}

#dialog1 .d-login {
  float:left;
  width:108px; 
  height:53px;
}

#boxes #dialog2 {
  background:url(images/notice.png) no-repeat 0 0 transparent; 
  width:326px; 
  height:229px;
  padding:50px 0 20px 25px;
}
.style2 {color: #999999}
</style>


<div class="data">


<table width="97%" border="1" cellspacing="0" cellpadding="0" id="stdtbl">
            <tr bgcolor="#DFF4FF">
              <td width="31" height="25" bgcolor="#DFF4FF" class="style15 style18 style2">ID</td>
              <td width="70" height="25" class="style15 style18 style2">E/F ID</td>
			   <td width="146" height="25" bgcolor="#DFF4FF" class="style15 style18 style2">Name</td>
              <td width="78" height="25" class="style15 style18 style2">Desig</td>
              <td width="88" height="25" class="style15 style18 style2">App Date</td>
              <td width="56" height="25" class="style15 style18 style2">L.Type</td>
              <td width="89" class="style15 style18 style2">F Date</td>
              <td width="88" class="style15 style18 style2">T Date</td>
              <td width="88" class="style15 style18 style2">Reason</td>
              <td width="88" class="style15 style18 style2">Status</td>
              <td height="25" align="center" class="style15 style18 style2">Action</td>
            </tr>
			<?php
			      if(isset($_POST['fdate'])){
				  //$std="SELECT id,stdid,stdname,hostel,concat(fname,' / ',mname) parents,img FROM tbl_stdinfo WHERE stdid like '%".$_POST['stdid']."%' and storedstatus<>'D' order by id asc  LIMIT $start, $per_page";
				  $std="Select id ,empid ,name as Name,designation as Designation,applyfor as ApplyFor,applydate as ApplyDate,frmdate as FromDate,todate as ToDate,reason as Reason,status as Status from tbl_leaveapplication Where applydate between '$_POST[fdate]' and '$_POST[tdate]' and storedstatus<>'D' order by id desc limit $start,$per_page";	
			      $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
				  if($count%2==0){
				  $bgcolor="#FFFFFF";
				  ?>
            <tr bgcolor="<?php echo $bgcolor; ?>">
              <td height="25" class="style4"><?php echo $stdr['id']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['empid']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['Name']; ?></td>
			  <td height="25" class="style4"><?php echo $stdr['Designation']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ApplyDate']; ?></td>
              <td height="25" class="style4" ><?php echo $stdr['ApplyFor']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['FromDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ToDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['Reason']; ?></td>
			
              <td height="25" class="style4"><?php if ($stdr['Status']=="Accepted"){ ?> <span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#009966; text-align:center; "><?php echo $stdr['Status']; ?></span><?php }else if ($stdr['Status']=="Rejected"){?><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#FF0000; text-align:center;"><?php echo $stdr['Status']; ?></span><?php }else{?><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#000000; text-align:center;"><?php echo $stdr['Status']; ?></span><?php }?></td>
              <td width="54" height="25" align="center" class="style4"><?php if ($stdr['Status']=="Pending"){ ?><a alt="<?php echo $stdr['empid']; ?>" class="add_categoryfm" id="<?php echo $stdr['id'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#000000; " >EDIT</span></a><?php }else{?><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#000000; " >EDIT</span><?php }?></td>
            </tr>
      <tr bgcolor="" id="tbl">
       <td colspan="14"><div id="myDiv<?php echo $count; ?>" style="width:800px;" align="center"></div></td>
      </tr>			<?php }else{ $bgcolor="#F7FCFF"; ?>
            <tr bgcolor="<?php echo $bgcolor; ?>">
              <td height="25" class="style4"><?php echo $stdr['id']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['empid']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['Name']; ?></td>
			  <td height="25" class="style4"><?php echo $stdr['Designation']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ApplyDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ApplyFor']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['FromDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ToDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['Reason']; ?></td>
              <td height="25" class="style4"><?php if ($stdr['Status']=="Accepted"){ ?> <span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#009966; text-align:center; "><?php echo $stdr['Status']; ?></span><?php }else if ($stdr['Status']=="Rejected"){?><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#FF0000; text-align:center;"><?php echo $stdr['Status']; ?></span><?php }else{?><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#000000; text-align:center;"><?php echo $stdr['Status']; ?></span><?php }?></td>
              <td width="54" height="25" align="center" class="style4"><?php if ($stdr['Status']=="Pending"){ ?><a alt="<?php echo $stdr['empid']; ?>" class="add_categoryfm" id="<?php echo $stdr['id'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#000000; " >EDIT</span></a><?php }else{?><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#000000; " >EDIT</span><?php }?></td>
            </tr>
      <tr bgcolor="" id="tbl">
       <td colspan="14"><div id="myDiv<?php echo $count; ?>" style="width:800px;" align="center"></div></td>
      </tr>			<?php }
			  $count++;
			  ?>
			<?php }
			      }else{ 
			
				  $std="Select id ,empid ,name as Name,designation as Designation,applyfor as ApplyFor,applydate as ApplyDate,frmdate as FromDate,todate as ToDate,reason as Reason,status as Status from tbl_leaveapplication Where storedstatus<>'D' order by id desc limit $start,$per_page";	
			      $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
				  if($count%2==0){
				  $bgcolor="#FFFFFF";
				  ?>
            <tr bgcolor="<?php echo $bgcolor; ?>">
              <td height="25" class="style4"><?php echo $stdr['id']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['empid']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['Name']; ?></td>
			  <td height="25" class="style4"><?php echo $stdr['Designation']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ApplyDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ApplyFor']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['FromDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ToDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['Reason']; ?></td>
              <td height="25" class="style4"><?php if ($stdr['Status']=="Accepted"){ ?> <span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#009966; text-align:center; "><?php echo $stdr['Status']; ?></span><?php }else if ($stdr['Status']=="Rejected"){?><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#FF0000; text-align:center;"><?php echo $stdr['Status']; ?></span><?php }else{?><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#000000; text-align:center;"><?php echo $stdr['Status']; ?></span><?php }?></td>
              <td width="54" height="25" align="center" class="style4"><?php if ($stdr['Status']=="Pending"){ ?><a alt="<?php echo $stdr['empid']; ?>" class="add_categoryfm" id="<?php echo $stdr['id'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#000000; " >EDIT</span></a><?php }else{?><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#000000; " >EDIT</span><?php }?></td>
            </tr>
      <tr bgcolor="" id="tbl">
       <td colspan="14"><div id="myDiv<?php echo $count; ?>" style="width:800px;" align="center"></div></td>
      </tr>			<?php }else{ $bgcolor="#F7FCFF"; ?>
            <tr bgcolor="<?php echo $bgcolor; ?>">
              <td height="25" class="style4"><?php echo $stdr['id']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['empid']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['Name']; ?></td>
			  <td height="25" class="style4"><?php echo $stdr['Designation']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ApplyDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ApplyFor']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['FromDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ToDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['Reason']; ?></td>
              <td height="25" class="style4"><?php if ($stdr['Status']=="Accepted"){ ?> <span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#009966; text-align:center; "><?php echo $stdr['Status']; ?></span><?php }else if ($stdr['Status']=="Rejected"){?><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#FF0000; text-align:center;"><?php echo $stdr['Status']; ?></span><?php }else{?><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#000000; text-align:center;"><?php echo $stdr['Status']; ?></span><?php }?></td>
              <td width="54" height="25" align="center" class="style4"><?php if ($stdr['Status']=="Pending"){ ?><a alt="<?php echo $stdr['empid']; ?>" class="add_categoryfm" id="<?php echo $stdr['id'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#000000; " >EDIT</span></a><?php }else{?><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#000000; " >EDIT</span><?php }?></td>
            </tr>
      <tr bgcolor="" id="tbl">
       <td colspan="14"><div id="myDiv<?php echo $count; ?>" style="width:800px;" align="center"></div></td>
      </tr>			<?php }
			  $count++;
			  ?>
			<?php }}
			?>
  </table>

<?php 
 /* --------------------------------------------- */
 $msg='';
$query_pag_num = "SELECT COUNT(*) AS count FROM tbl_leaveapplication";
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
<div id="boxes">

       <div id="dialog" class="window">
        
       <a href="#" class="close" style="margin-left:650px;">X</a>

       <div id="table_wrapper"></div>


     </div>
</div>
  <div id="mask"></div>

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
?>
