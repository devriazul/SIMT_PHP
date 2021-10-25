<?php
//PDF USING MULTIPLE PAGES
//FILE CREATED BY: Carlos Jos� V�squez S�ez
//YOU CAN CONTACT ME: carlos@magallaneslibre.com
//FROM PUNTA ARENAS, MAGALLANES
//INOVO GROUP - http://www.inovo.cl

//----------chk POST values-------------
//echo $_POST['deptid']."/".$_POST['semester']."/".$_POST['section']."/".$_POST['stdstatus']."/".$_POST['sexstatus']."/".$_POST['session']."/".$_POST['stdresultstatus']; exit;

define('FPDF_FONTPATH', 'font/');
require('fpdf.php');

//Connect to your database
require_once('dbClass.php');
include("config.php"); 
$myDb->connectDefaultServer()
 
//Create new pdf file
$pdf=new FPDF();//'P', 'cm', 'Legal'

//Open file
$pdf->Open();

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage('L');

//set initial y axis position per page
$y_axis_initial = 50;




//set the logo of the company    
	     $pdf->Image('logo.png',20,10,25);
		 

//Position at 1.5 cm from bottom
    $pdf->SetY(-15);
    //Arial italic 8
    $pdf->SetFont('Arial','',8);
    //Page number
    //$pdf->Cell(5,0,'Prepared By: ',0,0,'L'); $pdf->Cell(120,0,'Verified By: ',0,0,'R'); $pdf->Cell(140,0,'Approved By: ',0,0,'R');
    $pdf->Cell(280,10,'� Saic Institute of Management & Technology. Powered By: DesktopBD',0,0,'C');

	//print column titles for the actual page
	//$pdf->Cell(-70, -600, 'SAIC Institute of Management & Technology',0,'C',0);
	/*if($_POST['emptype']=="E")
	{
		$pdf->SetFont('Arial', 'U', 14);
		$pdf->Cell(168, -320, 'Employee Salary For the Month of: '.$_POST['smonth'].', '.$_POST['syear'],0,'C',0);
	}
	else if($_POST['emptype']=="F")
	{
		$pdf->SetFont('Arial', 'U', 14);
		$pdf->Cell(168, -320, 'Teachers Salary For the Month of: '.$_POST['smonth'].', '.$_POST['syear'],0,'C',0);
	}
*/

if(($_POST['sexstatus']!="") && ($_POST['deptid']!="") && ($_POST['semester']=="") && ($_POST['stdstatus'])=="" && ($_POST['section']=="") && ($_POST['session']=="") && ($_POST['stdresultstatus']==""))
{ //echo "1"; exit;
 	$crs="SELECT COUNT(s.id) as tn FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_semester sm on s.stdcursemester=sm.id inner join tbl_hostel h on s.hostelid=h.id WHERE s.sexstatus='$_POST[sexstatus]' and s.deptname='$_POST[deptid]' and s.storedstatus<>'D'";
 	$crq=$myDb->select($crs); 
  	$crsr=$myDb->get_row($crq,'MYSQL_ASSOC');
	$pdf->SetFont('Arial',  'I', 10);
	$pdf->Cell(-245, -300, 'Total No of students: '.$crsr['tn'],0,'C',0);

}

elseif(($_POST['sexstatus']!="") && ($_POST['deptid']!="") && ($_POST['semester']!="") && ($_POST['stdstatus'])=="" && ($_POST['section']=="") && ($_POST['session']=="") && ($_POST['stdresultstatus']==""))
{ //echo "1"; exit;
 	$crs="SELECT COUNT(s.id) as tn FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_semester sm on s.stdcursemester=sm.id inner join tbl_hostel h on s.hostelid=h.id WHERE s.sexstatus='$_POST[sexstatus]' and s.deptname='$_POST[deptid]' and s.stdcursemester='$_POST[semester]' and s.storedstatus<>'D'";
 	$crq=$myDb->select($crs); 
  	$crsr=$myDb->get_row($crq,'MYSQL_ASSOC');
	$pdf->SetFont('Arial',  'I', 10);
	$pdf->Cell(-245, -300, 'Total No of students: '.$crsr['tn'],0,'C',0);

}

