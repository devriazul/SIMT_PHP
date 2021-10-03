<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php");
require_once('class/ReturnStatus.class.php');
require_once('class/PagingPage.class.php');

if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='book_entry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  $prs=new ReturnStatus();
  $pg=new PagingPage();
	  $deptsearch=!empty($_GET['deptsearch'])?$_GET['deptsearch']:'';
	  $fdate=!empty($_GET['fdate'])?$_GET['fdate']:'';
	  $tdate=!empty($_GET['tdate'])?$_GET['tdate']:'';
	  
	  $deptsearch=$pg->select("SELECT id FROM tbl_department WHERE name like'$deptsearch%'");
	  $deptf=$pg->get_row($deptsearch,'MYSQL_ASSOC');
	  if(!empty($deptf['id'])){
	 
	 ?>

	 <?php

		    $sql="select d.name,c.id courseid,c.coursename,s.stdid,s.stdname
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_stdinfo s
								on s.stdid=b.stdid
								where b.returndate between '$fdate' and '$tdate'
								and b.deptid='$deptf[id]'
								and b.irstatus<>'RETURN'
								order by d.name,c.coursename";
			$prs->CurrentDateReturn($sql,'y');
			
			}else{
			
			  echo "</br></br></br><div align=center>No Record found</div>";
			  exit;
			
			}
			
	    	
?>	 


<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>
