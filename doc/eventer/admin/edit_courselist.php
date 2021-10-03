<?php
	include_once('eventer-config.php');
	include_once('session-check.php');
?>
<select name="coursecode" id="coursecode" style="font-family: Verdana; font-size: 10pt; border: 1px solid #3399FF" >
				<?php $crsq=mysql_query("SELECT * FROM tbl_courses WHERE departmentid='$_GET[sdid]' and storedstatus IN('I','U') order by id desc") or die(mysql_error());
					  $crsf=mysql_fetch_array($dq);
				?>
			    <option selected="selected" value="<?php echo $crsf['coursecode']; ?>"><?php echo $crsf['coursecode']."(".$crsf['coursename'].")"; ?></option>
              </select>