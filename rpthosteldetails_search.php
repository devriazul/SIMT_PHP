<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='rpthosteldetails.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
/*$per_page = 20;

if(isset($_GET['page']))
    $page = $_GET['page'];
$start = ($page-1)*$per_page;
*/
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

	jQuery('.numbersOnly').keyup(function () { 
    this.value = this.value.replace(/[^0-9\.]/g,'');
	});
</script>






<form name="MyForm" action="reporthosteldetails.php" id="frm" autocomplete="off"  method="post" target="new" >           
			<table width="100%" border="0" align="left" cellpadding="0" cellspacing="2" id="stdtbl">
             <tr>
               <td height="20" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">Hostel Details Information </td>
             </tr>
             <tr>
               <td width="47%" height="20" class="style2"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="gridTbl">
                 
                 
				  <tr bgcolor="#DFF4FF">
                   <td width="189" height="25" class="style2 gridTblHead" >Room No </td>
                   <td width="91" height="25" class="style2 gridTblHead"><div align="left">Seat No </div></td>
                   <td width="214" height="25" class="style2 gridTblHead"><div align="left">Student Id </div></td>
                   <td width="305" class="style2 gridTblHead">Student Name </td>
				   <td width="117" class="style2 gridTblHead"><div align="left">Rent</div></td>
				   <td width="117" class="style2 gridTblHead"><div align="left">Meal Charge </div></td>
			      </tr>					
				<?php
			      if(isset($_POST['hostel'])){ //echo $_POST['hostel']; exit;
  				  $crs="SELECT vhd.*, s.stdname as Name FROM `vw_hostelindetails` vhd left join tbl_stdinfo s on vhd.stdid=s.stdid WHERE vhd.HostelName='$_POST[hostel]'";
  				  
				  $crq=$myDb->select($crs); 
				  $count=0;
  				  while($crsr=$myDb->get_row($crq,'MYSQL_ASSOC')){
				  if($count%2==0){
				  $bgcolor="#FFFFFF";
				  ?>
                 <tr bgcolor="<?php echo $bgcolor; ?>">
				  
                   	<td class="style4 gridTblValue"><?php echo $crsr['RoomNo'];?>
               	    <input type="hidden" value="<?php echo $crsr['HostelName']; ?>" name="hostel" id="hostel" /></td>
                   	<td class="style4 gridTblValue" ><?php echo $crsr['seatno']; ?></td>
 				   	<td class="style4 gridTblValue" ><?php echo $crsr['stdid']; ?></td>
					<td class="style4 gridTblValue"><?php echo $crsr['Name']; ?></td>
					<td class="style4 gridTblValue"><?php echo $crsr['price']; ?></td>
					<td class="style4 gridTblValue"><?php echo $crsr['mealcharge']; ?></td>
				 </tr>
                
                 <?php }else{ $bgcolor="#F7FCFF"; ?>
                 <tr bgcolor="<?php echo $bgcolor; ?>">
				
                   	<td class="style4 gridTblValue"><?php echo $crsr['RoomNo'];?>
               	    <input type="hidden" value="<?php echo $crsr['HostelName']; ?>" name="hostel" id="hostel" /></td>
                   	<td class="style4 gridTblValue" ><?php echo $crsr['seatno']; ?></td>
 				   	<td class="style4 gridTblValue" ><?php echo $crsr['stdid']; ?></td>
					<td class="style4 gridTblValue"><?php echo $crsr['Name']; ?></td>
					<td class="style4 gridTblValue"><?php echo $crsr['price']; ?></td>
					<td class="style4 gridTblValue"><?php echo $crsr['mealcharge']; ?></td>
				 </tr>
				 
                 <?php }
			  	 	$count++;
			     	}
			  }  
			?>
               </table></td>
              </tr>
             <tr>
               <td height="20" class="style2"><span class="style4">
                 <input type="submit"  value="Generate Report" name="B" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />
               </span></span></td>
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