<?php
	require_once("eventer-config.php");
	
	session_start();

	$username = $_POST['name'];
	$password = $_POST['password'];
		
	$query = "SELECT username, password FROM eventer_admin WHERE username='$username' LIMIT 1";
	$recset = mysql_query( $query ) or die("error occured");
	
	if (mysql_num_rows( $recset ) > 0) {
		
		$row = mysql_fetch_assoc($recset);						
		
		//if($recset_row['password'] == $password){
		if (crypt($password, $row['password']) == $row['password']){
			$_SESSION['login'] = "ok";
			$_SESSION['username'] = $row['username'];
			header("Location: dashboard.php");
		}
		else {
			header("Location: index.php?error=password");
		}
	}
	else {
		header("Location: index.php?error=user&username=".$username);
	}
	
?>