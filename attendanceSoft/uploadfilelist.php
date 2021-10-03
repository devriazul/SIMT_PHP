<div style="width:500px; margin:0 auto; ">
<?php
$dir = 'C:\Program Files (x86)\701Client';
$files = scandir($dir, 0);
echo "<form action=\"#\" id=\"flid\" method=\"post\">";
echo "<label for=\"filelist\">File List</label>";
echo "<select name=\"filename\" id=\"filename\">";
echo "<option value=\"\">Select attendance file</option>";
for($i = 2; $i < count($files); $i++){
    print "<option value=\"$files[$i]\">".$files[$i]."</option>";
}
echo "</select>";	
echo "<input type=\"button\" name=\"impattdata\" id=\"impattdata\" value=\"Import Attendance Data\"/>";
echo "</form>";
?>

<script language="javascript">
  $(document).ready(function(){
     $('#impattdata').on("click",function(){	 
	 	var arr = $('#flid').serializeArray();	      
		$('.upmsg').show().html('<img src="img/load.gif" />');
	    $.post("keepfacultyempinouttime.php",arr,function(r){
	      $('.upmsg').slideDown(300).html(r);
		  $('#filename').focus();
	    });
	 });
  });
</script>

</div>