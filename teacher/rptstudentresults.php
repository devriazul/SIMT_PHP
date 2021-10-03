<?php
//PDF USING MULTIPLE PAGES
//FILE CREATED BY: Carlos José Vásquez Sáez
//YOU CAN CONTACT ME: carlos@magallaneslibre.com
//FROM PUNTA ARENAS, MAGALLANES
//INOVO GROUP - http://www.inovo.cl

define('FPDF_FONTPATH', 'font/');
require('../fpdf.php');

//Connect to your database
require_once('dbClass.php');
include("config.php"); 
$myDb->connect($host,$user,$pwd,$db,true);
 
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

	$iv="SELECT distinct exammarksper FROM tbl_examinitionsettings WHERE deptid='$_POST[deptid]' and courseid= '$_POST[courseid]' and semesterid='$_POST[semesterid]' and session='$_POST[sess]' and year='$_POST[year]' and examtype='$_POST[examtype]'";
  	$ivq=$myDb->select($iv);
  	$ivrs=$myDb->get_row($ivq,'MYSQL_ASSOC');
	$examname= $_POST['examtype']." (Total Marks:". $ivrs['exammarksper'].")";

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

	$pdf->SetFont('Arial', 'U', 14);
	$pdf->Cell(-65, -490, 'Student Result Report',0,'C',0);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(-3, -475, 'Deaprtment:' .$dep,0,'C',0);
	$pdf->Cell(12, -465, 'Course: '.$course,0,'C',0);
	$pdf->Cell(-20, -455, 'Session: '.$_POST['sess'],0,'C',0);
	$pdf->Cell(10, -445, 'Semester: '.$semester,0,'C',0);
	$pdf->Cell(12, -435, 'Exam Name: '.$examname,0,'C',0);
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
$pdf->SetFont('Arial', 'B', 12);

$pdf->SetY($y_axis_initial);

$pdf->SetX(25);



$pdf->Cell(60, 6, 'Student ID', 1, 0, 'L', 1);
$pdf->Cell(90, 6, 'Student Name', 1, 0, 'L', 1);
$pdf->Cell(20, 6, 'Marks', 1, 0, 'L', 1);
// set table body color
$pdf->SetFillColor(255, 255, 255);

$row_height = 6;

$y_axis = 75;
$y_axis = $y_axis + $row_height;

