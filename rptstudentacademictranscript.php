<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
	if($_SESSION['userid'])
	{
	        $sm="SELECT*FROM  tbl_semester WHERE id='$_POST[semester]'";
  			$csm=$myDb->select($sm);
  			$carsm=$myDb->get_row($csm,'MYSQL_ASSOC');

			     
  			
				

			$iv="SELECT s.*,RIGHT(s.boardrollno,2) as srollno, d.*, d.id as deptid, LEFT(d.name,2) as code, session  from tbl_stdinfo s inner join tbl_department d on s.deptname=d.id Where s.boardrollno='$_POST[stdid]' and s.storedstatus<>'D' ";
  			$ivq=$myDb->select($iv);
  			$ivrs=$myDb->get_row($ivq,'MYSQL_ASSOC');
			
			
			//$crs="SELECT *,LEFT(name,2) as code FROM tbl_department WHERE id='$_POST[deptid]' and storedstatus<>'D'";			  
			//$crq=$myDb->select($crs); 
  			//$crsr=$myDb->get_row($crq,'MYSQL_ASSOC');
			
			$y="SELECT distinct mf.year FROM `tbl_marksentryfinal` mf inner join tbl_stdinfo s on mf.stdid=s.stdid WHERE s.boardrollno='$_POST[stdid]' and mf.semesterid='$_POST[semester]'";
			$yq=$myDb->select($y); 
  			$yrs=$myDb->get_row($yq,'MYSQL_ASSOC');
			
$count=1;
$ht=0;
$sn=1;
$c=1;




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>

<style type="text/css">
<!--
body {

	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
   
#Layer1 {
	position:absolute;
	left:118px;
	top:70px;
	width:123px;
	height:21px;
	z-index:1;
}
.style2 {
	font-family:"Times New Roman";
	font-weight:bold;
	font-size: 14px;
}
.style4 {
	font-family: Times New Roman;
	font-size: 12px;
}
.gs {
	font-family: "Times New Roman";
	font-size: 10px;
}
.mfont {
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style16 {
/*font-family: Verdana, Arial, Helvetica, sans-serif;*/
font-family:Impact;
font-size: 26px;
}

.h {
font-family:Certificate;
font-size:32px; 
text-decoration:underline;
}
-->
#stdtbl{

 border-left:1px solid #333333;
 border-bottom:1px solid #333333;
}
#stdtbl2{
 border-right:1px solid #333333;
 border-bottom:1px solid #333333;
}
#stdtbl td{

 border-top:1px solid #333333;
  border-right:1px solid #333333;

}
#stdtbl2 td{

 border-top:1px solid #333333;
}
.style22 {font-size: 14px}
</style></head>

