<?php session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  //$id=mysql_real_escape_string($_GET['id']);
  
  
 /* $chka="SELECT*FROM  tbl_accdtl WHERE flname='managefacultyinfo.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  */
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
	font-size: 10px; color:#666666;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style16 {font-size: 12px}

-->
</style>
<script type="text/javascript" src="jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />


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
	function checkstd(){
	 if(document.getElementById("deptid").value=="Select Department"){
         alert('Please Select Department.');
	     document.getElementById("deptid").focus();
	     return false;
     }
     if(document.getElementById("courseid").value=="Select Subject"){
         alert('Please Select Course.');
	     document.getElementById("courseid").focus();
	     return false;
     }
     if(document.getElementById("session").value=="Select Session"){
         alert('Please Select Session.');
	     document.getElementById("session").focus();
	     return false;
     }
    
     if(document.getElementById("semester").value=="Select Semester"){
         alert('Please Select Semester.');
	     document.getElementById("semester").focus();
	     return false;
     }
    
	
}
   
</script>





<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>

<script language="javascript" src="show_course.js"></script>

		<link rel="stylesheet" media="screen" type="text/css" href="style.css" />
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
			
			$(".add_category").click(function(){
				categoryId = $(this).attr("id");
                var examid=$(this).attr('alt');
       			var count=$('#count').val();
				var session=$('#sessionnew').val();
				var deptid=$('#deptid').val();
				var courseid=$('#courseid').val();

				$.nyroModalManual({
					url: 'addstudentsmarks.php?id='+categoryId +'&session='+session +'&examid='+examid +'&deptid='+deptid +'&courseid='+courseid,
					width: 1050, // default Width If null, will be calculate automatically
					height: 690, // default Height If null, will be calculate automatically
					minWidth: null, // Minimum width
					minHeight: null, // Minimum height
					endRemove: function() {/*window.location.reload()*/}
				});
			});
			
			/*$(".add_categoryfm").click(function(){
				categoryId = $(this).attr("id");
                var examid=$(this).attr('alt');
       			var count=$('#count').val();
				var session=$('#sessionnew').val();
				$.nyroModalManual({
					url: 'addstudentsmarksfinal.php?id='+categoryId +'&session='+session +'&examid='+examid,
					width: 1050, // default Width If null, will be calculate automatically
					height: 690, // default Height If null, will be calculate automatically
					minWidth: null, // Minimum width
					minHeight: null, // Minimum height
					endRemove: function() {window.location.reload()}
				});
			});*/
			
			$(".delete_category").click(function(){
				parentId = $(this).parent("li").attr("id");
				category_name = $(this).siblings("span").text();
				$.nyroModalManual({
					url: 'delete.php?category_id='+parentId+'&category_name='+category_name,
					endRemove: function() {window.location.reload()},
					width: 450, // default Width If null, will be calculate automatically
					height: 150, // default Height If null, will be calculate automatically
					minWidth: null, // Minimum width
					minHeight: null, // Minimum height
					resizeable: false, // Indicate if the content is resizable. Will be set to false for swf
					autoSizable: false, // Indicate if the content is auto sizable. If not, the min size will be used
					padding: 0 // padding for the max modal size	
				});
			});			
			
		});
		</script>

		

