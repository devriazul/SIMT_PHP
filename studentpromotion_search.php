<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='studentpromotion.php' AND userid='$_SESSION[userid]'";
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
                var examname=$(this).attr('alt');
       			var count=$('#count').val();
				var session=$('#sessionnew').val();
				var deptid=$('#deptid').val();
				var courseid=$('#courseid').val();
				var eyear=$('#eyear').val();
				var semesterid=$('#semesterid').val();

				$.nyroModalManual({
					url: 'editstudentsmarksfinalbyec.php?id='+categoryId +'&session='+session +'&examname='+examname +'&deptid='+deptid +'&courseid='+courseid +'&eyear='+eyear +'&semesterid='+semesterid,
					width: 550, // default Width If null, will be calculate automatically
					height: 200, // default Height If null, will be calculate automatically
					minWidth: null, // Minimum width
					minHeight: null, // Minimum height
					//endRemove: function() {window.location.reload()}

				});
			});
			
			
			
		});
		</script>



<script language="javascript">
 $(document).ready(function(){
   $('.sbmt').click(function(){
     var arr=$('#frm').serializeArray();
	 
	 $.post('insstudentpromotion.php',arr,function(result){
	    $('#shw').html(result);
	 });
	 $('#shw').hide().fadeIn('slow');
   });
 });
