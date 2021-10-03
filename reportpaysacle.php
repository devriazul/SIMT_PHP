<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
	if($_SESSION['userid']){
	   
			     
  			$crs="SELECT * FROM tbl_payscale Where storedstatus<>'D' order by id";
  				  
			$crq=$myDb->select($crs); 
			$count=0;
  			//$crsr=$myDb->get_row($crq,'MYSQL_ASSOC');
				

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
    <td valign="top"><div align="center"><span style=" font-size:18px; text-decoration:underline; font-weight:bold; ">Paysacle Report </span></div></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="79%" valign="top">
      <table width="872" height="80" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#666666" id="stdtbl">
        <tr bgcolor="#DFF4FF">
          <td width="38" height="30" class="style2"><strong>SLNo.</strong></td>
          <td width="205" height="30" class="style2"><strong>Name</strong></td>
          <td width="71" class="style2"><strong>Basic Pay </strong></td>
          <td width="73" class="style2"><strong>House Rent </strong></td>
          <td width="116" class="style2"><strong>Medical Allowance </strong></td>
          <td width="126" class="style2"><strong>Transport Allowance </strong></td>
          <td width="107" class="style2"><strong>Other Allowance</strong></td>
          <td width="86" class="style2"><strong>Total</strong></td>
        </tr>
		<?php 
			$i=0;
			while($crsr=$myDb->get_row($crq,'MYSQL_ASSOC')){ $i++;
			if($count%2==0){
			$bgcolor="#FFFFFF";?>
        <tr bgcolor="<?php echo $bgcolor; ?>">
          <td height="18" class="style4" ><?php echo $i;?></td>
          <td height="18" class="style4" ><?php echo $crsr['name'];?></td>
          <td class="style4" ><?php echo $crsr['basicpay'];?></td>
          <td class="style4" ><?php echo $crsr['houserent'];?></td>
          <td class="style4" ><?php echo $crsr['medicalallow']; ?></td>
          <td class="style4"><?php echo $crsr['transportallow']; ?></td>
          <td class="style4"><?php echo $crsr['otherallow']; ?></td>
          <td class="style4"><?php echo $crsr['basicpay'] + $crsr['houserent'] + $crsr['medicalallow'] + $crsr['transportallow'] + $crsr['otherallow']; ?></td>
        </tr>
        <?php }else{ $bgcolor="#F7FCFF"; ?>
        <tr bgcolor="<?php echo $bgcolor; ?>">
          <td height="18" class="style4" ><?php echo $i;?></td>
          <td height="18" class="style4" ><?php echo $crsr['name'];?></td>
          <td class="style4" ><?php echo $crsr['basicpay'];?></td>
          <td class="style4" ><?php echo $crsr['houserent'];?></td>
          <td class="style4" ><?php echo $crsr['medicalallow']; ?></td>
          <td class="style4"><?php echo $crsr['transportallow']; ?></td>
          <td class="style4"><?php echo $crsr['otherallow']; ?></td>
          <td class="style4"><?php echo $crsr['basicpay'] + $crsr['houserent'] + $crsr['medicalallow'] + $crsr['transportallow'] + $crsr['otherallow']; ?></td>
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
