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
require("inwordfinal.php");

$myDb->connectDefaultServer()
 
//Create new pdf file
$pdf=new FPDF();//'P', 'cm', 'Legal'

//Open file
$pdf->Open();

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage('L');

//set initial y axis position per page
$y_axis_initial = 50;




//set the logo of the company    
	     $pdf->Image('logo.png',20,10,25);
		 
		 $pdf->SetX(70);

		 $pdf->SetFont('Arial', 'B', 16);
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetFillColor(235,234,230);
$pdf->Cell(15,10,"SAIC INSTITUTE OF MANAGEMENT & TECHNOLOGY",0,0,'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(5,20,"House # 1, Road # 2, Block # B, Section # 6, Mirpur, Dhaka - 1216",0,0,'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(5,30,"Phone: +88 02 8033034, +88 01936005816, +88 01936005817",0,0,'L');

		 

//Po    
/*
	$pdf->SetY(-20);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(5,0,'Prepared By:',0,0,'L'); $pdf->Cell(250,0,'Verified By:',0,0,'C'); $pdf->Cell(70,0,'Approved By:',0,0,'L');
  
    $pdf->SetY(-17);
    $pdf->SetFont('Arial','B',8);
	$pdf->Cell(5,0,'Sabina Banu',0,0,'L'); $pdf->Cell(250,0,'Biplob Mondal',0,0,'C'); $pdf->Cell(70,0,'Mrs. Shohaly Easmin',0,0,'L');

    $pdf->SetY(-14);
    $pdf->SetFont('Arial','',8);
	$pdf->Cell(5,0,'Admin Officer',0,0,'L'); $pdf->Cell(250,0,'Head of Accounts',0,0,'C'); $pdf->Cell(70,0,'Director',0,0,'L');
*/
    $pdf->SetFont('Arial','',8); 
	$pdf->Cell(100,390,'� Saic Institute of Management & Technology. Powered By: DesktopBD',0,0,'C');

	//print column titles for the actual page
	//$pdf->Cell(-70, -600, 'SAIC Institute of Management & Technology',0,'C',0);
	if($_POST['emptype']=="E")
	{
		$pdf->SetFont('Arial', 'U', 14);
		$pdf->Cell(-5, 50, 'Employee Salary For the Month of: '.$_POST['smonth'].', '.$_POST['syear'],0,'C',0);
	}
	else if($_POST['emptype']=="F")
	{
		$pdf->SetFont('Arial', 'U', 14);
		$pdf->Cell(-5, 50, 'Teachers Salary For the Month of: '.$_POST['smonth'].', '.$_POST['syear'],0,'C',0);
	}

	$pdf->SetFont('Arial', '',10);
	$pdf->Cell(0, 50, "Date: ".date('F j, Y'), 0,0, 'R');

// set the Report Header & Date

//$pdf->Cell(5, -498, "Date:");


// set the table header color
$pdf->SetFillColor(232, 232, 232);//(94, 188, 225);
$pdf->SetFont('Arial', 'B', 8);

$pdf->SetY($y_axis_initial);

$pdf->SetX(5);

		$pdf->Cell(6, 6, 'SN', 1, 0, 'L', 1);
		$pdf->Cell(30, 6, 'Name of Employee(s)', 1, 0, 'L', 1);
		$pdf->Cell(30, 6, 'Designation', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'Basic Salary', 1, 0, 'L', 1);
		$pdf->Cell(18, 6, 'House Rent', 1, 0, 'L', 1);
		$pdf->Cell(10, 6, 'TA/DA', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'MedicalAllow.', 1, 0, 'L', 1);
		$pdf->Cell(15, 6, 'Increment', 1, 0, 'L', 1);
		$pdf->Cell(12, 6, 'Others', 1, 0, 'L', 1);
		$pdf->Cell(15, 6, 'F.Bonus', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'Gross Salary', 1, 0, 'L', 1);
		$pdf->Cell(15, 6, 'Deduction', 1, 0, 'L', 1);
		$pdf->Cell(10, 6, 'PF(5%)', 1, 0, 'L', 1);
		$pdf->Cell(12, 6, 'Security', 1, 0, 'L', 1);
		$pdf->Cell(18, 6, 'Net Payable', 1, 0, 'R', 1);
		$pdf->Cell(20, 6, 'Signature', 1, 0, 'L', 1);
		$pdf->Cell(15, 6, 'Remarks', 1, 0, 'L', 1);
// set table body color
$pdf->SetFillColor(255, 255, 255);

$row_height = 6;

$y_axis = 50;
$y_axis = $y_axis + $row_height;

//Select the Products you want to show in your PDF file
$result=mysql_query("SELECT e.* FROM `tbl_employeesalary` e inner join `tbl_designation` d on e.designation=d.name WHERE e.monthname='$_POST[smonth]' and e.yearname='$_POST[syear]' and e.empid like '$_POST[emptype]%' Order By d.torder");

//initialize counter
$i = 0;

//Set maximum rows per page
$max = 24;

//Set Row Height

$pdf->SetFont('Arial', '', 8);
$sn=0;
while($row = mysql_fetch_array($result))
{
    //If the current row is the last one, create new page and print column title
    if ($i == $max)
    {
		// SET NEXT PAGE START POSITION
		$y_axis_initial = 30;
		$y_axis = 30;
        $pdf->AddPage('L');
/*
		$pdf->SetY(-20);
    	$pdf->SetFont('Arial','',8);
    	$pdf->Cell(5,0,'Prepared By:',0,0,'L'); $pdf->Cell(250,0,'Verified By:',0,0,'C'); $pdf->Cell(70,0,'Approved By:',0,0,'L');
  
    	$pdf->SetY(-17);
    	$pdf->SetFont('Arial','B',8);
		$pdf->Cell(5,0,'Sabina Banu',0,0,'L'); $pdf->Cell(250,0,'Biplob Mondal',0,0,'C'); $pdf->Cell(70,0,'Mrs. Shohaly Easmin',0,0,'L');

    	$pdf->SetY(-14);
    	$pdf->SetFont('Arial','',8);
		$pdf->Cell(5,0,'Admin Officer',0,0,'L'); $pdf->Cell(250,0,'Head of Accounts',0,0,'C'); $pdf->Cell(70,0,'Director',0,0,'L');
*/
    	$pdf->SetY(-6);
     	$pdf->Cell(270,0,'� Saic Institute of Management & Technology. Powered By: DesktopBD.',0,0,'C');

        //print column titles for the current page
        $pdf->SetY($y_axis_initial);
        $pdf->SetX(5);
		// set next page header color
		$pdf->SetFillColor(232, 232, 232);
		$pdf->SetFont('Arial', 'B', 8);

		$pdf->Cell(6, 6, 'SN', 1, 0, 'L', 1);
		$pdf->Cell(30, 6, 'Name of Employee(s)', 1, 0, 'L', 1);
		$pdf->Cell(30, 6, 'Designation', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'Basic Salary', 1, 0, 'L', 1);
		$pdf->Cell(18, 6, 'House Rent', 1, 0, 'L', 1);
		$pdf->Cell(10, 6, 'TA/DA', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'MedicalAllow.', 1, 0, 'L', 1);
		$pdf->Cell(15, 6, 'Increment', 1, 0, 'L', 1);
		$pdf->Cell(12, 6, 'Others', 1, 0, 'L', 1);
		$pdf->Cell(15, 6, 'F.Bonus', 1, 0, 'L', 1);
		$pdf->Cell(20, 6, 'Gross Salary', 1, 0, 'L', 1);
		$pdf->Cell(15, 6, 'Deduction', 1, 0, 'L', 1);
		$pdf->Cell(10, 6, 'PF(5%)', 1, 0, 'L', 1);
		$pdf->Cell(12, 6, 'Security', 1, 0, 'L', 1);
		$pdf->Cell(18, 6, 'Net Payable', 1, 0, 'R', 1);
		$pdf->Cell(20, 6, 'Signature', 1, 0, 'L', 1);
		$pdf->Cell(15, 6, 'Remarks', 1, 0, 'L', 1);
		// set next page body color
		$pdf->SetFillColor(255, 255, 255);
        
        //Go to next row
        $y_axis = $y_axis + $row_height;
        
        //Set $i variable to 0 (first row)
        $i = 0;
    }$sn++;

    $serialno = $sn;
    $empname = $row['empname'];
    $designation = $row['designation'];
    $basicpay = $row['basicpay'];
    $houserent = $row['houserent'];
    $tada = $row['tada'];
    $medicalallow = $row['medicalallow'];
    $increment = $row['increment'];
    $otherallow = $row['otherallow'];
    $festivalbouns = $row['festivalbouns'];
    $grosssalary = $row['grosssalary'];
    $totded = $row['totded'];
    $pfundamount = $row['pfundamount'];
    $securitymoney = $row['securitymoney'];
    $netpay = $row['netpay'];
    $remarks = $row['remarks'];
    //$securitymoney = $row['securitymoney'];

    $pdf->SetY($y_axis);
    $pdf->SetX(5);
	$pdf->SetFont('Arial', '', 8);

    $pdf->Cell(6, 6, $serialno, 1, 0, 'L', 1);
    $pdf->Cell(30, 6, $empname, 1, 0, 'L', 1);
    $pdf->Cell(30, 6, $designation, 1, 0, 'L', 1);
    $pdf->Cell(20, 6, $basicpay, 1, 0, 'L', 1);
    $pdf->Cell(18, 6, $houserent, 1, 0, 'L', 1);
    $pdf->Cell(10, 6, $tada, 1, 0, 'L', 1);
    $pdf->Cell(20, 6, $medicalallow, 1, 0, 'L', 1);
    $pdf->Cell(15, 6, $increment, 1, 0, 'L', 1);
    $pdf->Cell(12, 6, $otherallow, 1, 0, 'L', 1);
    $pdf->Cell(15, 6, $festivalbouns, 1, 0, 'L', 1);
    $pdf->Cell(20, 6, $grosssalary, 1, 0, 'L', 1);
    $pdf->Cell(15, 6, $totded, 1, 0, 'L', 1);
    $pdf->Cell(10, 6, $pfundamount, 1, 0, 'L', 1);
    $pdf->Cell(12, 6, $securitymoney, 1, 0, 'L', 1);
    $pdf->Cell(18, 6, $netpay, 1, 0, 'R', 1);
    $pdf->Cell(20, 6, '', 1, 0, 'L', 1);
    $pdf->Cell(15, 6, $remarks, 1, 0, 'L', 1);

    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;




}
	//-----------------For table bottom sum-------------------
	$resulttr=mysql_query("SELECT SUM(netpay) as NetPay, SUM(pfundamount) as tpfundamount, SUM(festivalbouns) as festivalbouns FROM `tbl_employeesalary` WHERE monthname='$_POST[smonth]' and yearname='$_POST[syear]' and empid like '$_POST[emptype]%'  Order By id");
	$trow=mysql_fetch_array($resulttr);
	//$ya=$trow['tnr'];

	$inwords=convert_number($trow['NetPay']);
	$pdf->SetY($y_axis);
	$pdf->SetX(5);
	$pdf->SetFont('Arial', 'B', 8);

	$pdf->Cell(161, 6, 'Total Amount (Tk.) =', 1, 0, 'R', 1);
    //$pdf->Cell(15, 6, '', 1, 0, 'R', 1);
    //$pdf->Cell(12, 6, '', 1, 0, 'R', 1);
	$pdf->Cell(15, 6, number_format($trow['festivalbouns'],2), 1, 0, 'L', 1);
	$pdf->Cell(45, 6, $trow['tpfundamount'], 1, 0, 'R', 1);
	$pdf->Cell(30, 6, number_format($trow['NetPay'],2), 1, 0, 'R', 1);
    $pdf->Cell(35, 6, '', 1, 0, 'L', 1);
	//----------------End table bottom sum---------------------
	//----------------For In words-----------------------------
	$pdf->SetY($y_axis+8);
	$pdf->SetX(5);
	$pdf->SetFont('Arial', 'I', 10);
	$pdf->Cell(200, 2, "In Words: ".$inwords." Taka Only.", 0, 0, 'L', 1);
	//----------------End of In words-------------------------



		$pdf->SetY(-20);
    	$pdf->SetFont('Arial','',8);
    	$pdf->Cell(5,0,'Prepared By:',0,0,'L'); $pdf->Cell(250,0,'Verified By:',0,0,'C'); $pdf->Cell(70,0,'Approved By:',0,0,'L');
  
    	$pdf->SetY(-17);
    	$pdf->SetFont('Arial','B',8);
		$pdf->Cell(5,0,'Sabina Banu',0,0,'L'); $pdf->Cell(250,0,'Biplob Mondal',0,0,'C'); $pdf->Cell(70,0,'Mrs. Shohaly Easmin',0,0,'L');

    	$pdf->SetY(-14);
    	$pdf->SetFont('Arial','',8);
		$pdf->Cell(5,0,'Admin Officer',0,0,'L'); $pdf->Cell(250,0,'Head of Accounts',0,0,'C'); $pdf->Cell(70,0,'Director',0,0,'L');


	$pdf->SetFont('Arial', '', 8);


mysql_close();

//Create file
$pdf->Output();
?>