<?php //require_once('../dbClass.php');
include("/config.php"); 
$myDb->connect($host,$user,$pwd,$db,true);


require('/FPDF/fpdf.php');
class PDF extends FPDF
{

function Header()
{
    //Logo
    $this->Image('logo.png',10,8,33);
    //Arial bold 15
    $this->SetFont('Arial','B',12);
    //Move to the right
    $this->Cell(80);
    //Title
    $this->Cell(30,10,'SAIC INSTITUTE OF AMANGEMENT & TECHNOLOGY',0,0,'C');  //in last 3 parameters 1st parameter set 0 means no border 1 means border
	$this->Cell(2, 30, 'Semsterwise Course Distribution Report',0,'C',0);
	
	$this->SetFont('Arial','B',9);
    $this->Cell(50, 30, "Date: ".date('F j, Y'), 0,0, 'R');


    //Line break
    $this->Ln(30);
}
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Text color in gray
    $this->SetTextColor(128);
    // Page number
	    $this->SetFont('Arial','B',6);
    //Move to the right
    $this->Cell(80);
    //Title
    $this->Cell(-50,10,'SAIC INSTITUTE OF AMANGEMENT & TECHNOLOGY',0,0,'C');  //in last 3 parameters 1st parameter set 0 means no border 1 means border

    $this->Cell(150,10,'Page '.$this->PageNo(),0,0,'C');
}



// Load data
function LoadData($sql)
{
    $data = array();
	$lin=mysql_query($sql);
	while($lines=mysql_fetch_array($lin)){
	  $data[]=$lines;
	
	}
   return $data;
	
}

