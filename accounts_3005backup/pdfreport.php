<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_jurnal.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  				$timezone = "Asia/Dhaka";
                if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);  

 $products = null;

if (!empty($_SESSION['products'])) {
	$products = $_SESSION['products'];
}
//$_SESSION['sdate']=$_POST['voucherdate'];
?>

<?php
require('fpdf/fpdf.php');
class PDF extends FPDF {
 
function Header() {
    $this->SetFont('Times','',12);
    $this->SetY(0.25);
    $this->Cell(0, .25, "John Doe ".$this->PageNo(), 'T', 2, "R");
    //reset Y
    $this->SetY(1);
}
 
function Footer() {
//This is the footer; it's repeated on each page.
//enter filename: phpjabber logo, x position: (page width/2)-half the picture size,
//y position: rough estimate, width, height, filetype, link: click it!
    $this->Image("images/2.jpg", (8.5/2)-1.5, 9.8, 3, 1, "JPG", "http://www.phpjabbers.com");
}
 
}
 
//class instantiation
$pdf=new PDF("P","in","Letter");
 
$pdf->SetMargins(1,1,1);
 
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$jqy=$myDb->select("SELECT*FROM tbl_2ndjournal");
while($vjqy=$myDb->get_row($jqy,'MYSQL_ASSOC')){
//$vjqy=$myDb->dump_query($jqy,'','','',''); 
  
$pdf->SetFillColor(240, 100, 100);
$pdf->SetFont('Times','BU',12);
  
//Cell(float w[,float h[,string txt[,mixed border[,
//int ln[,string align[,boolean fill[,mixed link]]]]]]])
$pdf->Cell(0, .25, "lipsum", 1, 2, "C", 1);
  
$pdf->SetFont('Times','',12);
//MultiCell(float w, float h, string txt [, mixed border [, string align [, boolean fill]]])
$pdf->MultiCell(0, 3, $vjqy, 'LR', "L");
$pdf->MultiCell(0, 0.25, $vjqy, 1, "R");
$pdf->MultiCell(0, 0.15, $vjqy, 'B', "J");
 
$pdf->AddPage();
$pdf->Write(2, $vjqy);
  
$pdf->Output();
}
?>
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.html?msg=$msg");
   }	 

}else{
  header("Location:login.html");
}
}  
?>