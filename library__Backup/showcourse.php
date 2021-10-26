<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='book_entry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  $id=mysql_real_escape_string($_GET['id']);
?>  

      <select name="courseid" id="courseid" onkeypress="return handleEnter(this, event)">
	    <option value="">Select Course</option>
		<?php $cq=$myDb->select("SELECT*FROM tbl_courses WHERE departmentid='$id' order by coursename asc");
		while($cqf=$myDb->get_row($cq,'MYSQL_ASSOC')){
		?>
		<option value="<?php echo $cqf['id']; ?>"><?php echo $cqf['coursename']; ?></option>
		<?php } ?>
      </select>

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