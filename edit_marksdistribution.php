<?php session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $id=mysql_real_escape_string($_GET['id']);
  //$vs="SELECT*FROM tbl_payscale WHERE id='$id'";
  $vs="Select m.id, d.id as departmentid, d.name as DepartmentName, c.id as courseid, c.coursename, m.markstype, m.totalmarks from tbl_marksdistribution m inner join tbl_department d on m.departmentid=d.id inner join tbl_courses c on m.courseid=c.id WHERE m.storedstatus<>'D' and m.id='$id'
 order by id";
  $r=$myDb->select($vs);
  $row=$myDb->get_row($r,'MYSQL_ASSOC');
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managemarksdistribution.php' AND userid='$_SESSION[userid]'";
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
	
	function checkstaffdata()
	{
		if(document.getElementById("totalmarks").value==''){
		alert('Total Marks can not left empty');
		 document.getElementById("totalmarks").focus();
	     return false;
		 
	    }

		if(document.getElementById("classtest").value==''){
		alert('Class Test can not be left empty.');
		 document.getElementById("classtest").focus();
	     return false;
		 
	    }

		

		if(document.getElementById("quiz").value==''){
		alert('Quiz can not be left empty.');
		 document.getElementById("quiz").focus();
	     return false;
		 
	    }

		
		if(document.getElementById("behavior").value==''){
		alert('Behavior can not be left empty');
		 document.getElementById("behavior").focus();
	     return false;
		 
	    }

		if(document.getElementById("attendance").value==''){
		alert('Attendance can not be left empty.');
		 document.getElementById("attendance").focus();
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
		<form name="MyForm" action="ed_marksdistribution.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data" onsubmit="Javascript:return checkstaffdata();">
          
			<div align="center"><br />
          <table width="70%" border="0" align="center" cellpadding="0" cellspacing="5" id="stdtbl">

            <tr>
              <td height="20" colspan="2" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">EDIT MARKS DISTRIBUTION (<span class="stars">*</span>Mandatory Field) </span></td>
              </tr>
            <tr bgcolor="#F3F3F3">
              <td height="18" colspan="2" class="style2">&nbsp;</td>
              </tr>
            <tr>
              <td width="31%" height="20" class="style2">Department Name :<span class="stars">*</span></td>
              <td width="69%" height="20"><select name="deptid" id="deptid" onkeypress="return handleEnter(this, event)">
                <option selected="selected" value="<?php echo $row['departmentid']; ?>"><?php echo $row['DepartmentName']; ?></option>
                <?php $hq=$myDb->select("select id,name from tbl_department");
				   while($hrow=$myDb->get_row($hq,'MYSQL_ASSOC')){
				   ?>
                <option value="<?php echo $hrow['id']; ?>"><?php echo $hrow['name']; ?></option>
                <?php } ?>
              </select></td>
            </tr>
            <tr>
              <td height="20" class="style2">Subject Name :<span class="stars">*</span> </td>
              <td height="20"><select name="courseid" id="select" onkeypress="return handleEnter(this, event)">
                <option selected="selected" value="<?php echo $row['courseid']; ?>"><?php echo $row['coursename']; ?></option>
                <?php $hq=$myDb->select("select id,coursename from tbl_courses");
				   while($hrow=$myDb->get_row($hq,'MYSQL_ASSOC')){
				   ?>
                <option value="<?php echo $hrow['id']; ?>"><?php echo $hrow['coursename']; ?></option>
                <?php } ?>
              </select></td>
            </tr>
            <tr>
              <td height="20" class="style2">Distribution Type  :<span class="stars">*</span></td>
              <td height="20"><span class="style4">
              <select name="dtype" id="dtype" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                <?php if($row['markstype']=="Theory Cont. Access"){ ?>
                <option value="<?php echo $row['markstype']; ?>" selected="selected">Theory Cont. Access</option>
                <?php }else if($row['markstype']=="Theory Final Exam."){ ?>
                <option value="<?php echo $row['markstype']; ?>">Theory Final Exam.</option>
                <?php }else if($row['markstype']=="Practical Cont. Access"){ ?>
                <option value="<?php echo $row['markstype']; ?>">Practical Cont. Access</option>
                <?php }else if($row['markstype']=="Practical Final Exam."){ ?>
                <option value="<?php echo $row['markstype']; ?>">Practical Final Exam.</option>
                
                <?php } ?>
                <option value="Theory Cont. Access">Theory Cont. Access</option>
                <option value="Theory Final Exam.">Theory Final Exam</option>
                <option value="Practical Cont. Access">Practical Cont. Access</option>
                <option value="Practical Final Exam.">Practical Final Exam.</option>
              </select>
</span></td>
            </tr>
            <tr>
              <td height="20" class="style2">Total Marks  :<span class="stars">*</span> </td>
              <td height="20"><input name="totalmarks" type="text" id="totalmarks" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" maxlength="11" value="<?php echo $row['totalmarks']; ?>" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
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