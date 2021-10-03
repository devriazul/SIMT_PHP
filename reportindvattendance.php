 <?php
//PDF USING MULTIPLE PAGES
//FILE CREATED BY: Carlos José Vásquez Sáez
//YOU CAN CONTACT ME: carlos@magallaneslibre.com
//FROM PUNTA ARENAS, MAGALLANES
//INOVO GROUP - http://www.inovo.cl

define('FPDF_FONTPATH', 'font/');
require('fpdf.php');

//Connect to your database
require_once('dbClass.php');
include("config.php"); 
$myDb->connect($host,$user,$pwd,$db,true);

//echo $er=substr($_POST['efid'],0,1); exit;//substr($_POST['efid'],1,1); 
 
//Create new pdf file
$pdf=new FPDF();

//Open file
$pdf->Open();

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage('P');

//set initial y axis position per page
$y_axis_initial = 50;




//set the logo of the company    
	     $pdf->Image('logo.png',10,5,25);
		 

//Position at 1.5 cm from bottom
    $pdf->SetY(-20);
    //Arial italic 8
    $pdf->SetFont('Arial','B',8);
    //Page number
    $pdf->Cell(0,10,'Copyright © Saic Institute of Management & Technology. Powered By: DesktopBD.',0,0,'C');

	//print column titles for the actual page & Date
	//$pdf->Cell(-70, -600, 'SAIC Institute of Management & Technology',0,'C',0);
	
	$pdf->SetY(30);
	$pdf->SetX(63);
	$pdf->SetFont('Arial', 'U', 14);
	$pdf->Cell(80, 10, 'Individual Attendance Report',0,0,'C');

	$pdf->SetY(35);
	$pdf->SetX(63);
	$pdf->SetFont('Arial', '',10);
	$pdf->Cell(80, 10, "From Date: ".$_POST['fromdate']." To Date: ".$_POST['todate'], 0,0, 'C');


	//-----------Print Date--------------
	//$pdf->Cell(0, -490, "Date: ".date('F j, Y'), 0,0, 'R');
	//-----------Show slected dates by user----------------


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


//$pdf->SetFont('Arial', 'B', 12);
//$pdf->Cell(5, -498, "Date:");


// set the table header color
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 10);

$pdf->SetY($y_axis_initial);

$pdf->SetX(5);

		$pdf->Cell(1, 6, '', 0, 0, 'L', 0);
		$pdf->Cell(20, 6, 'Date', 1, 0, 'L', 1);
		$pdf->Cell(60, 6, 'Name', 1, 0, 'L', 1);
		$pdf->Cell(16, 6, 'In Time', 1, 0, 'L', 1);
		$pdf->Cell(32, 6, 'Delay', 1, 0, 'L', 1);
		$pdf->Cell(18, 6, 'In Status', 1, 0, 'L', 1);
		$pdf->Cell(18, 6, 'Out Time', 1, 0, 'L', 1);
		$pdf->Cell(38, 6, 'Out Status', 1, 0, 'L', 1);
// set table body color
$pdf->SetFillColor(255, 255, 255);

$row_height = 6;

$y_axis = 50;
$y_axis = $y_axis + $row_height;

	if(substr($_POST['efid'],0,1)=="E")
	{

		$id="SELECT at . * , s.name AS EmpName, REPLACE(a.accname,'Panel','') as accname FROM  `tbl_attendance` at INNER JOIN  `tbl_staffinfo` s ON at.efid = s.sid INNER JOIN  `tbl_access` a ON at.accid = a.id WHERE at.edate BETWEEN  '$_POST[fromdate]' AND  '$_POST[todate]' and at.efid='$_POST[efid]' ";
	
		$qid=$myDb->select($id);
		$fid=$myDb->get_row($qid,'MYSQL_ASSOC');
	  	
		$stdtime="SELECT * FROM tbl_attendancesettings WHERE accid='41'";	
      	$stdqtime=$myDb->select($stdtime);
	  	$stdrtime=$myDb->get_row($stdqtime,'MYSQL_ASSOC');
	}
	else if(substr($_POST['efid'],0,1)=="F")
	{
		$id="SELECT at . * , f.name AS FacName, REPLACE(a.accname,'Panel','') as accname FROM  `tbl_attendance` at INNER JOIN  `tbl_faculty` f ON at.efid = f.facultyid INNER JOIN  `tbl_access` a ON at.accid = a.id WHERE at.edate BETWEEN  '$_POST[fromdate]' AND  '$_POST[todate]' and at.efid='$_POST[efid]'";
		$qid=$myDb->select($id);
		$fid=$myDb->get_row($qid,'MYSQL_ASSOC');
	  
	  
	  	$stdtime="SELECT * FROM tbl_attendancesettings WHERE accid='37'";	
      	$stdqtime=$myDb->select($stdtime);
	  	$stdrtime=$myDb->get_row($stdqtime,'MYSQL_ASSOC');
	}
	

