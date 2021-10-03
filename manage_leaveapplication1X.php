<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_leaveapplication.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
   
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<link type="text/css" href="css/jquery-ui-1.8.5.custom.css" rel="Stylesheet" />

<style type="text/css">
<!--
@import url("main.css");
.style15 {
	font-size: 10px; font-weight:bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}

-->
</style>

<script type="text/javascript" src="jquery.js"></script>


<style>
body {
font-family:verdana;
font-size:15px;
}

a {color:#333; text-decoration:none}
a:hover {color:#ccc; text-decoration:none}

#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#000;
  display:none;
  
}
  
#boxes .window {
  position:absolute;
  left:0;
  top:0;
  width:auto;
  height:auto;
  display:none;
  z-index:9999;
  padding:20px;

}

#boxes #dialog {
  width:auto; 
  height:auto;
  padding:10px;
  background-color:#ffffff;

}

#boxes #dialog1 {
  width:375px; 
  height:203px;
}

#dialog1 .d-header {
  background:url(images/login-header.png) no-repeat 0 0 transparent; 
  width:375px; 
  height:150px;
}
#dialog1 .d-header input {
  position:relative;
  top:60px;
  left:100px;
  border:3px solid #cccccc;
  height:22px;
  width:200px;
  font-size:15px;
  padding:5px;
  margin-top:4px;
}

#dialog1 .d-blank {
  float:left;
  background:url(images/login-blank.png) no-repeat 0 0 transparent; 
  width:267px; 
  height:53px;
}

#dialog1 .d-login {
  float:left;
  width:108px; 
  height:53px;
}

#boxes #dialog2 {
  background:url(images/notice.png) no-repeat 0 0 transparent; 
  width:326px; 
  height:229px;
  padding:50px 0 20px 25px;
}
</style>
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

<script type="text/javascript" src="JQdtp/jquery.min.js"></script>
<script type="text/javascript" src="JQdtp/jquery-ui.min.js"></script>
<script type="text/javascript" src="JQdtp/jquery-ui-i18n.min.js"></script>
<link rel="stylesheet" type="text/css" href="JQdtp/jquery-ui.css">

	<script type="text/javascript">
		/*
		 * jQuery UI Datepicker: Internationalization and Localization
		 * http://salman-w.blogspot.com/2013/01/jquery-ui-datepicker-examples.html
		 */
		$(function() {
			$("#fdate").datepicker($.datepicker);

			$("#tdate").datepicker($.extend({}, $.datepicker, {
				showWeek: true
			}));
			//$("#datepicker-3").datepicker($.datepicker.regional["de"]).datepicker("option", {
			//	changeMonth: true,
			//	changeYear: true
			//});
		});
	</script>

<script type="text/javascript" src="jquery.js"></script>


	<link rel="stylesheet" href="js/nyroModal-1.3.0/styles/nyroModal.css" type="text/css" media="screen" />
	<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
	<script src="js/nyroModal-1.3.0/js/jquery.nyroModal-1.3.0.pack.js"></script>   
	<script type="text/javascript" src="js/jquery.simple.tree.js"></script>
	<script type="text/javascript">
	var simpleTreeCollection;	
	$(document).ready(function(){
			
			simpleTreeCollection = $('.simpleTree').simpleTree({
				
				autoclose: false,
				docToFolderConvert: false,
				
				afterClick:function(node){
					// nothing to do for now...
				},
				
				afterDblClick:function(node){
					categoryId = $('span:first',node).parent("li").attr("id");
					parentId = $('span:first',node).parent("li").parent("ul").parent("li").attr("id");

					$.nyroModalManual({
						url: 'update.php?category_id='+categoryId,
						width: 290, // default Width If null, will be calculate automatically
						height: 150, // default Height If null, will be calculate automatically
						minWidth: null, // Minimum width
						minHeight: null, // Minimum height
						endRemove: function() {window.location.reload()}
					});		
	
					return false;
		
				},
				afterMove:function(){	
					var serialStr = "";
					var order = "";
					$("ul.simpleTree li span").each(function(){			
						parentId = $(this).parent("li").parent("ul").parent("li").attr("id");
						if (parentId == undefined) parentId = "root";
						order = (($(this).parent("li").prevAll("li").size()+1))/2; 
						if ( parentId != "root") serialStr += ""+parentId+":"+$(this).parent("li").attr("id")+":"+order+"|";
					});
					$.ajax({
					   type: "POST",
					   url: "saveData.php",
					   data: "serialized="+serialStr,
					   success: function(msg){
					   	 $("#serializedList").html(msg);
					   }
					 });
			
					return false;
					
				},
				docToFolderConvert: false,
				afterAjax:function()
				{
					//alert('Loaded');
				},
				animate:true
			});	
			
			
			
			$(".add_categoryfm").click(function(){
				categoryId = $(this).attr("id");
                var empid=$(this).attr('alt');
       			//var count=$('#count').val();
				//var session=$('#sessionnew').val();
				//var deptid=$('#deptid').val();
				//var courseid=$('#courseid').val();
				//var eyear=$('#eyear').val();
				//var semesterid=$('#semesterid').val();

				$.nyroModalManual({
					url: 'leaveapplication_finalop.php?id='+categoryId +'&empid='+empid,// +'&examname='+examname +'&deptid='+deptid +'&courseid='+courseid +'&eyear='+eyear +'&semesterid='+semesterid,
					width: 650, // default Width If null, will be calculate automatically
					height: 500, // default Height If null, will be calculate automatically
					minWidth: null, // Minimum width
					minHeight: null, // Minimum height
					//endRemove: function() {window.location.reload()}

				});
			});
			
			
			
		});
		</script>




