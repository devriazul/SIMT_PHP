<?php
require_once('pdf.class.php');


$pdf = new PDF();
$pdf->Image('../logo.png',20,10,25);
$pdf->Header();
$header = array('Course Code','coursename','stdid','stdname','Issue Date','Return Date');
//master query for group report
$name=!empty($_GET['name'])?mysql_real_escape_string($_GET['name']):'';
$fdate=!empty($_GET['fdate'])?mysql_real_escape_string($_GET['fdate']):'';
$tdate=!empty($_GET['tdate'])?mysql_real_escape_string($_GET['tdate']):'';
if(!empty($name)&&!(empty($fdate) && empty($tdate))){
    $mql="SELECT id,name FROM tbl_department WHERE id in(SELECT deptid FROM tbl_bookissue) and name like '$name%'";

    $data = $pdf->LoadData($mql);
	$pdf->SetFont('Arial','',8);
	
	$pdf->AddPage();
	$pdf->Cell(80);
	$pdf->Cell(30,10,"From date:".$fdate." To date:".$tdate,0,0,'C');
		$pdf->Ln(5);
		$pdf->Cell(180,10,"Department Wise Book Report",0,0,'C');
		$pdf->Ln(5);
	$pdf->DateWiseDeptBookReturn($header,$data,$fdate,$tdate);
	
	
	$pdf->Output();
	

}else{
    $mql="SELECT id,name FROM tbl_department WHERE name='$name'
		                     AND id in(SELECT deptid FROM tbl_bookissue)";

    $data = $pdf->LoadData($mql);
	$pdf->SetFont('Arial','',8);
	
	$pdf->AddPage();
	$pdf->Cell(80);
		$pdf->Cell(35,10,"Department Wise Book Report",0,0,'C');
		$pdf->Ln(5);
	$pdf->DeptWiseBookReturn($header,$data);
	
	
	$pdf->Output();
}
?>