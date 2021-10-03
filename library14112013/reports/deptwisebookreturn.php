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

if(empty($name)&&!(empty($fdate) && empty($tdate))){
    $mql="SELECT id,name FROM tbl_department WHERE id in(SELECT deptid FROM tbl_bookissue)";

    $data = $pdf->LoadData($mql);
	$pdf->SetFont('Arial','',6);
	
	$pdf->AddPage();
	$pdf->DateWiseDeptBookReturn($header,$data,$fdate,$tdate);
	
	
	$pdf->Output();

}else{
    $mql="SELECT id,name FROM tbl_department WHERE name='$name'
		                     AND id in(SELECT deptid FROM tbl_bookissue)";

    $data = $pdf->LoadData($mql);
	$pdf->SetFont('Arial','',6);
	
	$pdf->AddPage();
	$pdf->DeptWiseBookReturn($header,$data);
	
	
	$pdf->Output();
}
?>