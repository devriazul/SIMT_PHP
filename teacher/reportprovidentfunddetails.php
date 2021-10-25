<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
	if($_SESSION['userid'])
	{
		$efid=mysql_real_escape_string($_GET['efid']);
	     
		$vs="SELECT DATE_FORMAT(opdate,'%d %b %Y') as tdate, 'Opening Balance' as Particulars, ifnull(pfob,0) as SMP FROM `vw_allstaff` WHERE StaffID='$efid' UNION Select DATE_FORMAT(opdate,'%d %b %Y') as tdate, remarks as Particulars, ifnull(SUM(pfundamount),0) as SMP From tbl_employeesalary WHERE empid='$efid'";
		$r=$myDb->select($vs);
		//$row=$myDb->get_row($r,'MYSQL_ASSOC');
$count=0;

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
    <td height="28" bgcolor="#FFFFFF"><div align="center" class="style5"><?php include("rptheader.php");?></div></td>
  </tr>
  <tr>
    <td><img src="images/spaer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><div align="center" style="text-decoration:underline "><strong>Provident Fund Details Statement</strong></div></td>
  </tr>
  <tr>
    <td valign="top"><div align="center">(Upto <?php echo date('d M, Y');?>) </div></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="79%" valign="top">
      <table width="70%" height="80" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#666666" id="stdtbl">
        <tr bgcolor="#F9F9F9">
          <td width="139" height="30" class="style2"><strong>Date</strong></td>
          <td width="340" class="style2"><strong>Particulars</strong></td>
          <td width="156" class="style2"><div align="right"><strong>Paid Amount </strong></div></td>
        </tr>
		<?php while($crsr=$myDb->get_row($r,'MYSQL_ASSOC')){
			if($count%2==0){
			$bgcolor="#FFFFFF";?>
        <tr bgcolor="<?php echo $bgcolor; ?>">
          <td height="18" class="style4" ><?php echo $crsr['tdate'];?></td>
          <td class="style4" ><?php echo $crsr['Particulars'];?></td>
          <td class="style4" ><div align="right"><?php echo $crsr['SMP'];?>
          </div></td>
        </tr>
        <?php }else{ $bgcolor="#F7FCFF"; ?>
        <tr bgcolor="<?php echo $bgcolor; ?>">
          <td height="18" class="style4" ><?php echo $crsr['tdate'];?></td>
          <td class="style4" ><?php echo $crsr['Particulars'];?></td>
          <td class="style4" ><div align="right"><?php echo $crsr['SMP'];?>
          </div></td>
        </tr>
        <?php }
			  	 	$count++;
			  }
			  
			?>
      </table>
      <p align="center">&nbsp;</p>
      <p align="center" >        <font face="Arial, Helvetica, sans-serif" size="2"> </font></p>
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
?>
