<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){


$q=$_GET[q];
$ss="select*from `tbl_courses` where storedstatus<>'D' and departmentid='$q'";
$ssq=$myDb->select($ss);
//$ssr=$myDb->get_row($ssq,'MYSQL_ASSOC');
//$s_scat=mysql_query("select*from `tbl_courses` where departmentid='$q'") or die(mysql_error());

?>	
<style type="text/css">
<!--
@import url("main.css");
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style16 {font-size: 12px}

-->
</style>
<select name="sid" id="sid" class="style2">
	<option value="" selected="selected">Select Sub Category</option>
	<?php 
		while($ssr=$myDb->get_row($ssq,'MYSQL_ASSOC')){
	?>
	<option value="<?php echo $ssr['id']; ?>"><?php echo $ssr['coursename']; ?></option>
	<?php } ?>
</select>	
<?php 
}else{
  header("Location:login.php");
}
}  
?>
