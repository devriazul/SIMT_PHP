<?php 
ob_start();
session_start();
require_once('dbClass.php');

session_destroy();
header("Location:index.php");

?>