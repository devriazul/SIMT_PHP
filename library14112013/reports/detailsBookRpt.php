<?php
require_once('pdf.class.php');


$pdf = new PDF();
$pdf->Image('../logo.png',20,10,25);
$pdf->Header();
$header = array('Course Name','Author','Edition','Self No','Row No','Publisher','Total Book','Price','Total Cost');
//master query for group report
$crsname=mysql_real_escape_string($_GET['crsname']);
$mql="SELECT id,count(name),name FROM tbl_department where name='$crsname'";

$data = $pdf->LoadData($mql);

$pdf->SetFont('Arial','',6);
$pdf->AddPage();

$pdf->DetailBookRpt($header,$data);


$pdf->Output();
?>