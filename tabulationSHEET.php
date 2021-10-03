<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($_POST['deptid'] == 29 || $_POST['deptid'] == 30 || $_POST['session'] <= 1516){?>
 <!--new code start-->
 <?php 
	//echo "old logic";
	if($myDb->connect($host,$user,$pwd,$db,true))
	{ 
	  if($_SESSION['userid']){
	  $chka="SELECT*FROM  tbl_accdtl WHERE flname='studentstabulationsheet.php' AND userid='$_SESSION[userid]'";
	  $caq=$myDb->select($chka);
	  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
	  if($car['ins']=="y"){ 
	  @$deptid=mysql_real_escape_string($_POST['deptid'])?mysql_real_escape_string($_POST['deptid']):$_GET['deptid'];
	  @$semester=mysql_real_escape_string($_POST['semester'])?mysql_real_escape_string($_POST['semester']):$_GET['semester'];
	  @$stdadsem=mysql_real_escape_string($_POST['stdadsem'])?mysql_real_escape_string($_POST['stdadsem']):$_GET['stdadsem'];
	  @$year=mysql_real_escape_string($_POST['year'])?mysql_real_escape_string($_POST['year']):$_GET['year'];
	  @$session=mysql_real_escape_string($_POST['session'])?mysql_real_escape_string($_POST['session']):$_GET['session'];
	  @$heldmonths=mysql_real_escape_string($_POST['heldmonths'])?mysql_real_escape_string($_POST['heldmonths']):$_GET['heldmonths'];

	  //--------Should Open---------
	  //$updaf="UPDATE tbl_assignfaculty set status='1', attndstatus='1' where deptid='$deptid' and semesterid='$semester' and session='$session' and courseid in(select courseid from tbl_marksentryfinal m  where m.deptid='$deptid' and m.semesterid='$semester' and m.session='$session')";
	  //$afop=$myDb->update_sql($updaf);



	  $stqP=$myDb->select("select*from tbl_stdinfo where deptname='$deptid' and semester='$semester' and session='$session'");
		  $stdROW=mysql_num_rows($stqP);
		  $page = !empty($_POST['page'])?$_POST['page']:$_GET['page'];
		  if(empty($page)){
			$page=1;
		  }	
		  $page -= 1;
		  $perpage=20;
		  $start = $page * $perpage;
		  $totalPAGE=ceil($stdROW/$perpage);
		  
	?>

	<style type="text/css">
	 table{
		margin:0px;
		padding:0px;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		font-size:10px; 
	  }
	  td{
		 padding:2px;   

	  }	 	
	  .head{
		 font-weight:bold;
		 border:1px solid #333;
	  
	  }
	  .stdhead{
		 border-left:1px solid #333;
		 border-bottom:1px solid #333;

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
	<?php echo "<div style='width:110px; float:left;'><img src='logo.png' width='110' height='97' /></div>";
	echo "<div align='center'>";
	echo "<label><h1>Bangladesh Technical Education Board, Dhaka</h1></label>";
	echo "<label><h2>DIPLOMA-IN-ENGINEERING (Duration: 4-Years)</h3></label>";
	echo "<label><h2>3RD SEMESTER EXAMINATION, 2016</h3></label>";
	echo "</div>";

	 
	?>
	<div style='width:120px;float:right;border:1px solid #333;padding:5px;margin:2px;' ><a href='testTrabu.php?page=1&deptid=<?php echo $deptid; ?>&semester=<?php echo $semester; ?>&stdadsem=<?php echo $stdadsem; ?>&session=<?php echo $session; ?>&year=<?php echo $year; ?>&heldmonths=<?php echo $heldmonths; ?>&show=all'>PRINT VIEW</a></div>
	<br/>
	<br/>
	<br/>
	<div class="mainWRAP">

	<?php 



	$crs=$myDb->select("SELECT distinct d.id,d.name,c.coursename,c.coursecode,s.name,ss.session,ss.year
							  FROM tbl_semesterwisesubj ss						  
							  inner join tbl_department d
							  on ss.deptid=d.id
							  inner join tbl_courses c
							  on ss.courseid=c.id
							  inner join tbl_semester s
							  on ss.semesterid=s.id
							  where ss.deptid='$deptid'
							  and ss.semesterid='$semester'
							  
							  and ss.courseid in(select courseid from tbl_marksentryfinal m  where m.deptid='$deptid'
												  and m.semesterid='$semester'
												  and m.session='$session'

												  )
								group by c.coursename
							  order by c.id
							  "); 	
							  
		   $mainROW=mysql_num_rows($crs);
		   echo "<table cellpadding='0' cellspacing='0'>";
		   echo "<tr>";
		   echo "<td class='head'>Subject Code & Name</td>";
		   
		   while($row=$myDb->get_row($crs,'MYSQL_ASSOC')){

			   echo "<td colspan='3' class='head'>".$row['coursename']."</td>";
		   }					
			 echo "<td colspan=2 class='head'>Result</td>";
			 echo "<tr>"; 
			 echo "<td class='head'>&nbsp;</td>";
			 
			 $crsm=$myDb->select("SELECT distinct c.id,c.coursename,c.cont_assess_t,c.f_exam_t,c.cont_assess_p,c.f_exam_p,(c.cont_assess_t+c.f_exam_t+c.cont_assess_p+c.f_exam_p) TotalMark
							 FROM tbl_semesterwisesubj ss						  
							  inner join tbl_department d
							  on ss.deptid=d.id
							  inner join tbl_courses c
							  on ss.courseid=c.id
							  inner join tbl_semester s
							  on ss.semesterid=s.id
							  where ss.deptid='$deptid'
							  and ss.semesterid='$semester'
							 
							  and ss.courseid in(select courseid from tbl_marksentryfinal m  where m.deptid='$deptid'
												  and m.semesterid='$semester'
												  and m.session='$session'

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
			 echo "<td class='stdhead'>Student ID<br/><hr>Student Name<br/><hr>Roll No<br/><hr>Reg No<br/><hr>Session</td>";
			 $crsp=$myDb->select("SELECT distinct c.id,c.cont_assess_t,c.f_exam_t,c.cont_assess_p,c.f_exam_p
							 FROM tbl_semesterwisesubj ss						  
							  inner join tbl_department d
							  on ss.deptid=d.id
							  inner join tbl_courses c
							  on ss.courseid=c.id
							  inner join tbl_semester s
							  on ss.semesterid=s.id
							  where ss.deptid='$deptid'
							  and ss.semesterid='$semester'
							  
							  and ss.courseid in(select courseid from tbl_marksentryfinal m where m.deptid='$deptid'
													  and m.semesterid='$semester'
													  and m.session='$session'

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
		  //$stq=$myDb->select("select*from tbl_stdinfo where deptname=18 and semester=7 LIMIT $start, $perpage");
		  //$stq=$myDb->select("select*from tbl_stdinfo where deptname='$deptid' and semester='$semester' and session='$session' LIMIT $start, $perpage");
		  $stq=$myDb->select("select*from tbl_stdinfo where deptname='$deptid' and semester='$semester' and session='$session'");

		  while($stqf=$myDb->get_row($stq,'MYSQL_ASSOC')){	  
			  echo "<tr>";
			  echo "<td>";
			  echo "<table class='stdhead'>";
				echo "<tr>";
				echo "<td >".$stqf['stdid']."<br/><hr>".$stqf['stdname']."<br/><hr>".$stqf['boardrollno']."<br/><hr>".$stqf['boardregno']."<br/><hr>".$stqf['session']."</td>";
				echo "</tr>";	  
				echo "</table>";
				echo "</td>";
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
				//echo $totalROW;
				if($totalROW>0){
				$fl=0;$fs=0;$crsid='';
				while($iscrsf=$myDb->get_row($iscrs,'MYSQL_ASSOC')){
				 $incs=$myDb->select("SELECT distinct c.id,c.credit,m.stdid, m.examname, m.session, 
									  m.deptid, m.courseid, m.year, m.semesterid, 
									  (c.cont_assess_t+c.f_exam_t+c.cont_assess_p+c.f_exam_p) as TotalMarks
									  FROM `tbl_marksentryfinal` m 
									  inner join tbl_courses c 
									  on m.courseid=c.id 
									  WHERE m.deptid='$iscrsf[deptid]' 
									  and m.courseid= '$iscrsf[courseid]' 
									  and m.semesterid='$iscrsf[semesterid]' 
									  and m.session='$iscrsf[session]' 
									  and m.stdid='$iscrsf[stdid]'
									 ");
				 $incsf=$myDb->get_row($incs,'MYSQL_ASSOC');
				 $sum44=$incsf['TotalMarks'];
				
				
				
				
				$sumtc=$iscrsf['classtestmarks']+$iscrsf['quiztestmarks']+$iscrsf['attendancemarks'];
				$sumpc=($iscrsf['jobexpr']+$iscrsf['hwmarks']+$iscrsf['jobexprreport']+$iscrsf['jobexprviva']+$iscrsf['attendancemarksprac']+
					   $iscrsf['behaviormarks']);
				$sumtf=$iscrsf['finalexammarks'];	
				$sumpf=($iscrsf['jobexprfinal']+$iscrsf['jobexprreportfinal']+$iscrsf['jobexprvivafinal']);   
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
				echo "<td align='center' class='head'>".$total."<br/><hr><br/>".$cgpa."<br/><hr>".$grade."</td>";
					if($grade=="F"){
					   // $fs=$fs+$fl;
					    ++$fl;
					   $fs += 1;
					} 
	 
				 
				 $cdrt =($cdrt+$incsf['credit']);
		
				 $totalGP=($totalGP+($incsf['credit']*$cgpa));
				 $Lg=round($totalGP,2)/$cdrt;
				 }
						if($fs==0){
						  $status="Pass";
						}else if($fs<=3){
						  $status="Reff";
						}else{
						  $status="Fail";
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
			   
			   if($status == "Reff" || $status == "Fail"){
				  $Lg = 0; 
				  $fgrade = "F";
				  
			   }
			   
				echo "<td align='center' class='head'>".round($Lg,2)."<br/><hr>".$fgrade."</td>";
				echo "<td align='center' class='head'>".$status."</td>";
			  echo " </tr>";	
		 } 
		 
		 
	?>
	<div class="mainWRAP"></div>
	<?php 
		echo "<tr>";
		echo "</table>";



	   }else{
		 $msg="Sorry,you are not authorized to access this page";
		 header("Location:home.php?msg=$msg");
	   }	 

	}else{
	  header("Location:login.php");
	}
	}  
	?>


 <!--new code end-->
<?php } else{
	//echo "new logic";
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='studentstabulationsheet.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){ 
  @$deptid=mysql_real_escape_string($_POST['deptid'])?mysql_real_escape_string($_POST['deptid']):$_GET['deptid'];
  @$semester=mysql_real_escape_string($_POST['semester'])?mysql_real_escape_string($_POST['semester']):$_GET['semester'];
  @$stdadsem=mysql_real_escape_string($_POST['stdadsem'])?mysql_real_escape_string($_POST['stdadsem']):$_GET['stdadsem'];
  @$year=mysql_real_escape_string($_POST['year'])?mysql_real_escape_string($_POST['year']):$_GET['year'];
  @$session=mysql_real_escape_string($_POST['session'])?mysql_real_escape_string($_POST['session']):$_GET['session'];
  @$heldmonths=mysql_real_escape_string($_POST['heldmonths'])?mysql_real_escape_string($_POST['heldmonths']):$_GET['heldmonths'];

  //--------Should Open---------
  //$updaf="UPDATE tbl_assignfaculty set status='1', attndstatus='1' where deptid='$deptid' and semesterid='$semester' and session='$session' and courseid in(select courseid from tbl_marksentryfinal m  where m.deptid='$deptid' and m.semesterid='$semester' and m.session='$session')";
  //$afop=$myDb->update_sql($updaf);



  $stqP=$myDb->select("select*from tbl_stdinfo where deptname='$deptid' and semester='$semester' and session='$session'");
	  $stdROW=mysql_num_rows($stqP);
	  $page = !empty($_POST['page'])?$_POST['page']:$_GET['page'];
	  if(empty($page)){
	    $page=1;
	  }	
	  $page -= 1;
	  $perpage=20;
	  $start = $page * $perpage;
	  $totalPAGE=ceil($stdROW/$perpage);
	  
?>

<style type="text/css">
 table{
    margin:0px;
	padding:0px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:10px; 
  }
  td{
     padding:2px;   

  }	 	
  .head{
     font-weight:bold;
	 border:1px solid #333;
  
  }
  .stdhead{
	 border-left:1px solid #333;
	 border-bottom:1px solid #333;

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
<?php echo "<div style='width:110px; float:left;'><img src='logo.png' width='110' height='97' /></div>";
echo "<div align='center'>";
echo "<label><h1>Bangladesh Technical Education Board, Dhaka</h1></label>";
echo "<label><h2>DIPLOMA-IN-ENGINEERING (Duration: 4-Years)</h3></label>";
echo "<label><h2>3RD SEMESTER EXAMINATION, 2016</h3></label>";
echo "</div>";

 
?>
<div style='width:120px;float:right;border:1px solid #333;padding:5px;margin:2px;' ><a href='testTrabu.php?page=1&deptid=<?php echo $deptid; ?>&semester=<?php echo $semester; ?>&stdadsem=<?php echo $stdadsem; ?>&session=<?php echo $session; ?>&year=<?php echo $year; ?>&heldmonths=<?php echo $heldmonths; ?>&show=all'>PRINT VIEW</a></div>
<br/>
<br/>
<br/>
<div class="mainWRAP">

<?php 



$crs=$myDb->select("SELECT distinct d.id,d.name,c.coursename,c.coursecode,s.name,ss.session,ss.year
                          FROM tbl_semesterwisesubj ss						  
						  inner join tbl_department d
						  on ss.deptid=d.id
						  inner join tbl_courses c
						  on ss.courseid=c.id
						  inner join tbl_semester s
						  on ss.semesterid=s.id
						  where ss.deptid='$deptid'
						  and ss.semesterid='$semester'
						  
						  and ss.courseid in(select courseid from tbl_marksentryfinal m  where m.deptid='$deptid'
											  and m.semesterid='$semester'
											  and m.session='$session'

											  )

						  order by c.id
						  "); 	
						  
       $mainROW=mysql_num_rows($crs);
	   echo "<table cellpadding='0' cellspacing='0'>";
	   echo "<tr>";
       echo "<td class='head'>Subject Code & Name</td>";
	   
	   while($row=$myDb->get_row($crs,'MYSQL_ASSOC')){

		   echo "<td colspan='3' class='head'>".$row['coursename']."</td>";
	   }					
	     echo "<td colspan=2 class='head'>Result</td>";
	     echo "<tr>"; 
		 echo "<td class='head'>&nbsp;</td>";
		 
		 $crsm=$myDb->select("SELECT distinct c.id,c.coursename,c.cont_assess_t,c.f_exam_t,c.cont_assess_p,c.f_exam_p,(c.cont_assess_t+c.f_exam_t+c.cont_assess_p+c.f_exam_p) TotalMark
                         FROM tbl_semesterwisesubj ss						  
						  inner join tbl_department d
						  on ss.deptid=d.id
						  inner join tbl_courses c
						  on ss.courseid=c.id
						  inner join tbl_semester s
						  on ss.semesterid=s.id
						  where ss.deptid='$deptid'
						  and ss.semesterid='$semester'
						 
						  and ss.courseid in(select courseid from tbl_marksentryfinal m  where m.deptid='$deptid'
											  and m.semesterid='$semester'
											  and m.session='$session'

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
		 echo "<td class='stdhead'>Student ID<br/><hr>Student Name<br/><hr>Roll No<br/><hr>Reg No<br/><hr>Session</td>";
		 $crsp=$myDb->select("SELECT distinct c.id,c.cont_assess_t,c.f_exam_t,c.cont_assess_p,c.f_exam_p
                         FROM tbl_semesterwisesubj ss						  
						  inner join tbl_department d
						  on ss.deptid=d.id
						  inner join tbl_courses c
						  on ss.courseid=c.id
						  inner join tbl_semester s
						  on ss.semesterid=s.id
						  where ss.deptid='$deptid'
						  and ss.semesterid='$semester'
						  
						  and ss.courseid in(select courseid from tbl_marksentryfinal m where m.deptid='$deptid'
												  and m.semesterid='$semester'
												  and m.session='$session'

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
	  //$stq=$myDb->select("select*from tbl_stdinfo where deptname=18 and semester=7 LIMIT $start, $perpage");
	  //$stq=$myDb->select("select*from tbl_stdinfo where deptname='$deptid' and semester='$semester' and session='$session' LIMIT $start, $perpage");
	  $stq=$myDb->select("select*from tbl_stdinfo where deptname='$deptid' and semester='$semester' and session='$session'");

	  while($stqf=$myDb->get_row($stq,'MYSQL_ASSOC')){	  
		  echo "<tr>";
		  echo "<td>";
		  echo "<table class='stdhead'>";
			echo "<tr>";
			echo "<td >".$stqf['stdid']."<br/><hr>".$stqf['stdname']."<br/><hr>".$stqf['boardrollno']."<br/><hr>".$stqf['boardregno']."<br/><hr>".$stqf['session']."</td>";
			echo "</tr>";	  
			echo "</table>";
			echo "</td>";
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
			//echo $totalROW;
			
			if($totalROW>0){
			$fl=0;$fs=0;$crsid='';
			while($iscrsf=$myDb->get_row($iscrs,'MYSQL_ASSOC')){
			 $incs=$myDb->select("SELECT distinct c.id,c.credit,m.stdid, m.examname, m.session, 
								  m.deptid, m.courseid, m.year, m.semesterid, 
								  c.cont_assess_t as TCMarks,
								  c.f_exam_t as TFMarks,
								  c.cont_assess_p as PCMarks,
								  c.f_exam_p as PFMarks,								  
								  (c.cont_assess_t+c.f_exam_t+c.cont_assess_p+c.f_exam_p) as TotalMarks
								  FROM `tbl_marksentryfinal` m 
								  inner join tbl_courses c 
								  on m.courseid=c.id 
								  WHERE m.deptid='$iscrsf[deptid]' 
								  and m.courseid= '$iscrsf[courseid]' 
								  and m.semesterid='$iscrsf[semesterid]' 
								  and m.session='$iscrsf[session]' 
								  and m.stdid='$iscrsf[stdid]'
								 ");
			 $incsf=$myDb->get_row($incs,'MYSQL_ASSOC');
			 $TCmarks=$incsf['TCMarks'];
			 $TFmarks=$incsf['TFMarks'];
			 $PCmarks=$incsf['PCMarks'];
			 $PFmarks=$incsf['PFMarks'];
			 
			 $sum44=$incsf['TotalMarks'];			
			
			$sumtc=$iscrsf['classtestmarks']+$iscrsf['quiztestmarks']+$iscrsf['attendancemarks']+$iscrsf['midterm']+$iscrsf['assignment'];
			$sumpc=($iscrsf['jobexpr']+$iscrsf['hwmarks']+$iscrsf['jobexprreport']+$iscrsf['jobexprviva']+$iscrsf['attendancemarksprac']+
				   $iscrsf['behaviormarks']);
			$sumtf=$iscrsf['finalexammarks'];	
			$sumpf=($iscrsf['jobexprfinal']+$iscrsf['jobexprreportfinal']+$iscrsf['jobexprvivafinal']);   
			$total=($sumtc+$sumpc+$sumtf+$sumpf);
			
			$OTC=0;$OTF=0;$OPC=0;$OPF=0;
			if($TCmarks > 0){$OTC = ($sumtc/$TCmarks)*100;}
			if($TFmarks > 0){$OTF = ($sumtf/$TFmarks)*100;}
			if($PCmarks > 0){$OPC = ($sumpc/$PCmarks)*100;}
			if($PFmarks > 0){$OPF = ($sumpf/$PFmarks)*100;}	
			//echo $TCmarks.",".$TFmarks.",".$PCmarks.",".$PFmarks."<br/>";
			//echo $OTC.",".$OTF.",".$OPC.",".$OPF."<br/>";
			//new code start
			// function SetResultF(){
				// $grade="F";
				  // $cgpa=0.00;
			// }
			// function SetResult($total,$sum44){
				
				
				//exit;
			// }
			//new code end
					if(($TCmarks > 0) && ($TFmarks > 0) && ($PCmarks > 0) && ($PFmarks > 0))
					{
						if(($OTC >= 40) && ($OTF >= 40) && ($OPC >= 40) && ($OPF >= 40))
						{
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
						}else{
							$grade="F";
							$cgpa=0.00;
						}
					}
					else if(($TCmarks > 0) && ($TFmarks > 0) && ($PCmarks > 0) && ($PFmarks == 0))
					{
						if(($OTC >= 40) && ($OTF >= 40) && ($OPC >= 40))
						{
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
						}else{
							$grade="F";
							$cgpa=0.00;
						}
					}
					else if(($TCmarks > 0) && ($TFmarks > 0) && ($PCmarks == 0) && ($PFmarks > 0))
					{
						if(($OTC >= 40) && ($OTF >= 40) && ($OPF >= 40))
						{
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
						}else{
								$grade="F";
							$cgpa=0.00;
						}
					}
					else if(($TCmarks > 0) && ($TFmarks == 0) && ($PCmarks > 0) && ($PFmarks > 0))
					{
						if(($OTC >= 40) && ($OPC >= 40) && ($OPF >= 40))
						{
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
						}else{
								$grade="F";
							$cgpa=0.00;
						}
					}
					else if(($TCmarks == 0) && ($TFmarks > 0) && ($PCmarks > 0) && ($PFmarks > 0))
					{
						if(($OTF >= 40) && ($OPC >= 40) && ($OPF >= 40))
						{
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
						}else{
								$grade="F";
							$cgpa=0.00;
						}
					}
					else if(($TCmarks == 0) && ($TFmarks == 0) && ($PCmarks > 0) && ($PFmarks > 0))
					{
						if(($OPC >= 40) && ($OPF >= 40))
						{
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
						}else{
								$grade="F";
							$cgpa=0.00;
						}
					}
					else if(($TCmarks == 0) && ($TFmarks > 0) && ($PCmarks == 0) && ($PFmarks > 0))
					{
						if(($OTF >= 40) && ($OPF >= 40))
						{
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
						}else{
								$grade="F";
							$cgpa=0.00;
						}
					}
					else if(($TCmarks == 0) && ($TFmarks > 0) && ($PCmarks > 0) && ($PFmarks == 0))
					{
						if(($OTF >= 40) && ($OPC >= 40))
						{
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
						}else{
								$grade="F";
							$cgpa=0.00;
						}
					}
					else if(($TCmarks > 0) && ($TFmarks == 0) && ($PCmarks == 0) && ($PFmarks > 0))
					{
						if(($OTC >= 40) &&  ($OPF >= 40))
						{
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
						}else{
								$grade="F";
							$cgpa=0.00;
						}
					}
					else if(($TCmarks > 0) && ($PCmarks > 0) )
					{
						if(($OTC >= 40) && ($OPC >= 40))
						{
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
						}else{
								$grade="F";
							$cgpa=0.00;
						}
					}
					else if(($TCmarks > 0) && ($TFmarks > 0) && ($PCmarks == 0) && ($PFmarks == 0))
					{
						if(($OTC >= 40) && ($OTF >= 40))
						{
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
						}else{
								$grade="F";
							$cgpa=0.00;
						}
					}
					else if(($TCmarks == 0) && ($TFmarks == 0) && ($PCmarks == 0) && ($PFmarks > 0))
					{
						if(($OPF >= 40))
						{
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
						}else{
								$grade="F";
							$cgpa=0.00;
						}
					}
					else if(($TCmarks == 0) && ($TFmarks == 0) && ($PCmarks > 0) && ($PFmarks == 0))
					{
						if(($OPC >= 40))
						{
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
						}else{
								$grade="F";
							$cgpa=0.00;
						}
					}
					else if(($TCmarks == 0) && ($TFmarks > 0) && ($PCmarks == 0) && ($PFmarks == 0))
					{
						if(($OTF >= 40))
						{
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
						}else{
								$grade="F";
							$cgpa=0.00;
						}
					}
					else if(($TCmarks > 0) && ($TFmarks == 0) && ($PCmarks == 0) && ($PFmarks == 0))
					{
						if(($OTC >= 40))
						{
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
						}else{
								$grade="F";
							$cgpa=0.00;
						}
					}					
			
			echo "<td align='center' class='head'>".$sumtc."<br/><hr>".$sumpc."</td>";
			echo "<td align='center' class='head'>".$sumtf."<br/><hr>".$sumpf."</td>";
			echo "<td align='center' class='head'>".$total."<br/><hr><br/>".$cgpa."<br/><hr>".$grade."</td>";
				if($grade=="F"){
				   // $fs=$fs+$fl;
				    ++$fl;
				   $fs += 1;
				} 
 
			 
			 $cdrt =($cdrt+$incsf['credit']);
	
			 $totalGP=($totalGP+($incsf['credit']*$cgpa));
			 $Lg=round($totalGP,2)/$cdrt;
			 }
					if($fs==0){
						  $status="Pass";
						}else if($fs<=3){
						  $status="Reff";
						}else{
						  $status="Fail";
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
		   
		   if($status == "Reff" || $status == "Fail"){
				  $Lg = 0; 
				  $fgrade = "F";
				}
				
			echo "<td align='center' class='head'>".round($Lg,2)."<br/><hr>".$fgrade."</td>";
			echo "<td align='center' class='head'>".$status."</td>";
		  echo " </tr>";	
	 } 
	 
	 
?>
<div class="mainWRAP"></div>
<?php 
	echo "<tr>";
	echo "</table>";



   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
}
?>

