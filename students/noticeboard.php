<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<link href="css.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {

	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style1 {
	color: #999999;
	font-weight: bold;
}
#Layer1 {
	position:absolute;
	left:118px;
	top:70px;
	width:123px;
	height:21px;
	z-index:1;
}
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style3 {color: #082F5A}
.style4 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style5 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.style6 {font-family: Arial, Helvetica, sans-serif; font-size: 14px; }
.style7 {
	color: #FFFFFF;
	font-family: Calibri;
	font-size: x-small;
}
-->
</style></head>

<body>
<div class="style2" id="Layer1">
  <div align="center" class="style3">Ver : 1.0.0.1 </div>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5%" valign="top" background="images/leftinbg.jpg"><table width="100" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5%"><img src="images/topleft.jpg" width="265" height="113" /></td>
      </tr>
      <tr>
        <td background="images/leftinbg.jpg"><img src="images/leftinbg.jpg" width="265" height="3" /></td>
      </tr>
      <tr>
        <td background="images/leftinbg.jpg" class="Jlink"><table width="254" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td><?php include("left.php"); ?></td>
            </tr>
          </table>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
      </tr>
    </table></td>
    <td width="95%" valign="top" align="center" bgcolor="#FFFFFF" style="background-image: url(images/botbg.jpg); background-repeat: no-repeat; background-position: bottom;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td background="images/topbarbg.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="1%"><img src="images/topbarbg.jpg" width="3" height="44" /></td>
            <td width="99%"><div align="center" class="style1" ><font face="verdana" size="5">S t u d e n t &nbsp;W e b &nbsp;P a n e l</font></div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><p>&nbsp;</p>
          <table width="80%" height="103" border="0" align="center" cellpadding="8" cellspacing="2" bgcolor="#082F5A" >
            <tr bgcolor="#DFF4FF">
              <td width="119" height="25" class="style2">Published Date </td>
              <td width="479" height="25" class="style2"><div align="left">Headline</div></td>
              <td width="169" class="style2">Status</td>
              </tr>
            <?php
			     
  			$crs="SELECT * FROM `tbl_noticeboard` WHERE storedstatus<>'D' and status='Active' and noticefor in('Students','All') order by id desc";
  				  
			$crq=$myDb->select($crs); 
			$count=0;
  			while($crsr=$myDb->get_row($crq,'MYSQL_ASSOC')){
			if($count%2==0){
			$bgcolor="#FFFFFF";
				  ?>
            <tr bgcolor="<?php echo $bgcolor; ?>">
              <td class="style4"><?php echo $crsr['adate'];?>                  </td>
              <td class="style4" ><a href="noticeboarddetails.php?id=<?php echo $crsr['id']; ?>"><?php echo $crsr['headline']; ?></a></td>
              <td class="style4"><?php echo $crsr['status']; ?></td>
              </tr>
            <?php }else{ $bgcolor="#F7FCFF"; ?>
            <tr bgcolor="<?php echo $bgcolor; ?>">
              <td class="style4"><?php echo $crsr['adate'];?>                  </td>
              <td class="style4" ><a href="noticeboarddetails.php?id=<?php echo $crsr['id']; ?>"><?php echo $crsr['headline']; ?></a></td>
              <td class="style4"><?php echo $crsr['status']; ?></td>
              </tr>
            <?php }
			  	 	$count++;
			  }
			  
			?>
          </table>          <p class="style4">&nbsp;</p>
          <p class="style4">&nbsp;</p>
          <p class="style4">&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
      </tr>

    </table></td>
  </tr>
  <tr>
    <td colspan="2" background="images/bbg.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="1%"><img src="images/bbg.jpg" width="3" height="44" /></td>
        <td width="99%"><div align="center" class="style7">� Copyright All Rights Reserved. Powered By: <a href="https://riaz.fastitbd.com">(Web Developer) </a><a href="https://www.saicgroupbd.com">Saic Group</a></div></td>
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
?>
