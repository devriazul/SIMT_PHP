<?php session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $id=mysql_real_escape_string($_GET['id']);
  $vs="SELECT * FROM tbl_semester WHERE storedstatus <>'D' AND id='$id'";
  $r=$myDb->select($vs);
  $row=$myDb->get_row($r,'MYSQL_ASSOC');
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='semesterinfo.php' AND userid='$_SESSION[userid]'";
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
 
function valsemester(){
  		
		if(document.getElementById("name").value==''){
		alert('Department name can not left empty');
		 document.getElementById("name").focus();
	     return false;
		 
	    }
		if(document.getElementById("year").value==''){
		alert('Year can not left empty');
		 document.getElementById("year").focus();
	     return false;
		 
	    }
		if(document.getElementById("session").value==''){
		alert('Session can not left empty');
		 document.getElementById("session").focus();
	     return false;
		 
	    }
		if(document.getElementById("period").value==''){
		alert('Period can not left empty');
		 document.getElementById("period").focus();
	     return false;
		 
	    }
		if(document.getElementById("totcredit").value==''){
		alert('Totcredit can not left empty');
		 document.getElementById("totcredit").focus();
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
		<form id="form1" name="form1" method="post" action="ed_semesterinfo.php?id=<?php echo $id; ?>" onsubmit="Javascript:return valsemester();">
          <div align="center"><br />
          <table width="70%" border="0" align="center" cellpadding="0" cellspacing="3" id="stdtbl">

            <tr>
              <td height="20" colspan="3" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">SEMESTER INFORMATION </td>
              </tr>
            <tr>
              <td width="32%" height="20" class="style2">Semester Name <span class="stars">*</span> </td>
              <td width="4%"><div align="center"><span class="style2">:</span></div></td>
              <td width="64%" height="20"><input name="name" type="text" id="name" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['name']; ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Year <span class="stars">*</span> </td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><input name="year" type="text" id="year" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['year']; ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Session <span class="stars">*</span> </td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20">                  <select name="session" class="style2" id="session" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                <option selected="selected" value="<?php echo $row['session']; ?> "><?php echo "20".substr_replace($row['session'],'-20',-2,-2); ?></option>
				    
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
                </select></td></tr>
            <tr>
              <td height="20" class="style2">Period <span class="stars">*</span> </td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><input name="period" type="text" id="period" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo $row['period']; ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Credit <span class="stars">*</span> </td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td height="20"><input name="totcredit" id="totcredit" type="text" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="15" value="<?php echo $row['totalcredit']; ?>" /></td>
            </tr>
            <tr>
              <td><span class="style2">Description </span><span class="stars">*</span> </td>
              <td><div align="center"><span class="style2">:</span></div></td>
              <td>                <textarea name="desc" cols="60" id="desc" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"><?php echo $row['description']; ?></textarea></td>
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
          <?php $sdq=" SELECT * FROM tbl_semester WHERE storedstatus <>'D'";
			    $sdep=$myDb->dump_query($sdq,'edit_semesterinfo.php','del_semesterinfo.php',$car['upd'],$car['delt']);
		  ?>
          <p align="center">&nbsp;
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