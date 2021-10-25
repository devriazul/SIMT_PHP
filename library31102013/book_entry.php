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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<style type="text/css">

@import url("library.css");
@import url("main.css");
.style12 {font-size: 10px}
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style16 {font-size: 12px}

</style>


<script type="text/javascript" src="jquery-latest.pack.js"></script>
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
			    $('#table_wrapper').load('edit_settings.php?id='+tid);
       
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

<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
<script language type="text/javascript"> 
function handleEnter (field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
			i = (i + 1) % field.form.elements.length;
			field.form.elements[i].focus();
			return false;
		} 
		else
		return true;
	}      
</script>



<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>

<script language="javascript">
$(document).ready(function(){
  $('#book').css({'font-size':'12px'});
  $('#book-list').css({'display':'none'});
  $('#courseid').css({'font-family':'Verdana, Arial, Helvetica, sans-serif'}).css({'font-size':'12px'});
  $('#deptid').css({'font-family':'Verdana, Arial, Helvetica, sans-serif'}).css({'font-size':'12px'});
  $('#selfid').css({'font-family':'Verdana, Arial, Helvetica, sans-serif'}).css({'font-size':'12px'});
  $('#isbnno').css({'font-family':'Verdana, Arial, Helvetica, sans-serif'}).css({'font-size':'12px'});
  $('#author').css({'font-family':'Verdana, Arial, Helvetica, sans-serif'}).css({'font-size':'12px'});
  $('#publisher').css({'font-family':'Verdana, Arial, Helvetica, sans-serif'}).css({'font-size':'12px'});
  $('#edition').css({'font-family':'Verdana, Arial, Helvetica, sans-serif'}).css({'font-size':'12px'});
  $('#price').css({'font-family':'Verdana, Arial, Helvetica, sans-serif'}).css({'font-size':'12px'});
  $('#button-big').css({'font-family':'Verdana, Arial, Helvetica, sans-serif'}).css({'font-size':'12px'}).css({'margin-left':'10px'});
  $('#men').css({'font-family':'Verdana, Arial, Helvetica, sans-serif'}).css({'font-size':'12px'}).css({'font-weight':'bold'}).css({'color':'#999999'}).css({'border':'1px solid #999999'});
  $('#men').css({'background-color':'#CCCCCC'}).css({'padding':'10px'});
  $('#list-book').css({'font-family':'Verdana, Arial, Helvetica, sans-serif'}).css({'font-size':'12px'}).css({'font-weight':'bold'}).css({'color':'#999999'}).css({'border':'1px solid #999999'}).css({'padding':'10px'});
  
  $('#selfid').change(function(){  
     var sid=$('#selfid').val();
    $.get('showrow.php?id='+sid,function(data){
	   $('#rss').css({'width':'120px'});
	   $('#rss').html('<img src=loader.gif>');
	   $('#rss').fadeOut();
	   $('#rs').css({'float':'right'});
	   $('#rs').hide().html(data).fadeIn().css({'width':'auto'});
	   $('#noofrow').css({'border':'1px solid #999999'}).css({'color':'#666666'}).css({'font-family':'Verdana, Arial, Helvetica, sans-serif'}).css({'font-size':'12px'});;
	});
  });

    $('a[id=list-book]').click(function(e){
	 e.preventDefault();
	 $('#list-book').css({'padding':'10px'}).css({'background-color':'#CCCCCC'}).css({'color':'#FFFFFF'}).css({'border':'1px solid #999999'});
	 $('#men').css({'background-color':'#FFFFFF'}).css({'padding':'10px'}).css({'color':'#CCCCCC'});
	 document.getElementById("crsname").value='';
    $('#book-list').hide().fadeIn();
	
	     $('#book-form').fadeOut();
		 $('#search-list').fadeOut();
		 $('#book-form').css({'display':'none'});
		 $('#ins').fadeOut();
		

  });
  
  /*$('#book-list').mouseout('click',function(){
     $('#loading').fadeOut();

  });
  */
  $('a[id=men]').click(function(e){
    e.preventDefault();
	  $('#men').css({'background-color':'#CCCCCC'}).css({'padding':'10px'}).css({'color':'#FFFFFF'}).css({'border':'1px solid #999999'});

	 $('#list-book').css({'background-color':'#FFFFFF'}).css({'padding':'10px'}).css({'color':'#CCCCCC'});
    $('#book-form').hide().fadeIn().show();
	$('#search-list').slideUp();
    $('#book-list').fadeOut();
	 e.preventDefault();
	
  });
  

  
  $('#deptid').change(function(){
    var did=$('#deptid').val();
	$.get('showcourse.php?id='+did,function(data){
	   $('#fcr').hide();
	   $('#dcr').hide().html(data).fadeIn();
	});
  });
  
  $('#button-big').click(function(){
    var courseid=$('#courseid').val();
	if($('#deptid').val()==''){
		alert('Department ID can not left empty');
		$('#deptid').focus();
		return false;
	}
	if($('#courseid').val()==''){
		alert('Course ID can not left empty');
		$('#courseid').focus();
		return false;
	}	
	if($('#author').val()==''){
		alert('Author name can not left empty');
		$('#author').focus();
		return false;
	}	
	if($('#publisher').val()==''){
		alert('Publisher can not left empty');
		$('#publisher').focus();
		return false;
	}	
	if($('#edition').val()==''){
		alert('Book edition can not left empty');
		$('#edition').focus();
		return false;
	}	
	if($('#selfid').val()==''){
		alert('Book self can not left empty');
		$('#selfid').focus();
		return false;
	}	
	if($('#noofrow').val()==''){
		alert('Book self row can not left empty');
		$('#noofrow').focus();
		return false;
	}	
	if($('#totalbook').val()==''){
		alert('No of book can not left empty');
		$('#totalbook').focus();
		return false;
	}	
	if($('#price').val()==''){
		alert('Price can not left empty');
		$('#price').focus();
		return false;
	}	
	
    var arr=$('#bfrm').serializeArray();
	$.post('ins_book.php?courseid='+courseid,arr,function(data){
	  $('#ins').css({'padding-left':'200px'}).css({'color':'#00CC00'}).hide().html(data).fadeIn();
	  document.bfrm.reset();
	
	});
  
  });
  
  $('#submit-btn').click(function(e){
    e.preventDefault(); 
	$('#book-list').slideUp('slow');
    var arr=$('#srs').serializeArray();
	$.post('search_listbook.php',arr,function(data){
	 
	 
	  $('#search-list').hide().html(data).slideDown('slow');
	}); 
	$('#search-list').html("<img src='load.gif' />");
  });
  
});
</script>
<script language="javascript">
 $(document).keyup(function(e){
   if(e.keyCode==27){
	 $('#list-book').css({'padding':'10px'}).css({'background-color':'#CCCCCC'}).css({'color':'#FFFFFF'}).css({'border':'1px solid #999999'});
	 $('#men').css({'background-color':'#FFFFFF'}).css({'padding':'10px'}).css({'color':'#CCCCCC'});
	 document.getElementById("crsname").value='';
    $('#book-list').hide().fadeIn();
	
	     $('#book-form').fadeOut();
		 $('#search-list').fadeOut();
		 $('#book-form').css({'display':'none'});
		 $('#ins').fadeOut();
   
   }
   
   if(e.keyCode==112){
	  $('#men').css({'background-color':'#CCCCCC'}).css({'padding':'10px'}).css({'color':'#FFFFFF'}).css({'border':'1px solid #999999'});

	 $('#list-book').css({'background-color':'#FFFFFF'}).css({'padding':'10px'}).css({'color':'#CCCCCC'});
    $('#book-form').hide().fadeIn().show();
	$('#search-list').slideUp();
    $('#book-list').fadeOut();
   
   }
 });
