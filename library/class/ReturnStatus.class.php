<?php 
define('REFFER',$_SERVER['DOCUMENT_ROOT'].'/simt/library/');

require_once REFFER.'dbClass.php';
class ReturnStatus extends dbClass{
  public $conn;
  public $rs=array();
  public $qry;
  public $r;
  private $fieldName;
  private $fieldValue;
  
  public function __construct(){
      parent::__construct();

  }
  
  public function setFieldName($fname){
    $this->fieldName=$fname;
  
  }
  public function getFieldName(){
   return $this->fieldName;
  
  }
  public function setFieldValue($fvalue){
   $this->fieldValue=$fvalue;
  }
  public function getFieldValue(){
   return $this->fieldValue;
  }
  
  public function CurrentDateReturn($qry,$act=''){
    $this->r=array();
    $this->qry=parent::select($qry);
	echo "<table class='gridTbl' border='0' cellpadding='0' cellspacing='0'>";
	
   $i=0;
	while($this->r=parent::get_row($this->qry,'MYSQL_ASSOC')){
	  if($i==0){
		  echo "<tr>";
		  foreach($this->r as $key=>$value){
			 echo "<td class='gridTblHead'>".strtoupper($key)."</td>";	  
		  
		  }
		  if(!empty($act)){
		     echo "<td colspan=2 class='gridTblHead'>Action</td>";
		  }
		 "</tr>";
	  }
	  $i++;
	 echo "<tr>";
	 foreach($this->r as $key=>$value){
	    $this->setFieldName($key);
		$this->setFieldValue($value);
	    if($key!="stdname"){
		  $v=urlencode($this->getFieldValue());
		  //echo "<td class='record-headline'><a href=issRtnRpt.php?".$this->getFieldName()."=".urlencode($this->getFieldValue()).">".$value."</a></td>";
	    		  echo "<td class='gridTblValue'><a href='#' name='prt' id='".$this->getFieldName()."' class='".$v."' >".$value."</a></td>";

		}else{
		  echo "<td class='gridTblValue'>".$value."</td>";
		
		}
	  
	
	
	}
	if(!empty($act)){
		echo "<td class='gridTblValue'>Edit</td>";
		echo "<td class='gridTblValue'>Delete</td>";
	}
	echo "</tr>";
	}
	echo "</table>";
   							  
  }
  
  public function MainCategory($qry){
    $this->r=array();
    $this->qry=parent::select($qry);
	echo "<table class='class-tbl-style' border='0' cellpadding='0' cellspacing='0' style='width:500px'>";
	$i=0;
	while($this->r=parent::get_row($this->qry,'MYSQL_ASSOC')){
	  foreach($this->r as $key=>$value){
	    echo "<tr>";
		echo "<td width='30%' class='record-headline'>".ucwords($key)."</td>";
		echo "<td width='1%'>:</td>";
		echo "<td class='record-headline'>".ucwords(strtolower($value))."</td>";
		echo "</tr>";
	  }
	 $i++;
	}
	echo "</table>";
  
  
  
  }
  



}

