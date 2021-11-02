<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='stdinfo.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  $code=mysql_real_escape_string($_POST['deptname']);
  
?>

<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="478" align="right" class="style4"><span class="stars">*</span>Batch</td>
    <td width="29" class="style4">:</td>
    <td width="810"><select name="batch" class="style4" id="batch" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                <?php 
				      $hq="SELECT b.id bid,b.batchname batchname,d.code deptcode FROM tbl_batch b
				           INNER JOIN tbl_department d
						   ON b.depcode=d.id 
						   WHERE b.id='$edr[batch]' 
						   order by b.id desc";
				      $hr=$myDb->select($hq);
					  while($hrow=$myDb->get_row($hr,'MYSQL_ASSOC')){
				?>
				<option selected="selected" value="<?php echo $hrow['bid']; ?>"><?php echo $hrow['deptcode']."-".$hrow['batchname']; ?></option>
				<?php } ?>	  

				<?php $hq="SELECT b.id bid,b.batchname batchname,d.code deptcode FROM tbl_batch b
				           INNER JOIN tbl_department d
						   ON b.depcode=d.id 
						   WHERE b.depcode='$code' order by b.id desc";
				      $hr=$myDb->select($hq);
					  while($hrow=$myDb->get_row($hr,'MYSQL_ASSOC')){
				?>
				<option value="<?php echo $hrow['bid']; ?>"><?php echo $hrow['deptcode']."-".$hrow['batchname']; ?></option>
				<?php } ?>	   
              </select></td>
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