//Select the Products you want to show in your PDF file
//echo $rr="SELECT at . * , s.name AS EmpName, REPLACE(a.accname,'Panel','') as accname, TIMEDIFF(intime,'".$stdrtime['stdintime']."') as tdiff FROM  `tbl_attendance` at INNER JOIN  `tbl_staffinfo` s ON at.efid = s.sid INNER JOIN  `tbl_access` a ON at.accid = a.id WHERE at.edate BETWEEN  '$_POST[fromdate]' AND  '$_POST[todate]'  UNION SELECT at . * , f.name AS FacName, REPLACE(a.accname,'Panel','') as accname,TIMEDIFF(intime,'".$stdrtime['stdintime']."') as tdiff FROM  `tbl_attendance` at INNER JOIN  `tbl_faculty` f ON at.efid = f.facultyid INNER JOIN  `tbl_access` a ON at.accid = a.id WHERE at.edate BETWEEN  '$_POST[fromdate]' AND  '$_POST[todate]' "; exit;
	

	if(substr($_POST['efid'],0,1)=="E")
	{

		$result=mysql_query("SELECT at . * , s.name AS EmpName, REPLACE(a.accname,'Panel','') as accname, LEFT(TIMEDIFF(intime,'".$stdrtime['stdintime']."'),1) as tdiff FROM  `tbl_attendance` at INNER JOIN  `tbl_staffinfo` s ON at.efid = s.sid INNER JOIN  `tbl_access` a ON at.accid = a.id WHERE at.edate BETWEEN  '$_POST[fromdate]' AND  '$_POST[todate]' and at.efid='$_POST[efid]' ");
	}
	else if(substr($_POST['efid'],0,1)=="F")
	{ 
		$result=mysql_query("SELECT at . * , f.name AS EmpName, REPLACE(a.accname,'Panel','') as accname, LEFT(TIMEDIFF(intime,'".$stdrtime['stdintime']."'),1) as tdiff FROM  `tbl_attendance` at INNER JOIN  `tbl_faculty` f ON at.efid = f.facultyid INNER JOIN  `tbl_access` a ON at.accid = a.id WHERE at.edate BETWEEN  '$_POST[fromdate]' AND  '$_POST[todate]' and at.efid='$_POST[efid]'");
	}



//initialize counter
$i = 0;

//Set maximum rows per page
$max = 35;

//Set Row Height


