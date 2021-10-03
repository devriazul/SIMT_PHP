<?php
	include_once('eventer-config.php');
	include_once('session-check.php');
?>
<?php
	$option_recset = mysql_query("SELECT date_format FROM eventer_options");
	$option_row = mysql_fetch_assoc($option_recset);
	$date_format = $option_row['date_format'];
?>
<?php
	$images_folder = "../images/";
	
	if(isset($_GET['eventID'])) {
		$event_id = $_GET['eventID'];
		$query = mysql_query("SELECT * FROM `eventer_eventshces` WHERE `id` = '$event_id'") or die(mysql_error());
		$row = mysql_fetch_assoc($query) or die(mysql_error());
		$oimagepath = $images_folder.$row['image'];
		$oimage = $row['image'];
	}
		
	$start_time = $row['start_time'];	
	$times = explode(':' , $start_time);
	
	if (count($times) > 1) {
		$k=1;
		foreach($times as $start_time) { 	
			$starttimeold[$k] = $start_time;
			$k++;
		}
		
		$start_hour_old = $starttimeold['1'];
		$start_minutes_old = $starttimeold['2'];
	}
	else {
		$start_hour_old = '-1';
		$start_minutes_old = '-1';
	}
	
	$end_time = $row['end_time'];	
	$times = explode(':', $end_time);
	
	if (count($times) > 1) {
		$k=1;
		foreach($times as $end_time) { 	
			$endtimeold[$k] = $end_time;
			$k++;
		}
		
		$end_hour_old = $endtimeold['1'];
		$end_minutes_old = $endtimeold['2'];
	}
	else {
		$end_hour_old = '-1';
		$end_minutes_old = '-1';
	}
	
	// to check if Submit button is clicked...
	if(isset($_POST['Submit']))  {
		$title = $_POST['title'];
		
		if (isset($_POST['start_date']) && $_POST['start_date'] != '') {
			$date = $_POST['start_date'];
			$dateArr = explode("-", $date);
			
			if ($date_format == 'UK') {
				$start_date = $dateArr[2]."-".$dateArr[1]."-".$dateArr[0];
			}
			else {
				$start_date = $dateArr[2]."-".$dateArr[0]."-".$dateArr[1];
			}
		}
		else {
			$start_date = '';
		}
		
		if (isset($_POST['end_date']) && $_POST['end_date'] != '') {
			//$end_date = date('Y-m-d', $_POST['end_date']);
			$date = $_POST['end_date'];
			$dateArr = explode("-", $date);
			
			if ($date_format == 'UK') {
				$end_date = $dateArr[2]."-".$dateArr[1]."-".$dateArr[0];
			}
			else {
				$end_date = $dateArr[2]."-".$dateArr[0]."-".$dateArr[1];
			}
		}
		else {
			$end_date = '';
		}
		
		/*$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];*/
		
		$start_hour = $_POST['start_hour'];
		$start_hour = $_POST['start_hour'];
		if ($start_hour == '-1') {
			$start_time = '-1';
		}
		else {
			$start_minutes = $_POST['start_minutes'];
			$start_time = $start_hour.$start_minutes.':00';
		}
		
		$end_hour = $_POST['end_hour'];
		if ($end_hour == '-1') {
			$end_time = '-1';
		}
		else {
			$end_minutes = $_POST['end_minutes'];
			$end_time = $end_hour.$end_minutes.':00';
		}
		
		$description = $_POST['description'];
		$venue = $_POST['venue'];
		
		$link = $_POST['link'];
		
		$status = $_POST['status'];
		$dimage = $_POST['dimage'];

		$days = floor(strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24);
		$totdays = $days + 1;
		$monthname = date("F", strtotime($start_date)); 
		$yearname = date("Y", strtotime($start_date)); 
		$cldtype = $_POST['cldtype'];
		$departmentid=$_POST['departmentid'];
		$session=$_POST['session'];
		$semester=$_POST['semester'];
		$coursecode=$_POST['coursecode'];
		//$facultyid=$_POST['facultyid'];
		$day = date('l', strtotime($start_date));

		$image = $_FILES['file']['name'];
		$tmp = $_FILES['file']['tmp_name'];
		
		$image_alignment = $_POST['image_alignment'];
		
		$fdir = $images_folder.$image;
		
		// to run the query for insertion of data....
		
		$query=" UPDATE `eventer_eventshces` SET `title` =  '$title', `start_date` = '$start_date', `end_date` = '$end_date', `start_time` = '$start_time', `end_time` = '$end_time', `description` = '$description', `venue` = '$venue', `image_alignment` = '$image_alignment', `link` = '$link' , `status` = '$status' , `monthname` = '$monthname' , `yearname` = '$yearname' , `totaldays` = '$totdays' , `section` = '$cldtype' , `departmentid` = '$departmentid' , `session` = '$session' , `semester` = '$semester' , `coursecode` = '$coursecode' , `dayname` = '$day'";
		
		if($dimage == '1') {
			if($oimage) {
				if(file_exists($oimagepath)) {
					unlink($oimagepath) or die("image deletion failed");
				}
				$query.=",`image` = '' ";
			}
		}

		if($image && $image != '')  {
			$query.=",`image` = '$image' ";
			move_uploaded_file($tmp,$fdir) or die("file uploading failed");
			
			/*if($oimage) {
				if(file_exists($oimagepath)) {
					unlink($oimagepath) or die("image deletion failed");
				}
			}*/
		}
		
		$query.=" WHERE `id` = '$event_id'; ";
		
		mysql_query($query) or die(mysql_error());
		header("Location:events.php?Msg=Record+Updated+Successfully");
	}
