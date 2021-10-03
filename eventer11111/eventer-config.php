<?php
$server_link = mysql_connect("localhost", "root", "") or die(mysql_error());
$db_link = mysql_select_db("simtdb") or die(mysql_error());
?>