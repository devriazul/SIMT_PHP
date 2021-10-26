<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='book_entry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
    if($_GET['page'])
{
$page = $_GET['page'];
$cur_page = $page;
$page -= 1;
$per_page = 10;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;
?>


<script type="text/javascript" src="jquery.js"></script>
<script language="javascript">
  $(document).ready(function(){
	 $('#prtn').click(function(){
		var thePopup = window.open("BookRpt.php?name=<?php echo urlencode($_GET['name']); ?>","Book Issue & Return Information","location=0,titlebar=0,menubar=0,addressbar=no,height=700,width=900","fullscreen=yes" );
			thePopup.print();
		  
		});
 });


</script>

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
			    $('#table_wrapper22').show().css({'padding-bottom':'10px'}).load('edit_bookentry.php?id='+tid);
      			 
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
		//window.location.reload();
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
  position:fixed;
  left:0;
  top:0;
  width:auto;
  height:auto;
  display:none;
  z-index:9999;
  padding:10px;

}

#boxes #dialog {
  width:550px; 
  height:auto;
  padding:10px;
  background-color:#ffffff;

}
#boxes #bdialog {
  width:auto; 
  height:auto;
  padding:5px;
  background-color:#ffffff;

}
#boxes #bedialog {
  width:auto; 
  height:auto;
  padding:5px;
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

<?php 
  
		  $sdq="SELECT b.bookid as id,d.name as 'Department Name',c.coursename 'Course Name',b.author Author,b.edition Edition,b.selfid 'Book Self No',b.rowno 'Row No',b.publisher Publisher,sum(b.totalbook) 'Total Book',b.price Price,b.totalbook*b.price 'Total Cost' 
		        from tbl_bookentry b
				INNER JOIN tbl_courses c
				on b.courseid=c.id
				INNER JOIN tbl_department d
				on c.departmentid=d.id
				group by d.name,c.coursename
				LIMIT $start, $per_page
		  ";
			    $sdep=$myDb->dump_bookquery($sdq,'edit_courseinfo.php','del_libbook.php',$car['upd'],$car['delt']);


?>

<?php 
 /* --------------------------------------------- */
 $msg='';
$query_pag_num = "SELECT COUNT(*) AS count  from tbl_bookentry b
				INNER JOIN tbl_courses c
				on b.courseid=c.id
				INNER JOIN tbl_department d
				on c.departmentid=d.id
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
  header("Location:index.php");
}
}