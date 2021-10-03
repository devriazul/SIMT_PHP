<?php
require_once('pdf.class.php');


$pdf = new PDF();
$pdf->Image('../logo.png',20,10,25);
$pdf->Header();
$header = array('Course Name','Author','Self No','Row No','Total Book','Price','Total');
//master query for group report
$mql="SELECT*FROM tbl_department";

$data = $pdf->LoadData($mql);

$pdf->SetFont('Arial','',6);
$pdf->AddPage();

$pdf->FancyTable($header,$data);


$pdf->Output();
?>