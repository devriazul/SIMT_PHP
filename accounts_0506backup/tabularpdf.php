<?php 
require('fpdf/fpdf.php');
require('fpdf/fpdf_result.php');

$pdf = new PDF_result();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY(100);
$pdf->Cell(100, 13, "Student Details");
$pdf->SetFont('Arial', '');
$pdf->Cell(250, 13, $_POST['name']);
$pdf->SetFont('Arial', 'B');
$pdf->Cell(50, 13, "Date:");
$pdf->SetFont('Arial', '');
$pdf->Cell(100, 13, date('F j, Y'), 0, 1);
$pdf->SetFont('Arial', 'I');
$pdf->SetX(140);
$pdf->Cell(200, 15, $_POST['e-mail'], 0, 2);
$pdf->Cell(200, 15, $_POST['Address'] . ',' . $_POST['City'], 0, 2);
$pdf->Cell(200, 15, $_POST['Country'], 0, 2);
$pdf->Ln(100);
$pdf->Generate_Table($_POST['subjects'], $_POST['Marks']);
$pdf->Ln(50);
$message = "Congratulation , you have successfully passed your exams .For More Information Contact us at : ";
$pdf->MultiCell(0, 15, $message);
$pdf->SetFont('Arial', 'U', 12);
$pdf->SetTextColor(1, 162, 232);
$pdf->Write(13, "admin@youhack.me", "mailto:example@example.com");
$pdf->Output('result.pdf', 'F');

?>
