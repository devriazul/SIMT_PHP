<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='chart_of_acc.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  $accname=mysql_real_escape_string($_POST['parenthead']);
  
?>
<?php $hq="Select id from tbl_accchart where accname='$accname'";
				      $hr=$myDb->select($hq);
					  $hrow=$myDb->get_row($hr,'MYSQL_ASSOC');
					  
					  
      			
	  		
				?> 
<span class="style4">
<input name="accid" type="hidden" id="accid" class="style11" value="<?php echo $hrow['id']; ?>" readonly="true" onKeyPress="return handleEnter12(this, event)">
</span>
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>
