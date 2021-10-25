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
	     $pdf->Image('logo.png',10,5,25);
		 
//set report parameter query
	$dp="SELECT f.name as FacultyName, f.facultyid, d.name as DepartmentName FROM  tbl_faculty f inner join tbl_department d on f.deptid=d.id WHERE f.id='$_POST[faculty]'";
  	$dpq=$myDb->select($dp);
  	$cardp=$myDb->get_row($dpq,'MYSQL_ASSOC');
	$faculty=$cardp['FacultyName']." (".$cardp['facultyid'].")";
	$department=$cardp['DepartmentName'];


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
	$pdf->Cell(80, 10, 'Course Assign to Fculty Report',0,0,'C');
	
	$pdf->SetY(35);
	$pdf->SetX(63);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(80, 10, 'Faculty Name: ' .$faculty,0,0,'C');

	$pdf->SetY(40);
	$pdf->SetX(63);
	$pdf->Cell(80, 10, 'Department Name: '.$department,0,0,'C');
	
	$pdf->SetY(45);
	$pdf->SetX(63);
	$pdf->Cell(80, 10, 'Session: '.$_POST['session'],0,0,'C');
	
	$pdf->SetY(50);
	$pdf->SetX(63);
	$pdf->Cell(80, 10, 'Year: '.$_POST['year'],0,0,'C');
	
	$pdf->SetY(60);
	$pdf->SetX(150);
	$pdf->SetFont('Arial', '');
	$pdf->SetFont('Arial', 'U', 10);
	$pdf->Cell(80, 10, "Date: ".date('F j, Y'),0,0,'C');

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

$pdf->SetX(25);



$pdf->Cell(25, 6, 'Course Code', 1, 0, 'L', 1);
$pdf->Cell(65, 6, 'Course Name', 1, 0, 'L', 1);
$pdf->Cell(50, 6, 'Department', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'Semester', 1, 0, 'C', 1);
$pdf->Cell(15, 6, 'Group', 1, 0, 'C', 1);
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


$query="SELECT f.facultyid, f.name as FacultyName, d.name as DepartmentName, c.coursecode as CourseCode, c.coursename as CourseName, s.name as SemesterName, af.session, af.year, af.section FROM `tbl_assignfaculty` af inner join tbl_faculty f on af.facultyid=f.id inner join tbl_department d on af.deptid=d.id inner join tbl_courses c on af.courseid=c.id inner join tbl_semester s on af.semesterid=s.id WHERE af.facultyid='$_POST[faculty]' and af.session='$_POST[session]' and af.year='$_POST[year]'";	
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
		$pdf->Cell(65, 6, 'Course Name', 1, 0, 'L', 1);
		$pdf->Cell(50, 6, 'Department', 1, 0, 'C', 1);
		$pdf->Cell(25, 6, 'Semester', 1, 0, 'C', 1);
		$pdf->Cell(15, 6, 'Group', 1, 0, 'C', 1);
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

    $coursecode = $row['CourseCode'];
    $coursename = $row['CourseName'];
    $department = $row['DepartmentName'];
    $semester = $row['SemesterName'];
    $group = $row['section'];
    
    $pdf->SetY($y_axis);
    $pdf->SetX(25);

    $pdf->Cell(25, 6, $coursecode, 1, 0, 'L', 1);
    $pdf->Cell(65, 6, $coursename, 1, 0, 'L', 1);
    $pdf->Cell(50, 6, $department, 1, 0, 'L', 1);
    $pdf->Cell(25, 6, $semester, 1, 0, 'C', 1);
    $pdf->Cell(15, 6, $group, 1, 0, 'C', 1);

    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;


}
mysql_close();

//Create file
$pdf->Output();
?>