</script>

</script>

<script type="text/javascript" src="jquery.js"></script>


<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$(document).ready(function(){
   $('#listb').change(function(){
        var arr=$('#srs').serializeArray();

	var listb=$('#listb').val();
	//alert(listb);
	$.post('search_book.php',arr,function(data){
	  $('#lst').html(data); 
	
	});


$('#crsname').keypress(function(){
  var arr=$('#srs').serializeArray();
  	var listb=$('#listb').val();

  $.post('search_book.php?listb='+listb,arr,function(data){
    $('#lst').html(data);
  });
});

	
});  

});
$().ready(function() {
		$("#crsname").autocomplete("search_book.php", {
				width: 260,
				matchContains: true,
				//mustMatch: true,
				//minChars: 0,
				//multiple: true,
				//highlight: false,
				//multipleSeparator: ",",
				selectFirst: false
			});	

});
</script>

        <script type="text/javascript">
            $(document).ready(function(){				   
                function loading_show(){
                    //$('#loading').hide().show().html("<img src='load.gif'/>").fadeOut();
                }
                function loading_hide(){
                    $('#loading').fadeOut('fast');
                }                
                function loadData(page){
                    loading_show();                    
                    $.ajax
                    ({
                        type: "GET",
                        url: "list_book.php",
                        data: "page="+page,
					  //  data:$("form").serialize(),
                        success: function(msg)
                        {
                            $("#container").ajaxComplete(function(event, request, settings)
                            {
                                loading_hide();
                                $("#container").html(msg);
                            });
							
                        }
                    });
                }
                loadData(1);  // For first time page load default results
                $('#container .pagination li.active').live('click',function(){
                    var page = $(this).attr('p');
					//var catp=$("#catp").val();
                    loadData(page);
                    
                });           
            });
        </script>

        <style type="text/css">
            #loading{
                width: 100%;
                position: absolute;
                top: 200px;
                left: 500px;
				margin-top:50px;
            }
			#container{
			   width:600px;
			}   
            #container .pagination ul li.inactive,
            #container .pagination ul li.inactive:hover{
                background-color:#ededed;
                color:#bababa;
                border:1px solid #bababa;
                cursor: default;
            }
            .data{
			  margin-top:15px;
			}  
			 
			#container .data ul li{
                list-style: none;
                font-family: verdana;
                margin: 1px 0 1px 0;
                color: #000;
                font-size: 13px;
            }

            #container .pagination{
                width: 600px;
                height: 25px;
            }
            #container .pagination ul li{
                list-style: none;
                float: left;
                border: 1px solid #006699;
                padding: 2px 6px 2px 6px;
                margin: 5px 3px 0 3px;
                font-family: arial;
                font-size: 14px;
                color: #006699;
                font-weight: bold;
                background-color: #f2f2f2;
            }
            #container .pagination ul li:hover{
                color: #fff;
                background-color: #006699;
                cursor: pointer;
            }
			.go_button
			{
			background-color:#f2f2f2;border:1px solid #006699;color:#cc0000;padding:2px 6px 2px 6px;cursor:pointer;position:absolute;margin-top:-1px;
			}
			.total
			{
			float:right;font-family:arial;color:#999;
			}

        </style>

