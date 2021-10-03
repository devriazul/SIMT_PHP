<?php
require_once('pdf.class.php');


$pdf = new PDF();
//master query for group report
$name=!empty($_GET['name'])?mysql_real_escape_string($_GET['name']):'';
$stdid=!empty($_GET['stdid'])?mysql_real_escape_string($_GET['stdid']):'';
$stdid=urlencode($stdid);
$stdid=str_replace("+"," ",$stdid);
$fdate=!empty($_GET['fdate'])?mysql_real_escape_string($_GET['fdate']):'';
$tdate=!empty($_GET['tdate'])?mysql_real_escape_string($_GET['tdate']):'';
$courseid=!empty($_GET['courseid'])?mysql_real_escape_string($_GET['courseid']):'';
if(!empty($stdid)&&!empty($fdate)&&!empty($tdate)){
	$pdf->Image('../logo.png',20,10,25);
	$pdf->Header();
	$header = array('Course Code','coursename','Issue Date','Return Date');
    $mql="SELECT stdid,stdname FROM tbl_stdinfo WHERE stdid in(SELECT stdid FROM tbl_bookissue) and stdid like '$stdid%'
			UNION ALL
			SELECT facultyid stdid,name stdid FROM tbl_faculty WHERE facultyid in(SELECT stdid FROM tbl_bookissue) and facultyid like '$stdid%'
		 ";

    $data = $pdf->LoadData($mql);
	$pdf->SetFont('Arial','',6);
	
	$pdf->AddPage();
	//if(!empty($fdate)&&!empty($tdate)){
		$pdf->Cell(80);
		$pdf->Cell(30,10,"From date1111:".$fdate." To date:".$tdate,0,0,'C');
		$pdf->Ln(5);
	//}
	$pdf->StdFacltDateWiseDeptBookReturn($header,$data,$fdate,$tdate);
	
	
	$pdf->Output();
	

}else if(!empty($stdid)){
	$pdf->Image('../logo.png',20,10,25);
	$pdf->Header();
	$header = array('Course Code','coursename','Issue Date','Return Date');
    $mql="SELECT stdid,stdname FROM tbl_stdinfo WHERE stdid in(SELECT stdid FROM tbl_bookissue) and stdid like '$stdid%'
			UNION ALL
			SELECT facultyid stdid,name stdid FROM tbl_faculty WHERE facultyid in(SELECT stdid FROM tbl_bookissue) and facultyid like '$stdid%'
		 ";

    $data = $pdf->LoadData($mql);
	$pdf->SetFont('Arial','',6);
	
	$pdf->AddPage();
	$pdf->StdFacltWiseDeptBookReturn($header,$data,$fdate,$tdate);
	
	
	$pdf->Output();
	

}else if(!empty($courseid)){
	$pdf->Image('../logo.png',20,10,25);
	$pdf->Header();
	$header = array('Dept Name','Student/Faculty ID','Name','Issue Date','Return Date');
    $mql="SELECT id,coursecode,coursename FROM tbl_courses WHERE id='$courseid'
		                      AND id in(SELECT courseid FROM tbl_bookissue)";

    $data = $pdf->LoadData($mql);
	$pdf->SetFont('Arial','',6);
	
	$pdf->AddPage();
	$pdf->Ln(5);
	$pdf->CourseIDWiseBookReturn($header,$data);
	
	
	$pdf->Output();
	

}else{
	$pdf->Image('../logo.png',20,10,25);
	$pdf->Header();
	$header = array('Course Code','coursename','stdid','stdname','Issue Date','Return Date');
    $mql="SELECT id,name FROM tbl_department WHERE name='$name'
		                     AND id in(SELECT deptid FROM tbl_bookissue)";

    $data = $pdf->LoadData($mql);
	$pdf->SetFont('Arial','',6);
	
	$pdf->AddPage();
	$pdf->Ln(5);
	$pdf->DeptWiseBookReturn($header,$data);
	
	
	$pdf->Output();
}
?>