else if(($_POST['sexstatus']!="") && ($_POST['semester']=="") && ($_POST['stdstatus'])=="" && ($_POST['section']=="") && ($_POST['session']=="") && ($_POST['stdresultstatus']==""))
{ //echo "1"; exit;
 	$crs="SELECT COUNT(s.id) as tn FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_semester sm on s.stdcursemester=sm.id inner join tbl_hostel h on s.hostelid=h.id WHERE s.sexstatus='$_POST[sexstatus]' and s.storedstatus<>'D'";
 	$crq=$myDb->select($crs); 
  	$crsr=$myDb->get_row($crq,'MYSQL_ASSOC');
	$pdf->SetFont('Arial',  'I', 10);
	$pdf->Cell(-245, -300, 'Total No of students: '.$crsr['tn'],0,'C',0);

}


else if(($_POST['deptid']!="") && ($_POST['semester']=="") && ($_POST['stdstatus'])=="" && ($_POST['section']=="") && ($_POST['sexstatus']=="") && ($_POST['session']!="") && ($_POST['stdresultstatus']==""))
{//echo "2"; exit;
 	$crs="SELECT COUNT(s.id) as tn FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_semester sm on s.stdcursemester=sm.id inner join tbl_hostel h on s.hostelid=h.id WHERE s.deptname='$_POST[deptid]' and s.session='$_POST[session]' and s.storedstatus<>'D' ";
 	$crq=$myDb->select($crs); 
  	$crsr=$myDb->get_row($crq,'MYSQL_ASSOC');
	$pdf->SetFont('Arial',  'I', 10);
	$pdf->Cell(-245, -300, 'Total No of students: '.$crsr['tn'],0,'C',0);

}
else if(($_POST['deptid']!="") && ($_POST['semester']!="") && ($_POST['stdstatus'])=="" && ($_POST['section']=="") && ($_POST['sexstatus']=="") && ($_POST['session']=="") && ($_POST['stdresultstatus']==""))
{//echo "2"; exit;
 	$crs="SELECT COUNT(s.id) as tn FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_semester sm on s.stdcursemester=sm.id inner join tbl_hostel h on s.hostelid=h.id WHERE s.deptname='$_POST[deptid]' and s.stdcursemester='$_POST[semester]' and s.storedstatus<>'D' ";
 	$crq=$myDb->select($crs); 
  	$crsr=$myDb->get_row($crq,'MYSQL_ASSOC');
	$pdf->SetFont('Arial',  'I', 10);
	$pdf->Cell(-245, -300, 'Total No of students: '.$crsr['tn'],0,'C',0);

}
else if(($_POST['deptid']!="") && ($_POST['semester']!="") && ($_POST['stdstatus']!="") && ($_POST['section']=="") && ($_POST['sexstatus']=="") && ($_POST['session']=="") && ($_POST['stdresultstatus']==""))
{//echo "3"; exit;
 	$crs="SELECT COUNT(s.id) as tn FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_semester sm on s.stdcursemester=sm.id inner join tbl_hostel h on s.hostelid=h.id WHERE s.deptname='$_POST[deptid]' and s.stdcursemester='$_POST[semester]' and s.stdstatus='$_POST[stdstatus]' and s.storedstatus<>'D' ";
 	$crq=$myDb->select($crs); 
  	$crsr=$myDb->get_row($crq,'MYSQL_ASSOC');
	$pdf->SetFont('Arial',  'I', 10);
	$pdf->Cell(-245, -300, 'Total No of students: '.$crsr['tn'],0,'C',0);

}
else if(($_POST['deptid']!="") && ($_POST['semester']!="") && ($_POST['section']!="") && ($_POST['stdstatus']=="") && ($_POST['sexstatus']=="") && ($_POST['session']=="") && ($_POST['stdresultstatus']==""))
{//echo "4"; exit;
 	$crs="SELECT COUNT(s.id) as tn FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_semester sm on s.stdcursemester=sm.id inner join tbl_hostel h on s.hostelid=h.id WHERE s.deptname='$_POST[deptid]' and s.stdcursemester='$_POST[semester]' and s.section='$_POST[section]' and s.storedstatus<>'D' ";
 	$crq=$myDb->select($crs); 
  	$crsr=$myDb->get_row($crq,'MYSQL_ASSOC');
	$pdf->SetFont('Arial',  'I', 10);
	$pdf->Cell(-245, -300, 'Total No of students: '.$crsr['tn'],0,'C',0);

}
else if(($_POST['deptid']!="") && ($_POST['semester']!="") && ($_POST['section']=="") && ($_POST['stdstatus']=="") && ($_POST['sexstatus']=="") && ($_POST['session']!="") && ($_POST['stdresultstatus']!=""))
{//echo "7"; exit;
 	$crs="SELECT COUNT(s.id) as tn FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_semester sm on s.stdcursemester=sm.id inner join tbl_hostel h on s.hostelid=h.id WHERE s.deptname='$_POST[deptid]' and s.stdcursemester='$_POST[semester]' and s.session='$_POST[session]' and s.resultstatus='$_POST[stdresultstatus]' and s.storedstatus<>'D' "; 
 	$crq=$myDb->select($crs); 
  	$crsr=$myDb->get_row($crq,'MYSQL_ASSOC');
	$pdf->SetFont('Arial',  'I', 10);
	$pdf->Cell(-245, -300, 'Total No of students: '.$crsr['tn'],0,'C',0);

}
else
{//echo "5"; exit;
 	$crs="SELECT COUNT(s.id) as tn FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_semester sm on s.stdcursemester=sm.id inner join tbl_hostel h on s.hostelid=h.id WHERE s.storedstatus<>'D'";
 	$crq=$myDb->select($crs); 
  	$crsr=$myDb->get_row($crq,'MYSQL_ASSOC');
	$pdf->SetFont('Arial', 'I', 10);
	$pdf->Cell(-245, -300, 'Total No of students: '.$crsr['tn'],0,'C',0);

}


	$pdf->SetFont('Arial', '');
	$pdf->Cell(0, -300, "Date: ".date('F j, Y'), 0,0, 'R');