<style type="text/css">
<!--
.style17 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #000000; }
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
          ���������<br />
          
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        <td width="79%" valign="top">
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg'];  }?></font></p>
		<form name="MyForm" id="MyForm"  autocomplete="off" action="" method="post" onsubmit="Javascript:return checkstd();">
          <div align="center">            </div>
		
           <table width="95%" border="0" align="center" cellpadding="0" cellspacing="2" id="stdtbl">
             <tr bgcolor="#DFF4FF">
               <td height="32" colspan="4" class="style2"><table width="100%" height="65"  border="0" cellpadding="0" cellspacing="3">
                 <tr>
                   <td width="13%">Department :</td>
                   <td width="27%"><select name="deptid" id="deptid" onchange="show(this.value);" onkeypress="return handleEnter(this, event)">
                     <option>Select Department</option>
                     <?php  //$y=date("Y");
					$vsd="SELECT distinct d.id as did, d.name AS DepartmentName FROM tbl_assignfaculty a INNER JOIN tbl_faculty f ON a.facultyid = f.id INNER JOIN tbl_department d ON a.deptid = d.id INNER JOIN tbl_courses c ON a.courseid = c.id INNER JOIN tbl_semester s ON a.semesterid = s.id WHERE f.storedstatus<>'D' and f.facultyid='$_SESSION[userid]' ";
  					$rd=$myDb->select($vsd);
				   while($hrow=$myDb->get_row($rd,'MYSQL_ASSOC')){
					
				   ?>
                     <option value="<?php echo $hrow['did']; ?>"><?php echo $hrow['DepartmentName']; ?></option>
                     <?php } ?>
                   </select></td>
                   <td width="1%">&nbsp;</td>
				<td height="34" colspan="2" class="style2"><div id="sub"></div></td>
                   </tr>
                 <tr>
                   <td>Session :</td>
                   <td><select name="session" class="style2" id="session" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" onchange="showSelected();">
                     
                    <option>Select Session</option>
                     <?php 
					$vssn="SELECT distinct  a.session AS SESSION  FROM tbl_assignfaculty a INNER JOIN tbl_faculty f ON a.facultyid = f.id INNER JOIN tbl_department d ON a.deptid = d.id INNER JOIN tbl_courses c ON a.courseid = c.id INNER JOIN tbl_semester s ON a.semesterid = s.id WHERE f.storedstatus<>'D' and f.facultyid='$_SESSION[userid]'";
  					$rss=$myDb->select($vssn);
				   while($srow=$myDb->get_row($rss,'MYSQL_ASSOC')){
					
				   ?>
                     <option value="<?php echo $srow['SESSION']; ?>"><?php echo "20".substr_replace($srow['SESSION'],'-20',-2,-2); ?></option>
                     <?php } ?>
                   
                   </select></td>
                   <td>&nbsp;</td>
                   <td width="32%"><div align="right">Semester :</div></td>
                   <td width="27%"><select name="semester" id="semester" style="font-family: Verdana; font-size: 8pt;padding:3px; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                     <option value="-1" selected="selected">Select Semester</option>
                     <?php 
					$vsse="SELECT distinct s.id as sid, s.name AS SemesterName FROM tbl_assignfaculty a INNER JOIN tbl_faculty f ON a.facultyid = f.id INNER JOIN tbl_department d ON a.deptid = d.id INNER JOIN tbl_courses c ON a.courseid = c.id INNER JOIN tbl_semester s ON a.semesterid = s.id WHERE f.storedstatus<>'D' and f.facultyid='$_SESSION[userid]'";
  					$rse=$myDb->select($vsse);
				  while($stdr=$myDb->get_row($rse,'MYSQL_ASSOC')){
				  ?>
                     <option value="<?php echo $stdr['sid']; ?>"><?php echo $stdr['SemesterName']; ?></option>
                     <?php } ?>
                   </select></td>
                   </tr>
               </table></td>
             </tr>
             <tr>
               <td width="23%" height="20" class="style2">&nbsp;</td>
               <td width="31%" height="20">&nbsp;</td>
               <td width="18%">&nbsp;</td>
               <td width="28%">&nbsp;</td>
             </tr>
             <tr>
               <td height="20" colspan="4" class="style2">
                 <label></label>
                 <label>                 </label>
                 <label>
                 <input type="submit" name="subs" id="stb" value="Search" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />
                 </label>
                 </td>
               </tr>
           </table>      
           </form>
          
           <table width="90%" border="0" align="center" cellpadding="0" cellspacing="2" id="stdtbl">
             <tr>
               <td height="20" colspan="4" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">Lists of Examinition </td>
             </tr>
             <tr>
               <td height="20" colspan="4" class="style2"><table width="900" border="0" cellspacing="0" cellpadding="0" id="stdtbl">
                 <tr bgcolor="#DFF4FF">
                   <td height="25" class="style15">ID</td>
                   <td height="25" class="style15">Examinition Name </td>
                   <td class="style15"><div align="center">Marks(%)</div></td>
                   <td height="25" class="style15"><div align="center">Last Date of Taken Exam</div></td>
                   <td height="25" colspan="2" align="center" class="style15 style18">Action</td>
                 </tr>
                 <?php
			      if(isset($_POST['deptid']) && isset($_POST['session']) && isset($_POST['semester'])){
				  $std="SELECT * from tbl_examinitionsettings WHERE deptid ='".$_POST['deptid']."' and courseid='".$_POST['courseid']."' and session='".$_POST['session']."' and semesterid='".$_POST['semester']."' and storedstatus<>'D' order by id asc ";
			      $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
				  if($count%2==0){
				  $bgcolor="#FFFFFF";
				  ?>
                 <tr bgcolor="<?php echo $bgcolor; ?>"> 
                   <td height="25" class="style4"><?php echo $stdr['id']; ?><input type="hidden" value="<?php echo $stdr['session']; ?>" name="session" id="sessionnew" /></td>
                   <td height="25" class="style4"><?php echo $stdr['examname']; ?></td>
				   <td height="25" class="style4" align="center"><?php echo $stdr['exammarksper']; ?></td>
                   <td height="25" class="style4" align="center"><?php echo $stdr['lastdate']; ?></td>
                   <?php if($stdr['examstatus']==0){?>
				   <td height="25" align="center"><a alt="<?php echo $stdr['id']; ?>" class="add_category" id="<?php echo $stdr['deptid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " >Click to Enter Marks</span></a></td>
                   <?php } else {?>
					<td height="25" align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#009900; " >Marks Already Entered</span></td>
					<?php }?>
					
				</tr>
                 <tr bgcolor="" id="tbl">
                   <td colspan="8"><div id="myDiv<?php echo $count; ?>" style="width:800px;" align="center"></div></td>
                 </tr>
                 <?php }else{ $bgcolor="#F7FCFF"; ?>
                 <tr bgcolor="<?php echo $bgcolor; ?>">
                   <td height="25" class="style4"><?php echo $stdr['id']; ?><input type="hidden" value="<?php echo $stdr['session']; ?>" name="session" id="sessionnew" /></td>
                   <td height="25" class="style4"><?php echo $stdr['examname']; ?></td>
   				   <td height="25" class="style4" align="center"><?php echo $stdr['exammarksper']; ?></td>
                   <td height="25" class="style4" align="center"><?php echo $stdr['lastdate']; ?></td>
                   <?php if($stdr['examstatus']==0){?>
				   <td height="25" align="center"><a alt="<?php echo $stdr['id']; ?>" class="add_category" id="<?php echo $stdr['deptid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " >Click to Enter Marks</span></a></td>
                   <?php } else {?>
					<td height="25" align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#009900; " >Marks Already Entered</span></td>
					<?php }?>
					
                   </tr>
                 <tr bgcolor="" id="tbl">
                   <td colspan="8"><div id="myDiv<?php echo $count; ?>" style="width:800px;" align="center"></div></td>
                 </tr>
                 <?php }
			  $count++;
			  ?>
                 <?php }}
			     
			?>
               </table></td>
              </tr>
             <tr>
               <td width="23%" height="20" class="style2">&nbsp;                 </td>
               <td width="31%" height="20">&nbsp;</td>
               <td width="18%">&nbsp;</td>
               <td width="28%">&nbsp;</td>
             </tr>
           </table>
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
 /*  }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 
*/
}else{
  header("Location:index.php");
}
}  
?>