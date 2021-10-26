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
$y_axis_initial = 65;
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
	     $pdf->Image('logo.png',10,5,25);
		 
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

	$pdf->SetY(30);
	$pdf->SetX(63);
	$pdf->SetFont('Arial', 'U', 14);
	$pdf->Cell(80, 10, 'Student Result Report (Practical Contineous)',0,0,'C',0);

	$pdf->SetY(35);
	$pdf->SetX(63);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(80, 10, 'Deaprtment:' .$dep,0,0,'C',0);

	$pdf->SetY(40);
	$pdf->SetX(63);
	$pdf->Cell(80, 10, 'Course Name: '.$course,0,0,'C',0);

	$pdf->SetY(45);
	$pdf->SetX(63);
	$pdf->Cell(80, 10, 'Semester: '.$semester,0,0,'C',0);


	$pdf->SetY(50);
	$pdf->SetX(63);
	$pdf->Cell(80, 10, 'Session: '.$_POST['session'],0,0,'C',0);

	$pdf->SetFont('Arial', '');
	$pdf->SetFont('Arial', 'U', 10);
	//$pdf->Cell(0, -490, "Date: ".date('F j, Y'), 0,0, 'R');

// set the Report Header 
	$pdf->SetY(5);
	$pdf->SetX(67);

	$pdf->SetFont('Arial', 'B', 16);
	$pdf->SetFillColor(235,234,230);
	$pdf->Cell(80,10,"SAIC INSTITUTE OF MANAGEMENT & TECHNOLOGY",0,0,'C');

	$pdf->SetY(10);
	$pdf->SetX(67);

	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(80,10,"House # 1, Road # 2, Block # B, Section # 6, Mirpur, Dhaka - 1216",0,0,'C');

	$pdf->SetY(15);
	$pdf->SetX(67);

	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(80,10,"Phone: +88 02 8033034, +88 01936005816, +88 01936005817",0,0,'C');

//end of report header

//$pdf->Cell(5, -498, "Date:");


// set the table header color
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 10);

$pdf->SetY($y_axis_initial);

$pdf->SetX(10);



