<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){ 
	$opby=mysql_real_escape_string($_SESSION['userid']);
	$courseid=mysql_real_escape_string($_GET['courseid']);
	$isbnno=mysql_real_escape_string($_POST['isbnno']);
	$author=mysql_real_escape_string($_POST['author']);
	$publisher=mysql_real_escape_string($_POST['publisher']);
	$edition=mysql_real_escape_string($_POST['edition']);
	$deptid=mysql_real_escape_string($_POST['deptid']);
	$selfid=mysql_real_escape_string($_POST['selfid']);
	$noofrow=mysql_real_escape_string($_POST['noofrow']);
	$price=mysql_real_escape_string($_POST['price']);
	$totalbook=mysql_real_escape_string($_POST['totalbook']);
	
	$chkbook=$myDb->select("SELECT bookid,courseid,deptid FROM tbl_bookentry WHERE courseid='$courseid' AND deptid='$deptid'");
	$bookf=$myDb->get_row($chkbook,'MYSQL_ASSOC');
	
	if(empty($bookf['courseid']) && empty($bookf['deptid'])){
	
	    $courseq=$myDb->select("SELECT*FROM tbl_courses WHERE id='$courseid'");
		$coursef=$myDb->get_row($courseq,'MYSQL_ASSOC');
		
		
		
		$deptq=$myDb->select("SELECT*FROM tbl_department WHERE id='$deptid'");
		$deptf=$myDb->get_row($deptq,'MYSQL_ASSOC');
		

		$query="INSERT INTO tbl_bookentry(`courseid`,`deptid`,`isbnno`,`author`,`publisher`,
							  `edition`,`selfid`,`rowno`,`price`,`opby`,`storedstatus`,`totalbook`)            
				VALUES('$courseid','$deptid','$isbnno','$author','$publisher','$edition','$selfid','$noofrow','$price','$opby','I','$totalbook')";
		if($r=$myDb->insert_sql($query)){
		
			$maxbook=$myDb->select("SELECT MAX(bookid) mid from tbl_bookentry");
			$maxbookf=$myDb->get_row($maxbook,'MYSQL_ASSOC');
			
			$chkpr=$myDb->select("SELECT*FROM tbl_product WHERE prtype='Library Book' AND bookid='$maxbookf[mid]' AND courseid='$coursef[id]'");
			$chkprf=$myDb->get_row($chkpr,'MYSQL_ASSOC');
			if(empty($chkprf['courseid'])){
				
				$pquery="INSERT INTO tbl_product(pname,prtype,courseid,bookid,opby)
						 VALUES('$coursef[coursename]','ST012','$coursef[id]','$maxbookf[mid]','$_SESSION[userid]')";
				$myDb->insert_sql($pquery);		 
		    }		
			
			
			//$maxp=$myDb->select("SELECT MAX(id) mid from tbl_product");
			//$maxpf=$myDb->get_row($maxp,'MYSQL_ASSOC');
			
			//$insacc="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,productid)
							// VALUES('$coursef[coursename]','1660','1660','Expense Account','1','$_SESSION[userid]','".date("Y-m-d")."','I','$maxpf[mid]')";
			//$myDb->insert_sql($insacc);	
				 
		
		  $msg="Data inserted successfully";
		  echo $msg;
		}else{
		  $msg=$myDb->last_error;  
		  echo $msg;
		} 
	}else{
	    $msg="Duplicate entry,please try another";
		echo $msg;
	
	} 

}else{
  header("Location:index.php");
}
}