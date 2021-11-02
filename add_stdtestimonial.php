<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managestdtestimonial.php' AND userid='$_SESSION[userid]'";
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

-->
</style>
<script language="javascript" src="jquery-1.4.2.js"></script>
<script type="text/javascript" src="jquery.js"></script>




<script language="javascript">
 $(document).ready(function(){
     	   $('#stdname').keyup(function(){
	      var p=$('#stdname').val();
	      $.get('pick_student.php?p='+p,function(rec){
		  
		    $('#showpick').show();
		    $('#showpick').html(rec);
		  });
		  $('#showpick').fadeIn('slow');
		  $('#showpick').html("<img src='bigLoader.gif' />");

	   });

	   
	    $('#stdname').keypress(function(e){
			   if(e.which==13){
			      $('#selectmenu').focus();
			   }	  
			 
		}); 

		//--load Father Name----------
		$('#stdid').blur(function(){
			var stdid=$('#stdid').val(); 
			var arr=$('#MyForm').serializeArray();
			//---------------load Father Name--------------
			$.post('loadfname.php?stdid='+stdid+'&a=1',arr,function(rec){
                    $('#fname').val($.trim(rec));
			});
			//---------------load Mother Name--------------
			$.post('loadfname.php?stdid='+stdid+'&b=1',arr,function(rec){
                    $('#mname').val($.trim(rec));
			});
			//---------------load DOB--------------
			$.post('loadfname.php?stdid='+stdid+'&c=1',arr,function(rec){
                    $('#dob').val($.trim(rec));
			});
			//---------------load Department Name--------------
			$.post('loadfname.php?stdid='+stdid+'&d=1',arr,function(rec){
                    $('#department').val($.trim(rec));
			});
			//---------------load Session--------------
			$.post('loadfname.php?stdid='+stdid+'&e=1',arr,function(rec){
                    $('#session').val($.trim(rec));
			});
			//---------------load Roll No--------------
			$.post('loadfname.php?stdid='+stdid+'&f=1',arr,function(rec){
                    $('#rollno').val($.trim(rec));
			});
			//---------------load Registration No--------------
			$.post('loadfname.php?stdid='+stdid+'&g=1',arr,function(rec){
                    $('#regino').val($.trim(rec));
			});
						   if(e.which==13){
			      $('#cgpa').focus();
			   }	  


		 });

  });

</script>

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

	function checkstddata()
	{
		if(document.getElementById("sn").value==''){
			alert('Serial No cant be left empty.');
			document.getElementById("sn").focus();
	     	return false;
		 
	    }

		if(document.getElementById("stdid").value==''){
		alert('Student ID can not left empty');
		 document.getElementById("stdid").focus();
	     return false;
		 
	    }
	
		if(document.getElementById("rollno").value==''){
		alert('Roll No can not left empty');
		 document.getElementById("rollno").focus();
	     return false;
		 
	    }

		if(document.getElementById("regino").value==''){
		alert('Registration can not left empty');
		 document.getElementById("regino").focus();
	     return false;
		 
	    }


		
		if(document.getElementById("writtenby").value=='0'){
		alert('Written By can not be zero');
		 document.getElementById("writtenby").focus();
	     return false;
		 
	    }
	

	}    

 
</script>





<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>


<style type="text/css">
<!--
.style17 {font-size: 18px}
.style19 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
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
          
          <p></p>
          <p>&nbsp;</p></td>
        <td width="79%" valign="top">
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></font></p>
   		<form name="MyForm" id="frm" action="ins_stdtestimonial.php" method="post" enctype="multipart/form-data" onsubmit="Javascript:return checkstddata();"><div align="center">
   		  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="3" id="stdtbl">

            <tr>
              <td height="36" colspan="4" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">ADD STUDENT TESTIMONIAL (<span class="stars">*</span>Mandatory Field) </span></td>
              </tr>
            <tr bgcolor="#F4F4FF">
              <td height="26" colspan="4" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><div align="center">General Information </div></td>
              </tr>
            <tr>
              <td width="26%" height="20" class="style2">Serial No  :<span class="stars">*</span> </td>
              <td width="27%" height="20" valign="top"><input name="sn" type="text" id="sn" style="font-family: Verdana;  font-size: 10pt; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29"  /></td>
              <td width="20%"><span class="style2"> Examinition Year:<span class="stars">*</span></span>
                <div id="shw"></div></td>
              <td width="27%">                <input name="syear" type="text" id="syear" style="font-family: Verdana; width:60px; height:18px; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" value="<?php echo date("Y");?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Student Name :<span class="stars">*</span> </td>
              <td height="20"><input name="stdname" type="text" id="stdname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td><span class="style2">Student ID  :<span class="stars">*</span></span></td>
              <td><input name="stdid" type="text" id="stdid"  style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" />
              </td>
            </tr>
            <tr>
              <td height="20" class="style2">Father Name :<span class="stars">*</span></td>
              <td height="20"><input name="fname" type="text" id="fname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29"  /></td>
              <td><span class="style2">Mother Name  :<span class="stars">*</span></span></td>
              <td><input name="mname" type="text" id="mname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">DOB :<span class="stars">*</span></td>
              <td height="20"><input name="dob" type="text" id="dob" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29"  /></td>
              <td><span class="style2"></span></td>
              <td>&nbsp;</td>
            </tr>
            <tr bgcolor="#F4F4FF" >
              <td height="27" colspan="4" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><div align="center" >Academic  Information</div></td>
              </tr>
            <tr>
              <td height="20" class="style2">Department  :<span class="stars">*</span> </td>
              <td height="20"><input name="department" type="text" id="department" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td><span class="style2">Session :<span class="stars">*</span> </span></td>
              <td><input name="session" type="text" id="session" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Roll No  :<span class="stars">*</span></td>
              <td height="20"><input name="rollno" type="text" id="rollno" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29"  /></td>
              <td><span class="style2">Registration No  :<span class="stars">*</span></span></td>
              <td><input name="regino" type="text" id="regino" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29"  /></td>
            </tr>
            <tr>
              <td height="20" class="style2">CGPA :<span class="stars">*</span></td>
              <td height="20"><input name="cgpa" type="text" id="cgpa2" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
              <td><span class="style2">Written By  :<span class="stars">*</span></span></td>
              <td><input name="writtenby" type="text" id="writtenby" style="font-family: Verdana;  font-size: 10pt; font-weight:bold; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" value="Save & Print" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"> </td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>          
          </div>

            </form>
          <br />
          		<div id="MyResult" align="center"></div>  		          
           <div id="showpick" style=" position:absolute; width:400px; height:500px; left:700px; float:right; height:auto;top:300px;"></div>
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
?>