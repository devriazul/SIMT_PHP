<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
	if($_SESSION['userid']){

	$vs="SELECT * from tbl_noticeboard WHERE storedstatus<>'D' and id='$_GET[id]'";
  	$r=$myDb->select($vs);
  	$row=$myDb->get_row($r,'MYSQL_ASSOC');


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>


<body>
<table width="1047" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1047" height="152" valign="top" background="images/1.jpg"><span class="style17">
      <?php include("topdefault.php");?>
    </span></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" id="tblleft">
        <tr>
          <td height="28" colspan="2" bgcolor="#0C6ED1"><div align="center" class="style1">SAIC INSTITUTE OF MANAGEMENT TECHNOLOGY</div></td>
        </tr>
        <tr>
          <td background="images/leftbg.jpg"><img src="images/leftbg.jpg" width="252" height="3" /></td>
          <td><img src="images/spaer.gif" width="1" height="1" /></td>
        </tr>
        <tr>
          <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php"); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
            <p>&nbsp;</p>
            <p>&nbsp;</p></td>
          <td width="79%" valign="top">
            <table width="98%" height="147" border="0"  cellpadding="8" cellspacing="1" id="stdtbl" align="center">
              <tr bgcolor="#F4F4FF">
                <td height="35" colspan="3"><div align="center"><strong>Notice Borad </strong></div></td>
              </tr>
              <tr>
                <td width="24%" bgcolor="#DFF4FF"><span class="style8">Published Date </span></td>
                <td width="1%">:</td>
                <td width="75%" bgcolor="#F5F5F5"><?php echo $row['adate'];?></td>
              </tr>
              <tr>
                <td bgcolor="#DFF4FF"><span class="style8">Headline</span></td>
                <td>:</td>
                <td bgcolor="#F5F5F5"><?php echo $row['headline'];?></td>
              </tr>
              <tr>
                <td bgcolor="#DFF4FF"><span class="style8">Full Notice </span></td>
                <td>:</td>
                <td bgcolor="#F5F5F5"><?php echo $row['description'];?></td>
              </tr>
            </table>
            <p align="center">&nbsp;</p>
            <p align="center" ><font face="Arial, Helvetica, sans-serif" size="2">
            </font></p>
                        <br />
            <div id="MyResult" align="center"></div>
          <p></p></td>
        </tr>
        <tr>
          <td height="61" colspan="2" valign="middle" bgcolor="#D3F3FE"><?php include("bot.php"); ?></td>
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
