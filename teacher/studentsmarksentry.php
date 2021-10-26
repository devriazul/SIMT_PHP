<?php session_start();
include("../config.php"); 
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

div.transbox
  {
  background-color:#ffffff;

  opacity:0.9;
  filter:alpha(opacity=60); /* For IE8 and earlier */
  }

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

<script language="javascript">
$(document).keyup(function(e) {
  if(e.keyCode==45){
    $('#bothead').show();
  }
  if(e.keyCode==27){
    $('#bothead').hide();
  }
});
</script>



<script language="javascript" src="show_course.js"></script>

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
          <br />
          
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        <td width="79%" valign="top">
<div class="transbox"><div id="bothead" style=" position:absolute; background-color:#666666;   padding:10px; color:#FFFFFF; left:400px;float:right;width:700px; height:auto; display:none; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
   
   HOW TO SEARCH EXAMINIRION:<br/>
  ---------------------------------------------<br/><br/>
   <label>* First Select a Department.(After selecting Department another combo will be arrived beside this combo)</label><br/> 
   <label>* Now select a Subject/Course from newly arrived combo.</label><br/> 
   <label>* Select a Session.</label><br/> 
   <label>* Select a Semester.</label><br/> 
   <label>* Now Press "Search" button(Complete Examinition lists of selected combination will be arrived)</label><br/> <br/><br/>

	HOW TO ENTER MARKS<br/>
  	--------------------------------<br/><br/>
   <label>In Examinition Lists you will see four columns: Examinition Name, Marks(%), Last Date of taken Exam & Action</label><br/><br/>
   <label>	-> Examinition Name------means Lists of exams assigned by Exam Controller.</label><br/>
   <label>	-> Marks(%)------means which percentage of marks will be added with the Final Marks.</label><br/>
   <label>	-> Last Date of Taken Exam------means you should take exam with in this mentioned date.</label><br/>
   <label>	-> Action------means you should CLICK on the action column "Click to Enter Marks" to put Students Marks.</label><br/><br/><br/>
   <label>After clicking on "Click to Enter Marks" column a POP UP window will be load with student lists. On the top of that POP UP window you will see the Examinition Name with the Original Marks of selected exam. Now you can put marks on "Obtained Marks" column(student wise). Now click "Submit Marks" to save data.</label><br/><br/><br/>
   <label>	N.B: If the Action column shows "Marks Already Entered" that means you already enter that particular Exam Marks.</label><br/>
  
	     
</div></div>

