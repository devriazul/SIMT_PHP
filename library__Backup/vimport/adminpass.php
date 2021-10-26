<? ob_start(); 
session_start();
if(!$_POST[user]){
include ("adminlogin.php");
}else{
include ("config.php");
 
$usedate= date ("Y-m-d");
$usetime= date("g:i a");  
$result=mysql_query("select * from adminuser where userid='$_POST[user]'");
$row=mysql_fetch_array($result);


$user1=$row["userid"];
$password1=$row["password"];


if (($user1== $_POST[user])&&($password1 == $_POST[password])&&($row['security'] == 1))
    {
	$bpaddsesid=$_POST[user];
    $_SESSION[bpaddsesid]=$bpaddsesid;

    header("location:home.php");
	 }else if(($user1== $_POST[user])&&($password1 == $_POST[password])&&($row['security'] == 2))
    {
	$bpaddsesid=$_POST[user];
    $_SESSION[bpaddsesid]=$bpaddsesid;

    header("location:massmail2.php");
	   
	
	 }  
	
	else{
	 echo "<center><font face=verdana size=1 color='red'><b>Your User ID & Password Is Not Correct</b></font></center>";
	 echo "<br>";
	  include ("adminlogin.php");
	   }
	}
?>