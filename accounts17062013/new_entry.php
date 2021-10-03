<?php
session_start();
mysql_connect("localhost","root","");
mysql_select_db("simtdb");

unset($_SESSION['products']);
header("Location:add_jurnal.php");
?>