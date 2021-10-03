<?php 
//require ('fpdf/fpdf.php');//including the main class

class PDF_result extends FPDF
{

/*The constructor takes 4 Arguments ,

 The portrait is set to PORTRAIT ,

The units measurement is set to POINTS ,

 The Format of the PDF is set to LETTER with a Margin of 40 Points* /

function __construct($orientation = 'P', $unit = 'pt', $format = 'Letter', $margin =40)
 {

 $this->FPDF($orientation, $unit, $format);//Calling the parent Constructor with 3 Parameters
 $this->SetTopMargin($margin);//Setting the Top Margin
 $this->SetLeftMargin($margin);//Left Margin
 $this->SetRightMargin($margin);//Right Margin

 $this->SetAutoPageBreak(true, $margin);
/
 }

/*The Method Header adds an Image at the top of the page
The logo is printed with the Image()  method by  specifying its upper-left corner and its width. The height is calculated automatically to respect the image  proportions.*/
 function Header()
 {
 $this->Image('images/2.jpg', 100, 15, 250);
 }

/*The Footer Method add a text at the bottom of the Page */
 function Footer()
 {
 //Position at 1.5 cm from bottom
 $this->SetY(-15);
 //Arial italic 8
 $this->SetFont('Arial', 'I', 8);
 //Page number
 $this->Cell(0, 10, 'Generated at YouHack.me', 0, 0, 'C');
 }

//The Method Generate_Table takes 2 Array Parameters the subjects and Marks of Student .
 function Generate_Table($subjects, $marks)
 {
 $this->SetFont('Arial', 'B', 12);//Set the Font type to Arial,Bold with size 12 Pt
 $this->SetTextColor(0);//Set the Text Color
 $this->SetFillColor(94, 188, 225);//Fill the text with RGB Color
 $this->SetLineWidth(1);//Set the Line Width to 1pt
 $this->Cell(427, 25, "Subjects", 'LTR', 0, 'C', true);
$this->Cell(100, 25, "Marks", 'LTR', 1, 'C', true);
/*cell(Width of the cell ,Heigh of the cell, The Text to be written,1 = Border Parameter ||0 = Carriage Return,Position i.e C= Centre,Boolean for  background color )
*/
 $this->SetFont('Arial', ''); //Set the Font and Turn The Bold Off
 $this->SetFillColor(238);
 $this->SetLineWidth(0.2);//0.2 pts
 $fill = false;

 for ($i = 0; $i < count($subjects); $i++) {
 $this->Cell(427, 20, $subjects[$i], 1, 0, 'L', $fill);
 $this->Cell(100, 20, $marks[$i], 1, 1, 'R', $fill);
 $fill = !$fill;//This variable is responsible for the alternative row colors
 }
 $this->SetX(367);

 }

}
?>
