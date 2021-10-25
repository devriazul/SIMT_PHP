<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='book_entry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
?>

<div align="center">
<h2>SAIC GROUP OF INSTITUTIONS<br />
<h4>House-1,Road-2,Block-B,Section-6</h4>
<h4>Mirpur,Dhaka-1216</h4>
</h2>
</div>
<style type="text/css">
table{
     page-break-after:always;
	 page-break-before:avoid;
	 }

</style>
<?php  

    $crsname=mysql_real_escape_string($_GET['crsname'])?mysql_real_escape_string($_GET['crsname']):'';
	$listb=mysql_real_escape_string($_GET['listb'])?mysql_real_escape_string($_GET['listb']):'';

				switch($listb){
						case "department":
							$dpt=$myDb->select("SELECT id,count(name),name FROM tbl_department where name='$crsname'");
							while($dptf=$myDb->get_row($dpt,'MYSQL_ASSOC')){
							if(!empty($dptf['name'])){
							  echo "<label>Department Name:</label> {$dptf['name']}";
							}
							  $sdq="SELECT b.bookid as id,d.name as 'Department Name',c.coursename 'Course Name',b.author Author,b.edition Edition,b.selfid 'Book Self No',b.rowno 'Row No',b.publisher Publisher,b.totalbook 'Total Book',b.price Price,b.totalbook*b.price 'Total Cost' 
									from tbl_bookentry b
									INNER JOIN tbl_courses c
									on b.courseid=c.id
									INNER JOIN tbl_department d
									on c.departmentid=d.id
									where b.deptid='$dptf[id]'
									
									
							  ";
							 ?>
							 <?php 

									$sdep=$myDb->dump_bookquery($sdq,'','','','');
						   }									
						   break;		
						default:	
							$dpt=$myDb->select("SELECT id,count(name),name FROM tbl_department group by name");
							while($dptf=$myDb->get_row($dpt,'MYSQL_ASSOC')){
							if(!empty($dptf['name'])){
							  echo "<label>Department Name:</label> {$dptf['name']}";
							}
							echo "</br>";
							echo "</br>";
							  $sdq="SELECT b.bookid as id,d.name as 'Department Name',c.coursename 'Course Name',b.author Author,b.edition Edition,b.selfid 'Book Self No',b.rowno 'Row No',b.publisher Publisher,b.totalbook 'Total Book',b.price Price,b.totalbook*b.price 'Total Cost' 
									from tbl_bookentry b
									INNER JOIN tbl_courses c
									on b.courseid=c.id
									INNER JOIN tbl_department d
									on c.departmentid=d.id
									where b.deptid='$dptf[id]'
									
									
							  ";
							 ?>
							 <?php 

									$sdep=$myDb->dump_bookquery($sdq,'','','','');
						   }			
						
						
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
