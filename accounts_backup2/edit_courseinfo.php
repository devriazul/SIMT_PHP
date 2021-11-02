<?php 
ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $id=mysql_real_escape_string($_GET['id']);
  $vs="SELECT c.id, c.coursecode AS CourseCode, c.coursename AS CourseName, c.departmentid as departmentid, d.name AS DepartmentName, c.credit AS Credit, c.theory AS T, c.Practical AS P, c.description AS Description FROM tbl_courses c, tbl_department d WHERE c.departmentid = d.id AND c.storedstatus <>'D' AND c.id='$id'";
  $r=$myDb->select($vs);
  $row=$myDb->get_row($r,'MYSQL_ASSOC');
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managecourseinformation.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['upd']=="y"){
  
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
.style16 {font-size: 12px}

-->
</style>
<script language type="text/javascript"> 
function handleEnter (field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
			i = (i + 1) % field.form.elements.length;
			field.form.elements[i].focus();
			return false;
		} 
		else
		return true;
	}      
 
 
 
</script>
<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>

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
        <td background="images/leftbg.jpg"><img src="images/leftbg.jpg" width="252" height="3" /></td>
        <td><img src="images/spaer.gif" width="1" height="1" /></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php"); ?>
          <br />
          
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        <td width="79%" valign="top">
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php echo $_GET['msg'];?></font></p>
		<form id="form1" name="form1" method="post" action="ed_courseinfo.php?id=<?php echo $id; ?>">
          <div align="center"><br />
          <table width="70%" border="0" align="center" cellpadding="0" cellspacing="3" id="stdtbl">

            <tr>
              <td width="32%" height="20" class="style2">Code</td>
              <td width="4%"><div align="center"><span class="style2">:</span></div></td>
              <td width="64%" height="20"><input name="code" type="text" id="code" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['CourseCode']; ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Name</td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><input name="name" type="text" id="name" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['CourseName']; ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Department</td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><select name="department" id="department" class="style2" onkeypress="return handleEnter(this, event)">
                <option value="<?php echo $row['departmentid']; ?>" selected="selected"><?php echo $row['DepartmentName']; ?></option>
                <?php 
			  	$cat=mysql_query("select id, name from tbl_department") or die(mysql_error());
	 			while($cfetch=mysql_fetch_array($cat)){
	 			?>
                <option value="<?php echo $cfetch['id']; ?>"><?php echo $cfetch['name']; ?></option>
                <?php } ?>
              </select></td>
            </tr>
            <tr>
              <td height="20" class="style2">Credit</td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><input name="credit" id="noofseats2" type="text" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="15" value="<?php echo $row['Credit']; ?>" /></td>
            </tr>
            <tr>
              <td><span class="style2">Theory</span></td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td><input name="theory" type="text" id="theory" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['T']; ?>" /></td>
            </tr>
            <tr>
              <td><span class="style2">Practical</span></td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td><input name="practical" type="text" id="practical" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['P']; ?>" /></td>
            </tr>
            <tr>
              <td><span class="style2">Description</span></td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td>                <textarea name="description" cols="60" id="description" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"><?php echo $row['Description']; ?></textarea></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><input type="submit" value="Update" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"> 
              <input type="reset" name="Submit2" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/></td>
            </tr>
          </table>          
          </div>

            </form>
          <br />
          <p align="center">&nbsp;</p>
<p></p>
</td>
      </tr>
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
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>