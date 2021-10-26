<?php session_start();
include('config.php'); 
if($myDb->connectDefaultServer())
{ 
  	if($_SESSION['userid']){
	$id=mysql_real_escape_string($_GET['id']);
  	$vs="SELECT*FROM tbl_noticeboard WHERE id='$id'";
	$r=$myDb->select($vs);
  	$row=$myDb->get_row($r,'MYSQL_ASSOC');

  	$chka="SELECT*FROM  tbl_accdtl WHERE flname='managenotice.php' AND userid='$_SESSION[userid]'";
  	$caq=$myDb->select($chka);
  	$car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
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
	$("#searchid").autocomplete("search_leave.php", {
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

<script type="text/javascript" src="nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
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

<script type="text/javascript" src="datepickercontrol.js"></script>
  <script language="JavaScript">
  if (navigator.platform.toString().toLowerCase().indexOf("linux") != -1){
	 	document.write('<link type="text/css" rel="stylesheet" href="datepickercontrol_lnx.css">');
	 }
	 else{
	 	document.write('<link type="text/css" rel="stylesheet" href="datepickercontrol.css">');
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
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg'];  }?></font></p>


<div id="top-search-div"> 
           <div id="content">
		   <label>Edit Payscale </label>
		   <div class="input">
		   <form method="post" autocomplete="off" action="managenotice1.php">
		     <label>Search Form</label>
			 <label><input type="text" id="searchid" name="searchid"  /></label>
			 <label><input type="submit" name="subs" id="submit-btn" value="Search" /></label>
			 <label><a href="add_notice.php"><input type="button" name="addbtn" id="submit-btn" value="Add New" /></a></label>
			  
		   </form>
		   </div>
		</div>
		</div>
		<br />

		<form name="MyForm" action="ed_notice.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data" onsubmit="Javascript:return checknoticedata();">

          <div align="center"><br />
          <table width="80%" border="0" align="center" cellpadding="0" cellspacing="5" id="stdtbl">

            <tr>
              <td height="20" colspan="2" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">NOTICE BOARD (<span class="stars">*</span>Mandatory Field) </span></td>
              </tr>
            <tr>
              <td width="17%" height="20" class="style2">Published Date :<span class="stars">*</span></td>
              <td width="83%" height="20"><input name="adate" type="text" class="style4" id="DPC_adate_YYYY-MM-DD" value="<?php echo $row['adate'];?>" size="30" onkeypress="return handleEnter(this, event)" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Headline :<span class="stars">*</span> </td>
              <td height="20"><input name="headline" type="text" id="headline" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['headline']; ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Description  :<span class="stars">*</span> </td>
              <td height="20"><textarea name="desc" cols="50" id="desc" style="font-family: Verdana; width:100%; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"><?php echo $row['description']; ?></textarea></td>
            </tr>
            <tr>
              <td height="20" class="style2">Notice for :<span class="stars">*</span> </td>
              <td height="20" ><select name="noticefor" id="noticefor" onkeypress="return handleEnter(this, event)">
                <?php if($row['noticefor']=="All"){ ?>
                <option value="<?php echo $row['noticefor']; ?>" selected="selected">All</option>
                <?php }else if($row['noticefor']=="Students"){ ?>{ ?>
                <option value="<?php echo $row['noticefor']; ?>">Students</option>
                <?php }else if($row['noticefor']=="Teachers"){ ?>{ ?>
                <option value="<?php echo $row['noticefor']; ?>">Teachers</option>
                <?php }else if($row['noticefor']=="Office Staff"){ ?>{ ?>
                <option value="<?php echo $row['noticefor']; ?>">Office Staff</option>
                <?php } ?>
                <option value="All">All</option>
                <option value="Students">Students</option>
                <option value="Teachers">Teachers</option>
                <option value="Office Staff">Office Staff</option>
              </select></td>
            </tr>
            <tr>
              <td height="20" class="style2">Status :<span class="stars">*</span> </td>
              <td height="20" ><select name="status" id="status" onkeypress="return handleEnter(this, event)">
                <?php if($row['status']=="Active"){ ?>
                <option value="<?php echo $row['status']; ?>" selected="selected">Active</option>
                <?php }else{ ?>
                <option value="<?php echo $row['status']; ?>">Inactive</option>
                <?php } ?>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
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