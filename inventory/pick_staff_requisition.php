<script language="javascript">
 $(document).ready(function(){
   	    $('#selectmenu').change(function(){
            var values = $('#selectmenu').val();
			var name=$('#selectmenu option:selected').text();
			//var num=parseInt(values);
                 $('#empid').val(values);
				 $('#ename').val(name);
				 //alert(values);
        });
		
		$('#selectmenu').keypress(function(event){
		   if(event.which==13){
		      $('#pid').focus();
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
$sql = "select s.sid 'id',s.name 'name',d.name 'designation' from tbl_staffinfo s inner join tbl_designation d on d.id = s.designationid where s.name like '$q%' union select f.facultyid 'id',f.name ,d.name 'designation' from tbl_faculty f inner join tbl_designation d on d.id = f.designationid where f.name like '$q%'";
$rsd = mysql_query($sql);
?>
<select multiple="multiple" name="selectmenu" id="selectmenu" size="35" style="height:320px; border:1px solid #CCCCCC; width:250px;">

<?php while($rs = mysql_fetch_array($rsd)) {
?>
    <option value="<?php echo $rs['id']; ?>"><?php echo $rs['name']." -> ".$rs['designation']; ?></option>
<?php 

}
?>
  </select>


<?php 

}else{
  header("Location:index.php");
}
}
