<?php
session_start();
include("../conn.php");

$id = $_GET['id'];

if (!empty($id)) {

    $chk=mysql_query("SELECT*FROM tbl_tmpjurnal where id='$id' and opby='$_SESSION[userid]'") or die(mysql_error());
	$chkf=mysql_fetch_array($chk);
	if(!empty($chkf['id'])){
		if($chkf['masteraccno']>0){ 
			unset($_SESSION['products'][$id]);
			mysql_query("delete from tbl_tmpjurnal where id='$id' and opby='$_SESSION[userid]'") or die(mysql_error());
		}else{
			mysql_query("delete from tbl_tmpjurnal where masteraccno='$chkf[accno]' and opby='$_SESSION[userid]'") or die(mysql_error());
			mysql_query("delete from tbl_tmpjurnal where id='$id' and opby='$_SESSION[userid]'") or die(mysql_error());
			unset($_SESSION['products'][$id]);
			if (empty($_SESSION['products'])) {
				unset($_SESSION['products']);
			}
		}
	}
		if (empty($_SESSION['products'])) {
			unset($_SESSION['products']);
		}
	
}