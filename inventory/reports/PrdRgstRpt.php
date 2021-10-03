<?php
require_once('pdf.class.php');


$pdf = new PDF();

	$searchid=!empty($_GET['searchid'])?mysql_real_escape_string($_GET['searchid']):'';
	$searchid=urlencode($searchid);
	$searchid=str_replace("+"," ",$searchid);
	$stn=$myDb->select("SELECT*FROM tbl_store WHERE storename='$searchid'");
	$stnf=$myDb->get_row($stn,'MYSQL_ASSOC');
	if(!empty($searchid)){
		$pdf->Image('../logo.png',20,10,25);
		$pdf->Header();	
		$pdf->Ln(15);
	
		$header = array('PID/BID','ProductName','Rqty','Aqty','Pqty','InvStQty','Lib OB','Lib Stk','Iqty','Rem Qty');
		$mql="select*from tbl_product  where prtype='$stnf[storeid]' order by pname asc";
	
		$data = $pdf->LoadData($mql);
		$pdf->SetFont('Arial','',6);
		$pdf->AddPage();
		$pdf->Ln(5);
		$dpt=$stnf['storename'];
		$pdf->PrdTypeWiseRegisterReport($header,$data,$dpt);
		
		$pdf->Output();
	}else{
		$pdf->Image('../logo.png',20,10,25);
		$pdf->Header();	
		$pdf->Ln(15);
	
		$header = array('BID','ProductName','Product Type','Rqty','Aqty','Pqty','InvStQty','Lib OB','Lib Stk','Iqty','Rem Qty');
		$mql="select*from tbl_product order by prtype asc";
	
		$data = $pdf->LoadData($mql);
		$pdf->SetFont('Arial','',6);
		$pdf->AddPage();
		$pdf->Ln(5);
		$pdf->ProductRegisterReport($header,$data);
		
		$pdf->Output();
	
	}
//}
?>