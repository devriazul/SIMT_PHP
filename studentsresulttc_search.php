<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='studentmarksidwise.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
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

<style type="text/css">
<!--
@import url("main.css");
.style17 {font-weight: bold}

-->
</style>





<form name="MyForm" action="rptstudentresultstc.php" id="frm" autocomplete="off"  method="post"  target="_blank">           
			<table width="98%" border="0" align="left" cellpadding="0" cellspacing="2" id="stdtbl">
             <tr>
               <td height="20" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">&nbsp;</td>
             </tr>
             <tr>
               <td height="32" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><table width="100%"  border="0" cellpadding="0" cellspacing="2" bgcolor="#FFFFFF">
                 <tr bgcolor="#DFF4FF">
                   <td width="27%" height="23"><strong>Theory Contineous (TC) : </strong></td>
                   <td width="27%">Class Test </td>
                   <td width="21%">Quiz Test </td>
                   <td width="25%">Attendace Theory Contineous</td>
                 </tr>
               </table></td>
             </tr>
             <tr>
               <td width="47%" height="20" class="style2"><table width="100%" border="0" cellspacing="0" cellpadding="0" id="stdtbl">
                 
                 
				  <tr bgcolor="#DFF4FF">
                   <td width="286" height="25" class="gridTblHead">Student Name </td>
                   <td width="131" class="gridTblHead"><div align="center">Total Marks(TC) </div></td>
                   <td width="78" height="25" class="gridTblHead"><div align="center">Class Test</div></td>
                   <td width="74" class="gridTblHead"><div align="center">Quiz Test</div></td>
				   <td width="253" class="gridTblHead"><div align="center">Attandence Theory Contineous</div></td>
				   <td width="168" class="gridTblHead"><div align="center">Total Obtained Marks</div></td>
			      </tr>					
				<?php //echo $_GET['courseid']; exit;
			      if(isset($_POST['deptid']) && isset($_POST['session']) && isset($_POST['semester'])){
  				  $crs="SELECT mf.stdid FROM tbl_marksentryfinal mf WHERE mf.deptid='$_POST[deptid]' and mf.courseid= '$_GET[courseid]' and mf.semesterid='$_POST[semester]' and mf.session='$_POST[session]' and mf.year='$_POST[year]'"; // and examtype='$_POST[examtype]'"; 
  				  
				  $crq=$myDb->select($crs); 
				  $count=0;
  				  while($crsr=$myDb->get_row($crq,'MYSQL_ASSOC')){
				  if($count%2==0){
				  $bgcolor="#FFFFFF";
				  ?>
                 <tr bgcolor="<?php echo $bgcolor; ?>"><?php 
				  $std="SELECT distinct m.stdid, s.stdname, s.boardrollno, m.examname, m.session, m.deptid, m.courseid, m.year, m.semesterid, c.cont_assess_t,(c.cont_assess_t+c.f_exam_t+c.cont_assess_p+c.f_exam_p) as TotalMarks,
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
						FROM `tbl_marksentryfinal` m inner join tbl_courses c on m.courseid=c.id inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.courseid= '$_GET[courseid]' and m.semesterid='$_POST[semester]' and m.session='$_POST[session]' and m.year='$_POST[year]' and m.stdid='$crsr[stdid]'";	
			      $stdq=$myDb->select($std);
				  
				  $stdr=$myDb->get_row($stdq,'MYSQL_ASSOC'); ?>
				  
                   	<td height="25" class="gridTblValue"><?php echo $stdr['stdname']." (".$stdr['boardrollno'].")";?>
               	   <input type="hidden" value="<?php echo $stdr['stdid']; ?>" name="stdid" id="stdid" /><input type="hidden" value="<?php echo $stdr['session']; ?>" name="session" id="sessionnew" /><input type="hidden" value="<?php echo $stdr['deptid']; ?>" name="deptid" id="deptid" /><input type="hidden" value="<?php echo $stdr['courseid']; ?>" name="courseid" id="courseid" /><input type="hidden" value="<?php echo $stdr['year']; ?>" name="eyear" id="eyear" /><input type="hidden" value="<?php echo $stdr['semesterid']; ?>" name="semesterid" id="semesterid" /></td>
                   	<td class="gridTblValue" align="center"><a  id="<?php echo $stdr['stdid'];?>" alt="<?php echo "Class Test"; ?>" ><strong><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; " ><?php echo $stdr['cont_assess_t']; ?></span></strong></a></td>
                   	<td height="25" class="gridTblValue" align="center"><a alt="<?php echo "Class Test"; ?>"  id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; " ><?php echo $stdr['ClassTest']; ?></span></a></td>
					<td class="gridTblValue" align="center"><a alt="<?php echo "Quiz Test"; ?>"  id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; " ><?php echo $stdr['QuizTest']; ?></span></a></td>
					<td class="gridTblValue" align="center"><a alt="<?php echo "Attendance Theory Cont"; ?>"  id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px;  " ><?php echo $stdr['AttendanceT']; ?>
					</span></a></td>
					<td align="center" class="gridTblValue style17">
				      <?php echo $stdr['ClassTest']+$stdr['QuizTest']+$stdr['AttendanceT']; ?> </td>
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
					//var je=parseFloat($("#je<?php echo $count; ?>").val());
					//var hw=parseFloat($("#hw<?php echo $count; ?>").val());
					//var jer=parseFloat($("#jer<?php echo $count; ?>").val());
					//var jev=parseFloat($("#jev<?php echo $count; ?>").val());
					var attnt=parseFloat($("#attendancet<?php echo $count; ?>").val());
					//var attnp=parseFloat($("#attendancep<?php echo $count; ?>").val());
					//var bhv=parseFloat($("#behavior<?php echo $count; ?>").val());
					//var jef=parseFloat($("#jef<?php echo $count; ?>").val());
					//var jerf=parseFloat($("#jerf<?php echo $count; ?>").val());
					//var jevf=parseFloat($("#jevf<?php echo $count; ?>").val());
					//var fex=parseFloat($("#finalexam<?php echo $count; ?>").val());




					$("#tom<?php echo $count; ?>").val(ct+qt+attnt);
					
					//Calculate GPS & Grade
					/*var TOM = parseInt($("#tom<?php echo $count; ?>").val());
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
        			}*/

        			});
					

    			});
				</script>
                 <?php }else{ $bgcolor="#F7FCFF"; ?>
                 <tr bgcolor="<?php echo $bgcolor; ?>">
				<?php 
				  $std="SELECT distinct m.stdid, s.stdname, s.boardrollno, m.examname, m.session, m.deptid, m.courseid, m.year, m.semesterid, c.cont_assess_t, (c.cont_assess_t+c.f_exam_t+c.cont_assess_p+c.f_exam_p) as TotalMarks,
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
						FROM `tbl_marksentryfinal` m inner join tbl_courses c on m.courseid=c.id inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.courseid= '$_GET[courseid]' and m.semesterid='$_POST[semester]' and m.session='$_POST[session]' and m.year='$_POST[year]' and m.stdid='$crsr[stdid]'";	
			      $stdq=$myDb->select($std);
				  
				  $stdr=$myDb->get_row($stdq,'MYSQL_ASSOC'); ?>
                   	<td height="25" class="gridTblValue"><?php echo $stdr['stdname']." (".$stdr['boardrollno'].")";?>
               	   <input type="hidden" value="<?php echo $stdr['stdid']; ?>" name="stdid" id="stdid" /><input type="hidden" value="<?php echo $stdr['session']; ?>" name="session" id="sessionnew" /><input type="hidden" value="<?php echo $stdr['deptid']; ?>" name="deptid" id="deptid" /><input type="hidden" value="<?php echo $stdr['courseid']; ?>" name="courseid" id="courseid" /><input type="hidden" value="<?php echo $stdr['year']; ?>" name="eyear" id="eyear" /><input type="hidden" value="<?php echo $stdr['semesterid']; ?>" name="semesterid" id="semesterid" /></td>
                   	<td class="gridTblValue" align="center"><a  id="<?php echo $stdr['stdid'];?>" alt="<?php echo "Class Test"; ?>" ><strong><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; " ><?php echo $stdr['cont_assess_t']; ?></span></strong></a></td>
                   	<td height="25" class="gridTblValue" align="center"><a alt="<?php echo "Class Test"; ?>"  id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; " ><?php echo $stdr['ClassTest']; ?></span></a></td>
					<td class="gridTblValue" align="center"><a alt="<?php echo "Quiz Test"; ?>"  id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; " ><?php echo $stdr['QuizTest']; ?></span></a></td>
					<td class="gridTblValue" align="center"><a alt="<?php echo "Attendance Theory Cont"; ?>"  id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px;  " ><?php echo $stdr['AttendanceT']; ?>
					</span></a></td>
					<td align="center" class="gridTblValue style17">
				      <?php echo $stdr['ClassTest']+$stdr['QuizTest']+$stdr['AttendanceT']; ?> </td>
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
					//var je=parseFloat($("#je<?php echo $count; ?>").val());
					//var hw=parseFloat($("#hw<?php echo $count; ?>").val());
					//var jer=parseFloat($("#jer<?php echo $count; ?>").val());
					//var jev=parseFloat($("#jev<?php echo $count; ?>").val());
					var attnt=parseFloat($("#attendancet<?php echo $count; ?>").val());
					//var attnp=parseFloat($("#attendancep<?php echo $count; ?>").val());
					//var bhv=parseFloat($("#behavior<?php echo $count; ?>").val());
					//var jef=parseFloat($("#jef<?php echo $count; ?>").val());
					//var jerf=parseFloat($("#jerf<?php echo $count; ?>").val());
					//var jevf=parseFloat($("#jevf<?php echo $count; ?>").val());
					//var fex=parseFloat($("#finalexam<?php echo $count; ?>").val());




					$("#tom<?php echo $count; ?>").val(ct+qt+attnt);
					
					//Calculate GPS & Grade
					/*var TOM = parseInt($("#tom<?php echo $count; ?>").val());
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
					*/
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
                 <input type="submit"  value="Generate Report" name="B" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />
              </tr>
  </table>
</form>

		  	          
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}