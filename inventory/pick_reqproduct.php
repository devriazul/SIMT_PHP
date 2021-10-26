<script language="javascript">
 $(document).ready(function(){
   	    $('#selectmenu').change(function(){
            var values = $('#selectmenu').val();
			var name=$('#selectmenu option:selected').text();
			var num=parseInt(values);
                 $('#id').val(num);
				 $('#pname').val(name);
				 //alert(values);
        });
		
		$('#selectmenu').keypress(function(event){
		   if(event.which==13){
		      $('#pname').focus();
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
$sql = "select c.id bid,p.id prid,p.pname from tbl_product p
        inner join tbl_buyproduct c
		on p.id=c.pid
		where p.pname like '%$q%'
		and c.pstatus='R'";
$rsd = mysql_query($sql);
?>
<select multiple="multiple" name="selectmenu" id="selectmenu" size="35" style="height:320px; border:1px solid #CCCCCC; width:250px;">

<?php while($rs = mysql_fetch_array($rsd)) {
?>
    <option value="<?php echo $rs['bid']; ?>" class="<?php echo $rs['prid']; ?>"><?php echo $rs['pname']; ?></option>
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