// set the Report Header & Date
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetFillColor(235,234,230);
$pdf->Cell(-70,-360,"SAIC INSTITUTE OF MANAGEMENT & TECHNOLOGY",0,0,'R');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(-20,-350,"House # 1, Road # 2, Block # B, Section # 6, Mirpur, Dhaka - 1216",0,0,'R');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(-5,-340,"Phone: +88 02 8033034, +88 01936005816, +88 01936005817",0,0,'R');
$pdf->SetFont('Arial', 'U', 12);
if(($_POST['sexstatus']!="") && ($_POST['deptid']!="") && ($_POST['semester']=="") && ($_POST['stdstatus'])=="" && ($_POST['section']=="") && ($_POST['session']=="") && ($_POST['stdresultstatus']==""))
{
	$drs="SELECT name From tbl_department WHERE id='$_POST[deptid]' and storedstatus<>'D'";
 	$drq=$myDb->select($drs); 
  	$drsr=$myDb->get_row($drq,'MYSQL_ASSOC');
	
	$pdf->Cell(-100,-320,"Student Information Report ( Department:".$drsr['name']."/Gender: ".$_POST['sexstatus'].")",0,0,'C');
}

elseif(($_POST['sexstatus']!="") && ($_POST['deptid']!="") && ($_POST['semester']!="") && ($_POST['stdstatus'])=="" && ($_POST['section']=="") && ($_POST['session']=="") && ($_POST['stdresultstatus']==""))
{
	$drs="SELECT name From tbl_department WHERE id='$_POST[deptid]' and storedstatus<>'D'";
 	$drq=$myDb->select($drs); 
  	$drsr=$myDb->get_row($drq,'MYSQL_ASSOC');
	
	$srs="SELECT name From tbl_semester WHERE id='$_POST[semester]' and storedstatus<>'D'";
 	$srq=$myDb->select($srs); 
  	$srsr=$myDb->get_row($srq,'MYSQL_ASSOC');
	
	
	$pdf->Cell(-100,-320,"Student Information Report ( Department:".$drsr['name']."/Semester:".$srsr['name']."/Gender: ".$_POST['sexstatus'].")",0,0,'C');
}

else if(($_POST['sexstatus']!="") && ($_POST['semester']=="") && ($_POST['stdstatus'])=="" && ($_POST['section']=="") && ($_POST['session']=="") && ($_POST['stdresultstatus']==""))
{
	$pdf->Cell(-100,-320,"Student Information Report ( Gender: ".$_POST['sexstatus'].")",0,0,'C');
}




