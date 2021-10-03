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
$y_axis_initial = 50;


/*

//set the logo of the company    
	     $pdf->Image('logo.png',20,10,25);
		 

//Position at 1.5 cm from bottom
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
    $pdf->SetY(-14);
    $pdf->SetFont('Arial','',8); 
	//$pdf->SetFillColor(255, 255, 255);
	$pdf->Cell(200,20,'Copyright © Saic Institute of Management & Technology. Powered By: DesktopBD',0,0,'C');
	//$pdf->SetFillColor(232, 232, 232);


/*
// set the Report Header & Date
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetFillColor(235,234,230);
$pdf->Cell(-70,-360,"SAIC INSTITUTE OF MANAGEMENT & TECHNOLOGY",0,0,'R');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(-20,-350,"House # 1, Road # 2, Block # B, Section # 6, Mirpur, Dhaka - 1216",0,0,'R');
//$pdf->Cell(5, -498, "Date:");

*/


//------------------Page Starter--------------------
$pdf->SetY(35);
$pdf->SetX(15);
/*
$txt = 'Date : 
The Manager
IFIC Bank Ltd.




Dear Sir,	 	 	 
 	 	 	 
Salary Advice from SIMT A/C # 01013472198001 for the month of '.$_POST['smonth'].', '. $_POST['syear'].'. Please make the pay transfer from above A/C no to the below mentioned A/C no towards employee salaries:';
    // Times 12
    $pdf->SetFont('Times','',12);
    // Output justified text
    $pdf->MultiCell(0,5,$txt);
    // Line break
    $pdf->Ln();
    // Mention in italics
    $pdf->SetFont('','I');
    //$pdf->Cell(0,5,'(end of excerpt)');
	
*/
//---------------------------------------------------

	$pdf->SetFont('Arial', 'U', 12);
	$pdf->Cell(160, 50, 'EMPLOYEE SALARY FOR THE MONTH OF: '.$_POST['smonth'].', '.$_POST['syear'],0,'C',0);

	$pdf->SetFont('Arial', '',8);
	$pdf->Cell(0, 60, "Date: ".date('d.m.Y'), 0,0, 'R');


// set the table header color
$pdf->SetFillColor(232, 232, 232);//(94, 188, 225);
$pdf->SetFont('Times', 'B', 10);

$pdf->SetY(70);

$pdf->SetX(15);
		$pdf->Cell(10, 6, 'SLNo.', 1, 0, 'L', 1);
		$pdf->Cell(50, 6, 'Name of the Employee(s)', 1, 0, 'L', 1);
		$pdf->Cell(40, 6, 'Desigantion', 1, 0, 'L', 1);
		$pdf->Cell(30, 6, 'Amount (Tk.)', 1, 0, 'R', 1);
		$pdf->Cell(30, 6, 'Signature', 1, 0, 'L', 1);
		$pdf->Cell(30, 6, 'Remarks', 1, 0, 'L', 1);
		//$pdf->Cell(17, 6, 'Total Class', 1, 0, 'L', 1);
		//$pdf->Cell(27, 6, 'Amount Per Class', 1, 0, 'L', 1);
		//$pdf->Cell(27, 6, 'Total Amount (Tk.)', 1, 0, 'L', 1);
		//$pdf->Cell(20, 6, '', 1, 0, 'L', 1);
		//$pdf->Cell(20, 6, '', 1, 0, 'L', 1);
		//$pdf->Cell(35, 6, '', 1, 0, 'L', 1);
/*
//-----------------------for top heading-----------------
$pdf->SetY($y_axis_initial+6);
$pdf->SetX(7);

		$pdf->Cell(6, -12, 'SL', 1, 0, 'L', 1);

$pdf->SetY($y_axis_initial);
$pdf->SetX(13);

		$pdf->Cell(70, -6, 'Particulars', 1, 0, 'C', 1);
		$pdf->Cell(71, -6, 'Theory', 1, 0, 'C', 1);
		$pdf->Cell(71, -6, 'Practical', 1, 0, 'C', 1);

$pdf->SetY($y_axis_initial+6);
$pdf->SetX(225);

		$pdf->Cell(18, -12, 'Net Payable', 1, 0, 'R', 1);
		$pdf->Cell(20, -12, 'Signature', 1, 0, 'L', 1);
		$pdf->Cell(25, -12, 'Remarks(PaidBy)', 1, 0, 'L', 1);
//-------End of top heading-------------
*/

// set table body color
$pdf->SetFillColor(255, 255, 255);

$row_height = 6;

$y_axis = 70;
$y_axis = $y_axis + $row_height;

//Select the Products you want to show in your PDF file
$result=mysql_query("SELECT es.*,sf.bankaccno as BankAccNo, d.name as designationname  FROM tbl_employeesalary es inner join vw_allstaff sf on es.empid=sf.StaffID inner join tbl_designation d on sf.DesigId=d.id WHERE monthname='$_POST[smonth]' and yearname='$_POST[syear]' and sf.bankaccno like 'cash%' Order By d.torder");

//initialize counter
$i = 0;

//Set maximum rows per page
$max = 30;

