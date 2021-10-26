<?php
//PDF USING MULTIPLE PAGES
//FILE CREATED BY: Carlos Jos� V�squez S�ez
//YOU CAN CONTACT ME: carlos@magallaneslibre.com
//FROM PUNTA ARENAS, MAGALLANES
//INOVO GROUP - http://www.inovo.cl

define('FPDF_FONTPATH', 'font/');
require('fpdf.php');

//Connect to your database
require_once('dbClass.php');
include("config.php"); 
$myDb->connectDefaultServer()
 
//Create new pdf file
$pdf=new FPDF();

//Open file
$pdf->Open();

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage();

//set initial y axis position per page
$y_axis_initial = 60;


//echo $_POST['efid']; exit;

//set the logo of the company    
	     $pdf->Image('logo.png',10,5,25);
		 

//Position at 1.5 cm from bottom
    $pdf->SetY(-30);
    //Arial italic 8
    $pdf->SetFont('Arial','',8);
    //Page number
    $pdf->Cell(0,40,'Copyright: SAIC Institute of Management & Technology. Powered By: <a href="https://riaz.fastitbd.com">(Web Developer) </a><a href="https://www.saicgroupbd.com">Saic Group</a>.',0,0,'C');

	//print column titles for the actual page & Date
	//$pdf->Cell(-70, -600, 'SAIC Institute of Management & Technology',0,'C',0);
	$pdf->SetY(30);
	$pdf->SetX(63);

	$pdf->SetFont('Arial', 'U', 14);
	if(substr($_POST['efid'],0,1)=="E")
	{
		$pdf->Cell(80, 10, 'Employee Working Report',0,0,'C',0);
	}
	else if(substr($_POST['efid'],0,1)=="F")
	{
		$pdf->Cell(80, 10, 'Faculty/ Teacher Working Report',0,0,'C',0);
	}
	$pdf->SetFont('Arial', '',10);
	//-----------Print Date--------------
	//$pdf->Cell(0, -490, "Date: ".date('F j, Y'), 0,0, 'R');
	//-----------Show slected dates by user----------------
	$pdf->SetY(35);
	$pdf->SetX(63);

	$pdf->Cell(80, 10, "From Date: ".$_POST['fromdate']." To Date: ".$_POST['todate'], 0,0, 'C');

	$pdf->SetY(40);
	$pdf->SetX(63);

	$pdf->Cell(80, 10, "Employee/ Faculty Name: ".$_POST['efname']." (".$_POST['efid'].")", 0,0, 'C');


// set the Report Header 
	$pdf->SetY(5);
	$pdf->SetX(67);

	$pdf->SetFont('Arial', 'B', 16);
	$pdf->SetFillColor(235,234,230);
	$pdf->Cell(80,10,"SAIC INSTITUTE OF MANAGEMENT & TECHNOLOGY",0,0,'C');

	$pdf->SetY(10);
	$pdf->SetX(67);

	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(80,10,"House # 1, Road # 2, Block # B, Section # 6, Mirpur, Dhaka - 1216",0,0,'C');

	$pdf->SetY(15);
	$pdf->SetX(67);

	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(80,10,"Phone: +88 02 8033034, +88 01936005816, +88 01936005817",0,0,'C');

//end of report header
$pdf->SetFont('Arial', 'B', 12);
//$pdf->Cell(5, -498, "Date:");


// set the table header color
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 10);

$pdf->SetY($y_axis_initial);

$pdf->SetX(10);

		$pdf->Cell(8, 6, 'SN.', 1, 0, 'L', 1);
		$pdf->Cell(18, 6, 'Date', 1, 0, 'L', 1);
		$pdf->Cell(15, 6, 'In Time', 1, 0, 'L', 1);
		$pdf->Cell(18, 6, 'Out Time', 1, 0, 'L', 1);
		$pdf->Cell(63, 6, 'Out Status', 1, 0, 'L', 1);
		$pdf->Cell(30, 6, 'Working Hours', 1, 0, 'L', 1);
		$pdf->Cell(42, 6, 'Over Time', 1, 0, 'L', 1);
		//$pdf->Cell(15, 6, 'Type', 1, 0, 'L', 1);
// set table body color
$pdf->SetFillColor(255, 255, 255);

$row_height = 6;

$y_axis = 60;
$y_axis = $y_axis + $row_height;
$pdf->SetFont('Arial', '', 10);

//Select the Products you want to show in your PDF file

//---------previous query--------------
//$result=mysql_query("SELECT at . * , s.name AS EmpName, a.accname FROM  `tbl_attendance` at INNER JOIN  `tbl_staffinfo` s ON at.efid = s.sid INNER JOIN  `tbl_access` a ON at.accid = a.id WHERE at.edate BETWEEN  '$_POST[fromdate]' AND  '$_POST[todate]' UNION SELECT at . * , f.name AS FacName, a.accname FROM  `tbl_attendance` at INNER JOIN  `tbl_faculty` f ON at.efid = f.facultyid INNER JOIN  `tbl_access` a ON at.accid = a.id WHERE at.edate BETWEEN  '$_POST[fromdate]' AND  '$_POST[todate]'");

