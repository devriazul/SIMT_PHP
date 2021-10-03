<?php
require_once('../dbClass.php');
include("../config.php"); 
$myDb->connect($host,$user,$pwd,$db,true);


require('../FPDF/fpdf.php');

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
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Text color in gray
    $this->SetTextColor(128);
    // Page number
	    $this->SetFont('Arial','B',6);
    //Move to the right
    $this->Cell(80);
    //Title
    $this->Cell(-50,10,'SAIC INSTITUTE OF AMANGEMENT & TECHNOLOGY',0,0,'C');  //in last 3 parameters 1st parameter set 0 means no border 1 means border

    $this->Cell(150,10,'Page '.$this->PageNo(),0,0,'C');
}



// Load data
function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}

// Simple table
function BasicTable($header, $data)
{
    // Header
    foreach($header as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
}

// Better table
function ImprovedTable($header, $data)
{
    // Column widths
    $w = array(10, 35, 30,30);
    // Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR');
        $this->Cell($w[1],6,$row[1],'LR');
        $this->Cell($w[2],6,$row[2],'LR');
        $this->Cell($w[3],6,$row[3],'LR');
        //$this->Cell($w[3],6,$row[3],'LR');
        //$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
        //$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
        $this->Ln();
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}

// Colored table
function FancyTable($header, $data)
{    $w = array(15, 70, 30,15,10,10,15);

    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
	
		
			$this->Ln();
    // Data
    $fill = false;
	$i=0;
	$max=38;
    foreach($data as $row)
    {    
	
	
	if($i==$max){
	
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
	
		
			$this->Ln();
	  $i=0;
	 }
	

        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],6,$row[2],'LR',0,'L',$fill);
        $this->Cell($w[3],6,$row[3],'LR',0,'L',$fill);
        $this->Cell($w[4],6,$row[4],'LR',0,'L',$fill);
        $this->Cell($w[5],6,$row[5],'LR',0,'L',$fill);
        $this->Cell($w[3],6,$row[6],'LR',0,'L',$fill);
        //$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
        //$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
        $this->Ln();
		
        $fill = !$fill;
		
		
		
   	$i++;
	}

    // Closing line
    $this->Cell(array_sum($w),0,'','T');
	
}

}
$pdf = new PDF();
$pdf->Image('../logo.png',20,10,25);
$title = 'SAIC INSTITUTE OF AMANGEMENT & TECHNOLOGY';
$pdf->Header($title);
$header = array('ID', 'Course Name','Author','DName','BSelfNo','RowNo','Total');
// Data loading
$data = $pdf->LoadData('crsRpt.txt');

$pdf->SetFont('Arial','',6);

$pdf->AddPage();
$pdf->FancyTable($header,$data);


$pdf->Output();

?>