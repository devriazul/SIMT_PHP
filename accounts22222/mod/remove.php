<?php
session_start();
mysql_connect("localhost","root","");
mysql_select_db("simtdb");

$id = $_GET['id'];

if (!empty($id)) {
	unset($_SESSION['products'][$id]);
	mysql_query("delete from tbl_tmpjurnal where id='$id'") or die(mysql_error());
	if (empty($_SESSION['products'])) {
		unset($_SESSION['products']);
	}
}