<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='submitstudentmarksec.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
/*$per_page = 20;

if(isset($_GET['page']))
    $page = $_GET['page'];
$start = ($page-1)*$per_page;
*/
$t=0;
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



<form name="MyForm" action="#" id="frm" autocomplete="off"  method="post"  target="_blank">           
			<table width="100%" border="0" align="left" cellpadding="0" cellspacing="2" id="stdtbl">
             <tr>
               <td height="20" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">Student Marks </td>
             </tr>
             <tr>
               <td height="32" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><table width="100%"  border="0" cellpadding="0" cellspacing="2" bgcolor="#FFFFFF">
                 <tr bgcolor="#DFF4FF">
                   <td width="27%" height="23"><strong>TM:</strong> Total Marks</td>
                   <td width="27%"><strong>CT:</strong> Class Test </td>
                   <td width="21%"><strong>QT:</strong> Quiz Test </td>
                   <td width="25%"><strong>HW:</strong> Home Work </td>
                 </tr>
                 <tr bgcolor="#DFF4FF">
                   <td height="23"><strong>JE:</strong> Job Experiment</td>
                   <td><strong>JER:</strong> Job Experiment Report </td>
                   <td><strong>JEV:</strong> Job Experiment Viva</td>
                   <td><strong>BHV:</strong> Behavior</td>
                 </tr>
                 <tr bgcolor="#DFF4FF">
                   <td height="26"><strong>ATC:</strong> Attendance Theory Continuous </td>
                   <td><strong>APC:</strong> Attendance Pratical Continuous </td>
                   <td><strong>JEF:</strong> Job Experiment Final</td>
                   <td><strong>JERF:</strong> Job Experiment Report Final</td>
                 </tr>
                 <tr bgcolor="#DFF4FF">
                   <td height="23"><strong>JEVF:</strong> Job Experiment Viva Final </td>
                   <td><strong>TF:</strong> Theory Final </td>
                   <td><strong>TOM:</strong> Total Obtained Marks</td>
                   <td>&nbsp;</td>
                 </tr>
               </table></td>
             </tr>
             <tr>
               <td width="47%" height="20" class="style2"><table width="100%" border="0" cellspacing="0" cellpadding="0" id="stdtbl">
                 
                 
				  <tr bgcolor="#DFF4FF">
                   <td width="174" height="25" class="style2">Student ID </td>
                   <td width="61" height="25" class="style2"><div align="center">TM</div></td>
                   <td width="31" height="25" class="style2"><div align="center">CT</div></td>
                   <td width="30" class="style2"><div align="center">QT</div></td>
				   <td width="50" class="style2"><div align="center">JE</div></td>
				   <td width="45" class="style2"><div align="center">HW</div></td>
				   <td width="47" class="style2"><div align="center">JER</div></td>
				   <td width="47" class="style2"><div align="center">JEV</div></td>
				   <td width="47" class="style2"><div align="center">BHV</div></td>
				   <td width="50" class="style2"><div align="center">ATC</div></td>
				   <td width="48" class="style2"><div align="center">APC</div></td>
				   <td width="61" class="style2"><div align="center">JEF</div></td>
				   <td width="54" class="style2"><div align="center">JERF</div></td>
				   <td width="54" class="style2"><div align="center">JEVF</div></td>
				   <td width="55" class="style2"><div align="center">TF</div></td>
				   <td width="89" class="style2"><div align="center">TOM</div></td>
				   <td width="90" class="style2"><div align="center">Grade</div></td>
				  </tr>					
				<?php
			      if(isset($_POST['deptid']) && isset($_POST['session']) && isset($_POST['semester'])){
  				  $crs="SELECT distinct stdid FROM tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]'"; 
  				  
				  $crq=$myDb->select($crs); 
				  $count=0;
  				  while($crsr=$myDb->get_row($crq,'MYSQL_ASSOC')){
				  if($count%2==0){
				  $bgcolor="#FFFFFF";
				  ?>
                 <tr bgcolor="<?php echo $bgcolor; ?>"><?php 
				  $std="SELECT distinct m.stdid, m.examname, m.session, m.deptid, m.courseid, m.year, m.semesterid, (c.cont_assess_t+c.f_exam_t+c.cont_assess_p+c.f_exam_p) as TotalMarks,
						(select classtestmarks from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]'  and stdid='$crsr[stdid]') as ClassTest,
						(select quiztestmarks from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as QuizTest ,
						(select `hwmarks` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as HomeWork,
						(select `jobexpr` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperiment,
						(select `jobexprfinal` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperimentFinal,
						(select `jobexprreport` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperimentReport,
						(select `jobexprreportfinal` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperimentReportFinal,
						(select `jobexprviva` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperimentViva,
						(select `jobexprvivafinal` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperimentVivaFinal,
						(select `attendancemarks` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as AttendanceT,
						(select `attendancemarksprac` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as AttendanceP,
						(select `behaviormarks` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as Behavior,
						(select `finalexamprac` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as FinalExamPrac,
						(select `finalexammarks` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as FinalExam 
						FROM `tbl_marksentryfinal` m inner join tbl_courses c on m.courseid=c.id WHERE m.deptid='$_POST[deptid]' and m.courseid= '$_GET[courseid]' and m.semesterid='$_POST[semester]' and m.session='$_POST[session]' and m.year='$_POST[year]' and m.stdid='$crsr[stdid]'";	
			      $stdq=$myDb->select($std);
				  
				  $stdr=$myDb->get_row($stdq,'MYSQL_ASSOC'); ?>
				  
                   	<td height="25" class="style4"><?php echo $stdr['stdid'];?><input type="hidden" value="<?php echo $stdr['stdid']; ?>" name="stdid[]" id="stdid" /><input type="hidden" value="<?php echo $stdr['session']; ?>" name="session" id="sessionnew" /><input type="hidden" value="<?php echo $stdr['deptid']; ?>" name="deptid" id="deptid" /><input type="hidden" value="<?php echo $stdr['courseid']; ?>" name="courseid" id="courseid" /><input type="hidden" value="<?php echo $stdr['year']; ?>" name="eyear" id="eyear" /><input type="hidden" value="<?php echo $stdr['semesterid']; ?>" name="semesterid" id="semesterid" /></td>
                   	<td height="25" class="style4" ><div align="center"><input type="label" value="<?php echo $stdr['TotalMarks']; ?>" name="tm" id="tm<?php echo $count; ?>" style="width:50px; font-weight:bold; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" /></div></td>
       
 				   	<td height="25" class="style4" align="center"><a alt="<?php echo "Class Test"; ?>"  id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="label" value="<?php echo $stdr['ClassTest']; ?>" name="classtest" id="classtest<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" /></span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Quiz Test"; ?>"  id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="label" value="<?php echo $stdr['QuizTest']; ?>" name="quiztest" id="quiztest<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Job Experiment"; ?>"  id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="label" value="<?php echo $stdr['JobExperiment']; ?>" name="je" id="je<?php echo $count; ?>" style="width:30px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Home Work"; ?>"  id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="label" value="<?php echo $stdr['HomeWork']; ?>" name="hw" id="hw<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Job Experiment Report"; ?>"  id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="label" value="<?php echo $stdr['JobExperimentReport']; ?>" name="jer" id="jer<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Job Experiment Viva"; ?>"  id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="label" value="<?php echo $stdr['JobExperimentViva']; ?>" name="jev" id="jev<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Behavior"; ?>"  id="<?php echo $stdr['stdid'];?>" ></a><a alt="<?php echo "Behavior"; ?>"  id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " >
					  <input type="label" value="<?php echo $stdr['Behavior']; ?>" name="behavior" id="behavior<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/>
					</span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Attendance Theory Cont"; ?>"  id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " >
					  <input type="label" value="<?php echo $stdr['AttendanceT']; ?>" name="attendancet" id="attendancet<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" />
					</span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Attendance Practical Cont"; ?>"  id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " >
                    <a alt="<?php echo "Attendance Practical Cont"; ?>"  id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " >
                    <input type="label" value="<?php echo $stdr['AttendanceP']; ?>" name="attendancep" id="attendancep<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" />
                    </span></a> </span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Job Experiment Final"; ?>" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="label" value="<?php echo $stdr['JobExperimentFinal']; ?>" name="jef" id="jef<?php echo $count; ?>" style="width:30px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Job Experiment Report Final"; ?>" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="label" value="<?php echo $stdr['JobExperimentReportFinal']; ?>" name="jerf" id="jerf<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Job Experiment Viva Final"; ?>" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="label" value="<?php echo $stdr['JobExperimentVivaFinal']; ?>" name="jevf" id="jevf<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Theory Final Exam"; ?>" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " >
					  <input type="label" value="<?php echo $stdr['FinalExam']; ?>" name="finalexam" id="finalexam<?php echo $count; ?>" style="width:30px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/>
					</span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Theory Final Exam"; ?>" id="<?php echo $stdr['stdid'];?>" ></a>
				    <input type="label"  name="tom" id="tom<?php echo $count; ?>" style="width:60px; font-weight:bold; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" />
				    <input type="hidden"  name="mp" id="mp<?php echo $count; ?>" style="width:60px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" /></td>
				   	<td class="style4" align="center"><input type="label"  name="grade[]" id="grade<?php echo $count; ?>" style="width:60px; font-weight:bold; text-align:center;" onKeyPress="return handleEnter(this, event);" Readonly="true" />
			   	    <input type="hidden"  name="gp[]" id="gp<?php echo $count; ?>" style="width:60px; text-align:center;" onKeyPress="return handleEnter(this, event);" /></td>
			   	 </tr>
                <script language="javascript">
				$(function () {
					$('#tom<?php echo $count; ?>').ready(function () {
					/*if(parseInt($('#tnd<?php echo $count; ?>').val())<parseInt($('#ad<?php echo $count; ?>').val())){
						alert("Attendanc days can not bigger then total attendanc days");
						$('#ad<?php echo $count; ?>').focus();
						$('#ad<?php echo $count; ?>').val(0);
						return false;
					}*/
					
					var ct=parseFloat($("#classtest<?php echo $count; ?>").val());
					var qt=parseFloat($("#quiztest<?php echo $count; ?>").val());
					var je=parseFloat($("#je<?php echo $count; ?>").val());
					var hw=parseFloat($("#hw<?php echo $count; ?>").val());
					var jer=parseFloat($("#jer<?php echo $count; ?>").val());
					var jev=parseFloat($("#jev<?php echo $count; ?>").val());
					var attnt=parseFloat($("#attendancet<?php echo $count; ?>").val());
					var attnp=parseFloat($("#attendancep<?php echo $count; ?>").val());
					var bhv=parseFloat($("#behavior<?php echo $count; ?>").val());
					var jef=parseFloat($("#jef<?php echo $count; ?>").val());
					var jerf=parseFloat($("#jerf<?php echo $count; ?>").val());
					var jevf=parseFloat($("#jevf<?php echo $count; ?>").val());
					var fex=parseFloat($("#finalexam<?php echo $count; ?>").val());




					$("#tom<?php echo $count; ?>").val(ct+qt+je+hw+jer+jev+attnt+attnp+bhv+jef+jerf+jevf+fex);
					
					//Calculate GPS & Grade
					var TOM = parseInt($("#tom<?php echo $count; ?>").val());
        			var TM = parseInt($("#tm<?php echo $count; ?>").val());
					$("#mp<?php echo $count; ?>").val((TOM/TM)*100);			

					if($('#mp<?php echo $count; ?>').val()>=80){
						$('#grade<?php echo $count; ?>').val("A+");
						$('#gp<?php echo $count; ?>').val("4.00");
					}else if(($('#mp<?php echo $count; ?>').val()>=75)&& ($('#mp<?php echo $count; ?>').val()<80)){
   						$('#grade<?php echo $count; ?>').val("A");
						$('#gp<?php echo $count; ?>').val("3.75");
        			}else if(($('#mp<?php echo $count; ?>').val()>=70)&& ($('#mp<?php echo $count; ?>').val()<75)){
   						$('#grade<?php echo $count; ?>').val("A-");
						$('#gp<?php echo $count; ?>').val("3.50");
					}else if(($('#mp<?php echo $count; ?>').val()>=65)&& ($('#mp<?php echo $count; ?>').val()<70)){
   						$('#grade<?php echo $count; ?>').val("B+");
						$('#gp<?php echo $count; ?>').val("3.25");
        			}else if(($('#mp<?php echo $count; ?>').val()>=60)&& ($('#mp<?php echo $count; ?>').val()<65)){
   						$('#grade<?php echo $count; ?>').val("B");
						$('#gp<?php echo $count; ?>').val("3.00");
					}else if(($('#mp<?php echo $count; ?>').val()>=55)&& ($('#mp<?php echo $count; ?>').val()<60)){
   						$('#grade<?php echo $count; ?>').val("B-");
						$('#gp<?php echo $count; ?>').val("2.75");
        			}else if(($('#mp<?php echo $count; ?>').val()>=50)&& ($('#mp<?php echo $count; ?>').val()<55)){
   						$('#grade<?php echo $count; ?>').val("C+");
						$('#gp<?php echo $count; ?>').val("2.50");
					}else if(($('#mp<?php echo $count; ?>').val()>=45)&& ($('#mp<?php echo $count; ?>').val()<50)){
   						$('#grade<?php echo $count; ?>').val("C");
						$('#gp<?php echo $count; ?>').val("2.25");
        			}else if(($('#mp<?php echo $count; ?>').val()>=40)&& ($('#mp<?php echo $count; ?>').val()<45)){
   						$('#grade<?php echo $count; ?>').val("D");
						$('#gp<?php echo $count; ?>').val("2.00");
        			}else if(($('#mp<?php echo $count; ?>').val()<40)){
   						$('#grade<?php echo $count; ?>').val("F");
						$('#gp<?php echo $count; ?>').val("0.00");
        			}

        			});
					

    			});
				</script>
                 <?php }else{ $bgcolor="#F7FCFF"; ?>
                 <tr bgcolor="<?php echo $bgcolor; ?>">
				<?php 
				  $std="SELECT distinct m.stdid, m.examname, m.session, m.deptid, m.courseid, m.year, m.semesterid, (c.cont_assess_t+c.f_exam_t+c.cont_assess_p+c.f_exam_p) as TotalMarks,
						(select classtestmarks from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]'  and stdid='$crsr[stdid]') as ClassTest,
						(select quiztestmarks from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as QuizTest ,
						(select `hwmarks` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as HomeWork,
						(select `jobexpr` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperiment,
						(select `jobexprfinal` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperimentFinal,
						(select `jobexprreport` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperimentReport,
						(select `jobexprreportfinal` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperimentReportFinal,
						(select `jobexprviva` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperimentViva,
						(select `jobexprvivafinal` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperimentVivaFinal,
						(select `attendancemarks` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as AttendanceT,
						(select `attendancemarksprac` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as AttendanceP,
						(select `behaviormarks` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as Behavior,
						(select `finalexamprac` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as FinalExamPrac,
						(select `finalexammarks` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as FinalExam 
						FROM `tbl_marksentryfinal` m inner join tbl_courses c on m.courseid=c.id WHERE m.deptid='$_POST[deptid]' and m.courseid= '$_GET[courseid]' and m.semesterid='$_POST[semester]' and m.session='$_POST[session]' and m.year='$_POST[year]' and m.stdid='$crsr[stdid]'";	
			      $stdq=$myDb->select($std);
				  
				  $stdr=$myDb->get_row($stdq,'MYSQL_ASSOC'); ?>
                   	<td height="25" class="style4"><?php echo $stdr['stdid'];?><input type="hidden" value="<?php echo $stdr['stdid']; ?>" name="stdid[]" id="stdid" /><input type="hidden" value="<?php echo $stdr['session']; ?>" name="session" id="sessionnew" /><input type="hidden" value="<?php echo $stdr['deptid']; ?>" name="deptid" id="deptid" /><input type="hidden" value="<?php echo $stdr['courseid']; ?>" name="courseid" id="courseid" /><input type="hidden" value="<?php echo $stdr['year']; ?>" name="eyear" id="eyear" /><input type="hidden" value="<?php echo $stdr['semesterid']; ?>" name="semesterid" id="semesterid" /></td>
                   	<td height="25" class="style4" ><div align="center"><input type="label" value="<?php echo $stdr['TotalMarks']; ?>" name="tm" id="tm<?php echo $count; ?>" style="width:50px; font-weight:bold; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" /></div></td>
       
 				   	<td height="25" class="style4" align="center"><a alt="<?php echo "Class Test"; ?>" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="label" value="<?php echo $stdr['ClassTest']; ?>" name="classtest" id="classtest<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" /></span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Quiz Test"; ?>" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="label" value="<?php echo $stdr['QuizTest']; ?>" name="quiztest" id="quiztest<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Job Experiment"; ?>" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="label" value="<?php echo $stdr['JobExperiment']; ?>" name="je" id="je<?php echo $count; ?>" style="width:30px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Home Work"; ?>" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="label" value="<?php echo $stdr['HomeWork']; ?>" name="hw" id="hw<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Job Experiment Report"; ?>" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="label" value="<?php echo $stdr['JobExperimentReport']; ?>" name="jer" id="jer<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Job Experiment Viva"; ?>" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="label" value="<?php echo $stdr['JobExperimentViva']; ?>" name="jev" id="jev<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Behavior"; ?>" id="<?php echo $stdr['stdid'];?>" ></a><a alt="<?php echo "Behavior"; ?>" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " >
					  <input type="label" value="<?php echo $stdr['Behavior']; ?>" name="behavior" id="behavior<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/>
					</span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Attendance Theory Cont"; ?>" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " >
					  <input type="label" value="<?php echo $stdr['AttendanceT']; ?>" name="attendancet" id="attendancet<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" />
					</span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Attendance Practical Cont"; ?>" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " >
					  <input type="label" value="<?php echo $stdr['AttendanceP']; ?>" name="attendancep" id="attendancep<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" />
					</span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Job Experiment Final"; ?>" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="label" value="<?php echo $stdr['JobExperimentFinal']; ?>" name="jef" id="jef<?php echo $count; ?>" style="width:30px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Job Experiment Report Final"; ?>" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="label" value="<?php echo $stdr['JobExperimentReportFinal']; ?>" name="jerf" id="jerf<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Job Experiment Viva Final"; ?>" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="label" value="<?php echo $stdr['JobExperimentVivaFinal']; ?>" name="jevf" id="jevf<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Theory Final Exam"; ?>" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " >
					  <input type="label" value="<?php echo $stdr['FinalExam']; ?>" name="finalexam" id="finalexam<?php echo $count; ?>" style="width:30px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/>
					</span></a></td>
					<td class="style4" align="center"><a alt="<?php echo "Theory Final Exam"; ?>" id="<?php echo $stdr['stdid'];?>" ></a>
				    <input type="label"  name="tom" id="tom<?php echo $count; ?>" style="width:60px; font-weight:bold; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" />
				    <input type="hidden"  name="mp" id="mp<?php echo $count; ?>" style="width:60px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" /></td>
				   	<td class="style4" align="center"><input type="label"  name="grade[]" id="grade<?php echo $count; ?>" style="width:60px; font-weight:bold; text-align:center;" onKeyPress="return handleEnter(this, event);" Readonly="true" />
			   	    <input type="hidden"  name="gp[]" id="gp<?php echo $count; ?>" style="width:60px; text-align:center;" onKeyPress="return handleEnter(this, event);"  /></td>
			   	 </tr>
				 <script language="javascript">
					$(function () {
					$('#tom<?php echo $count; ?>').ready(function () {
					/*if(parseInt($('#tnd<?php echo $count; ?>').val())<parseInt($('#ad<?php echo $count; ?>').val())){
						alert("Attendanc days can not bigger then total attendanc days");
						$('#ad<?php echo $count; ?>').focus();
						$('#ad<?php echo $count; ?>').val(0);
						return false;
					}*/
					
					var ct=parseFloat($("#classtest<?php echo $count; ?>").val());
					var qt=parseFloat($("#quiztest<?php echo $count; ?>").val());
					var je=parseFloat($("#je<?php echo $count; ?>").val());
					var hw=parseFloat($("#hw<?php echo $count; ?>").val());
					var jer=parseFloat($("#jer<?php echo $count; ?>").val());
					var jev=parseFloat($("#jev<?php echo $count; ?>").val());
					var attnt=parseFloat($("#attendancet<?php echo $count; ?>").val());
					var attnp=parseFloat($("#attendancep<?php echo $count; ?>").val());
					var bhv=parseFloat($("#behavior<?php echo $count; ?>").val());
					var jef=parseFloat($("#jef<?php echo $count; ?>").val());
					var jerf=parseFloat($("#jerf<?php echo $count; ?>").val());
					var jevf=parseFloat($("#jevf<?php echo $count; ?>").val());
					var fex=parseFloat($("#finalexam<?php echo $count; ?>").val());




					$("#tom<?php echo $count; ?>").val(ct+qt+je+hw+jer+jev+attnt+attnp+bhv+jef+jerf+jevf+fex);
					
					//Calculate GPS & Grade
					var TOM = parseInt($("#tom<?php echo $count; ?>").val());
        			var TM = parseInt($("#tm<?php echo $count; ?>").val());
					$("#mp<?php echo $count; ?>").val((TOM/TM)*100);			

					if($('#mp<?php echo $count; ?>').val()>=80){
						$('#grade<?php echo $count; ?>').val("A+");
						$('#gp<?php echo $count; ?>').val("4.00");
					}else if(($('#mp<?php echo $count; ?>').val()>=75)&& ($('#mp<?php echo $count; ?>').val()<80)){
   						$('#grade<?php echo $count; ?>').val("A");
						$('#gp<?php echo $count; ?>').val("3.75");
        			}else if(($('#mp<?php echo $count; ?>').val()>=70)&& ($('#mp<?php echo $count; ?>').val()<75)){
   						$('#grade<?php echo $count; ?>').val("A-");
						$('#gp<?php echo $count; ?>').val("3.50");
					}else if(($('#mp<?php echo $count; ?>').val()>=65)&& ($('#mp<?php echo $count; ?>').val()<70)){
   						$('#grade<?php echo $count; ?>').val("B+");
						$('#gp<?php echo $count; ?>').val("3.25");
        			}else if(($('#mp<?php echo $count; ?>').val()>=60)&& ($('#mp<?php echo $count; ?>').val()<65)){
   						$('#grade<?php echo $count; ?>').val("B");
						$('#gp<?php echo $count; ?>').val("3.00");
					}else if(($('#mp<?php echo $count; ?>').val()>=55)&& ($('#mp<?php echo $count; ?>').val()<60)){
   						$('#grade<?php echo $count; ?>').val("B-");
						$('#gp<?php echo $count; ?>').val("2.75");
        			}else if(($('#mp<?php echo $count; ?>').val()>=50)&& ($('#mp<?php echo $count; ?>').val()<55)){
   						$('#grade<?php echo $count; ?>').val("C+");
						$('#gp<?php echo $count; ?>').val("2.50");
					}else if(($('#mp<?php echo $count; ?>').val()>=45)&& ($('#mp<?php echo $count; ?>').val()<50)){
   						$('#grade<?php echo $count; ?>').val("C");
						$('#gp<?php echo $count; ?>').val("2.25");
        			}else if(($('#mp<?php echo $count; ?>').val()>=40)&& ($('#mp<?php echo $count; ?>').val()<45)){
   						$('#grade<?php echo $count; ?>').val("D");
						$('#gp<?php echo $count; ?>').val("2.00");
        			}else if(($('#mp<?php echo $count; ?>').val()<40)){
   						$('#grade<?php echo $count; ?>').val("F");
						$('#gp<?php echo $count; ?>').val("0.00");
        			}

        			});
					

    			});
				</script>
                 <?php }
			  	 	$count++;
			     	}
			  }  
			?>
               </table></td>
              </tr>
             <tr>
               <td height="20" class="style2"><span class="nyroModal"><span class="style4">
<input type="submit"  value="Generate Report" name="B" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />
</span></span></td>
              </tr>
  </table>
</form>

		  	          
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>