//Select the Products you want to show in your PDF file
				  	if(($_POST['examtype']=="Theory Final Exam")) 
				  	{ 
				  		$query="SELECT distinct concat(m.stdid,'(',s.boardrollno,')') as stdid, s.stdname, m.finalexammarks as marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]' and s.section='$_POST[section]'  order by m.id";
						$result = mysql_query($query) or die(mysql_error());
				  	}
					else if(($_POST['examtype']=="Practical Final Exam")) 
				  	{ 
				  		$query="SELECT distinct concat(m.stdid,'(',s.boardrollno,')') as stdid, s.stdname, m.finalexamprac as marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]' and s.section='$_POST[section]' order by m.id";
						$result = mysql_query($query) or die(mysql_error());
				  	} 
					else if(($_POST['examtype']=="Class Test")) 
					{
				  		$query="SELECT distinct concat(m.stdid,'(',s.boardrollno,')') as stdid, s.stdname, m.classtestmarks as marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]' and s.section='$_POST[section]' order by m.id"; 
						$result = mysql_query($query) or die(mysql_error());

					}
					else if(($_POST['examtype']=="Quiz Test")) 
					{
				  		$query="SELECT distinct concat(m.stdid,'(',s.boardrollno,')') as stdid, s.stdname, m.quiztestmarks as marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]' and s.section='$_POST[section]' order by m.id";
						$result = mysql_query($query) or die(mysql_error());
			      	}
					else if(($_POST['examtype']=="Job/Experiment")) 
					{
				  		$query="SELECT distinct concat(m.stdid,'(',s.boardrollno,')') as stdid, s.stdname, m.jobexpr as marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]' and s.section='$_POST[section]' order by m.id";
						$result = mysql_query($query) or die(mysql_error());
			      	}
					else if(($_POST['examtype']=="Job/Experiment Final")) 
					{
				  		$query="SELECT distinct concat(m.stdid,'(',s.boardrollno,')') as stdid, s.stdname, m.jobexprfinal as marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]' and s.section='$_POST[section]' order by m.id";
						$result = mysql_query($query) or die(mysql_error());
			      	}
					else if(($_POST['examtype']=="Home Work")) 
					{
				  		$query="SELECT concat(m.stdid,'(',s.boardrollno,')') as stdid, s.stdname, m.hwmarks as marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]' and s.section='$_POST[section]' order by m.id";
						$result = mysql_query($query) or die(mysql_error());
			      	}
					else if(($_POST['examtype']=="Job/Experiment Report")) 
					{
				  		$query="SELECT distinct concat(m.stdid,'(',s.boardrollno,')') as stdid, s.stdname, m.jobexprreport as marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]' and s.section='$_POST[section]' order by m.id";
						$result = mysql_query($query) or die(mysql_error());
			      	}
					else if(($_POST['examtype']=="Job/Experiment Report Final")) 
					{
				  		$query="SELECT distinct concat(m.stdid,'(',s.boardrollno,')') as stdid, s.stdname, m.jobexprreportfinal as marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]' and s.section='$_POST[section]' order by m.id";
						$result = mysql_query($query) or die(mysql_error());
			      	}
					else if(($_POST['examtype']=="Job/Experiment Viva")) 
					{
				  		$query="SELECT distinct concat(m.stdid,'(',s.boardrollno,')') as stdid, s.stdname, m.jobexprviva as marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]' and s.section='$_POST[section]' order by m.id";
						$result = mysql_query($query) or die(mysql_error());
			      	}
					else if(($_POST['examtype']=="Job/Experiment Viva Final")) 
					{
				  		$query="SELECT distinct concat(m.stdid,'(',s.boardrollno,')') as stdid, s.stdname, m.jobexprvivafinal as marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]' and s.section='$_POST[section]' order by m.id";
						$result = mysql_query($query) or die(mysql_error());
			      	}
					else if(($_POST['examtype']=="Attendance Marks")) 
					{
				  		$query="SELECT distinct concat(m.stdid,'(',s.boardrollno,')') as stdid, s.stdname, m.attendancemarks as marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]' and s.section='$_POST[section]' order by m.id";
						$result = mysql_query($query) or die(mysql_error());
			      	}
					else if(($_POST['examtype']=="Behavior")) 
					{
				  		$query="SELECT distinct concat(m.stdid,'(',s.boardrollno,')') as stdid, s.stdname, m.behaviormarks as marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]' and s.section='$_POST[section]' order by m.id";
						$result = mysql_query($query) or die(mysql_error());
			      	}


//initialize counter
$i = 0;

//Set maximum rows per page
$max = 32;

//Set Row Height

while($row = mysql_fetch_array($result))
{
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
		$pdf->SetFont('Arial', 'B', 12);


		$pdf->Cell(60, 6, 'Student ID', 1, 0, 'L', 1);
		$pdf->Cell(90, 6, 'Student Name', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'Marks', 1, 0, 'L', 1);
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
	$pdf->SetFont('Arial', '', 10);

    $stdid = $row['stdid'];
    $stdname = $row['stdname'];
    $marks = $row['marks'];

    $pdf->SetY($y_axis);
    $pdf->SetX(25);

    $pdf->Cell(60, 6, $stdid, 1, 0, 'L', 1);
    $pdf->Cell(90, 6, $stdname, 1, 0, 'L', 1);
    $pdf->Cell(20, 6, $marks, 1, 0, 'L', 1);

    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;

}

mysql_close();

//Create file
$pdf->Output();
?>