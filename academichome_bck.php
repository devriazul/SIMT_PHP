<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
	if($_SESSION['userid'])
	{
		$uname= $_SESSION['userid'];
		$edate=date("Y-m-d");
		$queryx="SELECT*FROM tbl_attendance WHERE efid='$uname' AND edate='$edate'";
     	$rx=$myDb->select($queryx);
	 	$rowx=$myDb->get_row($rx,'MYSQL_ASSOC');
		
		$id=$myDb->select("Select * from tbl_staffinfo WHERE sid='$_SESSION[userid]'");
		$fid=$myDb->get_row($id,'MYSQL_ASSOC');



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
.style16 {font-size: 12px; font-weight:bold;}

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
        <td><div align="center"><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['t'])==0){ ?><span style="color:#FF6600; font-weight:bold;"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></span><?php } ?></font></div></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("academicleft.php");?>         <br />
          <p>&nbsp;</p>
          <p>&nbsp;</p></td><td width="79%" valign="top"><blockquote>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p align="center"><span class="style16">Intregrated Institute Management System (IIMS)</p>
            <p align="center">Welcome </br></br><?php echo $fid['name']; ?></p>
			
            <p align="center"><?php if($fid['img']!=""){?><img name="" src="staffphoto/<?php echo $fid['img']; ?>" width="100" height="105" border="1" alt="" /><?php } else { if($fid['sex']=="Male"){?><img name="" src="staffphoto/male.jpg" width="100" height="105" border="1" alt="" /><?php }else{?> <img name="" src="staffphoto/female.jpg" width="100" height="105" border="1" alt="" /><?php }}?></p>
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
				$lateinstatus=$_SESSION['lateinstatus'];
				
				
	    		$query="INSERT INTO tbl_attendance(`efid`,`edate`,`intime`,`accid`,`monthname`,`yearname`,`instatus`) VALUES('$userid',CURDATE(),CURTIME(),'$accid','$curmonth','$curyear','$lateinstatus')";
				$myDb->insert_sql($query);

				$st="SELECT `tbl_attendancesettings`.*, TIMEDIFF(CURTIME(),stdintime) as td, HOUR(TIMEDIFF(CURTIME(),stdintime)) as hrs, MINUTE(TIMEDIFF(CURTIME(),stdintime)) as mins FROM `tbl_attendancesettings` WHERE accid=41";
				$stq=$myDb->select($st);
				$str=$myDb->get_row($stq,'MYSQL_ASSOC');
				//$td=$str['td'];
				$totalmins=($str['hrs']*60)+$str['mins'];
				if($totalmins<$str['maxallow'])
				{
					$mg='<span style="font-size:12px; color:#006600; font-weight:bold; ">Present</span>';
				}
				
				else if(($totalmins>$str['minallow']) && ($totalmins<$str['maxallow']))
				{
					$mg='<span style="font-size:12px; color:#00FF00; font-weight:bold; ">Late Present</span>';
				}
				else if($totalmins>$str['maxallow'])
				{
					$mg='<span style="font-size:12px; color:#FF0000; font-weight:bold; ">Absent</span>';
				}


		 ?>
				<span style="font-size:12px; color:#006600; font-weight:bold; ">Your attendance is collected successfully. And you are: <?php echo $mg;?> today.</span>
		  <?php }?>
			<p align="center"><?php
			$getjd="Select * from tbl_staffinfo Where sid='$uname'";
			$getr=$myDb->select($getjd);
			$getd=$myDb->get_row($getr,'MYSQL_ASSOC');

			$start_date = new DateTime($getd['joindate']);
			$since_start = $start_date->diff(new DateTime(date('y-m-d')));
			//echo $since_start->days.' days total<br>';
			echo 'Your working experience in SIMT is: '.$since_start->y.' years, '. $since_start->m.' months and '.$since_start->d.' days.';
				//echo $since_start->m.' months<br>';
				//echo $since_start->d.' days<br>';
				//echo $since_start->h.' hours<br>';
				//echo $since_start->i.' minutes<br>';
				//echo $since_start->s.' seconds<br>';
			?></p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          </blockquote>
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
  header("Location:login.php");
}
}  
?>
