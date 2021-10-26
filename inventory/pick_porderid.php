<script language="javascript">
 $(document).ready(function(){
   	    $('#selectmenu').change(function(){
            var values = $('#selectmenu').val();
                 $('#reqid').val(values);
				 //alert(values);
        });
		
		$('#selectmenu').keypress(function(event){
		   if(event.which==13){
		      $('#save').focus();
			  		  $('#showpick').html("<img src='bigLoader.gif' />");

			  $('#showpick').fadeOut('slow');
		   }	  
		});
		

 });
</script>
<?php  
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
$q = $_GET["p"];
if (!$q) return;
//$sql = "select distinct p.porderid from tbl_purorder p inner join tbl_buyproduct b on p.porderid=b.porderid where p.porderid like '$q%' and p.opby='$_SESSION[userid]'  and b.storeid=''";
$sql = "select distinct reqid from tbl_buyproduct where reqid like '$q%' and opby='$_SESSION[userid]'  and pstatus='P'";

$rsd = mysql_query($sql);
?>
<select multiple="multiple" name="selectmenu" id="selectmenu" size="35" style="height:320px; border:1px solid #CCCCCC; width:250px;">

<?php while($rs = mysql_fetch_array($rsd)) {
?>
    <option value="<?php echo $rs['reqid']; ?>"><?php echo $rs['reqid']; ?></option>
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