else if(($_POST['deptid']!="") && ($_POST['semester']=="") && ($_POST['stdstatus']=="") && ($_POST['section']=="") && ($_POST['sexstatus']=="") && ($_POST['session']!="") && ($_POST['stdresultstatus']==""))
{
 	$drs="SELECT name From tbl_department WHERE id='$_POST[deptid]' and storedstatus<>'D'";
 	$drq=$myDb->select($drs); 
  	$drsr=$myDb->get_row($drq,'MYSQL_ASSOC');

 	/*$srs="SELECT name From tbl_semester WHERE id='$_POST[semester]' and storedstatus<>'D'";
 	$srq=$myDb->select($srs); 
  	$srsr=$myDb->get_row($srq,'MYSQL_ASSOC');*/

	$pdf->Cell(-100,-320,"Student Information Report ( Department: ".$drsr['name']."/ Session: ".$_POST['session'].")",0,0,'C');
}else if(($_POST['deptid']!="") && ($_POST['semester']!="") && ($_POST['stdstatus']=="") && ($_POST['section']=="") && ($_POST['sexstatus']=="") && ($_POST['session']=="") && ($_POST['stdresultstatus']==""))
{
 	$drs="SELECT name From tbl_department WHERE id='$_POST[deptid]' and storedstatus<>'D'";
 	$drq=$myDb->select($drs); 
  	$drsr=$myDb->get_row($drq,'MYSQL_ASSOC');

 	$srs="SELECT name From tbl_semester WHERE id='$_POST[semester]' and storedstatus<>'D'";
 	$srq=$myDb->select($srs); 
  	$srsr=$myDb->get_row($srq,'MYSQL_ASSOC');

	$pdf->Cell(-100,-320,"Student Information Report ( Department: ".$drsr['name']."/ Semester: ".$srsr['name'].")",0,0,'C');
}
else if(($_POST['deptid']!="") && ($_POST['semester']!="") && ($_POST['stdstatus']!="") && ($_POST['section']=="") && ($_POST['sexstatus']=="") && ($_POST['session']=="") && ($_POST['stdresultstatus']==""))
{
 	$drs="SELECT name From tbl_department WHERE id='$_POST[deptid]' and storedstatus<>'D'";
 	$drq=$myDb->select($drs); 
  	$drsr=$myDb->get_row($drq,'MYSQL_ASSOC');

 	$srs="SELECT name From tbl_semester WHERE id='$_POST[semester]' and storedstatus<>'D'";
 	$srq=$myDb->select($srs); 
  	$srsr=$myDb->get_row($srq,'MYSQL_ASSOC');

	$pdf->Cell(-100,-320,"Student Information Report ( Department: ".$drsr['name']."/ Semester: ".$srsr['name']."/ Type: ".$_POST['stdstatus'].")",0,0,'C');

}
else if(($_POST['deptid']!="") && ($_POST['semester']!="") && ($_POST['section']!="") && ($_POST['stdstatus']=="") && ($_POST['sexstatus']=="") && ($_POST['session']=="") && ($_POST['stdresultstatus']==""))
{
 	$drs="SELECT name From tbl_department WHERE id='$_POST[deptid]' and storedstatus<>'D'";
 	$drq=$myDb->select($drs); 
  	$drsr=$myDb->get_row($drq,'MYSQL_ASSOC');

 	$srs="SELECT name From tbl_semester WHERE id='$_POST[semester]' and storedstatus<>'D'";
 	$srq=$myDb->select($srs); 
  	$srsr=$myDb->get_row($srq,'MYSQL_ASSOC');

	$pdf->Cell(-100,-320,"Student Information Report ( Department: ".$drsr['name']."/ Semester: ".$srsr['name']."/ Section: ".$_POST['section'].")",0,0,'C');

}
else if(($_POST['deptid']!="") && ($_POST['semester']!="") && ($_POST['section']=="") && ($_POST['stdstatus']=="") && ($_POST['sexstatus']=="") && ($_POST['session']!="") && ($_POST['stdresultstatus']!=""))
{
 	$drs="SELECT name From tbl_department WHERE id='$_POST[deptid]' and storedstatus<>'D'";
 	$drq=$myDb->select($drs); 
  	$drsr=$myDb->get_row($drq,'MYSQL_ASSOC');

 	$srs="SELECT name From tbl_semester WHERE id='$_POST[semester]' and storedstatus<>'D'";
 	$srq=$myDb->select($srs); 
  	$srsr=$myDb->get_row($srq,'MYSQL_ASSOC');

	$pdf->Cell(-100,-320,"Student Information Report ( Department: ".$drsr['name']."/ Semester: ".$srsr['name']."/ Session: ".$_POST['session']."/ Result: ".$_POST['stdresultstatus'].")",0,0,'C');

}

