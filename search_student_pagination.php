<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_student.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
/*if($_GET['page'])
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
*/
?>
<script type="text/javascript" src="jquery.js"></script>

<script>

$(document).ready(function() {	
	//select all the a tag with name equal to modal

	$('a[name=modal]').click(function(e) {
		//Cancel the link behavior
       
		e.preventDefault();
		//Get the A tag
		var id = $(this).attr('href');
		var tid=$(this).attr('id');
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
			    $('#table_wrapper').load('edq.php?id='+tid);
       
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 
	
	});
	
	//if close button is clicked
	$('.window .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		
		
        // or opener.location.href = opener.location.href;
       // window.close(); // or self.close();
		$('#mask').hide();
		$('.window').hide();
		window.location.reload();
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});			

	$(window).resize(function () {
	 
 		var box = $('#boxes .window');
 
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
      
        //Set height and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});
               
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);
	 
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
</style>


<div class="data">


<table width="700" border="0" cellspacing="0" cellpadding="0" id="stdtbl">
            <tr>
              <td width="74" height="25" bgcolor="#0C6ED1" class="style15 style18">ID</td>
              <td width="99" height="25" bgcolor="#0C6ED1" class="style15 style18">Student ID </td>
			   <td width="35" height="25" bgcolor="#0C6ED1" class="style15 style18"></td>
              <td width="77" height="25" bgcolor="#0C6ED1" class="style15 style18">Student Name </td>
              <td width="61" height="25" bgcolor="#0C6ED1" class="style15 style18">Hostel</td>
              <td width="121" height="25" bgcolor="#0C6ED1" class="style15 style18">Parents</td>
              <td height="25" colspan="4" align="center" bgcolor="#0C6ED1" class="style15 style18">Action</td>
            </tr>
			<?php
			      if(isset($_GET['stdid'])){
				  $std="SELECT id,stdid,stdname,hostel,concat(fname,' / ',mname) parents,img FROM tbl_stdinfo WHERE stdid like '%".$_GET['stdid']."%' and storedstatus<>'D' order by id desc";
			      $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
				  if($count%2==0){
				  $bgcolor="#FFFFFF";
				  ?>
            <tr bgcolor="<?php echo $bgcolor; ?>">
              <td height="25" class="style4"><?php echo $stdr['id']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['stdid']; ?></td>
               <td height="25" class="style4"><img src="uploads/<?php echo $stdr['img']; ?>" width="20" height="20" /></td>
			  <td height="25" class="style4"><?php echo $stdr['stdname']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['hostel']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['parents']; ?></td>
              <td width="50" height="25" align="center" class="style4"><a href="std_accupdate.php?id=<?php echo $stdr['id']; ?>">EDIT</a></td>
              <td width="82" height="25" align="center" class="style4"><a href="del_std.php?id=<?php echo $stdr['id']; ?>" onclick="javascript:return confirm('Do you really want to delete this record')">DELETE</a></td>
              <td width="104" align="center" class="style4"><a onclick="loadXMLDoc('<?php echo $stdr['id']; ?>','<?php echo $count; ?>')" id="aTag<?php echo $count; ?>" href="javascript:toggleAndChangeText(<?php echo $count; ?>);" >EDUCATION &#9658</a> </td>
              <td width="98" align="center" class="style4"><a href="#dialog" name="modal" id="<?php echo $stdr['id']; ?>">ADD EDUCATION</a> </td>
            </tr>
      <tr bgcolor="" id="tbl">
       <td colspan="13"><div id="myDiv<?php echo $count; ?>" style="width:800px;" align="center"></div></td>
      </tr>			<?php }else{ $bgcolor="#F7FCFF"; ?>
            <tr bgcolor="<?php echo $bgcolor; ?>">
              <td height="25" class="style4"><?php echo $stdr['id']; ?></td>
              <td height="25" class="style4" ><?php echo $stdr['stdid']; ?></td>
              <td height="25" class="style4"><img src="uploads/<?php echo $stdr['img']; ?>" width="20" height="20" /></td>
			  <td height="25" class="style4"><?php echo $stdr['stdname']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['hostel']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['parents']; ?></td>
              <td height="25" align="center" class="style4"><a href="std_accupdate.php?id=<?php echo $stdr['id']; ?>">EDIT</a></td>
              <td height="25" align="center" class="style4"><a href="del_std.php?id=<?php echo $stdr['id']; ?>" onclick="javascript:return confirm('Do you really want to delete this record')">DELETE</a></td>
              <td height="25" align="center" class="style4"><a onclick="loadXMLDoc('<?php echo $stdr['id']; ?>','<?php echo $count; ?>')" id="aTag<?php echo $count; ?>" href="javascript:toggleAndChangeText(<?php echo $count; ?>);" >EDUCATION &#9658</a></td>
              <td height="25" align="center" class="style4"><a href="#dialog" name="modal" id="<?php echo $stdr['id']; ?>">ADD EDUCATION</a></td>
            </tr>
      <tr bgcolor="" id="tbl">
       <td colspan="13"><div id="myDiv<?php echo $count; ?>" style="width:800px;" align="center"></div></td>
      </tr>			<?php }
			  $count++;
			  ?>
			<?php }
			      }else{ 
			
				  $std="SELECT id,stdid,stdname,hostel,concat(fname,' / ',mname) parents,img FROM tbl_stdinfo WHERE storedstatus<>'D' order by id desc";
			      $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
				  if($count%2==0){
				  $bgcolor="#FFFFFF";
				  ?>
            <tr bgcolor="<?php echo $bgcolor; ?>">
              <td height="25" class="style4"><?php echo $stdr['id']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['stdid']; ?></td>
              <td height="25" class="style4"><img src="uploads/<?php echo $stdr['img']; ?>" width="20" height="20" /></td>
			  <td height="25" class="style4"><?php echo $stdr['stdname']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['hostel']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['parents']; ?></td>
              <td height="25" align="center" class="style4"><a href="std_accupdate.php?id=<?php echo $stdr['id']; ?>">EDIT</a></td>
              <td height="25" align="center" class="style4"><a href="del_std.php?id=<?php echo $stdr['id']; ?>" onclick="javascript:return confirm('Do you really want to delete this record')">DELETE</a></td>
              <td align="center" class="style4"><a onclick="loadXMLDoc('<?php echo $stdr['id']; ?>','<?php echo $count; ?>')" id="aTag<?php echo $count; ?>" href="javascript:toggleAndChangeText(<?php echo $count; ?>);" >EDUCATION &#9658</a> </td>
              <td align="center" class="style4"><a href="#dialog" name="modal" id="<?php echo $stdr['id']; ?>">ADD EDUCATION</a></td>
            </tr>
      <tr bgcolor="" id="tbl">
       <td colspan="13"><div id="myDiv<?php echo $count; ?>" style="width:800px;" align="center"></div></td>
      </tr>			<?php }else{ $bgcolor="#F7FCFF"; ?>
            <tr bgcolor="<?php echo $bgcolor; ?>">
              <td height="25" class="style4"><?php echo $stdr['id']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['stdid']; ?></td>
               <td height="25" class="style4"><img src="uploads/<?php echo $stdr['img']; ?>" width="20" height="20" /></td>
			  <td height="25" class="style4"><?php echo $stdr['stdname']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['hostel']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['parents']; ?></td>
              <td height="25" align="center" class="style4"><a href="std_accupdate.php?id=<?php echo $stdr['id']; ?>">EDIT</a></td>
              <td height="25" align="center" class="style4"><a href="del_std.php?id=<?php echo $stdr['id']; ?>" onclick="javascript:return confirm('Do you really want to delete this record')">DELETE</a></td>
              <td height="25" align="center" class="style4"><a onclick="loadXMLDoc('<?php echo $stdr['id']; ?>','<?php echo $count; ?>')" id="aTag<?php echo $count; ?>" href="javascript:toggleAndChangeText(<?php echo $count; ?>);" >EDUCATION &#9658</a></td>
              <td height="25" align="center" class="style4"><a href="#dialog" name="modal" id="<?php echo $stdr['id']; ?>">ADD EDUCATION</a></td>
            </tr>
      <tr bgcolor="" id="tbl">
       <td colspan="13"><div id="myDiv<?php echo $count; ?>" style="width:800px;" align="center"></div></td>
      </tr>			<?php }
			  $count++;
			  ?>
			<?php }}
			?>
          </table>

<?php 
 /* --------------------------------------------- */
/* $msg='';
$query_pag_num = "SELECT COUNT(*) AS count FROM tbl_stdinfo";
$result_pag_num = mysql_query($query_pag_num);
$row = mysql_fetch_array($result_pag_num);
$count = $row['count'];
$no_of_paginations = ceil($count / $per_page);

/* ---------------Calculating the starting and endign values for the loop----------------------------------- 
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
/* ----------------------------------------------------------------------------------------------------------- 
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
*/

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
   // } 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.html?msg=$msg");
   }	 

}else{
  header("Location:login.html");
}
}  
?>
