<?php
	include_once('eventer-config.php');
	include_once('session-check.php');
?>
<select name="facultyid" id="facultyid" style="font-family: Verdana; font-size: 10pt; border: 1px solid #3399FF; height:30px; padding:5px;" >
              
			    <option value="">Select</option>
				<?php $dq=mysql_query("SELECT * FROM tbl_faculty WHERE deptid='$_GET[did]' and storedstatus IN('I','U') order by id desc") or die(mysql_error());
					  while($drow=mysql_fetch_array($dq)){
				?>
				<option value="<?php echo $drow['facultyid']; ?>"><?php echo $drow['facultyid']."(".$drow['name'].")"; ?></option>
				<?php } ?>	   
              </select>