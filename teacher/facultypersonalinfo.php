<?php session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  //$id=mysql_real_escape_string($_GET['id']);
  
  $vs="SELECT f.id, f.facultyid, f.password, f.name, f.fname, f.mname, f.sex, f.dob, f.img, f.mstatus, f.bloodgroup, f.address,f.designationid, d.name as designation, f.joiningdate, f.deptid, dp.name as department, f.expartincourse, f.eduqualification, f.expyear, f.expmonth, f.contactno, f.type, f.payscaleid, p.name as payscale FROM `tbl_faculty` f inner join tbl_designation d on f.designationid=d.id inner join tbl_department dp on f.deptid=dp.id inner join tbl_payscale p on f.payscaleid=p.id WHERE f.storedstatus<>'D' and f.facultyid='$_SESSION[userid]'";
  $r=$myDb->select($vs);
  $row=$myDb->get_row($r,'MYSQL_ASSOC');
  
 /* $chka="SELECT*FROM  tbl_accdtl WHERE flname='managefacultyinfo.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  */
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
<style>
.box-div
{
box-shadow: 10px 20px 5px #888888;
}

div.transbox
  {
  background-color:#ffffff;

  opacity:0.9;
  filter:alpha(opacity=60); /* For IE8 and earlier */
  }
</style>

<script type="text/javascript" src="jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

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

<script language="javascript">
$(document).keyup(function(e) {
  if(e.keyCode==45){
    $('#bothead').show();
  }
  if(e.keyCode==27){
    $('#bothead').hide();
  }
});
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
<div class="transbox"><div id="bothead" style=" position:absolute; background-color:#666666;   padding:10px; color:#FFFFFF; left:400px;float:right;width:700px; height:auto; display:none; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
   
   HELP SHORTCUT KEY:<br/>
  ---------------------------<br/><br/>
   <label>Press "Insert" key from keyboard 	---- To open help</label><br/> 
   <label>Press "Esc" key					---- To close help</label><br/> <br/><br/>

	HOW TO EDIT INFORMATION:<br/>
  	-------------------------------------<br/><br/>
   <label>Click Edit Information Button----- To Edit your personal information</label><br/><br/>
  
	     
</div></div>
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg'];  }?></font></p>
		<form name="MyForm" autocomplete="off" action="facultypersonalinfoedit.php" method="post">
          <div align="center">          <table width="91%" border="0" align="center" cellpadding="0" cellspacing="2"  id="stdtbl">

            <tr>
              <td height="20" colspan="4" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">FACULTY PERSONAL INFORMATION</td>
              </tr>
            <tr bgcolor="#DFF4FF">
              <td height="32" colspan="4" class="gridTblHead style2">General Information</td>
              </tr>
            <tr bgcolor="#F4F4FF">
              <td height="20" bgcolor="#FFFFFF" class="style2"><div id="box-div"><?php if($row['img']!=""){?><img name="" src="../facultyphoto/<?php echo $row['img']; ?>" width="100" height="105" border="1" alt="" /><?php } else { if($row['sex']=="Male"){?><img name="" src="../facultyphoto/male.jpg" width="100" height="105" border="1" alt="" /><?php }else{?> <img name="" src="../facultyphoto/female.jpg" width="100" height="105" border="1" alt="" /><?php }}?></div></td>
              <td height="20" colspan="3" bgcolor="#FFFFFF"><span style="font-family: Arial; font-size: 16pt; font-weight:bold; color:#003399"><?php echo $row['name'];  ?></span></td>
              </tr>
            <tr bgcolor="#F4F4FF">
              <td width="23%" height="20" class="style2">Faculty ID :</td>
              <td width="31%" height="20"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['facultyid'];  ?></span></td>
              <td width="18%"><span class="style2">Sex :</span></td>
              <td width="28%"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['sex'];  ?></span></td>
            </tr>
            <tr bgcolor="#F4F4FF">
              <td height="20" class="style2">Department :</td>
              <td height="20"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['department'];  ?></span></td>
              <td><span class="style2">Experience :</span></td>
              <td><table width="83%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['expyear'];  ?></span> </td>
                  <td><span class="style2">Years</span></td>
                  <td><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['expmonth'];  ?></span> </td>
                  <td><span class="style2">Months</span></td>
                </tr>
              </table></td>
            </tr>
            <tr bgcolor="#F4F4FF">
              <td height="20" class="style2">Designation :</td>
              <td height="20"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['designation'];  ?></span></td>
              <td><span class="style2">Type :</span></td>
              <td><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['type'];  ?></span></td>
            </tr>
            <tr bgcolor="#F4F4FF">
              <td height="20" class="style2">Joining Date :</td>
              <td height="20"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['joiningdate'];  ?>
              </span></td>
              <td><span class="style2">Expart (In Subject) :</span></td>
              <td><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['expartincourse'];  ?></span>                </td>
            </tr>
            <tr bgcolor="#F4F4FF">
              <td height="20" class="style2">Payscale :</td>
              <td height="20"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['payscale'];  ?></span></td>
              <td><span class="style2">Contact No :</span></td>
              <td><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['contactno'];  ?></span></td>
            </tr>
            <tr bgcolor="#F4F4FF">
              <td height="20" class="style2">Education Qualification :</td>
              <td height="20" colspan="3" bgcolor="#F4F4FF"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['eduqualification'];  ?></span></td>
              </tr>
            <tr bgcolor="#F4F4FF">
              <td height="20" class="style2">Address :</td>
              <td height="20" colspan="3" bgcolor="#F4F4FF"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['address'];  ?></span></td>
              </tr>
            <tr bgcolor="#DFF4FF">
              <td height="40" colspan="4" class="gridTblHead style2">Personal Information</td>
              </tr>
            <tr bgcolor="#F4F4FF">
              <td height="20" class="style2">Father's Name :</td>
              <td height="20"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['fname'];  ?></span>                </td>
              <td><span class="style2">DOB :</span></td>
              <td><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['dob'];  ?></span>                </td>
            </tr>
            <tr bgcolor="#F4F4FF">
              <td height="20" class="style2">Mother's Name :</td>
              <td height="20"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['mname'];  ?></span>                </td>
              <td><span class="style2">Marital Status :</span></td>
              <td><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['mstatus'];  ?></span>                </td>
            </tr>
            <tr bgcolor="#F4F4FF">
              <td height="20" class="style2">Blood Group :</td>
              <td height="20"><span style="font-family: Verdana; font-size: 8pt;"><?php echo $row['bloodgroup'];  ?></span>                </td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="20" class="style2">&nbsp;</td>
              <td height="20">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="20" class="style2"> <input type="submit" value="Edit Infomation" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" /></td>
              <td height="20">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
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
  $myDb->__destruct();
	   
?>

<?php 
 /*  }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 
*/
}else{
  header("Location:index.php");
}
}  
?>