<?php ob_start();
session_start();

include('../config.php');  
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_routine_for.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  $deptid=mysql_real_escape_string($_POST['deptid']);
?>
  <select name="ownid" id="ownid" onkeypress="return handleEnter(this, event)" style="width:130px; ">
    <option value="">Alias</option>
	<?php $aq=$myDb->select("select id,alias from tbl_routine_for where deptid='$deptid'");
	while($aqf=$myDb->get_row($aq,'MYSQL_ASSOC')){ ?>
	<option value="<?php echo $aqf['id']; ?>"><?php echo $aqf['alias']; ?></option>
	<?php } ?>
  </select>
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}