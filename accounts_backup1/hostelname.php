<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='hostelname.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
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
 
function valdepname(){
  		if(document.getElementById("code1").value==''){
		alert('Code can not left empty');
		 document.getElementById("code1").focus();
	     return false;
		 
	    }
		if(document.getElementById("name1").value==''){
		alert('Department name can not left empty');
		 document.getElementById("name1").focus();
	     return false;
		 
	    }
		if(document.getElementById("address").value==''){
		alert('Address can not left empty');
		 document.getElementById("address").focus();
	     return false;
		 
	    }
		if(document.getElementById("noofseats").value==''){
		alert('No of seats can not left empty');
		 document.getElementById("noofseats").focus();
	     return false;
		 
	    }
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
		<form id="form1" name="form1" method="post" action="ins_hostel.php" onsubmit="Javascript:return valdepname();">
          <div align="center"><br />
          <table width="70%" border="0" align="center" cellpadding="0" cellspacing="5" id="stdtbl">

            <tr>
              <td height="20" colspan="2" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">HOSTEL INFORMATION <span class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><span class="stars">*</span>(Mandatory Field) </span></td>
              </tr>
            <tr>
              <td width="31%" height="20" class="style2">Code:<span class="stars">*</span> </td>
              <td width="69%" height="20"><input name="code1" type="text" id="code1" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Name:<span class="stars">*</span> </td>
              <td height="20"><input name="name1" type="text" id="name1" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Address:<span class="stars">*</span> </td>
              <td height="20"><textarea name="address" cols="50" id="address" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"></textarea></td>
            </tr>
            <tr>
              <td><span class="style2">No of Seats:<span class="stars">*</span> </span></td>
              <td><input name="noofseats" id="noofseats" type="text" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="15" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" value="Submit" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"> <input type="reset" name="Submit2" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/></td>
            </tr>
          </table>          
          </div>

                </form>
          <br />
          <?php $sdq="select id,code,name,address,noofseats from  tbl_hostel where storedstatus='I' OR storedstatus='U' order by id desc";
			    $sdep=$myDb->dump_query($sdq,'edit_hostelname.php','del_hostelname.php',$car['upd'],$car['delt']);
		  ?>		          
          <p align="center">
            <input type="submit" value="Save" name="B12" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />
            <input type="reset" name="Submit22" value="Edit" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/>
            <input type="button" name="Submit222" value="Refresh" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/>
			
</p>
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