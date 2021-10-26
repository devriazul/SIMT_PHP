<?php 
ob_start();
session_start();
include("../config.php"); 
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


<form name="MyForm" action="rptstudentresults.php" id="frm" autocomplete="off"  method="post"  target="_blank">           
			<table width="100%" border="0" align="left" cellpadding="0" cellspacing="2" id="stdtbl">
             <tr>
               <td height="20" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; font-size:14px; color:#666666;">Student <?php echo $_POST['examtype'];?> Marks.<span style="font:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; font-size:14px; color:#00CCFF"> [Base Marks: <?php echo $ivrs['exammarksper'];?><span class="style4">
               <span style="font:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; font-size:14px; color:#666666;"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; font-size:14px; color:#00CCFF">
               <input name="marksper" type="hidden" class="numbersOnly" id="marksper"  style="width:90px; height:12px; text-align:center;" value="<?php echo $ivrs['exammarksper'];?>" maxlength="3" />
               </span></span> </span>]</span></span> </td>
             </tr>
             <tr>
               <td width="47%" height="20" class="style2"><table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" class="gridTbl">
                 
                 <?php
			      if(isset($_POST['deptid']) && isset($_POST['session']) && isset($_POST['semester'])){
  				  if($_POST['section']=="A")
				  {
				  		$crs="SELECT distinct examstatusA as examstatus, resultstatusA  as resultstatus FROM tbl_examinitionsettings WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and examtype='$_POST[examtype]'";
  				  		$crq=$myDb->select($crs);
  				  }
  				  else if($_POST['section']=="B")
				  {
				  		$crs="SELECT distinct examstatusB as examstatus, resultstatusB  as resultstatus FROM tbl_examinitionsettings WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and examtype='$_POST[examtype]'";
  				  		$crq=$myDb->select($crs);
  				  }
  				  else if($_POST['section']=="C")
				  {
				  		$crs="SELECT distinct examstatusC as examstatus, resultstatusC  as resultstatus FROM tbl_examinitionsettings WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and examtype='$_POST[examtype]'";
  				  		$crq=$myDb->select($crs);
  				  }
  				  else if($_POST['section']=="D")
				  {
				  		$crs="SELECT distinct examstatusD as examstatus, resultstatusD  as resultstatus FROM tbl_examinitionsettings WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and examtype='$_POST[examtype]'";
  				  		$crq=$myDb->select($crs);
  				  }
				  while($crsr=$myDb->get_row($crq,'MYSQL_ASSOC')){
				  if(($crsr['examstatus']=="0"))
				  { ?><span style="color:#FF0000"><?php echo "You are not yet taken all the ".$_POST['examtype'].". Please take the ".$_POST['examtype']." First, then try to Submit Final Marks of ". $_POST['examtype']; ?></span> <?php 
					exit;
				  }
				  else { ?>
				  <tr bgcolor="#DFF4FF">
                   <td width="157" height="25" class="gridTblHead style15">Student ID </td>
                   <td width="216" height="25" class="gridTblHead style15"><div align="left">Student Name</div></td>
                   <td width="101" height="25" class="gridTblHead style15"><div align="center">Final Marks</div></td>
                  </tr>
				  <?php
				  	if(($_POST['examtype']=="Theory Final Exam")) 
				  	{ 
				  		$std="SELECT distinct m.id, m.stdid, m.finalexammarks as marks , s.boardrollno, s.session, s.stdname FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[session]' and m.courseid='$_GET[courseid]' and m.semesterid='$_POST[semester]' and s.section='$_POST[section]'  order by m.id";
				  	}
					else if(($_POST['examtype']=="Practical Final Exam")) 
				  	{ 
				  		$std="SELECT distinct m.id, m.stdid, m.finalexamprac as marks , s.boardrollno, s.session, s.stdname FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[session]' and m.courseid='$_GET[courseid]' and m.semesterid='$_POST[semester]' and s.section='$_POST[section]' order by m.id";
				  	} 
					else if(($_POST['examtype']=="Class Test")) 
					{
				  		$std="SELECT distinct m.id, m.stdid, m.classtestmarks as marks , s.boardrollno, s.session, s.stdname FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[session]' and m.courseid='$_GET[courseid]' and m.semesterid='$_POST[semester]' and s.section='$_POST[section]' order by m.id";
			      	}
					else if(($_POST['examtype']=="Quiz Test")) 
					{
				  		$std="SELECT distinct m.id, m.stdid, m.quiztestmarks as marks , s.boardrollno, s.session, s.stdname FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[session]' and m.courseid='$_GET[courseid]' and m.semesterid='$_POST[semester]' and s.section='$_POST[section]' order by m.id";
			      	}
					else if(($_POST['examtype']=="Job/Experiment")) 
					{
				  		$std="SELECT distinct m.id, m.stdid, m.jobexpr as marks , s.boardrollno, s.session, s.stdname FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[session]' and m.courseid='$_GET[courseid]' and m.semesterid='$_POST[semester]' and s.section='$_POST[section]' order by m.id";
			      	}
					else if(($_POST['examtype']=="Job/Experiment Final")) 
					{
				  		$std="SELECT distinct m.id, m.stdid, m.jobexprfinal as marks , s.boardrollno, s.session, s.stdname FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[session]' and m.courseid='$_GET[courseid]' and m.semesterid='$_POST[semester]' and s.section='$_POST[section]' order by m.id";
			      	}
					else if(($_POST['examtype']=="Home Work")) 
					{
				  		$std="SELECT distinct m.id, m.stdid, m.hwmarks as marks , s.boardrollno, s.session, s.stdname FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[session]' and m.courseid='$_GET[courseid]' and m.semesterid='$_POST[semester]' and s.section='$_POST[section]' order by m.id";
			      	}
					else if(($_POST['examtype']=="Job/Experiment Report")) 
					{
				  		$std="SELECT distinct m.id, m.stdid, m.jobexprreport as marks , s.boardrollno, s.session, s.stdname FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[session]' and m.courseid='$_GET[courseid]' and m.semesterid='$_POST[semester]' and s.section='$_POST[section]' order by m.id";
			      	}
					else if(($_POST['examtype']=="Job/Experiment Report Final")) 
					{
				  		$std="SELECT distinct m.id, m.stdid, m.jobexprreportfinal as marks , s.boardrollno, s.session, s.stdname FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[session]' and m.courseid='$_GET[courseid]' and m.semesterid='$_POST[semester]' and s.section='$_POST[section]' order by m.id";
			      	}
					else if(($_POST['examtype']=="Job/Experiment Viva")) 
					{
				  		$std="SELECT distinct m.id, m.stdid, m.jobexprviva as marks , s.boardrollno, s.session, s.stdname FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[session]' and m.courseid='$_GET[courseid]' and m.semesterid='$_POST[semester]' and s.section='$_POST[section]' order by m.id";
			      	}
					else if(($_POST['examtype']=="Job/Experiment Viva Final")) 
					{
				  		$std="SELECT distinct m.id, m.stdid, m.jobexprvivafinal as marks , s.boardrollno, s.session, s.stdname FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[session]' and m.courseid='$_GET[courseid]' and m.semesterid='$_POST[semester]' and s.section='$_POST[section]' order by m.id";
			      	}
					else if(($_POST['examtype']=="Attendance Theory Cont")) 
					{
				  		$std="SELECT distinct m.id, m.stdid, m.attendancemarks as marks , s.boardrollno, s.session, s.stdname FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[session]' and m.courseid='$_GET[courseid]' and m.semesterid='$_POST[semester]' and s.section='$_POST[section]' order by m.id";
			      	}
					else if(($_POST['examtype']=="Attendance Practical Cont")) 
					{
				  		$std="SELECT distinct m.id, m.stdid, m.attendancemarksprac as marks , s.boardrollno, s.session, s.stdname FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[session]' and m.courseid='$_GET[courseid]' and m.semesterid='$_POST[semester]' and s.section='$_POST[section]' order by m.id";
			      	}
					else if(($_POST['examtype']=="Behavior")) 
					{
				  		$std="SELECT distinct m.id, m.stdid, m.behaviormarks as marks , s.boardrollno, s.session, s.stdname FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[session]' and m.courseid='$_GET[courseid]' and m.semesterid='$_POST[semester]' and s.section='$_POST[section]' order by m.id";
			      	}
				  $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
				  if($count%2==0){
				  $bgcolor="#FFFFFF";
				  ?>
				 
                 <tr bgcolor="<?php echo $bgcolor; ?>">
                   <td height="25" class="gridTblValue style4"><?php echo $stdr['stdid']." (".$stdr['boardrollno'].")"; ?>
                   <input type="hidden" value="<?php echo $stdr['stdid']; ?>" name="stdid[]" id="stdid" />
                   <input type="hidden" value="<?php echo $stdr['session']; ?>" name="sess" id="sess" />					
                   <input type="hidden" value="<?php echo $_POST['deptid']; ?>" name="deptid" id="deptid" />
					<input type="hidden" value="<?php echo $_GET['courseid']; ?>" name="courseid" id="courseid" />
                    <input type="hidden" value="<?php echo $_POST['semester']; ?>" name="semesterid" id="semesterid" />					
                    <input type="hidden" value="<?php echo $_POST['examtype']; ?>" name="examtype" id="examtype" />
					<input type="hidden" value="<?php echo $_POST['year']; ?>" name="year" id="year" />
					<input type="hidden" value="<?php echo $_POST['section']; ?>" name="section" id="section" />
				   </td>
                   <td height="25" class="gridTblValue style4" ><?php echo $stdr['stdname']; ?></td>
					
                   <td height="25" class="gridTblValue style4" align="center"><?php echo $stdr['marks']; ?></td>
                	
				</tr>
                 <tr bgcolor="" id="tbl">
                   <td colspan="7"></td>
                 </tr>
                 <?php }else{ $bgcolor="#F7FCFF"; ?>
				
                 <tr bgcolor="<?php echo $bgcolor; ?>">
                   <td height="25" class="gridTblValue style4"><?php echo $stdr['stdid']." (".$stdr['boardrollno'].")"; ?>
                   <input type="hidden" value="<?php echo $stdr['stdid']; ?>" name="stdid[]" id="stdid" />
					<input type="hidden" value="<?php echo $stdr['session']; ?>" name="sess" id="sess" />
					<input type="hidden" value="<?php echo $_POST['deptid']; ?>" name="deptid" id="deptid" />
					<input type="hidden" value="<?php echo $_GET['courseid']; ?>" name="courseid" id="courseid" />
					<input type="hidden" value="<?php echo $_POST['semester']; ?>" name="semesterid" id="semesterid" />
					<input type="hidden" value="<?php echo $_POST['examtype']; ?>" name="examtype" id="examtype" />
					<input type="hidden" value="<?php echo $_POST['year']; ?>" name="year" id="year" />
					<input type="hidden" value="<?php echo $_POST['section']; ?>" name="section" id="section" />
				   </td>
                   <td height="25" class="gridTblValue style4" ><?php echo $stdr['stdname']; ?></td>
					
                   <td height="25" class="gridTblValue style4" align="center"><?php echo $stdr['marks']; ?></td>
                 </tr>
                 <?php }
			  	 	$count++;
			     	}
                 ?>
                
 
                <?php
				 }
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