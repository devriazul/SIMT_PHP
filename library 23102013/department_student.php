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
  $rowid=mysql_real_escape_string($_GET['rowid']);  

?>

<script language="javascript">
$(document).ready(function(){	 

  $('#stdid<?php echo $_GET['rowid']; ?>').blur('live',function(){
     var stdid=$('#stdid<?php echo $_GET['rowid']; ?>').val();
     $.get('check_return.php?stdid='+stdid+'&rowid=<?php echo $rowid; ?>',function(data){
	   $('#bchk<?php echo $_GET['rowid']; ?>').val(data);
	     
	 $('#chkbook<?php echo $_GET['rowid']; ?>').html('<img src=bigLoader.gif>');
	 $('#chkbook<?php echo $_GET['rowid']; ?>').fadeIn('slow');
	 $('#chkbook<?php echo $_GET['rowid']; ?>').load('check_return.php?stdid='+stdid+'&rowid=<?php echo $rowid; ?>');

	    
	 });	  
  });
});  
</script>
<script type="text/javascript" src="jquery.js"></script>


<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script language="javascript">
$().ready(function() {
		$("#stdid<?php echo $_GET['rowid']; ?>").autocomplete("search_student.php", {
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

  <tr>
    <td width="35%"><label>Student ID<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; color:#FF0000" >*</span> </label></td>
    <td><label>
      <!-- <select name="stdid" id="stdid<?php echo $_GET['rowid']; ?>" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
	   <option value="">Select ID</option>
	   <?php $std=$myDb->select("select*from tbl_stdinfo where deptname='$_POST[deptid]' order by id desc");
	   while($stdf=$myDb->get_row($std,'MYSQL_ASSOC')){
	   ?>
	   <option value="<?php echo $stdf['stdid']; ?>"><?php echo $stdf['stdid']."-".$stdf['stdname']; ?></option>
	   <?php } ?>
      </select> -->
	  <input type="text" name="stdid" id="stdid<?php echo $_GET['rowid']; ?>" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;"/>
	  <input type="hidden" name="bchk" id="bchk<?php echo $_GET['rowid']; ?>" />
    </label></td>
    </tr>
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
