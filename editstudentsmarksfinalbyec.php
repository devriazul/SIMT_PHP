<?php 
ob_start();
session_start();
require_once('dbClass.php');
include_once("config.php"); // the connection to the database 
if($myDb->connect($host,$user,$pwd,$db,true))
{
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
    <td><h1 class="style1">Student Final Marks Edit For <span class="style1">
      <?php echo "[".$_GET['examname']."]";?>
    </span></h1>
      <?php if(isset($_GET['submitted'])) { 
	
	if($_POST['examname']=="Class Test")
	{//echo $_POST['semesterid']; exit;
		$query="UPDATE   tbl_marksentryfinal set classtestmarks='$_POST[marks]' Where stdid='$_POST[stdid]' and deptid='$_POST[deptid]' and courseid='$_POST[courseid]' and session='$_POST[session]' and year='$_POST[eyear]' and semesterid='$_POST[semesterid]'";
		$op=$myDb->update_sql($query);
	}
	else if($_POST['examname']=="Quiz Test")
	{
		$query="UPDATE   tbl_marksentryfinal set quiztestmarks='$_POST[marks]' Where stdid='$_POST[stdid]' and deptid='$_POST[deptid]' and courseid='$_POST[courseid]' and session='$_POST[session]' and year='$_POST[eyear]' and semesterid='$_POST[semesterid]'";
		$op=$myDb->update_sql($query);
	}
	else if($_POST['examname']=="Job Experiment")
	{
		$query="UPDATE   tbl_marksentryfinal set jobexpr='$_POST[marks]' Where stdid='$_POST[stdid]' and deptid='$_POST[deptid]' and courseid='$_POST[courseid]' and session='$_POST[session]' and year='$_POST[eyear]' and semesterid='$_POST[semesterid]'";
		$op=$myDb->update_sql($query);
	}
	else if($_POST['examname']=="Home Work")
	{
		$query="UPDATE   tbl_marksentryfinal set hwmarks='$_POST[marks]' Where stdid='$_POST[stdid]' and deptid='$_POST[deptid]' and courseid='$_POST[courseid]' and session='$_POST[session]' and year='$_POST[eyear]' and semesterid='$_POST[semesterid]'";
		$op=$myDb->update_sql($query);
	}
	else if($_POST['examname']=="Job Experiment Report")
	{
		$query="UPDATE   tbl_marksentryfinal set jobexprreport='$_POST[marks]' Where stdid='$_POST[stdid]' and deptid='$_POST[deptid]' and courseid='$_POST[courseid]' and session='$_POST[session]' and year='$_POST[eyear]' and semesterid='$_POST[semesterid]'";
		$op=$myDb->update_sql($query);
	}
	else if($_POST['examname']=="Job Experiment Viva")
	{
		$query="UPDATE   tbl_marksentryfinal set jobexprviva='$_POST[marks]' Where stdid='$_POST[stdid]' and deptid='$_POST[deptid]' and courseid='$_POST[courseid]' and session='$_POST[session]' and year='$_POST[eyear]' and semesterid='$_POST[semesterid]'";
		$op=$myDb->update_sql($query);
	}
	else if($_POST['examname']=="Job Experiment Final")
	{
		$query="UPDATE   tbl_marksentryfinal set jobexprfinal='$_POST[marks]' Where stdid='$_POST[stdid]' and deptid='$_POST[deptid]' and courseid='$_POST[courseid]' and session='$_POST[session]' and year='$_POST[eyear]' and semesterid='$_POST[semesterid]'";
		$op=$myDb->update_sql($query);
	}
	else if($_POST['examname']=="Job Experiment Report Final")
	{
		$query="UPDATE   tbl_marksentryfinal set jobexprreportfinal='$_POST[marks]' Where stdid='$_POST[stdid]' and deptid='$_POST[deptid]' and courseid='$_POST[courseid]' and session='$_POST[session]' and year='$_POST[eyear]' and semesterid='$_POST[semesterid]'";
		$op=$myDb->update_sql($query);
	}
	else if($_POST['examname']=="Job Experiment Viva Final")
	{
		$query="UPDATE   tbl_marksentryfinal set jobexprvivafinal='$_POST[marks]' Where stdid='$_POST[stdid]' and deptid='$_POST[deptid]' and courseid='$_POST[courseid]' and session='$_POST[session]' and year='$_POST[eyear]' and semesterid='$_POST[semesterid]'";
		$op=$myDb->update_sql($query);
	}
	else if($_POST['examname']=="Attendance Theory Cont")
	{
		$query="UPDATE   tbl_marksentryfinal set attendancemarks='$_POST[marks]' Where stdid='$_POST[stdid]' and deptid='$_POST[deptid]' and courseid='$_POST[courseid]' and session='$_POST[session]' and year='$_POST[eyear]' and semesterid='$_POST[semesterid]'";
		$op=$myDb->update_sql($query);
	}
	else if($_POST['examname']=="Attendance Practical Cont")
	{
		$query="UPDATE   tbl_marksentryfinal set attendancemarksprac='$_POST[marks]' Where stdid='$_POST[stdid]' and deptid='$_POST[deptid]' and courseid='$_POST[courseid]' and session='$_POST[session]' and year='$_POST[eyear]' and semesterid='$_POST[semesterid]'";
		$op=$myDb->update_sql($query);
	}
	else if($_POST['examname']=="Behavior")
	{
		$query="UPDATE   tbl_marksentryfinal set behaviormarks='$_POST[marks]' Where stdid='$_POST[stdid]' and deptid='$_POST[deptid]' and courseid='$_POST[courseid]' and session='$_POST[session]' and year='$_POST[eyear]' and semesterid='$_POST[semesterid]'";
		$op=$myDb->update_sql($query);
	}
	else if($_POST['examname']=="Theory Final Exam")
	{
		$query="UPDATE   tbl_marksentryfinal set finalexammarks='$_POST[marks]' Where stdid='$_POST[stdid]' and deptid='$_POST[deptid]' and courseid='$_POST[courseid]' and session='$_POST[session]' and year='$_POST[eyear]' and semesterid='$_POST[semesterid]'";
		$op=$myDb->update_sql($query);
	}
	else if($_POST['examname']=="Mid Term")
	{
		$query="UPDATE   tbl_marksentryfinal set midterm='$_POST[marks]' Where stdid='$_POST[stdid]' and deptid='$_POST[deptid]' and courseid='$_POST[courseid]' and session='$_POST[session]' and year='$_POST[eyear]' and semesterid='$_POST[semesterid]'";
		$op=$myDb->update_sql($query);
	}
	else if($_POST['examname']=="Assigment")
	{
		$query="UPDATE   tbl_marksentryfinal set assignment='$_POST[marks]' Where stdid='$_POST[stdid]' and deptid='$_POST[deptid]' and courseid='$_POST[courseid]' and session='$_POST[session]' and year='$_POST[eyear]' and semesterid='$_POST[semesterid]'";
		$op=$myDb->update_sql($query);
	}

	/*$NR = count($_POST['stdid']);
	for($i=0;$i<$NR;$i++)
	{
		$opdate=date("Y-m-d");
		$examid=$_POST['examid'];
		$stdid=$_POST['stdid'][$i];
		$marks=$_POST['marks'][$i];
		$opby=$_SESSION['userid'];

		$newCategory = mysql_query("INSERT INTO tbl_marksentryprimary (examid, stdid, marks, opby, opdate, storedstatus) 
					VALUES ('$examid','$stdid','$marks','$opby','$opdate','I')") or die(mysql_error());
								
		
	}*/
	

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
	$.post('submitstudentmarksec_search.php?courseid='+courseid,arr,function(result){
		 $('#MyResult').hide().html(result).fadeIn('slow');
	 });
	 //$("#MyResult").html("<img src='bigLoader.gif' />");
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
    	
		<form action="<?php echo $_SERVER["PHP_SELF"]."?submitted=true" ?>" method="POST" name="add_new" class="nyroModal" id="add_new" onSubmit="Javascript:return checkstd();">     
   		<label for="category_name"></label>
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0" id="stdtbl">
              <tr bgcolor="#DFF4FF">
                <td width="237" height="25" class="style15">Student Name</td>
                <td width="144" height="25" class="style15">Student ID </td>
                <td width="144" class="style15">Final Marks</td>
              </tr>
              <?php
			      //$csession=date("y").date("y")+1;
				  $csession=$_GET['session'];
				  $deptid=$_GET['deptid'];
				  $courseid=$_GET['courseid'];
				  $eyear=$_GET['eyear'];
				  $semesterid=$_GET['semesterid']; 

				  $std="SELECT m.stdid, s.stdname, m.* FROM tbl_marksentryfinal m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.stdid ='$_GET[id]' and m.session='$csession' and m.deptid='$deptid' and m.courseid='$courseid' and m.semesterid='$semesterid' and m.year='$eyear'";
			      $stdq=$myDb->select($std);
				  //$count=0;
				  $stdr=$myDb->get_row($stdq,'MYSQL_ASSOC');
				  
				  $bgcolor="#F7FCFF";
				  ?>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td height="25" class="style4"><?php echo $stdr['stdname']; ?>
                    <input type='hidden' name='examname' id='examname' value="<?php echo $_GET['examname'];?>">
					<input type='hidden' name='session' id='session' value="<?php echo $_GET['session'];?>">
					<input type='hidden' name='eyear' id='eyear' value="<?php echo $_GET['eyear'];?>">
					<input type='hidden' name='deptid' id='deptid' value="<?php echo $_GET['deptid'];?>">
					<input type='hidden' name='courseid' id='courseid' value="<?php echo $_GET['courseid'];?>">
					<input type='hidden' name='semesterid' id='semesterid' value="<?php echo $_GET['semesterid'];?>">

				</td>
                <td height="25" class="style4"><input type='textbox' name='stdid' id='stdid' value="<?php echo $stdr['stdid'];?>" readonly="true" ></td>
                <td class="style4"><input name='marks' type='textbox' id='marks' maxlength="3" value="<?php if($_GET['examname']=="Class Test"){echo $stdr['classtestmarks'];}else if($_GET['examname']=="Quiz Test"){echo $stdr['quiztestmarks'];}else if($_GET['examname']=="Job Experiment"){echo $stdr['jobexpr'];}else if($_GET['examname']=="Home Work"){echo $stdr['hwmarks'];}else if($_GET['examname']=="Job Experiment Report"){echo $stdr['jobexprreport'];}else if($_GET['examname']=="Job Experiment Viva"){echo $stdr['jobexprviva'];}else if($_GET['examname']=="Behavior"){echo $stdr['behaviormarks'];}else if($_GET['examname']=="Attendance Theory Cont"){echo $stdr['attendancemarks'];}else if($_GET['examname']=="Attendance Practical Cont"){echo $stdr['attendancemarksprac'];}else if($_GET['examname']=="Behavior"){echo $stdr['behaviormarks'];}else if($_GET['examname']=="Job Experiment Final"){echo $stdr['jobexprfinal'];}else if($_GET['examname']=="Job Experiment Report Final"){echo $stdr['jobexprreportfinal'];}
				else if($_GET['examname']=="Job Experiment Viva Final"){echo $stdr['jobexprvivafinal'];}else if($_GET['examname']=="Theory Final Exam"){echo $stdr['finalexammarks'];}else if($_GET['examname']=="Mid Term"){echo $stdr['midterm'];}else if($_GET['examname']=="Assigment"){echo $stdr['assignment'];}?>" class="numbersOnly"  onKeyPress="return handleEnter(this, event)" ></td>
              </tr>
              <?php
			  //$count++;
			 // }
			    //} 
			?>
            </table></td>
            </tr>
        </table>
        <input type="hidden" value="<?php echo $_GET['category_id'] ?>" name="category_id" id="category_id" />
        <span class="style4"><span class="style2">
        <input type="submit" name="submit" id="submit" value="Update Marks" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />
        </span></span>
      </form>
<script type="text/javascript">	
	$(document).ready(function(){
		$("#form_submit").click(function(e){
			e.preventDefault();
			if ( $("#category_name").val() != "" ) $("#add_new").submit();
			else alert("Please insert the name of the new Account.");
		});
	});
</script>	 
      <?php }} ?></td>
  </tr>
</table>

</div>
