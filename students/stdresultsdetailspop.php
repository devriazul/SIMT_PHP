<?php 
ob_start();
session_start();
require_once('dbClass.php');
include_once("config.php"); // the connection to the database 
if($myDb->connect($host,$user,$pwd,$db,true))
{
  	$vs="SELECT s.id, s.stdname, s.stdid, s.password, s.session, d.name as Department, b.batchname as Batch, sm.name as Semester, s.fname, s.mname, s.nationality, s.praddress, s.peraddress, s.phone, s.sexstatus, s.dob, s.bgroup, s.religion, s.img FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_semester sm on s.semester=sm.id WHERE s.storedstatus<>'D' and s.stdid='$_SESSION[userid]'";
  	$r=$myDb->select($vs);
  	$row=$myDb->get_row($r,'MYSQL_ASSOC');

  	$vsc="SELECT c.*, (c.cont_assess_t+c.f_exam_t+c.cont_assess_p+c.f_exam_p) as TotalMarks FROM `tbl_marksentryfinal` mf inner join tbl_courses c on mf.courseid=c.id WHERE mf.storedstatus<>'D' and mf.stdid='$_SESSION[userid]' and mf.courseid='$_GET[courseid]'";
  	$rc=$myDb->select($vsc);
  	$rowc=$myDb->get_row($rc,'MYSQL_ASSOC');

  	$vsmd="SELECT es.* FROM `tbl_examinitionsettings` es inner join tbl_courses c on es.courseid=c.id WHERE es.storedstatus<>'D' and es.courseid='$_GET[courseid]'";
  	$rmd=$myDb->select($vsmd);
  	$rowmd=$myDb->get_row($rmd,'MYSQL_ASSOC');

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
.style15 {font-size: 12px; font-weight:bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>

<div style="overflow:hidden; margin:1em;">
<table width="98%"  border="0" cellspacing="0" cellpadding="0" id="stdtbl">
  <tr>
    <td><h1 class="style1">Course Name: <span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#33CC00; " ><?php echo $rowc['coursename']." (". $rowc['coursecode']."). Total Credit: ".$rowc['credit'].". Total Marks: ".$rowc['TotalMarks'];?></span></h1>
      <?php if(isset($_GET['submitted'])) { 
	
	

} else { 


?>
<form action="<?php echo $_SERVER["../PHP_SELF"]."?submitted=true" ?>" method="POST" name="add_new" class="nyroModal" id="add_new" onSubmit="Javascript:return checkstd();">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="2" cellpadding="0" >
              <tr bgcolor="#F2F2F2">
                <td width="237" height="25" class="style15">Examinition Name</td>
                <td width="144" class="style15"><div align="center">Obtained Marks</div></td>
              </tr>
              <?php
			      //$csession=date("y").date("y")+1;
				  //$csession=$_GET['session'];
				  //$deptid=$_GET['deptid'];
				  $courseid=$_GET['courseid']; 
				  //$eyear=$_GET['eyear'];
				  //$semesterid=$_GET['semesterid']; 
					
				  $std="SELECT s.*, mf.* FROM `tbl_stdinfo` s inner join tbl_marksentryfinal mf on s.stdid=mf.stdid WHERE s.storedstatus<>'D' and mf.stdid='$_SESSION[userid]' and mf.courseid='$courseid'";
			      $stdq=$myDb->select($std);
				  //$count=0;
				  $stdr=$myDb->get_row($stdq,'MYSQL_ASSOC');
				  
				  $bgcolor="#F7FCFF";
				  ?>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td height="25" class="style4"><span class="style15">Quiz Test : </span>
				</td>
                <td class="style15" align="center"><?php echo $stdr['quiztestmarks'];?>
                  </td>
              </tr>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td height="25" class="style4"><span class="style15">Class Test : </span></td>
                <td class="style15" align="center"><?php echo $stdr['classtestmarks'];?>
                  </td>
              </tr>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td height="25" class="style4"><span class="style15">Home Work : </span></td>
                <td class="style15" align="center"><?php echo $stdr['hwmarks'];?>
                  </td>
              </tr>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td height="25" class="style4"><span class="style15">Job Experiment : </span></td>
                <td class="style15" align="center"><?php echo $stdr['jobexpr'];?>
                  </td>
              </tr>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td height="25" class="style4"><span class="style15">Job Experiment Report : </span></td>
                <td class="style15" align="center"><?php echo $stdr['jobexprreport'];?>
                  </td>
              </tr>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td height="25" class="style4"><span class="style15">Job Experiment Viva : </span></td>
                <td class="style15" align="center"><?php echo $stdr['jobexprviva'];?>
                  </td>
              </tr>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td height="25" class="style4"><span class="style15">Job Experiment Final :</span></td>
                <td class="style15" align="center"><?php echo $stdr['jobexprfinal'];?>
                  </td>
              </tr>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td height="25" class="style4"><span class="style15">Job Experiment Report Final : </span></td>
                <td class="style15" align="center"><?php echo $stdr['jobexprreportfinal'];?>
                  </td>
              </tr>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td height="25" class="style4"><span class="style15">Job Experiment Viva Final : </span></td>
                <td class="style15" align="center"><?php echo $stdr['jobexprvivafinal'];?>
                  </td>
              </tr>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td height="25" class="style4"><span class="style15">General Attendance Marks : </span></td>
                <td class="style15" align="center"><?php echo $stdr['attendancemarks'];?>
                  </td>
              </tr>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td height="25" class="style4"><span class="style15">Practical Attendance Marks : </span></td>
                <td class="style15" align="center"><?php echo $stdr['attendancemarksprac'];?>
                  </td>
              </tr>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td height="25" class="style4"><span class="style15">Behavior Marks : </span></td>
                <td class="style15" align="center"><?php echo $stdr['behaviormarks'];?>
                  </td>
              </tr>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td height="25" class="style4"><span class="style15">Final Examinition : </span></td>
                <td class="style15" align="center"><?php echo $stdr['finalexammarks'];?>
                  </td>
              </tr>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td height="25" class="style4">&nbsp;</td>
                <td class="style15" align="center">&nbsp;</td>
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
</span></span><script type="text/javascript">	
	$(document).ready(function(){
		$("#form_submit").click(function(e){
			e.preventDefault();
			if ( $("#category_name").val() != "" ) $("#add_new").submit();
			else alert("Please insert the name of the new Account.");
		});
	});
</script>	 
      <?php }} ?></form>
</td>
  </tr>
</table>

</div>
