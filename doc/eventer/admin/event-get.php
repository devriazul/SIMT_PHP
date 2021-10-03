<?php 
	
	require_once('eventer-config.php');
	
	if (isset($_GET['eventID'])) {
		$eventID = $_GET['eventID'];
		$recset = mysql_query("SELECT * FROM `eventer_events` WHERE id='$eventID' LIMIT 1") or die(mysql_error());	
		
		if (mysql_num_rows($recset)) {
			$option_recset = mysql_query("SELECT date_format FROM eventer_options");
			$option_row = mysql_fetch_assoc($option_recset);
			$date_format = $option_row['date_format'];
			if ($date_format == "UK") {
				$date_value_format = "d-m-Y";
			}
			else {
				$date_value_format = "m-d-Y";
			}
			
			$row = mysql_fetch_assoc($recset);
			if ($row['start_date'] != '') {
				$row['start_date'] = date($date_value_format, strtotime($row['start_date']));
			}
			
			if ($row['end_date'] != '') {
				$row['end_date'] = date($date_value_format, strtotime($row['end_date']));
			}
			echo json_encode(array("status"=>"success", "eventData"=>$row));
		}
		else {
			echo json_encode(array("status"=>"error"));
		}
	}
	else {
		echo json_encode(array("status"=>"error"));
	}

?>