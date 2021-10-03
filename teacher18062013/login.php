<?php 
// Database connection
//include("connection.php");
ob_start();
session_start();
require_once('dbClass.php');
$myDb=new DbClass;
$host='localhost';
$user='root';
$pwd='';
$db='simt_edu';

if($myDb->connect($host,$user,$pwd,$db,true))
{  
  
// AJAX JQuery Validation 
include("validation/validation.php");

// Condition checks Submit button is set or not
if(isset($_POST["btnlogin"]))
{
	$uname=mysql_real_escape_string($_POST['adminid']);
	$password=mysql_real_escape_string(md5($_POST['password']));
	
	// Select username and password from admin table
	$result = mysql_query("SELECT * FROM tbl_login WHERE userid='$uname' AND password='$password'");

	// Query checks Entered user id is valid or not...
	if(mysql_num_rows($result) == 1)
	{
	
		// 	redirects to admindashboard.php
		header("Location: acchome.php");
	}
	else
	{
	
		// "Login Failed.. Please try again" message stores in variable $abc
		$abc="Login Failed.. Please try again";
	}
}
}
?>

<form name="formID" id="formID" class="formular" method="post" action="">
<p align="center"><b> <u><h2>Login Page </h2></u><br>Enter User ID and Password to Login website <br>
<font color="#FF0000">
<?php 
// prints if its invalid password
echo $abc; 
?>
</font></b>
</p>
 <p> <strong>User Name :
          <input type="text" name="adminid" id="adminid"  class="validate[required] text-input"/>
          </strong></p>
          <p><strong>Password :
          <input type="password" name="password" id="password" class="validate[required] text-input" />
          </strong></p>
          <p>
            <strong>
            <input class="submit"  type="submit" name="btnlogin" id="btnlogin" value="Login" />
            <input class="submit"  type="reset" name="button2" id="button2" value="Reset" />
            <br />
          </strong></p><p>&nbsp;</p><p>&nbsp;</p>
          <p>
</form>