else
{
	$pdf->Cell(-100,-320,"Student Information Report (All)",0,0,'C');
}
//$pdf->Cell(5, -498, "Date:");


// set the table header color
$pdf->SetFillColor(232, 232, 232);//(94, 188, 225);
$pdf->SetFont('Arial', 'B', 7);

$pdf->SetY($y_axis_initial);

$pdf->SetX(5);

		$pdf->Cell(20, 6, 'ID', 1, 0, 'L', 1);
		$pdf->Cell(38, 6, 'Name', 1, 0, 'L', 1);
		$pdf->Cell(35, 6, 'Fathers Name', 1, 0, 'L', 1);
		$pdf->Cell(32, 6, 'Mothers Name', 1, 0, 'L', 1);
		$pdf->Cell(40, 6, 'Address', 1, 0, 'L', 1);
		$pdf->Cell(14, 6, 'Batch', 1, 0, 'L', 1);
		$pdf->Cell(22, 6, 'Semester', 1, 0, 'L', 1);
		$pdf->Cell(15, 6, 'Board Roll', 1, 0, 'C', 1);
		$pdf->Cell(15, 6, 'Board Reg.', 1, 0, 'C', 1);
		$pdf->Cell(15, 6, 'Hostel', 1, 0, 'L', 1);
		$pdf->Cell(34, 6, 'Cotact No', 1, 0, 'L', 1);
		$pdf->Cell(10, 6, 'Section', 1, 0, 'C', 1);
		//$pdf->Cell(12, 6, 'Status', 1, 0, 'C', 1);
		//$pdf->Cell(20, 6, 'Signature', 1, 0, 'L', 1);
		//$pdf->Cell(15, 6, 'Remarks', 1, 0, 'L', 1);
// set table body color
$pdf->SetFillColor(255, 255, 255);

$row_height = 6;

$y_axis = 50;
$y_axis = $y_axis + $row_height;

//Select the Products you want to show in your PDF file
if(($_POST['sexstatus']!="") && ($_POST['deptid'] !="") && ($_POST['semester']=="") && ($_POST['stdstatus'])=="" && ($_POST['section']=="") && ($_POST['session']=="") && ($_POST['stdresultstatus']==""))
{
	$result=mysql_query("SELECT s.*, d.name as department, b.batchname as batchname, sm.name as semester, h.name as hostel FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_semester sm on s.stdcursemester=sm.id inner join tbl_hostel h on s.hostelid=h.id WHERE s.sexstatus='$_POST[sexstatus]' and s.deptname='$_POST[deptid]' and s.storedstatus<>'D' Order By d.id");
}

elseif(($_POST['sexstatus']!="") && ($_POST['deptid'] !="") && ($_POST['semester']!="") && ($_POST['stdstatus'])=="" && ($_POST['section']=="") && ($_POST['session']=="") && ($_POST['stdresultstatus']==""))
{
	$result=mysql_query("SELECT s.*, d.name as department, b.batchname as batchname, sm.name as semester, h.name as hostel FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_semester sm on s.stdcursemester=sm.id inner join tbl_hostel h on s.hostelid=h.id WHERE s.sexstatus='$_POST[sexstatus]' and s.deptname='$_POST[deptid]' and s.stdcursemester='$_POST[semester]' and s.storedstatus<>'D' Order By d.id");
}


else if(($_POST['sexstatus']!="") && ($_POST['semester']=="") && ($_POST['stdstatus'])=="" && ($_POST['section']=="") && ($_POST['session']=="") && ($_POST['stdresultstatus']==""))
{
	$result=mysql_query("SELECT s.*, d.name as department, b.batchname as batchname, sm.name as semester, h.name as hostel FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_semester sm on s.stdcursemester=sm.id inner join tbl_hostel h on s.hostelid=h.id WHERE s.sexstatus='$_POST[sexstatus]' and s.storedstatus<>'D' Order By d.id");
}


