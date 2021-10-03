<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='hostelname.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  $id=mysql_real_escape_string($_GET['id']);
  $sq=$myDb->select("SELECT h.id hid,h.name as name,s.roomno as RoomNo,s.noofstudent as StudentsPerRoom 
                     FROM tbl_hostel h 
					 INNER JOIN tbl_hostelseat s
					 ON h.id=s.hostelid 
					 WHERE s.id='$id' AND s.storedstatus<>'D'");
  $srow=$myDb->get_row($sq,'MYSQL_ASSOC');
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
<script type="text/javascript" src="jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#searchid").autocomplete("search_hostelname.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
});
</script>
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
<script src="hostel_seat.js" type="text/javascript"></script>
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
        <td height="28" colspan="2" bgcolor="#0C6ED1"><div align="center" class="style1"><?php include("company.php"); ?></div></td>
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
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></font></p>
<div id="top-search-div"> 
           <div id="content">
		   <label>Add Hostel Room </label>
		   <div class="input">
		   <form method="post" autocomplete="off" action="hostelseat1.php">
		     <label>Search Form</label>
			 <label><input type="text" id="searchid" name="searchid" placeholder="Search by hostel name" /></label>
			 <label><input type="submit" name="subs" id="submit-btn" value="Search" /></label>
			 <label><a href="add_hostelname.php"><input type="button" name="addbtn" id="submit-btn" value="Add New" /></a></label>
			 			  <label><a href="manage_hostelseat.php"><input type="button" name="addbtn" id="submit-btn" value="Manage Room" />
			 			  </a></label>
			   <label><a href="add_hostel_seat.php"><input type="button" name="addbtn" id="submit-btn" value="Add Hostel Room" />
			   </a></label>

		   </form>
		   </div>
		</div>
		</div>
		<br />
		<form name="MyForm" autocomplete="off" action="edit_hostelseat.php" method="post" onsubmit="xmlhttpPost('ed_hostelseat.php?id=<?php echo $id; ?>', 'MyForm', 'MyResult', '<img src=\'loader.gif\'>'); return false;">
          <div align="center"><br />
          <table width="70%" border="0" align="center" cellpadding="0" cellspacing="5" id="stdtbl">

            <tr>
              <td height="20" colspan="2" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">HOSTEL ROOM INFORMATION <span class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><span class="stars">*</span>(Mandatory Field) </span></td>
              </tr>
            <tr>
              <td width="31%" height="20" class="style2">Hostel ID :<span class="stars">*</span> </td>
              <td width="69%" height="20"><label>
                <select name="hostelid" id="hostelid" onkeypress="return handleEnter(this, event)">
				   <option selected="selected" value="<?php echo $srow['hid']; ?>"><?php echo $srow['name']; ?></option>
				   <?php $hq=$myDb->select("select id,name from tbl_hostel");
				   while($hrow=$myDb->get_row($hq,'MYSQL_ASSOC')){
				   ?>
				   <option value="<?php echo $hrow['id']; ?>"><?php echo $hrow['name']; ?></option>
				   <?php } ?>
                </select>
              </label></td>
            </tr>
            <tr>
              <td height="20" class="style2">Room No :<span class="stars">*</span> </td>
              <td height="20"><input name="roomno" type="text" id="roomno" value="<?php echo $srow['RoomNo']; ?>" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            
            <tr>
              <td><span class="style2">No of Students Per Room:<span class="stars">*</span></span></td>
              <td><input name="noofstudent" type="text" id="noofstudent" value="<?php echo $srow['StudentsPerRoom']; ?>" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td></td>
              <td><input type="submit" value="Submit" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"> <input type="reset" name="Submit2" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/></td>
            </tr>
          </table>          
          </div>

            </form>
          <br />
          		<div id="MyResult" align="center"></div>  		          
          
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
  header("Location:index.php");
}
}