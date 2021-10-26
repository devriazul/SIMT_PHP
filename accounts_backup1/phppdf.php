<?php
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

require('fpdf/fpdf.php');

class PDF extends FPDF
{
//Load data
function LoadData($file)
{
//Read file lines
$lines=file($file);
$data=array();
foreach($lines as $line)
$data[]=explode(';',chop($line));
return $data;
}

//Simple table
function BasicTable($header,$data)
{
//Header
foreach($header as $col)
$this->Cell(40,7,$col,1);
$this->Ln();
//Data
foreach($data as $row)
{
foreach($row as $col)
$this->Cell(40,6,$col,1);
$this->Ln();
}
}

//Better table
function ImprovedTable($header,$data)
{
//Column widths
$w=array(40,35,40,45);
//Header
for($i=0;$i<count($header);$i++)
$this->Cell($w[$i],7,$header[$i],1,0,'C');
$this->Ln();
//Data
foreach($data as $row)
{
$this->Cell($w[0],6,$row[0],'LR');
$this->Cell($w[1],6,$row[1],'LR');
$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
$this->Ln();
}
//Closure line
$this->Cell(array_sum($w),0,'','T');
}

//Colored table
function FancyTable($header,$data)
{
//Colors, line width and bold font
$this->SetFillColor(255,0,0);
$this->SetTextColor(255);
$this->SetDrawColor(128,0,0);
$this->SetLineWidth(.3);
$this->SetFont('','B');
//Header
$w=array(40,35,40,45);
for($i=0;$i<count($header);$i++)
$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
$this->Ln();
//Color and font restoration
$this->SetFillColor(224,235,255);
$this->SetTextColor(0);
$this->SetFont('');
//Data
$fill=false;
foreach($data as $row)
{
$this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
$this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
$this->Ln();
$fill=!$fill;
}
$this->Cell(array_sum($w),0,'','T');
}
}

$pdf=new PDF();
//Column titles
$header=array('Accno','Accname','Amountdr','Amountcr','Masteraccno');
//Data loading
$data=$pdf->LoadData('delete_acc11.php');
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
//$pdf->BasicTable($header,$data);
//$pdf->AddPage();
//$pdf->ImprovedTable($header,$data);
//$pdf->AddPage();
$pdf->FancyTable($header,$data);
$pdf->Output();
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