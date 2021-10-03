<?php require_once("dbClass.php");
include("config.php");
ini_set("display_error","true");

class Utility extends dbClass{
   //$R="REQ-10000022222"; $rl=strlen($R);  $sp=strpos($R,"-"); echo $sub=substr($R,4,$rl);  ?
   public $r;
   public $rl;
   public $sp;
   public $sub;
   public $q;
   public $rs;
   public $reqid;
   public function __construct(){
	   parent::connect("localhost","root","dtbd13adm1n","simtdb",true);      
   }
   
   public function currentReqid(){
      //$R="REQ-10000022222"; $rl=strlen($R);  $sp=strpos($R,"-"); echo $sub=substr($R,4,$rl);  ?
		  $this->q=parent::select("SELECT reqid FROM tbl_buyproduct where id=(select max(id) from tbl_buyproduct)");
		  $this->rs=parent::get_row($this->q,'MYSQL_ASSOC');

		if(empty($this->rs["reqid"])){
			 $this->r="REQ-10001";
			 $this->rl=strlen($this->r);
			 $this->sp=strpos($this->r,"-");
			 $this->sub=substr($this->r,4,$this->rl);
			 return $this->r;
		}else{
			 $this->r=$this->rs["reqid"];
			 $this->rl=strlen($this->r);
			 $this->sp=strpos($this->r,"-");
			 $this->sub=substr($this->r,4,$this->rl);
			 $this->reqid="REQ-".intval(($this->sub)+1);
			 return $this->reqid;
		} 
   }	 
  public function __destruct(){
    parent::__destruct(parent::connect("localhost","root","dtbd13adm1n","simtdb",true));
  }  
}

?>