<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg'];  }?></font></p>
		<form name="MyForm" id="MyForm"  autocomplete="off" action="" method="post" onsubmit="Javascript:return checkstd();">
          <div align="center">            </div>
		
           <table width="95%" border="0" align="center" cellpadding="0" cellspacing="2" id="stdtbl">
             <tr>
               <td height="32" colspan="4" class="style2"><table width="100%" height="65"  border="0" cellpadding="0" cellspacing="3">
                 <tr>
                   <td width="13%">Department :</td>
                   <td width="27%"><select name="deptid" id="deptid" onchange="show(this.value);" onkeypress="return handleEnter(this, event)">
                     <option>Select Department</option>
                     <?php  //$y=date("Y");
					$vsd="SELECT distinct d.id as did, d.name AS DepartmentName FROM tbl_assignfaculty a INNER JOIN tbl_faculty f ON a.facultyid = f.id INNER JOIN tbl_department d ON a.deptid = d.id INNER JOIN tbl_courses c ON a.courseid = c.id INNER JOIN tbl_semester s ON a.semesterid = s.id WHERE f.storedstatus<>'D' and f.facultyid='$_SESSION[userid]' and a.status='0'";
  					$rd=$myDb->select($vsd);
				   while($hrow=$myDb->get_row($rd,'MYSQL_ASSOC')){
					
				   ?>
                     <option value="<?php echo $hrow['did']; ?>"><?php echo $hrow['DepartmentName']; ?></option>
                     <?php } ?>
                   </select></td>
                   <td width="1%">&nbsp;</td>
				<td height="34" class="style2"><div align="right">Course Name :</div></td>
                   <td height="34" class="style2"><div id="sub"></div></td>
                 </tr>
                 <tr>
                   <td>Session :</td>
                   <td><select name="session" class="style2" id="session" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" onchange="showSelected();">
                     
                    <option>Select Session</option>
                     <?php 
					$vssn="SELECT distinct  a.session AS SESSION  FROM tbl_assignfaculty a INNER JOIN tbl_faculty f ON a.facultyid = f.id INNER JOIN tbl_department d ON a.deptid = d.id INNER JOIN tbl_courses c ON a.courseid = c.id INNER JOIN tbl_semester s ON a.semesterid = s.id WHERE f.storedstatus<>'D' and f.facultyid='$_SESSION[userid]' and a.status='0'";
  					$rss=$myDb->select($vssn);
				   while($srow=$myDb->get_row($rss,'MYSQL_ASSOC')){
					
				   ?>
                     <option value="<?php echo $srow['SESSION']; ?>"><?php echo $srow['SESSION'];//echo "20".substr_replace($srow['SESSION'],'-20',-2,-2); ?></option>
                     <?php } ?>
                   
                   </select></td>
                   <td>&nbsp;</td>
                   <td><div align="right">Semester :</div></td>
                   <td><select name="semester" id="semester" style="font-family: Verdana; font-size: 8pt;padding:3px; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                     <option value="-1" selected="selected">Select Semester</option>
                     <?php 
					$vsse="SELECT distinct s.id as sid, s.name AS SemesterName FROM tbl_assignfaculty a INNER JOIN tbl_faculty f ON a.facultyid = f.id INNER JOIN tbl_department d ON a.deptid = d.id INNER JOIN tbl_courses c ON a.courseid = c.id INNER JOIN tbl_semester s ON a.semesterid = s.id WHERE f.storedstatus<>'D' and f.facultyid='$_SESSION[userid]' and a.status='0'";
  					$rse=$myDb->select($vsse);
				  while($stdr=$myDb->get_row($rse,'MYSQL_ASSOC')){
				  ?>
                     <option value="<?php echo $stdr['sid']; ?>"><?php echo $stdr['SemesterName']; ?></option>
                     <?php } ?>
                   </select></td>
                 </tr>
                 <tr>
                   <td>Section :</td>
                   <td><span class="style4">
                     <select name="section" class="style2" id="section" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" onchange="showSelected();">
                       <option>Select Section</option>
                       <?php 
					$vss="SELECT distinct  a.section  FROM tbl_assignfaculty a INNER JOIN tbl_faculty f ON a.facultyid = f.id INNER JOIN tbl_department d ON a.deptid = d.id INNER JOIN tbl_courses c ON a.courseid = c.id INNER JOIN tbl_semester s ON a.semesterid = s.id WHERE f.storedstatus<>'D' and f.facultyid='$_SESSION[userid]'";
  					$qss=$myDb->select($vss);
				   while($serow=$myDb->get_row($qss,'MYSQL_ASSOC')){
					
				   ?>
                       <option value="<?php echo $serow['section']; ?>"><?php echo $serow['section'];//echo "20".substr_replace($srow['SESSION'],'-20',-2,-2); ?></option>
                       <?php } ?>
                     </select>
                   </span></td>
                   <td>&nbsp;</td>
                   <td width="32%"><div align="right"></div></td>
                   <td width="27%"></td>
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
                 <input type="button" name="subs" id="stb" value="Search" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />
                 </label>
                 </td>
               </tr>
           </table>      
           </form>
          
           <script language="javascript">
		   $(document).ready(function(){
		     $('#stb').click(function(){
			    var arr=$('#MyForm').serializeArray();
				$.post("search_student_for_marks.php",arr,function(r){
				  $('#MyResult').html(r);
				});
			 });
		   });
		   
		   </script>
		    <br />
			<div id="stMark"></div>
          		<div id="MyResult" align="center"></div> 
          		          
<p></p>
<?php 
  $myDb->__destruct();
	   
?>
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