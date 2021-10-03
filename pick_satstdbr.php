<script language="javascript">
 $(document).ready(function(){
   	    $('#selectmenu').change(function(){
            var values = $('#selectmenu').val();
			var name=$('#selectmenu option:selected').text();
			var num=values;
                 $('#stdidid').val(num);
				 $('#stdbr').val(name);
				 //alert(values);
        });
		
		$('#selectmenu').keypress(function(event){
		   if(event.which==13){
		      $('#stdid').focus();
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
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
$q = $_GET["p"];
if (!$q) return;
//$sql = "select distinct empname, designation from tbl_parttimeemployeesalary where empname like '$q%'";
//$sql = "select f.name as empname, d.name as designation from tbl_faculty f inner join tbl_designation d on f.designationid=d.id where f.name like '$q%' and f.type='Part Time'";
$sql = "select stdid, boardrollno from tbl_stdinfo where boardrollno like '$q%'";
$rsd = mysql_query($sql);
?>
<select multiple="multiple" name="selectmenu" id="selectmenu" size="35" style="height:320px; border:1px solid #CCCCCC; width:250px;">

<?php while($rs = mysql_fetch_array($rsd)) {
?>
    <option value="<?php echo $rs['stdid']; ?>"><?php echo $rs['boardrollno']; ?></option>
<?php 

}
?>
  </select>


<?php 

}else{
  header("Location:index.php");
}
}
?>

