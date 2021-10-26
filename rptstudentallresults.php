<?php
//PDF USING MULTIPLE PAGES
//FILE CREATED BY: Carlos Jos� V�squez S�ez
//YOU CAN CONTACT ME: carlos@magallaneslibre.com
//FROM PUNTA ARENAS, MAGALLANES
//INOVO GROUP - http://www.inovo.cl

define('FPDF_FONTPATH', 'font/');
require('/fpdf.php');

//Connect to your database
require_once('dbClass.php');
include("config.php"); 
$myDb->connectDefaultServer()
 
//Create new pdf file
$pdf=new FPDF();

//Open file
$pdf->Open();

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage();

//set initial y axis position per page
$y_axis_initial = 75;
/*
class PDF extends FPDF
{

function Header()
{
    //Logo
    $this->Image('../logo.png',10,8,33);
    //Arial bold 15
    $this->SetFont('Arial','B',12);
    //Move to the right
    $this->Cell(80);
    //Title
    $this->Cell(30,10,'SAIC INSTITUTE OF AMANGEMENT & TECHNOLOGY',0,0,'C');  //in last 3 parameters 1st parameter set 0 means no border 1 means border
	$this->Cell(2, 30, 'Department Wise Book Information',0,'C',0);
	
	$this->SetFont('Arial','B',9);
    $this->Cell(50, 30, "Date: ".date('F j, Y'), 0,0, 'R');


    //Line break
    $this->Ln(30);
}
}
*/
//set the logo of the company    
	     $pdf->Image('logo.png',20,10,25);
		 
//set report parameter query
	$dp="SELECT*FROM  tbl_department WHERE id='$_POST[deptid]'";
  	$dpq=$myDb->select($dp);
  	$cardp=$myDb->get_row($dpq,'MYSQL_ASSOC');
	$dep=$cardp['name'];

  	$cr="SELECT*FROM  tbl_courses WHERE id='$_POST[courseid]'";
  	$crq=$myDb->select($cr);
  	$carcr=$myDb->get_row($crq,'MYSQL_ASSOC');
	$course= $carcr['coursename']." (".$carcr['coursecode'].")";	

  	$sm="SELECT*FROM  tbl_semester WHERE id='$_POST[semesterid]'";
  	$csm=$myDb->select($sm);
  	$carsm=$myDb->get_row($csm,'MYSQL_ASSOC');
	$semester=$carsm['name'];

	$iv="SELECT concat(stdid,'(',boardrollno,')') as stdid, stdname as stdname from tbl_stdinfo Where stdid='$_POST[stdid]'";
  	$ivq=$myDb->select($iv);
  	$ivrs=$myDb->get_row($ivq,'MYSQL_ASSOC');
	$stdid= $ivrs['stdid'];
	$stdname= $ivrs['stdname'];

//Position at 1.5 cm from bottom
    $pdf->SetY(-15);
    //Arial italic 8
    $pdf->SetFont('Arial','',8);
    //Page bottom
	$pdf->SetTextColor(232, 232, 232);
    $pdf->Cell(0,10,'Copyright: SAIC Institute of Management & Technology. Powered By: <a href="https://riaz.fastitbd.com">(Web Developer) </a><a href="https://www.saicgroupbd.com">Saic Group</a>. 12, Kawran Bazar. BDBL Bhaban (6th Floor). Dhaka-1215. Phone: 8189542.',0,0,'C');
    //Page number
	// page no is not defined

	//print column titles for the actual page
	//$pdf->Cell(-70, -600, 'SAIC Institute of Management & Technology',0,'C',0);
	$pdf->SetTextColor(0, 0, 0);

	$pdf->SetFont('Arial', 'U', 14);
	$pdf->Cell(-65, -490, 'Student Result Report',0,'C',0);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(-3, -475, 'Deaprtment:' .$dep,0,'C',0);
	$pdf->Cell(12, -465, 'Student Name: '.$stdname,0,'C',0);
	$pdf->Cell(-20, -455, 'Session: '.$_POST['session'],0,'C',0);
	$pdf->Cell(10, -445, 'Semester: '.$semester,0,'C',0);
	$pdf->Cell(1, -435, 'Student ID: '.$stdid,0,'C',0);
	$pdf->SetFont('Arial', '');
	$pdf->SetFont('Arial', 'U', 10);
	$pdf->Cell(0, -490, "Date: ".date('F j, Y'), 0,0, 'R');

