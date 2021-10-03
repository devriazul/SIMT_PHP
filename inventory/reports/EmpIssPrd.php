<?php
require_once('pdf.class.php');
$pdf = new PDF();

$pdf->Header();
    $empid=mysql_real_escape_string(urlencode($_GET['empid']));
	$empid=str_replace("+"," ",$empid);
	$issuedate=mysql_real_escape_string($_GET['issuedate']);
$header = array('Product ID','Product Name','Issue Qty');
//master query for group report
		$q="select sid 'id',name from tbl_staffinfo where tbl_staffinfo.sid='$empid' 
		                           union all
								   select facultyid 'id',name from tbl_faculty where tbl_faculty.facultyid='$empid'
								 ";
								   
		//$rs=$pdf->get_row($q,'MYSQL_ASSOC');
		
		  
		  
	//$rs=parent::get_row($this->q,'MYSQL_ASSOC');

//$mql="SELECT*FROM tbl_department";

    $data = $pdf->LoadData($q);
	$pdf->SetFont('Arial','',6);
	$pdf->AddPage();
	$pdf->Ln(2);
	$pdf->EmployeeIssuePrd($header,$data,$issuedate);
	
	$pdf->Output();
?>