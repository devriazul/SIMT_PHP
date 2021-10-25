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
$y_axis_initial = 55;
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
	$dp="SELECT * from tbl_department Where id='$_POST[department]' and storedstatus<>'D'";
  	$dpq=$myDb->select($dp);
  	$cardp=$myDb->get_row($dpq,'MYSQL_ASSOC');
	$department=$cardp['name'];

	$sm="SELECT * from tbl_semester Where id='$_POST[semester]' and storedstatus<>'D'";
  	$smq=$myDb->select($sm);
  	$carsm=$myDb->get_row($smq,'MYSQL_ASSOC');
	$semester=$carsm['name'];


//Position at 1.5 cm from bottom
    $pdf->SetY(-15);
    //Arial italic 8
    $pdf->SetFont('Arial','',8);
    //Page bottom
	$pdf->SetTextColor(232, 232, 232);
    $pdf->Cell(0,10,'Copyright: SAIC Institute of Management & Technology. Powered By: DesktopBD. 12, Kawran Bazar. BDBL Bhaban (6th Floor). Dhaka-1215. Phone: 8189542.',0,0,'C');
    //Page number
	// page no is not defined

	//print column titles for the actual page
	//$pdf->Cell(-70, -600, 'SAIC Institute of Management & Technology',0,'C',0);
	$pdf->SetTextColor(0, 0, 0);

	$pdf->SetY(30);
	$pdf->SetX(63);

	$pdf->SetFont('Arial', 'U', 14);
	$pdf->Cell(80, 10, 'Semester wise Course Report',0,0,'C');

	$pdf->SetY(35);
	$pdf->SetX(63);

	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(80, 10, 'Department Name: ' .$department,0,0,'C');
	$pdf->SetY(40);
	$pdf->SetX(63);

	$pdf->Cell(80, 10, 'Semester Name: '.$semester,0,0,'C');
	//$pdf->Cell(-20, -455, 'Session: '.$_POST['session'],0,'L',0);
	//$pdf->Cell(-2, -445, 'Year: '.$_POST['year'],0,'L',0);

//set print Date
	$pdf->SetY(40);
	$pdf->SetX(120);

	$pdf->SetFont('Arial', '');
	$pdf->SetFont('Arial', 'U', 10);
	$pdf->Cell(80, 10, "Date: ".date('F j, Y'), 0,0, 'R');


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

$pdf->SetX(15);


$pdf->Cell(10, 6, 'SN.', 1, 0, 'L', 1);
$pdf->Cell(18, 6, 'C.Code', 1, 0, 'L', 1);
$pdf->Cell(65, 6, 'Course Name', 1, 0, 'L', 1);
$pdf->Cell(13, 6, 'Credit', 1, 0, 'C', 1);
$pdf->Cell(15, 6, 'T.C.A', 1, 0, 'C', 1);
$pdf->Cell(15, 6, 'T.F.E', 1, 0, 'C', 1);
$pdf->Cell(15, 6, 'P.C.A', 1, 0, 'C', 1);
$pdf->Cell(15, 6, 'P.F.E', 1, 0, 'C', 1);
$pdf->Cell(20, 6, 'Total Marks', 1, 0, 'C', 1);
// set table body color
$pdf->SetFillColor(255, 255, 255);

$row_height = 6;

$y_axis = 55;
$y_axis = $y_axis + $row_height;

//Select the query you want to show in your PDF file

//$query="SELECT concat(c.coursename,' (',coursecode,')') as CourseName , sr.gp as GP, sr.grade as Grade FROM `tbl_stdresult` sr inner join tbl_stdinfo s on sr.stdid=s.stdid inner join tbl_courses c on sr.courseid=c.id WHERE sr.deptid='$_POST[deptid]' and sr.session='$_POST[session]' and sr.semesterid='$_POST[semesterid]' and sr.stdid='$_POST[stdid]'  order by sr.id";
//$result = mysql_query($query) or die(mysql_error());



//initialize counter
$i = 1;

//Set maximum rows per page
$max = 32;

//Set Row Height

