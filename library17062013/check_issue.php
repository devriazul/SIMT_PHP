<?php ob_start();
@session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){ 
	if(isset($_GET['stdid'])){
	  $stdid=mysql_real_escape_string($_GET['stdid']);
	}else{
	  $stdid=mysql_real_escape_string($_POST['stdid']);
	}  
?>
<?php 	
	$opby=mysql_real_escape_string($_SESSION['userid']);
	
	$lss=$myDb->select("select*from tbl_libsetting");
	$lssf=$myDb->get_row($lss,'MYSQL_ASSOC');
	
	$tbbq=$myDb->select("select ifnull(count(*),0) totalbook from tbl_bookissue WHERE stdid='$stdid' and irstatus='ISSUE' and `return`<>'R'");
	$tbbf=$myDb->get_row($tbbq,'MYSQL_ASSOC');
	
	
	if($tbbf['totalbook']!=$lssf['maxallow']){
			$issb=$myDb->select("SELECT*,DATEDIFF(curdate(),returndate) as dated,curdate()  as currentdate FROM tbl_bookissue 
								WHERE stdid='$stdid' and irstatus='ISSUE' 
								and (`return`<>'R' or `return`='R')
								and fine=0
								and returndate<=curdate()");
			$sum=0;
			while($issbf=$myDb->get_row($issb,'MYSQL_ASSOC')){
			   
				if(isset($issbf['id'])){
				   $crrs=$myDb->select("SELECT*FROM tbl_courses WHERE id='$issbf[courseid]'");
				   $crrsf=$myDb->get_row($crrs,'MYSQL_ASSOC');
				   echo "You have to return this book:".$crrsf['coursename']."</br>";
				   echo "Total exceeded day:".$issbf['dated']."</br>";
				   $sum=($sum+($issbf['dated']*$lssf['fine']));
				   echo "<br/>";
				  
				}
				$sum++;
			
			}
			if($sum==0){
			  echo "";
			}else{
			  echo "Total Fine: ".$sum;  
			  exit;
			}  
	}else{
	  echo "You already taken 4 books,another book not issued for you";
	  exit;
    }	  
				

}else{
  header("Location:login.php");
}
}  
?>