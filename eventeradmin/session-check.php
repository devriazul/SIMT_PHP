<?php
	session_start();
	
	//Check if user is logged in
	if( !isset( $_SESSION['login']) || $_SESSION['login'] != 'ok' ){
		header("Location: index.php");
	}
?>