<?php
require_once('pdf.class.php');


$pdf = new PDF();
$pdf->Image('logo.png',20,10,25);
$pdf->Header();
$header = array('Course Code','Course Name','Credit','Theory','Practical','T.Cont.Access','T.Final.Exam','P.Cont.Access','P.Final.Exam','Total');
//master query for group report
$mql="SELECT*FROM tbl_semester";

$data = $pdf->LoadData($mql);

$pdf->SetFont('Arial','',6);
$pdf->AddPage();

$pdf->CourseDistByDept($header,$data);


$pdf->Output();
?>