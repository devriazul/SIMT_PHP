<?php session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $id=mysql_real_escape_string($_GET['id']);
  //$vs="SELECT*FROM tbl_payscale WHERE id='$id'";
  $vs="select p.id,p.name as PayscaleName,p.basicpay,p.houserent,p.medicalallow,p.transportallow,p.otherallow,p.remarks,d.id as did,d.name as Designation, (p.basicpay+p.houserent+p.medicalallow+p.transportallow+p.otherallow) as Total from  tbl_payscale p, tbl_designation d WHERE p.id='$id' and p.designationid=d.id and p.storedstatus<>'D'
 order by id";
  $r=$myDb->select($vs);
  $row=$myDb->get_row($r,'MYSQL_ASSOC');
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managepayscale.php' AND userid='$_SESSION[userid]'";
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
	$("#searchid").autocomplete("search_payscale.php", {
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
<script src="payscale.js" type="text/javascript"></script>
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
<?php 
if(isset($_GET['msg']))
{?>
<meta http-equiv="refresh" content="1"; url=edit_payscale.php">
<?php }?>

<div id="top-search-div"> 
           <div id="content">
		   <label>Edit Payscale </label>
		   <div class="input">
		   <form method="post" autocomplete="off" action="managepayscale1.php">
		     <label>Search Form</label>
			 <label><input type="text" id="searchid" name="searchid" placeholder="Search by payscale name" /></label>
			 <label><input type="submit" name="subs" id="submit-btn" value="Search" /></label>
			 <label><a href="add_payscale.php"><input type="button" name="addbtn" id="submit-btn" value="Add New" /></a></label>
			  
		   </form>
		   </div>
		</div>
		</div>
		<br />
		<form name="MyForm" autocomplete="off" action="edit_payscale.php?" method="post" onsubmit="xmlhttpPost('ed_payscale.php?id=<?php echo $id; ?>', 'MyForm', 'MyResult', '<img src=\'loader.gif\'>'); return false;">
          <div align="center"><br />
          <table width="70%" border="0" align="center" cellpadding="0" cellspacing="5" id="stdtbl">

            <tr>
              <td height="20" colspan="2" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">PAYSCALE INFORMATION (<span class="stars">*</span>Mandatory Field) </span></td>
              </tr>
            <tr>
              <td width="31%" height="20" class="style2">Name:<span class="stars">*</span></td>
              <td width="69%" height="20"><input name="name" type="text" id="name" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['PayscaleName']; ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Designation:<span class="stars">*</span> </td>
              <td height="20"><select name="desigid" id="desigid" onkeypress="return handleEnter(this, event)">
                <option selected="selected" value="<?php echo $row['did']; ?>"><?php echo $row['Designation']; ?></option>
                <?php $hq=$myDb->select("select id,name from tbl_designation");
				   while($hrow=$myDb->get_row($hq,'MYSQL_ASSOC')){
				   ?>
                <option value="<?php echo $hrow['id']; ?>"><?php echo $hrow['name']; ?></option>
                <?php } ?>
              </select></td>
            </tr>
            <tr>
              <td height="20" class="style2">Basic Salary :<span class="stars">*</span> </td>
              <td height="20"><input name="basicsalary" type="text" id="basicsalary" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['basicpay']; ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">House Rent :<span class="stars">*</span> </td>
              <td height="20"><input name="houserent" type="text" id="houserent" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['houserent']; ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Medical Allowance :<span class="stars">*</span> </td>
              <td height="20"><input name="medicalallow" type="text" id="medicalallow" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['medicalallow']; ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Transport Allowance :<span class="stars">*</span> </td>
              <td height="20"><input name="transportallow" type="text" id="transportallow" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['transportallow']; ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Other Allowance :<span class="stars">*</span> </td>
              <td height="20"><input name="otherallow" type="text" id="otherallow" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['otherallow']; ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Total Gross Salary  :</td>
              <td height="20"><input name="totalgs" type="text" id="totalgs" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['Total']; ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Remarks:</td>
              <td height="20"><textarea name="remarks" cols="50" id="remarks" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"><?php echo $row['remarks']; ?></textarea></td>
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