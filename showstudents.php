<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='rptstdcv.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
?>


<div id="table_wrapper">
	<?php if (!empty($_SESSION['userid'])) { 
		
		?>
          
			<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#F5F5F5" class="gridTbl">
			
				<tr bgcolor="#F4F4FF">
					<th width="22%" class="gridTblHead" height="27" ><div align="left"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; font-weight:bold; ">StudentID</span></div></th>
					<th width="49%" class="gridTblHead"><div align="left"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; font-weight:bold; ">Student Name </span></div></th>
					<th width="17%" class="gridTblHead"><div align="left"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; font-weight:bold; ">CGPA</span></div></th>
					<th width="12%" class="gridTblHead"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; font-weight:bold; ">Action</span></th>
				</tr>
				
				<?php 
				$src=mysql_real_escape_string($_POST['searchid']);
				$uac=$myDb->select("SELECT * FROM tbl_stdcv WHERE stdid LIKE '$src%' order by id desc");
				while($uacf=$myDb->get_row($uac,'MYSQL_ASSOC')){
				?>
									
					<tr bgcolor="#FFFFFF">
						<td height="21" class="gridTblValue" ><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; "><?php echo $uacf['stdid']; ?></span></td>
						<td class="gridTblValue"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; "><?php echo $uacf['stdname']; ?></span></td>
						<td class="gridTblValue"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; "><?php echo $uacf['cgpa']; ?></span></td>
						<td class="gridTblValue" >
						<a class="remove" target="_blank" href="reportstudentcv.php?stdid=<?php echo $uacf['stdid']; ?>"  name="modal"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; ">Preview</span></a>
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
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}