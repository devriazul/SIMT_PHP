<?php

$conn = @mysql_connect('localhost','root','dtbd13adm1n');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
mysql_select_db('jquerycrud', $conn);

?>