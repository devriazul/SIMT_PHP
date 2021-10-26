<?php ob_start();
session_start();
include('../config.php'); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='schedule_report_parameter_prev.php' AND userid='$_SESSION[userid]'";
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

<script src="jquery-1.6.2.min.js" type="text/javascript"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#facultyid").autocomplete("search_gudie_faculty.php", {
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
<script language="javascript">
 $(document).ready(function(){
	 $('#vname').change(function(){
	   var arr=$('#MyForm').serializeArray();
	   $.post("search_roomno.php",arr,function(r){
		$('#roomshw').fadeOut().fadeIn("slow").html(r);
	   });
	 
	 });
	 
   $('#deptid').change(function(){
	   var arr=$('#MyForm').serializeArray();
	   $.post("search_alias.php",arr,function(r){
		$('#als').fadeOut().fadeIn("slow").html(r);
	   });
 
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
        <td background="images/leftbg.jpg">&nbsp;</td>
        <td><div align="center"><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])) {echo $_GET['msg'];}?></font></div></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php");?><br />
          <p>&nbsp;</p>
          <p>&nbsp;</p></td><td width="79%" height="300" valign="top"><blockquote>
          <p>&nbsp;</p>
        </blockquote>
		  <div class="appset" style="width:500px;margin:0 auto;"><form method="post" name="MyForm" id="MyForm" action="schedule_report_prev.php" target="new">
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" colspan="4" class="style11" style="border-bottom:1px solid #999999; ">Schedule Parameter </td>
  </tr>
  <tr class="style15">
    <td>Year</td>
    <td>:</td>
    <td><input type="text" id="rptYear" name="rptYear" placeholder="Enter year" value="<?php echo date("Y"); ?>" /></td>
    <td><select name="yrpart" id="yrpart">
				   <option value="">Select part of year</option>
				   <option value="half1">Part 1</option>
				   <option value="half2">Part 2</option>
				  
				  </select>
				  </td>
  </tr>
  <tr class="style15">
    <td width="138">Department Report </td>
    <td width="5">:</td>
    <td><select name="deptid" id="deptid" onkeypress="return handleEnter(this, event)">
	   <option value="">Select Dept ID</option>
	  <?php $dptq=$myDb->select("select *from tbl_department");
								
		 while($dptqf=$myDb->get_row($dptq,'MYSQL_ASSOC')){ ?>
		 <option value="<?php echo $dptqf['id']; ?>"><?php echo $dptqf['name']; ?></option>
		 <?php } ?>
		</select> 
		 						 
	</td>
    <td><div style="width:70px; " id="als"></div></td>
  </tr>
  <tr class="style15">
    <td>Teacher Report </td>
    <td>:</td>
    <td colspan="2"><input name="facultyid" type="text" id="facultyid" placeholder="Faculty Name" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
  </tr>
  <tr class="style15">
    <td>Venu Report </td>
    <td>:</td>
    <td width="195"><span class="style2"><span class="stars">
      <select style="width:150px;" name="vname" id="vname" onkeypress="return handleEnter(this, event)">
        <option value="">Venue</option>
        <?php $vnq=$myDb->select("select distinct venuname from tbl_venue order by orderid");
				while($vnqf=$myDb->get_row($vnq,'MYSQL_ASSOC')){ ?>
        <option value="<?php echo $vnqf['venuname']; ?>"><?php echo $vnqf['venuname']; ?></option>
        <?php } ?>
      </select>
    </span></span></td>
    <td width="234"><div id="roomshw" style="width:170px" class="style2"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><input type="submit" value="Submit" name="B1" id="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" /></td>
  </tr>
</table>
</form>            </div>
		  <p>&nbsp;</p></td></tr>
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