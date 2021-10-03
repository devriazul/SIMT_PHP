<?php @session_start();
@ob_start();
//connect to database

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'simtdb';

$conn = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db($dbname);

//NOTE: MAKE SURE YOU DO YOUR OWN APPROPRIATE SERVERSIDE ERROR CHECKING HERE!!!
if(!empty($_POST) && isset($_POST))
{
	//make variables safe to insert
  //$name = mysql_real_escape_string($_POST['name']);
 // $surname = mysql_real_escape_string($_POST['surname']);

	
	$mx=mysql_query("SELECT max(id) mid FROM tbl_masterjournal") or die(mysql_error());
	$mxf=mysql_fetch_array($mx);
	$maxid=$mxf['mid']+1;
	$voucherid="VR-".$_POST['vouchertype']."/".$maxid;
	$sql = "INSERT INTO tbl_masterjournal(voucherid,voucherdate,vouchertype,opby,opdate,storedstatus)
		VALUES('$voucherid','$_POST[voucherdate]','$_POST[vouchertype]','$_SESSION[userid]','".date("Y-m-d")."','I')";
	$result = mysql_query($sql);
	
	if(!($result))
	{
		echo "Failed to insert record";
	}
	else
	{
		echo "Record inserted successfully";
	}
}
?>