$pdf->Cell(10, 6, 'S.N.', 1, 0, 'L', 1);
$pdf->Cell(45, 6, 'Student Name', 1, 0, 'L', 1);
$pdf->Cell(20, 6, 'B.RollNo', 1, 0, 'C', 1);
$pdf->Cell(15, 6, 'T.Marks', 1, 0, 'C', 1);
$pdf->Cell(12, 6, 'JE', 1, 0, 'C', 1);
$pdf->Cell(12, 6, 'JER', 1, 0, 'C', 1);
$pdf->Cell(12, 6, 'HW', 1, 0, 'C', 1);
$pdf->Cell(12, 6, 'JEV', 1, 0, 'C', 1);
$pdf->Cell(12, 6, 'Behv', 1, 0, 'C', 1);
$pdf->Cell(12, 6, 'Attnd', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Obtained Marks', 1, 0, 'C', 1);
// set table body color
$pdf->SetFillColor(255, 255, 255);

$row_height = 6;

$y_axis = 65;
$y_axis = $y_axis + $row_height;

//Select the query you want to show in your PDF file

//$query="SELECT concat(c.coursename,' (',coursecode,')') as CourseName , sr.gp as GP, sr.grade as Grade FROM `tbl_stdresult` sr inner join tbl_stdinfo s on sr.stdid=s.stdid inner join tbl_courses c on sr.courseid=c.id WHERE sr.deptid='$_POST[deptid]' and sr.session='$_POST[session]' and sr.semesterid='$_POST[semesterid]' and sr.stdid='$_POST[stdid]'  order by sr.id";
//$result = mysql_query($query) or die(mysql_error());



//initialize counter
$i = 0;

//Set maximum rows per page
$max = 32;

//Set Row Height


$crs="SELECT mf.stdid FROM tbl_marksentryfinal mf inner join tbl_stdinfo s on mf.stdid=s.stdid WHERE mf.deptid='$_POST[deptid]' and mf.courseid= '$_POST[courseid]' and mf.semesterid='$_POST[semesterid]' and mf.session='$_POST[session]' and mf.year='$_POST[eyear]' order by s.boardrollno";
$crq=$myDb->select($crs); 

$i=1;
while($crsr=$myDb->get_row($crq,'MYSQL_ASSOC'))
{
//$count=0;
	  $query="SELECT distinct m.stdid, s.stdname, s.boardrollno, c.coursecode, c.coursename, m.examname, m.session, m.deptid, m.courseid, m.year, m.semesterid, c.cont_assess_p, (c.cont_assess_t+c.f_exam_t+c.cont_assess_p+c.f_exam_p) as TotalMarks,
						(select jobexpr from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_POST[courseid]' and semesterid='$_POST[semesterid]' and session='$_POST[session]' and year='$_POST[eyear]'  and stdid='$crsr[stdid]') as jobexpr,
						(select jobexprreport from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_POST[courseid]' and semesterid='$_POST[semesterid]' and session='$_POST[session]' and year='$_POST[eyear]' and stdid='$crsr[stdid]') as jobexprreport,						
						(select hwmarks from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_POST[courseid]' and semesterid='$_POST[semesterid]' and session='$_POST[session]' and year='$_POST[eyear]' and stdid='$crsr[stdid]') as hwmarks,
						(select jobexprviva from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_POST[courseid]' and semesterid='$_POST[semesterid]' and session='$_POST[session]' and year='$_POST[eyear]'  and stdid='$crsr[stdid]') as jobexprviva,
						(select behaviormarks from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_POST[courseid]' and semesterid='$_POST[semesterid]' and session='$_POST[session]' and year='$_POST[eyear]'  and stdid='$crsr[stdid]') as behaviormarks,
						(select attendancemarksprac from tbl_marksentryfinal WHERE deptid='$_POST[deptid]' and courseid= '$_POST[courseid]' and semesterid='$_POST[semesterid]' and session='$_POST[session]' and year='$_POST[eyear]'  and stdid='$crsr[stdid]') as attendancemarksprac
						FROM `tbl_marksentryfinal` m inner join tbl_courses c on m.courseid=c.id inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.courseid= '$_POST[courseid]' and m.semesterid='$_POST[semesterid]' and m.session='$_POST[session]' and m.year='$_POST[eyear]' and m.stdid='$crsr[stdid]' "; 

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


		$pdf->Cell(10, 6, 'S.N.', 1, 0, 'L', 1);
		$pdf->Cell(45, 6, 'Student Name', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'B.RollNo', 1, 0, 'C', 1);
		$pdf->Cell(15, 6, 'T.Marks', 1, 0, 'C', 1);
		$pdf->Cell(12, 6, 'JE', 1, 0, 'C', 1);
		$pdf->Cell(12, 6, 'JER', 1, 0, 'C', 1);
		$pdf->Cell(12, 6, 'HW', 1, 0, 'C', 1);
		$pdf->Cell(12, 6, 'JEV', 1, 0, 'C', 1);
		$pdf->Cell(12, 6, 'Behv', 1, 0, 'C', 1);
		$pdf->Cell(12, 6, 'Attnd', 1, 0, 'C', 1);
		$pdf->Cell(30, 6, 'Obtained Marks', 1, 0, 'C', 1);
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

    $stdname = $row['stdname'];
    $brollno = $row['boardrollno'];
	$totalmarkstpc = $row['cont_assess_p'];
	$je = $row['jobexpr'];
    $jer = $row['jobexprreport'];
    $hw = $row['hwmarks'];
	$jev = $row['jobexprviva'];
    $bhv = $row['behaviormarks'];
    $attndpc = $row['attendancemarksprac'];
    $totalom = $je + $jer + $hw + $jev + $bhv + $attndpc;



    $pdf->SetY($y_axis);
    $pdf->SetX(10);

    $pdf->Cell(10, 6, $i, 1, 0, 'L', 1);
    $pdf->Cell(45, 6, $stdname, 1, 0, 'L', 1);
    $pdf->Cell(20, 6, $brollno, 1, 0, 'C', 1);
    $pdf->Cell(15, 6, $totalmarkstpc, 1, 0, 'C', 1);
    $pdf->Cell(12, 6, $je, 1, 0, 'C', 1);
    $pdf->Cell(12, 6, $jer, 1, 0, 'C', 1);
    $pdf->Cell(12, 6, $hw, 1, 0, 'C', 1);
    $pdf->Cell(12, 6, $jev, 1, 0, 'C', 1);
    $pdf->Cell(12, 6, $bhv, 1, 0, 'C', 1);
    $pdf->Cell(12, 6, $attndpc, 1, 0, 'C', 1);
    $pdf->Cell(30, 6, $totalom, 1, 0, 'C', 1);

    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;

}
}
mysql_close();

//Create file
$pdf->Output();
?>