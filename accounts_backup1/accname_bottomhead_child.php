<script language="javascript">
 $(document).ready(function(){
   	    $('#selectmenu1').change(function(){
            var values = $('#selectmenu1').val();
                 $('#accname').val(values);
				 //alert(values);
        });
		
		$('#selectmenu1').keypress(function(event){
		   if(event.which==13){
		      $('#acctype').focus();
			  $('#bothead').fadeOut('slow');
		   }	  
		});

 });
</script>
<?php  
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["p"];
if (!$q) return;
$sql = "select*from tbl_accchart where id not in(select parentid from tbl_accchart) and groupname!=0 and accname like '$q%'";
$rsd = mysql_query($sql);
?>
<select multiple="multiple" name="selectmenu1" id="selectmenu1" size="35" style="height:320px; border:1px solid #CCCCCC; width:250px;">

<?php while($rs = mysql_fetch_array($rsd)) {
?>
    <option value="<?php echo $rs['accname']; ?>"><?php echo $rs['accname']; ?></option>
<?php 

}
?>
  </select>


<?php 

}else{
  header("Location:login.php");
}
}
?>