<body>
<table width="102%" height="890"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" >
  <tr>
    <th rowspan="3" valign="top" scope="col">&nbsp;</th>
    <th height="25" valign="top" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th height="840" valign="top" scope="col"><table width="94%" border="0" align="center" cellpadding="0" cellspacing="0" >
      <tr>
        <td height="69" colspan="2" bgcolor="#FFFFFF"><div align="center" class="style16"></div></td>
      </tr>
      <tr>
        <td height="28" bgcolor="#FFFFFF">
            <div align="left"></div>            <table width="63%"  border="0" align="center" cellpadding="2" cellspacing="0">
              <tr>
                <th width="80%" scope="col"><div align="center">DIPLOMA-IN-ENGINEERING (<span class="style22">Duration: 4-Year</span>)</div></th>
              </tr>
              <tr>
                <td><div align="center"><?php echo $carsm['name']. " EXAMINATION, ".$yrs['year'];?></div></td>
              </tr>
              <tr>
                <td><div align="center"><?php echo "(Held in Month of ".$_POST['heldmonths'].", ".$yrs['year'].")";?></div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
          </table></td>
        <td height="28" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><img src="images/spaer.gif" width="1" height="1" /></td>
      </tr>
      <tr>
        <td width="84%" height="185" align="left" valign="top" ><div align="left"> <span class="mfont">Serial No: <strong><?php echo $ivrs['session'].$ivrs['code'].$ivrs['srollno'];?></strong></span>&nbsp;
          </div>          <div align="right">
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="71%" valign="top"><table width="99%"  border="0" cellspacing="0" cellpadding="1">
                <tr>
                  <td width="21%" class="mfont">Technology</td>
                  <td width="1%">:</td>
                  <td colspan="3" class="mfont"><?php echo $ivrs['name'];?></td>
                </tr>
                <tr>
                  <td class="mfont">Student's Name </td>
                  <td>:</td>
                  <td colspan="3" class="mfont"><?php echo $ivrs['stdname'];?></td>
                </tr>
                <tr>
                  <td class="mfont">Father's Name </td>
                  <td>:</td>
                  <td colspan="3" class="mfont"><?php echo $ivrs['fname'];?></td>
                </tr>
                <tr>
                  <td class="mfont">Mother's Name </td>
                  <td>:</td>
                  <td colspan="3" class="mfont"><?php echo $ivrs['mname'];?></td>
                </tr>
                <tr>
                  <td class="mfont">Board Roll No </td>
                  <td>:</td>
                  <td colspan="3" class="mfont"><?php echo $ivrs['boardrollno'];?></td>
                </tr>
                <tr>
                  <td class="mfont">Registration No </td>
                  <td>:</td>
                  <td width="28%" class="mfont"><?php echo $ivrs['boardregno'];?></td>
                  <td width="32%"><div align="right" class="mfont">Session : <?php echo "20".substr_replace($ivrs['session'],'-20',-2,-2); ?></div></td>
                  <td width="18%"><div align="right"></div></td>
                </tr>
                <tr>
                  <td class="mfont">Institute Name </td>
                  <td>:</td>
                  <td colspan="3" class="mfont">50116-SAIC Institute of Management & Technology, Dhaka.</td>
                </tr>
              </table></td>
              </tr>
          </table>
          </div></td>
        <td width="16%" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" valign="top" ><table width="98%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="84%" valign="top" colspan="2" height="251" ><table width="100%" height="253" border="0" align="left" cellpadding="1" cellspacing="0" bordercolor="#666666" id="stdtbl">
              <tr bgcolor="#CCCCCC">
                <td width="47" height="25" class="style2"><strong>SLNo. </strong></td>
                <td width="150" height="25" class="style2"><strong>Subject Code </strong></td>
                <td width="385" height="25" class="style2"><strong>Name of Subject </strong></td>
                <td width="97" height="25" class="style2"><strong>Full Marks </strong></td>
                <td width="72" height="25" class="style2"><div align="center"><strong>Obtained Marks </strong></div></td>
                <td width="56" height="25" class="style2"><div align="center"><strong><strong>Grade Point(GP)</strong></strong></div></td>
                <td width="135" height="25" class="style2"><strong>Letter Geade</strong></td>
                </tr>
              <?php 
			$crs="SELECT mf.courseid, c.coursecode, c.coursename FROM tbl_courses c inner join tbl_marksentryfinal mf on c.id= mf.courseid inner join tbl_stdinfo s on mf.stdid=s.stdid WHERE mf.deptid='$ivrs[deptid]' and s.boardrollno= '$_POST[stdid]' and mf.semesterid='$_POST[semester]' and mf.session='$ivrs[session]' and mf.year='$yrs[year]' ";
			$crq=$myDb->select($crs); 			
			$tcredit=0; $g=0; 
			$tcgp=0;
			while($crsr=$myDb->get_row($crq,'MYSQL_ASSOC'))
			{
			
				/*echo "SELECT distinct m.stdid, c.credit, right(c.coursecode,4) as coursecode, c.coursename, m.examname, m.session, m.deptid, m.courseid, m.year, m.semesterid, (c.cont_assess_t+c.f_exam_t+c.cont_assess_p+c.f_exam_p) as TotalMarks, c.cont_assess_t,c.f_exam_t,c.cont_assess_p,c.f_exam_p,
						m.classtestmarks,m.quiztestmarks,m.hwmarks,m.jobexpr,m.jobexprfinal,m.jobexprreport,m.jobexprreportfinal,m.jobexprviva,
						m.jobexprvivafinal,m.attendancemarks,m.attendancemarksprac,m.behaviormarks,m.finalexamprac,m.finalexammarks
						FROM `tbl_marksentryfinal` m inner join tbl_courses c on m.courseid=c.id WHERE m.deptid='$_POST[deptid]' and m.courseid= '$crsr[courseid]' and m.semesterid='$_POST[semester]' and m.session='$_POST[session]' and m.year='$_POST[year]' and m.stdid='$_POST[stdid]'"; exit;*/
	
	

			
			
				$query="SELECT distinct m.stdid, c.credit, right(c.coursecode,5) as coursecode, c.coursename, m.examname, m.session, m.deptid, m.courseid, m.year, m.semesterid, (c.cont_assess_t+c.f_exam_t+c.cont_assess_p+c.f_exam_p) as TotalMarks, c.cont_assess_t,c.f_exam_t,c.cont_assess_p,c.f_exam_p,
						m.classtestmarks,m.quiztestmarks,m.hwmarks,m.jobexpr,m.jobexprfinal,m.jobexprreport,m.jobexprreportfinal,m.jobexprviva,
						m.jobexprvivafinal,m.attendancemarks,m.attendancemarksprac,m.behaviormarks,m.finalexamprac,m.finalexammarks,m.midterm,m.assignment,
						((select mf.classtestmarks from tbl_marksentryfinal mf inner join `tbl_stdinfo` s on mf.stdid=s.stdid WHERE mf.deptid='$ivrs[deptid]' and mf.courseid= '$crsr[courseid]' and mf.semesterid='$_POST[semester]' and mf.session='$ivrs[session]' and mf.year='$yrs[year]'  and s.boardrollno='$_POST[stdid]') +
						(select mf.quiztestmarks from tbl_marksentryfinal mf inner join `tbl_stdinfo` s on mf.stdid=s.stdid WHERE mf.deptid='$ivrs[deptid]' and mf.courseid= '$crsr[courseid]' and mf.semesterid='$_POST[semester]' and mf.session='$ivrs[session]' and mf.year='$yrs[year]' and s.boardrollno='$_POST[stdid]') +
						(select mf.`hwmarks` from tbl_marksentryfinal mf inner join `tbl_stdinfo` s on mf.stdid=s.stdid WHERE mf.deptid='$ivrs[deptid]' and mf.courseid= '$crsr[courseid]' and mf.semesterid='$_POST[semester]' and mf.session='$ivrs[session]' and mf.year='$yrs[year]' and s.boardrollno='$_POST[stdid]') +
						(select mf.`jobexpr` from tbl_marksentryfinal mf inner join `tbl_stdinfo` s on mf.stdid=s.stdid WHERE mf.deptid='$ivrs[deptid]' and mf.courseid= '$crsr[courseid]' and mf.semesterid='$_POST[semester]' and mf.session='$ivrs[session]' and mf.year='$yrs[year]' and s.boardrollno='$_POST[stdid]') +
						(select mf.`jobexprfinal` from tbl_marksentryfinal mf inner join `tbl_stdinfo` s on mf.stdid=s.stdid WHERE mf.deptid='$ivrs[deptid]' and mf.courseid= '$crsr[courseid]' and mf.semesterid='$_POST[semester]' and mf.session='$ivrs[session]' and mf.year='$yrs[year]' and s.boardrollno='$_POST[stdid]') +
						(select mf.`jobexprreport` from tbl_marksentryfinal mf inner join `tbl_stdinfo` s on mf.stdid=s.stdid WHERE mf.deptid='$ivrs[deptid]' and mf.courseid= '$crsr[courseid]' and mf.semesterid='$_POST[semester]' and mf.session='$ivrs[session]' and mf.year='$yrs[year]' and s.boardrollno='$_POST[stdid]') +
						(select mf.`jobexprreportfinal` from tbl_marksentryfinal mf inner join `tbl_stdinfo` s on mf.stdid=s.stdid WHERE mf.deptid='$ivrs[deptid]' and mf.courseid= '$crsr[courseid]' and mf.semesterid='$_POST[semester]' and mf.session='$ivrs[session]' and mf.year='$yrs[year]' and s.boardrollno='$_POST[stdid]') +
						(select mf.`jobexprviva` from tbl_marksentryfinal mf inner join `tbl_stdinfo` s on mf.stdid=s.stdid WHERE mf.deptid='$ivrs[deptid]' and mf.courseid= '$crsr[courseid]' and mf.semesterid='$_POST[semester]' and mf.session='$ivrs[session]' and mf.year='$yrs[year]' and s.boardrollno='$_POST[stdid]') +
						(select mf.`jobexprvivafinal` from tbl_marksentryfinal mf inner join `tbl_stdinfo` s on mf.stdid=s.stdid WHERE mf.deptid='$ivrs[deptid]' and mf.courseid= '$crsr[courseid]' and mf.semesterid='$_POST[semester]' and mf.session='$ivrs[session]' and mf.year='$yrs[year]' and s.boardrollno='$_POST[stdid]') +
						(select mf.`attendancemarks` from tbl_marksentryfinal mf inner join `tbl_stdinfo` s on mf.stdid=s.stdid WHERE mf.deptid='$ivrs[deptid]' and mf.courseid= '$crsr[courseid]' and mf.semesterid='$_POST[semester]' and mf.session='$ivrs[session]' and mf.year='$yrs[year]' and s.boardrollno='$_POST[stdid]') +
						(select mf.`attendancemarksprac` from tbl_marksentryfinal mf inner join `tbl_stdinfo` s on mf.stdid=s.stdid WHERE mf.deptid='$ivrs[deptid]' and mf.courseid= '$crsr[courseid]' and mf.semesterid='$_POST[semester]' and mf.session='$ivrs[session]' and mf.year='$yrs[year]' and s.boardrollno='$_POST[stdid]') +
						(select mf.`behaviormarks` from tbl_marksentryfinal mf inner join `tbl_stdinfo` s on mf.stdid=s.stdid WHERE mf.deptid='$ivrs[deptid]' and mf.courseid= '$crsr[courseid]' and mf.semesterid='$_POST[semester]' and mf.session='$ivrs[session]' and mf.year='$yrs[year]' and s.boardrollno='$_POST[stdid]') +
						(select mf.`finalexamprac` from tbl_marksentryfinal mf inner join `tbl_stdinfo` s on mf.stdid=s.stdid WHERE mf.deptid='$ivrs[deptid]' and mf.courseid= '$crsr[courseid]' and mf.semesterid='$_POST[semester]' and mf.session='$ivrs[session]' and mf.year='$yrs[year]' and s.boardrollno='$_POST[stdid]') +
						(select mf.finalexammarks from tbl_marksentryfinal mf inner join `tbl_stdinfo` s on mf.stdid=s.stdid WHERE mf.deptid='$ivrs[deptid]' and mf.courseid= '$crsr[courseid]' and mf.semesterid='$_POST[semester]' and mf.session='$ivrs[session]' and mf.year='$yrs[year]' and s.boardrollno='$_POST[stdid]')) as obtainedmarks
						FROM `tbl_marksentryfinal` m inner join tbl_courses c on m.courseid=c.id inner join `tbl_stdinfo` s on m.stdid=s.stdid WHERE m.deptid='$ivrs[deptid]' and m.courseid= '$crsr[courseid]' and m.semesterid='$_POST[semester]' and m.session='$ivrs[session]' and m.year='$yrs[year]' and s.boardrollno='$_POST[stdid]'";
				$result = mysql_query($query) or die(mysql_error());
			while($row=$myDb->get_row($result,'MYSQL_ASSOC'))
			{
				$sumtc=$row['classtestmarks']+$row['quiztestmarks']+$row['attendancemarks']+$row['midterm']+$row['assignment'];
				$sumpc=($row['jobexpr']+$row['hwmarks']+$row['jobexprreport']+$row['jobexprviva']+$row['attendancemarksprac']+$row['behaviormarks']);
				$sumtf=$row['finalexammarks'];	
				$sumpf=($row['jobexprfinal']+$row['jobexprreportfinal']+$row['jobexprvivafinal']); 
				$ObtainedMarksN = $sumtc+$sumpc+$sumtf+$sumpf;
				
				$totalTFCB=($row['cont_assess_t']+$row['f_exam_t']);
				$totalPFCB=($row['cont_assess_p']+$row['f_exam_p']);
				$totalTFC=0;
				if($sumtf>0||$sumtc>0){
					if($totalTFCB == 0){$totalTFCB =1;}
					$totalTFC=((($sumtf+$sumtc)/$totalTFCB)*100);
				}
				$totalPFC=0;
				if($sumpc>0||$sumpf>0){
					if($totalPFCB == 0){$totalPFCB =1;}
					$totalPFC=((($sumpf+$sumpc)/$totalPFCB)*100);
				}
					
				 
				$mp= ($ObtainedMarksN/$row['TotalMarks'])*100;
				if($mp>=80)
				{
					$grade = "A+";
					$gp = "4.00";
				}
				else if(($mp>=75) && ($mp<80))
				{
					$grade = "A";
					$gp = "3.75";
				}
				else if(($mp>=70) && ($mp<75))
				{
					$grade = "A-";
					$gp = "3.5";
				}
				else if(($mp>=65) && ($mp<70))
				{
					$grade = "B+";
					$gp = "3.25";
				}
				else if(($mp>=60) && ($mp<65))
				{
					$grade = "B";
					$gp = "3.00";
				}
				else if(($mp>=55) && ($mp<60))
				{
					$grade = "B-";
					$gp = "2.75";
				}
				else if(($mp>=50) && ($mp<55))
				{
					$grade = "C+";
					$gp = "2.50";
				}
				else if(($mp>=45) && ($mp<50))
				{
					$grade = "C";
					$gp = "2.25";
				}
				else if(($mp>=40) && ($mp<45))
				{
					$grade = "D";
					$gp = "2.00";
				}
				else if($mp<40)
				{
					$grade = "F";
					$gp = "0.00";
				}
				$gp = $gp;
    			$grade = $grade;
    			$cgp = $row['credit']*$gp;
				$credit=$row['credit']; 
			?>
              <tr>
                <td height="18" class="style4"><?php echo $sn++;?></td>
                <td height="18" bgcolor="#CCCCCC" class="style4"><?php echo $row['coursecode'];?></td>
                <td height="18" class="style4" align="left"><?php echo $row['coursename'];?></td>
                <td height="18" bgcolor="#CCCCCC" class="style4"><?php echo $row['TotalMarks'];?></td>
                <!--td height="18" class="style4"><?php //echo $row['obtainedmarks'];?></td-->
				<td height="18" class="style4"><?php echo $ObtainedMarksN;?></td>
				
				<?php if(($row['cont_assess_t']>0&&$row['f_exam_t']>0&&$row['cont_assess_p']>0&&$row['f_exam_p']>0)){	
				 
							if($totalTFC>=40&&$totalPFC>=40){
								echo "<td height='18' class='style4'>$gp</td>";
								echo "<td height='18' class='style4'>$grade</td>";
							}else{
								$gp=0;
								$grade="F";
								echo "<td height='18' class='style4'>$gp</td>";
								echo "<td height='18' class='style4'>$grade</td>";
							}
					 }elseif(($row['cont_assess_t']>0&&$row['f_exam_t']>0&&$row['cont_assess_p']>0&&$row['f_exam_p']==0)){
				 
							if($totalTFC>=40&&$totalPFC>=40){
								echo "<td height='18' class='style4'>$gp</td>";
								echo "<td height='18' class='style4'>$grade</td>";
							}else{
								$gp=0;
								$grade="F";
								echo "<td height='18' class='style4'>$gp</td>";
								echo "<td height='18' class='style4'>$grade</td>";
							}
					}elseif(($row['cont_assess_t']>0&&$row['f_exam_t']>0&&$row['cont_assess_p']==0&&$row['f_exam_p']==0)){
				 
							if($totalTFC>=40){
								echo "<td height='18' class='style4'>$gp</td>";
								echo "<td height='18' class='style4'>$grade</td>";
							}else{
								$grade="F";
								$gp=0;
								echo "<td height='18' class='style4'>$gp</td>";
								echo "<td height='18' class='style4'>$grade</td>";
							}
					}elseif(($row['cont_assess_t']==0&&$row['f_exam_t']==0&&$row['cont_assess_p']>0&&$row['f_exam_p']>0)){
				  
							if($totalPFC>=40){
								echo "<td height='18' class='style4'>$gp</td>";
								echo "<td height='18' class='style4'>$grade</td>";
							}else{
								$grade="F";
								$gp=0;
								echo "<td height='18' class='style4'>$gp</td>";
								echo "<td height='18' class='style4'>$grade</td>";
							}
					}else{
						//$grade="F";
						//echo "<td align='center' class='head'>".$total."<br/><hr><br/>0<br/><hr>".$grade."</td>";
					}		
				?>	
				<!--
				<td height="18" class="style4"><?php echo $gp; ?></td>
                <td height="18" class="style4"><?php echo $grade; ?>
				
				-->
				
                  <input type="hidden" value="<?php echo $credit; ?>" name="credit" id="credit" />
                  <input type="hidden" value="<?php echo $cgp; ?>" name="cgp" id="cgp" /></td>
              <?php 	$count++; if($grade=="F"){$g+=$c; $c++;} 
			  		$tcredit +=$credit; $tcgp +=$cgp;
                 	}
					
        			$ht +=27;

			  	} if(!empty($_POST['stdid'])) {$gpav=round($tcgp/$tcredit,2);
			  	if(($gpav < 2.00) && ($gpav >= 0))
				{
					$fgrade="F";
				}
			  	else if(($gpav < 2.25) && ($gpav >= 2.00))
				{
					$fgrade="D";
				}
			  	else if(($gpav < 2.50) && ($gpav >= 2.25))
				{
					$fgrade="C";
				}
			  	else if(($gpav < 2.75) && ($gpav >= 2.50))
				{
					$fgrade="C+";
				}
			  	else if(($gpav < 3.00) && ($gpav >= 2.75))
				{
					$fgrade="B-";
				}
			  	else if(($gpav < 3.25) && ($gpav >= 3.00))
				{
					$fgrade="B";
				}
			  	else if(($gpav < 3.50) && ($gpav >= 3.25))
				{
					$fgrade="B+";
				}
			  	else if(($gpav < 3.75) && ($gpav >= 3.50))
				{
					$fgrade="A-";
				}
			  	else if(($gpav < 4.00) && ($gpav >= 3.75))
				{
					$fgrade="A";
				}
			  	else if($gpav = 4.00)
				{
					$fgrade="A+";
				}
				$fg=$fgrade;
			?>
                </tr>
            </table>
			<td height="249"  valign="top" bgcolor="#CCCCCC">
			<table width="100%" height="249"   border="0" cellpadding="0" cellspacing="0" bordercolor="#666666" id="stdtbl2" >
              <tr>
                <td height="51" bgcolor="#CCCCCC"><span class="style2"><strong>Grade Point Average (GPA) </strong></span></td>
              </tr>
              <tr>
                <td bgcolor="#CCCCCC" style="height:auto;" ><?php if($g>0){echo "F"; }else{echo $gpav; ?></br><?php echo " ".$fg; }}?></td>
              </tr>
			</table>			</td>
			
          </tr>
        </table>          </td>
      </tr>
      <tr>
        <td height="80" colspan="2" valign="middle" bgcolor="#FFFFFF">          <div align="center"></div></td>
      </tr>
    </table>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td width="31%" height="53">&nbsp;</td>
          <td width="3%">&nbsp;</td>
          <td width="31%">&nbsp;</td>
          <td width="3%">&nbsp;</td>
          <td width="32%">&nbsp;</td>
        </tr>

  </table>	</tr>
  <tr>
    <th height="25" valign="top" scope="col">    
  </tr>
</table>
</th>
<div align="center"></div>
</body>
</html>
<?php 
}else{
  header("Location:index.php");
	echo "sorry! u did mistake. please check corresponding.";
}
}  
?>