else if(($_POST['deptid']!="") && ($_POST['semester']=="") && ($_POST['stdstatus']=="") && ($_POST['section']=="") && ($_POST['sexstatus']=="") && ($_POST['session']!="") && ($_POST['stdresultstatus']==""))
{
	$result=mysql_query("SELECT s.*, d.name as department, b.batchname as batchname, sm.name as semester, h.name as hostel FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_semester sm on s.stdcursemester=sm.id inner join tbl_hostel h on s.hostelid=h.id WHERE s.deptname='$_POST[deptid]' and s.session='$_POST[session]' and s.storedstatus<>'D' Order By d.id");
}
else if(($_POST['deptid']!="") && ($_POST['semester']!="") && ($_POST['stdstatus']=="") && ($_POST['section']=="") && ($_POST['sexstatus']=="") && ($_POST['session']=="") && ($_POST['stdresultstatus']==""))
{
	$result=mysql_query("SELECT s.*, d.name as department, b.batchname as batchname, sm.name as semester, h.name as hostel FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_semester sm on s.stdcursemester=sm.id inner join tbl_hostel h on s.hostelid=h.id WHERE s.deptname='$_POST[deptid]' and s.stdcursemester='$_POST[semester]' and s.storedstatus<>'D' Order By d.id");
}
else if(($_POST['deptid']!="") && ($_POST['semester']!="") && ($_POST['stdstatus']!="") && ($_POST['section']=="") && ($_POST['sexstatus']=="") && ($_POST['session']=="") && ($_POST['stdresultstatus']==""))
{
	$result=mysql_query("SELECT s.*, d.name as department, b.batchname as batchname, sm.name as semester, h.name as hostel FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_semester sm on s.stdcursemester=sm.id inner join tbl_hostel h on s.hostelid=h.id WHERE s.deptname='$_POST[deptid]' and s.stdcursemester='$_POST[semester]' and s.stdstatus='$_POST[stdstatus]' and s.storedstatus<>'D' Order By d.id");
}
else if(($_POST['deptid']!="") && ($_POST['semester']!="") && ($_POST['section']!="") && ($_POST['stdstatus']=="") && ($_POST['sexstatus']=="") && ($_POST['session']=="") && ($_POST['stdresultstatus']==""))
{
	$result=mysql_query("SELECT s.*, d.name as department, b.batchname as batchname, sm.name as semester, h.name as hostel FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_semester sm on s.stdcursemester=sm.id inner join tbl_hostel h on s.hostelid=h.id WHERE s.deptname='$_POST[deptid]' and s.stdcursemester='$_POST[semester]' and s.section='$_POST[section]' and s.storedstatus<>'D' Order By d.id");
}
else if(($_POST['deptid']!="") && ($_POST['semester']!="") && ($_POST['section']=="") && ($_POST['stdstatus']=="") && ($_POST['sexstatus']=="") && ($_POST['session']!="") && ($_POST['stdresultstatus']!=""))
{
	$result=mysql_query("SELECT s.*, d.name as department, b.batchname as batchname, sm.name as semester, h.name as hostel FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_semester sm on s.stdcursemester=sm.id inner join tbl_hostel h on s.hostelid=h.id WHERE s.deptname='$_POST[deptid]' and s.stdcursemester='$_POST[semester]' and s.session='$_POST[session]' and s.resultstatus='$_POST[stdresultstatus]' and s.storedstatus<>'D' Order By d.id");
}
else
{
	$result=mysql_query("SELECT s.*, d.name as department, b.batchname as batchname, sm.name as semester, h.name as hostel FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_semester sm on s.stdcursemester=sm.id inner join tbl_hostel h on s.hostelid=h.id WHERE s.storedstatus<>'D' Order By d.id");

}
//initialize counter
$i = 0;

//Set maximum rows per page
$max = 22;

//Set Row Height

$pdf->SetFont('Arial', '', 7);

