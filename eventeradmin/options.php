<?php
	include_once('eventer-config.php');
	include_once('session-check.php');
	
	if(isset($_POST['Submit']))  {
		$color_theme = $_POST['color_theme'];
		$calendar_padding = $_POST['calendar_padding'];
		$calendar_background_width = $_POST['calendar_background_width'];
		
		$date_box_width = $_POST['date_box_width'];
		$date_box_height = $_POST['date_box_height'];
		$date_box_horizontal_space = $_POST['date_box_horizontal_space'];
		$date_box_vertical_space = $_POST['date_box_vertical_space'];
		$date_box_corner_radius = $_POST['date_box_corner_radius'];
		$date_box_bg_color = $_POST['date_box_bg_color'];
		$empty_date_box_alpha = $_POST['empty_date_box_alpha'];
		$today_date_box_bg_color = $_POST['today_date_box_bg_color'];
		
		$date_format = $_POST['date_format'];
		$starting_week_day = $_POST['starting_week_day'];
		$week_day_names_format = $_POST['week_day_names_format'];
		$week_day_names_short = $_POST['week_day_names_short'];
		$week_day_names_long = $_POST['week_day_names_long'];
		
		$month_names_format = $_POST['month_names_format'];
		$month_names_short = $_POST['month_names_short'];
		$month_names_long = $_POST['month_names_long'];
		$show_months_navigation = $_POST['show_months_navigation'];
		
		$repeat_events = $_POST['repeat_events'];
		$time_zone = $_POST['time_zone'];
		
		$query=" UPDATE `eventer_optionshces` SET `color_theme` =  '$color_theme', `date_box_width` =  '$date_box_width', `date_box_height` = '$date_box_height', `date_box_horizontal_space` = '$date_box_horizontal_space', `date_box_vertical_space` = '$date_box_vertical_space', `date_box_corner_radius` = '$date_box_corner_radius', `date_box_bg_color` = '$date_box_bg_color', `empty_date_box_alpha` = '$empty_date_box_alpha', `today_date_box_bg_color` = '$today_date_box_bg_color', `date_format` = '$date_format', `starting_week_day` = '$starting_week_day', `week_day_names_short` = '$week_day_names_short', `week_day_names_long` = '$week_day_names_long', `week_day_names_format` = '$week_day_names_format', `month_names_short` = '$month_names_short', `month_names_long` = '$month_names_long', `month_names_format` = '$month_names_format', `show_months_navigation` = '$show_months_navigation', `calendar_padding` =  '$calendar_padding', `calendar_background_width` =  '$calendar_background_width', `repeat_events` = '$repeat_events'";
		
		$result = mysql_query($query) or die(mysql_error());
		
		if ($result) {
			
		}
	}
	
?>
<?php
	include_once('header.php');
	include_once('menu.php');
?>
<?php
	$recset = mysql_query("SELECT * FROM eventer_optionshces LIMIT 1") or die(mysql_error());
	$row = mysql_fetch_assoc($recset);
