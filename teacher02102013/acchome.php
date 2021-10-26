<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  	if($_SESSION['userid'])
	{
		$uname= $_SESSION['userid'];
		$edate=date("Y-m-d");
		$queryx="SELECT*FROM tbl_attendance WHERE efid='$uname' AND edate='$edate'";
     	$rx=$myDb->select($queryx);
	 	$rowx=$myDb->get_row($rx,'MYSQL_ASSOC');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<style type="text/css">
<!--
@import url("main.css");
.style12 {font-size: 10px}
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style16 {font-size: 12px}

-->
</style>
</head>

<body>
<table width="1047" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1047" height="152" valign="top" background="images/1.jpg"><span class="style17"><?php include("topdefault.php");?>    </span></span></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" id="tblleft">
      <tr>
        <td height="28" colspan="2" bgcolor="#0C6ED1"><div align="center" class="style1">SAIC INSTITUTE OF MANAGEMENT TECHNOLOGY</div></td>
        </tr>
      <tr>
        <td background="images/leftbg.jpg">&nbsp;</td>
        <td><div align="center"><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])) {echo $_GET['msg'];}?></font></div></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php");?><br />
          <p>&nbsp;</p>
          <p>&nbsp;</p></td><td width="79%" height="300" valign="top"><blockquote>

        </blockquote>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
	        <p align="center"><span class="style16"><?php if(($rowx['efid']==$uname) && ($rowx['edate']==$edate))
		  {?> 
		  		<span style="font-size:12px; color:#FF0000; font-weight:bold; ">Your attendance has already been collected for today.</span>
		  <?php }else
		  { 
				$query="SELECT*FROM tbl_login WHERE userid='$uname'";
     			$r=$myDb->select($query);
	 			$row=$myDb->get_row($r,'MYSQL_ASSOC');

				
				$userid=$row['userid'];
				$accid=$row['accid'];
				$curmonth= date('F');
				$curyear= date('Y');
	    		$query="INSERT INTO tbl_attendance(`efid`,`edate`,`intime`,`accid`,`monthname`,`yearname`) VALUES('$userid',CURDATE(),CURTIME(),'$accid','$curmonth','$curyear')";
				$myDb->insert_sql($query);
		 ?>
				<span style="font-size:12px; color:#006600; font-weight:bold; ">Your attendance is collected successfully.</span>
		  <?php }?>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p></td></tr>
      <tr>
        <td height="60" colspan="2" valign="middle" bgcolor="#D3F3FE"><?php include("bot.php"); ?></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<?php 
}else{
  header("Location:index.php");
	echo "sorry! u did mistake. please check corresponding.";
}
}  
?>
