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
  public function __construct(){
    parent::connect("localhost","root","dtbd13adm1n","simtdb",true);
  
  }
  
  public function prdresult($recid){
    $this->recid=$recid;
	$data=array();
	$this->q=parent::select("SELECT bp.id 'id',st.name 'Employee Name',bp.empid,bp.pid,bp.rqty,bp.reqdate,bp.pstatus,
	                         p.pname 'Product Name' 
	                         FROM tbl_buyproduct bp
							 INNER JOIN tbl_staffinfo st
							 ON bp.empid=st.id 
							 INNER JOIN tbl_product p
							 on p.id=bp.pid
							 WHERE bp.id='".$this->recid."'");
	$this->rs=parent::get_row($this->q,'MYSQL_ASSOC');
    return $this->rs;  
  }
  
  public function showRequisitionProduct($reqid){
    $this->recid=$reqid;
	$data=array();
	$this->q=parent::select("SELECT bp.id 'id',st.name 'Employee Name',bp.empid,bp.pid,bp.rqty,bp.reqdate,bp.pstatus,
	                         p.pname 'Product Name' 
	                         FROM tbl_buyproduct bp
							 INNER JOIN tbl_staffinfo st
							 ON bp.empid=st.id 
							 INNER JOIN tbl_product p
							 on p.id=bp.pid
							 WHERE bp.reqid='".$this->recid."'");
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
    $this->q=parent::select("SELECT b.*,s.name FROM tbl_buyproduct b
	                         INNER JOIN tbl_staffinfo s
							 ON s.id=b.empid
							 WHERE b.reqid='$reqid'");
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
	
	$this->q="SELECT p.pname 'Product Name',b.rqty 'Requisition Qty',b.aqty 'ApproveQty',b.pqty 'PurchaseQty' FROM tbl_buyproduct b
	                         INNER JOIN tbl_product p
							 ON p.id=b.pid
							 WHERE b.reqid='$reqid'";
	$this->q=parent::dump_requisition($this->q,'','','n','n','','');
					  
	
    
  
  
  }
  
  public function createApproveProduct($reqid,$id,$frmValue){
    $this->frmValue=$frmValue;
    $this->q=parent::select("SELECT*FROM tbl_buyproduct WHERE id='$id'");
	$this->rs=parent::get_row($this->q,'MYSQL_ASSOC');
	if(($this->rs["rqty"]>0)&&($this->rs["rqty"]>=$this->frmValue)&&($this->frmValue>0)){
	  $cnt=count($this->frmValue);
	 // for($i=0;$i<$cnt;$i++){
	   parent::update_sql("UPDATE tbl_buyproduct SET aqty='".$this->frmValue."',pstatus='A',appdate='".date("Y-m-d")."' WHERE id='$id' AND reqid='$reqid'");
	   $this->msg="<div style='width:auto;margin-left:10px;color:#009900'>Requisition Approve successfully</div>";
	   return $this->msg;
	 // }  
	}else{
	  $this->msg="<div style='width:auto;margin-left:10px;color:#FF0000'>Approve qty can not grater than requisition qty as well as approve qty can not be zero</div>";
	  return $this->msg;
	}   
  
  }
  
  public function createPurchaseProduct($reqid,$id,$frmValue,$price){
    $this->frmValue=$frmValue;
	$this->price=$price;
    $this->q=parent::select("SELECT*FROM tbl_buyproduct WHERE id='$id'");
	$this->rs=parent::get_row($this->q,'MYSQL_ASSOC');
	if(($this->rs["rqty"]>0)&&($this->rs["rqty"]>=$this->frmValue)&&($this->frmValue>0)){
	  $cnt=count($this->frmValue);
	 // for($i=0;$i<$cnt;$i++){
	   parent::update_sql("UPDATE tbl_buyproduct SET pqty='".$this->frmValue."',pprice='".$this->price."',pstatus='P',pdate='".date("Y-m-d")."' WHERE id='$id' AND reqid='$reqid'");
	   $this->msg="<div style='width:auto;margin-left:10px;color:#009900'>Requisition Purchase successfully</div>";
	   return $this->msg;
	 // }  
	}else{
	  $this->msg="<div style='width:auto;margin-left:10px;color:#FF0000'>Purchase qty can not grater than requisition and approve qty as well as purchase qty can not be zero</div>";
	  return $this->msg;
	}   
  
  }  

}

?>
