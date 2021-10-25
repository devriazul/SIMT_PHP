<?php  
require_once('ReturnStatus.class.php'); 
class PagingPage extends ReturnStatus{
  public $page;
  public $cur_page;
  public $per_page;
  public $previous_btn;
  public $next_btn;
  public $first_btn;
  public $last_btn;
  public $start;
  public $msg;
  public $query_pag_num;
  public $result_pag_num;
  public function __construct(){
    parent::__construct();
  
  }
  public function setPageOrgan($organArray=array()){
    $this->organArray=$organArray;
  
  }
  public function getPageOrgan(){
    return $this->organArray;
  
  }
  public function setPage($page){
    $this->page=$page;
  }
  public function getPage(){
    return $this->page;
  }
  
  public function setCurpage($cur_page){
    $this->cur_page=$cur_page;
  }
  public function getCurpage(){
    return $this->cur_page;
  }
  public function setPerPage($noofrec){
    $this->per_page=$noofrec;
  }
  public function getPerPage(){
    return $this->per_page;
  }
  public function setPrvBtn($pbtn=true){
    $this->previous_btn=$pbtn;
  }
  public function getPrvBtn(){
    return $this->previous_btn;
  
  }
  
  public function setNxtBtn($nbtn=true){
    $this->next_btn=$nbtn;
  }
  public function getNxtBtn(){
    return $this->next_btn;
  
  }
  
  public function setFstBtn($fbtn=true){
    $this->first_btn=$fbtn;
  }
  public function getFstBtn(){
    return $this->first_btn;
  
  }

  public function setLstBtn($lbtn=true){
    $this->last_btn=$lbtn;
  }
  public function getLstBtn(){
    return $this->last_btn;
  
  }
  public function setStart($page,$per_page){
    $this->setPage($page);
	$this->setPerPage($per_page);
	$this->start= $this->getPage()*$this->getPerPage();
  }
  public function getStart(){
    return $this->start;
  
  }
  
  public function pageSetup($page,$per_page){
     $this->setPage($page);
	 
	 $this->page=$this->getPage();
	 $this->cur_page=$this->page;
	 $this->page -=1;
	 $this->setPerPage($per_page);	
	 $this->per_page = $this->getPerPage();
	 
	 $this->setPrvBtn(true);
	 $this->getPrvBtn();
	 
	 $this->setNxtBtn(true);
	 $this->getNxtBtn();
	 	
	 $this->setFstBtn(true);
	 $this->getFstBtn();	
	 
	 $this->setLstBtn(true);
	 $this->getLstBtn();
	 
	 $this->start=$this->page*$this->per_page;
	 return $this->start;
	  
  
  }
  
  public function pageNumber($sql,$per_page,$page){
	$this->setPerPage($per_page); 
	$this->per_page=$this->getPerPage();
	
     $this->msg='';
	 $query_pag_num=$sql;
	 $result_pag_num=parent::select($query_pag_num);						
	 $row=parent::get_row($result_pag_num,'MYSQL_ASSOC');		
			$count = $row['count'];
			
			$no_of_paginations = ceil($count / $this->per_page);
			
			/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
			
     $this->setPage($page);
	 $this->getPage();
	 $this->setCurpage($this->getPage());
	 $this->getCurpage();
			
			if ($this->getCurpage() >= 7) {
				$start_loop = $this->getCurpage() - 3;
				if ($no_of_paginations > $this->getCurpage() + 3)
					$end_loop = $this->getCurpage() + 3;
				else if ($this->getCurpage() <= $no_of_paginations && $this->getCurpage() > $no_of_paginations - 6) {
					$start_loop = $no_of_paginations - 6;
					$end_loop = $no_of_paginations;
				} else {
					$end_loop = $no_of_paginations;
				}
			} else {
				$start_loop = 1;
				if ($no_of_paginations > 7)
					$end_loop = 7;
				else
					$end_loop = $no_of_paginations;
			}
			/* ----------------------------------------------------------------------------------------------------------- */
			$this->msg .= "<div class='pagination'><ul>";
			
			// FOR ENABLING THE FIRST BUTTON
			$this->setFstBtn(true);
			if ($this->getFstBtn() && $this->getCurpage() > 1) {
				$this->msg .= "<li p='1' class='active'>First</li>";
			} else if ($this->getFstBtn()) {
				$this->msg .= "<li p='1' class='inactive'>First</li>";
			}
			
			// FOR ENABLING THE PREVIOUS BUTTON
			$this->setPrvBtn(true);
			if ($this->getPrvBtn() && $this->getCurpage() > 1) {
				$pre = $this->getCurpage() - 1;
				$this->msg .= "<li p='$pre' class='active'>Previous</li>";
			} else if ($this->getPrvBtn()) {
				$this->msg .= "<li class='inactive'>Previous</li>";
			}
			for ($i = $start_loop; $i <= $end_loop; $i++) {
			
				if ($this->getCurpage() == $i)
					$this->msg .= "<li p='$i' style='color:#fff;background-color:#006699;' class='active'>{$i}</li>";
				else
					$this->msg .= "<li p='$i' class='active'>{$i}</li>";
			}
			
			// TO ENABLE THE NEXT BUTTON
			$this->setNxtBtn(true);
			
			if ($this->getNxtBtn() && $this->getCurpage() < $no_of_paginations) {
				$nex = $this->getCurpage() + 1;
				$this->msg .= "<li p='$nex' class='active'>Next</li>";
			} else if ($this->getNxtBtn()) {
				$this->msg .= "<li class='inactive'>Next</li>";
			}
			
			// TO ENABLE THE END BUTTON
			$this->setLstBtn(true);
			if ($this->getLstBtn() && $this->getCurpage() < $no_of_paginations) {
				$this->msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
			} else if ($this->getLstBtn()) {
				$this->msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
			}
			$this->msg = $this->msg . "</ul></div>";  // Content for pagination
			return $this->msg;  
  
  
  
  }
}