// set the Report Header & Date
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetFillColor(235,234,230);
$pdf->Cell(-13,-535,"SAIC INSTITUTE OF MANAGEMENT & TECHNOLOGY",0,0,'R');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(-23,-522,"House # 1, Road # 2, Block # B, Section # 6, Mirpur, Dhaka - 1216",0,0,'R');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(-6,-513,"Phone: +88 02 8033034, +88 01936005816, +88 01936005817",0,0,'R');

//$pdf->Cell(5, -498, "Date:");


// set the table header color
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 10);

$pdf->SetY($y_axis_initial);

$pdf->SetX(25);



$pdf->Cell(25, 6, 'Course Code', 1, 0, 'L', 1);
$pdf->Cell(50, 6, 'Course Name', 1, 0, 'L', 1);
$pdf->Cell(20, 6, 'Full Marks', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Obtained Marks', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Grade Point(GP)', 1, 0, 'C', 1);
$pdf->Cell(15, 6, 'Grade', 1, 0, 'C', 1);
// set table body color
$pdf->SetFillColor(255, 255, 255);

$row_height = 6;

$y_axis = 75;
$y_axis = $y_axis + $row_height;

//Select the query you want to show in your PDF file

//$query="SELECT concat(c.coursename,' (',coursecode,')') as CourseName , sr.gp as GP, sr.grade as Grade FROM `tbl_stdresult` sr inner join tbl_stdinfo s on sr.stdid=s.stdid inner join tbl_courses c on sr.courseid=c.id WHERE sr.deptid='$_POST[deptid]' and sr.session='$_POST[session]' and sr.semesterid='$_POST[semesterid]' and sr.stdid='$_POST[stdid]'  order by sr.id";
//$result = mysql_query($query) or die(mysql_error());



//initialize counter
$i = 0;

//Set maximum rows per page
$max = 32;

//Set Row Height


$crs="SELECT mf.courseid, c.coursecode, c.coursename FROM tbl_courses c, tbl_marksentryfinal mf WHERE c.id= mf.courseid and mf.deptid='$_POST[deptid]' and mf.stdid= '$_POST[stdid]' and mf.semesterid='$_POST[semesterid]' and mf.session='$_POST[session]' and mf.year='$_POST[eyear]'";
  				  
