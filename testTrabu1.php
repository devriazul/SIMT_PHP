<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='studentstabulationsheet.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
	  @$deptid=mysql_real_escape_string($_POST['deptid'])?mysql_real_escape_string($_POST['deptid']):$_GET['deptid'];
	  @$semester=mysql_real_escape_string($_POST['semester'])?mysql_real_escape_string($_POST['semester']):$_GET['semester'];
	  @$year=mysql_real_escape_string($_POST['year'])?mysql_real_escape_string($_POST['year']):$_GET['year'];
	  @$session=mysql_real_escape_string($_POST['session'])?mysql_real_escape_string($_POST['session']):$_GET['session'];
	  @$heldmonths=mysql_real_escape_string($_POST['heldmonths'])?mysql_real_escape_string($_POST['heldmonths']):$_GET['heldmonths'];
		
	  $dptq=$myDb->select("SELECT*FROM tbl_department WHERE id='$deptid'");
	  $dptqf=$myDb->get_row($dptq,'MYSQL_ASSOC');	
	  
	  $smq=$myDb->select("SELECT*FROM tbl_semester WHERE id='$semester'");
	  $smqf=$myDb->get_row($smq,'MYSQL_ASSOC');	
	  
	  $strecs=$myDb->select("select distinct semester from tbl_stdinfo WHERE deptname='$deptid' and session='$session'");
	  $strecsemf=$myDb->get_row($strecs,'MYSQL_ASSOC');
	  /*  
	  $myDb->update_sql("DELETE FROM tbl_reffinal where deptid='$deptid' and session='$session'
	  							and semesterid='$semester' and year='$year'");

	  $setref=$myDb->update_sql("ALTER TABLE tbl_reffinal AUTO_INCREMENT = 1");
  	*/
	  
  
	  @$mainPAGE = !empty($_POST['page'])?$_POST['page']:$_GET['page'];
	  if(empty($mainPAGE)){
	    $mainPAGE=1;
	  }	
	  
	  $mainPAGE -=1;
	  $mainPERPAGE=20;
	  $mainSTART=$mainPAGE*$mainPERPAGE;
	  if(isset($_GET['show'])){
		  $stqP=$myDb->select("select *from tbl_stdinfo
								where deptname='$deptid' 
								and session='$session'
								and stdid in(select stdid from tbl_marksentryfinal 
												where year='$year'
												and deptid='$deptid'
												and session='$session'
												and semesterid='$semester')");
	  }else{
		  $stqP=$myDb->select("select *from tbl_stdinfo
								where deptname='$deptid' 
								and session='$session'
								and stdid in(select stdid from tbl_marksentryfinal 
												where year='$year'
												and deptid='$deptid'
												and session='$session'
												and semesterid='$semester') 
								LIMIT $mainSTART,$mainPERPAGE");
	  }	  
	  $stdROW=mysql_num_rows($stqP);
	  $perpage=20;
	  $totalPAGE=ceil($stdROW/$perpage);
	  
?>
<style type="text/css">
 .test-table{
    margin:0px;
	padding:0px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:9px; 
	border-top:1px solid #333;
	border-bottom:1px solid #333;
	border-left:1px solid #333;
  }
  td{
     padding:1px;   

  }	 	
  .head{
	 border-right:1px solid #333;
	 border-top:1px solid #333;
  }
  .stdhead{
  	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:9px; 
  }
   .stdhead-top{
	border-right:1px solid #333;

  }

  a,a:active,a:visited{
    text-decoration:none;
	 }
 .mainWRAP{
    page-break-before:always;
 }
 h1,h2{
    font-size:18px;
 }			 
</style>
<script type="text/javascript" src="jquery.js"></script>
<script language="javascript">
 $(document).ready(function(){
   window.print();
 });

</script>
<?php
$y=1;
$totalY=0;
while($y<=$totalPAGE){
	$x=$y-1;
	$start=$x*$perpage;
?>

<?php 
	//Checking page no grater than 2
if($y>2){
?>
<div class="mainWRAP">
<?php //All page heading (First,Last page not here)
		echo "<div align='center'style='float:left;'>
		      <div align='center'style='float:left; width:150px;'><img src='logo.png' width='110' height='97' />
			  </div>";			  

		echo "<div style='float:right; width:600px;'><label><h4>Bangladesh Technical Education Board</h4>
		      <h5>Tabulation Sheet for Diploma in Engineering({$smqf['name']} EXAMINATION)</h5></label> 
			  </div>";
		echo "</div>";
		echo "<div style='float:right; font-size:11px; width:auto; border:1px solid #333333; padding:3px;'>
		      <label>TC-Theory Continious</label><br/>
			  <label>TF-Theory Final</label><br/>
			  <label>PC-Practical Continious</label><br/>
			  <label>PF-Practical Final</label>
		
		</div>";
		echo "<div style='float:left; font-size:14px;width:700px;'>Technology Code and Name: {$dptqf['name']}<br/>Institue Code and Name: [50116] SAIC Institue of Management and Technology</div>"."<br/>";
		echo "<div align='right' style='float:right; font-size:12px;width:500px;'>Examination Year: {$heldmonths} {$year}</div>"."<br/>";
}
$refdeptid='';$refstdid='';$refsemesterid='';$refsession='';$refcourseid='';$refcoursecode='';$refyear='';

?>

<?php 	$crs=$myDb->select("SELECT distinct d.id,d.name,c.coursename,c.coursecode,s.name,ss.session,ss.year
                          FROM tbl_semesterwisesubj ss						  
						  inner join tbl_department d
						  on ss.deptid=d.id
						  inner join tbl_courses c
						  on ss.courseid=c.id
						  inner join tbl_semester s
						  on ss.semesterid=s.id
						  where ss.deptid='$deptid'
						  
						  and ss.courseid in(select courseid from tbl_marksentryfinal 						  
						  					  where deptid='$deptid'
											  and semesterid='$semester'
											  and session='$session'
											  and year='$year'

											  )

						  order by c.id
						  "); 	
						  
       $mainROW=mysql_num_rows($crs);	   

	   echo "<table cellpadding='0' cellspacing='0' class='test-table'>";
	   echo "<tr>";
       echo "<td class='head' colspan=2>Subject Code & Name</td>";

	   while($row=$myDb->get_row($crs,'MYSQL_ASSOC')){
		     $len=strlen($row['coursecode']);
			 $ccode=substr($row['coursecode'],-4,$len);
			 
			 echo "<td colspan='3' class='head'>".$row['coursename']."<br/>".$ccode."</td>";
	   }					
	     echo "<td colspan=3 class='head'>Result</td>";
	     echo "<tr>"; 
		 echo "<td class='head' colspan=2>Student Name</td>";

		 $crsm=$myDb->select("SELECT distinct c.id,c.coursename,c.cont_assess_t,c.f_exam_t,c.cont_assess_p,c.f_exam_p,(c.cont_assess_t+c.f_exam_t+c.cont_assess_p+c.f_exam_p) TotalMark
                         FROM tbl_semesterwisesubj ss						  
						  inner join tbl_department d
						  on ss.deptid=d.id
						  inner join tbl_courses c
						  on ss.courseid=c.id
						  inner join tbl_semester s
						  on ss.semesterid=s.id
						  where ss.deptid='$deptid'
						  
						  and ss.courseid in(select courseid from tbl_marksentryfinal m						  
						  					  where m.deptid='$deptid'
											  and m.semesterid='$semester'
											  and m.session='$session'
											  and m.year='$year'

											  )
						  order by c.id
						");
		 while($crsmf=$myDb->get_row($crsm,'MYSQL_ASSOC')){
		 
				 if($crsmf['cont_assess_t']==0){
					 echo "<td align='center' class='head'>&nbsp;</td>";  
				 }else{   
					 echo "<td align='center' class='head'>"."TC"."<BR/>".$crsmf['cont_assess_t']."</td>";  
				 }	 
				 if($crsmf['f_exam_t']==0){
					 echo "<td align='center' class='head' >&nbsp;</td>"; 
				 }else{
					 echo "<td align='center' class='head' >"."TF"."<BR/>".$crsmf['f_exam_t']."</td>"; 
				 }		
						 
				 echo "<td align=center class='head'>Total"."<BR/>".$crsmf['TotalMark']."</td>";
		 }		
		 echo "<td class='head'>GPA</td>";
		 echo "<td class='head'>Status</td>";

	     echo "<tr>";
		 echo "<td class='stdhead-top' colspan=2><br/><hr>Roll No<br/><hr>Reg No<br/><hr>Session<hr></td>";

		 $crsp=$myDb->select("SELECT distinct c.id,c.cont_assess_t,c.f_exam_t,c.cont_assess_p,c.f_exam_p
                         FROM tbl_semesterwisesubj ss						  
						  inner join tbl_department d
						  on ss.deptid=d.id
						  inner join tbl_courses c
						  on ss.courseid=c.id
						  inner join tbl_semester s
						  on ss.semesterid=s.id
						  where ss.deptid='$deptid'
						  
						  and ss.courseid in(select courseid from tbl_marksentryfinal m					  
						  					  where m.deptid='$deptid'
											  and m.semesterid='$semester'
											  and m.session='$session'
											  and m.year='$year'

											  )
						  order by c.id
						 ");
		 $sum44=0;
		 while($crspf=$myDb->get_row($crsp,'MYSQL_ASSOC')){
		 $sum44=($crspf['cont_assess_t']+$crspf['f_exam_t']+$crspf['cont_assess_p']+$crspf['f_exam_p']);
				 if($crspf['cont_assess_p']==0){
					 echo "<td align='center' class='head'></td>";  
				 }else{
					 echo "<td align='center' class='head'>"."PC"."<BR/>".$crspf['cont_assess_p']."</td>";  
				 }
				 if($crspf['f_exam_p']==0){
					 echo "<td align='center' class='head'></td>"; 
				 }else{
					 echo "<td align='center' class='head'>"."PF"."<BR/>".$crspf['f_exam_p']."</td>"; 
				 }
				 echo "<td align='center' class='head'>"."<BR/>GP<hr> </BR>Letter Grade	</td>"; 
		 
		 }		  
	  echo "<td class='head'>Letter Grade</td>"; 
	  echo "<td class='head'>&nbsp;</td>";
	  

      echo "</tr>";
	  if(isset($_GET['show'])){
		  $stq=$myDb->select("select *from tbl_stdinfo
								where deptname='$deptid' 
								and session='$session'
								and stdid in(select stdid from tbl_marksentryfinal 
												where year='$year'
												and deptid='$deptid'
												and session='$session'
												and semesterid='$semester')
								LIMIT $start,$perpage");
	  }else{
		  $stq=$myDb->select("select *from tbl_stdinfo
								where deptname='$deptid' 
								and session='$session'
								and stdid in(select stdid from tbl_marksentryfinal 
												where year='$year'
												and deptid='$deptid'
												and session='$session'
												and semesterid='$semester')
								LIMIT $mainSTART,$mainPERPAGE");
	  }
	  while($stqf=$myDb->get_row($stq,'MYSQL_ASSOC')){	  
		  echo "<tr>";
		  
		  echo "<td>";
		  
		  echo "<table class='stdhead' cellpadding='0' cellspacing='0'>";
			echo "<tr>";
			echo "<td >".$stqf['stdname']."<br/>".$stqf['boardrollno']."<br/>".$stqf['boardregno']."<br/>".$stqf['session']."<hr></td>";
			echo "</tr>";	  
			echo "</table>";
			echo "</td>";
			//echo "<td class='head'>".$stqf['stdname']."</td>";
						echo "<td class='head'></td>";

			$i=0;
			$iscrs=$myDb->select("SELECT * from tbl_marksentryfinal where stdid='$stqf[stdid]'
								   and deptid='$deptid' and semesterid='$semester'
								   and courseid in(SELECT distinct c.id
													  FROM tbl_semesterwisesubj ss
													  inner join tbl_department d
													  on ss.deptid=d.id
													  inner join tbl_courses c
													  on ss.courseid=c.id
													  inner join tbl_semester s
													  on ss.semesterid=s.id
													  where ss.deptid='$deptid'
													  and ss.semesterid='$semester'
													  
													  order by c.id
													  )
									and session='$session'
									and year='$year'
									 order by courseid				  
									");
			$sumtc=0;
			$sumpc=0;
			$sumtf=0;
			$sumpf=0;
			$totalGP=0;				
			$grade='';
			$cgpa=0;
			$totalCGPA=0;$cdrt=0; 
			$fgrade=0;$Lg=0;			

			$totalROW=mysql_num_rows($iscrs);
			if($totalROW>0){
			$fl=0;$fs=0;$crsid='';

			while($iscrsf=$myDb->get_row($iscrs,'MYSQL_ASSOC')){
			 $incs=$myDb->select("SELECT distinct c.id,c.coursecode,c.coursename,c.credit,m.stdid, m.examname, m.session, 
								  m.deptid, m.courseid, m.year, m.semesterid,c.cont_assess_t,c.f_exam_t,c.cont_assess_p,c.f_exam_p,
								  (c.cont_assess_t+c.f_exam_t+c.cont_assess_p+c.f_exam_p) as TotalMarks
								  FROM `tbl_marksentryfinal` m 
								  inner join tbl_courses c 
								  on m.courseid=c.id 
								  WHERE m.deptid='$iscrsf[deptid]' 
								  and m.courseid= '$iscrsf[courseid]' 
								  and m.semesterid='$iscrsf[semesterid]' 
								  and m.session='$iscrsf[session]' 
								  and m.stdid='$iscrsf[stdid]'
								  and m.year='$year'
								 ");
			 $incsf=$myDb->get_row($incs,'MYSQL_ASSOC');
			 $sum44=$incsf['TotalMarks'];
			
			
			
			
			$sumtc=$iscrsf['classtestmarks']+$iscrsf['quiztestmarks']+$iscrsf['attendancemarks'];
		    $isptc=0;$isppc=0;$isptf=0;$isppf=0;
			if($sumtc>0){
			    //echo "Std id:".$iscrsf['stdid']."<br/>";
				//echo "Percent ".$isptc=(($sumtc/$incsf['cont_assess_t'])*100)."<br/>";
				
				
					@$isptc=(($sumtc/$incsf['cont_assess_t'])*100);
				
				
			}
			$sumpc=($iscrsf['jobexpr']+$iscrsf['hwmarks']+$iscrsf['jobexprreport']+$iscrsf['jobexprviva']+$iscrsf['attendancemarksprac']+
				$iscrsf['behaviormarks']);
			if($sumpc>0){
				$isppc=(($sumpc/$incsf['cont_assess_p'])*100);	   
			}
			$sumtf=$iscrsf['finalexammarks'];	
			if($sumtf>0){
				$isptf=(($sumtf/$incsf['f_exam_t'])*100);
			}
			$sumpf=($iscrsf['jobexprfinal']+$iscrsf['jobexprreportfinal']+$iscrsf['jobexprvivafinal']);  
			if($sumpf>0){
				$isppf=(($sumpf/$incsf['f_exam_p'])*100); 
			}
			
			$totalTFCB=($incsf['cont_assess_t']+$incsf['f_exam_t']);
			$totalPFCB=($incsf['cont_assess_p']+$incsf['f_exam_p']);
			$totalTFC=0;
			if($sumtf>0 || $sumtc>0){
				@$totalTFC=((($sumtf+$sumtc)/$totalTFCB)*100);
			}
			$totalPFC=0;
			if($sumpc>0||$sumpf>0){
				$totalPFC=((($sumpf+$sumpc)/$totalPFCB)*100);
			}
			$total=($sumtc+$sumpc+$sumtf+$sumpf);
			$gp=(($total/$sum44)*100);
				if($gp>=80){
				  $grade="A+";
				  $cgpa=4.00;
				}else if($gp>=75 && $gp<80){
				  $grade="A";
				  $cgpa=3.75;
				}else if($gp>=70 && $gp<75){
				  $grade="A-";
				  $cgpa=3.5;
				}else if($gp>=65 && $gp<70){
				  $grade="B+";
				  $cgpa=3.25;
				}else if($gp>=60 && $gp<65){
				  $grade="B";
				  $cgpa=3.00;
				}else if($gp>=55 && $gp<60){
				  $grade="B-";
				  $cgpa=2.75;
				}else if($gp>=50 && $gp<55){
				  $grade="C+";
				  $cgpa=2.5;
				}else if($gp>=45 && $gp<50){
				  $grade="C";
				  $cgpa=2.25;
				}else if($gp>=40 && $gp<45){
				  $grade="D";
				  $cgpa=2;
				}else if($gp<40){
				  $grade="F";
				  $cgpa=0.00;
				}
				
				echo "<td align='center' class='head'>".$sumtc."<br/><hr>".$sumpc."</td>";
				echo "<td align='center' class='head'>".$sumtf."<br/><hr>".$sumpf."</td>";
				if(($incsf['cont_assess_t']>0&&$incsf['f_exam_t']>0&&$incsf['cont_assess_p']>0&&$incsf['f_exam_p']>0)){	
				 
					if($totalTFC>=40&&$totalPFC>=40){
						echo "<td align='center' class='head'>".$total."<br/><hr><br/><span style='color: #0000CC'>".$cgpa."</span><br/><hr><span style='color: #009900'>".$grade."</span></td>";
					}else{
						$grade="F";
						echo "<td align='center' class='head'>".$total."<br/><hr><br/>0<br/><hr><span style='color: #FF0000'>".$grade."</span></td>";
					}
				}elseif(($incsf['cont_assess_t']>0&&$incsf['f_exam_t']>0&&$incsf['cont_assess_p']>0&&$incsf['f_exam_p']==0)){
				 
					if($totalTFC>=40&&$totalPFC>=40){
						echo "<td align='center' class='head'>".$total."<br/><hr><br/><span style='color: #0000CC'>".$cgpa."</span><br/><hr><span style='color: #009900'>".$grade."</span></td>";
					}else{
						$grade="F";
						echo "<td align='center' class='head'>".$total."<br/><hr><br/>0<br/><hr><span style='color: #FF0000'>".$grade."</span></td>";
					}
				}elseif(($incsf['cont_assess_t']>0&&$incsf['f_exam_t']>0&&$incsf['cont_assess_p']==0&&$incsf['f_exam_p']==0)){
				 
					if($totalTFC>=40){
						echo "<td align='center' class='head'>".$total."<br/><hr><br/><span style='color: #0000CC'>".$cgpa."</span><br/><hr><span style='color: #009900'>".$grade."</span></td>";
					}else{
						$grade="F";
						echo "<td align='center' class='head'>".$total."<br/><hr><br/>0<br/><hr><span style='color: #FF0000'>".$grade."</td></span>";
					}
				}elseif(($incsf['cont_assess_t']==0&&$incsf['f_exam_t']==0&&$incsf['cont_assess_p']>0&&$incsf['f_exam_p']>0)){
				  
					if($totalPFC>=40){
						echo "<td align='center' class='head'>".$total."<br/><hr><br/><span style='color: #0000CC'>".$cgpa."</span><br/><hr><span style='color: #009900'>".$grade."</span></td>";
					}else{
						$grade="F";
						echo "<td align='center' class='head'>".$total."<br/><hr><br/>0<br/><hr><span style='color: #FF0000'>".$grade."</span></td>";
					}
				}else{
				    //$grade="F";
					//echo "<td align='center' class='head'>".$total."<br/><hr><br/>0<br/><hr>".$grade."</td>";
				}
			    $refdeptid=$incsf['deptid'];
				$refstdid=$incsf['stdid'];
				$refsemesterid=$incsf['semesterid'];
				$refsession=$incsf['session'];
				$refcourseid=$incsf['courseid'];
				$refcoursecode=$incsf['coursecode'];
				$refyear=$incsf['year'];
				
				$strefsubid='';
			    if($grade=="F"){
					 $chkref=$myDb->select("SELECT*FROM tbl_studentreffsub 
										  WHERE deptid='$incsf[deptid]' 
										  and courseid= '$incsf[id]'
										  and coursecode='$incsf[coursecode]' 
										  and semesterid='$incsf[semesterid]' 
										  and session='$incsf[session]' 
										  and stdid='$incsf[stdid]'
										  and year='$incsf[year]'
									  ");
					  $chkreff=$myDb->get_row($chkref,'MYSQL_ASSOC');
					 if(empty($chkreff['deptid'])&& empty($chkreff['courseid'])
						 && empty($chkreff['semesterid'])&& empty($chkreff['session'])&& empty($chkreff['stdid'])){
						 $myDb->insert_sql("INSERT INTO `tbl_studentreffsub` (`stdid`, `courseid`, `coursecode`, `semesterid`, 
																			 `deptid`, `session`, `year`) 
										   VALUES ('$incsf[stdid]', '$incsf[courseid]', '$incsf[coursecode]', '$incsf[semesterid]', 
												   '$incsf[deptid]', '$incsf[session]', '$incsf[year]')");
						 $refq=$myDb->select("SELECT*FROM `tbl_reffinal` where stdid='$incsf[stdid]' and deptid='$deptid' and session='$session'");
						 $reff=$myDb->get_row($refq,'MYSQL_ASSOC');
						 
						 $refsq=$myDb->select("SELECT*FROM `tbl_reffinalforsummery` where stdid='$incsf[stdid]' and deptid='$deptid' and session='$session'");
						 $reffs=$myDb->get_row($refsq,'MYSQL_ASSOC');
						 
						 $stcd='';
						 $tfailed=1;
						 if(empty($reff['stdid'])){
						   $tfailed=$tfailed;
						   $myDb->insert_sql("INSERT INTO tbl_reffinal(stdid,deptid,semesterid,session,year,coursecode,totalfailed)
						   						values('$incsf[stdid]','$incsf[deptid]','$incsf[semesterid]','$incsf[session]','$incsf[year]',
														'".$incsf['coursename'].'('.$incsf['coursecode'].')'."','$tfailed')");
														
						   $myDb->insert_sql("INSERT INTO tbl_reffinalforsummery(stdid,deptid,semesterid,session,year,coursecode,totalfailed)
						   						values('$incsf[stdid]','$incsf[deptid]','$incsf[semesterid]','$incsf[session]','$incsf[year]',
														'$incsf[coursecode]','$tfailed')");
														
														
														
						 }else{
						   $reff['coursecode'].=',';
						   $reff['coursecode'].=$incsf['coursename'].'('.$incsf['coursecode'].')';
						   $totalfailed=$reff['totalfailed']+1;
						   $myDb->update_sql("UPDATE tbl_reffinal set coursecode='$reff[coursecode]',totalfailed='$totalfailed' where stdid='$incsf[stdid]' and semesterid='$incsf[semesterid]'
						   						and session='$incsf[session]' and year='$incsf[year]'");
						 
						 
						   $reffs['coursecode'].=',';
						   $reffs['coursecode'].=$incsf['coursecode'];
						   
						   $myDb->update_sql("UPDATE tbl_reffinalforsummery set coursecode='$reffs[coursecode]',totalfailed='$totalfailed' where stdid='$incsf[stdid]' and semesterid='$incsf[semesterid]'
						   						and session='$incsf[session]' and year='$incsf[year]'");
						 
						 
						 
						 }						   
												   
				     }else{
				        $myDb->update_sql("UPDATE `tbl_studentreffsub` SET `stdid`='$incsf[stdid]',
					                                                   `courseid`='$incsf[courseid]', 
																	   `coursecode`='$incsf[coursecode]',
																	   `semesterid`='$incsf[semesterid]', 
					                                                   `deptid`='$incsf[deptid]',
																	   `session`='$incsf[session]',
																	   `year`='$incsf[year]'
										  WHERE deptid='$incsf[deptid]' 
										  and courseid= '$incsf[id]'
										  and coursecode='$incsf[coursecode]' 
										  and semesterid='$incsf[semesterid]' 
										  and session='$incsf[session]' 
										  and stdid='$incsf[stdid]'
										  and year='$incsf[year]'
										)");
				  
				  }
				  
				}			
			  //Determine Last status (pass,fail,reff) of students
				if($grade=="F"){
				  $fs=$fs+$fl;
				  ++$fl;
				} 
				 $cdrt =($cdrt+$incsf['credit']);
		
				 $totalGP=($totalGP+($incsf['credit']*$cgpa));
				 $Lg=round($totalGP,2)/$cdrt;
				 
			  }
					if($fl==1){
					  $status="";
					  $rf="Reff";
					}else if(($fl>1)&&($fl<=3)){
					  $status="";
					  $rf="Reff";
					}else if(($fl>3)){
					  $status="";
					  $rf="Failed";
					}
					else
					{
						$status="Pass";
						$myDb->insert_sql("INSERT into tbl_stdpassinfo (stdid, cgpa, semesterid, deptid, session, year) VALUES('$incsf[stdid]','$Lg','$incsf[semesterid]','$incsf[deptid]','$incsf[session]','$incsf[year]')");
					}
					
					
					//Student promotion grade F total <=3 then promotion otherwise no promotion apply
					if(($fl<=3)&&($fl>0)){
								  $stdsem=$myDb->select("select *from tbl_stdinfo
											where deptname='$deptid' 
											and session='$session'
											and stdid in(select stdid from tbl_marksentryfinal 
															where year='$year'
															and deptid='$deptid'
															and session='$session'
															and semesterid='$semester')
											and stdid='$incsf[stdid]'");
								  //if student cursemester and marks final table semester id same than update			
								  while($stdsemf=$myDb->get_row($stdsem,'MYSQL_ASSOC')){
								  	  $mrfsemid=$myDb->select("select distinct semesterid from tbl_marksentryfinal 
															where year='$year'
															and deptid='$deptid'
															and session='$session'
															and semesterid='$semester'");
									  $mrsemidf=$myDb->get_row($mrfsemid,'MYSQL_ASSOC');
									  if($stdsemf['stdcursemester']==$mrsemidf['semesterid']){						
								  
										  $stdcursem=$stdsemf['stdcursemester']+1;
										  $myDb->update_sql("UPDATE tbl_stdinfo SET stdcursemester='$stdcursem',
										  							resultstatus='Reffard'
																	WHERE stdid='$stdsemf[stdid]'");
									  }							
								  } 											 
						  $stdprm=$myDb->select("SELECT*FROM tbl_stdpromotiontrace 
												 WHERE deptid='$deptid'
												 AND semesterid='$semester'
												 AND session='$session' 
												 AND year='$year'");
						  $stdprmf=$myDb->get_row($stdprm,'MYSQL_ASSOC');							 

						  if(empty($stdprmf['deptid'])&&empty($stdprmf['semesterid'])&&empty($stdprmf['session'])&&empty($stdprmf['year'])){
							 if($myDb->insert_sql("INSERT INTO tbl_stdpromotiontrace(deptid,semesterid,session,year,opby,opdate,storedstatus)
												 VALUES('$deptid','$semester','$session','$year',
												 '$_SESSION[userid]','".date("Y-m-d")."','I')")){
												
							 }else{
							   echo $myDb->last_error;
							 }					 
						  
						  }
						
					}else if($fl<1){
								 $stdsem=$myDb->select("select *from tbl_stdinfo
											where deptname='$deptid' 
											and session='$session'
											and stdid in(select stdid from tbl_marksentryfinal 
															where year='$year'
															and deptid='$deptid'
															and session='$session'
															and semesterid='$semester')
											and stdid='$incsf[stdid]'");
								  //if student cursemester and marks final table semester id same than update			
								  while($stdsemf=$myDb->get_row($stdsem,'MYSQL_ASSOC')){
								  	  $mrfsemid=$myDb->select("select distinct semesterid from tbl_marksentryfinal 
															where year='$year'
															and deptid='$deptid'
															and session='$session'
															and semesterid='$semester'");
									  $mrsemidf=$myDb->get_row($mrfsemid,'MYSQL_ASSOC');
									  if($stdsemf['stdcursemester']==$mrsemidf['semesterid']){						
								  
										  $stdcursem=$stdsemf['stdcursemester']+1;
										  $myDb->update_sql("UPDATE tbl_stdinfo SET stdcursemester='$stdcursem',
										  							resultstatus='Passed'
																	WHERE stdid='$stdsemf[stdid]'");
									  }							
								  }
				}else{
								  $stdsem=$myDb->select("select *from tbl_stdinfo
											where deptname='$deptid' 
											and session='$session'
											and stdid in(select stdid from tbl_marksentryfinal 
															where year='$year'
															and deptid='$deptid'
															and session='$session'
															and semesterid='$semester')
											and stdid='$incsf[stdid]'");
								  //if student cursemester and marks final table semester id same than update			
								  while($stdsemf=$myDb->get_row($stdsem,'MYSQL_ASSOC')){
								  	  $mrfsemid=$myDb->select("select distinct semesterid from tbl_marksentryfinal 
															where year='$year'
															and deptid='$deptid'
															and session='$session'
															and semesterid='$semester'");
									  $mrsemidf=$myDb->get_row($mrfsemid,'MYSQL_ASSOC');
									  if($stdsemf['stdcursemester']==$mrsemidf['semesterid']){						
								  
										  $myDb->update_sql("UPDATE tbl_stdinfo SET resultstatus='Failed',stdstatus='D'
																	WHERE stdid='$stdsemf[stdid]'");
									  }							
								  }				
				}
					
			  		  

		   }
		   $newROW=$mainROW-$totalROW;
		   if($newROW>0){
			echo "<td align='center' class='head'>0</td>";
			echo "<td align='center' class='head'>0</td>";
			echo "<td align='center' class='head'>0<br/><hr><br/>0<br/><hr>F</td>";
			echo "<td align='center' class='head'>0</td>";
			echo "<td align='center' class='head'>0</td>";
			echo "<td align='center' class='head'>0<br/><hr><br/>0<br/><hr>F</td>";
	
		   }	
		   if(($Lg < 2.00) && ($Lg >= 0)){
			  $fgrade="F";
		   }else if(($Lg < 2.25) && ($Lg >= 2.00)){
			  $fgrade="D";
		   }else if(($Lg < 2.50) && ($Lg >= 2.25)){
			  $fgrade="C";
		   }else if(($Lg < 2.75) && ($Lg >= 2.50)){
			  $fgrade="C+";
		   }else if(($Lg < 3.00) && ($Lg >= 2.75)){
			  $fgrade="B-";
		   }else if(($Lg < 3.25) && ($Lg >= 3.00)){
			  $fgrade="B";
		   }else if(($Lg < 3.50) && ($Lg >= 3.25)){
			  $fgrade="B+";
		   }else if(($Lg < 3.75) && ($Lg >= 3.50)){
			  $fgrade="A-";
		   }else if(($Lg < 4.00) && ($Lg >= 3.75)){
			  $fgrade="A";
		   }else if($Lg = 4.00){
			  $fgrade="A+";
		   }
		  //check if grade=F 
		  if($fl==1){
		    echo "<td align='center' class='head'>".$status."</td>";
		  }else if($fl>1){
		    echo "<td align='center' class='head'>".$status."</td>";
		  }else{	//fit grade without F
		    echo "<td align='center' class='head'><span style='color: #0000CC'>".round($Lg,2)."</span><br/><hr><span style='color: #009900'>".$fgrade."</span></td>";
	      }
	?>
			
			<td align="center" class="head" width="10%"><?php echo $status; ?><br/> 
			
			    <?php 
				      $qryrefs=$myDb->select("SELECT*FROM tbl_studentreffsub 
										  WHERE deptid='$refdeptid' 
										  and semesterid='$refsemesterid' 
										  and session='$refsession' 
										  and stdid='$refstdid'
										  and year='$refyear'
									  ");
					//check if grade=F 				  
					  if($fl==1){
					    echo "$rf"."<br/>";
					  }else if($fl>1){
					    echo "$rf"."<br/>";
					  }	
					  while($reffsub=$myDb->get_row($qryrefs,'MYSQL_ASSOC')){
					    echo $reffsub['coursecode']."<br/>";
					  }
	   //After print view table tbl_studentreffsub will be truncated
	   $myDb->insert_sql("TRUNCATE TABLE tbl_studentreffsub");
	   
 ?>
		    </td>
	
	<?php echo " </tr>";	

	 } 
	 //First Page Heading
	 
	 if($y==1){
		echo "<div align='center'style='float:left;'>
		      <div align='center'style='float:left; width:150px;'><img src='logo.png' width='110' height='97' />
			  </div>";			  

		echo "<div style='float:right; width:600px;'><label><h4>Bangladesh Technical Education Board</h4>
		      <h5>Tabulation Sheet for Diploma in Engineering({$smqf['name']} EXAMINATION)</h5></label> 
			  </div>";
		echo "</div>";
		echo "<div style='float:right; font-size:11px; width:auto;  border:1px solid #333333; padding:3px;'>
		      <label>TC-Theory Continious</label><br/>
			  <label>TF-Theory Final</label><br/>
			  <label>PC-Practical Continious</label><br/>
			  <label>PF-Practical Final</label>
		
		</div>";
		echo "<div style='float:left; font-size:14px;width:700px;'>Technology Code and Name: {$dptqf['name']}<br/>Institue Code and Name: [50116] SAIC Institue of Management and Technology</div>"."<br/>";
		echo "<div align='right' style='float:right; font-size:12px;width:700px;'>Examination Year: {$heldmonths} {$year}</div>"."<br/>";
	 } 
    
?>

<?php 	 
   $totalY +=$y;
   echo "</div>";
   //All Page bottom
   if($y!=1){
    echo "<div style='width:700px; float:left'>";
	echo "<div style='font-size:10px;width:40px;margin-top:50px;float:left;border-top:1px solid #333333;height:30px;'>Tabular</div>";
	echo "<div style='font-size:10px;width:50px;margin-top:50px;float:left;border-top:1px solid #333333;height:30px;margin-left:50px;'>Comparer</div>";
	echo "<div style='font-size:10px;width:160px;margin-top:50px;float:left;border-top:1px solid #333333;height:30px;margin-left:100px;'>Signature of the Head of the Institute</div>";
	echo "<div style='font-size:10px;width:150px;margin-top:50px;float:left;border-top:1px solid #333333;height:30px;margin-left:140px;'>Signature of the Asst.Controller</div>";
    echo "</div>";
	echo "<div style=\clear:both;\"></div>";
	echo "<div style='width:700px; float:left; font-size:8px; color:#ccc;text-align:center'>Developed By DesktopBD ( http://desktopbd.com )</div>";

   }  
}


?>
<?php 
?>

<div class="mainWRAP"></div>

<?php //Last Page Heading

	if($totalPAGE!=1){
		echo "<div align='center'style='float:left;'>
		      <div align='center'style='float:left; width:150px;'><img src='logo.png' width='110' height='97' />
			  </div>";			  

		echo "<div style='float:right; width:600px;'><label><h4>Bangladesh Technical Education Board</h4>
		      <h5>Tabulation Sheet for Diploma in Engineering({$smqf['name']} EXAMINATION)</h5></label> 
			  </div>";
		echo "</div>";
		echo "<div style='float:right; font-size:11px; width:auto; border:1px solid #333333; padding:3px;'>
		      <label>TC-Theory Continious</label><br/>
			  <label>TF-Theory Final</label><br/>
			  <label>PC-Practical Continious</label><br/>
			  <label>PF-Practical Final</label>
		
		</div>";
		echo "<div style='float:left; font-size:14px;width:700px;'>Technology Code and Name: {$dptqf['name']}<br/>Institue Code and Name: [50116] SAIC Institue of Management and Technology</div>"."<br/>";
		echo "<div align='right' style='float:right; font-size:12px;width:700px;'>Examination Year: {$heldmonths} {$year}</div>"."<br/>";
    }


	echo "<tr>";
	echo "</table>";
	//Last Page bootom;
	if($totalPAGE!=1){
		echo "<div style='width:700px; float:left'>";
		echo "<div style='font-size:10px;width:40px;margin-top:50px;float:left;border-top:1px solid #333333;height:30px;'>Tabular</div>";
		echo "<div style='font-size:10px;width:50px;margin-top:50px;float:left;border-top:1px solid #333333;height:30px;margin-left:50px;'>Comparer</div>";
		echo "<div style='font-size:10px;width:160px;margin-top:50px;float:left;border-top:1px solid #333333;height:30px;margin-left:100px;'>Signature of the Head of the Institute</div>";
		echo "<div style='font-size:10px;width:150px;margin-top:50px;float:left;border-top:1px solid #333333;height:30px;margin-left:140px;'>Signature of the Asst.Controller</div>";
		echo "</div>";
    }
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>