</script>
<form name="MyForm" id="frm" autocomplete="off"  method="post" >           
			<table width="96%" border="0" align="left" cellpadding="0" cellspacing="2" id="stdtbl">
             <tr>
               <td width="47%" height="20" class="style2"><table width="99%" border="0" cellspacing="0" cellpadding="0" id="stdtbl">
                 
                 
				  <tr bgcolor="#DFF4FF">
                   <td width="162" height="25" class="style2">Student ID 
                    <div align="center"></div>                     <div align="center"></div></td>
                   <td width="350" class="style2"><div align="left">Student Name </div></td>
                   <td width="119" class="style2"><div align="center">Total Marks</div></td>
                   <td width="160" class="style2"><div align="center">Total Obtained Marks</div></td>
				   <td width="87" class="style2"><div align="center">GPA</div></td>
				   <td width="104" class="style2"><div align="center">Grade</div></td>
				  </tr>					
				<?php
			      if(isset($_POST['deptid']) && isset($_POST['session']) && isset($_POST['semester'])){
  				  $crs="SELECT distinct stdid FROM tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]'";// and examtype='$_POST[examtype]'";
  				  
				  $crq=$myDb->select($crs); 
				  $count=0;
  				  while($crsr=$myDb->get_row($crq,'MYSQL_ASSOC')){
					
  				  $chk="SELECT * FROM tbl_stdpromotiontrace WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]'";// and examtype='$_POST[examtype]'";
				  $qhk=$myDb->select($chk);
  				  $rchk=$myDb->get_row($qhk,'MYSQL_ASSOC'); 
				  if(($rchk['deptid'] == $_POST['deptid']) && ($rchk['semesterid'] == $_POST['semester']) && ($rchk['session'] == $_POST['session']))
				  {
					?><span style="color:#FF0000"><?php echo "SORRY!!! Selected Options Final Marks Already Submited. Please try different combination."; ?></span> <?php 
					exit;
				  }
				  else{
				  if($count%2==0){
				  $bgcolor="#FFFFFF";
				  ?>
                 <tr bgcolor="<?php echo $bgcolor; ?>"><?php 
				  $std="SELECT distinct m.stdid, s.stdname, m.deptid, m.semesterid, s.stdcursemester, m.session, SUM(c.cont_assess_t+c.f_exam_t+c.cont_assess_p+c.f_exam_p) as TotalMarks,
						(select SUM(classtestmarks) as classtestmarks from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]'  and stdid='$crsr[stdid]') as ClassTest,
						(select SUM(quiztestmarks) as quiztestmarks  from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as QuizTest ,
						(select SUM(`hwmarks`) as hwmarks from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as HomeWork,
						(select SUM(`jobexpr`) as jobexpr from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperiment,
						(select SUM(`jobexprfinal`) as jobexprfinal from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperimentFinal,
						(select SUM(`jobexprreport`) as jobexprreport from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperimentReport,
						(select SUM(`jobexprreportfinal`) as jobexprreportfinal from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperimentReportFinal,
						(select SUM(`jobexprviva`) as jobexprviva from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperimentViva,
						(select SUM(`jobexprvivafinal`) as jobexprvivafinal from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperimentVivaFinal,
						(select SUM(`attendancemarks`) as attendancemarks from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as AttendanceT,
						(select SUM(`attendancemarksprac`) as attendancemarksprac from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as AttendanceP,
						(select SUM(`behaviormarks`) as behaviormarks from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as Behavior,
						(select SUM(`finalexamprac`) as finalexamprac from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as FinalExamPrac,
						(select SUM(`finalexammarks`) as finalexammarks from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as FinalExam 
						FROM `tbl_marksentryfinal` m inner join tbl_courses c on m.courseid=c.id inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.semesterid='$_POST[semester]' and m.session='$_POST[session]' and m.year='$_POST[year]' and m.stdid='$crsr[stdid]' GROUP BY m.stdid, s.stdname, m.deptid, m.semesterid, s.stdcursemester, m.session";	
			      $stdq=$myDb->select($std);
				  
				  $stdr=$myDb->get_row($stdq,'MYSQL_ASSOC'); ?>
				  
                   	<td height="25" class="style4"><?php echo $stdr['stdid'];?><input type="hidden" value="<?php echo $stdr['stdid']; ?>" name="stdid[]" id="stdid" /><input type="hidden" value="<?php echo $stdr['session']; ?>" name="session" id="sessionnew" /><input type="hidden" value="<?php echo $stdr['deptid']; ?>" name="deptid" id="deptid" />
                   	  <input type="hidden" value="<?php echo $stdr['year']; ?>" name="eyear" id="eyear" /><input type="hidden" value="<?php echo $stdr['semesterid']; ?>" name="semesterid" id="semesterid" /><input type="hidden" value="<?php echo $stdr['stdcursemester']; ?>" name="cursemesterid" id="cursemesterid" />                   	  <div align="center">
                 	    </div>                   	  <a alt="<?php echo "Class Test"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="hidden" value="<?php echo $stdr['ClassTest']; ?>" name="classtest" id="classtest<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" /></span></a><a alt="<?php echo "Quiz Test"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="hidden" value="<?php echo $stdr['QuizTest']; ?>" name="quiztest" id="quiztest<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a><a alt="<?php echo "Job Experiment"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="hidden" value="<?php echo $stdr['JobExperiment']; ?>" name="je" id="je<?php echo $count; ?>" style="width:30px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a><a alt="<?php echo "Home Work"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="hidden" value="<?php echo $stdr['HomeWork']; ?>" name="hw" id="hw<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a><a alt="<?php echo "Job Experiment Report"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="hidden" value="<?php echo $stdr['JobExperimentReport']; ?>" name="jer" id="jer<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a><a alt="<?php echo "Job Experiment Viva"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="hidden" value="<?php echo $stdr['JobExperimentViva']; ?>" name="jev" id="jev<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a><a alt="<?php echo "Behavior"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ></a><a alt="<?php echo "Behavior"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " >
					  <input type="hidden" value="<?php echo $stdr['Behavior']; ?>" name="behavior" id="behavior<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/>
					</span></a><a alt="<?php echo "Attendance Theory Cont"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " >
					  <input type="hidden" value="<?php echo $stdr['AttendanceT']; ?>" name="attendancet" id="attendancet<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" />
					</span></a><a alt="<?php echo "Attendance Practical Cont"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " >
                    <a alt="<?php echo "Attendance Practical Cont"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " >
                    <input type="hidden" value="<?php echo $stdr['AttendanceP']; ?>" name="attendancep" id="attendancep<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" />
                    </span></a> </span></a><a alt="<?php echo "Job Experiment Final"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="hidden" value="<?php echo $stdr['JobExperimentFinal']; ?>" name="jef" id="jef<?php echo $count; ?>" style="width:30px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a><a alt="<?php echo "Job Experiment Report Final"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="hidden" value="<?php echo $stdr['JobExperimentReportFinal']; ?>" name="jerf" id="jerf<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a><a alt="<?php echo "Job Experiment Viva Final"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="hidden" value="<?php echo $stdr['JobExperimentVivaFinal']; ?>" name="jevf" id="jevf<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a><a alt="<?php echo "Theory Final Exam"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " >
					  <input type="hidden" value="<?php echo $stdr['FinalExam']; ?>" name="finalexam" id="finalexam<?php echo $count; ?>" style="width:30px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/>
					</span></a></td>
                   	<td class="style4" align="left"><?php echo $stdr['stdname'];?>
               	    <div align="left"></div></td>
                   	<td class="style4" align="center"><div align="center"><input type="text" value="<?php echo $stdr['TotalMarks']; ?>" name="tm" id="tm<?php echo $count; ?>" style="width:50px; font-weight:bold; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" /></div></td>
					<td class="style4" align="center"><a alt="<?php echo "Theory Final Exam"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ></a>
				    <input type="text"  name="tom" id="tom<?php echo $count; ?>" style="width:100px; font-weight:bold; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" />
				    <input type="hidden"  name="mp" id="mp<?php echo $count; ?>" style="width:60px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" /></td>
				   	<td class="style4" align="center"><input type="text"  name="gp[]" id="gp<?php echo $count; ?>" style="width:60px; font-weight:bold; text-align:center;" onKeyPress="return handleEnter(this, event);" readonly="true" /></td>
				   	<td class="style4" align="center"><input type="text"  name="grade[]" id="grade<?php echo $count; ?>" style="width:60px; font-weight:bold; text-align:center;" onKeyPress="return handleEnter(this, event);" Readonly="true" />
			   	    </td>
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
				  $std="SELECT distinct m.stdid, s.stdname, m.deptid, m.semesterid, s.stdcursemester, m.session, SUM(c.cont_assess_t+c.f_exam_t+c.cont_assess_p+c.f_exam_p) as TotalMarks,
						(select SUM(classtestmarks) as classtestmarks from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]'  and stdid='$crsr[stdid]') as ClassTest,
						(select SUM(quiztestmarks) as quiztestmarks  from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as QuizTest ,
						(select SUM(`hwmarks`) as hwmarks from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as HomeWork,
						(select SUM(`jobexpr`) as jobexpr from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperiment,
						(select SUM(`jobexprfinal`) as jobexprfinal from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperimentFinal,
						(select SUM(`jobexprreport`) as jobexprreport from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperimentReport,
						(select SUM(`jobexprreportfinal`) as jobexprreportfinal from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperimentReportFinal,
						(select SUM(`jobexprviva`) as jobexprviva from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperimentViva,
						(select SUM(`jobexprvivafinal`) as jobexprvivafinal from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as JobExperimentVivaFinal,
						(select SUM(`attendancemarks`) as attendancemarks from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as AttendanceT,
						(select SUM(`attendancemarksprac`) as attendancemarksprac from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as AttendanceP,
						(select SUM(`behaviormarks`) as behaviormarks from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as Behavior,
						(select SUM(`finalexamprac`) as finalexamprac from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as FinalExamPrac,
						(select SUM(`finalexammarks`) as finalexammarks from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$crsr[stdid]') as FinalExam 
						FROM `tbl_marksentryfinal` m inner join tbl_courses c on m.courseid=c.id inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.semesterid='$_POST[semester]' and m.session='$_POST[session]' and m.year='$_POST[year]' and m.stdid='$crsr[stdid]' GROUP BY m.stdid, s.stdname, m.deptid, m.semesterid, s.stdcursemester, m.session";	
			      $stdq=$myDb->select($std);
				  
				  $stdr=$myDb->get_row($stdq,'MYSQL_ASSOC'); ?>
                   	<td height="25" class="style4"><?php echo $stdr['stdid'];?><input type="hidden" value="<?php echo $stdr['stdid']; ?>" name="stdid[]" id="stdid" /><input type="hidden" value="<?php echo $stdr['session']; ?>" name="session" id="sessionnew" /><input type="hidden" value="<?php echo $stdr['deptid']; ?>" name="deptid" id="deptid" />
                   	  <input type="hidden" value="<?php echo $stdr['year']; ?>" name="eyear" id="eyear" /><input type="hidden" value="<?php echo $stdr['semesterid']; ?>" name="semesterid" id="semesterid" /> <input type="hidden" value="<?php echo $stdr['stdcursemester']; ?>" name="cursemesterid" id="cursemesterid" />                  	  <div align="center">
                 	    </div>                   	  <a alt="<?php echo "Class Test"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="hidden" value="<?php echo $stdr['ClassTest']; ?>" name="classtest" id="classtest<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" /></span></a><a alt="<?php echo "Quiz Test"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="hidden" value="<?php echo $stdr['QuizTest']; ?>" name="quiztest" id="quiztest<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a><a alt="<?php echo "Job Experiment"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="hidden" value="<?php echo $stdr['JobExperiment']; ?>" name="je" id="je<?php echo $count; ?>" style="width:30px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a><a alt="<?php echo "Home Work"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="hidden" value="<?php echo $stdr['HomeWork']; ?>" name="hw" id="hw<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a><a alt="<?php echo "Job Experiment Report"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="hidden" value="<?php echo $stdr['JobExperimentReport']; ?>" name="jer" id="jer<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a><a alt="<?php echo "Job Experiment Viva"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="hidden" value="<?php echo $stdr['JobExperimentViva']; ?>" name="jev" id="jev<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a><a alt="<?php echo "Behavior"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ></a><a alt="<?php echo "Behavior"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " >
					  <input type="hidden" value="<?php echo $stdr['Behavior']; ?>" name="behavior" id="behavior<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/>
					</span></a><a alt="<?php echo "Attendance Theory Cont"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " >
					  <input type="hidden" value="<?php echo $stdr['AttendanceT']; ?>" name="attendancet" id="attendancet<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" />
					</span></a><a alt="<?php echo "Attendance Practical Cont"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " >
					  <input type="hidden" value="<?php echo $stdr['AttendanceP']; ?>" name="attendancep" id="attendancep<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" />
					</span></a><a alt="<?php echo "Job Experiment Final"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="hidden" value="<?php echo $stdr['JobExperimentFinal']; ?>" name="jef" id="jef<?php echo $count; ?>" style="width:30px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a><a alt="<?php echo "Job Experiment Report Final"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="hidden" value="<?php echo $stdr['JobExperimentReportFinal']; ?>" name="jerf" id="jerf<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a><a alt="<?php echo "Job Experiment Viva Final"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " ><input type="hidden" value="<?php echo $stdr['JobExperimentVivaFinal']; ?>" name="jevf" id="jevf<?php echo $count; ?>" style="width:20px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/></span></a><a alt="<?php echo "Theory Final Exam"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " >
					  <input type="hidden" value="<?php echo $stdr['FinalExam']; ?>" name="finalexam" id="finalexam<?php echo $count; ?>" style="width:30px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled"/>
					</span></a></td>
                   	<td class="style4" align="left"><?php echo $stdr['stdname'];?>
               	    <div align="left"></div></td>
                   	<td class="style4" align="center"><div align="center"><input type="text" value="<?php echo $stdr['TotalMarks']; ?>" name="tm" id="tm<?php echo $count; ?>" style="width:50px; font-weight:bold; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" /></div></td>
					<td class="style4" align="center"><a alt="<?php echo "Theory Final Exam"; ?>" class="add_categoryfm" id="<?php echo $stdr['stdid'];?>" ></a>
				    <input type="text"  name="tom" id="tom<?php echo $count; ?>" style="width:100px; font-weight:bold; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" />
				    <input type="hidden"  name="mp" id="mp<?php echo $count; ?>" style="width:60px; text-align:center;" onKeyPress="return handleEnter(this, event);" disabled="disabled" /></td>
				   	<td class="style4" align="center"><input type="text"  name="gp[]" id="gp<?php echo $count; ?>" style="width:60px; font-weight:bold; text-align:center;" onKeyPress="return handleEnter(this, event);" readonly="true"/></td>
				   	<td class="style4" align="center"><input type="text"  name="grade[]" id="grade<?php echo $count; ?>" style="width:60px; font-weight:bold; text-align:center;" onKeyPress="return handleEnter(this, event);" Readonly="true" /></td>
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
			  }  
			?>
               </table></td>
              </tr>
             <tr>
               <td height="20" class="style2"><span class="style4">
                 <input type="button" class="sbmt" value="Proceed Students to Next Semester" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />
               </span></span><div id="shw"></td>
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