while($row = mysql_fetch_array($result))
{
    //If the current row is the last one, create new page and print column title
    if ($i == $max)
    {
		// SET NEXT PAGE START POSITION
		$y_axis_initial = 30;
		$y_axis = 30;
        $pdf->AddPage('L');
      	$pdf->Cell(280,380,'� Saic Institute of Management & Technology. Powered By: DesktopBD.',0,0,'C');

        //print column titles for the current page
        $pdf->SetY($y_axis_initial);
        $pdf->SetX(5);
		// set next page header color
		$pdf->SetFillColor(232, 232, 232);
		$pdf->SetFont('Arial', 'B', 7);


		$pdf->Cell(20, 6, 'ID', 1, 0, 'L', 1);
		$pdf->Cell(38, 6, 'Name', 1, 0, 'L', 1);
		$pdf->Cell(35, 6, 'Fathers Name', 1, 0, 'L', 1);
		$pdf->Cell(32, 6, 'Mothers Name', 1, 0, 'L', 1);
		$pdf->Cell(40, 6, 'Address', 1, 0, 'L', 1);
		$pdf->Cell(14, 6, 'Batch', 1, 0, 'L', 1);
		$pdf->Cell(22, 6, 'Semester', 1, 0, 'L', 1);
		$pdf->Cell(15, 6, 'Board Roll', 1, 0, 'C', 1);
		$pdf->Cell(15, 6, 'Board Reg.', 1, 0, 'C', 1);
		$pdf->Cell(15, 6, 'Hostel', 1, 0, 'L', 1);
		$pdf->Cell(34, 6, 'Cotact No', 1, 0, 'L', 1);
		$pdf->Cell(10, 6, 'Section', 1, 0, 'C', 1);
		//$pdf->Cell(12, 6, 'Status', 1, 0, 'C', 1);
		//$pdf->Cell(20, 6, 'Net Payable', 1, 0, 'L', 1);
		//$pdf->Cell(20, 6, 'Signature', 1, 0, 'L', 1);
		//$pdf->Cell(15, 6, 'Remarks', 1, 0, 'L', 1);
		// set next page body color
		$pdf->SetFillColor(232, 232, 232);
        
        //Go to next row
        $y_axis = $y_axis + $row_height;
        
        //Set $i variable to 0 (first row)
        $i = 0;
    }

    $stdid = $row['stdid'];
    $stdname = $row['stdname'];
    $fname = $row['fname'];
    $mname = $row['mname'];
	$address = $row['praddress']."/".$row['peraddress'];
    $batchname = $row['batchname'];
    $semester = $row['semester'];
    //$session = $row['session'];
    $boardrollno = $row['boardrollno'];
    $boardregno = $row['boardregno'];
    $hostel = $row['hostel'];
    $phone = $row['phone'];
    $section = $row['section'];
    //$stdstatus = $row['stdstatus'];
    //$netpay = $row['netpay'];
    //$remarks = $row['remarks'];
    //$securitymoney = $row['securitymoney'];

    $pdf->SetY($y_axis);
    $pdf->SetX(5);

	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetFont('Arial', '', 7);

    $pdf->Cell(20, 6, $stdid, 1, 0, 'L', 1);
    $pdf->Cell(38, 6, $stdname, 1, 0, 'L', 1);
    $pdf->Cell(35, 6, $fname, 1, 0, 'L', 1);
    $pdf->Cell(32, 6, $mname, 1, 0, 'L', 1);
    $pdf->Cell(40, 6, $address, 1, 0, 'L', 1);
    $pdf->Cell(14, 6, $batchname, 1, 0, 'L', 1);
    $pdf->Cell(22, 6, $semester, 1, 0, 'L', 1);
    $pdf->Cell(15, 6, $boardrollno, 1, 0, 'C', 1);
    $pdf->Cell(15, 6, $boardregno, 1, 0, 'C', 1);
    $pdf->Cell(15, 6, $hostel, 1, 0, 'L', 1);
    $pdf->Cell(34, 6, $phone, 1, 0, 'L', 1);
    $pdf->Cell(10, 6, $section, 1, 0, 'C', 1);
    
	
	//$pdf->Cell(12, 6, $stdstatus, 1, 0, 'C', 1);
    //$pdf->Cell(20, 6, $netpay, 1, 0, 'L', 1);
    //$pdf->Cell(20, 6, '', 1, 0, 'L', 1);
    //$pdf->Cell(15, 6, $remarks, 1, 0, 'L', 1);

    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;

}

mysql_close();

//Create file
$pdf->Output();
?>