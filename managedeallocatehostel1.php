<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managedeallocatehostel.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  
  	 $searchid=@$_POST['searchid']; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
	<link type="text/css" href="css/jquery-ui-1.8.5.custom.css" rel="Stylesheet" />
<style type="text/css">
<!--
@import url("main.css");

-->
</style>

<script type="text/javascript" src="jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#searchid").autocomplete("search_studentbyid.php", {
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
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></font></p>
		<div id="top-search-div"> 
           <div id="content">
		   <label>Search Student </label>
		   <div class="input">
		   <form method="post" autocomplete="off" action="managedeallocatehostel1.php">
		     <label>Search Student By ID :</label>
			 <label><input type="text" id="searchid" name="searchid" /></label>
			 <label><input type="submit" name="subs" id="submit-btn" value="Search" /></label>
			 
		   </form>
		   </div>
		</div>
		</div>
          <br />
         <?php $searchid=mysql_real_escape_string($_POST['searchid']);
			if(isset($_POST['searchid']))
			{  
				$sdq="SELECT s.id, s.stdid as StudentId, s.stdname AS Name, b.batchname AS Batch, d.name AS Department,h.name as HostelName, r.roomno as RoomNo, hsd.seatno as SNo FROM  `tbl_stdinfo` s inner join `tbl_batch` b on s.batch=b.id inner join `tbl_department` d on s.deptname=d.id inner join `tbl_hostelseatdetails` hsd on s.stdid=hsd.stdid inner join `tbl_hostel` h on hsd.hostelid=h.id inner join `tbl_hostelseat` r on hsd.roomid=r.id  WHERE s.storedstatus <>  'D'  AND s.stdid ='$searchid' ";
				$sdep=$myDb->dump_querySHD($sdq,'deallocatehostelseatdetails.php',$car['upd']);
			}
			else
			{
				$sdq="SELECT s.id, s.stdid as StudentId, s.stdname AS Name, b.batchname AS Batch, d.name AS Department,h.name as HostelName, r.roomno as RoomNo, hsd.seatno as SNo FROM  `tbl_stdinfo` s inner join `tbl_batch` b on s.batch=b.id inner join `tbl_department` d on s.deptname=d.id inner join `tbl_hostelseatdetails` hsd on s.stdid=hsd.stdid inner join `tbl_hostel` h on hsd.hostelid=h.id inner join `tbl_hostelseat` r on hsd.roomid=r.id  WHERE s.storedstatus <>  'D'";
				$sdep=$myDb->dump_querySHD($sdq,'deallocatehostelseatdetails.php',$car['upd']);
			}
	?>
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
?>
