<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='rptdutydetails.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
$t=0;
?>
<script language type="text/javascript"> 
function handleEnter (field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
			i = (i + 1) % field.form.elements.length;
			field.form.elements[i].focus();
			return false;
		} 
		else
		return true;
	}  

</script>






<form name="MyForm" action="reportemployeeduty.php" id="frm" autocomplete="off"  method="post" target="_blank">           
			<table width="100%" border="0" align="left" cellpadding="0" cellspacing="2" id="stdtbl">
             <tr>
               <td height="20" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">Hostel Details Information </td>
             </tr>
		     <tr>
               <td height="20" class="style2"><span class="style4">
                 <input type="submit"  value="Generate Report" name="B" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />
               </span></span></td>
              </tr>			 <tr>
               <td width="47%" height="20" class="style2"><table width="100%" height="93" border="0" cellpadding="0" cellspacing="0" class="gridTbl">
                 
                 
				  <tr bgcolor="#DFF4FF">
                   <td width="55" height="25" class="gridTblHead">ID</td>
                   <td width="86" height="25" class="gridTblHead"><div align="left">E/F ID </div></td>
                   <td width="204" height="25" class="gridTblHead"><div align="left">Name</div></td>
                   <td width="105" class="gridTblHead">In Time </td>
				   <td width="87" class="gridTblHead"><div align="left">Out Time </div></td>
				   <td width="332" class="gridTblHead">Working Hour(s)</td>
				   <td width="100" class="gridTblHead"><div align="left">Type</div></td>
			      </tr>					
				<?php
			      if(isset($_POST['fdate']) && isset($_POST['tdate'])){
				  $std="SELECT at . * , s.name AS EmpName, a.accname FROM  `tbl_attendance` at INNER JOIN  `tbl_staffinfo` s ON at.efid = s.sid INNER JOIN  `tbl_access` a ON at.accid = a.id WHERE at.edate BETWEEN  '$_POST[fdate]' AND  '$_POST[tdate]' UNION SELECT at . * , f.name AS FacName, a.accname FROM  `tbl_attendance` at INNER JOIN  `tbl_faculty` f ON at.efid = f.facultyid INNER JOIN  `tbl_access` a ON at.accid = a.id WHERE at.edate BETWEEN  '$_POST[fdate]' AND  '$_POST[tdate]'  ";	
			      $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){

				  $stdtime="SELECT * FROM tbl_attendancesettings WHERE accid='$stdr[accid]'";	
			      $stdqtime=$myDb->select($stdtime);
				  $stdrtime=$myDb->get_row($stdqtime,'MYSQL_ASSOC');
 				  
				  $t1= new DateTime($stdr['intime']);
				  $t2= new DateTime($stdr['outtime']);
				  $interval = $t2->diff($t1);
				  $a=(int)$interval->format('%h%i');
				  if($count%2==0){
				  $bgcolor="#FFFFFF";
				  ?>
                 <tr bgcolor="<?php echo $bgcolor; ?>">
				  
                   	<td class="gridTblValue"><?php echo $stdr['id']; ?><input type="hidden" name="fromdate" value="<?php echo $_POST['fdate'];?>" /><input type="hidden" name="todate" value="<?php echo $_POST['tdate'];?>" /></td>
                   	<td class="gridTblValue" ><?php echo $stdr['efid']; ?></td>
 				   	<td class="gridTblValue" ><?php echo $stdr['EmpName']; ?></td>
					<td class="gridTblValue"><?php echo $stdr['intime']; ?></td>
					<td class="gridTblValue"><?php echo $stdr['outtime']; ?></td>
					<td class="gridTblValue"><?php echo $interval->format('%H hour(s) %i min(s) %s second(s)');//echo $td; ?></td>
					<td class="gridTblValue"><?php echo $stdr['accname']; ?></td>
				 </tr>
                
                 <?php }else{ $bgcolor="#F7FCFF"; ?>
                 <tr bgcolor="<?php echo $bgcolor; ?>">
				
                   	<td class="gridTblValue"><?php echo $stdr['id']; ?><input type="hidden" name="fromdate" value="<?php echo $_POST['fdate'];?>" /><input type="hidden" name="todate" value="<?php echo $_POST['tdate'];?>" /></td>
                   	<td class="gridTblValue" ><?php echo $stdr['efid']; ?></td>
 				   	<td class="gridTblValue" ><?php echo $stdr['EmpName']; ?></td>
					<td class="gridTblValue"><?php echo $stdr['intime']; ?></td>
					<td class="gridTblValue"><?php echo $stdr['outtime']; ?></td>
					<td class="gridTblValue"><?php echo $interval->format('%H hour(s) %i min(s) %s second(s)');//echo $td; ?></td>
					<td class="gridTblValue"><?php echo $stdr['accname']; ?></td>
				 </tr>
				 
                 <?php }
			  	 	$count++;
			     	}
			  }  
			?>
               </table></td>
              </tr>
          
  </table>
</form>

		  	          
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}