<?php 
ob_start();
session_start();
require_once('dbClass.php');
include_once("config.php"); // the connection to the database 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
	
	$iv="SELECT * FROM tbl_examinitionsettings WHERE id='$_GET[examid]'";
  	$ivq=$myDb->select($iv);
  	$ivrs=$myDb->get_row($ivq,'MYSQL_ASSOC');

	/*echo $ss="SELECT af.* FROM tbl_assignfaculty af inner join tbl_faculty f on af.faculty=f.id WHERE f.facultyid='$_SESSION[userid]' and af.deptid='$_GET[deptid]' and af.courseid='$_GET[courseid]' and af.session='$_GET[session]' and af.year='$_GET[eyear]' and af.semesterid='$_GET[semester]'"; exit;
  	$rss=$myDb->select($ss);
  	$qss=$myDb->get_row($rdd,'MYSQL_ASSOC');*/


?>




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

	jQuery('.numbersOnly').keyup(function () { 
    this.value = this.value.replace(/[^0-9\.]/g,'');
	});
</script>






<script language="JavaScript" type="text/JavaScript">
function checkstd(){
	 if(document.getElementById("marks").value==""){
         alert('Please Enter a Marks.');
	     document.getElementById("marks").focus();
	     return false;
     }
}
</script>

<script language type="text/javascript"> 
function submit_form()
{
	dml=document.forms['add_new'];
	// get the number of elements from the document
	len = dml.elements.length;
	for( i=0 ; i<len ; i++)
	{
		//check the textbox with the elements name
		if (dml.elements[i].name=='marks')
		{
			// if exists do the validation and set the focus to the textbox
			if (dml.elements[i].value=="")
			{
				alert('Enter the Name');
				dml.elements[i].focus();
				return false;
			}
		}
	}
	return true;
}
</script>



<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
border-bottom:1px solid #CCCCCC;
}
-->
</style>

