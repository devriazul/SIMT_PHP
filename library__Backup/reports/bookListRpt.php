<?php
require_once('pdf.class.php');


$pdf = new PDF();

$pdf->Header();

$header = array('Course Name','Author','Self No','Row No','Total Book','Price','Total');
//master query for group report

$mql="SELECT*FROM tbl_department";

    $data = $pdf->LoadData($mql);
	$pdf->SetFont('Arial','',7);
	$pdf->AddPage();
	$pdf->Cell(80);
		$pdf->Cell(35,10,"Department Wise Details Book Information",0,0,'C');
		$pdf->Ln(5);
	$pdf->FancyTable($header,$data);
	
	$pdf->Output();
?>