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
		$query = mysql_query("SELECT * FROM `eventer_events` WHERE `id` = '$event_id'") or die(mysql_error());
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
		
		$image = $_FILES['file']['name'];
		$tmp = $_FILES['file']['tmp_name'];
		
		$image_alignment = $_POST['image_alignment'];
		
		$fdir = $images_folder.$image;
		
		// to run the query for insertion of data....
		
		$query=" UPDATE `eventer_events` SET `title` =  '$title', `start_date` = '$start_date', `end_date` = '$end_date', `start_time` = '$start_time', `end_time` = '$end_time', `description` = '$description', `venue` = '$venue', `image_alignment` = '$image_alignment', `link` = '$link' , `status` = '$status'";
		
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
	$query = "SELECT * FROM eventer_events WHERE id='$eventID'";
	$recset = mysql_query($query);
	$row = mysql_fetch_assoc($recset);
?>
    
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
                <td><strong>Venue</strong></td>
                <td><input name="venue" type="text" id="venue" size="69" value='<?php echo $row['venue']; ?>' /></td>
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