<div style="overflow:hidden; margin:1em;">
<table width="97%"  border="0" cellspacing="0" cellpadding="0" id="stdtbl">
  <tr>
    <td><h1 class="style1">Student Marks Entry For: "<?php echo $ivrs['examname'];?>". <span style="color:#0099FF ">With Base Marks: <?php echo $ivrs['exammarksper'];?></span></h1>
     <?php if(isset($_GET['submitted'])) { 
	$NR = count($_POST['stdid']);
	
	
	for($i=0;$i<$NR;$i++)
	{
		$opdate=date("Y-m-d");
		$examid=$_POST['examid'];
		$stdid=$_POST['stdid'][$i];
		$marks=$_POST['marks'][$i];
		$deptid=$_POST['deptid'];
		$courseid=$_POST['courseid'];
		$session=$_POST['session'];
		$eyear=$_POST['eyear'];
		$semesterid=$_POST['semesterid'];
		/*$absent=$_POST['absent'][$i]; 
		$disqul=$_POST['disqul'][$i]; 
		if($absent!="")
		{
			$remarks=$absent;
		}
		else if($disqul!="")
		{
			$remarks=$disqul;
		}
		else
		{
			$remarks="Present";
		}
		*/
		$remarks=$_POST['remarks'][$i];
		$opby=$_SESSION['userid'];

		$newCategory = mysql_query("INSERT INTO tbl_marksentryprimary (examid, stdid, marks, opby, opdate, storedstatus, remarks) 
					VALUES ('$examid','$stdid','$marks','$opby','$opdate','I','$remarks')") or die(mysql_error());
								
		$ivn="SELECT * FROM tbl_marksentryfinal WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$eyear' and semesterid='$semesterid'";
  		$ivqn=$myDb->select($ivn);
  		$ivrsn=$myDb->get_row($ivqn,'MYSQL_ASSOC');
		if($ivrsn==0)
		{
			$newCategory = mysql_query("INSERT INTO tbl_marksentryfinal (stdid, deptid, courseid, session, year, semesterid, opby, opdate, storedstatus) 
					VALUES ('$stdid','$deptid','$courseid','$session','$eyear','$semesterid','$opby','$opdate','I')") or die(mysql_error());
		}
		
	}
	
	$section=$_POST['section'];
	if($section=="A")
	{
		$query="UPDATE   tbl_examinitionsettings set examstatusA='1' Where id='$_POST[examid]'";
		$op=$myDb->update_sql($query);
	}
	else if($section=="B")
	{
		$query="UPDATE   tbl_examinitionsettings set examstatusB='1' Where id='$_POST[examid]'";
		$op=$myDb->update_sql($query);
	}
	else if($section=="C")
	{
		$query="UPDATE   tbl_examinitionsettings set examstatusC='1' Where id='$_POST[examid]'";
		$op=$myDb->update_sql($query);
	}
	else if($section=="D")
	{
		$query="UPDATE   tbl_examinitionsettings set examstatusD='1' Where id='$_POST[examid]'";
		$op=$myDb->update_sql($query);
	}


	?>
      <script type="text/javascript">	
		$(document).ready(function(){
			$.nyroModalRemove();
		});
	  </script>

		<script language="javascript">
 $(document).ready(function(){
	var courseid=$('#courseid').val();
    var arr=$('#MyForm').serializeArray();	 
	$.post('studentmarksentry_search.php?courseid='+courseid,arr,function(result){
		 $('#MyResult').hide().html(result).fadeIn('slow');
	 });
 });
</script>
      <?php
	
} else { 

// extract the max order number: the new category will have this order number + 1
/*$csession=date("y").date("y")+1;


$rsCategoryName = mysql_query("SELECT * FROM tbl_stdinfo WHERE deptname ='$_GET[id]' and session='$csession'") or die(mysql_error());
$results = mysql_fetch_array($rsCategoryName);
$categoryName = $results[0];
*/

?>
    	
		<form action="<?php echo $_SERVER["PHP_SELF"]."?submitted=true" ?>" method="POST" name="add_new" class="nyroModal" id="add_new" onclick="javascript:return submit_form();">     
   		<label for="category_name"></label>
        <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="gridTbl">
          <tr>
            <td width="244" height="25" class="gridTblHead style2">Student Name</td>
            <td width="171" height="25" class="gridTblHead style2">Student ID</td>
            <td width="130" class="gridTblHead style2"><div align="center">Board Roll No</div></td>
            <td width="162" class="gridTblHead style2"><div align="center">Board Registration No</div></td>
            <td width="123" class="gridTblHead style2"><div align="center">Obtained Marks</div></td>
            <td width="176" bgcolor="#FFFFCC" class="gridTblHead style2"><div align="center">Remarks</div></td>
          </tr>
          <?php
			      //$csession=date("y").date("y")+1;
				  $csession=$_GET['session'];
				  $section=$_GET['section'];
				  $semester=$ivrs['semesterid'];
				  $std="SELECT * FROM tbl_stdinfo WHERE deptname ='$_GET[id]' and session='$csession' and section='$section' and stdcursemester='$semester' order by boardrollno";
			      $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
				  //if($count%2==0){
				  $bgcolor="#F7FCFF";
				  ?>
          <tr>
            <td height="25" class="gridTblValue"><?php echo $stdr['stdname']; ?><input type='hidden' name='examid' id='examid' value="<?php echo $ivrs['id'];?>"  ><input type='hidden' name='deptid' id='deptid' value="<?php echo $ivrs['deptid'];?>"  ><input type='hidden' name='courseid' id='courseid' value="<?php echo $ivrs['courseid'];?>"  ><input type='hidden' name='session' id='session' value="<?php echo $ivrs['session'];?>"  >
              <input type='hidden' name='semesterid' id='semesterid' value="<?php echo $ivrs['semesterid'];?>"  >
              <input type='hidden' name='eyear' id='eyear' value="<?php echo $ivrs['year'];?>"  >
              <input type='hidden' name='section' id='section' value="<?php echo $section;?>"  ></td>
            <td height="25" class="gridTblValue"><input type='textbox' name='stdid[]' id='stdid[]' value="<?php echo $stdr['stdid'];?>" readonly="true"  ></td>
            <td class="gridTblValue"><div align="center"><?php echo $stdr['boardrollno']; ?></div></td>
            <td class="gridTblValue"><div align="center"><?php echo $stdr['boardregno']; ?></div></td>
            <td class="gridTblValue" ><div align="center">
              <input name='marks[]' type='textbox' class="numbersOnly" id='marks<?php echo $count; ?>' width="60px;"  onKeyPress="return handleEnter(this, event)" value="0" maxlength="3" >
           </div></td>
            <td height="25" bgcolor="#FFF0FF" class="gridTblValue"><div align="center">
              <select name="remarks[]" id="remarks[]"  onkeypress="return handleEnter(this, event)">
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
                <option value="Disqualified">Disqualified</option>
              </select>
            </div></td>
		    </tr>
 <script language="javascript">
		     $(document).ready(function(){
			 $('#marks<?php echo $count; ?>').mouseout(function(){
			    //alert($('#marks<?php echo $count; ?>').val());
			    var bmrk='<?php echo $ivrs['exammarksper']; ?>';
			    if(parseInt($('#marks<?php echo $count; ?>').val())>parseInt(bmrk)){
				  alert("marks can not grater than base mark");
				  return false;
				}  
			  
			  });
			  
			  $('#marks<?php echo $count; ?>').blur('click',function(e){
			    //alert($('#marks<?php echo $count; ?>').val());
				//if(e.keycode==32){
			    var bmrk='<?php echo $ivrs['exammarksper']; ?>';
			    if(parseInt($('#marks<?php echo $count; ?>').val())>parseInt(bmrk)){
					
					alert("marks can not grater than base mark");
					
				  
				  return false;
				}
				//}  
			  
			  });		
			    $('input[class="numbersOnly"]').mousedown(function(){ 
				  var bmrk='<?php echo $ivrs['exammarksper']; ?>';
				  $('input[class="numbersOnly"]').each(function(i){
					
						  if(parseInt($('#marks'+i).val())>parseInt(bmrk)){
							alert("Obtained marks can not grater than base mark");
							$('#marks'+i).blur();
							$('#submit').hide();
							return false;
						  }else{
							$('#submit').show();
						  }
						  
				  });
				 }); 
				
				
				
				 
				 
			  $('#submit').mouseenter(function(){
			    //alert($('#marks<?php echo $count; ?>').val());
				//if(e.keycode==32){
				$('input[class="numbersOnly"]').each(function(i){
					var bmrk='<?php echo $ivrs['exammarksper']; ?>';
					if(parseInt($('#marks'+i).val())>parseInt(bmrk)){
					  alert("marks can not grater than base mark");
					  $('#marks'+i).blur();
					  $('#submit').hide();
					  return false;					
					}else{
					   $('#submit').show();
					}   
				});  
			  
			  });	
			  
			  					  				  				  
			});
		   </script>         
		   <?php
			  $count++;
			 // }
			    } 
			?>
        </table>
        <input type="hidden" value="<?php echo $_GET['category_id'] ?>" name="category_id" id="category_id" />
        <span class="style4"><span class="style2">
        <input type="submit" name="submit" id="submit" value="Submit Marks" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />
        </span></span>
      </form>
	  <script language="javascript">
	   $(document).blur(function(e){
	   
				$('input[class="numbersOnly"]').blur(function(){
				  var bmrk='<?php echo $ivrs['exammarksper']; ?>';
				  $('input[class="numbersOnly"]').each(function(i){
					
						  if(parseInt($('#marks'+i).val())>parseInt(bmrk)){
							alert("Obtained marks can not grater than base mark");
							$('#marks'+i).blur();
							$('#submit').hide();
							return false;
						  }else{
							$('#submit').show();
						  }
						  
				  });
				 }); 	   
	   
	   
	   
	     if(e.keyCode==9){
		  var bmrk='<?php echo $ivrs['exammarksper']; ?>';
	      $('input[class="numbersOnly"]').each(function(i){
			
			  	  if(parseInt($('#marks'+i).val())>parseInt(bmrk)){
					alert("Obtained marks can not grater than base mark");
					$('#marks'+i).blur();
					$('#submit').hide();
					return false;
				  }else{
				    $('#submit').show();
				  }
				  
		  });	  
	     }
	   });
	  
	  
	  </script>
	  
<script type="text/javascript">	
	$(document).ready(function(){
		$("#submit").click(function(e){
			e.preventDefault();
			if ( $("#marks").val() != "" ) $("#add_new").submit();
			else alert("Please insert the marks.");
		});
	});
</script>	 
      <?php }
	  
	   }else{
  header("Location:index.php");
}
} ?></td>
  </tr>
</table>

</div>
<?php 
  //$myDb->__destruct();
  
	   
?>
