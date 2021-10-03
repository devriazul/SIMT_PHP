<?php 
// change this with your our server, user, password, and database name:
// mysql_connect("localhost", "root", "") or die(mysql_error());
// mysql_select_db("tree") or die(mysql_error());

$conn = mysql_connect("localhost", "root", "dtbd13adm1n") or die(mysql_error());
mysql_select_db("simtdb") or die(mysql_error());
?>