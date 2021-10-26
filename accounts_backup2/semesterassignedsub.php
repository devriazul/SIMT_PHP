<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='semesterwisesubject.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
$per_page = 20;

if(isset($_GET['page']))
    $page = $_GET['page'];
$start = ($page-1)*$per_page;
?>
<div class="indent1 unline" >
<?php 		  
		  $sdq=" SELECT count(tbl_semesterwisesubj.id) ToalRecord,tbl_semesterwisesubj.id id, tbl_semesterwisesubj.year, tbl_semesterwisesubj.session, tbl_semester.name as SemesterName, 
		                tbl_department.name as DepartmentName,tbl_courses.coursename as CourseName 
						FROM tbl_semesterwisesubj 
						inner join tbl_semester on tbl_semesterwisesubj.semesterid=tbl_semester.id 
						inner join tbl_department on tbl_semesterwisesubj.deptid=tbl_department.id 
						inner join tbl_courses on tbl_semesterwisesubj.courseid=tbl_courses.id 
						WHERE tbl_semesterwisesubj.storedstatus <>'D' 
						group by tbl_semesterwisesubj.id,tbl_semesterwisesubj.year,tbl_semesterwisesubj.session,tbl_department.name,tbl_courses.coursename,tbl_semester.name
						limit $start,$per_page";
			    $sdep=$myDb->dump_query($sdq,'edit_semesterwisesubj.php','del_semesterwisesubj.php',$car['upd'],$car['delt']);
		  ?>	
</div>		  	          
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