</head>

<body>

<div id="boxes">

       <div id="dialog" class="window">
       <a href="#" class="close"  style="padding-left:670px;"><img src="images/closebox.png" width="20" height="20" border="0" /></a>

       <div id="table_wrapper" style="margin-bottom:40px;"></div>


     </div>
	 
    

    </div>
  <div id="mask"></div>
<table width="1047" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1047" height="152" valign="top" background="images/1.jpg"><span class="style17"><?php include("topdefault.php");?>    </span></span></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" id="tblleft">
      <tr>
        <td height="28" colspan="2" bgcolor="#0C6ED1"><div align="center" class="style1">SAIC INSTITUTE OF MANAGEMENT TECHNOLOGY</div></td>
        </tr>
      <tr>
        <td background="images/leftbg.jpg">&nbsp;</td>
        <td><div align="center"><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['t'])==0){ ?><span style="color:#FF6600; font-weight:bold;"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></span><?php } ?></font></div></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php");?>���������<br />
          <p>&nbsp;</p>
          <p>&nbsp;</p></td><td width="79%" valign="top">

		  <div style="margin-top:30px;"></div>
		  <div style="float:left;margin-left:30px;" ><a href="#" id="men">Book Entry Form</a> <a href="#" id="list-book">List View</a><div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; padding-left:10px; width:300px; float:right; ">[Esc->List View || Shift+F1->Book Entery Form]</div></div>
		  <div style=" position:relative;border:1px solid #999999;top:28px;"></div>
		  
<div style="margin-top:60px;"><div id="ins"></div></div>
<div style="padding-left:20px;width:700px;" id="search-list"></div>
<div style="padding-left:20px;width:700px;" id="book-list">
<div id="top-search-div"> 
           <div id="content">
		   <label></label>
		   <div class="input">
		   <form method="post" id="srs">
		     <label>Search Form</label>
             <label>
			 <select id="listb" name="listb">
			  <option value="">Select options</option>
			  <option value="department">Department</option>
			  <option value="author">Author</option>
			  <option value="course">Course Name</option>
			 </select>
			 </label>			 
             <label><input type="text" id="crsname" name="crsname" placeholder="Book Name" /></label>
			 <label><input type="button" name="subs" id="submit-btn" value="Search" /></label>
			
		   </form>
		   </div>
		</div>
		</div>
