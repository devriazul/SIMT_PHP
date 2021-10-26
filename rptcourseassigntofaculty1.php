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


  	$sm="SELECT*FROM  tbl_semester WHERE id='$_POST[semester]'";
  	$csm=$myDb->select($sm);
  	$carsm=$myDb->get_row($csm,'MYSQL_ASSOC');
	$semester=$carsm['name'];


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
	$pdf->Cell(10, -445, 'Semester: '.$semester,0,'C',0);
	$pdf->Cell(-20, -455, 'Session: '.$_POST['session'],0,'C',0);
	$pdf->Cell(1, -435, 'Year: '.$_POST['year'],0,'C',0);
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

$pdf->Cell(60, 6, 'Faculty Name', 1, 0, 'L', 1);
$pdf->Cell(25, 6, 'Course Code', 1, 0, 'L', 1);
$pdf->Cell(65, 6, 'Course Name', 1, 0, 'L', 1);
$pdf->Cell(25, 6, 'Section', 1, 0, 'C', 1);
//$pdf->Cell(30, 6, 'Grade Point(GP)', 1, 0, 'C', 1);
//$pdf->Cell(15, 6, 'Grade', 1, 0, 'C', 1);
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
		$mcrs="SELECT distinct f.facultyid, f.name AS FacultyName FROM tbl_assignfaculty a INNER JOIN tbl_faculty f ON a.facultyid = f.id INNER JOIN tbl_department d ON a.deptid = d.id INNER JOIN tbl_courses c ON a.courseid = c.id INNER JOIN tbl_semester s ON a.semesterid = s.id WHERE a.deptid='$_POST[deptid]' and a.semesterid='$_POST[semester]' and a.session='$_POST[session]' and a.year='$_POST[year]' Order By f.name";
  				  
		$mcrq=$myDb->select($mcrs); 
		while($mcrsr=$myDb->get_row($mcrq,'MYSQL_ASSOC'))
		{



$query="SELECT a.id, f.facultyid, f.name AS FacultyName, d.name AS DepartmentName, c.coursecode, c.coursename AS CourseName, s.name AS SemesterName, a.session AS SESSION , a.year AS YEAR, a.section FROM tbl_assignfaculty a INNER JOIN tbl_faculty f ON a.facultyid = f.id INNER JOIN tbl_department d ON a.deptid = d.id INNER JOIN tbl_courses c ON a.courseid = c.id INNER JOIN tbl_semester s ON a.semesterid = s.id WHERE f.facultyid='$mcrsr[facultyid]' and a.deptid='$_POST[deptid]' and a.semesterid='$_POST[semester]' and a.session='$_POST[session]' and a.year='$_POST[year]'";	
$result = mysql_query($query) or die(mysql_error());

/*
		$mquery="SELECT distinct f.facultyid, f.name AS FacultyName FROM tbl_assignfaculty a INNER JOIN tbl_faculty f ON a.facultyid = f.id INNER JOIN tbl_department d ON a.deptid = d.id INNER JOIN tbl_courses c ON a.courseid = c.id INNER JOIN tbl_semester s ON a.semesterid = s.id WHERE a.deptid='18' and a.semesterid='7' and a.session='1112' and a.year='2012' order by f.facultyid";	
		$mresult = mysql_query($mquery) or die(mysql_error());
    	while($mrow = mysql_fetch_array($mresult))
		{
			$FacultyName = $mrow['FacultyName'];
	    	$pdf->Cell(50, 6, $FacultyName, 1, 0, 'L', 1);
		}
*/

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




		$pdf->Cell(60, 6, 'Faculty Name', 1, 0, 'L', 1);
		$pdf->Cell(25, 6, 'Course Code', 1, 0, 'L', 1);
		$pdf->Cell(65, 6, 'Course Name', 1, 0, 'L', 1);
		$pdf->Cell(25, 6, 'Section', 1, 0, 'C', 1);

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

    $facultyname = $row['FacultyName'];
    $coursecode = $row['coursecode'];
    $coursename = $row['CourseName'];
    $section = $row['section'];

    $pdf->SetY($y_axis);
    $pdf->SetX(25);

    $pdf->Cell(60, 6, $facultyname, 1, 0, 'L', 1);
    $pdf->Cell(25, 6, $coursecode, 1, 0, 'L', 1);
    $pdf->Cell(65, 6, $coursename, 1, 0, 'L', 1);
    $pdf->Cell(25, 6, $section, 1, 0, 'C', 1);




    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
$pdf->Ln($i-22);

}


    $facultyname = $mcrsr['FacultyName'];
    $pdf->Cell(60, 6, $facultyname, 1, 0, 'L', 1);
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;

}
mysql_close();

//Create file
$pdf->Output();
?>