while($row = mysql_fetch_array($result))
{
//determine the time delay
	if(substr($_POST['efid'],0,1)=="E")
	{ //echo "emp"; exit;
	  $stdtime="SELECT * FROM tbl_attendancesettings WHERE accid='41'";	
      $stdqtime=$myDb->select($stdtime);
	  $stdrtime=$myDb->get_row($stdqtime,'MYSQL_ASSOC');
 				  
	  $t1= new DateTime($row['intime']);
	  $t2= new DateTime($stdrtime['stdintime']);
	  $interval = $t1->diff($t2);
	  $a=(int)$interval->format('%h');
	  $b=(int)$interval->format('%i'); 
	  $c=($a*60)+$b;
	}
	else if(substr($_POST['efid'],0,1)=="F")
	{ //echo "fac"; exit;
	  $stdtime="SELECT * FROM tbl_attendancesettings WHERE accid='37'";
      $stdqtime=$myDb->select($stdtime);
	  $stdrtime=$myDb->get_row($stdqtime,'MYSQL_ASSOC');
 				  
	  $t1= new DateTime($row['intime']);
	  $t2= new DateTime($stdrtime['stdintime']);
	  $interval = $t1->diff($t2);
	  $a=(int)$interval->format('%h');
	  $b=(int)$interval->format('%i'); 
	  $c=($a*60)+$b;
	}
	 
    

//If the current row is the last one, create new page and print column title
    if ($i == $max)
    {
		// SET NEXT PAGE START POSITION
		$y_axis_initial = 30;
		$y_axis = 30;
        $pdf->AddPage('P');
	    $pdf->SetFont('Arial','B',8);
      	$pdf->Cell(190,550,'Copyright © Saic Institute of Management & Technology. Powered By: DesktopBD.',0,0,'C');


        //print column titles for the current page
        $pdf->SetY($y_axis_initial);
        $pdf->SetX(5);
		// set next page header color
		$pdf->SetFillColor(232, 232, 232);
		$pdf->SetFont('Arial', 'B', 10);

		$pdf->Cell(1, 6, '', 0, 0, 'L', 0);
		$pdf->Cell(20, 6, 'Date', 1, 0, 'L', 1);
		$pdf->Cell(60, 6, 'Name', 1, 0, 'L', 1);
		$pdf->Cell(16, 6, 'In Time', 1, 0, 'L', 1);
		$pdf->Cell(32, 6, 'Delay', 1, 0, 'L', 1);
		$pdf->Cell(18, 6, 'In Status', 1, 0, 'L', 1);
		$pdf->Cell(18, 6, 'Out Time', 1, 0, 'L', 1);
		$pdf->Cell(38, 6, 'Out Status', 1, 0, 'L', 1);
		// set next page body color
		$pdf->SetFillColor(255, 255, 255);
        
        //Go to next row
        $y_axis = $y_axis + $row_height;
        
        //Set $i variable to 0 (first row)
        $i = 0;
    }
	//-------set the details page font-----------
	//$pdf->SetFont('Arial', '', 10);

    $edate = $row['edate'];
    $name = $row['EmpName'];
    $intime = $row['intime'];
	if(($row['tdiff']=='-'))
	{
		$delay = "------------------";
	}
	else if(($c<=$stdrtime['minallow']))
	{
		$delay = "------------------";
	}
	else if (($c>$stdrtime['minallow']) && ($c<=$stdrtime['maxallow']))
	{
	    $delay = $interval->format('%h Hr %i Mn %s Sec');//$row['tdiff'];
	}
	else if ($c>$stdrtime['maxallow'])
	{
	    $delay = $interval->format('%h Hr %i Mn %s Sec');//$row['tdiff'];
	}
    //$delay = $interval->format('%h Hr %i Mn %s Sec');//$row['tdiff'];
    $stafftype = $row['accname'];
	
	//echo	$row['tdiff']; exit;
	//$f= hoursToMinutes($row['tdiff']);
	//echo	$row['tdiff']."**".$c."**".$stdrtime['minallow']; exit;

	if(($row['tdiff']=='-') )
	{		
		$status = "Present";
	}
	else if($c<=$stdrtime['minallow'])
	{		
		$status = "Present";
	}


	else if (($c>$stdrtime['minallow']) && ($c<=$stdrtime['maxallow']))
	{
		$status = "Late";

	}
	else if ($c>$stdrtime['maxallow'])
	{
		$status = "Absent";

	}
	
    $pdf->SetY($y_axis);
    $pdf->SetX(5);
	//

    $pdf->Cell(1, 6, ' ', 0, 0, 'L', 0);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(20, 6, $edate, 1, 0, 'L', 1);
    $pdf->Cell(60, 6, $name, 1, 0, 'L', 1);
    $pdf->Cell(16, 6, $intime, 1, 0, 'L', 1);
    $pdf->Cell(32, 6, $delay, 1, 0, 'L', 1);

	if($status=="Absent")
	{
    	$pdf->SetTextColor(255,0,0);
		$pdf->Cell(18, 6, $status, 1, 0, 'L', 1);
	}
	else if($status=="Late")
	{
    	$pdf->SetTextColor(0,0,255);
		$pdf->Cell(18, 6, $status, 1, 0, 'L', 1);
	}

	else
	{
    	$pdf->SetTextColor(0,0,0);
		$pdf->Cell(18, 6, $status, 1, 0, 'L', 1);
	
	}
   	$pdf->SetTextColor(0,0,0);
    $pdf->Cell(18, 6, $row['outtime'], 1, 0, 'L', 1);
    $pdf->Cell(38, 6, $row['earlyoutreason'], 1, 0, 'L', 1);

	//$pdf->Cell(20, 6, $status, 1, 0, 'L', 1);


    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;

}

mysql_close();

//Create file
$pdf->Output();
?>