//Set Row Height

$pdf->SetFont('Times', '', 10);
$sl=0;
while($row = mysql_fetch_array($result))
{
    //If the current row is the last one, create new page and print column title
    if ($i == $max)
    {
		// SET NEXT PAGE START POSITION
		$y_axis_initial = 70;
		$y_axis = 70;
        $pdf->AddPage('P');

    	$pdf->SetY(-6);
	    $pdf->SetFont('Arial','',8); 

     	$pdf->Cell(200,0,'Copyright © Saic Institute of Management & Technology. Powered By: DesktopBD.',0,0,'C');

        //print column titles for the current page
        $pdf->SetY($y_axis_initial);
        $pdf->SetX(15);
		// set next page header color
		$pdf->SetFillColor(232, 232, 232);
		$pdf->SetFont('Times', 'B', 10);

		$pdf->Cell(10, 6, 'SLNo.', 1, 0, 'L', 1);
		$pdf->Cell(50, 6, 'Name of the Employee(s)', 1, 0, 'L', 1);
		$pdf->Cell(40, 6, 'Desigantion', 1, 0, 'L', 1);
		$pdf->Cell(30, 6, 'Amount (Tk.)', 1, 0, 'R', 1);
		$pdf->Cell(30, 6, 'Signature', 1, 0, 'L', 1);
		$pdf->Cell(30, 6, 'Remarks', 1, 0, 'L', 1);

		// set next page body color
		$pdf->SetFillColor(255, 255, 255);
        
        //Go to next row
        $y_axis = $y_axis + $row_height;
        
        //Set $i variable to 0 (first row)
        $i = 0;
    }$sl++;

    $SL = $sl;
    $empname = $row['empname'];
    $designation = $row['designationname'];
	
    $netpay = number_format($row['netpay'],2);
    //$tcr = $row['tamountpc'];
	//$tt = $row['ttclass'] * $row['tamountpc'];
    //$tpc = $row['tpclass'];
    //$pcr = $row['pamountpc'];
	//$pt = $row['tpclass'] * $row['pamountpc'];
    //$netpay = $tt + $pt;
    //$remarks = $row['remarks'];
    //$securitymoney = $row['securitymoney'];

    $pdf->SetY($y_axis);
    $pdf->SetX(15);
	$pdf->SetFont('Times', '', 10);

		$pdf->Cell(10, 6, $SL, 1, 0, 'L', 1);
		$pdf->Cell(50, 6, $empname, 1, 0, 'L', 1);
		$pdf->Cell(40, 6, $designation, 1, 0, 'L', 1);
		$pdf->Cell(30, 6, $netpay, 1, 0, 'R', 1);
		$pdf->Cell(30, 6, '', 1, 0, 'L', 1);
		$pdf->Cell(30, 6, '', 1, 0, 'L', 1);

    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
	

}   


	//-----------------For table bottom sum-------------------
	$resulttr=mysql_query("Select ifnull(sum(es.netpay),0) as totalamount FROM tbl_employeesalary es inner join vw_allstaff sf on es.empid=sf.StaffID  WHERE monthname='$_POST[smonth]' and yearname='$_POST[syear]' and sf.bankaccno like 'cash%' Order By es.id");
	$trow=mysql_fetch_array($resulttr);
	//$ya=$trow['tnr'];

	$inwords=convert_number($trow['totalamount']);
	$pdf->SetY($y_axis);
	$pdf->SetX(15);
	$pdf->SetFont('Times', 'B', 10);

	$pdf->Cell(160, 6, 'Total Amount (Tk.) =', 1, 0, 'R', 1);
    $pdf->Cell(30, 6, number_format($trow['totalamount'],2), 1, 0, 'R', 1);
    //$pdf->Cell(35, 6, '', 1, 0, 'L', 1);
	//----------------End table bottom sum---------------------
	

	$pdf->SetY($y_axis+8);
	$pdf->SetX(15);
	$pdf->SetFont('Times', 'I', 10);
	$pdf->Cell(218, 2, "In Words: ".$inwords." Taka Only.", 0, 0, 'L', 1);
		

		$pdf->SetY(-35);
    	$pdf->SetFont('Times','',10);
		$pdf->Cell(5,0,'Prepared By:',0,0,'L'); $pdf->Cell(150,0,'',0,0,'C'); $pdf->Cell(70,0,'Approved By:',0,0,'L');
  
    	$pdf->SetY(-31);
    	$pdf->SetFont('Times','B',10);
		$pdf->Cell(5,0,'Sabina Banu',0,0,'L'); $pdf->Cell(150,0,'',0,0,'C'); $pdf->Cell(70,0,'Mrs. Shohaly Easmin',0,0,'L');

    	$pdf->SetY(-28);
    	$pdf->SetFont('Times','I',10);
    	$pdf->Cell(5,0,'Admin Officer',0,0,'L'); $pdf->Cell(150,0,'',0,0,'C'); $pdf->Cell(70,0,'Director',0,0,'L');



	$pdf->SetFont('Arial', '', 8);


mysql_close();

//Create file
$pdf->Output();
?>