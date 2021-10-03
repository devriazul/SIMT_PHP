<?php

	require_once("eventer-config.php");
	
	$storage = "../images/";
	$file = basename($_FILES['uploadfile']['name']);
	
	if ( move_uploaded_file($_FILES['uploadfile']['tmp_name'] , $storage.''.$file ) ) {
		
		$query = "INSERT INTO eventer_images(`path`) VALUES('$file')";
		$result = mysql_query($query);
		if ($result) {
			echo "1";
		}
		else {
			echo "0";
		}
	}
	else{
		echo "0";
	}

?>
