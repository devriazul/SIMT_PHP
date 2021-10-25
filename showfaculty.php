<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
?>


<div id="table_wrapper">
	<?php if (!empty($_SESSION['userid'])) { 
		
		?>
          
			<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#F5F5F5" class="gridTbl">
			
				<tr bgcolor="#F4F4FF">
					<th width="22%" height="27" class="gridTblHead" ><div align="left"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; font-weight:bold; ">ID</span></div></th>
					<th width="49%" class="gridTblHead"><div align="left"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; font-weight:bold; ">Name </span></div></th>
					<th width="17%" class="gridTblHead"><div align="left"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; font-weight:bold; ">Department</span></div></th>
					<th width="12%" class="gridTblHead"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; font-weight:bold; ">Action</span></th>
				</tr>
				
				<?php 
				$src=mysql_real_escape_string($_POST['searchid']);
				$uac=$myDb->select("SELECT f.*, d.name as department 
									FROM tbl_faculty f 
									inner join tbl_department d 
									on f.deptid=d.id 
									WHERE facultyid LIKE '$src%' 
									order by id desc");
				while($uacf=$myDb->get_row($uac,'MYSQL_ASSOC')){
				?>
									
					<tr bgcolor="#FFFFFF">
						<td height="21" class="gridTblValue"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; "><?php echo $uacf['facultyid']; ?></span></td>
						<td class="gridTblValue"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; "><?php echo $uacf['name']; ?></span></td>
						<td class="gridTblValue"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; "><?php echo $uacf['department']; ?></span></td>
						<td class="gridTblValue">
						<a class="remove" target="_blank" href="reportindvidualfaculty.php?facultyid=<?php echo $uacf['facultyid']; ?>"  name="modal"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; ">Preview</span></a>
							<!---<a href="#" class="remove" rel="">
								Preview
							</a>-->								
						</td>
					</tr>
					
				<?php } ?>
</table>
		<?php } else { ?>
			
			<p>There are currently no records available.</p>
		
		<?php } ?>
<?php 
 /*  }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.html?msg=$msg");
   }	 
*/
}else{
  header("Location:index.php");
}
}