//--------------previous-----------
//$query="SELECT tbl_semesterwisesubj.id id, tbl_semesterwisesubj.session, tbl_semester.name as SemesterName, tbl_department.name as DepartmentName,tbl_courses.coursecode,tbl_courses.coursename as CourseName, tbl_courses.credit ,tbl_courses.theory, tbl_courses.practical, tbl_courses.cont_assess_t, tbl_courses.f_exam_t, tbl_courses.cont_assess_p, tbl_courses.f_exam_p FROM tbl_semesterwisesubj inner join tbl_semester on tbl_semesterwisesubj.semesterid=tbl_semester.id inner join tbl_department on tbl_semesterwisesubj.deptid=tbl_department.id 	inner join tbl_courses on tbl_semesterwisesubj.courseid=tbl_courses.id WHERE tbl_semesterwisesubj.storedstatus <>'D'  and tbl_semesterwisesubj.session='$_POST[session]'	and tbl_semesterwisesubj.semesterid='$_POST[semester]' and tbl_semesterwisesubj.deptid='$_POST[department]'";	
$query="SELECT tbl_semesterwisesubj.id id, tbl_semesterwisesubj.session, tbl_semester.name as SemesterName, tbl_department.name as DepartmentName,tbl_courses.coursecode,tbl_courses.coursename as CourseName, tbl_courses.credit ,tbl_courses.theory, tbl_courses.practical, tbl_courses.cont_assess_t, tbl_courses.f_exam_t, tbl_courses.cont_assess_p, tbl_courses.f_exam_p FROM tbl_semesterwisesubj inner join tbl_semester on tbl_semesterwisesubj.semesterid=tbl_semester.id inner join tbl_department on tbl_semesterwisesubj.deptid=tbl_department.id 	inner join tbl_courses on tbl_semesterwisesubj.courseid=tbl_courses.id WHERE tbl_semesterwisesubj.storedstatus <>'D'  and tbl_semesterwisesubj.semesterid='$_POST[semester]' and tbl_semesterwisesubj.deptid='$_POST[department]'";	
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
        $pdf->SetX(15);
		// set next page header color

		$pdf->SetFillColor(232, 232, 232);
		$pdf->SetFont('Arial', 'B', 10);

		$pdf->Cell(10, 6, 'SN.', 1, 0, 'L', 1);
		$pdf->Cell(18, 6, 'C.Code', 1, 0, 'L', 1);
		$pdf->Cell(65, 6, 'Course Name', 1, 0, 'L', 1);
		$pdf->Cell(13, 6, 'Credit', 1, 0, 'C', 1);
		$pdf->Cell(15, 6, 'T.C.A', 1, 0, 'C', 1);
		$pdf->Cell(15, 6, 'T.F.E', 1, 0, 'C', 1);
		$pdf->Cell(15, 6, 'P.C.A', 1, 0, 'C', 1);
		$pdf->Cell(15, 6, 'P.F.E', 1, 0, 'C', 1);
		$pdf->Cell(20, 6, 'Total Marks', 1, 0, 'C', 1);
		// set next page body color
		$pdf->SetFillColor(255, 255, 255);
        
        //Go to next row
        $y_axis = $y_axis + $row_height;
        
        //Set $i variable to 0 (first row)
        $i = 0;

    	//Page bottom in per page
    	$pdf->SetFont('Arial','',8);
		$pdf->SetTextColor(232, 232, 232);
    	$pdf->Cell(-180,510,'Copyright: SAIC Institute of Management & Technology. Powered By: DesktopBD. 12, Kawran Bazar. BDBL Bhaban (6th Floor). Dhaka-1215. Phone: 8189542.',0,0,'C');

    }
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetFont('Arial', '', 8);

    $coursecode = $row['coursecode'];
    $coursename = $row['CourseName'];
    $credit = $row['credit'];
    $tca = $row['cont_assess_t'];
    $tfe = $row['f_exam_t'];
    $pca = $row['cont_assess_p'];
    $pfe = $row['f_exam_p'];
    $totalmarks = $row['cont_assess_t'] + $row['f_exam_t'] + $row['cont_assess_p'] + $row['f_exam_p'];
    
    $pdf->SetY($y_axis);
    $pdf->SetX(15);

    $pdf->Cell(10, 6, $i, 1, 0, 'L', 1);
    $pdf->Cell(18, 6, $coursecode, 1, 0, 'L', 1);
    $pdf->Cell(65, 6, $coursename, 1, 0, 'L', 1);
    $pdf->Cell(13, 6, $credit, 1, 0, 'C', 1);
    $pdf->Cell(15, 6, $tca, 1, 0, 'C', 1);
    $pdf->Cell(15, 6, $tfe, 1, 0, 'C', 1);
    $pdf->Cell(15, 6, $pca, 1, 0, 'C', 1);
    $pdf->Cell(15, 6, $pfe, 1, 0, 'C', 1);
    $pdf->Cell(20, 6, $totalmarks, 1, 0, 'C', 1);

    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;


}
mysql_close();

//Create file
$pdf->Output();
?>