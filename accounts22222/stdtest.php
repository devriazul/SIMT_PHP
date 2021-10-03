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
<script type="text/javascript">
function loadXMLDocd(p)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {	
    if(xmlhttp.readyState == 3)  // Loading Request
	{
	document.getElementById("myDiv1").innerHTML = '<img src="loader.gif" align="center" />';
	}else{  
	//if (xmlhttp.readyState==4 && xmlhttp.status==200)
    //{
    document.getElementById("myDiv1").innerHTML=xmlhttp.responseText;
    //document.getElementById("pid").focus();
	//document.getElementById("tr"+r).style.display="none"; 
    }
  }
xmlhttp.open("GET","showbatch.php?code="+p,true);
xmlhttp.send();
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
		
<form name="MyForm" action="insSTD.php" method="post" enctype="multipart/form-data" onsubmit="Javascript:return checkstd();">
          <br />
          <table width="900" border="0" align="center" cellpadding="0" cellspacing="2" id="stdtbl">

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
                <div id="ex" style="display:block;"><input name="exstid" type="text" class="style4" id="exstid" size="40" onkeypress="return handleEnter(this, event)"  />
                </div>
              </label></td>
              <td class="style4">&nbsp;</td>
              <td class="style4">&nbsp;</td>
              <td class="style4">&nbsp;</td>
            </tr>
            <tr>
              <td height="26" align="right" class="style4"><span class="stars">*</span>Name</td>
              <td height="26" class="style4">:</td>
              <td width="27%" height="26" class="style4"><input name="stdname" type="text" id="stdname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" size="40" onkeypress="return handleEnter(this, event)"/></td>
              <td width="23%" class="style4">Password<span class="stars">*</span></td>
              <td width="1%" class="style4">&nbsp;</td>
              <td width="30%" class="style4"><input name="password" type="text" id="password" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" size="40" onkeypress="return handleEnter(this, event)"/></td>
            </tr>
            <tr>
              <td height="26" align="right" class="style4"><span class="stars">*</span>Sex</td>
              <td height="26" class="style4">: </td>
              <td height="26"><span class="style4">
                <select name="sexstatus" id="sexstatus" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                  <option value="">Select</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </span></td>
              <td height="26"><span class="style4">DOB<span class="stars">*</span></span></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26"><label>
              <input name="dob" type="text" class="style4" id="DPC_dob_YYYY-MM-DD" size="30" onkeypress="return handleEnter(this, event)" />
              </label></td>
            </tr>
            <tr>
              <td height="26" align="right" class="style4"><span class="stars">*</span>Session</td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26">
			  <select name="session" class="style4" id="session" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                <option value="">Select session</option>
				<option value="0506">2005-2006</option>
				<option value="0607">2006-2007</option>
				<option value="0708">2007-2008</option>
				<option value="0809">2008-2009</option>
				<option value="0910">2009-2010</option>
				<option value="1011">2010-2011</option>
				<option value="1112">2011-2012</option>
				<option value="1213">2012-2013</option>
				<option value="1314">2013-2014</option>
				<option value="1415">2014-2015</option>
				<option value="1516">2015-2016</option>
				<option value="1617">2016-2017</option>
				<option value="1718">2017-2018</option>
				<option value="1819">2018-2019</option>
				<option value="1920">2019-2020</option>
				<option value="2021">2020-2021</option>
				<option value="2122">2021-2022</option>
				<option value="2223">2022-2023</option>
				<option value="2324">2023-2024</option>
				<option value="2425">2024-2025</option>
              </select></td>
              <td height="26"><span class="style4">Blood Group<span class="stars">*</span></span></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26"><span class="style4">
                <select name="bgroup" id="bgroup" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                  <option value="">Select</option>
                  <option value="A+">A+</option>
                  <option value="A-">A-</option>
                  <option value="B+">B+</option>
                  <option value="B-">B-</option>
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option>
                </select>
              </span></td>
            </tr>
            <tr>
              <td height="26" align="right" class="style4"><span class="stars">*</span>Department</td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26"><select name="deptname" class="style4" id="deptname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" onchange="xmlhttpPost('showbatch.php', 'MyForm', 'myDiv1', '<img src=\'loader.gif\'>');">
                <option value="">Select</option>
				<?php $dq="SELECT code FROM tbl_department WHERE storedstatus IN('I','U') order by id desc";
				      $dr=$myDb->select($dq);
					  while($drow=$myDb->get_row($dr,'MYSQL_ASSOC')){
				?>
				<option value="<?php echo $drow['code']; ?>"><?php echo $drow['code']; ?></option>
				<?php } ?>	   
              </select></td>
              <td height="26" colspan="3"><div id="myDiv1"></div></td>
              </tr>

           
            <tr>
              <td height="26" align="right"><span class="style4"><span class="stars">*</span>Hostel</span></td>
              <td height="26" class="style4">:</td>
              <td height="26"><select name="hostel" class="style4" id="hostel" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
				<option></option>
				<?php $hq="SELECT code,name FROM tbl_hostel order by id desc";
				      $hr=$myDb->select($hq);
					  while($hrow=$myDb->get_row($hr,'MYSQL_ASSOC')){
				?>
				<option value="<?php echo $hrow['code']; ?>"><?php echo $hrow['name']; ?></option>
				<?php } ?>	   
              </select></td>
              <td height="26"><span class="style4">Father's Name<span class="stars">*</span></span></td>
              <td height="26">&nbsp;</td>
              <td height="26"><input name="fname" type="text" class="style4" id="fname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="40"/></td>
            </tr>
            <tr>
              <td height="26" align="right"><span class="style4"><span class="stars">*</span>Mother's Name</span></td>
              <td height="26" class="style4">:</td>
              <td height="26"><input name="mname" type="text" class="style4" id="mname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="40" /></td>
              <td height="26"><span class="style4">Guardian Name </span></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26"><input name="gname" type="text" class="style4" id="gname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF"  onkeypress="return handleEnter(this, event)" size="40"/></td>
            </tr>
            <tr>
              <td height="26" align="right" class="style4">Nationality</td>
              <td height="26" class="style4">:</td>
              <td height="26"><input name="nationality" type="text" class="style4" id="nationality" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="30" value="Bangladeshi" /></td>
              <td height="26"><span class="style4">Religion<span class="stars">*</span></span></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26"><span class="style4">
                <select name="religion" id="religion" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                  <option value="">Select</option>
				  <option value="Islam">Islam</option>
                  <option value="Hindu">Hindu</option>
                  <option value="Boddho">Boddho</option>
                  <option value="Khristan">Khristan</option>
                  <option value="Iahudi">Iahudi</option>
                </select>
              </span></td>
            </tr>
            <tr>
              <td height="26" align="right" class="style4"><span class="stars">*</span>Present Address</td>
              <td height="26" class="style4">:</td>
              <td height="26"><textarea name="praddress" cols="40" class="style4" id="praddress" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"></textarea></td>
              <td height="26"><span class="style4">Permanent Address<span class="stars">*</span> </span></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26"><textarea name="peraddress" cols="40" class="style4" id="peraddress" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"></textarea></td>
            </tr>
            <tr>
              <td height="26" align="right" valign="top" class="style4"><span class="stars">*</span>Phone</td>
              <td height="26" valign="top" class="style4">:</td>
              <td height="26" valign="top"><input name="phone" type="text" class="style4" id="phone" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="30" /></td>
              <td height="26"><span class="style4">Image<span class="stars">*</span></span></td>
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
              <td height="26" colspan="4"><input type="submit" value="Save &amp; Continue" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />                </td>
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
