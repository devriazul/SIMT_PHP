<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
	if($_SESSION['userid']){
	
	       
			     
  			$crs="SELECT *, (-DATEDIFF(frmdate,todate)) AS NoOfDays FROM tbl_leaveapplication Where applydate between '$_POST[fdate]' and '$_POST[tdate]' and storedstatus<>'D'";
  				  
			$crq=$myDb->select($crs); 
			$count=0;
  			$crsr=$myDb->get_row($crq,'MYSQL_ASSOC');
				

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
.style15 {
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
.style4 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style5 {font-weight: bold}
-->
</style></head>

<body>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" id="tblleft">
  <tr>
    <td height="28" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td height="28" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td height="28" bgcolor="#FFFFFF"><div align="center" class="style5"><?php include("rptheader.php");?></div></td>
  </tr>
  <tr>
    <td><img src="images/spaer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><div align="center"><strong>Leave Application Summary  Report </strong></div></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><div align="center" class="style15"><strong>Date Between:</strong> <?php echo $_POST['fdate'];?> <strong> To:</strong> <?php echo $_POST['tdate'];?></div></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="79%" valign="top">
      <table width="1118" height="69" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#666666" id="stdtbl">
        <tr bgcolor="#DFF4FF">
          <td width="46" height="25" class="style2"><strong>E/F Id </strong></td>
          <td width="147" class="style2"><strong>Name</strong></td>
          <td width="115" class="style2"><strong>Designation</strong></td>
          <td width="94" class="style2"><strong>Apply Date </strong></td>
          <td width="110" class="style2"><strong>Apply For </strong></td>
          <td width="78" height="25" class="style2"><div align="left"><strong>From Date </strong></div></td>
          <td width="79" class="style2"><strong>To Date </strong></td>
          <td width="124" class="style2"><strong>Total No of Day (s) </strong></td>
          <td width="174" class="style2"><strong>Reason</strong></td>
          <td width="89" class="style2"><strong>Status</strong></td>
        </tr>
		<?php while($crsr=$myDb->get_row($crq,'MYSQL_ASSOC')){
			if($count%2==0){
			$bgcolor="#FFFFFF";?>
        <tr bgcolor="<?php echo $bgcolor; ?>">
          <td height="18" class="style4"><?php echo $crsr['empid'];?> </td>
          <td class="style4" ><?php echo $crsr['name'];?></td>
          <td class="style4" ><?php echo $crsr['designation'];?></td>
          <td class="style4" ><?php echo $crsr['applydate'];?></td>
          <td class="style4" ><?php echo $crsr['applyfor'];?></td>
          <td class="style4" ><?php echo $crsr['frmdate']; ?></td>
          <td class="style4"><?php echo $crsr['todate']; ?></td>
          <td class="style4"><?php echo $crsr['NoOfDays'];?></td>
          <td class="style4"><?php echo $crsr['reason'];?></td>
          <td class="style4"><?php echo $crsr['status'];?></td>
        </tr>
        <?php }else{ $bgcolor="#F7FCFF"; ?>
        <tr bgcolor="<?php echo $bgcolor; ?>">
          <td height="18" class="style4"><?php echo $crsr['empid'];?> </td>
          <td class="style4" ><?php echo $crsr['name'];?></td>
          <td class="style4" ><?php echo $crsr['designation'];?></td>
          <td class="style4" ><?php echo $crsr['applydate'];?></td>
          <td class="style4" ><?php echo $crsr['applyfor'];?></td>
          <td class="style4" ><?php echo $crsr['frmdate']; ?></td>
          <td class="style4"><?php echo $crsr['todate']; ?></td>
          <td class="style4"><?php echo $crsr['NoOfDays'];?></td>
          <td class="style4"><?php echo $crsr['reason'];?></td>
          <td class="style4"><?php echo $crsr['status'];?></td>
        </tr>
        <?php }
			  	 	$count++;
			  }
			  
			?>
      </table>
      <p align="center">&nbsp;</p>
      <p align="center" >      <font face="Arial, Helvetica, sans-serif" size="2"> </font></p>
      <br />
      <div id="MyResult" align="center"></div>
      <p></p></td>
  </tr>
  <tr>
    <td height="61" valign="middle" bgcolor="#FFFFFF"><?php include("rptbot.php"); ?>
    <div align="center"></div></td>
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