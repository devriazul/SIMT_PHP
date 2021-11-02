<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_admission_fees.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  $stdid=mysql_real_escape_string($_POST['stdid']);
  
?>
<?php $hq="SELECT s.stdname stdname, d.name dname, b.batchname batchname, sm.name semname
           FROM tbl_stdinfo s
           INNER JOIN tbl_department d 
		   ON s.deptname = d.id
           INNER JOIN tbl_batch b 
		   ON s.batch = b.id
           INNER JOIN tbl_semester sm 
		   ON s.semester = sm.id
		   WHERE s.storedstatus<>'D'
		   AND d.storedstatus<>'D'
		   AND b.storedstatus<>'D'
		   AND sm.storedstatus<>'D'
		   AND s.stdid='$stdid'
		   OR s.exstid='$stdid'";
				      $hr=$myDb->select($hq);
					  $hrow=$myDb->get_row($hr,'MYSQL_ASSOC');
					  
					  
      			
	  		
				?> 
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" id="stdtbl">
  <tr>
    <td align="right" class="style4">&nbsp;</td>
    <td class="style4">&nbsp;</td>
    <td class="style4">Student Name</td>
    <td class="style4">&nbsp;</td>
    <td class="style4">Department</td>
    <td class="style4">&nbsp;</td>
    <td class="style4">Batch</td>
    <td class="style4">Semester</td>
  </tr>
  <tr>
    <td align="right" class="style4" height="5"></td>
    <td class="style4"></td>
    <td class="style4"></td>
    <td class="style4"></td>
    <td class="style4"></td>
    <td class="style4"></td>
    <td colspan="2" class="style4"></td>
  </tr>
  <tr>
    <td width="28" align="right" class="style4">&nbsp;</td>
    <td width="10" class="style4">&nbsp;</td>
    <td width="186" class="style4"><label>
      <input name="stdname" type="text" id="stdname" class="style11" value="<?php echo $hrow['stdname']; ?>" readonly="true" onkeypress="return handleEnter12(this, event)">
    </label></td>
    <td width="10" class="style4">&nbsp;</td>
    <td width="149" class="style4"><input name="deptname" class="style11" type="text" id="deptname" value="<?php echo $hrow['dname']; ?>" readonly="true" onkeypress="return handleEnter(this, event)"></td>
    <td width="10" class="style4">&nbsp;</td>
    <td width="101" class="style4"><input name="batch" type="text" readonly="true" class="style11" id="batch" value="<?php echo $hrow['batchname']; ?>" size="10" onkeypress="return handleEnter(this, event)"></td>
    <td width="206" class="style4"><label>
      <input type="text" name="semester" id="semester" value="<?php echo $hrow['semname']; ?>" class="style11" readonly="true" onkeypress="return handleEnter(this, event)" />
    </label></td>
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
