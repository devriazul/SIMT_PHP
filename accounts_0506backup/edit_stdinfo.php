<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='stdinfo.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
     $id=mysql_real_escape_string($_GET['id']);
     $edq="SELECT*FROM tbl_stdinfo WHERE id='$id'";
	 $eds=$myDb->select($edq);
	 $edr=$myDb->get_row($eds,'MYSQL_ASSOC');
  
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<link href="main.css" rel="stylesheet" type="text/css" />
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


    function getExstid() {
        var checkbox = document.getElementById("sh");
        if(checkbox.checked == true){
             document.getElementById("ex").style.display = "block";
        }else if(checkbox.checked == false) {
             document.getElementById("ex").style.display = "none";
        }
    }
	
  function checkstd(){
     var checkbox = document.getElementById("sh");
	 if(checkbox.checked==true){
	    if(document.getElementById("exstid").value==""){
		   alert('Existing student ID can not left empty.');
           document.getElementById("exstid").focus();
		   return false;
		}   
	 }         
     if(document.getElementById("stdname").value==""){
         alert('Student name can not left empty!');
	     document.getElementById("stdname").focus();
	     return false;
     }
     if(document.getElementById("password").value==""){
         alert('Password can not left empty!');
	     document.getElementById("password").focus();
	     return false;
     }
     if(document.getElementById("sexstatus").value==""){
         alert('Sex status can not left empty!');
	     document.getElementById("sexstatus").focus();
	     return false;
     }
     if(document.getElementById("DPC_dob_YYYY-MM-DD").value==""){
         alert('Date of Birth can not left empty!');
	     document.getElementById("DPC_dob_YYYY-MM-DD").focus();
	     return false;
     }
     if(document.getElementById("session").value==""){
         alert('session can not left empty!');
	     document.getElementById("session").focus();
	     return false;
     }
     if(document.getElementById("bgroup").value==""){
         alert('Blod group can not left empty!');
	     document.getElementById("bgroup").focus();
	     return false;
     }
     if(document.getElementById("deptname").value==""){
         alert('Department name can not left empty!');
	     document.getElementById("deptname").focus();
	     return false;
     }
     if(document.getElementById("fname").value==""){
         alert('Father name can not left empty!');
	     document.getElementById("fname").focus();
	     return false;
     }
     if(document.getElementById("mname").value==""){
         alert('Mother name can not left empty!');
	     document.getElementById("mname").focus();
	     return false;
     }
     if(document.getElementById("religion").value==""){
         alert('Religion can not left empty!');
	     document.getElementById("religion").focus();
	     return false;
     }
     if(document.getElementById("praddress").value==""){
         alert('Present address can not left empty!');
	     document.getElementById("praddress").focus();
	     return false;
     }
     if(document.getElementById("peraddress").value==""){
         alert('Permanent address can not left empty!');
	     document.getElementById("peraddress").focus();
	     return false;
     }
     if(document.getElementById("phone").value==""){
         alert('Phone can not left empty!');
	     document.getElementById("phone").focus();
	     return false;
     }
     if(document.getElementById("img").value==""){
         alert('Image can not left empty!');
	     document.getElementById("img").focus();
	     return false;
     }
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
<script src="dep.js" type="text/javascript"></script>



</head>

<body onload="getExstid();">
<table width="1100" border="0" align="center" cellpadding="0" cellspacing="0">
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
        <td valign="top"><div align="center"><font face="Arial, Helvetica, sans-serif" size="2"><?php echo $_GET['msg'];?></font></div>
		
<form name="MyForm" action="edstd.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data" onsubmit="Javascript:return checkstd();">
          <br />
          <table width="900" border="0" align="center" cellpadding="0" cellspacing="2" id="stdtbl">

            <tr>
              <td height="26" colspan="6" class="style11" style="padding:3px; border-bottom:1px solid #CCCCCC">STUDENT INFORMATION </td>
              </tr>
            <tr>
              <td width="18%" height="26" class="style4">&nbsp;</td>
              <td width="1%" height="26" class="style4">&nbsp;</td>
              <td height="26" colspan="4"><label>
                <input name="sh" type="checkbox" class="style4" id="sh" onClick="getExstid();"/>
                <span class="style4">(Applicable for existing students) </span></label></td>
            </tr>
            <tr>
              <td height="26" class="style4">&nbsp;</td>
              <td height="26" class="style4">&nbsp;</td>
              <td height="26" class="style4"><label>
                <div id="ex" style="display:block;"><input name="exstid" type="text" class="style4" id="exstid" size="40" onkeypress="return handleEnter(this, event)" value="<?php echo $edr['exstid']; ?>"  />
                </div>
              </label></td>
              <td class="style4">&nbsp;</td>
              <td class="style4">&nbsp;</td>
              <td class="style4">&nbsp;</td>
            </tr>
            <tr>
              <td height="26" align="right" class="style4">Name<span class="stars">*</span></td>
              <td height="26" class="style4">:</td>
              <td width="27%" height="26" class="style4"><input name="stdname" type="text" id="stdname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" size="40" onkeypress="return handleEnter(this, event)" value="<?php echo $edr['stdname']; ?>"/></td>
              <td width="23%" align="right" class="style4">Password<span class="stars">*</span></td>
              <td width="1%" class="style4">&nbsp;</td>
              <td width="30%" class="style4"><input name="password" type="text" id="password" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" size="40" onkeypress="return handleEnter(this, event)" value="<?php echo $edr['password']; ?>"/></td>
            </tr>
            <tr>
              <td height="26" align="right" class="style4">Sex<span class="stars">*</span></td>
              <td height="26" class="style4">: </td>
              <td height="26"><span class="style4">
                <select name="sexstatus" id="sexstatus" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                  <?php switch($edr['sexstatus']){
				           case "male":
				  ?>		   
				  <option selected="selected" value="<?php echo "male"; ?>"><?php echo "Male"; ?></option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
				  <?php       break;
				           case "female":
				  ?>
				  <option selected="selected" value="<?php echo "female"; ?>"><?php echo "Female"; ?></option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
				  <?php       break;
				            default:
				  ?>
				  <option value="">Select</option>			
                  <option value="male">Male</option>
                  <option value="female">Female</option>
				  <?php } ?>
                </select>
              </span></td>
              <td height="26" align="right"><span class="style4">DOB<span class="stars">*</span></span></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26"><label>
              <input name="dob" type="text" class="style4" id="DPC_dob_YYYY-MM-DD" size="30" onkeypress="return handleEnter(this, event)" value="<?php echo $edr['dob']; ?>" />
              </label></td>
            </tr>
            <tr>
              <td height="26" align="right" class="style4">Blood Group<span class="stars">*</span></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26"><span class="style4">
                <select name="bgroup" id="bgroup" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                  <option selected="selected" value="<?php echo $edr['bgroup']; ?>"><?php echo $edr['bgroup']; ?></option>
                  <option value="A+">A+</option>
                  <option value="A-">A-</option>
                  <option value="B+">B+</option>
                  <option value="B-">B-</option>
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option>
                </select>
              </span></td>
              <td height="26" align="right">&nbsp;</td>
              <td height="26">&nbsp;</td>
              <td height="26">&nbsp;</td>
            </tr>
            
            <tr>
              <td height="26" align="right" class="style4">Father's Name<span class="stars">*</span></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26"><input name="fname" type="text" class="style4" id="fname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="40" value="<?php echo $edr['fname']; ?>"/></td>
              <td height="26" align="right">&nbsp;</td>
              <td height="26">&nbsp;</td>
              <td height="26">&nbsp;</td>
            </tr>
            
            <tr>
              <td height="26" align="right"><span class="style4">Mother's Name<span class="stars">*</span></span></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26"><input name="mname" type="text" class="style4" id="mname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="40" value="<?php echo $edr['mname']; ?>" /></td>
              <td height="26" align="right"><span class="style4">Guardian Name </span></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26"><input name="gname" type="text" class="style4" id="gname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF"  onkeypress="return handleEnter(this, event)" size="40" value="<?php echo $edr['gname']; ?>"/></td>
            </tr>
            <tr>
              <td height="26" align="right" class="style4">Nationality</td>
              <td height="26" class="style4">:</td>
              <td height="26"><input name="nationality" type="text" class="style4" id="nationality" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="30" value="<?php echo $edr['nationality']; ?>" /></td>
              <td height="26" align="right"><span class="style4">Religion<span class="stars">*</span></span></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26"><span class="style4">
                <select name="religion" id="religion" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                  <option selected="selected" value="<?php echo $edr['religion']; ?>"><?php echo $edr['religion']; ?></option>
				  <option value="Islam">Islam</option>
                  <option value="Hindu">Hindu</option>
                  <option value="Boddho">Boddho</option>
                  <option value="Khristan">Khristan</option>
                  <option value="Iahudi">Iahudi</option>
                </select>
              </span></td>
            </tr>
            <tr>
              <td height="26" align="right" class="style4">Present Address<span class="stars">*</span></td>
              <td height="26" class="style4">:</td>
              <td height="26"><textarea name="praddress" cols="40" class="style4" id="praddress" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"><?php echo $edr['praddress']; ?></textarea></td>
              <td height="26" align="right"><span class="style4">Permanent Address<span class="stars">*</span> </span></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26"><textarea name="peraddress" cols="40" class="style4" id="peraddress" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"><?php echo $edr['peraddress']; ?></textarea></td>
            </tr>
            <tr>
              <td height="26" align="right" valign="top" class="style4">Phone<span class="stars">*</span></td>
              <td height="26" valign="top" class="style4">:</td>
              <td height="26" valign="top"><input name="phone" type="text" class="style4" id="phone" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="30" value="<?php echo $edr['phone']; ?>" /></td>
              <td height="26" align="right"><span class="style4">Image<span class="stars">*</span></span></td>
              <td height="26"><span class="style4" >:</span></td>
              <td height="26" valign="top">
    		<input name="img" type="file" class="style4" id="img"/></td>
            </tr>
            <tr>
              <td height="26">&nbsp;</td>
              <td height="26">&nbsp;</td>
              <td height="26" colspan="4">&nbsp;</td>
            </tr>
            <tr>
              <td height="26">&nbsp;</td>
              <td height="26">&nbsp;</td>
              <td height="26" colspan="4"><input type="submit" value="Update" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />                </td>
			  <input name="stdid" type="hidden" id="stdid" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" size="50"  />
            </tr>
          </table>
            </form>
         
          <p>&nbsp;</p>
		  

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
