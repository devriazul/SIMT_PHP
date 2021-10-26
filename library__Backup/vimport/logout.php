<? session_start();
include ("config.php");

session_destroy();
echo ("<br><center><font face=verdana size=2 color='#123453'>You have logout from admin panel !<br></center>");
include ("index.php");

?>
