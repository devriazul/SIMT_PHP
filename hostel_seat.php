<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style2 {font-size: 14px}
.style3 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #FFFFFF;
}
.style4 {color: #FFFFFF}
-->
</style>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="35" bgcolor="#0000FF"><span class="style3" style="margin-left:3px;">Hostel Seat Allotment </span></td>
    <td height="35" bgcolor="#0000FF"><span class="style4"></span></td>
  </tr>
  <?php 
  for($i=1;$i<=$_POST['noofseats'];$i++){
   ?>
  
  <tr>
    <td width="39%"><span class="style2">Enter Seat No. </span></td>
    <td width="61%"><label>
      <input type="text" name="seat[]" id="seat[]" onkeypress="return handleEnter(this, event)" />
    </label></td>
  </tr>
  <?php } ?>
</table>
</body>
</html>