?>
<?php
	include_once('header.php');
	include_once('menu.php');
?>
<?php
	$eventID = $_GET['eventID'];
	$query = "SELECT * FROM eventer_eventshces WHERE id='$eventID'";
	$recset = mysql_query($query);
	$row = mysql_fetch_assoc($recset);
?>
    <script language="javascript">
 $(document).ready(function(){
    $('#departmentid').change(function(){
    var did=$('#departmentid').val();
	   //alert(did);
	   $('#clist').html('<img src="bigLoader.gif" />').fadeIn('slow');
	   $('#clist').load("courselist.php?did=" + did);
	   $('#scid').fadeOut('fast');
	   
	   
	   //$('#flist').html('<img src="bigLoader.gif" />').fadeIn('slow');
	   //$('#flist').load("facultylist.php?did=" + did);
	   //$('#fcid').fadeOut('fast');
	});
 });
</script>

	<div id="content">
        <div class="content-header">
        	<h1 class="title">You are editing - <span style="color:#CF3B06"><?php echo $row['title']; ?></span></h1>
            <div class="add-new-item"><a href="event-add.php" class="header-action add-action">Add Event</a></div>
        </div>
        <input type="hidden" id="DPC_TODAY_TEXT" value="today">
        <input type="hidden" id="DPC_BUTTON_TITLE" value="Open calendar...">
        <input type="hidden" id="DPC_MONTH_NAMES" value="['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']">
        <input type="hidden" id="DPC_DAY_NAMES" value="['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']">
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <table border="0" class="rows">
              <tr>
                <td width="150"><strong>Title</strong></td>
                <td width="650"><label for="title"></label>
                  <input name="title" type="text" id="title" size="69" value="<?php echo $row['title']; ?>" /></td>
              </tr>
              <tr>
                <td><strong>Start Date</strong></td>
                <?php
					if ($date_format == "UK") {
						$date_picker_format = "DD-MM-YYYY";
						$date_value_format = "d-m-Y";
					}
					else {
						$date_picker_format = "MM-DD-YYYY";
						$date_value_format = "m-d-Y";
					}
				?>
                <td><input type="text" name="start_date" id="start_date" size="29" class="flatedit" datepicker="true" datepicker_format="<?php echo $date_picker_format; ?>" value="<?php if ($row['start_date'] != '') { echo date($date_value_format, strtotime($row['start_date'])); } ?>"></td>
              </tr>
              <tr>
                <td><strong>End Date</strong></td>
                <td><input type="text" name="end_date" id="end_date" size="29" class="flatedit" datepicker="true" datepicker_format="<?php echo $date_picker_format; ?>" value="<?php if ($row['end_date'] != '') { echo date($date_value_format, strtotime($row['end_date'])); } ?>"></td>
              </tr>
              <tr>
                <td><strong>Start Time</strong></td>
                <td><select name="start_hour" id="start_hour">
                      <option value="-1">Hour</option>
                      <?php
                        $start_hour = 0;
                        while($start_hour < 24) {
                      ?>
                       <option value="<?php echo $start_hour; ?>" <?php if ($start_hour_old == $start_hour) {?> selected="selected" <?php }?>><?php echo $start_hour; ?></option>
                      <?php 
                            $start_hour++;
                        }
                      ?>
                      </select> 
                      
                      <select name="start_minutes" id="start_minutes">
                        <option value=":00">Minutes</option>
                        <?php
                        $start_minute = 0;
                        while($start_minute < 60) {
                      ?>
                       <option value="<?php echo ':'.$start_minute; ?>" <?php if ($start_minutes_old == $start_minute) {?> selected="selected" <?php }?>><?php echo $start_minute; ?></option>
                      <?php 
                            $start_minute++;
                        }
                      ?>
                      </select>
                   </td>
              </tr>
              <tr>
                <td><strong>End Time</strong></td>
                <td><select name="end_hour" id="end_hour">
                      <option value="-1">Hour</option>
                      <?php
                      	$end_hour = 0;
                        while($end_hour < 24) { 
                      ?>
                       <option value="<?php echo $end_hour; ?>" <?php if ($end_hour_old == $end_hour) {?> selected="selected" <?php }?>><?php echo $end_hour; ?></option>
                      <?php 
                        $end_hour++;
                        }
                      ?>
                      
                      </select> 
                      
                      <select name="end_minutes" id="end_minutes">
                        <option value=":00">Minutes</option>
						<?php
                        	$end_minute = 0;
                        	while($end_minute < 60) {
                      ?>
                       <option value="<?php echo ':'.$end_minute; ?>" <?php if ($end_minutes_old == $end_minute) {?> selected="selected" <?php }?>><?php echo $end_minute; ?></option>
                      <?php 
                            $end_minute++;
                        }
                      ?>
                      </select>
                   </td>
              </tr>
              <tr>
                <td><strong>Department Name</strong></td>
                <td><select name="departmentid" id="departmentid" style="font-family: Verdana; font-size: 10pt; border: 1px solid #3399FF;height:30px; padding:5px;" >
                  <?php $sdptid=mysql_query("SELECT id,code,name FROM tbl_department WHERE id='$row[departmentid]' and storedstatus IN('I','U') order by id desc") or die(mysql_error());
				   $sdptidf=mysql_fetch_array($sdptid);
				?>
                  <option value="<?php echo $sdptidf['id']; ?>" selected="selected"><?php echo $sdptidf['name']; ?></option>
                  <?php $dq=mysql_query("SELECT id,code,name FROM tbl_department WHERE storedstatus IN('I','U') order by id desc") or die(mysql_error());
					  while($drow=mysql_fetch_array($dq)){
				?>
                  <option value="<?php echo $drow['id']; ?>"><?php echo $drow['code']."(".$drow['name'].")"; ?></option>
                  <?php } ?>
                </select></td>
              </tr>
              <tr>
                <td><strong>Semester Name</strong></td>
                <td><select name="semester" id="semester" style="font-family: Verdana; font-size: 10pt; border: 1px solid #3399FF;height:30px; padding:5px;">
                  <?php $semq=mysql_query("SELECT * FROM tbl_semester WHERE storedstatus IN('I','U') order by id desc") or die(mysql_error());
					  $semf=mysql_fetch_array($semq);
				  ?>
                  <option value="<?php echo $semf['id']; ?>" selected="selected"><?php echo $semf['name']; ?></option>
                  <?php $dq=mysql_query("SELECT * FROM tbl_semester WHERE storedstatus IN('I','U') order by id desc") or die(mysql_error());
					  while($drow=mysql_fetch_array($dq)){
				?>
                  <option value="<?php echo $drow['id']; ?>"><?php echo $drow['name']; ?></option>
                  <?php } ?>
                </select></td>
              </tr>
              <tr>
                <td><strong>Session</strong></td>
                <td><select name="session" id="session" style="font-family: Verdana; font-size: 10pt; border: 1px solid #3399FF;height:30px; padding:5px;" onkeypress="return handleEnter(this, event)">
                  <option value="<?php echo $row['session']; ?>" selected="selected"><?php echo $row['session']; ?></option>
                  <option value="0506">2005-2006</option>
                  <option value="0607">2006-2007</option>
                  <option value="0708">2007-2008</option>
                  <option value="0809">2008-2009</option>
                  <option value="0910">2009-2010</option>
                  <option value="1011">2010-2011</option>
                  <option value="1112">2011-2012</option>
                  <option value="1213">2012-2013</option>
                  <option value="1314">2013-2014</option>
                  <option value="1415">2014-2015</option>
                  <option value="1516">2015-2016</option>
                  <option value="1617">2016-2017</option>
                  <option value="1718">2017-2018</option>
                  <option value="1819">2018-2019</option>
                  <option value="1920">2019-2020</option>
                  <option value="2021">2020-2021</option>
                  <option value="2122">2021-2022</option>
                  <option value="2223">2022-2023</option>
                  <option value="2324">2023-2024</option>
                  <option value="2425">2024-2025</option>
                </select></td>
              </tr>
              <tr>
                <td><strong>Course</strong></td>
                <td><div id="scid">
                  <select name="coursecode" id="coursecode" style="font-family: Verdana; font-size: 10pt; border: 1px solid #3399FF;height:30px; padding:5px;" >
                    <option value="">Select</option>
                    <?php $dq=mysql_query("SELECT * FROM tbl_courses WHERE id='$row[coursecode]' and storedstatus IN('I','U') order by id desc") or die(mysql_error());
					  while($drow=mysql_fetch_array($dq)){
				?>
                    <option selected="selected" value="<?php echo $drow['id']; ?>"><?php echo $drow['coursecode']."(".$drow['coursename'].")"; ?></option>
                    <?php } ?>
                  </select>
                </div><div id="clist" style="display:none"></div></td>
              </tr>
              <tr>
                <td><strong>Venue</strong></td>
                <td><input name="venue" type="text" id="venue" size="69" value='<?php echo $row['venue']; ?>' /></td>
              </tr>
              <tr>
                <td><strong>Calendar Type</strong></td>
                <td><select name="cldtype" id="cldtype">
                  <option value="Holiday Calendar">Holiday Calendar</option>
                  <option value="Exam Routine">Exam Routine</option>
                  <option value="Holiday Calendar" <?php if ($row['section'] == 'Holiday Calendar') { ?> selected="selected" <?php } ?>>Holiday Calendar</option>
                  <option value="Exam Routine" <?php if ($row['section'] == 'Exam Routine') { ?> selected="selected" <?php } ?>>Exam Routine</option>
                </select></td>
              </tr>
              <tr>
                <td><strong>Image</strong></td>
                <td>
                	<label for="file"></label><input name="file" type="file" id="file" style="margin-bottom:20px;" />
                    <?php
						if ($row['image'] != '') {
					?>
                    <img src="<?php echo $images_folder.'/'.$row['image'];?>" style="display:block; margin-bottom:20px;" />
                    <input name="dimage" type="checkbox" id="dimage" value="1" /><label for="dimage">Check to delete current image</label>
                    <?php
						}
					?>
                </td>
              </tr>
              <tr>
                <td><strong>Image Alignment</strong></td>
                <td>
                	<select name="image_alignment" id="image_alignment">
                        <option value="left" <?php if ($row['image_alignment'] == 'left') { ?> selected="selected" <?php } ?>>Left</option>
                        <option value="right" <?php if ($row['image_alignment'] == 'right') { ?> selected="selected" <?php } ?>>Right</option>
                        <option value="center" <?php if ($row['image_alignment'] == 'center') { ?> selected="selected" <?php } ?>>Center</option>
                    </select>
                </td>
              </tr>
              <tr>
                <td><strong>Description</strong></td>
                <td><textarea id="description" name="description" class="tinymce"><?php echo $row['description']; ?></textarea></td>
              </tr>
              <tr>
                <td><strong>Link</strong></td>
                <td><input name="link" type="text" id="link" size="69" value='<?php echo $row['link']; ?>' /></td>
              </tr>
              <tr>
                <td><strong>Status</strong></td>
                <td><strong>
                  <?php $status = $row['status'];?>
                  <input type="radio" name="status" id="status" value="1" <?php if($status=='1') { echo 'checked="checked"'; }?> />
                  </strong><strong>Enable</strong><strong>
                  <input type="radio" name="status" id="status" value="0" <?php if($status=='0') { echo 'checked="checked"'; }?> />
                  Disable </strong></td>
              </tr>
              <tr>
              	<td>&nbsp;</td>
                <td><input type="submit" name="Submit" id="Submit" value="Update Event" /></td>
              </tr>
            </table>
        </form>
    </div>

<?php
	include_once('footer.php');
?>