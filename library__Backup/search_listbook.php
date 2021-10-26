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
    
?>

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
			    $('#table_wrapper33').show().load('edit_bookentry.php?id='+tid);
                $('#table_wrapper22').hide();
				 $('#table_wrapper').hide();
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
  width:auto; 
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
<script language="javascript">
$(document).ready(function(){  
  $('a[name=isbook]').click(function(e){
	  e.preventDefault();
	  var id=$(this).attr('id');
	  var deptid=$(this).attr('alt');
	  $('#return'+id).css({'display':'none'});
	  var isid=$('#issue'+id).attr('id');
	  $('#issue'+id).toggle('slow');
	 $('#issue'+id).load('book_issue.php?rowid='+id+'&deptid='+deptid);
	  
	 
    });	  
	
	 $('a[name=isreturn]').click(function(e){
	  e.preventDefault();
	 
	  var id=$(this).attr('id'); 
	  var deptid=$(this).attr('alt');
	  $('#issue'+id).css({'display':'none'});
	  var isid=$('#return'+id).attr('id');
	  $('#return'+id).toggle('slow');
	  $('#return'+id).load('book_return.php?rowid='+id+'&deptid='+deptid);
	  
	 
    });	  
});
</script>


<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; padding-left:10px; width:300px; float:right; ">[Esc->List View || Shift+F1->Book Entery Form]</div><br/>

<?php 
         switch($_POST['listb']){
		   case 'department':
				  $sdq="SELECT b.bookid as id,d.name as 'Department Name',b.deptid,c.coursename 'Course Name',b.author Author,b.edition Edition,b.totalbook 'Total Book',b.selfid 'Book Self No',b.rowno 'Row No' 
						from tbl_bookentry b
						INNER JOIN tbl_courses c
						on b.courseid=c.id
						INNER JOIN tbl_department d
						on c.departmentid=d.id
						where d.name like '$_POST[crsname]%'
						order by c.coursename
						
				  ";
						$sdep=$myDb->dump_searchbookquery($sdq,'','','y','');
		         break;	
			case 'author':
				  $sdq="SELECT b.bookid as id,d.name as 'Department Name',b.deptid,c.coursename 'Course Name',b.author Author,b.edition Edition,b.totalbook 'Total Book',b.selfid 'Book Self No',b.rowno 'Row No' 
						from tbl_bookentry b
						INNER JOIN tbl_courses c
						on b.courseid=c.id
						INNER JOIN tbl_department d
						on c.departmentid=d.id
						where b.author like '$_POST[crsname]%'
						order by c.coursename
						
				  ";
						$sdep=$myDb->dump_searchbookquery($sdq,'','','y','');
		         break;	
			case 'course':
				  $sdq="SELECT b.bookid as id,d.name as 'Department Name',b.deptid,c.coursename 'Course Name',b.author Author,b.edition Edition,b.totalbook 'Total Book',b.selfid 'Book Self No',b.rowno 'Row No' 
						from tbl_bookentry b
						INNER JOIN tbl_courses c
						on b.courseid=c.id
						INNER JOIN tbl_department d
						on c.departmentid=d.id
						where c.coursename like '$_POST[crsname]%'
						order by c.coursename
						
				  ";
						$sdep=$myDb->dump_searchbookquery($sdq,'','','y','');
		         break;	
		    default:
				  $sdq="SELECT b.bookid as id,d.name as 'Department Name',b.deptid,c.coursename 'Course Name',b.author Author,b.edition Edition,b.totalbook 'Total Book',b.selfid 'Book Self No',b.rowno 'Row No' 
						from tbl_bookentry b
						INNER JOIN tbl_courses c
						on b.courseid=c.id
						INNER JOIN tbl_department d
						on c.departmentid=d.id
						order by c.coursename
						
				  ";
						$sdep=$myDb->dump_searchbookquery($sdq,'','','y','');
		 }


?>


<?php 


   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}