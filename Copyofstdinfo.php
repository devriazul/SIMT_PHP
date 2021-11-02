<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_student.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
     header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	 header("Cache-Control: post-check=0, pre-check=0", false);
	 header("Pragma: no-cache");

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
             document.getElementById("exx").style.display = "block";
        }else if(checkbox.checked == false) {
             document.getElementById("ex").style.display = "none";
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
  document.getElementById("exx").style.display = "block";
  document.getElementById("exr").style.display = "block";
  $('#deptname').change(function(){
    //var session=$('#session').val();
	//var deptname=$('#deptname').val();
	var arr=$('#MyForm').serializeArray();
	$.post('add_std_achead.php',arr,function(data){
	  $('#sc').html(data);
	
	});
	$.post('showbatch.php',arr,function(data){
	  $('#myDiv1').html(data).fadeIn('fast');
	
	});
  });
  
  $('#DPC_dob_YYYY-MM-DD').blur(function(){
    //var session=$('#session').val();
	//var deptname=$('#deptname').val();
	var arr=$('#MyForm').serializeArray();
	$.post('valid_year_edit.php',arr,function(data){
	  $('#yrdiv').html(data);
	
	});
	var yr='<?php echo date("Y-m-d"); ?>';
	if($('#DPC_dob_YYYY-MM-DD').val()>yr){
	  $('#DPC_dob_YYYY-MM-DD').focus();
	  return false;
	}  
	if($('#DPC_dob_YYYY-MM-DD').val()<'1960-01-01'){
	  $('#DPC_dob_YYYY-MM-DD').focus();
	  return false;
	}  
  });  
  
  var deptname='<?php echo $edr['deptname']; ?>'
  var bid='<?php echo $edr['batch']; ?>'
	$.get('edit_showbatch.php?deptname='+deptname+'&bid='+bid,function(data){
	  $('#myDiv1').html(data).fadeIn('fast');
	
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
  
  
});
</script>
<script language="javascript">
 $(document).ready(function(){
	  if(($('#stdstatus').val()=="D") || ($('#stdstatus').val()=="F")|| ($('#stdstatus').val()=="RF")){
	    $('#rmrk').show();
	  
	  }else{
	    $('#rmrk').hide();
	  
	  }
   $('#stdstatus').change(function(){
      $('.csts').css({'background-color':'#FF0000'}).css({'height':'30px','padding':'2px','color':'#FFFFFF'}).hide().fadeIn('slow');
	  $('#rmrk').css({'background-color':'#FF0000'}).css({'padding':'2px','color':'#FFFFFF'}).hide().fadeIn('slow');
	  if(($('#stdstatus').val()=="D") || ($('#stdstatus').val()=="F")|| ($('#stdstatus').val()=="RF")){
	    $('#rmrk').show();
	  
	  }else{
	    $('#rmrk').hide();
	  
	  }
   
   });
 
 });

</script>
<script language="javascript">
$(document).ready(function(){
  $('#stdname').blur(function(){
	   var para=$('#stdname').val();
	   $.get("field_ucwords.php?para="+para,function(r){
		 $.trime($('#stdname').val(r));
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
        <td valign="top"><div align="center"><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></font></div>
		<div id="top-search-div"> 
           <div id="content">
		   <div class="input" style="margin-top:3px; ">
		   <form method="post" autocomplete="off" action="manage_student1.php" >
		     <label>Search Form</label>
			 <label><input type="text" id="stdid" name="stdid" /></label>
			 <label><input type="submit" name="subs" id="submit-btn" value="Search" /></label>
			 <label><a href="stdinfo.php"><input type="button" name="addbtn" id="submit-btn" value="Add New" /></a></label>
		   </form>
		   </div>
		</div>
		</div>
<form name="MyForm" id="MyForm" action="edstd.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data" onsubmit="Javascript:return checkstd();">
          <br />
          <table width="950" border="0" align="center" cellpadding="0" cellspacing="0" id="stdtbl">

            <tr>
              <td height="35" colspan="3" bgcolor="#F7F7F7" class="style11" style="padding:3px; border-bottom:1px solid #CCCCCC">STUDENT INFORMATION </td>
              <td height="35" bgcolor="#F7F7F7" class="style11" style="padding:3px; border-bottom:1px solid #CCCCCC">Student Status </td>
              <td height="35" bgcolor="#F7F7F7" class="style11" style="padding:3px; border-bottom:1px solid #CCCCCC">:</td>
              <td height="35" colspan="2" bgcolor="#F7F7F7" class="style11" style="padding:3px; border-bottom:1px solid #CCCCCC">
			   <select name="stdstatus" id="stdstatus">
			    
				<?php if(!empty($edr['stdstatus'])){ ?>
				
				 <?php switch($edr['stdstatus']){
				            case "R":
				?>			
							    <option selected="selected" value="R">Regular</option>
				<?php 				
								break;
							case "IR":
				?>			
							     <option selected="selected" value="IR">Irregular</option>
				<?php 				 
								break;
							case "D":
				?>
				 <option selected="selected" value="D">Drop Out</option>			
                <?php 
								break;
						    case "C":
				?>
				 <option selected="selected" value="C">Cancel</option>			
                <?php 
								break;
							default:
				?>			
					<option value="">Select Status</option>						
				<?php 
				 }
				 ?>
				
				<?php } ?>
				<option value="R">Regular</option>
				<option value="IR">Irregular</option>
				<option value="D">Drop Out</option>
				<option value="C">Cancel</option>
			   </select>			  </td>
              </tr>
            
            <tr>
              <td width="12%" height="26" class="style4">&nbsp;</td>
              <td width="1%" height="26" class="style4">&nbsp;</td>
              <td height="26" class="style4"><label>
                <div id="ex"><input name="exstid" type="text" class="style4" id="exstid" size="40" onkeypress="return handleEnter(this, event)" value="<?php echo trim($edr['stdid']); ?> "  />
                </div>
              </label></td>
              <td class="style4">&nbsp;</td>
              <td class="style4">&nbsp;</td>
              <td colspan="2" class="style4">&nbsp;</td>
            </tr>
            <tr>
              <td height="26" align="right" class="style4"><div align="left">Name<span class="stars">*</span></div></td>
              <td height="26" class="style4">:</td>
              <td width="34%" height="26" class="style4"><input name="stdname" type="text" id="stdname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" size="40" onkeypress="return handleEnter(this, event)" value="<?php echo $edr['stdname']; ?>"/></td>
              <td width="14%" align="right" class="style4"><div align="left">Password<span class="stars">*</span></div></td>
              <td width="1%" class="style4">:</td>
              <td colspan="2" class="style4"><input name="password" type="text" id="password" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" size="40" onkeypress="return handleEnter(this, event)" value="<?php echo $edr['password']; ?>"/></td>
            </tr>
            <tr>
              <td height="26" align="right" class="style4"><div align="left">Sex<span class="stars">*</span></div></td>
              <td height="26" class="style4">: </td>
              <td height="26"><span class="style4">
                <select name="sexstatus" id="sexstatus" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                  <option selected="selected" value="<?php echo $edr['sexstatus']; ?>"><?php echo $edr['sexstatus']; ?></option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </span></td>
              <td height="26" align="right"><div align="left"><span class="style4">DOB</span><span class="style4"><span class="stars">*</span></span></div></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26" colspan="2"><label>
              <input name="dob" type="text" class="style4" id="DPC_dob_YYYY-MM-DD" size="30" onkeypress="return handleEnter(this, event)" value="<?php echo $edr['dob']; ?>" />
              </label></td>
            </tr>
            <tr>
              <td height="26" align="right" class="style4">&nbsp;</td>
              <td height="26">&nbsp;</td>
              <td height="26">&nbsp;</td>
              <td height="26" colspan="4" align="left"><div id="yrdiv" style="color:#FF3300; "></div></td>
              </tr>
            <tr>
              <td height="26" align="right" class="style4"><div align="left">Session<span class="stars">*</span></div></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26"><div id="sc"></div>
			  <select name="session" class="style4" id="session" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                <option selected="selected" value="<?php echo $edr['session']; ?>"><?php echo "20".substr($edr['session'],0,2)."-"."20".substr($edr['session'],-2,4); ?></option>
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
              <td height="26" align="right"><div align="left"><span class="style4">Blood Group</span><span class="style4"></span></div></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26" colspan="2"><span class="style4">
                <select name="bgroup" id="bgroup" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                  <option selected="selected" value="<?php echo $edr['bgroup']; ?>"><?php echo $edr['bgroup']; ?></option>
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
              <td height="26"><select name="deptname" class="style4" id="deptname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
				<?php $dq="SELECT id,code,name FROM tbl_department WHERE id='$edr[deptname]' and storedstatus IN('I','U') order by id desc";
				      $dr=$myDb->select($dq);
					  $drow=$myDb->get_row($dr,'MYSQL_ASSOC');
				?>
				<option selected="selected" value="<?php echo $drow['id']; ?>"><?php echo $drow['code']."(".$drow['name'].")"; ?></option>
				<?php $dq="SELECT id,code,name FROM tbl_department WHERE storedstatus IN('I','U') order by id desc";
				      $dr=$myDb->select($dq);
					  while($drow=$myDb->get_row($dr,'MYSQL_ASSOC')){
				?>
				<option value="<?php echo $drow['id']; ?>"><?php echo $drow['code']."(".$drow['name'].")"; ?></option>
				<?php } ?>	   
              </select></td>
              <td height="26" colspan="4"><div id="myDiv1">
                
              </div></td>
              </tr>

           
            <tr>
              <td height="26" align="right"><div align="left"><span class="style4">Section</span><span class="stars">*</span></div></td>
              <td height="26" class="style4">&nbsp;</td>
              <td height="26"><span class="style4">
                <select name="section" id="section" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                  <option selected="selected" value="<?php echo $edr['section']; ?>"><?php echo $edr['section']; ?></option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                  <option value="E">E</option>
                </select>
              </span></td>
              <td height="35" colspan="3" align="center" bgcolor="F7F7F7" class="style11" style="border-bottom:1px solid #CCCCCC;">CHILD OF </td>
              <td height="35" align="center" bgcolor="F7F7F7" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
            </tr>
            <tr>
              <td height="12" align="right"><div align="left"><span class="style4">Semester</span><span class="style4"><span class="stars">*</span></span></div></td>
              <td height="14" class="style4">:</td>
              <td height="12"><div id="scc"></div><select name="semester" class="style4" id="semester" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                <?php $dq="SELECT * FROM tbl_semester WHERE id='$edr[semester]' and storedstatus IN('I','U') order by id";
				      $dr=$myDb->select($dq);
					  $drow=$myDb->get_row($dr,'MYSQL_ASSOC');
				?>
                <option selected="selected" value="<?php echo $drow['id']; ?>"><?php echo $drow['name']; ?></option>
                <?php $dq="SELECT * FROM tbl_semester WHERE storedstatus IN('I','U') order by id";
				      $dr=$myDb->select($dq);
					  while($drow=$myDb->get_row($dr,'MYSQL_ASSOC')){
				?>
                <option value="<?php echo $drow['id']; ?>"><?php echo $drow['name']; ?></option>
                <?php } ?>
              </select></td>
              <td height="26" rowspan="3" align="right" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
              <td height="26" rowspan="3" class="style4" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
              <td width="11%" height="26" rowspan="3" valign="top" style="border-bottom:1px solid #CCCCCC;"><label class="style4">
                <?php if($edr['horde']!=""){ ?>
				<input name="horde" type="checkbox" id="horde" value="Y" onkeypress="return handleEnter(this, event)" checked="checked"/>
				<?php }else{ ?>
				<input name="horde" type="checkbox" id="horde" value="Y" onkeypress="return handleEnter(this, event)"/>
				<?php } ?>
                Horde              </label></td>
              <td width="27%" rowspan="3" valign="top" style="border-bottom:1px solid #CCCCCC;"><label class="style4">
			  <?php if($edr['ffighter']!=""){ ?>
                <input name="ffighter" type="checkbox" id="ffighter" value="Y" onkeypress="return handleEnter(this, event)" checked="checked" />
			  <?php }else{ ?>	
                <input name="ffighter" type="checkbox" id="ffighter" value="Y" onkeypress="return handleEnter(this, event)" />
			  <?php } ?>
               Freedom Fighter </label></td>
            </tr>
            <tr>
			 
             <td height="12" rowspan="2" align="right" valign="top"> <div class="csts"><div align="left"><span class="style4" style=" font-weight:bold;">Current Semester</span><span class="style4"><span class="stars">*</span></span></div></div></td>
              <td height="6" valign="top" class="style4">:</td>
              <td height="6"><div class="csts"><select name="stdcursemester" class="style4" id="stdcursemester" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                <?php $dq="SELECT * FROM tbl_semester WHERE id='$edr[stdcursemester]' and storedstatus IN('I','U') order by id";
				      $dr=$myDb->select($dq);
					  $drow=$myDb->get_row($dr,'MYSQL_ASSOC');
				?>
                <option selected="selected" value="<?php echo $drow['id']; ?>"><?php echo $drow['name']; ?></option>
                <?php $dq="SELECT * FROM tbl_semester WHERE storedstatus IN('I','U') order by id";
				      $dr=$myDb->select($dq);
					  while($drow=$myDb->get_row($dr,'MYSQL_ASSOC')){
				?>
                <option value="<?php echo $drow['id']; ?>"><?php echo $drow['name']; ?></option>
                <?php } ?>
              </select></div>			  </td>
            </tr>
            <tr>
              <td height="6" class="style4">&nbsp;</td>
              <td height="6"><div id="rmrk" style="display:none;"><label><span class="style4" style=" font-weight:bold;">Remarks</span></label><br />
			                 <textarea name="remarks" id="remarks"><?php echo $edr['remarks']; ?></textarea>
			  </div>	</td>
            </tr>
            <tr>
              <td height="35" align="right"><div align="left"><span class="style4">Hostel</span></div></td>
              <td height="35" class="style4">:</td>
              <td height="35" align="left"><select name="hostel" class="style4" id="hostel" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
				<?php $hq="SELECT id,code,name FROM tbl_hostel where code='$edr[hostel]' order by id desc";
				      $hr=$myDb->select($hq);
					  $hrow=$myDb->get_row($hr,'MYSQL_ASSOC');
				?>
				<option selected="selected" value="<?php echo $hrow['code']; ?>"><?php echo $hrow['name']; ?></option>
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
              <td height="35" colspan="2"><input name="fname" type="text" class="style4" id="fname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="40" value="<?php echo $edr['fname']; ?>"/></td>
            </tr>
            <tr>
              <td height="35" align="right"><div align="left"><span class="style4">Mother's Name</span><span class="style4"><span class="stars">*</span></span></div></td>
              <td height="35" class="style4">:</td>
              <td height="35"><input name="mname" type="text" class="style4" id="mname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="40" value="<?php echo $edr['mname']; ?>" /></td>
              <td height="35" align="right"><div align="left"><span class="style4">Guardian Name </span></div></td>
              <td height="35"><span class="style4">:</span></td>
              <td height="35" colspan="2"><input name="gname" type="text" class="style4" id="gname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF"  onkeypress="return handleEnter(this, event)" size="40" value="<?php echo $edr['gname']; ?>"/></td>
            </tr>
            <tr>
              <td height="40" align="right" bgcolor="F7F7F7" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
              <td height="40" bgcolor="F7F7F7" class="style4" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
              <td height="40" bgcolor="F7F7F7" style="border-bottom:1px solid #CCCCCC;"><div id="exx" style="display:none;"><label><span class="style4">Board Registration No:</span></label><br/><input name="boardregno" type="text" class="style4" id="boardregno" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="40" placeholder="Board Registration No" value="<?php echo $edr['boardregno']; ?>"/></div></td>
              <td height="40" align="right" bgcolor="F7F7F7" class="style4" style="border-bottom:1px solid #CCCCCC;"><div align="left"></div></td>
              <td height="40" bgcolor="F7F7F7" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
              <td height="40" colspan="2" bgcolor="F7F7F7" style="border-bottom:1px solid #CCCCCC;"><div id="exr" style="display:none;"><label><span class="style4">Board Roll No:</span></label><br/><input name="boardrollno" type="text" class="style4" id="boardrollno" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="40" placeholder="Board Roll No" value="<?php echo $edr['boardrollno']; ?>"/></div></td>
            </tr>
            
            <tr>
              <td height="26" align="right" class="style4"><div align="left">Nationality</div></td>
              <td height="26" class="style4">:</td>
              <td height="26"><input name="nationality" type="text" class="style4" id="nationality" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="30" value="<?php echo $edr['nationality']; ?>" /></td>
              <td height="26" align="right"><div align="left"><span class="style4">Religion</span><span class="style4"><span class="stars">*</span></span></div></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26" colspan="2"><span class="style4">
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
              <td height="26" align="right" class="style4"><div align="left">Present Address<span class="stars">*</span></div></td>
              <td height="26" class="style4">:</td>
              <td height="26"><textarea name="praddress" cols="40" class="style4" id="praddress" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"><?php echo $edr['praddress']; ?></textarea></td>
              <td height="26" align="right"><div align="left"><span class="style4">Permanent Address</span><span class="style4"><span class="stars">*</span></span></div></td>
              <td height="26"><span class="style4">:</span></td>
              <td height="26" colspan="2"><textarea name="peraddress" cols="40" class="style4" id="peraddress" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"><?php echo $edr['peraddress']; ?></textarea></td>
            </tr>
            <tr>
              <td height="26" align="right" valign="top" class="style4"><div align="left">Phone<span class="stars">*</span></div></td>
              <td height="26" valign="top" class="style4">:</td>
              <td height="26" valign="top"><input name="phone" type="text" class="style4" id="phone" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="30" value="<?php echo $edr['phone']; ?>" /></td>
              <td height="26" align="right"><div align="left"><span class="style4">Image</span><span class="style4"><span class="stars">*</span></span></div></td>
              <td height="26"><span class="style4" >:</span></td>
              <td height="26" colspan="2" valign="top">
    		<input name="img" type="file" class="style4" id="img" onkeypress="return handleEnter(this, event)"/></td>
            </tr>
            <tr>
              <td height="26">&nbsp;</td>
              <td height="26">&nbsp;</td>
              <td height="26">&nbsp;</td>
              <td height="26">&nbsp;</td>
              <td height="26">&nbsp;</td>
              <td height="26" colspan="2"><img src="uploads/<?php echo $edr['img']; ?>" width="70" height="70"/></td>
              </tr>
            <tr>
              <td height="35" bgcolor="#F7F7F7" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
              <td height="35" bgcolor="#F7F7F7" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
              <td height="35" colspan="5" bgcolor="#F7F7F7" style="border-bottom:1px solid #CCCCCC;"><div align="center">
                <input type="submit" value="Save &amp; Continue" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />                
              </div></td>
			  <input name="stdid" type="hidden" id="stdid" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" size="50" value="<?php echo $edr['stdid']; ?>"  />
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