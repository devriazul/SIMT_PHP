<script language="javascript">
 $(document).ready(function(){
   	    $('#selectmenu').change(function(){
            var values = $('#selectmenu').val();
			var name=$('#selectmenu option:selected').text();
                 $('#storeid').val(values);
				 $('#storename').val(name);
				 //alert(values);
        });
		
		$('#selectmenu').keypress(function(event){
		   if(event.which==13){
		      $('#issuedate').focus();
			  		  $('#showpick').html("<img src='bigLoader.gif' />");

			  $('#showpick').fadeOut('slow');
		   }	  
		});
		

 });
</script>
<?php  
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["p"];
if (!$q) return;
if($_SESSION['userid']=="inventory"){
	$sql = "select*from tbl_store  where storename like '$q%'";
}else{
	$sql = "select*from tbl_store  where maintainby='$_SESSION[userid]' and storename like '$q%'";
}
$rsd = mysql_query($sql);
?>
<select multiple="multiple" name="selectmenu" id="selectmenu" size="35" style="height:320px; border:1px solid #CCCCCC; width:250px;">

<?php while($rs = mysql_fetch_array($rsd)) {
?>
    <option value="<?php echo $rs['storeid']; ?>"><?php echo $rs['storename']; ?></option>
<?php 

}
?>
  </select>


<?php 

}else{
  header("Location:index.php");
}
}
