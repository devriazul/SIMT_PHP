<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
	if($_SESSION['userid']){
	
	       
			$dp= "Select d.name as department from tbl_faculty f inner join tbl_department d on f.deptid=d.id where f.deptid='$_POST[deptid]' ";
			$fdp=$myDb->select($dp);
			$qdp=$myDb->get_row($fdp,'MYSQL_ASSOC');
			     
  			$crs="SELECT f.*,d.name as department, dg.name as designation, p.name as payscalename FROM `tbl_faculty` f inner join tbl_department d on f.deptid=d.id inner join tbl_designation dg on f.designationid=dg.id inner join tbl_payscale p on f.payscaleid=p.id WHERE f.deptid='$_POST[deptid]' and f.storedstatus<>'D' order by f.facultyid";
  				  
			$crq=$myDb->select($crs); 
			$count=0; $i=1;
  			//$cr=$myDb->get_row($crq,'MYSQL_ASSOC');
				

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
.style16 {
	color: #999999;
	font-weight: bold;
	font-size:16px;
	text-decoration:underline;
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
    <td valign="top"><div align="center"><strong><span style="color:#999999; text-decoration:underline; font-size:18px; ">Faculty Report </span></strong></div></td>
  </tr>
  <tr>
    <td valign="top"><div align="center" class="style16"><strong>Department Name:</strong> <?php echo $qdp['department'];?></div></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="79%" valign="top">
      <table width="100%" height="69" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="stdtbl">
        <tr bgcolor="#DFF4FF">
          <td width="31" class="style2"><strong>SL No </strong></td>
          <td width="58" height="25" class="style2"><strong>FacultyId </strong></td>
          <td width="90" class="style2"><strong>Name</strong></td>
          <td width="85" class="style2"><strong>Father's Name </strong></td>
          <td width="87" class="style2"><strong>Mother's Name</strong></td>
          <td width="84" class="style2"><strong>Education.Q</strong></td>
          <td width="84" class="style2"><strong>Designation</strong></td>
          <td width="90" height="25" class="style2"><div align="left"><strong><strong>Payscale</strong></strong></div></td>
          <td width="72" class="style2"><strong>JoiningDate </strong></td>
          <td width="89" class="style2"><strong>Bank Account No </strong></td>
          <td width="79" class="style2"><strong>Experience</strong></td>
          <td width="74" class="style2"><strong>Contact No </strong></td>
        </tr>
		<?php while($crsr=$myDb->get_row($crq,'MYSQL_ASSOC')){
			if($count%2==0){
			if($crsr['jobstatus']=="Active")
			{
				$bgcolor="#FFFFFF";
			}
			else
			{
				$bgcolor="#FF9966";
			}
			?>
        <tr bgcolor="<?php echo $bgcolor; ?>">
          <td class="style4"><?php echo  $i;?></td>
          <td height="18" class="style4"><?php echo$crsr['facultyid'];?> </td>
          <td class="style4" ><?php echo $crsr['name'];?></td>
          <td class="style4" ><?php echo $crsr['fname'];?></td>
          <td class="style4" ><?php echo $crsr['mname'];?></td>
          <td class="style4" ><?php echo $crsr['eduqualification'];?></td>
          <td class="style4" ><?php echo $crsr['designation']; ?></td>
          <td class="style4" ><?php echo $crsr['payscalename'];?></td>
          <td class="style4"><?php echo $crsr['joiningdate'];?></td>
          <td class="style4"><?php echo $crsr['bankaccno'];?></td>
          <td class="style4"><?php echo $crsr['expyear']." Year ".$crsr['expmonth']." Months";?></td>
          <td class="style4"><?php echo $crsr['contactno'];?></td>
        </tr>
        <?php }else{ 
			if($crsr['jobstatus']=="Active")
			{
				$bgcolor="#F7FCFF"; 
			}
			else
			{
				$bgcolor="#FF9966";
			}
		?>
        <tr bgcolor="<?php echo $bgcolor; ?>">
          <td class="style4"><?php echo  $i;?></td>
          <td height="18" class="style4"><?php echo $crsr['facultyid'];?> </td>
          <td class="style4" ><?php echo $crsr['name'];?></td>
          <td class="style4" ><?php echo $crsr['fname'];?></td>
          <td class="style4" ><?php echo $crsr['mname'];?></td>
          <td class="style4" ><?php echo $crsr['eduqualification'];?></td>
          <td class="style4" ><?php echo $crsr['designation']; ?></td>
          <td class="style4" ><?php echo $crsr['payscalename'];?></td>
          <td class="style4"><?php echo $crsr['joiningdate'];?></td>
          <td class="style4"><?php echo $crsr['bankaccno'];?></td>
          <td class="style4"><?php echo $crsr['expyear']." Year ".$crsr['expmonth']." Months";?></td>
          <td class="style4"><?php echo $crsr['contactno'];?></td>
        </tr>
        <?php }
			  	 	$count++; $i++;
			  }
			  
			?>
      </table>
      <p align="center">&nbsp;</p>
      <p align="center" >
        <input type="button"  value="Print Report" onClick="window.print()" name="B" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB;" />
      <font face="Arial, Helvetica, sans-serif" size="2"> </font></p>
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
