<?php
session_start();
include("../conn.php");

$id = $_GET['id'];

if (!empty($id)) {
	unset($_SESSION['products'][$id]);
	mysql_query("delete from tbl_tmpjurnal where accno='$id' and opby='$_SESSION[userid]' and vdate='".date("Y-m-d")."'") or die(mysql_error());
	mysql_query("delete from tbl_tmpjurnal where masteraccno='$id' and opby='$_SESSION[userid]' and vdate='".date("Y-m-d")."'") or die(mysql_error());
	
	mysql_query("delete from tbl_tmpjurnal where accno='$id' and opby='$_SESSION[userid]' and vdate='".$_SESSION['vdate']."'") or die(mysql_error());
	mysql_query("delete from tbl_tmpjurnal where masteraccno='$id' and opby='$_SESSION[userid]' and vdate='".$_SESSION['vdate']."'") or die(mysql_error());
	
	
	if (empty($_SESSION['products'])) {
		unset($_SESSION['products']);
	}
}