<?php
require_once('pdf.class.php');


$pdf = new PDF();

	$searchid=!empty($_GET['searchid'])?mysql_real_escape_string($_GET['searchid']):'';
	$searchid=urlencode($searchid);
	$searchid=str_replace("+"," ",$searchid);
	$dpt=str_replace("%",">",$searchid);
	$dpt=substr($dpt,9,strlen($dpt));
	$searchid=substr($searchid,0,strpos($searchid,"-%"));
	if(!empty($searchid)){
		$pdf->Image('../logo.png',20,10,25);
		$pdf->Header();	
		$pdf->Ln(15);
	
		$header = array('BID','ProductName','Rqty','Aqty','Pqty','InvStQty','Lib OB','Lib Stk','Iqty','Rem Qty');
		$mql="select*from tbl_product  where prtype='ST012' and courseid in(select id from tbl_courses where departmentid like '$searchid%') order by pname asc";
	
		$data = $pdf->LoadData($mql);
		$pdf->SetFont('Arial','',8);
		$pdf->AddPage();
		$pdf->Cell(80);
		$pdf->Cell(35,10,"Department Wise Book Register Report",0,0,'C');
		$pdf->Ln(5);
		$pdf->DeptWiseBookRegisterReport($header,$data,$dpt);
		
		$pdf->Output();
	}else{
		$pdf->Image('../logo.png',20,10,25);
		$pdf->Header();	
		$pdf->Ln(15);
	
		$header = array('BID','ProductName','Rqty','Aqty','Pqty','InvStQty','Lib OB','Lib Stk','Iqty','Rem Qty');
		$mql="select*from tbl_product  where prtype='ST012' order by pname asc";
	
		$data = $pdf->LoadData($mql);
		$pdf->SetFont('Arial','',8);
		$pdf->AddPage();
		$pdf->Cell(80);
		$pdf->Cell(35,10,"Book Register Report",0,0,'C');
		$pdf->Ln(10);
		$pdf->BookRegisterReport($header,$data);
		
		$pdf->Output();
	
	}
//}
?>