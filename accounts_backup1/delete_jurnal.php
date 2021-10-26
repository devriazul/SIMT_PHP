<?php @session_start();
@ob_start();
//connect to database

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'simtdb';

$conn = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db($dbname);

$id = $_POST['id'];

if (isset($id)) {

$query = "delete from  tbl_tmpjurnal WHERE id = '$id'";

mysql_query($query) or die('Error, insert query failed');

}

?>