<style type="text/css">
<!--
.style17 {color: #000033}
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
          
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        <td width="79%" valign="top">
<p align="center" id="msgerr" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></font></p>
<div id="top-search-div"> 
           <div id="content">
		   <label>Manage Leave Application </label>
		   <div class="input">
		   <form method="post" autocomplete="off" action="manage_leaveapplication1.php">
		     <table width="397" border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td>Search Form</td>
                 <td><input type="text" id="fdate" name="fdate" style="width:80px" value="<?php echo date('Y-m-d');?>" /></td>
                 <td><input type="text" id="tdate" name="tdate" style="width:80px"value="<?php echo date('Y-m-d');?>"/></td>
                 <td><input type="submit" name="subs" id="subs" value="Search" /></td>
               </tr>
             </table>
		     <label></label>
			 <label>			 </label>
			 <label></label>
			 <label></label>
		   </form>
		   </div>
		</div>
		</div>	<br />
          
		  
		  <table width="98%" border="1" cellspacing="0" cellpadding="0" id="stdtbl">
            <tr bgcolor="#DFF4FF">
              <td width="34" height="25" class="style15 ">ID</td>
              <td width="144" height="25" class="style15">Name</td>
              <td width="85" height="25" class="style15 ">Designation</td>
              <td width="97" height="25" class="style15 ">ApplyDate</td>
              <td width="62" height="25" class="style15 ">ApplyFor</td>
              <td width="91" class="style15 ">FromDate</td>
              <td width="81" class="style15 ">ToDate</td>
              <td width="119" class="style15 ">Reason</td>
              <td width="67" class="style15 ">Status</td>
              <td height="25" align="center" class="style15 ">Action</td>
            </tr>
			<?php 
			      if(isset($_POST['fdate'])){
				  $std="Select id ,empid ,name as Name,designation as Designation,applyfor as ApplyFor,applydate as ApplyDate,frmdate as FromDate,todate as ToDate,reason as Reason,status as Status from tbl_leaveapplication Where applydate between '$_POST[fdate]' and '$_POST[tdate]' and storedstatus<>'D' order by id desc ";	
			      $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){ //echo $stdr['Name']; exit;
				  if($count%2==0){
				  $bgcolor="#FFFFFF";
				  ?>
                        <tr bgcolor="<?php echo $bgcolor; ?>">
              <td height="25" class="style4"><?php echo $stdr['id']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['Name']; ?></td>
			  <td height="25" class="style4"><?php echo $stdr['Designation']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ApplyDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ApplyFor']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['FromDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ToDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['Reason']; ?></td>
              <td height="25" class="style4"><?php if ($stdr['Status']=="Accepted"){ ?> <span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#009966; text-align:center; "><?php echo $stdr['Status']; ?></span><?php }else if ($stdr['Status']=="Rejected"){?><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#FF0000; text-align:center;"><?php echo $stdr['Status']; ?></span><?php }else{?><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#000000; text-align:center;"><?php echo $stdr['Status']; ?></span><?php }?></td>
              <td width="54" height="25" align="center" class="style4"><?php if ($stdr['Status']=="Pending"){ ?><a alt="<?php echo $stdr['empid']; ?>" class="add_categoryfm" id="<?php echo $stdr['id'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#000000; " >EDIT</span></a><?php }else{?><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#000000; " >EDIT</span><?php }?></td>
              </tr>
      <tr bgcolor="" id="tbl">
       <td colspan="11"><div id="myDiv<?php echo $count; ?>" style="width:800px;" align="center"></div></td>
      </tr>			<?php }else{ $bgcolor="#F7FCFF"; ?>
            <tr bgcolor="<?php echo $bgcolor; ?>">
              <td height="25" class="style4"><?php echo $stdr['id']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['Name']; ?></td>
			  <td height="25" class="style4"><?php echo $stdr['Designation']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ApplyDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ApplyFor']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['FromDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ToDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['Reason']; ?></td>
              <td height="25" class="style4"><?php if ($stdr['Status']=="Accepted"){ ?> <span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#009966; text-align:center; "><?php echo $stdr['Status']; ?></span><?php }else if ($stdr['Status']=="Rejected"){?><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#FF0000; text-align:center;"><?php echo $stdr['Status']; ?></span><?php }else{?><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#000000; text-align:center;"><?php echo $stdr['Status']; ?></span><?php }?></td>
              <td width="54" height="25" align="center" class="style4"><?php if ($stdr['Status']=="Pending"){ ?><a alt="<?php echo $stdr['empid']; ?>" class="add_categoryfm" id="<?php echo $stdr['id'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#000000; " >EDIT</span></a><?php }else{?><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#000000; " >EDIT</span><?php }?></td>
              </tr>
      <tr bgcolor="" id="tbl">
       <td colspan="11"><div id="myDiv<?php echo $count; ?>" style="width:800px;" align="center"></div></td>

      </tr>			<?php }
			  $count++;
			  ?>
			<?php }
			      }else{ 
			
				  $std="Select id ,empid ,name as Name,designation as Designation,applyfor as ApplyFor,applydate as ApplyDate,frmdate as FromDate,todate as ToDate,reason as Reason,status as Status from tbl_leaveapplication Where storedstatus<>'D' order by id desc";	
			      $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
				  if($count%2==0){
				  $bgcolor="#FFFFFF";
				  ?>
            <tr bgcolor="<?php echo $bgcolor; ?>">
              <td height="25" class="style4"><?php echo $stdr['id']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['Name']; ?></td>
			  <td height="25" class="style4"><?php echo $stdr['Designation']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ApplyDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ApplyFor']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['FromDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ToDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['Reason']; ?></td>
              <td height="25" class="style4"><?php if ($stdr['Status']=="Accepted"){ ?> <span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#009966; text-align:center; "><?php echo $stdr['Status']; ?></span><?php }else if ($stdr['Status']=="Rejected"){?><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#FF0000; text-align:center;"><?php echo $stdr['Status']; ?></span><?php }else{?><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#000000; text-align:center;"><?php echo $stdr['Status']; ?></span><?php }?></td>
              <td width="54" height="25" align="center" class="style4"><?php if ($stdr['Status']=="Pending"){ ?><a alt="<?php echo $stdr['empid']; ?>" class="add_categoryfm" id="<?php echo $stdr['id'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#000000; " >EDIT</span></a><?php }else{?><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#000000; " >EDIT</span><?php }?></td>
              </tr>
      <tr bgcolor="" id="tbl">
       <td colspan="11"><div id="myDiv<?php echo $count; ?>" style="width:800px;" align="center"></div></td>
      </tr>			<?php }else{ $bgcolor="#F7FCFF"; ?>
            <tr bgcolor="<?php echo $bgcolor; ?>">
              <td height="25" class="style4"><?php echo $stdr['id']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['Name']; ?></td>
			  <td height="25" class="style4"><?php echo $stdr['Designation']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ApplyDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ApplyFor']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['FromDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['ToDate']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['Reason']; ?></td>
              <td height="25" class="style4"><?php if ($stdr['Status']=="Accepted"){ ?> <span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#009966; text-align:center; "><?php echo $stdr['Status']; ?></span><?php }else if ($stdr['Status']=="Rejected"){?><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#FF0000; text-align:center;"><?php echo $stdr['Status']; ?></span><?php }else{?><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#000000; text-align:center;"><?php echo $stdr['Status']; ?></span><?php }?></td>
              <td width="54" height="25" align="center" class="style4"><?php if ($stdr['Status']=="Pending"){ ?><a alt="<?php echo $stdr['empid']; ?>" class="add_categoryfm" id="<?php echo $stdr['id'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#000000; " >EDIT</span></a><?php }else{?><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#000000; " >EDIT</span><?php }?></td>
              </tr>
      <tr bgcolor="" id="tbl">
       <td colspan="11"><div id="myDiv<?php echo $count; ?>" style="width:800px;" align="center"></div></td>
      </tr>			<?php }
			  $count++;
			  ?>
			<?php }}
			?>
          </table>    
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
<div id="boxes">

       <div id="dialog" class="window">
        
       <a href="#" class="close" style="margin-left:650px;">X</a>

       <div id="table_wrapper"></div>


     </div>
</div>
  <div id="mask"></div>

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
