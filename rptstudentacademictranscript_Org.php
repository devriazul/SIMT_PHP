<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
	if($_SESSION['userid']){
	
	
	
	
	        $sm="SELECT*FROM  tbl_semester WHERE id='$_POST[semester]'";
  			$csm=$myDb->select($sm);
  			$carsm=$myDb->get_row($csm,'MYSQL_ASSOC');

			     
  			$crs="SELECT *,LEFT(name,2) as code FROM tbl_department WHERE id='$_POST[deptid]' and storedstatus<>'D'";			  
			$crq=$myDb->select($crs); 
  			$crsr=$myDb->get_row($crq,'MYSQL_ASSOC');
				

			$iv="SELECT *,RIGHT(boardrollno,2) as srollno from tbl_stdinfo Where stdid='$_POST[stdid]' and storedstatus<>'D'";
  			$ivq=$myDb->select($iv);
  			$ivrs=$myDb->get_row($ivq,'MYSQL_ASSOC');
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
.style18 {font-size: 34px;}
.style19 {font-size: x-small;}
</style></head>

<body>
<table width="102%" height="890"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" >
  <tr>
    <th rowspan="3" valign="top" scope="col"><img src="images/leftimg.jpg" width="26" height="883" /></th>
    <th height="25" valign="top" scope="col"><img src="images/topimg.jpg" width="100%" height="25" /></th>
    <th rowspan="3" valign="top"><img src="images/rightimg.jpg" width="28" height="891"/></th>
  </tr>
  <tr>
    <th height="840" valign="top" scope="col"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" >
      <tr>
        <td height="28" colspan="2" bgcolor="#FFFFFF"><div align="center" class="style16"><span class="style18">B</span>ANGLADESH <span class="style18">T</span>ECHNICAL <span class="style18">E</span>DUCATION <span class="style18">B</span>OARD, <span class="style18">D</span>HAKA</div></td>
      </tr>
      <tr>
        <td height="28" colspan="2" bgcolor="#FFFFFF"><div align="center" >
          <table width="88%"  border="0" cellspacing="0" cellpadding="4">
            <tr>
              <th width="16%" rowspan="4" scope="col"><div align="left"><img src="logo.png" width="110" height="97" /></div></th>
              <th width="80%" scope="col"><div align="center">DIPLOMA-IN-ENGINEERING (Duration: 4-Years) </div></th>
            </tr>
            <tr>
              <td><div align="center"><?php echo $carsm['name']. " EXAMINATION, ".$_POST['year'];?></div></td>
            </tr>
            <tr>
              <td><div align="center"><?php echo "(Held in Month of ".$_POST['heldmonths'].", ".$_POST['year'].")";?></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
        </div></td>
      </tr>
      <tr>
        <td colspan="2"><img src="images/spaer.gif" width="1" height="1" /></td>
      </tr>
      <tr>
        <td valign="top"><div align="center" class="h"> 
          <div align="center">Academic Transcript</div>
        </div></td>
        <td width="16%" rowspan="2" valign="top"><table width="120%"  border="1" align="right" cellpadding="0" cellspacing="0" bordercolor="#000000" class="style4">
          <tr bgcolor="#CCCCCC">
            <td height="18" colspan="3"><div align="center">Grading Sytem </div></td>
          </tr>
          <tr class="gs">
            <td height="23"><div align="center">Marks Interval </div></td>
            <td><div align="center">Letter Grade </div></td>
            <td><div align="center">Grade Point </div></td>
          </tr>
          <tr class="gs">
            <td><div align="center" class="gs">80-100</div></td>
            <td><div align="center">A+</div></td>
            <td><div align="center">4.00</div></td>
          </tr>
          <tr class="gs">
            <td><div align="center">75-79</div></td>
            <td><div align="center">A</div></td>
            <td><div align="center">3.75</div></td>
          </tr>
          <tr class="gs">
            <td><div align="center">70-74</div></td>
            <td><div align="center">A-</div></td>
            <td><div align="center">3.50</div></td>
          </tr>
          <tr class="gs">
            <td><div align="center">65-69</div></td>
            <td><div align="center">B+</div></td>
            <td><div align="center">3.25</div></td>
          </tr>
          <tr class="gs">
            <td><div align="center">60-64</div></td>
            <td><div align="center">B</div></td>
            <td><div align="center">3.00</div></td>
          </tr>
          <tr class="gs">
            <td><div align="center">55-59</div></td>
            <td><div align="center">B-</div></td>
            <td><div align="center">2.75</div></td>
          </tr>
          <tr class="gs">
            <td><div align="center">50-54</div></td>
            <td><div align="center">C+</div></td>
            <td><div align="center">2.50</div></td>
          </tr>
          <tr class="gs">
            <td><div align="center">45-49</div></td>
            <td><div align="center">C</div></td>
            <td><div align="center">2.25</div></td>
          </tr>
          <tr class="gs">
            <td><div align="center">40-44</div></td>
            <td><div align="center">D</div></td>
            <td><div align="center">2.00</div></td>
          </tr>
          <tr class="gs">
            <td><div align="center">00-39</div></td>
            <td><div align="center">F</div></td>
            <td><div align="center">0.00</div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="84%" height="185" align="left" valign="top" ><div align="left"> <span class="mfont">Serial No: <strong><?php echo $_POST['session'].$crsr['code'].$ivrs['srollno'];?></strong></span>&nbsp;
          </div>          <div align="right">
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="71%" valign="top"><table width="99%"  border="0" cellspacing="0" cellpadding="1">
                <tr>
                  <td width="21%" class="mfont">Technology</td>
                  <td width="1%">:</td>
                  <td colspan="3" class="mfont"><?php echo $crsr['name'];?></td>
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
                  <td width="32%"><div align="right" class="mfont">Session : <?php echo "20".substr_replace($_POST['session'],'-20',-2,-2); ?></div></td>
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
        </tr>
      <tr>
        <td colspan="2" valign="top" ><table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="84%" valign="top" colspan="2" height="251" ><table width="100%" height="253" border="0" align="left" cellpadding="1" cellspacing="0" bordercolor="#666666" id="stdtbl">
              <tr bgcolor="#CCCCCC">
                <td width="47" height="25" class="style2"><strong>SLNo. </strong></td>
                <td width="160" height="25" class="style2"><strong>Subject Code </strong></td>
                <td width="385" height="25" class="style2"><strong>Name of Subject </strong></td>
                <td width="97" height="25" class="style2"><strong>Full Marks </strong></td>
                <td width="72" height="25" class="style2"><div align="center"><strong>Obtained Marks </strong></div></td>
                <td width="56" height="25" class="style2"><div align="center"><strong><strong>Grade Point(GP)</strong></strong></div></td>
                <td width="135" height="25" class="style2"><strong>Letter Geade</strong></td>
                </tr>
              <?php 
			$crs="SELECT mf.courseid, c.coursecode, c.coursename FROM tbl_courses c, tbl_marksentryfinal mf WHERE c.id= mf.courseid and mf.deptid='$_POST[deptid]' and mf.stdid= '$_POST[stdid]' and mf.semesterid='$_POST[semester]' and mf.session='$_POST[session]' and mf.year='$_POST[year]' ";
			$crq=$myDb->select($crs); 			
			$tcredit=0; $g=0; 
			$tcgp=0;
			while($crsr=$myDb->get_row($crq,'MYSQL_ASSOC'))
			{
			
				/*echo "SELECT distinct m.stdid, c.credit, right(c.coursecode,4) as coursecode, c.coursename, m.examname, m.session, m.deptid, m.courseid, m.year, m.semesterid, (c.cont_assess_t+c.f_exam_t+c.cont_assess_p+c.f_exam_p) as TotalMarks, c.cont_assess_t,c.f_exam_t,c.cont_assess_p,c.f_exam_p,
						m.classtestmarks,m.quiztestmarks,m.hwmarks,m.jobexpr,m.jobexprfinal,m.jobexprreport,m.jobexprreportfinal,m.jobexprviva,
						m.jobexprvivafinal,m.attendancemarks,m.attendancemarksprac,m.behaviormarks,m.finalexamprac,m.finalexammarks
						FROM `tbl_marksentryfinal` m inner join tbl_courses c on m.courseid=c.id WHERE m.deptid='$_POST[deptid]' and m.courseid= '$crsr[courseid]' and m.semesterid='$_POST[semester]' and m.session='$_POST[session]' and m.year='$_POST[year]' and m.stdid='$_POST[stdid]'"; exit;*/
	
	

			
			
				$query="SELECT distinct m.stdid, c.credit, right(c.coursecode,4) as coursecode, c.coursename, m.examname, m.session, m.deptid, m.courseid, m.year, m.semesterid, (c.cont_assess_t+c.f_exam_t+c.cont_assess_p+c.f_exam_p) as TotalMarks, c.cont_assess_t,c.f_exam_t,c.cont_assess_p,c.f_exam_p,
						m.classtestmarks,m.quiztestmarks,m.hwmarks,m.jobexpr,m.jobexprfinal,m.jobexprreport,m.jobexprreportfinal,m.jobexprviva,
						m.jobexprvivafinal,m.attendancemarks,m.attendancemarksprac,m.behaviormarks,m.finalexamprac,m.finalexammarks,
						((select classtestmarks from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]'  and stdid='$_POST[stdid]') +
						(select quiztestmarks from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$_POST[stdid]') +
						(select `hwmarks` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$_POST[stdid]') +
						(select `jobexpr` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$_POST[stdid]') +
						(select `jobexprfinal` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$_POST[stdid]') +
						(select `jobexprreport` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$_POST[stdid]') +
						(select `jobexprreportfinal` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$_POST[stdid]') +
						(select `jobexprviva` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$_POST[stdid]') +
						(select `jobexprvivafinal` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$_POST[stdid]') +
						(select `attendancemarks` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$_POST[stdid]') +
						(select `attendancemarksprac` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$_POST[stdid]') +
						(select `behaviormarks` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$_POST[stdid]') +
						(select `finalexamprac` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$_POST[stdid]') +
						(select `finalexammarks` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and stdid='$_POST[stdid]')) as obtainedmarks 
						FROM `tbl_marksentryfinal` m inner join tbl_courses c on m.courseid=c.id WHERE m.deptid='$_POST[deptid]' and m.courseid= '$crsr[courseid]' and m.semesterid='$_POST[semester]' and m.session='$_POST[session]' and m.year='$_POST[year]' and m.stdid='$_POST[stdid]'";	
				$result = mysql_query($query) or die(mysql_error());
			while($row=$myDb->get_row($result,'MYSQL_ASSOC'))
			{
				$sumtc=$row['classtestmarks']+$row['quiztestmarks']+$row['attendancemarks'];
				$sumpc=($row['jobexpr']+$row['hwmarks']+$row['jobexprreport']+$row['jobexprviva']+$row['attendancemarksprac']+$row['behaviormarks']);
				$sumtf=$row['finalexammarks'];	
				$sumpf=($row['jobexprfinal']+$row['jobexprreportfinal']+$row['jobexprvivafinal']); 
				
				
				$totalTFCB=($row['cont_assess_t']+$row['f_exam_t']);
				$totalPFCB=($row['cont_assess_p']+$row['f_exam_p']);
				$totalTFC=0;
				if($sumtf>0||$sumtc>0){
					$totalTFC=((($sumtf+$sumtc)/$totalTFCB)*100);
				}
				$totalPFC=0;
				if($sumpc>0||$sumpf>0){
					$totalPFC=((($sumpf+$sumpc)/$totalPFCB)*100);
				}
					
				 
				$mp= ($row['obtainedmarks']/$row['TotalMarks'])*100;
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
                <td height="18" class="style4"><?php echo $row['obtainedmarks'];?></td>
                
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
        <tr>
          <td rowspan="2" style="border-top:1px solid #CCCCCC;"><div align="center">Head of the Dpt. </div>
              <div align="center"><span style=" font:Geneva, Arial, Helvetica, sans-serif; font-size:9px; ">SAIC Institute of Management & Technology</span></div></td>
          <td>&nbsp;</td>
          <td style="border-top:1px solid #CCCCCC;"><div align="center">Controller of Examinations</div></td>
          <td>&nbsp;</td>
          <td rowspan="2" style="border-top:1px solid #CCCCCC;"><div align="center">Director/ Principal </div>
              <div align="center"><span style=" font:Geneva, Arial, Helvetica, sans-serif; font-size:9px; ">SAIC Institute of Management & Technology</span></div></td>
        </tr>
        <tr>
          <td height="25">&nbsp;</td>
          <td><div align="center"></div></td>
          <td>&nbsp;</td>
        </tr>
		
  </table>	</tr>
  <tr>
  <th height="25" valign="top" scope="col"><img src="images/botimg.jpg" width="100%" height="25" /></tr>
</table>
</th>
<div align="center"><span class="style19" >This Academic Transcript is issued without any alteration/ensure.</span> </div>
</body>
</html>
<?php 
}else{
  header("Location:index.php");
	echo "sorry! u did mistake. please check corresponding.";
}
}  
?>
