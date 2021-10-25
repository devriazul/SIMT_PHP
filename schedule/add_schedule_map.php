<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_schedule_map.php' AND userid='$_SESSION[userid]'";
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
@import url("main.css");
.style12 {font-size: 10px}
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style16 {font-size: 12px}
#MyResult table{
 width:800px;
}
#MyResult table td{
  padding:10px;
}
.gridTblValue{
  font-size:12px;

}
</style>
<script src="jquery-1.6.2.min.js" type="text/javascript"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#guideteacher").autocomplete("search_gudie_faculty.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
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
	
	
	$("#teacher").autocomplete("search_gudie_faculty.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#coursecode").autocomplete("search_coursecode.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	$("#routinefor").autocomplete("search_routinefor.php", {
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
$(document).ready(function(){
 $('#B1').click(function(){   
   var arr=$('#MyForm').serializeArray();
   if($('#yrpart').val()==""){
     alert("Part of the year can not be left empty");
	 $('#yrpart').focus();
	 return false;
   }
   if($('#mapyear').val()==""){
     alert("Year can not be left empty");
	 $('#mapyear').focus();
	 return false;
   }
   if($('#deptid').val()==""){
     alert("Department can not be left empty");
	 $('#deptid').focus();
	 return false;
   }
   if($('#ownid').val()==""){
     alert("Alias can not be left empty");
	 $('#ownid').focus();
	 return false;
   }
   if($('#mdeptid').val()==""){
     alert("Mapping department can not be left empty");
	 $('#mdeptid').focus();
	 return false;
   }
   if($('#semesterid').val()==""){
     alert("Semester name can not be left empty");
	 $('#semesterid').focus();
	 return false;
   }
   if($('#ownid').val()==""){
     alert("Alias can not be left empty");
	 $('#ownid').focus();
	 return false;
   }
   if($('#coursecode').val()==""){
     alert("coursecode can not be left empty");
	 $('#coursecode').focus();
	 return false;
   }
   if($('#theory').val()==""){
     alert("theory can not be left empty");
	 $('#theory').focus();
	 return false;
   }
   if($('#paractical').val()==""){
     alert("paractical can not be left empty");
	 $('#paractical').focus();
	 return false;
   }
   
   if($('#guideteacher').val()==""){
     alert("Guideteacher can not be left empty");
	 $('#guideteacher').focus();
	 return false;
   }
   
   if($('#dyid').val()==""){
     alert("Schedule day can not be left empty");
	 $('#dyid').focus();
	 return false;
   }
   if($('#frmtime').val()==""){
     alert("From time can not be left empty");
	 $('#frmtime').focus();
	 return false;
   }
   
   if($('#totime').val()==""){
     alert("To time can not be left empty");
	 $('#totime').focus();
	 return false;
   }
   
   if($('#vname').val()==""){
     alert("Venue name can not be left empty");
	 $('#vname').focus();
	 return false;
   }
   if($('#facultyid').val()==""){
     alert("Faculty can not be left empty");
	 $('#facultyid').focus();
	 return false;
   }
   if($('#roomno').val()==""){
     alert("Room can not be left empty");
	 $('#roomno').focus();
	 return false;
   }
   if($('#orderid').val()==""){
     alert("Orderid can not be left empty");
	 $('#orderid').focus();
	 return false;
   }
   $.post("ins_schedule_map.php",arr,function(r){
     $('#shw').html(r);
	 $('#container').load("schedule_map_pagination.php?page=1");
	 //$('#MyForm').submit();

   });
	 //$('#MyForm')[0].reset();
	 //$('#deptid').val('');
	 //$('#ownid').val('');
	 $('#coursecode').val('');
	 $('#frmtime').val('');
	 $('#totime').val('');
	 $('#vname').val('');
	 $('#roomno').val('');
	 $('#facultyid').val('');
	 $('#shortname').val('');
	 $('#orderid').val('');
	 $('#theory').val('');
	 $('#paractical').val('');
	 $('#coursecode').focus();
 });
 
 
 $('#totime').blur(function(){
   var difin=$('#totime').val()-$('#frmtime').val();
   if(parseInt(difin)>1){
     alert("From period and To period setting error");
	 $(this).focus();
	 return false;
   }
   
 });
 
 
 $('#guideteacher').blur(function(){
   var arr=$('#MyForm').serializeArray();
   $.post("search_phone.php",arr,function(r){
     $('#contactno').val($.trim(r));
   });
 });
 
 $('#deptid').change(function(){
   var arr=$('#MyForm').serializeArray();
   $.post("search_alias.php",arr,function(r){
    $('#als').html('<img src="images/load.gif"/>').fadeIn();
    $('#als').fadeIn("slow").html(r);
   });
 
 });
 $('#vname').change(function(){
   var arr=$('#MyForm').serializeArray();
   $.post("search_roomno.php",arr,function(r){
    $('#roomshw').html('<img src="images/load.gif"/>').fadeIn();
    $('#roomshw').fadeIn("slow").html(r);
   });
 
 });
 
 $('#facultyid').blur(function(){
   var arr=$('#MyForm').serializeArray();
   $.post("search_shortname.php",arr,function(r){
    $('#shortname').html('<img src="images/load.gif"/>').fadeIn();
     $('#shortname').val($.trim(r));
   });
   
   $.post("check_course_code.php",arr,function(r){
	 $('#shw').html($.trim(r));
   });
 });
});

</script>
<script language="javascript">
$(document).ready(function(){
  $('a[name="dlt"]').unbind().click(function(e){
    e.preventDefault();
	var id=$(this).attr('alt');
	var trigger = $(this);
	var rows=$('.dmpquery tr').length;
	var checkstr =  confirm('are you sure you want to delete this?');
	if(checkstr == true){	
		$.get("delperiod.php?id="+id,function(r){
		
			if(rows>2){
		
				trigger.closest('tr').fadeOut(300, function() {
							$(this).remove();			
				});	
			}
			$('#shw').html(r);
			//$('.data').load("macclevel_pagination?page=1");

		});
	}else{
	  return false;
	}	
  
  });
  
});

</script>
<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>
<script language="javascript">
 $(document).ready(function(){
	 $('#yrpart').change(function(){
	   var yrpart=$('#yrpart').val();
	   $.get("populateFrmTotime.php?yrpart="+yrpart,function(r){
		 $('.frm').html(r);
	   });
	 });
 });
</script>
<script type="text/javascript">
            $(document).ready(function(){				   
                function loading_show(){
                    $('#loading').html("<img src='images/load.gif'/>").fadeIn('fast');
                }
                function loading_hide(){
                    $('#loading').fadeOut('fast');
                }                
                function loadData(page){
                    loading_show();                    
                    $.ajax
                    ({
                        type: "GET",
                        url: "schedule_map_pagination.php",
                        data: "page="+page,
					  //  data:$("form").serialize(),
                        success: function(msg)
                        {
                            $("#container").ajaxComplete(function(event, request, settings)
                            {
                                loading_hide();
                                $("#container").html(msg);
                            });
                        }
                    });
                }
                loadData(1);  // For first time page load default results
                $('#container .pagination li.active').live('click',function(){
                    var page = $(this).attr('p');
					//var catp=$("#catp").val();
                    loadData(page);
                    
                }); 
				
				$('#submit-btn').click(function(){
				  if($('#yrpart').val()==""){
				    alert("Please select schedule type");
					$('#yrpart').focus();
					return false;
				  }
				  var yrpart = $('#yrpart').val();
				  var arr=$('#frmsrch').serializeArray();
				  $.post("schedule_map_pagination.php?page=1&yrpart="+yrpart,arr,function(r){
				    $("#container").html(r);
				  });
				});
				$('#routinefor').keyup(function(){
				  var arr=$('#frmsrch').serializeArray();
				  $.post("schedule_map_pagination.php?page=1",arr,function(r){
				    $("#container").html(r);
				  });
				});
				          
            });
        </script>

        <style type="text/css">
            #loading{
                width: 647px;
                position: absolute;
                top: 350px;
                left: 500px;
				margin-top:200px;
            }
            #container .pagination ul li.inactive,
            #container .pagination ul li.inactive:hover{
                background-color:#ededed;
                color:#bababa;
                border:1px solid #bababa;
                cursor: default;
            }
            .data{
			  margin-top:-15px;
			}  
			 
			#container .data ul li{
                list-style: none;
                font-family: verdana;
                margin: 1px 0 1px 0;
                color: #000;
                font-size: 13px;
            }

            #container .pagination{
                width: 800px;
                height: 25px;
            }
            #container .pagination ul li{
                list-style: none;
                float: left;
                border: 1px solid #006699;
                padding: 2px 6px 2px 6px;
                margin: 5px 3px 0 3px;
                font-family: arial;
                font-size: 14px;
                color: #006699;
                font-weight: bold;
                background-color: #f2f2f2;
            }
            #container .pagination ul li:hover{
                color: #fff;
                background-color: #006699;
                cursor: pointer;
            }
			.go_button
			{
			background-color:#f2f2f2;border:1px solid #006699;color:#cc0000;padding:2px 6px 2px 6px;cursor:pointer;position:absolute;margin-top:-1px;
			}
			.total
			{
			float:right;font-family:arial;color:#999;
			}

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
        <td height="28" colspan="2" bgcolor="#0C6ED1"><div align="center" class="style1"><?php include("company.php"); ?></div></td>
        </tr>
      <tr>
        <td background="images/leftbg.jpg"><img src="images/leftbg.jpg" width="252" height="3" /></td>
        <td><img src="images/spaer.gif" width="1" height="1" /></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php"); ?>
          ���������<br />
          
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        <td width="79%" valign="top">
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></font></p>
<form name="MyForm" id="MyForm" autocomplete="off" action="#" method="post" >
          <div align="center"><br />
            <table width="800px" border="0" align="center" cellpadding="0" cellspacing="3" id="stdtbl">
              <tr>
                <td height="20" colspan="2" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">ADD SCHEDULE MAPPING</td>
                <td height="20" colspan="2" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">
				  <select name="yrpart" id="yrpart">
				   <option value="">Select part of year</option>
				   <option value="half1">Part 1</option>
				   <option value="half2">Part 2</option>
				   <option value="half3">Part 3</option>
				  
				  </select>
				</td>
                <td width="21%" height="20" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><span class="stars">*</span>(Mandatory Field) </td>
              </tr>
              <tr>
                <td height="20" class="style2">Year :<span class="stars">*</span></td>
                <td height="20">
                  <input name="mapyear" type="text" id="mapyear" placeholder="Year name" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF; width:50px; text-align:center;" onkeypress="return handleEnter(this, event)" value="<?php echo date("Y"); ?>"/>
                    <div style="width:130px; float:right; "><span class="style2" style="text-align:right; ">Department(Owner) :<span class="stars">*</span></span></div></td>
                <td colspan="2" align="left"><span class="style2"></span>
                  <select name="deptid" id="deptid" onkeypress="return handleEnter(this, event)">
                    <option value="">Select department</option>
                    <?php $dptq=$myDb->select("select id,name from tbl_department order by name asc");
				 while($dptqf=$myDb->get_row($dptq,'MYSQL_ASSOC')){
				 ?>
                    <option value="<?php echo $dptqf['id']; ?>"><?php echo $dptqf['name']; ?></option>
                    <?php } ?>
                </select></td>
                <td><div style="width:70px; " id="als"></div></td>
              </tr>
              <tr>
                <td height="20" class="style2"><div style="width:130px; float:right; "><span class="style2" style="text-align:right; ">Department(Map) :<span class="stars">*</span></span></div></td>
                <td height="20">
				<select name="mdeptid" id="mdeptid" onkeypress="return handleEnter(this, event)">
                    <option value="">Select department</option>
                    <?php $dptq=$myDb->select("select id,name from tbl_department order by name asc");
				 while($dptqf=$myDb->get_row($dptq,'MYSQL_ASSOC')){
				 ?>
                    <option value="<?php echo $dptqf['id']; ?>"><?php echo $dptqf['name']; ?></option>
                    <?php } ?>
                </select>			</td>
                <td colspan="2" align="right"><span class="style2">Semester :<span class="stars">*</span></span>
                  <select name="semesterid" class="style4" id="semesterid" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                  <option value="">Select</option>
                  <?php $dq="SELECT * FROM tbl_semester WHERE storedstatus IN('I','U') order by id";
				      $dr=$myDb->select($dq);
					  while($drow=$myDb->get_row($dr,'MYSQL_ASSOC')){
				?>
                  <option value="<?php echo $drow['id']; ?>"><?php echo $drow['name']; ?></option>
                  <?php } ?>
                </select>				  </td>
                <td align="left">
				  
				
				</td></tr>
              <tr>
                <td height="20" class="style2">Guide Teacher :<span class="stars">*</span> </td>
                <td height="20" colspan="4"><input name="guideteacher" type="text" id="guideteacher" placeholder="Guide Teacher Name" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" />
                  <input name="contactno" type="text" id="contactno" placeholder="Phone number" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF; width:100px;" onkeypress="return handleEnter(this, event)" size="29" /></td>
              </tr>
              <tr>
                <td height="20" class="style2">Course :<span class="stars">*</span></td>
                <td height="20" colspan="4"><input name="coursecode" type="text" id="coursecode" placeholder="Course code & Name" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF; width:320px;" onkeypress="return handleEnter(this, event)" size="29" />
                  <span class="style2">Theeory:<input name="theory" type="text" id="theory" placeholder="theory" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF; width:30px; text-align:center;" onkeypress="return handleEnter(this, event)" size="29" /></span>
                  <span class="style2">Practical:<input name="practical" type="text" id="paractical" placeholder="paractical" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF; width:30px; text-align:center;" onkeypress="return handleEnter(this, event)" size="29" /></span>
				  </td>
			  </tr>
              <tr>
                <td height="20" class="style2">Day :<span class="stars">*</span></td>
                <td height="20"><select style="width:130px;" name="dyid" id="dyid" onkeypress="return handleEnter(this, event)">
                    <option value="">Schedule day</option>
                    <?php $dyq=$myDb->select("select id,dyname from tbl_schedule_day order by orderid");
				while($dyqf=$myDb->get_row($dyq,'MYSQL_ASSOC')){ ?>
                    <option value="<?php echo $dyqf['id']; ?>"><?php echo $dyqf['dyname']; ?></option>
                    <?php } ?>
                </select></td>
                <td colspan="3"><div class="frm">  <span class="style2">From :<span class="stars">*</span></span>
				                
				<select style="width:130px;" name="frmtime" id="frmtime" onkeypress="return handleEnter(this, event)">
                      <option value="">From Time</option>
                      <?php $fq=$myDb->select("select id,intervalName from tbl_time_interval order by orderid");
				while($fqf=$myDb->get_row($fq,'MYSQL_ASSOC')){ ?>
                      <option value="<?php echo $fqf['id']; ?>"><?php echo $fqf['intervalName']; ?></option>
                      <?php } ?>
                      </select>				<span class="style2">To :<span class="stars">*
                        <select style="width:130px;" name="totime" id="totime" onkeypress="return handleEnter(this, event)">
                          <option value="">To Time</option>
                          <?php $tq=$myDb->select("select id,intervalName from tbl_time_interval order by orderid");
				while($tqf=$myDb->get_row($tq,'MYSQL_ASSOC')){ ?>
                          <option value="<?php echo $tqf['id']; ?>"><?php echo $tqf['intervalName']; ?></option>
                          <?php } ?>
                        </select>
				
                </span></span></div></td>
                </tr>
              <tr>
                <td height="20" class="style2">Venue :<span class="stars">*</span></td>
                <td height="20"><span class="style2"><span class="stars">
                  <select style="width:150px;" name="vname" id="vname" onkeypress="return handleEnter(this, event)">
                    <option value="">Venue</option>
                    <?php $vnq=$myDb->select("select distinct venuname from tbl_venue order by orderid");
				while($vnqf=$myDb->get_row($vnq,'MYSQL_ASSOC')){ ?>
                    <option value="<?php echo $vnqf['venuname']; ?>"><?php echo $vnqf['venuname']; ?></option>
                    <?php } ?>
                  </select>
                </span></span></td>
                <td colspan="3"><div id="roomshw" style="width:170px" class="style2"></div></td>
              </tr>
              <tr>
                <td width="17%" height="20" class="style2">Faculty :<span class="stars">*</span></td>
                <td width="28%" height="20"><input name="facultyid" type="text" id="facultyid" placeholder="Faculty Name" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" size="29" /></td>
                <td width="15%"><input name="shortname" type="text" id="shortname" placeholder="Short Name" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF; width:100px;" onkeypress="return handleEnter(this, event)" />
                </td>
                <td colspan="2"><span class="style2"><span class="stars">
                  <input type="button" value="Submit" name="B1" id="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />
                  <input type="reset" name="Submit2" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/>
</span></span></td>
                </tr>
              <tr>
                <td><span class="style2"></span></td>
                <td colspan="4">&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td colspan="4">&nbsp;                      </td>
              </tr>
            </table>
          </div>
</form>
          <br />
		  
		     <div id="shw" style="width:500px; margin:0 auto;" align="center"></div>
			 <br/>
		<div id="top-search-div"> 
		   <form method="post" autocomplete="off" action="#" id="frmsrch">
		     <label>Search Form</label>
			 <label><input type="text" id="mpyear" name="mpyear" placeholder="Mapping Year" class="small-text" value="<?php echo date("Y"); ?>" /></label>
			 <label><input type="text" id="routinefor" name="routinefor" placeholder="Enter schedule for" /></label>
			 <label><input type="text" id="teacher" name="teacher" placeholder="Enter teacher name" /></label>
			 <label><input type="button" name="subs" id="submit-btn" value="Search" /></label>
		   </form>
		</div>			 <br/>
          		<div id="MyResult" align="center">
				<div align="center">
						
					  <div id="loading"></div>
						<div id="container">
						<div class="pagination"></div>
							<div class="data"></div>
					</div>

				
				</div>          
          <p align="center">&nbsp;</p>
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