if(substr($_POST['efid'],0,1)=="E")
{
	$result=mysql_query("SELECT at . * , s.name AS EmpName, a.accname FROM  `tbl_attendance` at INNER JOIN  `tbl_staffinfo` s ON at.efid = s.sid INNER JOIN  `tbl_access` a ON at.accid = a.id WHERE at.edate BETWEEN  '$_POST[fromdate]' AND  '$_POST[todate]' and s.sid='$_POST[efid]'");
}
else if(substr($_POST['efid'],0,1)=="F")
{
	$result=mysql_query("SELECT at . * , f.name AS EmpName, a.accname FROM  `tbl_attendance` at INNER JOIN  `tbl_faculty` f ON at.efid = f.facultyid INNER JOIN  `tbl_access` a ON at.accid = a.id WHERE at.edate BETWEEN  '$_POST[fromdate]' AND  '$_POST[todate]' and f.facultyid='$_POST[efid]'");
}



//initialize counter
$i = 1;

//Set maximum rows per page
$max = 35;

//Set Row Height


while($row = mysql_fetch_array($result))
{
//determine the time delay
	  $stdtime="SELECT * FROM tbl_attendancesettings WHERE accid='$row[accid]'";	
      $stdqtime=$myDb->select($stdtime);
	  $stdrtime=$myDb->get_row($stdqtime,'MYSQL_ASSOC');
 				  
	  $t1= new DateTime($row['intime']);
	  $t2= new DateTime($row['outtime']);
	  $interval = $t2->diff($t1);
	  $a=(int)$interval->format('%h%i%s');
    

//If the current row is the last one, create new page and print column title
    if ($i == $max)
    {
		// SET NEXT PAGE START POSITION
		$y_axis_initial = 30;
		$y_axis = 30;
        $pdf->AddPage();

        //print column titles for the current page
        $pdf->SetY($y_axis_initial);
        $pdf->SetX(10);
		// set next page header color
		$pdf->SetFillColor(232, 232, 232);
		$pdf->SetFont('Arial', 'B', 10);

		$pdf->Cell(8, 6, 'SN.', 1, 0, 'L', 1);
		$pdf->Cell(18, 6, 'Date', 1, 0, 'L', 1);
		$pdf->Cell(15, 6, 'In Time', 1, 0, 'L', 1);
		$pdf->Cell(18, 6, 'Out Time', 1, 0, 'L', 1);
		$pdf->Cell(63, 6, 'Out Status', 1, 0, 'L', 1);
		$pdf->Cell(30, 6, 'Working Hours', 1, 0, 'L', 1);
		$pdf->Cell(42, 6, 'Over Time', 1, 0, 'L', 1);
		//$pdf->Cell(15, 6, 'Type', 1, 0, 'L', 1);
		// set next page body color
		$pdf->SetFillColor(255, 255, 255);
        
        //Go to next row
        $y_axis = $y_axis + $row_height;
        
        //Set $i variable to 0 (first row)
        $i = 0;
    }
	//-------set the details page font-----------
	//$pdf->SetFont('Arial', '', 10);
	$wdate = $row['edate'];
    $staffid = $row['efid'];
    $name = $row['EmpName'];
    $intime = $row['intime'];
    $outtime = $row['outtime'];
    $outstatus = $row['earlyoutreason'];
	if($outtime=="00:00:00")
	{
		//$pdf->SetFont('Arial', 'I', 8);
    	$delay = "No Out time is found.";

	}
	else
	{
		//$pdf->SetFont('Arial', '', 8);
    	$delay = $interval->format('%h Hr %i Mn %s Sec');
	}

	//$xo=number_format((int)$interval->format('%h')+((int)$interval->format('%i')/60),2);
	//if($stdrtime['accid']=="41")
	//{
		if(number_format((int)$interval->format('%h')+((int)$interval->format('%i')/60),2)>$stdrtime['twh'] && ($outtime!="00:00:00"))
		{
			$r=number_format((int)$interval->format('%h'))-$stdrtime['twh']; $q=((int)$interval->format('%i')*60);
			if(($r>=0) && ($q>0))
			{			
				$pdf->SetTextColor(220,50,50);

				$xo="over time". ": ".$r." hrs & ".($q/60)." mins";
			}
			else
			{		
				$pdf->SetTextColor(0);

				$xo="no over time";

			}
		}
		else
		{
			$pdf->SetTextColor(0);

			$xo="no over time";

		}
	//}

    if($row['accname']=="Staff Panel")
	{
		$stafftype = "Staff";
	}
    else if($row['accname']=="Teachers Panel")
	{
		$stafftype = "Teacher";
	}
	
    
    $pdf->SetY($y_axis);
    $pdf->SetX(10);
	$pdf->SetFont('Arial', '', 8);

    $pdf->Cell(8, 6, $i, 1, 0, 'L', 1);
    $pdf->Cell(18, 6, $wdate, 1, 0, 'L', 1);
    $pdf->Cell(15, 6, $intime, 1, 0, 'L', 1);
    $pdf->Cell(18, 6, $outtime, 1, 0, 'L', 1);
    $pdf->Cell(63, 6, $outstatus, 1, 0, 'L', 1);
    $pdf->Cell(30, 6, $delay, 1, 0, 'L', 1);
    $pdf->Cell(42, 6, $xo, 1, 0, 'L', 1);
    //$pdf->Cell(15, 6, $stafftype, 1, 0, 'L', 1);

    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;

}

mysql_close();

//Create file
$pdf->Output();
?>