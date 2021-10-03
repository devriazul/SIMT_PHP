<?php
require_once('pdf.class.php');
$pdf = new PDF();

$pdf->Header();
$reqid=!empty($_GET['reqid'])?mysql_real_escape_string($_GET['reqid']):'';
$header = array('Product Name','Est.Price','Req Qty','AppQty','PurQty','UnitPrice','TotalPrice');
//master query for group report
	$chkstaff=$myDb->select("SELECT empid,storeid from tbl_buyproduct where reqid='".$reqid."'");
	$stf=$myDb->get_row($chkstaff,'MYSQL_ASSOC');
		$empstring=substr($stf["empid"],0,3);
		$fltstring=substr($stf["empid"],0,1);
	$mql='';
	if($empstring=='EMP'){
		$mql="SELECT distinct (select storename 
								from tbl_store 
								where storeid='$stf[storeid]')mstoreid,
						     b.reqid,b.empid,b.pstatus,b.reqdate,b.expdate,b.appdate,
						     b.pdate,b.reqid,s.* FROM tbl_buyproduct b
	                         INNER JOIN tbl_staffinfo s
							 ON s.sid=b.empid
							 WHERE b.reqid='$reqid'
							 and b.pid<>0";
	}else{
		$mql="SELECT distinct (select storename 
								from tbl_store 
								where storeid='$stf[storeid]')mstoreid,
							 b.reqid,b.empid,b.pstatus,b.reqdate,b.expdate,b.appdate,b.pdate,b.reqid,s.* FROM tbl_buyproduct b
	                         INNER JOIN tbl_faculty s
							 ON s.facultyid=b.empid
							 WHERE b.reqid='$reqid'
							 and b.pid<>0";
	
	}						 
	//$rs=parent::get_row($this->q,'MYSQL_ASSOC');

//$mql="SELECT*FROM tbl_department";

    $data = $pdf->LoadData($mql);
	$pdf->SetFont('Arial','',10);
	$pdf->AddPage();
	$pdf->Ln(2);
	$pdf->FancyTable($header,$data);
	
	$pdf->Output();
?>