<div style="margin-top:70px;"></div>
<div id="loading"></div>
        <div id="container">
		<div class="pagination"></div>
            <div class="data"></div>
            
        </div>

</div>		  
<div style="padding-left:50px;width:700px;" id="book-form">
<form method="post" id="bfrm" name="bfrm">	   
<table width="700" border="0" cellspacing="0" cellpadding="0" id="book">
  <tr>
    <td width="198">&nbsp;</td>
    <td width="10">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
<tr>
    <td>Departmnet Name </td>
    <td>:</td>
    <td colspan="2"><label>
      <select name="deptid" id="deptid" onkeypress="return handleEnter(this, event)">
	   <option value="">Select department</option>
	   <?php $dq=$myDb->select("SELECT*FROM tbl_department order by name asc");
	   while($dqf=$myDb->get_row($dq,'MYSQL_ASSOC')){
	   ?>
	   <option value="<?php echo $dqf['id']; ?>"><?php echo $dqf['name']; ?></option>
	   <?php } ?>
      </select>
    </label></td>
  </tr>  <tr>
    <td>Course Name</td>
    <td>: </td>
    <td colspan="2"><label>
	<div id="dcr"></div>
	<div id="fcr">
      <select name="courseid" id="courseid" onkeypress="return handleEnter(this, event)">
	    <option value="">Select Course</option>
		<?php $cq=$myDb->select("SELECT*FROM tbl_courses order by coursename asc");
		while($cqf=$myDb->get_row($cq,'MYSQL_ASSOC')){
		?>
		<option value="<?php echo $cqf['id']; ?>"><?php echo $cqf['coursename']; ?></option>
		<?php } ?>
      </select>
	</div>  
    </label></td>
  </tr>
  <tr>
    <td>ISBN NO </td>
    <td>:</td>
    <td colspan="2"><label>
      <input type="text" name="isbnno" id="isbnno" onkeypress="return handleEnter(this, event)"/>
    </label></td>
  </tr>
  <tr>
    <td>Author</td>
    <td>:</td>
    <td colspan="2"><label>
      <input type="text" name="author" id="author" onkeypress="return handleEnter(this, event)"/>
    </label></td>
  </tr>
  <tr>
    <td>Publisher</td>
    <td>:</td>
    <td colspan="2"><label>
      <input type="text" name="publisher" id="publisher" onkeypress="return handleEnter(this, event)"/>
    </label></td>
  </tr>
  <tr>
    <td>Edition</td>
    <td>:</td>
    <td colspan="2"><label>
      <input type="text" name="edition" id="edition" onkeypress="return handleEnter(this, event)"/>
    </label></td>
  </tr>
  
  <tr>
    <td>Book self No </td>
    <td>:</td>
    <td width="132"><label>
      <select name="selfid" id="selfid" onkeypress="return handleEnter(this, event)">
	  <option value="">Select Bookself</option>
	  <?php $sq=$myDb->select("SELECT distinct selfno FROM tbl_bookself");
	  while($sqf=$myDb->get_row($sq,'MYSQL_ASSOC')){
	  ?>
	  <option value="<?php echo $sqf['selfno']; ?>"><?php echo $sqf['selfno']; ?></option>
	  <?php } ?>
      </select>
    </label></td>
    <td width="560">
   <div style="float:left">
    <div id="rs" ></div><div id="rss"></div></div></td>
  </tr>
  <tr>
    <td>Qty</td>
    <td>:</td>
    <td colspan="2"><label>
      <input type="text" name="totalbook" id="totalbook" onkeypress="return handleEnter(this, event)"/>
    </label></td>
  </tr>
  <tr>
    <td>Price</td>
    <td>:</td>
    <td colspan="2"><label>
      <input type="text" name="price" id="price" onkeypress="return handleEnter(this, event)"/>
    </label></td>
  </tr>
  <tr>
    <td colspan="4"><div style="margin-left:150px;"><input type="button" value="Add Book" id="button-big"></div></td>
   </tr>
</table>


</form>
</div>
          <p>&nbsp;</p></td></tr>
      <tr>
        <td height="60" colspan="2" valign="middle" bgcolor="#D3F3FE"><?php include("bot.php"); ?></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
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

