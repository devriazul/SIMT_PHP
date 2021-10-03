<?php
	include_once('eventer-config.php');
	include_once('session-check.php');
?>
<?php
	$images_folder = "../images/";
	
	// to check if Submit button is clicked...
	if(isset($_POST['Submit'])) {
		$title = $_POST['title'];
		
		if (isset($_POST['start_date']) && $_POST['start_date'] != '') {
			$date = $_POST['start_date'];
			$dateArr = explode("-",$date);
			
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
			$dateArr = explode("-",$date);
			
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
		
		$image = $_FILES['file']['name'];
		$tmp = $_FILES['file']['tmp_name'];
		
		$image_alignment = $_POST['image_alignment'];
		
		$fdir = $images_folder.$image;
		
		if($image) {
			move_uploaded_file($tmp,$fdir) or die("file uploading failed");
		}
		
		$description = $_POST['description'];
		$venue = $_POST['venue'];
		
		$link = $_POST['link'];
		$status = $_POST['status'];
		
		$query = "INSERT INTO `eventer_events` (`start_date`, `end_date`, `start_time`, `end_time`, `title`, `description`, `venue`, `link`, `image`, `image_alignment`, `status`) VALUES ('$start_date', '$end_date', '$start_time', '$end_time', '$title', '$description', '$venue', '$link', '$image', '$image_alignment', '$status'); ";
		mysql_query($query) or die(mysql_error());
		
		header("Location:events.php?Msg=Record+Inserted+Successfully");
	}
?>
<?php
	include_once('header.php');
	include_once('menu.php');
?>
    
	<div id="content">
        <div class="content-header">
        <h1 class="title">New Event</h1>
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
              <input name="title" type="text" id="title" size="69" /></td>
            </tr>
            <tr>
              <td><strong>Date</strong></td>
				<?php
					$option_recset = mysql_query("SELECT date_format FROM eventer_options");
					$option_row = mysql_fetch_assoc($option_recset);
					$date_format = $option_row['date_format'];
					if ($date_format == "UK") {
						$date_picker_format = "DD-MM-YYYY";
					}
					else {
						$date_picker_format = "MM-DD-YYYY";
					}
                ?>
              <td><input name="start_date" type="text" class="flatedit" id="start_date" size="29" datepicker="true" datepicker_format="<?php echo $date_picker_format; ?>"></td>
            </tr>
            <tr>
              <td><strong>Date</strong></td>
              <td><input name="end_date" type="text" class="flatedit" id="end_date" size="29" datepicker="true" datepicker_format="<?php echo $date_picker_format; ?>"></td>
            </tr>
            <tr>
                <td><strong>Start Time</strong></td>
                <td>
                    <select name="start_hour" id="start_hour">
                    <option value="-1">Hour</option>
                    <?php
                        $start_hour = 0;
                        while($start_hour < 24) {
                    ?>
                    <option value="<?php echo $start_hour; ?>"><?php echo $start_hour++; ?></option>
                    <?php
                        }
                    ?>
                    </select>
                    <select name="start_minutes" id="start_minutes">
                    <option value=":00">Minutes</option>
                    <?php
                        $minutes = 0;
                        while($minutes < 60) {
                    ?>
                    <option value="<?php echo ':'.$minutes; ?>"><?php echo $minutes++; ?></option>
                    <?php
                        }
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><strong>End Time</strong></td>
                <td>
                    <select name="end_hour" id="end_hour">
                    <option value="-1">Hour</option>
                    <?php
                        $end_hour = 0;
                        while($end_hour < 24) {
                    ?>
                    <option value="<?php echo $end_hour; ?>"><?php echo $end_hour++; ?></option>
                    <?php
                        }
                    ?>
                    
                    </select> 
                    
                    <select name="end_minutes" id="end_minutes">
                    <option value=":00">Minutes</option>
                    <?php
                        $minutes = 0;
                        while($minutes < 60) {
                    ?>
                    <option value="<?php echo ':'.$minutes; ?>"><?php echo $minutes++; ?></option>
                    <?php
                        }
                    ?>
                    
                    </select>
                </td>
            </tr>
            <tr>
                <td><strong>Venue</strong></td>
                <td><input name="venue" type="text" id="venue" size="69" value="" /></td>
            </tr>
            <tr>
                <td><strong>Image</strong></td>
                <td><label for="file"></label><input name="file" type="file" id="file" size="29" /></td>
            </tr>
            <tr>
                <td><strong>Image Alignment</strong></td>
                <td>
                	<select name="image_alignment" id="image_alignment">
                        <option value="left">Left</option>
                        <option value="right">Right</option>
                        <option value="center">Center</option>
                    </select>
                </td>
              </tr>
            <tr>
                <td><strong>Description</strong></td>
                <td><textarea id="description" name="description" class="tinymce"></textarea></td>
            </tr>
            <tr>
                <td><strong>Link</strong></td>
                <td><input name="link" type="text" id="link" size="69" /></td>
            </tr>
            <tr>
                <td><strong>Status</strong></td>
                <td><input type="radio" name="status" id="status" value="1" checked="checked"/><strong>Enable</strong><input type="radio" name="status" id="status" value="0" /><strong>Disable</strong></td>
            </tr>
            <tr>
            	<td>&nbsp;</td>
            	<td><input type="submit" name="Submit" id="Submit" value="Add Event" /></td>
            </tr>
          </table>
        </form>
    </div>

<?php
	include_once('footer.php');
?>