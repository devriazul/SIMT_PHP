<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
	if($_SESSION['userid']){

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
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
.style7 {
	color: #FFFFFF;
	font-family: Calibri;
	font-size: x-small;
}
.style10 {font-family:"Trebuchet MS"; font-weight: bold; font-size: 12px; }
-->
</style></head>

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
            <table height="76" align="center" border="0" cellpadding="4" cellspacing="0" id="stdtbl">
              <tr bgcolor="#DFF4FF">
                <td width="119" height="25" class="gridTblHead style2">Published Date </td>
                <td width="479" height="25" class="gridTblHead style2"><div align="left">Headline</div></td>
                <td width="169" class="gridTblHead style2">Status</td>
              </tr>
              <?php
			     
  			$crs="SELECT * FROM `tbl_noticeboard` WHERE storedstatus<>'D' and status='Active' and noticefor in('Office Staff','All') order by id desc";
  				  
			$crq=$myDb->select($crs); 
			$count=0;
  			while($crsr=$myDb->get_row($crq,'MYSQL_ASSOC')){
			if($count%2==0){
			$bgcolor="#FFFFFF";
				  ?>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td class="gridTblValue style4"><?php echo $crsr['adate'];?> </td>
                <td class="gridTblValue style4" ><a href="noticeboarddetails.php?id=<?php echo $crsr['id']; ?>"><?php echo $crsr['headline']; ?></a></td>
                <td class="gridTblValue style4"><?php echo $crsr['status']; ?></td>
              </tr>
              <?php }else{ $bgcolor="#F7FCFF"; ?>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td class="gridTblValue style4"><?php echo $crsr['adate'];?> </td>
                <td class="gridTblValue style4" ><a href="noticeboarddetails.php?id=<?php echo $crsr['id']; ?>"><?php echo $crsr['headline']; ?></a></td>
                <td class="gridTblValue style4"><?php echo $crsr['status']; ?></td>
              </tr>
              <?php }
			  	 	$count++;
			  }
			  
			?>
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
