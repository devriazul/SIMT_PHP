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
  $id=mysql_real_escape_string($_GET['id']);
  if(isset($_GET['bookid'])){
		  $bookid=mysql_real_escape_string($_GET['bookid']);
		  
		  $book=$myDb->select("SELECT*FROM tbl_bookentry WHERE bookid='$bookid'");
		  $bookf=$myDb->get_row($book,'MYSQL_ASSOC');
  }
  
?>  

 <select name="noofrow" id="noofrow" style="width:auto;">
 <?php if($bookf['bookid']!=""){ ?>
 <option value="<?php echo $bookf['rowno']; ?>"><?php echo $bookf['rowno']; ?></option>
 <?php }else{ ?>
 <option value="">Select Selfrow</option>
 <?php } ?>
 <?php $nq=$myDb->select("SELECT noofrow FROM  tbl_bookself WHERE selfno='$id'");
 while($nqf=$myDb->get_row($nq,'MYSQL_ASSOC')){
 ?>
 <option value="<?php echo $nqf['noofrow']; ?>"><?php echo "Row ".$nqf['noofrow']; ?></option>
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