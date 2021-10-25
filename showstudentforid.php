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
          
			<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#F5F5F5" class="gridTblt">
			
				<tr bgcolor="#F4F4FF">
					<th width="16%" height="27" class="gridTblHead"><div align="left"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; font-weight:bold; ">ID</span></div></th>
					<th width="36%" class="gridTblHead"><div align="left"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; font-weight:bold; ">Name </span></div></th>
					<th width="6%" class="gridTblHead"><div align="left"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; font-weight:bold; ">Session</span></div></th>
					<th width="8%" class="gridTblHead"><div align="left"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; font-weight:bold; ">Batch</span></div></th>
					<th width="22%" class="gridTblHead"><div align="left"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; font-weight:bold; ">Department</span></div></th>
					<th width="12%" class="gridTblHead"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; font-weight:bold; ">Action</span></th>
				</tr>
				
				<?php 
				$src=mysql_real_escape_string($_POST['searchid']);
				$uac=$myDb->select("SELECT s.*, d.name as department, b.batchname as BatchName 
									FROM tbl_stdinfo s 
									inner join tbl_department d 
									on s.deptname=d.id  
									inner join tbl_batch b 
									on s.batch=b.id 
									WHERE stdid LIKE '$src%' order by id desc");
				while($uacf=$myDb->get_row($uac,'MYSQL_ASSOC')){
				?>
									
					<tr bgcolor="#FFFFFF">
						<td height="21" class="gridTblValue"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; "><?php echo $uacf['stdid']; ?></span></td>
						<td class="gridTblValue"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; "><?php echo $uacf['stdname']; ?></span></td>
						<td class="gridTblValue"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; "><?php echo $uacf['session']; ?></span></td>
						<td class="gridTblValue"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; "><?php echo $uacf['BatchName']; ?></span></td>
						<td class="gridTblValue"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; "><?php echo $uacf['department']; ?></span></td>
						<td class="gridTblValue">
						<a class="remove" target="_blank" href="reportstudentidcardNew.php?sid=<?php echo $uacf['stdid']; ?>"  name="modal"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; ">Preview</span></a>
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
}else{
  header("Location:index.php");
}
}