$crq=$myDb->select($crs); 
while($crsr=$myDb->get_row($crq,'MYSQL_ASSOC'))
{
//$count=0;
$query="SELECT distinct m.stdid, c.coursecode, c.coursename, m.examname, m.session, m.deptid, m.courseid, m.year, m.semesterid, (c.cont_assess_t+c.f_exam_t+c.cont_assess_p+c.f_exam_p) as TotalMarks,
						((select classtestmarks from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semesterid]' and session='$_POST[session]' and year='$_POST[eyear]'  and stdid='$_POST[stdid]') +
						(select quiztestmarks from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semesterid]' and session='$_POST[session]' and year='$_POST[eyear]' and stdid='$_POST[stdid]') +
						(select `hwmarks` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semesterid]' and session='$_POST[session]' and year='$_POST[eyear]' and stdid='$_POST[stdid]') +
						(select `jobexpr` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semesterid]' and session='$_POST[session]' and year='$_POST[eyear]' and stdid='$_POST[stdid]') +
						(select `jobexprfinal` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semesterid]' and session='$_POST[session]' and year='$_POST[eyear]' and stdid='$_POST[stdid]') +
						(select `jobexprreport` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semesterid]' and session='$_POST[session]' and year='$_POST[eyear]' and stdid='$_POST[stdid]') +
						(select `jobexprreportfinal` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semesterid]' and session='$_POST[session]' and year='$_POST[eyear]' and stdid='$_POST[stdid]') +
						(select `jobexprviva` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semesterid]' and session='$_POST[session]' and year='$_POST[eyear]' and stdid='$_POST[stdid]') +
						(select `jobexprvivafinal` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semesterid]' and session='$_POST[session]' and year='$_POST[eyear]' and stdid='$_POST[stdid]') +
						(select `attendancemarks` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semesterid]' and session='$_POST[session]' and year='$_POST[eyear]' and stdid='$_POST[stdid]') +
						(select `attendancemarksprac` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semesterid]' and session='$_POST[session]' and year='$_POST[eyear]' and stdid='$_POST[stdid]') +
						(select `behaviormarks` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semesterid]' and session='$_POST[session]' and year='$_POST[eyear]' and stdid='$_POST[stdid]') +
						(select `finalexamprac` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semesterid]' and session='$_POST[session]' and year='$_POST[eyear]' and stdid='$_POST[stdid]') +
						(select `finalexammarks` from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semesterid]' and session='$_POST[session]' and year='$_POST[eyear]' and stdid='$_POST[stdid]')) as obtainedmarks 
						FROM `tbl_marksentryfinal` m inner join tbl_courses c on m.courseid=c.id WHERE m.deptid='$_POST[deptid]' and m.courseid= '$crsr[courseid]' and m.semesterid='$_POST[semesterid]' and m.session='$_POST[session]' and m.year='$_POST[eyear]' and m.stdid='$_POST[stdid]'";	
$result = mysql_query($query) or die(mysql_error());



while($row = mysql_fetch_array($result))
{
//echo $row['obtainedmarks'];
//echo $row['TotalMarks']; 
	
	//If the current row is the last one, create new page and print column title
    if ($i == $max)
    {
		// SET NEXT PAGE START POSITION
		$y_axis_initial = 30;
		$y_axis = 30;
        $pdf->AddPage();

        //print column titles for the current page
        $pdf->SetY($y_axis_initial);
        $pdf->SetX(25);
		// set next page header color

		$pdf->SetFillColor(232, 232, 232);
		$pdf->SetFont('Arial', 'B', 10);


		$pdf->Cell(25, 6, 'Course Code', 1, 0, 'L', 1);
		$pdf->Cell(50, 6, 'Course Name', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'Full Marks', 1, 0, 'C', 1);
		$pdf->Cell(30, 6, 'Obtained Marks', 1, 0, 'C', 1);
		$pdf->Cell(30, 6, 'Grade Point(GP)', 1, 0, 'C', 1);
		$pdf->Cell(15, 6, 'Grade', 1, 0, 'C', 1);
		// set next page body color
		$pdf->SetFillColor(255, 255, 255);
        
        //Go to next row
        $y_axis = $y_axis + $row_height;
        
        //Set $i variable to 0 (first row)
        $i = 0;

    	//Page bottom in per page
    	$pdf->SetFont('Arial','',8);
		$pdf->SetTextColor(232, 232, 232);
    	$pdf->Cell(-180,510,'Copyright: SAIC Institute of Management & Technology. Powered By: <a href="https://riaz.fastitbd.com">(Web Developer) </a><a href="https://www.saicgroupbd.com">Saic Group</a>. 12, Kawran Bazar. BDBL Bhaban (6th Floor). Dhaka-1215. Phone: 8189542.',0,0,'C');

    }
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetFont('Arial', '', 8);

    $coursecode = $row['coursecode'];
    $coursename = $row['coursename'];
    $fullmarks = $row['TotalMarks'];
    $obtainedmarks = $row['obtainedmarks'];
    
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
		$gp = "3.00";
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


	$gp = $gp;//$row['session'];
    $grade = $grade;//$row['deptid'];

    $pdf->SetY($y_axis);
    $pdf->SetX(25);

    $pdf->Cell(25, 6, $coursecode, 1, 0, 'L', 1);
    $pdf->Cell(50, 6, $coursename, 1, 0, 'L', 1);
    $pdf->Cell(20, 6, $fullmarks, 1, 0, 'C', 1);
    $pdf->Cell(30, 6, $obtainedmarks, 1, 0, 'C', 1);
    $pdf->Cell(30, 6, $gp, 1, 0, 'C', 1);
    $pdf->Cell(15, 6, $grade, 1, 0, 'C', 1);

    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;

}
}
mysql_close();

//Create file
$pdf->Output();
?>