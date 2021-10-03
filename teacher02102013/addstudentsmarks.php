<?php 
ob_start();
session_start();
require_once('dbClass.php');
include_once("config.php"); // the connection to the database 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
$iv="SELECT * FROM tbl_examinitionsettings WHERE id='$_GET[examid]'";
  	$ivq=$myDb->select($iv);
  	$ivrs=$myDb->get_row($ivq,'MYSQL_ASSOC');
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
	$query="UPDATE   tbl_examinitionsettings set examstatus='1' Where id='$_POST[examid]'";
	$op=$myDb->update_sql($query);
	
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

		$opby=$_SESSION['userid'];

		$newCategory = mysql_query("INSERT INTO tbl_marksentryprimary (examid, stdid, marks, opby, opdate, storedstatus) 
					VALUES ('$examid','$stdid','$marks','$opby','$opdate','I')") or die(mysql_error());
								
		$ivn="SELECT * FROM tbl_marksentryfinal WHERE stdid='$stdid' and deptid='$deptid' and courseid='$courseid' and session='$session' and year='$eyear' and semesterid='$semesterid'";
  		$ivqn=$myDb->select($ivn);
  		$ivrsn=$myDb->get_row($ivqn,'MYSQL_ASSOC');
		if($ivrsn==0)
		{
			$newCategory = mysql_query("INSERT INTO tbl_marksentryfinal (stdid, deptid, courseid, session, year, semesterid, opby, opdate, storedstatus) 
					VALUES ('$stdid','$deptid','$courseid','$session','$eyear','$semesterid','$opby','$opdate','I')") or die(mysql_error());
		}
		
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
        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="stdtbl">
          <tr bgcolor="#DFF4FF">
            <td width="242" height="25" class="style15">Student Name</td>
            <td width="170" height="25" class="style15">Student ID              </td>
			
            <td width="129" class="style15"><div align="center">Board Roll No</div></td>
            <td width="152" class="style15"><div align="center">Board Registration No</div></td>
            <td width="152" class="style15"><div align="center">Obtained Marks</div></td>
          </tr>
          <?php
			      //$csession=date("y").date("y")+1;
				  $csession=$_GET['session'];
				  $std="SELECT * FROM tbl_stdinfo WHERE deptname ='$_GET[id]' and session='$csession'";
			      $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
				  //if($count%2==0){
				  $bgcolor="#F7FCFF";
				  ?>
          <tr bgcolor="<?php echo $bgcolor; ?>">
            <td height="25" class="style4"><?php echo $stdr['stdname']; ?><input type='hidden' name='examid' id='examid' value="<?php echo $ivrs['id'];?>"  ><input type='hidden' name='deptid' id='deptid' value="<?php echo $ivrs['deptid'];?>"  ><input type='hidden' name='courseid' id='courseid' value="<?php echo $ivrs['courseid'];?>"  ><input type='hidden' name='session' id='session' value="<?php echo $ivrs['session'];?>"  ><input type='hidden' name='semesterid' id='semesterid' value="<?php echo $ivrs['semesterid'];?>"  ><input type='hidden' name='eyear' id='eyear' value="<?php echo $ivrs['year'];?>"  ></td>
            <td height="25" class="style4"><input type='textbox' name='stdid[]' id='stdid[]' value="<?php echo $stdr['stdid'];?>" readonly="true"  ></td>
            <td class="style4"><div align="center"><?php echo $stdr['boardrollno']; ?></div></td>
            <td class="style4"><div align="center"><?php echo $stdr['boardregno']; ?></div></td>
            <td height="25" class="style4"><div align="center">
			  <input name='marks[]' type='textbox' class="numbersOnly" id='marks[]'  onKeyPress="return handleEnter(this, event)" value="0" maxlength="3" >
</div></td>
		    </tr>
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
<script type="text/javascript">	
	$(document).ready(function(){
		$("#submit").click(function(e){
			e.preventDefault();
			if ( $("#marks").val() != "" ) $("#add_new").submit();
			else alert("Please insert the name of the new Account.");
		});
	});
</script>	 
      <?php }} ?></td>
  </tr>
</table>

</div>