// Simple table
function BasicTable($header, $data)
{
    // Header
    foreach($header as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
}

// Better table
function ImprovedTable($header, $data)
{
    // Column widths
    $w = array(10, 35, 30,30);
    // Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR');
        $this->Cell($w[1],6,$row[1],'LR');
        $this->Cell($w[2],6,$row[2],'LR');
        $this->Cell($w[3],6,$row[3],'LR');
        //$this->Cell($w[3],6,$row[3],'LR');
        //$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
        //$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
        $this->Ln();
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}

// Colored table
function CourseDistByDept($header, $data)
{    

			$w = array(20,60,10,10,15,15,15,15,15,15);		    

			// Color and font restoration
			$this->SetFillColor(235,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');
			foreach($data as $row)
			{    

			$this->Cell(15,15,'Semester Name: ',0,0,'L',false);
			$this->Cell(110,15,$row['name'],0,0,'L',false);
			
			$this->Ln(10);
			$this->SetFillColor(235,235,255);

			for($i=0;$i<count($header);$i++)

			   $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
			
				
					$this->Ln();
					
				$sql=mysql_query("SELECT tbl_courses.coursecode, tbl_courses.coursename as CourseName, tbl_courses.credit, tbl_courses.theory, tbl_courses.practical, tbl_courses.cont_assess_t, tbl_courses.f_exam_t, tbl_courses.cont_assess_p, tbl_courses.f_exam_p, (tbl_courses.cont_assess_t + tbl_courses.f_exam_t + tbl_courses.cont_assess_p + tbl_courses.f_exam_p) as Total, tbl_semesterwisesubj.year, tbl_semesterwisesubj.session, tbl_semester.name as SemesterName, tbl_department.name as DepartmentName  FROM tbl_semesterwisesubj inner join tbl_semester on tbl_semesterwisesubj.semesterid=tbl_semester.id inner join tbl_department on tbl_semesterwisesubj.deptid=tbl_department.id 	inner join tbl_courses on tbl_semesterwisesubj.courseid=tbl_courses.id WHERE tbl_semesterwisesubj.storedstatus <>'D' and tbl_semesterwisesubj.session='$_POST[session]' and tbl_semesterwisesubj.deptid='$_POST[department]' and tbl_semester.name='$row[name]'") or die(mysql_error());
		    $i=0;
			$fill = false;
			$max=40;							
           	while($sqlf=mysql_fetch_array($sql))
			{
				if($i==$max)
				{
					for($i=0;$i<count($header);$i++)
						$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
						$this->Ln();
					 	$i=0;
						 
				}
				$this->SetFillColor(255,255,255);
   
				$this->Cell($w[0],6,$sqlf[0],'LR',0,'L',$fill);
				$this->Cell($w[1],6,$sqlf[1],'LR',0,'L',$fill);
				$this->Cell($w[2],6,$sqlf[2],'LR',0,'C',$fill);
				$this->Cell($w[3],6,$sqlf[3],'LR',0,'C',$fill);
				$this->Cell($w[4],6,$sqlf[4],'LR',0,'C',$fill);
				$this->Cell($w[5],6,$sqlf[5],'LR',0,'C',$fill);
				$this->Cell($w[6],6,$sqlf[6],'LR',0,'C',$fill);
				$this->Cell($w[7],6,$sqlf[7],'LR',0,'C',$fill);
				$this->Cell($w[8],6,$sqlf[8],'LR',0,'C',$fill);
				$this->Cell($w[9],6,$sqlf[9],'LR',0,'C',$fill);
				$this->Ln();
							
				$fill = !$fill;
				$i++;
			}
			//$this->Ln();
		    $this->Cell(array_sum($w),0,'','T');
	    	$this->AddPage();  
  
		}			

}
    


function DetailBookRpt($header, $data)
{    
			$w = array(60,60,7,7,7,30,7,7,7);
			// Color and font restoration
			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');

			foreach($data as $row)
			{    

			$this->Cell(15,15,'Department:',0,0,'L',false);
			$this->Cell(110,15,$row['name'],0,0,'L',false);
			
			$this->Ln(10);
			for($i=0;$i<count($header);$i++)
			   $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
			
				
					$this->Ln();
					
				$sql=mysql_query("SELECT c.coursename 'Course Name',
				                         b.author Author,b.edition Edition,b.selfid 'Book Self No',b.rowno 'Row No',
										 b.publisher Publisher,b.totalbook 'Total Book',
										 b.price Price,b.totalbook*b.price 'Total Cost' 
									from tbl_bookentry b
									INNER JOIN tbl_courses c
									on b.courseid=c.id
									INNER JOIN tbl_department d
									on c.departmentid=d.id
									where b.deptid='$row[id]'") or die(mysql_error());
		    $i=0;
			$fill = false;
			$max=40;							

		           while($sqlf=mysql_fetch_array($sql)){
				    //

						if($i==$max){
							for($i=0;$i<count($header);$i++)
								$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
						
							
								$this->Ln();
								
						  $i=0;
						  
						 }
						   
							$this->Cell($w[0],6,$sqlf[0],'LR',0,'L',$fill);
							$this->Cell($w[1],6,$sqlf[1],'LR',0,'L',$fill);
							$this->Cell($w[2],6,$sqlf[2],'LR',0,'L',$fill);
							$this->Cell($w[3],6,$sqlf[3],'LR',0,'L',$fill);
							$this->Cell($w[4],6,$sqlf[4],'LR',0,'L',$fill);
							$this->Cell($w[5],6,$sqlf[4],'LR',0,'L',$fill);
							$this->Cell($w[6],6,$sqlf[4],'LR',0,'L',$fill);
							$this->Cell($w[7],6,$sqlf[4],'LR',0,'L',$fill);
							$this->Cell($w[8],6,$sqlf[4],'LR',0,'L',$fill);
							//if use number formet
							//$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
							//$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
							$this->Ln();
							
							$fill = !$fill;
							
							
							
						$i++;
						
						
					}
						$this->Cell(array_sum($w),0,'','B');
						$this->AddPage();
						
	        }
			// Closing line
			
			//$this->Cell(array_sum($w),0,'1','T');
			
			//Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
   }


function DeptWiseBookReturn($header, $data)
{    
			$w = array(20,60,20,35,25,25);
			// Color and font restoration
			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');

			foreach($data as $row)
			{    

			$this->Cell(15,15,'Department:',0,0,'L',false);
			$this->Cell(110,15,$row['name'],0,0,'L',false);
			$this->Ln(10);
			for($i=0;$i<count($header);$i++)
			   $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
			
				
					$this->Ln();
					
				$sql=mysql_query("select c.coursecode 'Course Code',c.coursename,s.stdid,s.stdname,b.issuedate 'Issue Date',b.returndate 'Return Date'
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_stdinfo s
								on s.stdid=b.stdid
								where b.returndate<=curdate()
								and b.irstatus<>'RETURN'
								and b.deptid='$row[id]'
								order by c.coursename") or die(mysql_error());
		    $i=0;
			$fill = false;
			$max=30;							

		           while($sqlf=mysql_fetch_array($sql)){
				    //

						if($i==$max){
						$this->AddPage();
							for($i=0;$i<count($header);$i++)
								$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
						
							
								$this->Ln();
								
						  $i=0;
						  
						 }
						   
							$this->Cell($w[0],6,$sqlf[0],'LR',0,'L',$fill);
							$this->Cell($w[1],6,$sqlf[1],'LR',0,'L',$fill);
							$this->Cell($w[2],6,$sqlf[2],'LR',0,'L',$fill);
							$this->Cell($w[3],6,$sqlf[3],'LR',0,'L',$fill);
							$this->Cell($w[4],6,$sqlf[4],'LR',0,'L',$fill);
							$this->Cell($w[5],6,$sqlf[5],'LR',0,'L',$fill);							
							//if use number formet
							//$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
							//$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
							$this->Ln();
							
							$fill = !$fill;
							
							
							
						$i++;
						
					}
						// Closing line
						$this->Cell(array_sum($w),0,'','B');
						$this->AddPage();
						
	        }
			
			
			//$this->Cell(array_sum($w),0,'','T');
   }


function DateWiseDeptBookReturn($header, $data,$fdate,$tdate)
{    
			$w = array(20,60,20,35,25,25);
			// Color and font restoration
			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');

			foreach($data as $row)
			{    

			$this->Cell(15,15,'Department:',0,0,'L',false);
			$this->Cell(110,15,$row['name'],0,0,'L',false);
			
			$this->Ln(10);
			for($i=0;$i<count($header);$i++)
			   $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
			
				
					$this->Ln();
					
				$sql=mysql_query("select c.coursecode 'Course Code',c.coursename,s.stdid,s.stdname,b.issuedate 'Issue Date',b.returndate 'Return Date'
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_stdinfo s
								on s.stdid=b.stdid
								where b.returndate between '$fdate' and '$tdate'
								and b.irstatus<>'RETURN'
								order by c.coursename") or die(mysql_error());
		    $i=0;
			$fill = false;
			$max=30;							

		           while($sqlf=mysql_fetch_array($sql)){
				    //

						if($i==$max){
						$this->AddPage();
							for($i=0;$i<count($header);$i++)
								$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
						
							
								$this->Ln();
								
						  $i=0;
						  
						 }
						   
							$this->Cell($w[0],6,$sqlf[0],'LR',0,'L',$fill);
							$this->Cell($w[1],6,$sqlf[1],'LR',0,'L',$fill);
							$this->Cell($w[2],6,$sqlf[2],'LR',0,'L',$fill);
							$this->Cell($w[3],6,$sqlf[3],'LR',0,'L',$fill);
							$this->Cell($w[4],6,$sqlf[4],'LR',0,'L',$fill);
							$this->Cell($w[5],6,$sqlf[5],'LR',0,'L',$fill);							
							//if use number formet
							//$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
							//$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
							$this->Ln();
							
							$fill = !$fill;
							
							
							
						$i++;
						
					}
						
						// Closing line
						
						$this->Cell(array_sum($w),0,'','B');$this->AddPage();
						
						
	        }
			// Closing line
			
			//$this->Cell(array_sum($w),0,'','T');
			//$this->AddPage();
   }



}
?>