?>
    
	<div id="content">
        <div class="content-header">
            <h1 class="title">Eventer Options</h1>
        </div>
        <form action="" method="post">
            <table border="0" class="rows">
            	<tr>
                    <td><strong>Color Theme</strong></td>
                    <td><label for="color_theme"></label>
                        <select name="color_theme" id="color_theme">
                            <option value="Light" <?php if ($row['color_theme'] == 'Light') { ?> selected="selected" <?php } ?>>Light</option>
                            <option value="Dark" <?php if ($row['color_theme'] == 'Dark') { ?> selected="selected" <?php } ?>>Dark</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="200"><strong>Calendar Padding</strong></td>
                    <td>
                        <label for="calendar_padding"></label>
                        <input type="text" name="calendar_padding" id="calendar_padding" size="69" value="<?php echo $row['calendar_padding']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td width="200"><strong>Calendar Background Width</strong></td>
                    <td>
                        <label for="calendar_background_width"></label>
                        <select name="calendar_background_width" id="calendar_background_width">
                            <option value="100%" <?php if ($row['calendar_background_width'] == '100%') { ?> selected="selected" <?php } ?>>100%</option>
                            <option value="Fixed" <?php if ($row['calendar_background_width'] == 'Fixed') { ?> selected="selected" <?php } ?>>Fixed</option>
                        </select>
                    </td>
                    </td>
                </tr>
                <tr>
                    <td width="200"><strong>Date Box Width</strong></td>
                    <td>
                        <label for="date_box_width"></label>
                        <input type="text" name="date_box_width" id="date_box_width" size="69" value="<?php echo $row['date_box_width']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td><strong>Date Box Height</strong></td>
                    <td><label for="date_box_height"></label>
                        <input type="text" name="date_box_height" id="date_box_height" size="69" value="<?php echo $row['date_box_height']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td><strong>Date Box Horizontal Space</strong></td>
                    <td><label for="date_box_horizontal_space"></label>
                        <input type="text" name="date_box_horizontal_space" id="date_box_horizontal_space" size="69" value="<?php echo $row['date_box_horizontal_space']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td><strong>Date Box Vertical Space</strong></td>
                    <td><label for="date_box_vertical_space"></label>
                        <input type="text" name="date_box_vertical_space" id="date_box_vertical_space" size="69" value="<?php echo $row['date_box_vertical_space']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td><strong>Date Box Corner Radius</strong></td>
                    <td><label for="date_box_corner_radius"></label>
                        <input type="text" name="date_box_corner_radius" id="date_box_corner_radius" size="69" value="<?php echo $row['date_box_corner_radius']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td><strong>Date Box BG Color</strong></td>
                    <td><label for="date_box_bg_color"></label>
                        <input type="text" name="date_box_bg_color" id="date_box_bg_color" size="69" value="<?php echo $row['date_box_bg_color']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td><strong>Today Date Box BG Color</strong></td>
                    <td><label for="today_date_box_bg_color"></label>
                        <input type="text" name="today_date_box_bg_color" id="today_date_box_bg_color" size="69" value="<?php echo $row['today_date_box_bg_color']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td><strong>Empty Date Box Alpha</strong></td>
                    <td><label for="empty_date_box_alpha"></label>
                        <input type="text" name="empty_date_box_alpha" id="empty_date_box_alpha" size="69" value="<?php echo $row['empty_date_box_alpha']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td><strong>Date Format</strong></td>
                    <td><label for="date_format"></label>
                        <select name="date_format" id="date_format">
                            <option value="USA" <?php if ($row['date_format'] == 'USA') { ?> selected="selected" <?php } ?>>USA</option>
                            <option value="UK" <?php if ($row['date_format'] == 'UK') { ?> selected="selected" <?php } ?>>UK</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>Starting Week Day</strong></td>
                    <td><label for="starting_week_day"></label>
                        <select name="starting_week_day" id="starting_week_day">
                            <option value="0" <?php if ($row['starting_week_day'] == 0) { ?> selected="selected" <?php } ?>>Sunday</option>
                            <option value="1" <?php if ($row['starting_week_day'] == 1) { ?> selected="selected" <?php } ?>>Monday</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>Week Day Names Format</strong></td>
                    <td><label for="week_day_names_format"></label>
                        <select name="week_day_names_format" id="week_day_names_format">
                            <option value="short" <?php if ($row['week_day_names_format'] == 'short') { ?> selected="selected" <?php } ?>>Short</option>
                            <option value="long" <?php if ($row['week_day_names_format'] == 'long') { ?> selected="selected" <?php } ?>>Long</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>Week Day Names Short</strong></td>
                    <td><label for="week_day_names_short"></label>
                        <input type="text" name="week_day_names_short" id="week_day_names_short" size="69" value="<?php echo $row['week_day_names_short']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td><strong>Week Day Names Long</strong></td>
                    <td><label for="week_day_names_long"></label>
                        <input type="text" name="week_day_names_long" id="week_day_names_long" size="69" value="<?php echo $row['week_day_names_long']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td><strong>Month Names Format</strong></td>
                    <td><label for="month_names_format"></label>
                        <select name="month_names_format" id="month_names_format">
                            <option value="short" <?php if ($row['month_names_format'] == 'short') { ?> selected="selected" <?php } ?>>Short</option>
                            <option value="long" <?php if ($row['month_names_format'] == 'long') { ?> selected="selected" <?php } ?>>Long</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>Month Names Short</strong></td>
                    <td><label for="month_names_short"></label>
                        <input type="text" name="month_names_short" id="month_names_short" size="69" value="<?php echo $row['month_names_short']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td><strong>Month Names Long</strong></td>
                    <td><label for="month_names_long"></label>
                        <input type="text" name="month_names_long" id="month_names_long" size="69" value="<?php echo $row['month_names_long']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td><strong>Show Months Navigation</strong></td>
                    <td><label for="show_months_navigation"></label>
                        <select name="show_months_navigation" id="show_months_navigation">
                            <option value="1" <?php if ($row['show_months_navigation'] == 1) { ?> selected="selected" <?php } ?>>Yes</option>
                            <option value="0" <?php if ($row['show_months_navigation'] == 0) { ?> selected="selected" <?php } ?>>No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>Repeat Events</strong></td>
                    <td><label for="repeat_events"></label>
                        <select name="repeat_events" id="repeat_events">
                            <option value="1" <?php if ($repeat_events == 1) { ?> selected="selected" <?php } ?>>Yes</option>
                            <option value="0" <?php if ($repeat_events == 0) { ?> selected="selected" <?php } ?>>No</option>
                        </select>
                    </td>
                </tr>
                <?php /*?><tr>
                    <td><strong>Time Zone</strong></td>
                    <td><label for="time_zone"></label>
                        <input type="text" name="time_zone" id="time_zone" size="69" value="<?php echo $row['time_zone']; ?>" />
                    </td>
                </tr><?php */?>
                <tr>
                    <td>&nbsp;</td>
                    <td height="34" colspan="2"><input type="submit" name="Submit" id="Submit" value="Update Options" class="btn" /></td>
                </tr>
            </table>
        </form>
    </div>

<?php
	include_once('footer.php');
?>