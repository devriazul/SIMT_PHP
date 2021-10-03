<?php
	include_once('eventer-config.php');
	include_once('classes/EventerCalendarVars.php');
	include_once('classes/EventerCalendarOptions.php');
	$eventerCalendarVars = new EventerCalendarVars();
	
	if (isset($_GET['eventer_month']) && $_GET['eventer_month'] !='') {
		$eventerCalendarVars->currentMonth = $_GET["eventer_month"];
	}
	else {
		$eventerCalendarVars->currentMonth = date('m');
	}
	
	if (isset($_GET['eventer_year']) && $_GET['eventer_year'] !='') {
		$eventerCalendarVars->currentYear = $_GET["eventer_year"];
	}
	else {
		$eventerCalendarVars->currentYear = date('Y');
	}
	
	$eventerCalendarVars->prevYear = $eventerCalendarVars->currentYear;
	$eventerCalendarVars->nextYear = $eventerCalendarVars->currentYear;
	$eventerCalendarVars->prevMonth = $eventerCalendarVars->currentMonth - 1;
	$eventerCalendarVars->nextMonth = $eventerCalendarVars->currentMonth + 1;
	
	if ($eventerCalendarVars->prevMonth == 0) {
		$eventerCalendarVars->prevMonth = 12;
		$eventerCalendarVars->prevYear = $eventerCalendarVars->currentYear - 1;
	}
	
	if ($eventerCalendarVars->nextMonth == 13) {
		$eventerCalendarVars->nextMonth = 1;
		$eventerCalendarVars->nextYear = $eventerCalendarVars->currentYear + 1;
	}
	
	$eventer_row = 0;
	$eventer_col = 0;
	
	$eventer_options_recset = mysql_query("SELECT * from eventer_options LIMIT 1");
	$eventer_options_row = mysql_fetch_assoc($eventer_options_recset);
	
	$eventerCalendarOptions = new EventerCalendarOptions();
	
	$eventerCalendarOptions->colorTheme = $eventer_options_row['color_theme'];
	
	$eventerCalendarOptions->calendarPadding = $eventer_options_row['calendar_padding'];
	$eventerCalendarOptions->calendarBackgroundWidth = $eventer_options_row['calendar_background_width'];
	
	$eventerCalendarOptions->dateBoxWidth = $eventer_options_row['date_box_width'];
	$eventerCalendarOptions->dateBoxHeight = $eventer_options_row['date_box_height'];
	$eventerCalendarOptions->dateBoxHorizontalSpace = $eventer_options_row['date_box_horizontal_space'];
	$eventerCalendarOptions->dateBoxVerticalSpace = $eventer_options_row['date_box_vertical_space'];
	$eventerCalendarOptions->dateBoxCornerRadius = $eventer_options_row['date_box_corner_radius'];
	
	$eventerCalendarOptions->dateBoxBGColor = $eventer_options_row['date_box_bg_color'];
	$eventerCalendarOptions->todayDateBoxBGColor = $eventer_options_row['today_date_box_bg_color'];
	$eventerCalendarOptions->emptyDateBoxAlpha = $eventer_options_row['empty_date_box_alpha'];
	
	$eventerCalendarOptions->dateFormat = $eventer_options_row['date_format'];
	$eventerCalendarOptions->startingWeekDay = $eventer_options_row['starting_week_day'];
	$eventerCalendarOptions->weekDayNamesShort = $eventer_options_row['week_day_names_short'];
	$eventerCalendarOptions->weekDayNamesLong = $eventer_options_row['week_day_names_long'];
	$eventerCalendarOptions->weekDayNamesFormat = $eventer_options_row['week_day_names_format'];
	$eventerCalendarOptions->monthNamesShort = $eventer_options_row['month_names_short'];
	$eventerCalendarOptions->monthNamesLong = $eventer_options_row['month_names_long'];
	$eventerCalendarOptions->monthNamesFormat = $eventer_options_row['month_names_format'];
	$eventerCalendarOptions->showMonthsNavigation = $eventer_options_row['show_months_navigation'];
	$eventerCalendarOptions->repeatEvents = $eventer_options_row['repeat_events'];
	
	if ($eventerCalendarOptions->showMonthsNavigation == '0') {
		$eventerCalendarVars->currentMonth = date('m');
		$eventerCalendarVars->currentYear = date('Y');
	}
	
	if ($eventerCalendarOptions->monthNamesFormat == 'short') {
		$eventerCalendarVars->monthNames = explode(',', $eventerCalendarOptions->monthNamesShort);
	}
	else {
		$eventerCalendarVars->monthNames = explode(',', $eventerCalendarOptions->monthNamesLong);
	}
	
	if ($eventerCalendarOptions->weekDayNamesFormat == 'long') {
		$eventerCalendarVars->weekDayNames = explode(',', $eventerCalendarOptions->weekDayNamesLong);
	}
	else {
		$eventerCalendarVars->weekDayNames = explode(',', $eventerCalendarOptions->weekDayNamesShort);
	}
	
	if ($eventerCalendarOptions->dateFormat == 'UK') {
		$eventerCalendarVars->dateFormatShort = 'dd-mm-YYYY';
		$eventerCalendarVars->dateFormatLong = 'd F Y';
	}
	else {
		$eventerCalendarVars->dateFormatShort = 'mm-dd-YYYY';
		$eventerCalendarVars->dateFormatLong = 'F d, Y';
	}
	
	if ($eventerCalendarOptions->startingWeekDay == 1) {
		// Move the Sunday from the end of the array to the start of array
		array_unshift($eventerCalendarVars->weekDayNames, array_pop($eventerCalendarVars->weekDayNames));
	}
	
	if ($eventerCalendarOptions->colorTheme == "Dark") {
?>
<link href="css/eventer-dark.css" rel="stylesheet" type="text/css"/>
<?php
	}
	else {
?>
<link href="css/eventer.css" rel="stylesheet" type="text/css"/>
<?php
	}
?>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.tinyscrollbar.min.js"></script>
<script type="text/javascript" src="js/eventer-1.0.min.js"></script>

<script type="text/javascript">
	jQuery.easing.def = "easeOutQuint";
	
	$(function(){
		$eventer_events_calendar = new EventerEventsCalendar('#eventer-events-calendar-container');
		$eventer_events_calendar.init(
			{
				calendarPadding:<?php echo $eventerCalendarOptions->calendarPadding; ?>,
				calendarBackgroundWidth:<?php echo "'".$eventerCalendarOptions->calendarBackgroundWidth."'"; ?>,
				dateBoxWidth:<?php echo $eventerCalendarOptions->dateBoxWidth; ?>,
				dateBoxHeight:<?php echo $eventerCalendarOptions->dateBoxHeight; ?>,
				dateBoxHSpace:<?php echo $eventerCalendarOptions->dateBoxHorizontalSpace; ?>,
				dateBoxVSpace:<?php echo $eventerCalendarOptions->dateBoxVerticalSpace; ?>,
				dateBoxCornerRadius:<?php echo $eventerCalendarOptions->dateBoxCornerRadius; ?>,
				dateBoxBGColor:'<?php echo $eventerCalendarOptions->dateBoxBGColor; ?>',
				todayDateBoxBGColor:'<?php echo $eventerCalendarOptions->todayDateBoxBGColor; ?>',
				emptyDateBoxAlpha:<?php echo $eventerCalendarOptions->emptyDateBoxAlpha; ?>
			}
		);
	});
</script>