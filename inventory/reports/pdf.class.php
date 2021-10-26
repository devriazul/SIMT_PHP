<?php 
include("../../config.php"); 
$myDb->connectDefaultServer();
require('../FPDF/fpdf.php');
class PDF extends FPDF
{

function Header()
{
    //Logo
    $this->Image('../logo.png',10,8,33);
    //Arial bold 15
    $this->SetFont('Arial','B',12);
    //Move to the right
    $this->Cell(80);
    //Title
    $this->Cell(30,10,'SAIC INSTITUTE OF MANGEMENT & TECHNOLOGY',0,0,'C');  //in last 3 parameters 1st parameter set 0 means no border 1 means border
    $this->Ln(5);
	$this->Cell(190,30,'House#1,Road#2,Block# B,Section#6,Mirpur,Dhaka',0,0,'C');  //in last 3 parameters 1st parameter set 0 means no border 1 means border
	$this->Ln(12);
	$this->Cell(122, 30, 'Purchase & Inventory Information',0,'C',0);
	
	$this->SetFont('Arial','B',9);
    $this->Cell(50, 30, "Date: ".date('F j, Y'), 0,0, 'R');


    //Line break
    $this->Ln(25);
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
    $this->Cell(-50,10,'SAIC INSTITUTE OF MANGEMENT & TECHNOLOGY',0,0,'C');  //in last 3 parameters 1st parameter set 0 means no border 1 means border
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
function FancyTable($header, $data)
{    
			// Color and font restoration
			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');
			$w = array(80,20,20,15,15,15,20);

			foreach($data as $row)
			{  			
  

			$this->Cell(25,15,'Employee ID:',0,0,'L',false);
			$this->Cell(20,15,$row['empid'],0,0,'L',false);
			$this->Cell(30,15,'Employee Name:',0,0,'L',false);
			$this->Cell(110,15,$row['name'],0,0,'L',false);

			$this->Ln(5);						
			$this->Cell(30,15,'Requisition Date:',0,0,'L',false);
			$this->Cell(30,15,$row['reqdate'],0,0,'L',false);

			$this->Cell(30,15,'Expected Date:',0,0,'L',false);
			$this->Cell(30,15,$row['expdate'],0,0,'L',false);

			$this->Ln(5);						
			$this->Cell(30,15,'Approve Date:',0,0,'L',false);
			$this->Cell(30,15,$row['appdate'],0,0,'L',false);

			$this->Cell(30,15,'Purchase Date:',0,0,'L',false);
			$this->Cell(30,15,$row['pdate'],0,0,'L',false);

			$this->Ln(5);
			$this->Cell(30,15,'Requisition ID:',0,0,'L',false);
			$this->Cell(30,15,$row['reqid'],0,0,'L',false);
			$this->Ln(5);
			$this->Cell(30,15,'Department:',0,0,'L',false);
			$this->Cell(30,15,$row['mstoreid'],0,0,'L',false);
			switch($row["pstatus"]){
								  case "R":
									$this->Cell(18,15,'Status: ',0,0,'L',false);
									$this->Cell(20,15,'Requisition',0,0,'L',false);
									break;
								  case "A":
									$this->Cell(10,15,'Status:',0,0,'L',false);
									$this->Cell(20,15,'Approved',0,0,'L',false);
									break;
								  case "P":
									$this->Cell(10,15,'Status:',0,0,'L',false);
									$this->Cell(20,15,'Purchased',0,0,'L',false);
									break;
								  default:	
									$this->Cell(15,15,'Status:',0,0,'L',false);
									$this->Cell(20,15,'Requisition',0,0,'L',false);
			}			
			$this->Ln(10);
			for($i=0;$i<count($header);$i++)
			   $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
			
				
				$this->Ln();
				if($row['pstatus']=='P'){
					$sql=mysql_query("SELECT p.pname 'Product Name',b.estprice,b.rqty 'Requisition Qty',b.aqty 'ApproveQty',
							  b.pqty 'PurchaseQty',b.pprice,round(b.pqty*b.pprice,2) 'Total Value',b.pstatus 
							  FROM tbl_buyproduct b
											 INNER JOIN tbl_product p
											 ON p.id=b.pid
											 WHERE b.reqid='$row[reqid]'");
				}else{
					$sql=mysql_query("SELECT p.pname 'Product Name',b.estprice,b.rqty 'Requisition Qty',b.aqty 'ApproveQty',
							  b.pqty 'PurchaseQty','' pprice,'' TotalValue FROM tbl_buyproduct b
											 INNER JOIN tbl_product p
											 ON p.id=b.pid
											 WHERE b.reqid='$row[reqid]'");
				}									
									
									
		    $i=0;
			$fill = false;
			$max=28;							
			$sum=0;
			$booksum=0;

		           while($sqlf=mysql_fetch_array($sql)){
						if($i==$max){
						    $this->AddPage();
							$this->Ln();
							for($i=0;$i<count($header);$i++)
								$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
						
							
								$this->Ln();
								
						  $i=0;
						  
						 }
						   if($row['pstatus']=="P"){ 
								$this->Cell($w[0],6,$sqlf[0],'LR',0,'L',$fill);
								$this->Cell($w[1],6,$sqlf[1],'LR',0,'L',$fill);
								$this->Cell($w[2],6,$sqlf[2],'LR',0,'L',$fill);
								$this->Cell($w[3],6,$sqlf[3],'LR',0,'L',$fill);
								$this->Cell($w[4],6,$sqlf[4],'LR',0,'L',$fill);
								$this->Cell($w[5],6,$sqlf[5],'LR',0,'L',$fill);
								$this->Cell($w[6],6,$sqlf[5],'LR',0,'L',$fill);
								$this->Ln();
						   }else{ 
								$this->Cell($w[0],6,$sqlf[0],'LR',0,'L',$fill);
								$this->Cell($w[1],6,$sqlf[1],'LR',0,'L',$fill);
								$this->Cell($w[2],6,$sqlf[2],'LR',0,'L',$fill);
								$this->Cell($w[3],6,$sqlf[3],'LR',0,'L',$fill);
								$this->Cell($w[4],6,$sqlf[4],'LR',0,'L',$fill);
								$this->Cell($w[5],6,$sqlf[5],'LR',0,'L',$fill);
								$this->Cell($w[6],6,$sqlf[5],'LR',0,'L',$fill);
								$this->Ln();
						   
						   }
							
							//$fill = !$fill;
						 if($row['pstatus']=="P"){		
							$sum=$sum+$sqlf['Total Value'];	
							$this->Cell(array_sum($w),0,'','B');
							$this->Ln();
						  }else{
						  
							$this->Cell(array_sum($w),0,'','B');
							$this->Ln();
						  }	

						$i++;
						
						
					}
						 if($row['pstatus']=="P"){		
							$this->Ln(2);
							$shsum="Grand Total: ".$sum;
								$this->Cell(array_sum($w),6,$shsum,'',0,'R','');
								$this->Ln(2);
								$this->Cell(array_sum($w),6,$this->convert_number($sum),'','L','');
								$this->Ln(2);
						}		
						
	        }
			
			
	$this->Ln(25);
	$this->Cell(2);
    $this->Cell(50,1,'---------------------------',0,0,'C');  
	$this->Ln(2);    
	$this->Cell(1);
    //Title

    $this->Cell(50,10,'Prepared By',0,0,'C');  //in last 3 parameters 1st parameter set 0 means no border 1 means border
	
	$this->Cell(5);
    $this->Cell(55,1,'---------------------------',0,0,'C');  
	$this->Ln(2);    
	$this->Cell(55);
    //Title

    $this->Cell(60,10,'Verified By Dept.Head',0,0,'C');  //in last 3 parameters 1st parameter set 0 means no border 1 means border
	
	
	$this->Cell(1);
    $this->Cell(55,1,'---------------------------',0,0,'C');  
	$this->Ln(2);    
	$this->Cell(110);
    //Title

    $this->Cell(60,10,'Approved By',0,0,'C');  //in last 3 parameters 1st parameter set 0 means no border 1 means border
	
	
   }
    
function EmployeeIssuePrd($header, $data,$issuedate)
{    
			// Color and font restoration
			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');
			$w = array(15,60,15);

			foreach($data as $row)
			{    
				$this->Cell(18,15,'Issue Date:',0,0,'L',false);
				$this->Cell(20,15,$issuedate,0,0,'L',false);
				$this->Ln(5);
				$this->Cell(18,15,'Employee ID:',0,0,'L',false);
				$this->Cell(20,15,$row['id'],0,0,'L',false);
				$this->Ln(5);
				$this->Cell(18,15,'Employee Name:',0,0,'L',false);
				$this->Cell(20,15,$row['name'],0,0,'L',false);
				
			$this->Ln(10);
			for($i=0;$i<count($header);$i++)
			   $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
			
				
				$this->Ln();
			$empstring=substr($row['id'],0,3);
			$fltstring=substr($row['id'],0,1);
  
		  $chkstring=!empty($empstring)?$empstring:$fltstring;
		  if($chkstring=='EMP'){
			  $issql="select p.id 'Product ID',p.pname 'Product Name',sum(i.iqty) 'Issue Qty'
					from tbl_product p ";
		  }else{
			  $issql="select p.id 'Product ID',p.pname 'Product Name',sum(i.iqty) 'Issue Qty'
					from tbl_product p ";
		  
		  }			
		  
		  $issql.="inner join tbl_issue i on p.id=i.pid ";
		  if($chkstring=='EMP'){
			   $instf="inner join tbl_staffinfo e	on e.sid=i.empid ";
			   $issql.=$instf;		
		  }else{		
			   $inflt="inner join tbl_faculty f on f.facultyid=i.empid ";
			   $issql.=$inflt;
		  }		
		  $cond="where i.empid='$row[id]' and i.issue_date='$issuedate' group by p.pname ";
		  $issql.=$cond;
		  $issql=mysql_query($issql);										
									
		    $i=0;
			$fill = false;
			$max=28;							
			$sum=0;
			$booksum=0;

		           while($sqlf=mysql_fetch_array($issql)){
						if($i==$max){
						    $this->AddPage();
							$this->Ln();
							for($i=0;$i<count($header);$i++)
								$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
						
							
								$this->Ln();
								
						  $i=0;
						  
						 }
								$this->Cell($w[0],6,$sqlf[0],'LR',0,'L',$fill);
								$this->Cell($w[1],6,$sqlf[1],'LR',0,'L',$fill);
								$this->Cell($w[2],6,$sqlf[2],'LR',0,'L',$fill);
								$this->Ln();
								$this->Cell(array_sum($w),0,'','B');
								$this->Ln();
							//$fill = !$fill;

						$i++;
						
						
					}
						
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
					
				$sql=mysql_query("select c.coursecode 'Course Code',c.coursename,
								s.stdid,s.stdname,b.issuedate 'Issue Date',
								b.returndate 'Return Date'
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_stdinfo s
								on s.stdid=b.stdid
								where b.irstatus<>'RETURN'
								and b.deptid='$row[id]'
								
								UNION ALL
								select c.coursecode 'Course Code',c.coursename,
								s.facultyid stdid,s.name stdname,b.issuedate 'Issue Date',
								b.returndate 'Return Date'
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_faculty s
								on s.facultyid=b.stdid
								where b.irstatus<>'RETURN'
								and b.deptid='$row[id]'
								") or die(mysql_error());
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
					
				$sql=mysql_query("select c.coursecode 'Course Code',c.coursename,
								s.stdid,s.stdname,b.issuedate 'Issue Date',b.returndate 'Return Date'
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_stdinfo s
								on s.stdid=b.stdid
								where b.returndate between '$fdate' and '$tdate'
								and b.irstatus<>'RETURN'
								and b.deptid='$row[id]'
								
								UNION ALL
								select c.coursecode 'Course Code',c.coursename,
								s.facultyid stdid,s.name stdname,b.issuedate 'Issue Date',b.returndate 'Return Date'
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_faculty s
								on s.facultyid=b.stdid
								where b.returndate between '$fdate' and '$tdate'
								and b.irstatus<>'RETURN'
								and b.deptid='$row[id]'
								") or die(mysql_error());
		    $i=0;
			$fill = false;
			$max=20;							

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
			// Closing line
			
			//$this->Cell(array_sum($w),0,'','T');
			//$this->AddPage();
   }

function StdFacltDateWiseDeptBookReturn($header, $data,$fdate,$tdate)
{    
			$w = array(20,60,25,25);
			// Color and font restoration
			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');
			foreach($data as $row)
			{    

			$this->Cell(20,20,'StudentID/FacultyID:',0,0,'L',false);
			$this->Cell(40,20,$row['stdid'],0,0,'L',false);
			$this->Ln(5);
			$this->Cell(7,15,'Name:',0,0,'L',false);
			$this->Cell(20,15,$row['stdname'],0,0,'L',false);
			
			$this->Ln(10);
			for($i=0;$i<count($header);$i++)
			   $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
			
				
					$this->Ln();
					
				$sql=mysql_query("select c.coursecode 'Course Code',c.coursename,
								b.issuedate 'Issue Date',b.returndate 'Return Date'
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_stdinfo s
								on s.stdid=b.stdid
								where b.returndate between '$fdate' and '$tdate'
								and b.irstatus<>'RETURN'
								and b.stdid='$row[stdid]'
								
								UNION ALL
								select c.coursecode 'Course Code',c.coursename,
								b.issuedate 'Issue Date',b.returndate 'Return Date'
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_faculty s
								on s.facultyid=b.stdid
								where b.returndate between '$fdate' and '$tdate'
								and b.irstatus<>'RETURN'
								and b.stdid='$row[stdid]'
								") or die(mysql_error());
		    $i=0;
			$fill = false;
			$max=20;							

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
							//$this->Cell($w[4],6,$sqlf[4],'LR',0,'L',$fill);
							//$this->Cell($w[5],6,$sqlf[5],'LR',0,'L',$fill);							
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
			// Closing line
			
			//$this->Cell(array_sum($w),0,'','T');
			//$this->AddPage();
   }
   
   function StdFacltWiseDeptBookReturn($header, $data){    
			$w = array(20,60,25,25);
			// Color and font restoration
			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');
			foreach($data as $row)
			{    

			$this->Cell(20,20,'StudentID/FacultyID:',0,0,'L',false);
			$this->Cell(40,20,$row['stdid'],0,0,'L',false);
			$this->Ln(5);
			$this->Cell(7,15,'Name:',0,0,'L',false);
			$this->Cell(20,15,$row['stdname'],0,0,'L',false);
			
			$this->Ln(10);
			for($i=0;$i<count($header);$i++)
			   $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
			
				
					$this->Ln();
					
				$sql=mysql_query("select c.coursecode 'Course Code',c.coursename,
								b.issuedate 'Issue Date',b.returndate 'Return Date'
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_stdinfo s
								on s.stdid=b.stdid
								where b.irstatus<>'RETURN'
								and b.stdid='$row[stdid]'
								
								UNION ALL
								select c.coursecode 'Course Code',c.coursename,
								b.issuedate 'Issue Date',b.returndate 'Return Date'
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_faculty s
								on s.facultyid=b.stdid
								where b.irstatus<>'RETURN'
								and b.stdid='$row[stdid]'
								") or die(mysql_error());
		    $i=0;
			$fill = false;
			$max=20;							

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
							//$this->Cell($w[4],6,$sqlf[4],'LR',0,'L',$fill);
							//$this->Cell($w[5],6,$sqlf[5],'LR',0,'L',$fill);							
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
			// Closing line
			
			//$this->Cell(array_sum($w),0,'','T');
			//$this->AddPage();
 }
function CourseIDWiseBookReturn($header, $data)
{    
			$w = array(30,60,20,35,25);
			// Color and font restoration
			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');

			foreach($data as $row)
			{    

			$this->Cell(15,15,'Course Code:',0,0,'L',false);
			$this->Cell(110,15,$row['coursecode'],0,0,'L',false);
			$this->Ln(5);
			$this->Cell(15,15,'Course Name:',0,0,'L',false);
			$this->Cell(110,15,$row['coursename'],0,0,'L',false);
			$this->Ln(5);
			$this->Cell(15,15,'Course ID:',0,0,'L',false);
			$this->Cell(110,15,$row['id'],0,0,'L',false);
			$this->Ln(10);
			for($i=0;$i<count($header);$i++)
			   $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
			
				
					$this->Ln();
					
				$sql=mysql_query("select d.name,s.stdid,s.stdname,b.issuedate 'Issue Date',
								b.returndate 'Return Date'
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_stdinfo s
								on s.stdid=b.stdid
								where b.irstatus<>'RETURN'
								and b.courseid='$row[id]'
								
								UNION ALL
								select d.name,s.facultyid stdid,s.name stdname,b.issuedate 'Issue Date',
								b.returndate 'Return Date'
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_faculty s
								on s.facultyid=b.stdid
								where b.irstatus<>'RETURN'
								and b.courseid='$row[id]'
								") or die(mysql_error());
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
							$this->Cell($w[3],6,$sqlf[3],'LR',0,'C',$fill);
							$this->Cell($w[4],6,$sqlf[4],'LR',0,'C',$fill);
							//$this->Cell($w[5],6,$sqlf[5],'LR',0,'L',$fill);							
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
			
			
   }
function PrdTypeWiseRegisterReport($header, $data,$dpt)
{    
				$this->SetFillColor(224,235,255);
				$this->SetTextColor(0);
				$this->SetFont('');
					// Header
						$this->Cell(14,15,'Product Type: ',0,0,'L',false);
						$this->Cell(105,15,$dpt,0,0,'L',false);
						$this->Ln(15);

					$w = array(11,90,11,11,11,11,11,11,11,11);
					for($i=0;$i<count($header);$i++)
						$this->Cell($w[$i],7,$header[$i],1,0,'C',true);			

					$fill = false;
					$y=0;
					$max=30;	

				foreach($data as $row)
				{    	
				if($dpt=="Library Book"){				
							$sql=mysql_query("select bookid 'Book ID',pname 'Product Name',
                                                                (select ifnull(sum(rqty),0) from tbl_buyproduct where pid='$row[id]') 'Requisition Qty',
                                                                (select ifnull(sum(aqty),0) from tbl_buyproduct where pid='$row[id]') 'Approve Qty',
																(select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$row[id]') 'Purchase Qty',
																(select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$row[id]' and storeid<>'') 'Stock Qty',
																(select ifnull(sum(totalbook),0) from tbl_bookentry where bookid=(select bookid from tbl_product where id='$row[id]')) 'Library OB',
																((select ifnull(sum(totalbook),0) from tbl_bookentry where bookid=(select bookid from tbl_product where id='$row[id]'))+
																(select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$row[id]' and storeid<>'')) 'Library Stock'
																,(select ifnull(count(courseid),0) from tbl_bookissue where bookid=(select bookid from tbl_product where id='$row[id]')
																  AND irstatus<>'RETURN') 'Issue Qty',																
																  (((select ifnull(sum(totalbook),0) from tbl_bookentry where bookid=(select bookid from tbl_product where id='$row[id]'))+
																     (select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$row[id]' and storeid<>''))
																  -((select ifnull(count(courseid),0) from tbl_bookissue where bookid=(select bookid from tbl_product where id='$row[id]') AND irstatus<>'RETURN'))) 'Remaining Qty'
												from tbl_product 
												where id='$row[id]'
												and prtype='$row[prtype]'") or die(mysql_error());
					}else{
							$sql=mysql_query("select id 'Product ID',pname 'Product Name',
                                                                (select ifnull(sum(rqty),0) from tbl_buyproduct where pid='$row[id]') 'Requisition Qty',
                                                                (select ifnull(sum(aqty),0) from tbl_buyproduct where pid='$row[id]') 'Approve Qty',
																(select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$row[id]') 'Purchase Qty',
																(select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$row[id]' and storeid<>'') 'Stock Qty',ifnull('',0),ifnull('',0)
																,(select ifnull(sum(iqty),0) from tbl_issue where pid='$row[id]') 'Issue Qty',
																((select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$row[id]' and storeid<>'')-(select ifnull(sum(iqty),0) from tbl_issue where pid='$row[id]')) 'Remaining Qty'
												from tbl_product 
												where id='$row[id]'
												") or die(mysql_error());
					
					}												
					$this->Ln();
					if($y==$max){
						$this->AddPage();$this->Ln(5);
						for($i=0;$i<count($header);$i++)
						$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
						$this->Ln();
						$y=0;
					}
				   while($sqlf=mysql_fetch_array($sql)){

							$this->Cell($w[0],7,$sqlf[0],'LR',0,'L',$fill);
							$this->Cell($w[1],7,$sqlf[1],'LR',0,'L',$fill);
							$this->Cell($w[2],7,$sqlf[2],'LR',0,'C',$fill);
							$this->Cell($w[3],7,$sqlf[3],'LR',0,'C',$fill);
							$this->Cell($w[4],7,$sqlf[4],'LR',0,'C',$fill);
							$this->Cell($w[5],7,$sqlf[5],'LR',0,'C',$fill);				
							$this->Cell($w[6],7,$sqlf[6],'LR',0,'C',$fill);							
							$this->Cell($w[7],7,$sqlf[7],'LR',0,'C',$fill);							
							$this->Cell($w[8],7,$sqlf[8],'LR',0,'C',$fill);			
							$this->Cell($w[9],7,$sqlf[9],'LR',0,'C',$fill);							
							$this->Ln();
						//$fill = !$fill;
					

					}
					// Closing line
					$this->Cell(array_sum($w),0,'','B');
					$y++;

					
			
			
			}					

			
   }   
   
function ProductRegisterReport($header, $data)
{    
				$this->SetFillColor(224,235,255);
				$this->SetTextColor(0);
				$this->SetFont('');
					$w = array(11,85,20,9,9,9,11,11,11,11,11);
					for($i=0;$i<count($header);$i++)
						$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
					$fill = false;
					$y=0;
					$max=30;	

				foreach($data as $row)
				{    		
					$stn=$this->select("SELECT*FROM tbl_store WHERE storeid='$row[prtype]'");
					$stnf=$this->get_row($stn,'MYSQL_ASSOC');
					if($stnf['storename']=="Library Book"){
							$sql=mysql_query("select bookid 'Book ID',pname 'Product Name',(SELECT storename FROM tbl_store WHERE storeid='$row[prtype]') storename,
                                                                (select ifnull(sum(rqty),0) from tbl_buyproduct where pid='$row[id]') 'Requisition Qty',
                                                                (select ifnull(sum(aqty),0) from tbl_buyproduct where pid='$row[id]') 'Approve Qty',
																(select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$row[id]') 'Purchase Qty',
																(select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$row[id]' and storeid<>'') 'Inventory Stock Qty',
																(select ifnull(sum(totalbook),0) from tbl_bookentry where bookid=(select bookid from tbl_product where id='$row[id]')) 'Library OB',
																((select ifnull(sum(totalbook),0) from tbl_bookentry where bookid=(select bookid from tbl_product where id='$row[id]'))+
																(select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$row[id]' and storeid<>'')) 'Library Stock'
																,(select ifnull(count(courseid),0) from tbl_bookissue where bookid=(select bookid from tbl_product where id='$row[id]')
																  AND irstatus<>'RETURN') 'Issue Qty',																
																  (((select ifnull(sum(totalbook),0) from tbl_bookentry where bookid=(select bookid from tbl_product where id='$row[id]'))+
																     (select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$row[id]' and storeid<>''))
																  -((select ifnull(count(courseid),0) from tbl_bookissue where bookid=(select bookid from tbl_product where id='$row[id]') AND irstatus<>'RETURN'))) 'Remaining Qty'
												from tbl_product 
												where id='$row[id]'
												and prtype='$row[prtype]'
												order by prtype") or die(mysql_error());		
					}else{
							$sql=mysql_query("select id 'Product ID',pname 'Product Name',(SELECT storename FROM tbl_store WHERE storeid='$row[prtype]') storename,
                                                                (select ifnull(sum(rqty),0) from tbl_buyproduct where pid='$row[id]') 'Requisition Qty',
                                                                (select ifnull(sum(aqty),0) from tbl_buyproduct where pid='$row[id]') 'Approve Qty',
																(select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$row[id]') 'Purchase Qty',
																(select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$row[id]' and storeid<>'') 'Stock Qty',ifnull('',0),ifnull('',0)
																,(select ifnull(sum(iqty),0) from tbl_issue where pid='$row[id]') 'Issue Qty',
																((select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$row[id]' and storeid<>'')-(select ifnull(sum(iqty),0) from tbl_issue where pid='$row[id]')) 'Remaining Qty'
												from tbl_product 
												where id='$row[id]'
												and prtype='$row[prtype]'
												order by prtype
												") or die(mysql_error());
					
					
					}										
					$this->Ln();
					if($y==$max){
						$this->AddPage();$this->Ln(5);
						for($i=0;$i<count($header);$i++)
						$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
						$this->Ln();
						$y=0;
					}
				   while($sqlf=mysql_fetch_array($sql)){

							$this->Cell($w[0],7,$sqlf[0],'LR',0,'L',$fill);
							$this->Cell($w[1],7,$sqlf[1],'LR',0,'L',$fill);
							$this->Cell($w[2],7,$sqlf[2],'LR',0,'C',$fill);
							$this->Cell($w[3],7,$sqlf[3],'LR',0,'C',$fill);
							$this->Cell($w[4],7,$sqlf[4],'LR',0,'C',$fill);
							$this->Cell($w[5],7,$sqlf[5],'LR',0,'C',$fill);				
							$this->Cell($w[6],7,$sqlf[6],'LR',0,'C',$fill);							
							$this->Cell($w[7],7,$sqlf[7],'LR',0,'C',$fill);							
							$this->Cell($w[8],7,$sqlf[8],'LR',0,'C',$fill);			
							$this->Cell($w[9],7,$sqlf[9],'LR',0,'C',$fill);		
							$this->Cell($w[10],7,$sqlf[10],'LR',0,'C',$fill);		
						$this->Ln();
						//$fill = !$fill;
					

					}
					// Closing line
					$this->Cell(array_sum($w),0,'','B');
					$y++;

					
			
			
			}					

			
   } 
  }
?>