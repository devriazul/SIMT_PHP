<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
	$iv="SELECT distinct exammarksper FROM tbl_examinitionsettings WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and examtype='$_POST[examtype]'";
  	$ivq=$myDb->select($iv);
  	$ivrs=$myDb->get_row($ivq,'MYSQL_ASSOC');
	
/*  $chka="SELECT*FROM  tbl_accdtl WHERE flname='semesterwisesubject_search.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){*/
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

<script language="javascript">
 $(document).ready(function(){
   $('.sbmt').click(function(){
     var arr=$('#frm').serializeArray();
	 
	 $.post('updatesubmitstdfinalmarks.php',arr,function(result){
	    $('#shw').html(result);
	 });
	 $('#shw').hide().fadeIn('slow');
   });
 });
</script>
<form name="MyForm" id="frm" autocomplete="off"  method="post" >           
			<table width="100%" border="0" align="left" cellpadding="0" cellspacing="2" id="stdtbl">
             <tr>
               <td height="20" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">Student <?php echo $_POST['examtype'];?> Marks. <span class="style2"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; font-size:14px; color:#666666;"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; font-size:14px; color:#00CCFF">[Base Marks: <?php echo $ivrs['exammarksper'];?>]</span></span> </span> </td>
             </tr>
             <tr>
               <td width="47%" height="20"  class="style2"><table width="100%" border="0" cellspacing="0" align="center" cellpadding="0" id="stdtbl">
                 
                 <?php
			      if(isset($_POST['deptid']) && isset($_POST['session']) && isset($_POST['semester'])){
  				  $crs="SELECT *  FROM tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$_POST[stdid]'";
  				  $crq=$myDb->select($crs);
  				  $crsr=$myDb->get_row($crq,'MYSQL_ASSOC');
				  if(($crsr['classtestmarks']==0) && ($crsr['quiztestmarks']==0) && ($crsr['hwmarks']==0) && ($crsr['jobexpr']==0) && ($crsr['jobexprfinal']==0) && ($crsr['jobexprreport']==0) && ($crsr['jobexprreportfinal']==0) && ($crsr['jobexprviva']==0) && ($crsr['jobexprvivafinal']==0) && ($crsr['attendancemarks']==0) && ($crsr['attendancemarksprac']==0) && ($crsr['behaviormarks']==0) && ($crsr['finalexammarks']==0))
				  {
					?><span style="color:#FF0000"><?php echo "No Record Found."; ?></span> <?php 
					exit;
				  
				  }else { ?>
				  <tr bgcolor="#DFF4FF">
                   <td width="157" height="25" class="style15">Student ID </td>
                   <td width="216" height="25" class="style15"><div align="left">Student Name</div></td>
                   <td width="101" height="25" class="style15"><div align="center">Final Marks</div></td>
                  </tr>
				  <?php
				  //$std="SELECT m.id, m.stdid, m.marks , e.examname, e.examtype, s.stdname FROM `tbl_marksentryprimary` m inner join tbl_examinitionsettings e on e.id=m.examid inner join tbl_stdinfo s on m.stdid=s.stdid WHERE e.deptid='$_POST[deptid]' and e.session='$_POST[session]' and e.courseid='$_GET[courseid]' and e.semesterid='$_POST[semester]' and e.examtype='$_POST[examtype]' ";
				  $std="SELECT m.*, s.stdname FROM tbl_marksentryfinal m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.stdid='$_POST[stdid]' and m.deptid='$_POST[deptid]' and m.courseid= '$_GET[courseid]' and m.semesterid='$_POST[semester]' and m.session='$_POST[session]' and m.year='$_POST[year]' ";	
			      $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
				  if($count%2==0){
				  $bgcolor="#FFFFFF";
				  ?>
                 <tr bgcolor="<?php echo $bgcolor; ?>">
                   <td height="25" class="style4"><?php echo $stdr['stdid']; ?>
                   <input type="hidden" value="<?php echo $stdr['stdid']; ?>" name="stdid" id="stdid" />
					<input type="hidden" value="<?php echo $stdr['session']; ?>" name="session" id="session" />
					<input type="hidden" value="<?php echo $stdr['deptid']; ?>" name="deptid" id="deptid" />
					<input type="hidden" value="<?php echo $stdr['courseid']; ?>" name="courseid" id="courseid" />
					<input type="hidden" value="<?php echo $stdr['semesterid']; ?>" name="semesterid" id="semesterid" />
					<input type="hidden" value="<?php echo $_POST['examtype']; ?>" name="examtype" id="examtype" />
					<input type="hidden" value="<?php echo $stdr['year']; ?>" name="year" id="year" />
				   </td>
                   <td height="25" class="style4" ><?php echo $stdr['stdname']; ?></td>
                   <td height="25" class="style4" align="center"><input name="fmarks" type="text" class="numbersOnly" id="fmarks" value="<?php if($_POST['examtype']=="Class Test"){echo $stdr['classtestmarks'];} else if($_POST['examtype']=="Quiz Test"){echo $stdr['quiztestmarks'];} else if($_POST['examtype']=="Theory Final Exam"){echo $stdr['finalexammarks'];} else if($_POST['examtype']=="Practical Final Exam"){echo $stdr['finalexamprac'];} else if($_POST['examtype']=="Attendance Theory Cont"){echo $stdr['attendancemarks'];} else if($_POST['examtype']=="Attendance Practical Cont"){echo $stdr['attendancemarksprac'];} else if($_POST['examtype']=="Behavior"){echo $stdr['behaviormarks'];} else if($_POST['examtype']=="Home Work"){echo $stdr['hwmarks'];} else if($_POST['examtype']=="Job/Experiment"){echo $stdr['jobexpr'];} else if($_POST['examtype']=="Job/Experiment Final"){echo $stdr['jobexprfinal'];} else if($_POST['examtype']=="Job/Experiment Report"){echo $stdr['jobexprreport'];} 
					else if($_POST['examtype']=="Job/Experiment Report Final"){echo $stdr['jobexprreportfinal'];} else if($_POST['examtype']=="Job/Experiment Viva"){echo $stdr['jobexprviva'];} else if($_POST['examtype']=="Job/Experiment Viva Final"){echo $stdr['jobexprvivafinal'];} ?>" style="width:90px; height:12px; text-align:center;" onKeyPress="return handleEnter(this, event);" maxlength="3" /></td>
                 </tr>
                 <tr bgcolor="" id="tbl">
                   <td colspan="7"></td>
                 </tr>
                 <?php }else{ $bgcolor="#F7FCFF"; ?>
                 <tr bgcolor="<?php echo $bgcolor; ?>">
                   <td height="25" class="style4"><?php echo $stdr['stdid']; ?>
                    <input type="hidden" value="<?php echo $stdr['stdid']; ?>" name="stdid" id="stdid" />
					<input type="hidden" value="<?php echo $stdr['session']; ?>" name="session" id="session" />
					<input type="hidden" value="<?php echo $stdr['deptid']; ?>" name="deptid" id="deptid" />
					<input type="hidden" value="<?php echo $stdr['courseid']; ?>" name="courseid" id="courseid" />
					<input type="hidden" value="<?php echo $stdr['semesterid']; ?>" name="semesterid" id="semesterid" />
					<input type="hidden" value="<?php echo $_POST['examtype']; ?>" name="examtype" id="examtype" />
					<input type="hidden" value="<?php echo $stdr['year']; ?>" name="year" id="year" />
				   </td>
                   <td height="25" class="style4" ><?php echo $stdr['stdname']; ?></td>
                   <td height="25" class="style4" align="center"><input name="fmarks" type="text" class="numbersOnly" id="fmarks" value="<?php if($_POST['examtype']=="Class Test"){echo $stdr['classtestmarks'];} else if($_POST['examtype']=="Quiz Test"){echo $stdr['quiztestmarks'];} else if($_POST['examtype']=="Theory Final Exam"){echo $stdr['finalexammarks'];} else if($_POST['examtype']=="Practical Final Exam"){echo $stdr['finalexamprac'];} else if($_POST['examtype']=="Attendance Theory Cont"){echo $stdr['attendancemarks'];} else if($_POST['examtype']=="Attendance Practical Cont"){echo $stdr['attendancemarksprac'];} else if($_POST['examtype']=="Behavior"){echo $stdr['behaviormarks'];} else if($_POST['examtype']=="Home Work"){echo $stdr['hwmarks'];} else if($_POST['examtype']=="Job/Experiment"){echo $stdr['jobexpr'];} else if($_POST['examtype']=="Job/Experiment Final"){echo $stdr['jobexprfinal'];} else if($_POST['examtype']=="Job/Experiment Report"){echo $stdr['jobexprreport'];} 
					else if($_POST['examtype']=="Job/Experiment Report Final"){echo $stdr['jobexprreportfinal'];} else if($_POST['examtype']=="Job/Experiment Viva"){echo $stdr['jobexprviva'];} else if($_POST['examtype']=="Job/Experiment Viva Final"){echo $stdr['jobexprvivafinal'];} ?>" style="width:90px; height:12px; text-align:center;" onKeyPress="return handleEnter(this, event);" maxlength="3" /></td>
                 </tr>
                 <?php }
			  	 	$count++;
			     	}
				 }
				
			  }  

			?>
               </table></td>
              </tr>
             <tr>
               <td height="20" class="style2"><span class="nyroModal"><span class="style4">
                 <input type="button" class="sbmt" value="Update Marks" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />
               </span></span></td>
              </tr>
             <tr>
               <td height="20" class="style2"><div id="shw"></div></td>
              </tr>
  </table>
</form>

		  	          
<?php 
/*   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 
*/
}else{
  header("Location:login.php");
}
}  
?>