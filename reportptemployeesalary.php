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
require("inwordfinal.php");
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
$y_axis_initial = 70;




//set the logo of the company    
	     //$pdf->Image('logo.png',20,10,25);
		 

//Position at 1.5 cm from bottom
    $pdf->SetY(-35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(5,0,'Prepared By:',0,0,'L'); $pdf->Cell(150,0,'Verified By:',0,0,'C'); $pdf->Cell(70,0,'Approved By:',0,0,'L');
  
    $pdf->SetY(-31);
    $pdf->SetFont('Arial','B',8);
	$pdf->Cell(5,0,'Sabina Banu',0,0,'L'); $pdf->Cell(150,0,'Biplob Mondal',0,0,'C'); $pdf->Cell(70,0,'Mrs. Shohaly Easmin',0,0,'L');

    $pdf->SetY(-28);
    $pdf->SetFont('Arial','',8);
	$pdf->Cell(5,0,'Admin Officer',0,0,'L'); $pdf->Cell(150,0,'Head of Accounts',0,0,'C'); $pdf->Cell(70,0,'Director',0,0,'L');



    $pdf->SetFont('Arial','',8); 
	$pdf->Cell(-260,40,'© Saic Institute of Management & Technology. Powered By: DesktopBD',0,0,'C');

	$pdf->SetFont('Arial', 'U', 12);
	$pdf->Cell(200, -430, 'PART TIME EMPLOYEE SALARY FOR THE MONTH OF: '.$_POST['smonth'].', '.$_POST['syear'],0,'C',0);

	$pdf->SetFont('Arial', '',8);
	$pdf->Cell(0, -420, "Date: ".date('F j, Y'), 0,0, 'R');

// set the Report Header & Date
/*
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetFillColor(235,234,230);
$pdf->Cell(-70,-360,"SAIC INSTITUTE OF MANAGEMENT & TECHNOLOGY",0,0,'R');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(-20,-350,"House # 1, Road # 2, Block # B, Section # 6, Mirpur, Dhaka - 1216",0,0,'R');
*/
//$pdf->Cell(5, -498, "Date:");


// set the table header color
$pdf->SetFillColor(232, 232, 232);//(94, 188, 225);
$pdf->SetFont('Arial', 'B', 8);

$pdf->SetY($y_axis_initial);

$pdf->SetX(7);
		$pdf->Cell(6, 6, '', 1, 0, 'L', 1);
		$pdf->Cell(35, 6, 'Name of The Teacher(s)', 1, 0, 'L', 1);
		$pdf->Cell(25, 6, 'Designation', 1, 0, 'L', 1);
		$pdf->Cell(10, 6, 'Class', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'Amount/Class', 1, 0, 'L', 1);
		$pdf->Cell(10, 6, 'Total', 1, 0, 'L', 1);
		$pdf->Cell(10, 6, 'Class', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'Amount/Class', 1, 0, 'L', 1);
		$pdf->Cell(10, 6, 'Total', 1, 0, 'L', 1);
		//$pdf->Cell(20, 6, '', 1, 0, 'L', 1);
		//$pdf->Cell(20, 6, '', 1, 0, 'L', 1);
		//$pdf->Cell(35, 6, '', 1, 0, 'L', 1);
//-----------------------for top heading-----------------
$pdf->SetY($y_axis_initial+6);
$pdf->SetX(7);

		$pdf->Cell(6, -12, 'SL', 1, 0, 'L', 1);

$pdf->SetY($y_axis_initial);
$pdf->SetX(13);

		$pdf->Cell(60, -6, 'Particulars', 1, 0, 'C', 1);
		$pdf->Cell(40, -6, 'Theory', 1, 0, 'C', 1);
		$pdf->Cell(40, -6, 'Practical', 1, 0, 'C', 1);

$pdf->SetY($y_axis_initial+6);
$pdf->SetX(153);

		$pdf->Cell(18, -12, 'Net Payable', 1, 0, 'R', 1);
		$pdf->Cell(20, -12, 'Signature', 1, 0, 'L', 1);
		$pdf->Cell(15, -12, 'Remarks', 1, 0, 'L', 1);
//-------End of top heading-------------
// set table body color
$pdf->SetFillColor(255, 255, 255);

$row_height = 6;

$y_axis = 70;
$y_axis = $y_axis + $row_height;

//Select the Products you want to show in your PDF file
$result=mysql_query("SELECT * FROM `tbl_parttimeemployeesalary` WHERE monthname='$_POST[smonth]' and yearname='$_POST[syear]' Order By id");

//initialize counter
$i = 0;

//Set maximum rows per page
$max = 28;

//Set Row Height

$pdf->SetFont('Arial', '', 8);
$sl=0;
while($row = mysql_fetch_array($result))
{
    //If the current row is the last one, create new page and print column title
    if ($i == $max)
    {
		// SET NEXT PAGE START POSITION
		$y_axis_initial = 30;
		$y_axis = 30;
        $pdf->AddPage('P');

        //print column titles for the current page
        $pdf->SetY($y_axis_initial);
        $pdf->SetX(5);
		// set next page header color
		$pdf->SetFillColor(94, 188, 225);
		$pdf->SetFont('Arial', 'B', 12);

		$pdf->Cell(10, 6, 'SL', 1, 0, 'L', 1);
		$pdf->Cell(40, 6, 'Name of 	The Teacher(s)', 1, 0, 'L', 1);
		$pdf->Cell(30, 6, 'Designation', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'Theory Total Class', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'Amount (Theory/Class)', 1, 0, 'L', 1);
		$pdf->Cell(25, 6, 'Total Amount (Tk.)', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'Parctical Total Class', 1, 0, 'L', 1);
		$pdf->Cell(25, 6, 'Amount (Practical/Class)', 1, 0, 'L', 1);
		$pdf->Cell(25, 6, 'Total Amount (Tk.)', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'Net Payable', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'Signature', 1, 0, 'L', 1);
		$pdf->Cell(35, 6, 'Remarks(Paid By Cash)', 1, 0, 'L', 1);
		// set next page body color
		$pdf->SetFillColor(232, 232, 232);
        
        //Go to next row
        $y_axis = $y_axis + $row_height;
        
        //Set $i variable to 0 (first row)
        $i = 0;
    }$sl++;

    $SL = $sl;
    $empname = $row['empname'];
    $designation = $row['designation'];
    $ttc = $row['ttclass'];
    $tcr = $row['tamountpc'];
	$tt = $row['ttclass'] * $row['tamountpc'];
    $tpc = $row['tpclass'];
    $pcr = $row['pamountpc'];
	$pt = $row['tpclass'] * $row['pamountpc'];
    $netpay = $tt + $pt;
    $remarks = $row['remarks'];
    //$securitymoney = $row['securitymoney'];

    $pdf->SetY($y_axis);
    $pdf->SetX(7);

    $pdf->Cell(6, 6, $SL, 1, 0, 'L', 1);
    $pdf->Cell(35, 6, $empname, 1, 0, 'L', 1);
    $pdf->Cell(25, 6, $designation, 1, 0, 'L', 1);
    $pdf->Cell(10, 6, $ttc, 1, 0, 'L', 1);
    $pdf->Cell(20, 6, $tcr, 1, 0, 'L', 1);
    $pdf->Cell(10, 6, $tt, 1, 0, 'L', 1);
    $pdf->Cell(10, 6, $tpc, 1, 0, 'L', 1);
    $pdf->Cell(20 , 6, $pcr, 1, 0, 'L', 1);
    $pdf->Cell(10, 6, $pt, 1, 0, 'L', 1);
    $pdf->Cell(18, 6, $netpay, 1, 0, 'R', 1);
    $pdf->Cell(20, 6, '', 1, 0, 'L', 1);
    $pdf->Cell(15, 6, $remarks, 1, 0, 'L', 1);

    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
	

}

	//-----------------For table bottom sum-------------------
	$resulttr=mysql_query("SELECT count(*) as tnr, SUM(ttclass*tamountpc+tpclass*pamountpc) as NetPay FROM `tbl_parttimeemployeesalary` WHERE monthname='$_POST[smonth]' and yearname='$_POST[syear]' Order By id");
	$trow=mysql_fetch_array($resulttr);
	//$ya=$trow['tnr'];

	$inwords=convert_number($trow['NetPay']);
	$pdf->SetY($y_axis);
	$pdf->SetX(7);
	$pdf->SetFont('Arial', 'I', 10);

	$pdf->Cell(146, 6, 'Total Amount (Tk.) =', 1, 0, 'R', 1);
    $pdf->Cell(18, 6, $trow['NetPay'], 1, 0, 'R', 1);
    $pdf->Cell(35, 6, '', 1, 0, 'L', 1);
	//----------------End table bottom sum---------------------
	

	$pdf->SetY($y_axis+8);
	$pdf->SetX(7);
	$pdf->Cell(218, 2, "In Words: ".$inwords." Taka Only.", 0, 0, 'L', 1);
		

	$pdf->SetFont('Arial', '', 8);


mysql_close();

//Create file
$pdf->Output();
?>