<?php
//PDF USING MULTIPLE PAGES
//FILE CREATED BY: Carlos Jos� V�squez S�ez
//YOU CAN CONTACT ME: carlos@magallaneslibre.com
//FROM PUNTA ARENAS, MAGALLANES
//INOVO GROUP - http://www.inovo.cl

define('FPDF_FONTPATH', 'font/');
require('fpdf.php');

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
$y_axis_initial = 50;




//set the logo of the company    
	     $pdf->Image('logo.png',20,10,25);
		 

//Position at 1.5 cm from bottom
    $pdf->SetY(-15);
    //Arial italic 8
    $pdf->SetFont('Arial','B',8);
    //Page number
    $pdf->Cell(0,10,'Copyright � Saic Institute of Management & Technology. Powered By: DesktopBD.',0,0,'C');

	//print column titles for the actual page
	//$pdf->Cell(-70, -600, 'SAIC Institute of Management & Technology',0,'C',0);
	$pdf->SetFont('Arial', 'U', 14);
	$pdf->Cell(-65, -490, 'Hostel Details Information',0,'C',0);
	
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(-4, -478, "(Hostel Name: ".$_POST['hostel'].")",0,'C',0);
	$pdf->SetFont('Arial', '', '10');
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

$pdf->SetY($y_axis_initial);

$pdf->SetX(25);

$pdf->SetFont('Arial', 'B', 10);


$pdf->Cell(20, 6, 'Room No', 1, 0, 'L', 1);
$pdf->Cell(20, 6, 'Seat No', 1, 0, 'L', 1);
$pdf->Cell(30, 6, 'Student ID', 1, 0, 'L', 1);
$pdf->Cell(60, 6, 'Student Name', 1, 0, 'L', 1);
$pdf->Cell(20, 6, 'Seat Rent', 1, 0, 'L', 1);
$pdf->Cell(25, 6, 'Meal Charge', 1, 0, 'L', 1);



// set table body color
$pdf->SetFillColor(255, 255, 255);

$row_height = 6;

$y_axis = 50;
$y_axis = $y_axis + $row_height;

//Select the Products you want to show in your PDF file
$result=mysql_query("SELECT vhd.*, s.stdname as Name FROM `vw_hostelindetails` vhd left join tbl_stdinfo s on vhd.stdid=s.stdid WHERE vhd.HostelName='$_POST[hostel]' Order By RoomNo, seatno");

//initialize counter
$i = 0;

//Set maximum rows per page
$max = 35;

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
	    $pdf->SetFont('Arial','B',8);
      	$pdf->Cell(190,550,'Copyright � Saic Institute of Management & Technology. Powered By: DesktopBD.',0,0,'C');

        //print column titles for the current page
        $pdf->SetY($y_axis_initial);
        $pdf->SetX(25);
		// set next page header color


		$pdf->SetFillColor(232, 232, 232);
		$pdf->SetFont('Arial', 'B', 10);

		$pdf->Cell(20, 6, 'Room No', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'Seat No', 1, 0, 'L', 1);
		$pdf->Cell(30, 6, 'Student ID', 1, 0, 'L', 1);
		$pdf->Cell(60, 6, 'Student Name', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'Seat Rent', 1, 0, 'L', 1);
		$pdf->Cell(25, 6, 'Meal Charge', 1, 0, 'L', 1);
		// set next page body color
		$pdf->SetFillColor(255, 255, 255);
        
        //Go to next row
        $y_axis = $y_axis + $row_height;
        
        //Set $i variable to 0 (first row)
        $i = 0;
    }

    $RoomNo = $row['RoomNo'];
    $seatno = $row['seatno'];
    $stdid = $row['stdid'];
    $stdname = $row['Name'];
    $rent = $row['price'];
	$mealcharge= $row['mealcharge'];

    $pdf->SetY($y_axis);
    $pdf->SetX(25);
	$pdf->SetFont('Arial', '', 10);

    $pdf->Cell(20, 6, $RoomNo, 1, 0, 'L', 1);
    $pdf->Cell(20, 6, $seatno, 1, 0, 'L', 1);
    $pdf->Cell(30, 6, $stdid, 1, 0, 'L', 1);
    $pdf->Cell(60, 6, $stdname, 1, 0, 'L', 1);
    $pdf->Cell(20, 6, $rent, 1, 0, 'L', 1);
    $pdf->Cell(25, 6, $mealcharge, 1, 0, 'L', 1);

    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;

}

mysql_close();

//Create file
$pdf->Output();
?>