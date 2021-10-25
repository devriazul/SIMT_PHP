<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='hostelname.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  $code=mysql_real_escape_string($_POST['hostel']);
  
?>

<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="810"><select name="seat" id="seat" class="style4" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
				<option value="">Select</option>


				<?php $hq="SELECT h.id hid,h.name as name,hs.seat FROM tbl_hostel h
				           INNER JOIN tbl_hostelseat hs
						   ON h.id=hs.hostelid 
						   WHERE h.code='$code' 
						   order by h.id desc";
				      $hr=$myDb->select($hq);
					  while($hrow=$myDb->get_row($hr,'MYSQL_ASSOC')){
				?>
				<option value="<?php echo $hrow['seat']; ?>"><?php echo $hrow['name']."-".$hrow['seat']; ?></option>
				<?php } ?>	   
              </select> </td>
  </tr>
</table>

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
