<?php include("../config.php");
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/pagination.css" />
<link rel="stylesheet" href="css/style.css" />
<script src="js/jquery-1.11.3.min.js"></script>
<script language="javascript">
 $(document).ready(function(){
   $('#upfileid').on("click",function(){
	    $('.upfrm').slideDown(300);
		$('.upmsg').slideUp(300);
		$('#container').slideUp(300);
		$('.uploadfilelist').slideUp(300);
   });
   $('#upfileid').on("dblclick",function(){
	    $('.upfrm').slideUp(300);
   });
   
   $('#upfilelistid').on("click",function(){
	    $('.upfrm').slideUp(300);
		$('.upmsg').slideUp(300);
		$('#container').slideUp(300);
        $('.uploadfilelist').slideDown(300).load("uploadfilelist.php");
   });
   $('#upfilelistid').on("dblclick",function(){
        $('.uploadfilelist').slideUp(300);
   });
   
	$("#upfrmid").submit(function(evt){	 
	   evt.preventDefault();
	
	   var formData = new FormData($(this)[0]); 
	
	   $.ajax({
		 url: 'upload.php',
		 type: 'POST',
		 data: formData,
		 async: false,
		 cache: false,
		 contentType: false,
		 enctype: 'multipart/form-data',
		 processData: false,
		 success: function (response) {
		   $('.upfrm').slideUp(300);
		   $('.upmsg').slideDown(300).html(response);
		   
		 }
	   });
	
	   return false;
	 }); 
	 
	 $('#dattrec').on("click",function(){
	 	$('#container').show(300).html('<img src="img/load.gif" />').slideDown(300).load("dailyattendance.php?page=1");
	    $('.upfrm').slideUp(300);
		$('.upmsg').slideUp(300);
		$('.uploadfilelist').slideUp(300);
	 });
	 
	 $('#fdump').on("click",function(){
	 	$('.upmsg').show(300).html('<img src="img/load.gif" />').slideDown(300).load("finaldump.php");
	    $('.upfrm').slideUp(300);
		$('.uploadfilelist').slideUp(300);
		$('#container').slideUp(300);
	 });
 });
 
</script>

</head>
<body>
<div class="wrapper">
	<div class="application-header"><h1>Faculty/Employee Attendance Application</h1>
	</div>
	<div style="margin:20px auto; border:5px solid #9999; padding:5px; width:90%; ">
	  <input type="button" value="Upload file" class="upfile" id="upfileid" />
	  <input type="button" value="File List" class="upfile" id="upfilelistid" />
	  <input type="button" value="View attn" class="upfile" id="dattrec" />
	  <input type="button" value="Final Dump" class="upfile" id="fdump" />
	</div>
	<div class="upfrm">
	<form action="#" method="post" enctype="multipart/form-data" id="upfrmid">
		Select image to upload:
		<input type="file" name="fileToUpload" id="fileToUpload">
		<input type="submit" value="Upload File" name="submit">
	</form>
	</div>
	<div class="uploadfilelist"></div>
	<div class="upmsg"></div>
	<div id="container">
		<div class="pagination"></div>
	</div>
</div>
</body>
</html>
<?php }