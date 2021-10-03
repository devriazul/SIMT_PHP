<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_student.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#stdid").autocomplete("search_student.php", {
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
  var checkbox = document.getElementById("sh");
  $('#fname').mouseleave(function(e){
     if((checkbox.checked!== true)&&(e.which==13)){
	   $('#mname').focus();
	 }else{
	   $('#boardregno').focus();
	 }    
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


    function getExstid() {
        var checkbox = document.getElementById("sh");
        if(checkbox.checked == true){
             document.getElementById("ex").style.display = "block";
			 document.getElementById("exr").style.display = "block";
             document.getElementById("exx").style.display = "block";
        }else if(checkbox.checked == false) {
             document.getElementById("ex").style.display = "none";
			 document.getElementById("exr").style.display = "none";
             document.getElementById("exx").style.display = "none";
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
     if(document.getElementById("batch").value==""){
         alert('Student batch can not left empty!');
	     document.getElementById("batch").focus();
	     return false;
     }
     if(document.getElementById("semester").value==""){
         alert('Semester can not left empty!');
	     document.getElementById("semester").focus();
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


<script src="dep.js" type="text/javascript"></script>
<script src="std_hostelseat.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>

<script language="javascript">
$(document).ready(function(){
  $('#deptname').change(function(){
    //var session=$('#session').val();
	//var deptname=$('#deptname').val();
	var arr=$('#MyForm').serializeArray();
	//$('#myDiv1').html("<img src='images/load.gif'/>");
	$.post('add_std_achead.php',arr,function(data){
	  $('#sc').html(data);	
	});	
  });
  
    $('#deptname').blur(function(){
		//var session=$('#session').val();
		//var deptname=$('#deptname').val();
		var arr=$('#MyForm').serializeArray();
		$('#myDiv1').html("<img src='images/load.gif'/>");
		$.post("showbatch.php",arr,function(r){
		  $('#myDiv1').html(r);
		});
    });
  
  
  $('#yr').blur(function(){
    //var session=$('#session').val();
	//var deptname=$('#deptname').val();
	var arr=$('#MyForm').serializeArray();
	$.post('valid_year.php',arr,function(data){
	  $('#yrdiv').html(data);
	
	});
	var yr='<?php echo date("Y"); ?>';
	if($('#yr').val()>yr){
	  $('#yr').focus();
	  return false;
	}  
	if($('#yr').val()<1960){
	  $('#yr').focus();
	  return false;
	}  
  });
  
 $('#semester').change(function(){
    //var session=$('#session').val();
	//var deptname=$('#deptname').val();
	var arr=$('#MyForm').serializeArray();
	$.post('add_std_achead.php',arr,function(data){
	  $('#sc').hide();
	  $('#scc').html(data);
	
	});
  });
  
  $('#fname').focus(function(){
    $('#scc').hide();
  });
   $('#stdname').focus(function(){
	   var prtype=$('#exstid').val();   
	   $.get("validatetext.php?prtype="+prtype+"&equip=2",function(r){
	     $('#validatetext').html(r);	     
		 return false;

	   });
	   $.get("formetText.php?prtype="+prtype+"&equip=1",function(r){
	     $('#exstid').val($.trim(r));
	   });
   
   });
   
   $('input[name="dob"]').blur(function(){
     var dob=$('input[name="dob"]').val();
      $.get("getdob.php?dob="+dob,function(r){
	   $.trim($('input[name="dob"]').val(r));
	  })
   });
});
</script>
<script language="javascript">
$(document).ready(function(){
  $('#stdname').blur(function(){
	   var para=$('#stdname').val();
	   $.get("field_ucwords.php?para="+para,function(r){
		 $.trime($('#stdname').val($.trim(r));
	   });

  });
  
  $('#fname').blur(function(){
	   var para=$('#fname').val();
	   $.get("field_ucwords.php?para="+para,function(r){
		 $.trime($('#fname').val(r));
	   });

  });
  
  $('#mname').blur(function(){
	   var para=$('#mname').val();
	   $.get("field_ucwords.php?para="+para,function(r){
		 $.trime($('#mname').val(r));
	   });

  });
  
  $('#gname').blur(function(){
	   var para=$('#gname').val();
	   $.get("field_ucwords.php?para="+para,function(r){
		 $.trime($('#gname').val(r));
	   });

  });
});
</script>
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
        <td valign="top"><div align="center"><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?>
</font></div>
		<div id="top-search-div"> 
           <div id="content">
		   <label>Student Information</label>
		   <div class="input" style="margin-top:2px; ">
		   <form method="post" autocomplete="off" action="manage_student1.php">
		     <label>Search Form</label>
			 <label><input type="text" id="stdid" name="stdid" placeholder="Search by studentid" /></label>
			 <label><input type="submit" name="subs" id="submit-btn" value="Search" /></label>
			 <label><a href="stdinfo.php"><input type="button" name="addbtn" id="submit-btn" value="Add New" /></a></label>
		   </form>
		   </div>
		</div>
		</div>
<form name="MyForm" id="MyForm" action="insSTD.php" method="post" enctype="multipart/form-data" onsubmit="Javascript:return checkstd();">
          <br />
          <table width="950" border="0" align="center" cellpadding="0" cellspacing="0" id="stdtbl">

            <tr>
              <td height="35" colspan="8" bgcolor="#F7F7F7" class="style11" style="padding:3px; border-bottom:1px solid #CCCCCC">STUDENT INFORMATION </td>
              </tr>
            <tr>
              <td width="12%" height="26" class="style4">&nbsp;</td>
              <td width="1%" height="26" class="style4">&nbsp;</td>
              <td height="26" colspan="6"><label>
                <input name="sh" type="checkbox" class="style4" id="sh" onClick="getExstid();"/>
                <span class="style4">(Applicable for existing students) </span></label></td>
            </tr>
            <tr>
              <td height="26" class="style4">&nbsp;</td>
              <td height="26" class="style4">&nbsp;</td>
              <td height="26" class="style4"><label>
                <div id="ex" style="display:none;"><input name="exstid" type="text" class="style4" id="exstid" size="40" onkeypress="return handleEnter(this, event)" placeholder="Student id"  />
                </div>
              </label></td>
              <td class="style4">&nbsp;</td>
              <td class="style4">&nbsp;</td>
              <td colspan="3" class="style4">&nbsp;</td>
            </tr>
            <tr>
              <td height="26" align="right" class="style4"><div align="left">Name<span class="stars">*</span></div></td>
              <td height="26" class="style4">:</td>
              <td width="35%" height="26" class="style4"><input name="stdname" type="text" id="stdname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" size="40" onkeypress="return handleEnter(this, event)"/></td>
              <td width="13%" align="right" class="style4"><div align="left">Password<span class="stars">*</span></div></td>
              <td width="1%" class="style4">:</td>
              <td colspan="3" class="style4"><input name="password" type="text" id="password" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" size="40" onkeypress="return handleEnter(this, event)"/></td>
            </tr>
            <tr>
              <td height="26" align="right" class="style4"><div align="left">Sex<span class="stars">*</span></div></td>
              <td height="26" class="style4">: </td>
              <td height="26"><span class="style4">
                <select name="sexstatus" id="sexstatus" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                  <option value="">Select</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </span></td>
              <td height="26" align="right"><div align="left"><span class="style4">DOB<span class="stars">*</span></span></div></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26">
			   <select name="dy" id="dy" style="width:55px; " onkeypress="return handleEnter(this, event)">
			     <option value="">day</option>
				 <?php for($d=1;$d<=31;$d++){ ?>
				   <option value="<?php echo $d; ?>"><?php echo $d; ?></option>
				 <?php } ?>
			   </select>
			  </td>
              <td><select name="mn" id="mn" style="width:75px; " onkeypress="return handleEnter(this, event)">
			    <option value="">Month</option>
			    <option value="01">January</option>
				<option value="02">February</option>
				<option value="03">March</option>
				<option value="04">April</option>
				<option value="05">May</option>
				<option value="06">June</option>
				<option value="07">July</option>
				<option value="08">August</option>
				<option value="09">September</option>
				<option value="10">October</option>
				<option value="11">November</option>
				<option value="12">December</option>

			  </select></td>
              <td height="26"><input name="yr" type="text" id="yr" style="width:65px; " onkeypress="return handleEnter(this, event)" size="4" maxlength="4" placeholder="Year"/>
			  
			  </td>
            </tr>
            <tr>
              <td height="26" align="right" class="style4">&nbsp;</td>
              <td height="26">&nbsp;</td>
              <td height="26">&nbsp;</td>
              <td height="26" colspan="5" align="left"><div id="yrdiv" style="color:#FF3300; "></div></td>
              </tr>
            <tr>
              <td height="26" align="right" class="style4"><div align="left">Session<span class="stars">*</span></div></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26"><div id="sc"></div>
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
              <td height="26" align="right"><div align="left"><span class="style4">Blood Group<span class="stars"></span></span></div></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26" colspan="3"><span class="style4">
                <select name="bgroup" id="bgroup" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                  <option value="">Select</option>
                  <option value="A+">A+</option>
                  <option value="A-">A-</option>
                  <option value="B+">B+</option>
                  <option value="B-">B-</option>
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option>
				  <option value="O+">O+</option>

                  <option value="O-">O-</option>
                </select>
              </span></td>
            </tr>
            <tr>
              <td height="26" align="right" class="style4"><div align="left">Department<span class="stars">*</span></div></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26"><select name="deptname" class="style4" id="deptname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" >
                <option value="">Select</option>
				<?php $dq="SELECT id,code,name FROM tbl_department WHERE storedstatus IN('I','U') order by id desc";
				      $dr=$myDb->select($dq);
					  while($drow=$myDb->get_row($dr,'MYSQL_ASSOC')){
				?>
				<option value="<?php echo $drow['id']; ?>"><?php echo $drow['code']."(".$drow['name'].")"; ?></option>
				<?php } ?>	   
              </select></td>
              <td height="26" colspan="5">
			  <div id="myDiv1">
					             
			  </div>
			  </td>
              </tr>

           
            <tr>
              <td height="26" align="right"><div align="left"><span class="style4">Section</span><span class="stars">*</span></div></td>
              <td height="26" class="style4">:</td>
              <td height="26"><span class="style4">
                <select name="section" id="section" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                  <option value="E">E</option>
                </select>
              </span></td>
              <td height="35" colspan="4" align="center" bgcolor="#F7F7F7" class="style11" style="border-bottom:1px solid #CCCCCC;">CHILD OF </td>
              <td height="35" align="center" bgcolor="#F7F7F7" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
            </tr>
            <tr>
              <td height="26" align="right"><div align="left"><span class="style4">Semester</span><span class="style4"><span class="stars">*</span></span></div></td>
              <td height="26" class="style4">:</td>
              <td height="26"><div id="scc"></div><select name="semester" class="style4" id="semester" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                <option value="">Select</option>
                <?php $dq="SELECT * FROM tbl_semester WHERE storedstatus IN('I','U') order by id";
				      $dr=$myDb->select($dq);
					  while($drow=$myDb->get_row($dr,'MYSQL_ASSOC')){
				?>
                <option value="<?php echo $drow['id']; ?>"><?php echo $drow['name']; ?></option>
                <?php } ?>
              </select></td>
              <td height="26" align="right">&nbsp;</td>
              <td height="26" class="style4">&nbsp;</td>
              <td width="9%" height="26" colspan="2"><label class="style4">
                <input name="horde" type="checkbox" id="horde" value="Y" onkeypress="return handleEnter(this, event)"/>
                Horde              </label></td>
              <td width="29%"><label class="style4">
                <input name="ffighter" type="checkbox" id="ffighter" value="Y" onkeypress="return handleEnter(this, event)" />
               Freedom Fighter </label></td>
            </tr>
            <tr>
              <td height="35" align="right"><div align="left"><span class="style4">Hostel</span></div></td>
              <td height="35" class="style4">:</td>
              <td height="35" align="left"><select name="hostel" class="style4" id="hostel" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
				<option value=""></option>
				<?php $hq="SELECT id,code,name FROM tbl_hostel order by id desc";
				      $hr=$myDb->select($hq);
					  while($hrow=$myDb->get_row($hr,'MYSQL_ASSOC')){
				?>
				<option value="<?php echo $hrow['code']; ?>"><?php echo $hrow['name']; ?></option>
				<?php } ?>	   
              </select>
                
                <div id="myDiv2"></div>               </td>
              <td height="35" align="right"><div align="left"><span class="style4">Father's Name</span><span class="style4"><span class="stars">*</span></span></div></td>
              <td height="35" class="style4">:</td>
              <td height="35" colspan="3"><input name="fname" type="text" class="style4" id="fname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="40"/></td>
            </tr>
			            <tr>
              <td height="35" align="right"><div align="left"><span class="style4">Mother's Name</span><span class="style4"><span class="stars">*</span></span></div></td>
              <td height="35" class="style4">:</td>
              <td height="35"><input name="mname" type="text" class="style4" id="mname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="40" /></td>
              <td height="35" align="right"><div align="left"><span class="style4">Guardian Name </span></div></td>
              <td height="35"><span class="style4">:</span></td>
              <td height="35" colspan="3"><input name="gname" type="text" class="style4" id="gname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF"  onkeypress="return handleEnter(this, event)" size="40"/></td>
            </tr>

                        <tr>
                          <td height="2" align="right" bgcolor="#F7F7F7" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
                          <td height="2" bgcolor="#F7F7F7" class="style4" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
                          <td height="2" bgcolor="#F7F7F7" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
                          <td height="2" align="right" bgcolor="#F7F7F7" class="style4" style="border-bottom:1px solid #CCCCCC;"></td>
                          <td height="2" bgcolor="#F7F7F7" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
                          <td height="2" colspan="3" bgcolor="#F7F7F7" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
                        </tr>
                <tr>
              <td height="40" align="right" bgcolor="#F7F7F7" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
              <td height="40" bgcolor="#F7F7F7" class="style4" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
              <td height="40" bgcolor="#F7F7F7" style="border-bottom:1px solid #CCCCCC;"><div id="exx" style="display:none;"><label><span class="style4">Board Registration No:</span></label><br/><input name="boardregno" type="text" class="style4" id="boardregno" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="40" placeholder="Board Registration No" /></div></td>
              <td height="40" align="right" bgcolor="#F7F7F7" class="style4" style="border-bottom:1px solid #CCCCCC;"></td>
              <td height="40" bgcolor="#F7F7F7" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
              <td height="40" colspan="3" bgcolor="#F7F7F7" style="border-bottom:1px solid #CCCCCC;"><div id="exr" style="display:none;"><label><span class="style4">Board Roll No:</span></label><br/><input name="boardrollno" type="text" class="style4" id="boardrollno" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="40" placeholder="Board Roll No" /></div></td>
            </tr>
            
            <tr>
              <td height="26" align="right" class="style4"><div align="left">Nationality</div></td>
              <td height="26" class="style4">:</td>
              <td height="26"><input name="nationality" type="text" class="style4" id="nationality" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="30" value="Bangladeshi" /></td>
              <td height="26" align="right"><div align="left"><span class="style4">Religion</span><span class="style4"><span class="stars">*</span></span></div></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26" colspan="3"><span class="style4">
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
              <td height="26" align="right" class="style4"><div align="left">Present Address<span class="stars">*</span></div></td>
              <td height="26" class="style4">:</td>
              <td height="26"><textarea name="praddress" cols="40" class="style4" id="praddress" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"></textarea></td>
              <td height="26" align="right"><div align="left"><span class="style4">Permanent Address</span><span class="style4"><span class="stars">*</span></span></div></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26" colspan="3"><textarea name="peraddress" cols="40" class="style4" id="peraddress" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"></textarea></td>
            </tr>
            <tr>
              <td height="26" align="right" valign="top" class="style4"><div align="left">Phone<span class="stars">*</span></div></td>
              <td height="26" valign="top" class="style4">:</td>
              <td height="26" valign="top"><input name="phone" type="text" class="style4" id="phone" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="30" /></td>
              <td height="26" align="right"><div align="left"><span class="style4">Image</span><span class="style4"><span class="stars">*</span></span></div></td>
              <td height="26"><span class="style4" >:</span></td>
              <td height="26" colspan="3" valign="top">
    		<input name="img" type="file" class="style4" id="img" onkeypress="return handleEnter(this, event)"/></td>
            </tr>
            <tr>
              <td height="26">&nbsp;</td>
              <td height="26">&nbsp;</td>
              <td height="26" colspan="6">&nbsp;</td>
            </tr>
            <tr>
              <td height="40" bgcolor="#F7F7F7" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
              <td height="40" bgcolor="#F7F7F7" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
              <td height="40" colspan="6" bgcolor="#F7F7F7" style="border-bottom:1px solid #CCCCCC;"><div align="center">
                <input type="submit" value="Save &amp; Continue" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />                
              </div></td>
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
  header("Location:index.php");
}
}