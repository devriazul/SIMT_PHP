<?php
//PDF USING MULTIPLE PAGES
//FILE CREATED BY: Carlos José Vásquez Sáez
//YOU CAN CONTACT ME: carlos@magallaneslibre.com
//FROM PUNTA ARENAS, MAGALLANES
//INOVO GROUP - http://www.inovo.cl

define('FPDF_FONTPATH', 'font/');
require('fpdf.php');

//Connect to your database
require_once('dbClass.php');
include("config.php"); 
$myDb->connect($host,$user,$pwd,$db,true);
 
//Create new pdf file
$pdf=new FPDF();//'P', 'cm', 'Legal'

//Open file
$pdf->Open();

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage('P');

//set initial y axis position per page
$y_axis_initial = 50;




//set the logo of the company    
	     $pdf->Image('logo.png',20,10,25);
		 

//Po    
	

	$pdf->SetFont('Arial', '');
	$pdf->Cell(0, -320, "Date: ".date('F j, Y'), 0,0, 'R');

// set the Report Header & Date
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetFillColor(235,234,230);
$pdf->Cell(-70,-360,"SAIC INSTITUTE OF MANAGEMENT & TECHNOLOGY",0,0,'R');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(-20,-350,"House # 1, Road # 2, Block # B, Section # 6, Mirpur, Dhaka - 1216",0,0,'R');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(-5,-340,"Phone: +88 02 8033034, +88 01936005816, +88 01936005817",0,0,'R');
//$pdf->Cell(5, -498, "Date:");


// set the table header color
$pdf->SetFillColor(232, 232, 232);//(94, 188, 225);
$pdf->SetFont('Arial', 'B', 8);

$pdf->SetY($y_axis_initial);

$pdf->SetX(15);

		$pdf->Cell(30, 6, 'Staff ID', 1, 0, 'L', 1);
		$pdf->Cell(30, 6, 'Name', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'In Time', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'Delay', 1, 0, 'L', 1);
		$pdf->Cell(10, 6, 'Staff Type', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'Status', 1, 0, 'L', 1);
// set table body color
$pdf->SetFillColor(255, 255, 255);

$row_height = 6;

$y_axis = 50;
$y_axis = $y_axis + $row_height;

//Select the Products you want to show in your PDF file
$result=mysql_query("SELECT at . * , s.name AS EmpName, a.accname FROM  `tbl_attendance` at INNER JOIN  `tbl_staffinfo` s ON at.efid = s.sid INNER JOIN  `tbl_access` a ON at.accid = a.id WHERE at.edate BETWEEN  '$_POST[fromdate]' AND  '$_POST[todate]' UNION SELECT at . * , f.name AS FacName, a.accname FROM  `tbl_attendance` at INNER JOIN  `tbl_faculty` f ON at.efid = f.facultyid INNER JOIN  `tbl_access` a ON at.accid = a.id WHERE at.edate BETWEEN  '$_POST[fromdate]' AND  '$_POST[todate]'");

//initialize counter
$i = 0;

//Set maximum rows per page
$max = 35;

//Set Row Height

$pdf->SetFont('Arial', '', 8);

while($row = mysql_fetch_array($result))
{
//determine the time delay
	$stdtime="SELECT * FROM tbl_attendancesettings WHERE accid='$row[accid]'";	
    $stdqtime=$myDb->select($stdtime);
	$stdrtime=$myDb->get_row($stdqtime,'MYSQL_ASSOC');
 				  
	$t1= new DateTime($row['intime']);
	$t2= new DateTime($stdrtime['stdintime']);
	$interval = $t2->diff($t1);
	$a=(int)$interval->format('%h%i');    //If the current row is the last one, create new page and print column title
    if ($i == $max)
    {
		// SET NEXT PAGE START POSITION
		$y_axis_initial = 30;
		$y_axis = 30;
        $pdf->AddPage('L');

        //print column titles for the current page
        $pdf->SetY($y_axis_initial);
        $pdf->SetX(15);
		// set next page header color
		$pdf->SetFillColor(94, 188, 225);
		$pdf->SetFont('Arial', 'B', 12);

		$pdf->Cell(30, 6, 'Staff ID', 1, 0, 'L', 1);
		$pdf->Cell(30, 6, 'Name', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'In Time', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'Delay', 1, 0, 'L', 1);
		$pdf->Cell(10, 6, 'Staff Type', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'Status', 1, 0, 'L', 1);
		// set next page body color
		$pdf->SetFillColor(232, 232, 232);
        
        //Go to next row
        $y_axis = $y_axis + $row_height;
        
        //Set $i variable to 0 (first row)
        $i = 0;
    }

    $staffid = $row['efid'];
    $name = $row['EmpName'];
    $intime = $row['intime'];
    $delay = $interval->format('%h Hr %i Mn %s Sec');
    $stafftype = $row['accname'];
    
	if ($a<=$stdrtime['minallow'])
	{
		$status =  "Present";
	}
	else if ($a<=$stdrtime['maxallow'])
	{
		$status =  "Late";
	}
	else
	{
		$status = "Absent";
	}

    $pdf->SetY($y_axis);
    $pdf->SetX(15);

    $pdf->Cell(30, 6, $staffid, 1, 0, 'L', 1);
    $pdf->Cell(30, 6, $name, 1, 0, 'L', 1);
    $pdf->Cell(20, 6, $intime, 1, 0, 'L', 1);
    $pdf->Cell(20, 6, $delay, 1, 0, 'L', 1);
    $pdf->Cell(10, 6, $stafftype, 1, 0, 'L', 1);
    $pdf->Cell(20, 6, $status, 1, 0, 'L', 1);

    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;

}

mysql_close();

//Create file
$pdf->Output();
?>