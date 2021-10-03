<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
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
</style>
<script src="jquery.js" type="text/javascript"></script>


</head>

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
          <form method="post" name="MyForm" id="MyForm" action="schedule_report.php">
<table width="600" border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td height="30" colspan="4" class="style11" style="border-bottom:1px solid #999999; ">Schedule Parameter </td>
  </tr>
  <tr class="style15">
    <td>Year</td>
    <td>:</td>
    <td width="195"><input type="text" id="rptYear" name="rptYear" placeholder="Enter year" value="<?php echo date("Y"); ?>" /></td>
    <td width="234">
				  </td>
  </tr>
  <tr class="style15">
    <td>Schedule Part </td>
    <td>:</td>
    <td><select name="yrpart" id="yrpart">
				   <option value="">Select part of year</option>
				   <option value="half1">Part 1</option>
				   <option value="half2">Part 2</option>
				  
				  </select></td>
    <td></td>
  </tr>
  <tr class="style15">
    <td width="138">Department Report </td>
    <td width="5">:</td>
    <td><select name="deptid" id="deptid" onkeypress="return handleEnter(this, event)">
	   <option value="">Select Dept ID</option>
	  <?php $dptq=$myDb->select("select *from tbl_department where id=(select deptname from tbl_stdinfo where stdid='$_SESSION[userid]')");
								
		 while($dptqf=$myDb->get_row($dptq,'MYSQL_ASSOC')){ ?>
		 <option value="<?php echo $dptqf['id']; ?>"><?php echo $dptqf['name']; ?></option>
		 <?php } ?>
		</select> 
		 						 
	</td>
    <td></td>
  </tr>
  <tr class="style15">
    <td>Section</td>
    <td>:</td>
    <td colspan="2">  <select name="ownid" id="ownid" onkeypress="return handleEnter(this, event)" style="width:130px; ">
    <option value="">Alias</option>
	<?php $aq=$myDb->select("select id,alias from tbl_routine_for where deptid=(select deptname from tbl_stdinfo where stdid='$_SESSION[userid]')");
	while($aqf=$myDb->get_row($aq,'MYSQL_ASSOC')){ ?>
	<option value="<?php echo $aqf['id']; ?>"><?php echo $aqf['alias']; ?></option>
	<?php } ?>
  </select>
</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><input type="submit" value="Submit" name="B1" id="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" /></td>
  </tr>
</table>
</form>          <p class="style4">&nbsp;</p>
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
        <td width="99%"><div align="center" class="style7">© Copyright All Rights Reserved. Powered By: DesktopBD</div></td>
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
