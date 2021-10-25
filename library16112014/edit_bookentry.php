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
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  $book=$myDb->select("SELECT*FROM tbl_bookentry WHERE bookid='$_GET[id]'");
  $bookf=$myDb->get_row($book,'MYSQL_ASSOC');
?>  
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
 $('.reclist tr[id=<?php echo $_GET["id"]; ?>] td').css({'background-color':'none'});
   var sid=$('#selfid').val();
    $.get('showrow.php?id='+sid+'&bookid=<?php echo $bookf['bookid']; ?>',function(data){
	   $('#rss').css({'width':'120px'});
	   $('#rss').html('<img src=loader.gif>');
	   $('#rss').fadeOut();
	   $('#rs').css({'float':'right'});
	   $('#rs').hide().html(data).fadeIn().css({'width':'auto'});
	   $('#noofrow').css({'border':'1px solid #999999'}).css({'color':'#666666'}).css({'font-family':'Verdana, Arial, Helvetica, sans-serif'}).css({'font-size':'12px'});;
	});
 
 
 
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
  
   
  

  
  $('#deptid').change(function(){
    var did=$('#deptid').val();
	$.get('showcourse.php?id='+did,function(data){
	   $('#fcr').hide();
	   $('#dcr').hide().html(data).fadeIn();
	});
  });
  
  $('#button-big').click(function(){
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
	$.post('update_book.php?bookid=<?php echo $bookf['bookid']; ?>&courseid=<?php echo $bookf['courseid']; ?>',arr,function(data){
	  $('#ins').css({'padding-left':'200px'}).css({'color':'#00CC00'}).hide().html(data).fadeIn();
	  $('.close').hide();
	  $('#mask').hide();
		$('.window').hide();
	});
	
	
	$('#book-list').slideUp('slow');
    var arr=$('#srs').serializeArray();
	$.post('search_listbook.php',arr,function(data){
	 
	 
	  $('#search-list').hide().html(data).slideDown('slow');
	  	$("body, html").animate({ 
		   scrollTop: $('.reclist tr[id=<?php echo $_GET["id"]; ?>] td').css({'background-color':'#999999','color':'#FFFFFF','font-style':'italic'}).offset().top
        }, 1000);			

	}); 
	
	$('#search-list').html("<img src='load.gif' />");
	
	
	
	
  });
  
  
});
</script>

<form method="post" id="bfrm">	   
<table width="500" border="0" cellspacing="0" cellpadding="0" id="book" class="global-form" >
<tr>
  <td height="40" colspan="4" ><div class="input-form-heading">Book Information</div> </td>
  </tr>
<tr>
    <td width="178" class="style15">Departmnet Name </td>
    <td width="7">:</td>
    <td colspan="2"><label>
      <select name="deptid" id="deptid" onkeypress="return handleEnter(this, event)">
	   <?php $dq=$myDb->select("SELECT*FROM tbl_department where id='$bookf[deptid]' order by name asc");
	   $dqf=$myDb->get_row($dq,'MYSQL_ASSOC');
	   ?>
	   <option value="<?php echo $dqf['id']; ?>"><?php echo $dqf['name']; ?></option>
	   <?php $dq=$myDb->select("SELECT*FROM tbl_department order by name asc");
	   while($dqf=$myDb->get_row($dq,'MYSQL_ASSOC')){
	   ?>
	   <option value="<?php echo $dqf['id']; ?>"><?php echo $dqf['name']; ?></option>
	   <?php } ?>
      </select>
    </label></td>
  </tr>  <tr>
    <td class="style15">Course Name</td>
    <td>: </td>
    <td colspan="2"><label>
	<div id="dcr"></div>
	<div id="fcr">
      <select name="courseid" id="courseid" onkeypress="return handleEnter(this, event)">
	    <?php $cq=$myDb->select("SELECT*FROM tbl_courses WHERE id='$bookf[courseid]' order by coursename asc");
		$cqf=$myDb->get_row($cq,'MYSQL_ASSOC');
		?>
		<option value="<?php echo $cqf['id']; ?>"><?php echo $cqf['coursename']; ?></option>
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
    <td class="style15">Isbn No </td>
    <td>:</td>
    <td colspan="2"><label>
      <input type="text" name="isbnno" id="isbnno" onkeypress="return handleEnter(this, event)" value="<?php echo $bookf['isbnno']; ?>"/>
    </label></td>
  </tr>
  <tr>
    <td class="style15">Author</td>
    <td>:</td>
    <td colspan="2"><label>
      <input type="text" name="author" id="author" onkeypress="return handleEnter(this, event)" value="<?php echo $bookf['author']; ?>"/>
    </label></td>
  </tr>
  <tr>
    <td class="style15">Publisher</td>
    <td>:</td>
    <td colspan="2"><label>
      <input type="text" name="publisher" id="publisher" onkeypress="return handleEnter(this, event)" value="<?php echo $bookf['publisher']; ?>"/>
    </label></td>
  </tr>
  <tr>
    <td class="style15">Edition</td>
    <td>:</td>
    <td colspan="2"><label>
      <input type="text" name="edition" id="edition" onkeypress="return handleEnter(this, event)" value="<?php echo $bookf['edition']; ?>"/>
    </label></td>
  </tr>
  
  <tr>
    <td class="style15">Book self No </td>
    <td>:</td>
    <td width="136"><label>
      <select name="selfid" id="selfid" onkeypress="return handleEnter(this, event)">
	  <option value="<?php echo $bookf['selfid']; ?>"><?php echo $bookf['selfid']; ?></option>
	  <?php $sq=$myDb->select("SELECT distinct selfno FROM tbl_bookself");
	  while($sqf=$myDb->get_row($sq,'MYSQL_ASSOC')){
	  ?>
	  <option value="<?php echo $sqf['selfno']; ?>"><?php echo $sqf['selfno']; ?></option>
	  <?php } ?>
      </select>
    </label></td>
    <td width="279">
   <div style="float:left">
    <div id="rs" ></div><div id="rss"></div></div></td>
  </tr>
  <tr>
    <td class="style15">Qty</td>
    <td>:</td>
    <td colspan="2"><label>
      <input type="text" name="totalbook" id="totalbook" onkeypress="return handleEnter(this, event)" value="<?php echo $bookf['totalbook']; ?>"/>
    </label></td>
  </tr>
  <tr>
    <td class="style15">Price</td>
    <td>:</td>
    <td colspan="2"><label>
      <input type="text" name="price" id="price" onkeypress="return handleEnter(this, event)" value="<?php echo $bookf['price']; ?>"/>
    </label></td>
  </tr>
  <tr>
    <td colspan="4"><div style="margin-left:150px;"><input type="button" value="Add Book" id="button-big"></div></td>
   </tr>
</table>


</form>
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}