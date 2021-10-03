<?php 
require_once("dbClass.php");
class ProductFilter extends dbClass{
  public $q;
  public $rs;
  public $recid;
  public $msg;
  public $tblContainer;
  public $frmValue;
  public $status;
  public $price;
  public $empstring;
  public $fltstring;
  public $chkstring;
  public $issql;
  public $instf;
  public $inflt;
  public $cond;
  public $appdate;
  public function __construct(){
    parent::connect("localhost","root","dtbd13adm1n","simtdb",true);
  
  }
  
  public function prdresult($recid){
    $this->recid=$recid;
	$data=array();
	
	$chkstaff=parent::select("SELECT empid from tbl_buyproduct where id='".$this->recid."'");
	$stf=parent::get_row($chkstaff,'MYSQL_ASSOC');
		$this->empstring=substr($stf["empid"],0,3);
		$this->fltstring=substr($stf["empid"],0,1);
	
		if($this->empstring=='EMP'){
				$this->q=parent::select("SELECT bp.id 'id',st.name 'Employee Name',bp.empid,bp.pid,bp.rqty,bp.reqdate,bp.pstatus,
								 p.pname 'Product Name' ,bp.aqty,bp.pqty,bp.reqid,p.prtype
								 FROM tbl_buyproduct bp
								 INNER JOIN tbl_staffinfo st
								 ON bp.empid=st.sid 
								 INNER JOIN tbl_product p
								 on p.id=bp.pid
								 WHERE bp.id='".$this->recid."'");
		}else{
				$this->q=parent::select("SELECT bp.id 'id',st.name 'Employee Name',bp.empid,bp.pid,bp.rqty,bp.reqdate,bp.pstatus,
								 p.pname 'Product Name' ,bp.aqty,bp.pqty,bp.reqid,p.prtype
								 FROM tbl_buyproduct bp
								 INNER JOIN tbl_faculty st
								 ON bp.empid=st.facultyid 
								 INNER JOIN tbl_product p
								 on p.id=bp.pid
								 WHERE bp.id='".$this->recid."'");
		
		
		}  
						 
	$this->rs=parent::get_row($this->q,'MYSQL_ASSOC');
    return $this->rs;
  }
  
  public function showRequisitionProduct($reqid){
    $this->recid=$reqid;
	$data=array();
	
	$chkstaff=parent::select("SELECT empid from tbl_buyproduct where reqid='".$this->recid."'");
	$stf=parent::get_row($chkstaff,'MYSQL_ASSOC');
		$this->empstring=substr($stf["empid"],0,3);
		$this->fltstring=substr($stf["empid"],0,1);
	
	if($this->empstring=='EMP'){
	
		$this->q=parent::select("SELECT bp.id 'id',st.name 'Employee Name',bp.empid,bp.pid,bp.rqty,bp.reqdate,bp.pstatus,
	                         p.pname 'Product Name' 
	                         FROM tbl_buyproduct bp
							 INNER JOIN tbl_staffinfo st
							 ON bp.empid=st.sid 
							 INNER JOIN tbl_product p
							 on p.id=bp.pid
							 WHERE bp.reqid='".$this->recid."'");
	}else{
		$this->q=parent::select("SELECT bp.id 'id',st.name 'Employee Name',bp.empid,bp.pid,bp.rqty,bp.reqdate,bp.pstatus,
	                         p.pname 'Product Name' 
	                         FROM tbl_buyproduct bp
							 INNER JOIN tbl_faculty st
							 ON bp.empid=st.facultyid 
							 INNER JOIN tbl_product p
							 on p.id=bp.pid
							 WHERE bp.reqid='".$this->recid."'");
	
	
	
	}						 
	$this->rs=parent::get_row($this->q,'MYSQL_ASSOC');
	$this->status=$this->rs["pstatus"];
    return $this->rs;  
  }  
  public function deletePrd($id){
    $this->q=parent::select("SELECT*FROM tbl_buyproduct WHERE id='$id'");
	$this->rs=parent::get_row($this->q,'MYSQL_ASSOC');
	
	if(($this->rs["aqty"]==0)&&($this->rs["pqty"]==0)){
	  parent::update_sql("DELETE FROM tbl_buyproduct WHERE id='$id'");
	  $this->msg="Record deleted successfully";
	  return $this->msg;
	
	}else{
	  $this->msg="Integrity constraint error,this have one or more child record you can not delete the record";
	  return $this->msg;
	} 
  }	
  
  
  public function printRequisition($reqid){
  
	$chkstaff=parent::select("SELECT empid from tbl_buyproduct where reqid='".$reqid."'");
	$stf=parent::get_row($chkstaff,'MYSQL_ASSOC');
		$this->empstring=substr($stf["empid"],0,3);
		$this->fltstring=substr($stf["empid"],0,1);
	
	if($this->empstring=='EMP'){
  
		$this->q=parent::select("SELECT b.*,s.name FROM tbl_buyproduct b
	                         INNER JOIN tbl_staffinfo s
							 ON s.sid=b.empid
							 WHERE b.reqid='$reqid'");
	}else{
		$this->q=parent::select("SELECT b.*,s.name FROM tbl_buyproduct b
	                         INNER JOIN tbl_faculty s
							 ON s.facultyid=b.empid
							 WHERE b.reqid='$reqid'");
	
	}						 
	$this->rs=parent::get_row($this->q,'MYSQL_ASSOC');
	echo "<table border='0' id='prttbl'>
							  <tr>
								<td>Employee ID:</td>";
								
								echo "<td>".$this->rs['empid']."</td>";
							    echo "</tr>";
								echo "<tr>";
								echo "<td>Employee Name</td>";
								
								echo "<td>".$this->rs['name']."</td>";
							    echo "</tr>";
							    echo "<tr>";
								echo "<td collspan='2'>Requisition Date</td>";
								echo "<td collspan='2'>".$this->rs['reqdate']."</td>";
								echo "<td collspan='2'>Expected Date</td>";
								echo "<td collspan='2'>".$this->rs['expdate']."</td>";
							    echo "</tr>";
								echo "<tr>";
								echo "<td collspan='2'>Approve Date</td>";
								echo "<td collspan='2'>".$this->rs['appdate']."</td>";
								echo "<td collspan='2'>Purchase Date</td>";
								echo "<td collspan='2'>".$this->rs['pdate']."</td>";
								echo "</tr>";
							    echo "<tr>";
								echo "<td>Requisition ID</td>";
								echo "<td>".$this->rs['reqid']."</td>";
							    echo "</tr>";
								switch($this->rs["pstatus"]){
								  case "R":
										echo "<tr>";
										echo "<td>Status</td>";
										echo "<td>Requisition</td>";
										echo "</tr>";
										break;
								  case "A":
										echo "<tr>";
										echo "<td>Status</td>";
										echo "<td>Approved</td>";
										echo "</tr>";
										break;
								  case "P":
										echo "<tr>";
										echo "<td>Status</td>";
										echo "<td>Purchased</td>";
										echo "</tr>";
										break;
								  default:	
										echo "<tr>";
										echo "<td>Status</td>";
										echo "<td>Requisition</td>";
										echo "</tr>";
										break;
								}
							    echo "<tr>";
							    echo "<td>&nbsp;</td>";
							    echo "<td>&nbsp;</td>";
							    echo "</tr>";
	
		
		if($this->rs['pstatus']=='P'){
			$this->q="SELECT p.pname 'Product Name',b.rqty 'Requisition Qty',b.aqty 'ApproveQty',
					  b.pqty 'PurchaseQty',b.pprice,round(b.pqty*b.pprice,2) 'Total Value',b.pstatus 
					  FROM tbl_buyproduct b
									 INNER JOIN tbl_product p
									 ON p.id=b.pid
									 WHERE b.reqid='$reqid'";
			
			$this->q=parent::dump_requisition($this->q,'','','n','n','','');
		
		}else{
			$this->q="SELECT p.pname 'Product Name',b.rqty 'Requisition Qty',b.aqty 'ApproveQty',
					  b.pqty 'PurchaseQty' FROM tbl_buyproduct b
									 INNER JOIN tbl_product p
									 ON p.id=b.pid
									 WHERE b.reqid='$reqid'";
			$this->q=parent::dump_requisition($this->q,'','','n','n','','');
					  
	    }
    
  
  
  }
  
  public function createApproveProduct($reqid,$id,$appdate,$frmValue){
    $this->frmValue=$frmValue;
	$this->appdate=$appdate;
    $this->q=parent::select("SELECT*FROM tbl_buyproduct WHERE id='$id'");
	$this->rs=parent::get_row($this->q,'MYSQL_ASSOC');
	if(($this->rs["rqty"]>0)&&($this->rs["rqty"]>=$this->frmValue)&&($this->frmValue>0)){
	  $cnt=count($this->frmValue);
	 // for($i=0;$i<$cnt;$i++){
	   parent::update_sql("UPDATE tbl_buyproduct SET aqty='".$this->frmValue."',pstatus='A',appdate='".$this->appdate."' WHERE id='$id' AND reqid='$reqid'");
	   $this->msg="<div style='width:auto;margin-left:10px;color:#009900'>Requisition Approve successfully</div>";
	   return $this->msg;
	 // }  
	}else{
	  $this->msg="<div style='width:auto;margin-left:10px;color:#FF0000'>Approve qty can not grater than requisition qty as well as approve qty can not be zero</div>";
	  return $this->msg;
	}   
  
  }
  
  public function createPurchaseProduct($reqid,$id,$frmValue,$price,$supid,$storeid,$pdate){
    $this->frmValue=$frmValue;
	$this->price=$price;
    $this->q=parent::select("SELECT*FROM tbl_buyproduct WHERE id='$id'");
	$this->rs=parent::get_row($this->q,'MYSQL_ASSOC');
	if(($this->rs["rqty"]>0)&&($this->rs["rqty"]>=$this->frmValue)&&($this->frmValue>0)){
	  $cnt=count($this->frmValue);
	 // for($i=0;$i<$cnt;$i++){
	   parent::update_sql("UPDATE tbl_buyproduct SET pqty='".$this->frmValue."'
	                             ,pprice='".$this->price."'
								 ,pstatus='P'
								 ,pdate='$pdate'
								 ,supid='$supid'
								 ,storeid='$storeid' WHERE id='$id' AND reqid='$reqid'");
	   $this->msg="<div style='width:auto;margin-left:10px;color:#009900'>Requisition Purchase successfully</div>";
	   return $this->msg;
	   
	   
	 // }  
	}else{
	  $this->msg="<div style='width:auto;margin-left:10px;color:#FF0000'>Purchase qty can not grater than requisition and approve qty as well as purchase qty can not be zero</div>";
	  return $this->msg;
	}   
  
  }
  
  public function issueEmployeePrd($empid,$issuedate){
		$this->q=parent::select("select sid 'id',name from tbl_staffinfo where tbl_staffinfo.sid='$empid' 
		                           union 
								   select facultyid 'id',name from tbl_faculty where tbl_faculty.facultyid='$empid'
								 ");
								   
		$this->rs=parent::get_row($this->q,'MYSQL_ASSOC');
		$this->empstring=substr($empid,0,3);
		$this->fltstring=substr($empid,0,1);
  
		  $this->chkstring=!empty($this->empstring)?$this->empstring:$this->fltstring;
		
		  if($this->chkstring=='EMP'){
			  $this->issql="select p.id 'Product ID',p.pname 'Product Name',sum(i.iqty) 'Issue Qty'
					from tbl_product p ";
		  }else{
			  $this->issql="select p.id 'Product ID',p.pname 'Product Name',sum(i.iqty) 'Issue Qty'
					from tbl_product p ";
		  
		  }			
				
		  $this->issql.="inner join tbl_issue i on p.id=i.pid ";
		  if($this->chkstring=='EMP'){
			   $this->instf="inner join tbl_staffinfo e	on e.sid=i.empid ";
			   $this->issql.=$this->instf;		
		  }else{		
			   $this->inflt="inner join tbl_faculty f on f.facultyid=i.empid ";
			   $this->issql.=$this->inflt;
		  }		
		  $this->cond="where i.empid='$empid' and i.issue_date='$issuedate' group by p.pname ";
		  $this->issql.=$this->cond;	
		  
		  echo '<table width="700" border="0">
				  <tr>
					<td width="105" height="30">Issue Date </td>
					<td width="7" height="30">:</td>
					<td height="30" colspan="4">'.$issuedate.'</td>
				  </tr>
				  <tr>
					<td height="30">Employee ID </td>
					<td height="30">:</td>
					<td width="98" height="30">'.$this->rs["id"].'</td>
					<td width="125" height="30">Employee Name </td>
					<td width="3" height="30">:</td>
					<td width="322" height="30">'.$this->rs["name"].'</td>
				  </tr>
				</table>
			  ';
		  
		  
		  
		  $sdep=parent::dump_query($this->issql,'','','','');
  
  
  }
  
  public function __destruct(){
    parent::__destruct(parent::connect("localhost","root","dtbd13adm1n","simtdb",true));
  }  

}

?>
