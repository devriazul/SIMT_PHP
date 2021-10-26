<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php

//- Variables - for your RPT and PDF
echo "Print Report Test";
$my_report = "C:\\Report\\rptPaymentVoucher.rpt"; //rpt source file
//$my_pdf = "C:\\Report\\rptPaymentVoucher.pdf"; // RPT export to pdf file
//-Create new COM object-depends on your Crystal Report version
$ObjectFactory= new COM("CrystalReports10.ObjectFactory.1") or die ("Error on load"); // call COM port
$crapp = $ObjectFactory-> CreateObject("CrystalDesignRunTime.Application"); // create an instance for Crystal
$creport = $crapp->OpenReport($my_report, 1); // call rpt report

// to refresh data before

//- Set database logon info - must have
$creport->Database->Tables(1)->SetLogOnInfo("localhost", "simtdb", "root", "");

//- field prompt or else report will hang - to get through
$creport->EnableParameterPrompting = 0;

//- DiscardSavedData - to refresh then read records
$creport->DiscardSavedData;
$creport->ReadRecords();

   
//export to PDF process
$creport->ExportOptions->DiskFileName=$my_report; //export to pdf
$creport->ExportOptions->PDFExportAllPages=true;
$creport->ExportOptions->DestinationType=1; // export to file
$creport->ExportOptions->FormatType=31; // PDF type
$creport->Export(false);

//------ Release the variables ------
$creport = null;
$crapp = null;
$ObjectFactory = null;

//------ Embed the report in the webpage ------
print "<embed src=\"C:\\Report\\rptPaymentVoucher.pdf\" width=\"100%\" height=\"100%\">"

   
   
?>
</body>
</html>
